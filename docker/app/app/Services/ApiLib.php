<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ApiLib
{
    private string $base;

    public function __construct()
    {
        $this->base = rtrim(config('services.apilib.url'), '/');
    }

    // token ใบเดียวใช้ได้ทุกเส้น (scope read) แคช 3000 วิ
    private function token(): string
    {
        return Cache::remember('apilib_token', 3000, function () {
            $res = Http::asForm()
                ->timeout(10)
                ->post($this->base . '/oauth2/token', [
                    'client_id'            => config('services.apilib.client_id'),
                    'client_secret'        => config('services.apilib.client_secret'),
                    'grant_type'           => 'password',
                    'scope'                => 'read',
                    'provision_key'        => config('services.apilib.provision_key'),
                    'authenticated_userid' => config('services.apilib.user'),
                ]);

            if (!$res->successful()) {
                throw new \RuntimeException('ApiLib Token Request Failed: ' . $res->body());
            }

            $token = $res->json('access_token');

            if (!$token) {
                throw new \RuntimeException('ApiLib ไม่ส่ง access_token กลับมา');
            }

            return $token;
        });
    }

    private function post(string $path, array $data)
    {
        for ($i = 0; $i < 2; $i++) {
            $res = Http::timeout(10)
                ->withToken($this->token())
                ->acceptJson()
                ->post($this->base . $path, $data);

            // token หมดอายุก่อนเวลา: ล้างแคชแล้วขอใหม่ 1 ครั้ง
            if ($res->status() === 401 && $i === 0) {
                Cache::forget('apilib_token');
                continue;
            }

            return $res;
        }

        return $res;
    }

    // ตรวจ username + รหัสผ่านมหาวิทยาลัย และต้องเป็นบุคลากรห้องสมุด (statusauth = library)
    public function login(string $username, string $password): bool
    {
        try {
            $res = $this->post('/api/login', [
                'username'   => $username,
                'password'   => $password,
                'secret'     => false,
                'statusauth' => 'library',
            ]);

            return $res->successful() && ($res->json('status') === 'success' || $res->json('status') === true);
        } catch (\Throwable $e) {
            // ห้ามใส่รหัสผ่านลง log
            Log::warning('ApiLib login error', ['error' => $e->getMessage()]);
            return false;
        }
    }

    // ค้นหาบุคลากรห้องสมุดจาก username (ไม่ใช้รหัสผ่าน) ไม่พบจะได้ null
    public function checkPerson(string $username): ?array
    {
        $res = $this->post('/Persons/CheckPersons', ['username' => $username]);

        if ($res->status() === 404) {
            return null;
        }

        return ($res->successful() && $res->json('status') === true) ? $res->json('data') : null;
    }
}