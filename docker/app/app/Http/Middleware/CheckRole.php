<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // อันนี้คือถ้ายังไม่loginจะเด้งuserกลับไปที่หน้าloginคร่าวๆประมาณนี้
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // อันนี้คือแสดงerrorถ้าroleไม่ตรงกับที่login
        if (!in_array(auth()->user()->role, $roles)) {
            abort(403,'สิทธิ์ของคุณไม่ถูกต้อง');
        }
        return $next($request);
    }
}
