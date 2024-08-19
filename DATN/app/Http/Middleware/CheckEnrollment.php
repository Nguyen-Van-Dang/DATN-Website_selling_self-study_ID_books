<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class CheckEnrollment
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Kiểm tra người dùng đã đăng nhập chưa
        if (!Auth::check()) {
            return redirect('/');
        }

        $userId = Auth::id();
        $enrolled = DB::table('enrolls')
            ->where('user_id', $userId)
            ->where('course_id', $request->id)
            ->exists();

        if (!$enrolled) {
            return redirect('/');
        }

        return $next($request);
    }
}
