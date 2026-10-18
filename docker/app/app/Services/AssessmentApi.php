<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class AssessmentApi
{
    private string $base;

    public function __construct()
    {
        $this->base = rtrim(config('services.assessment.url'), '/');
    }

    // ขอ token ต่อ 1 URI และ cache ไว้
    private function token(string $uri): string
    {
        return Cache::remember('assess_api_token_' . md5($uri), 3000, function () use ($uri) {
            return Http::timeout(10)
                ->post($this->base . '/api/oauth2/token', [
                    'client_id'            => config('services.assessment.client_id'),
                    'client_secret'        => config('services.assessment.client_secret'),
                    'grant_type'           => 'password',
                    'scope'                => $uri,
                    'provision_key'        => $uri,
                    'authenticated_userid' => config('services.assessment.user'),
                ])
                ->throw()
                ->json('access_token');
        });
    }

    private function call(string $method, string $path, array $data = []): array
    {
        $uri = $this->base . $path;

        for ($attempt = 0; $attempt < 2; $attempt++) {
            $req = Http::timeout(10)->withToken($this->token($uri))->acceptJson();
            $res = $method === 'POST' ? $req->post($uri, $data) : $req->get($uri);

            // token หมดอายุก่อนเวลา ล้างแคชแล้วขอใหม่ 1 ครั้ง
            if ($res->status() === 401 && $attempt === 0) {
                Cache::forget('assess_api_token_' . md5($uri));
                continue;
            }

            return $res->throw()->json();
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
            ->filter(fn($r) => !empty($r->full_name))
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
            'password_hash' => $u['password_hash'] ?? null,
        ]);
    }
}