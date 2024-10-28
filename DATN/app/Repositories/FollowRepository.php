<?php

namespace App\Repositories;
use App\Models\Follow;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class FollowRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
public function follow($userId)
    {
        // Tìm người dùng theo ID
        $user = User::findOrFail($userId);

        // Kiểm tra nếu người dùng hiện tại chưa theo dõi người khác
        if (!auth()->user()->followings()->where('following_id', $user->id)->exists()) {
            auth()->user()->followings()->attach($user->id);
        }

        return back();
    }

    public function unfollow($userId)
    {
        // Tìm người dùng theo ID
        $user = User::findOrFail($userId);

        // Hủy theo dõi nếu đang theo dõi
        auth()->user()->followings()->detach($user->id);

        return back();
    }

    // Lấy tổng số người theo dõi (followers)
    public function getFollowersCount($userId)
    {
        $user = User::findOrFail($userId);
        return $user->followers()->count();
    }  
}
