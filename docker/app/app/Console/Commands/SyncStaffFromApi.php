<?php

namespace App\Console\Commands;

use App\Services\ApiLib;
use App\Services\AssessmentApi;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SyncStaffFromApi extends Command
{
    protected $signature = 'users:sync-staff {--apply : เขียนลงฐานข้อมูลจริง (ไม่ใส่ = dry-run)}';
    protected $description = 'นำเข้าบุคลากรห้องสมุดที่ไม่มีรหัสผ่าน (login ผ่าน ApiLib) โดยตรวจกับ CheckPersons';

    private const ROLE_MAP = [
        'super admin' => 'admin',
        'admin'       => 'manager',
        'user'        => 'user',
    ];

    public function handle(AssessmentApi $assess, ApiLib $lib): int
    {
        $apply = $this->option('apply');
        $this->info($apply ? 'โหมดนำเข้าจริง' : 'โหมด dry-run (ยังไม่เขียนฐานข้อมูล)');

        $existing = DB::table('users')->pluck('username')->map(fn($u) => mb_strtolower($u))->all();
        $stats = ['insert' => 0, 'exists' => 0, 'not_staff' => 0, 'bad_role' => 0, 'error' => 0];

        foreach ($assess->users() as $u) {
            // คนที่มีรหัสผ่านถูกนำเข้าด้วย users:sync-api แล้ว
            if (!empty($u->password_hash)) {
                continue;
            }
            if (in_array(mb_strtolower($u->username), $existing, true)) {
                $stats['exists']++;
                $this->line("ข้าม (มีอยู่แล้ว): {$u->username}");
                continue;
            }
            $role = self::ROLE_MAP[mb_strtolower(trim((string) $u->role))] ?? null;
            if (!$role) {
                $stats['bad_role']++;
                $this->warn("ข้าม (role แมปไม่ได้ '{$u->role}'): {$u->username}");
                continue;
            }

            try {
                $p = $lib->checkPerson($u->username);
            } catch (\Throwable $e) {
                $stats['error']++;
                $this->error("เรียก ApiLib ไม่ได้ {$u->username}: " . $e->getMessage());
                continue;
            }
            if (!$p || ($p['Status'] ?? '') !== 'Active') {
                $stats['not_staff']++;
                $this->line("ข้าม (ไม่ใช่บุคลากรห้องสมุดที่ Active): {$u->username}");
                continue;
            }

            $name = trim(($p['Firstname'] ?? '') . ' ' . ($p['Lastname'] ?? ''));
            $this->line("เพิ่ม: {$u->username} ({$u->role} -> {$role})");

            if ($apply) {
                try {
                    DB::table('users')->insert([
                        'username'      => $u->username,
                        'full_name'     => $name ?: ($u->full_name ?: $u->username),
                        'email'         => $u->email ?: ($p['Email'] ?? null),
                        'password_hash' => null,   // login ผ่าน ApiLib
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
        $this->table(['จะเพิ่ม/เพิ่มแล้ว', 'มีอยู่แล้ว', 'ไม่ใช่บุคลากรห้องสมุด', 'role แมปไม่ได้', 'error'], [array_values($stats)]);
        return self::SUCCESS;
    }
}