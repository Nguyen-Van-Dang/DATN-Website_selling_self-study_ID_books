<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AutoLogout
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $inactiveTime = 10;
            $lastActivity = session('last_activity_time');

            if ($lastActivity && (time() - $lastActivity > $inactiveTime)) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                toastr()->info('<p>Phiên đăng nhập đã hết hạn!</p>');
                return redirect('/');
            }

            // Cập nhật thời gian hoạt động cuối cùng
            session(['last_activity_time' => time()]);
        }

        return $next($request);
    }
}
