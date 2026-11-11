<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Http\Client\Pool;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AssessmentApi
{
    private string $base;

    // ดัชนี "อีเมล -> แบบประเมินที่ทำแล้ว" ใช้ร่วมกันทุกคน
    // สดอยู่ 5 นาที / หลังจากนั้นถึง 1 ชม. ยังส่งค่าเดิมให้ทันที แล้วค่อยอัปเดตเบื้องหลังหลังส่งหน้าเว็บไปแล้ว
    private const EMAIL_INDEX_KEY   = 'assess_email_index_v3';   // v3: เพิ่มสถานะ "ถูกสุ่มแล้ว" ของแต่ละคน (ใช้กับหน้าสุ่มของรางวัล)
    private const EMAIL_INDEX_FRESH = 300;
    private const EMAIL_INDEX_STALE = 3600;
    // ยิงพร้อมกันทีละกี่ครั้ง (เซิร์ฟเวอร์ API บางตัวรับพร้อมกันเยอะๆ ไม่ไหว)
    private const POOL_SIZE = 5;

    public function __construct()
    {
        $this->base = rtrim(config('services.assessment.url'), '/');
    }

    private function tokenKey(string $uri): string
    {
        return 'assess_api_token_' . md5($uri);
    }

    private function tokenPayload(string $uri): array
    {
        return [
            'client_id'            => config('services.assessment.client_id'),
            'client_secret'        => config('services.assessment.client_secret'),
            'grant_type'           => 'password',
            'scope'                => $uri,
            'provision_key'        => $uri,
            'authenticated_userid' => config('services.assessment.user'),
        ];
    }

    // ขอ token ต่อ 1 URI และ cache ไว้
    private function token(string $uri): string
    {
        return Cache::remember($this->tokenKey($uri), 3000, function () use ($uri) {
            return Http::timeout(10)
                ->post($this->base . '/api/oauth2/token', $this->tokenPayload($uri))
                ->throw()
                ->json('access_token');
        });
    }

    private function call(string $method, string $path, array $data = []): array
    {
        $uri = $this->base . $path;

        for ($attempt = 0; $attempt < 2; $attempt++) {
            $req = Http::timeout(10)->withToken($this->token($uri))->acceptJson();
            $res = $method === 'POST' ? $req->post($uri, $data) : $req->get($uri, $data);

            // token หมดอายุก่อนเวลา ล้างแคชแล้วขอใหม่ 1 ครั้ง
            if ($res->status() === 401 && $attempt === 0) {
                Cache::forget($this->tokenKey($uri));
                continue;
            }

            return $res->throw()->json() ?? [];
        }

        return [];
    }

    private function normalizeAssessment(array $a): object
    {
        return (object) [
            'assessment_id'   => $a['id'],
            'name'            => $a['name'],
            'created_by_name' => $a['created_by'] ?? null,
            'closed_at'       => !empty($a['closed_at']) ? Carbon::parse($a['closed_at']) : null,
            'is_open'         => (int) ($a['is_open'] ?? 0),
        ];
    }

    // แบบประเมินทั้งหมด
    public function all(): Collection
    {
        $data = $this->call('GET', '/api/assessments');
        return collect($data['assessments'] ?? [])->map(fn($a) => $this->normalizeAssessment($a));
    }

    // แบบประเมิน 1รายการ
    public function find(int $id): ?object
    {
        try {
            $data = $this->call('GET', "/api/assessments/{$id}");
        } catch (RequestException $e) {
            if ($e->response->status() === 404) {
                return null;
            }
            throw $e;
        }
        return $this->normalizeAssessment($data['assessment']);
    }

    // ผู้ตอบแบบประเมิน
    public function respondents(int $id): Collection
    {
        $data = $this->call('GET', "/api/assessments/{$id}/respondents");
        return collect($data['respondents'] ?? [])
            ->map(fn($r) => (object) [
                'respondent_id' => $r['id'],
                'full_name'     => $r['full_name'] ?? null,
                'email'         => $r['email'] ?? null,
                'is_drawn'      => (int) ($r['is_drawn'] ?? 0),
            ])
            ->filter(fn($r) => !empty($r->email))
            ->values();
    }

    // แจ้งว่าผู้ตอบถูกสุ่มแล้ว
    public function markDrawn(int $respondentId): array
    {
        return $this->call('POST', '/api/respondents/drawn', ['respondent_id' => $respondentId]);
    }

    //ผู้ใช้ทั้งหมดของระบบแบบประเมิน
    public function users(): Collection
    {
        $data = $this->call('POST', '/api/users');
        return collect($data['users'] ?? [])->map(fn($u) => (object) [
            'api_id'        => $u['id'],
            'username'      => $u['username'],
            'full_name'     => $u['full_name'] ?? null,
            'email'         => $u['email'] ?? null,
            'role'          => $u['role'] ?? null,
            'is_active'     => (int) ($u['is_active'] ?? 0),
        ]);
    }

    // แบบประเมินที่ user ได้ทำแล้ว *********************
    public function userAssessments(int $userId): Collection
    {
        $data = $this->call('GET', '/api/user-assessments',[
            'user_id' => $userId
        ]);
        return collect($data['assessments'] ?? [])->map(fn($a) => $this->normalizeAssessment($a));
    }

    // แบบประเมินที่ผู้ตอบ (ตามอีเมล) ได้ทำแล้ว
    // เดิม: ทุกคนที่เข้าหน้าหลักต้องรอเรียก API ทีละแบบประเมินจนครบ (1 + จำนวนแบบประเมิน ครั้ง ต่อคน)
    // ใหม่: สร้างดัชนีอีเมลครั้งเดียวใช้ร่วมกันทุกคน เรียก API พร้อมกันทีเดียว และอัปเดตเบื้องหลัง
    public function assessmentsByEmail(string $email): Collection
    {
        $email = strtolower(trim($email));
        if ($email === '') {
            return collect();
        }

        $index = $this->emailIndex();
        $mine  = array_flip($index['emails'][$email] ?? []);
        $drawn = array_flip($index['drawn'][$email] ?? []);

        // แต่ละรายการมี is_drawn ติดมาด้วย (1 = คนนี้ถูกสุ่มแล้วในแบบประเมินนั้น) หน้าสุ่มของรางวัลใช้ หน้าหลักไม่ได้ใช้ก็ไม่เป็นไร
        return collect($index['assessments'])
            ->filter(fn ($a, $id) => isset($mine[$id]))
            ->map(function ($a, $id) use ($drawn) {
                $assessment = $this->normalizeAssessment($a);
                $assessment->is_drawn = isset($drawn[$id]) ? 1 : 0;
                return $assessment;
            })
            ->values();
    }

    // คนนี้ (ตามอีเมล) ถูกสุ่มแล้วในแบบประเมินนี้หรือยัง ดูจากดัชนีที่แคชไว้ ไม่ต้องเรียก API
    public function isDrawn(int $assessmentId, string $email): bool
    {
        $email = strtolower(trim($email));
        if ($email === '') {
            return false;
        }
        return in_array($assessmentId, $this->emailIndex()['drawn'][$email] ?? [], true);
    }

    // ดัชนีที่แคชไว้ (ถ้าเก่าแล้วจะได้ค่าเดิมทันที แล้วระบบอัปเดตให้หลังส่งหน้าเว็บเสร็จ)
    public function emailIndex(): array
    {
        return Cache::flexible(
            self::EMAIL_INDEX_KEY,
            [self::EMAIL_INDEX_FRESH, self::EMAIL_INDEX_STALE],
            fn () => $this->buildEmailIndex()
        );
    }

    // สร้างดัชนีใหม่ทันที (ใช้กับตัวตั้งเวลาอัปเดตล่วงหน้า หรืออยากให้ข้อมูลใหม่เดี๋ยวนั้น)
    public function refreshEmailIndex(): array
    {
        $index = $this->buildEmailIndex();
        Cache::forget(self::EMAIL_INDEX_KEY);
        Cache::flexible(self::EMAIL_INDEX_KEY, [self::EMAIL_INDEX_FRESH, self::EMAIL_INDEX_STALE], fn () => $index);
        return $index;
    }

    // ดึงแบบประเมินทั้งหมด 1 ครั้ง แล้วดึงผู้ตอบของทุกแบบประเมิน "พร้อมกัน" ทีละ 5
    // อันไหนดึงแบบพร้อมกันไม่สำเร็จ จะลองใหม่ทีละอันด้วยวิธีเดิม (call) ที่เคยใช้ได้
    // ถ้ายังไม่สำเร็จจริงๆ จะไม่บันทึกดัชนีที่ขาดหาย ไม่ให้หน้าหลักโชว์ 0 ค้างไว้
    private function buildEmailIndex(): array
    {
        $raw = $this->call('GET', '/api/assessments')['assessments'] ?? [];

        $assessments = [];
        $uris = [];
        foreach ($raw as $a) {
            if (!isset($a['id'])) {
                continue;
            }
            $id = (int) $a['id'];
            $assessments[$id] = $a;
            $uris[$id] = $this->base . "/api/assessments/{$id}/respondents";
        }

        if (!$uris) {
            return ['assessments' => [], 'emails' => [], 'drawn' => []];
        }

        // token ของแต่ละ URI: ใช้ที่แคชไว้ ตัวไหนยังไม่มีค่อยขอแบบพร้อมกัน
        $this->prefetchTokens($uris);

        // ยิงแบบพร้อมกันเฉพาะอันที่มี token แล้ว
        $withToken = array_filter($uris, fn ($uri) => Cache::has($this->tokenKey($uri)));
        $responses = [];
        foreach (array_chunk($withToken, self::POOL_SIZE, true) as $chunk) {
            $responses += Http::pool(function (Pool $pool) use ($chunk) {
                foreach ($chunk as $id => $uri) {
                    $pool->as((string) $id)
                        ->connectTimeout(5)
                        ->timeout(10)
                        ->acceptJson()
                        ->withToken((string) Cache::get($this->tokenKey($uri), ''))
                        ->get($uri);
                }
            });
        }

        $emails  = [];
        $drawn   = [];
        $retried = [];
        $failed  = [];
        foreach ($uris as $id => $uri) {
            $res = $responses[$id] ?? null;

            if ($res instanceof Response && $res->successful()) {
                $list = $res->json('respondents') ?? [];
            } else {
                // บันทึกเหตุผลไว้ดูใน storage/logs/laravel.log
                $retried[$id] = $res instanceof Response ? 'HTTP ' . $res->status()
                    : ($res instanceof \Throwable ? class_basename($res) . ': ' . $res->getMessage() : 'ไม่มี token');
                if ($res instanceof Response && $res->status() === 401) {
                    Cache::forget($this->tokenKey($uri));
                }
                try {
                    $list = $this->call('GET', "/api/assessments/{$id}/respondents")['respondents'] ?? [];
                } catch (RequestException $e) {
                    if ($e->response->status() === 404) {
                        continue;   // แบบประเมินนี้ไม่มีแล้ว ข้ามไป
                    }
                    $failed[$id] = 'HTTP ' . $e->response->status();
                    continue;
                } catch (\Throwable $e) {
                    $failed[$id] = class_basename($e) . ': ' . $e->getMessage();
                    continue;
                }
            }

            foreach ($list as $r) {
                $email = strtolower(trim((string) ($r['email'] ?? '')));
                if ($email !== '') {
                    $emails[$email][] = (int) $id;
                    if ((int) ($r['is_drawn'] ?? 0) === 1) {
                        $drawn[$email][] = (int) $id;
                    }
                }
            }
        }

        if ($retried) {
            Log::info('AssessmentApi: ดึงแบบพร้อมกันไม่สำเร็จ ลองใหม่ทีละอัน', $retried);
        }
        if ($failed) {
            Log::warning('AssessmentApi: ดึงผู้ตอบไม่สำเร็จ ไม่บันทึกดัชนีรอบนี้', $failed);
            throw new \RuntimeException('ดึงผู้ตอบแบบประเมินไม่ครบ ' . count($failed) . ' รายการ');
        }

        foreach ($emails as $email => $ids) {
            $emails[$email] = array_values(array_unique($ids));
        }
        foreach ($drawn as $email => $ids) {
            $drawn[$email] = array_values(array_unique($ids));
        }

        return ['assessments' => $assessments, 'emails' => $emails, 'drawn' => $drawn];
    }

    private function prefetchTokens(array $uris): void
    {
        $missing = array_filter($uris, fn ($uri) => !Cache::has($this->tokenKey($uri)));

        foreach (array_chunk($missing, self::POOL_SIZE, true) as $chunk) {
            $responses = Http::pool(function (Pool $pool) use ($chunk) {
                foreach ($chunk as $id => $uri) {
                    $pool->as((string) $id)
                        ->connectTimeout(5)
                        ->timeout(10)
                        ->post($this->base . '/api/oauth2/token', $this->tokenPayload($uri));
                }
            });

            foreach ($responses as $id => $res) {
                if ($res instanceof Response && $res->successful() && $res->json('access_token')) {
                    Cache::put($this->tokenKey($chunk[(int) $id]), $res->json('access_token'), 3000);
                }
            }
        }
    }
}