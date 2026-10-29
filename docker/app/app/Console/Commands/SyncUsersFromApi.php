<?php

namespace App\Console\Commands;

use App\Services\AssessmentApi;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SyncUsersFromApi extends Command
{
    protected $signature = 'users:sync-api {--apply : เขียนลงฐานข้อมูลจริง (ไม่ใส่ = dry-run)}';
    protected $description = 'นำเข้าผู้ใช้จากระบบแบบประเมิน (เก็บ password_hash ตรง ๆ ไม่ hash ซ้ำ)';

    // เทียบ role
    private const ROLE_MAP = [
        'super admin' => 'admin',
        'admin'       => 'manager',
        'user'        => 'user',
    ];

    public function handle(AssessmentApi $api): int
    {
        $apply = $this->option('apply');
        $this->info($apply ? 'โหมดนำเข้าจริง' : 'โหมด dry-run (ยังไม่เขียนฐานข้อมูล)');

        $existing = DB::table('users')->pluck('username')->map(fn($u) => mb_strtolower($u))->all();
        $stats = ['insert' => 0, 'exists' => 0, 'no_password' => 0, 'bad_role' => 0, 'error' => 0];

        foreach ($api->users() as $u) {
            $role = self::ROLE_MAP[mb_strtolower(trim((string) $u->role))] ?? null;

            if (in_array(mb_strtolower($u->username), $existing, true)) {
                $stats['exists']++;
                $this->line("ข้าม (มีอยู่แล้ว): {$u->username}");
                continue;
            }
            if (!$role) {
                $stats['bad_role']++;
                $this->warn("ข้าม (role แมปไม่ได้ '{$u->role}'): {$u->username}");
                continue;
            }
            if (empty($u->password_hash)) {
                $stats['no_password']++;
                $this->line("ข้าม (ไม่มีรหัสผ่าน/login ผ่านมหาวิทยาลัย): {$u->username}");
                continue;
            }

            $this->line("เพิ่ม: {$u->username} ({$u->role} -> {$role})");

            if ($apply) {
                try {
                    // ใช้ DB::table เพื่อข้าม cast 'hashed' ของ Model จึงไม่ hash ซ้ำ
                    DB::table('users')->insert([
                        'username'      => $u->username,
                        'full_name'     => $u->full_name ?: $u->username,
                        'email'         => $u->email,
                        'password_hash' => $u->password_hash,
                        'role'          => $role,
                        'is_active'     => $u->is_active,
                        'created_at'    => now(),
                        'updated_at'    => now(),
                    ]);
                } catch (\Throwable $e) {
                    $stats['error']++;
                    $this->error("พลาด {$u->username}: " . $e->getMessage());
                    continue;
                }
            }
            $stats['insert']++;
        }

        $this->newLine();
        $this->table(['จะเพิ่ม/เพิ่มแล้ว', 'มีอยู่แล้ว', 'ไม่มีรหัสผ่าน', 'role แมปไม่ได้', 'error'], [array_values($stats)]);
        return self::SUCCESS;
    }
}