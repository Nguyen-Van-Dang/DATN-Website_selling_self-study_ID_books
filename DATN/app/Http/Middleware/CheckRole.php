<?php
// app/Http/Middleware/CheckRole.php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */

    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            // role = 1 vào được tất cả trang
            if (Auth::user()->role_id == 1) {
                return $next($request);
            }
            if (Auth::user()->role_id == 2) {
                // role = 2 không vào được trang user của admin
                    if ($request->is('admin/user*') || $request->is('admin/nguoi-dung*') || $request->is('admin/Contact*')) {
                    return redirect('/admin')->with('error', 'Bạn không có quyền truy cập trang này.');
                }
                return $next($request);
            }
            // role = 3 không vào được admin
            return redirect('/')->with('error', 'Bạn không có quyền truy cập trang này.');
        }

        // Nếu chưa đăng nhập, chuyển hướng về trang chủ
        return redirect('/')->with('error', 'Vui lòng đăng nhập.');
    }
}
