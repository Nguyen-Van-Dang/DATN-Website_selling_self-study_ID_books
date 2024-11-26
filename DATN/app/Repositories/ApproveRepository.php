<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use  App\Models\Request;
use App\Models\Book;
class ApproveRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }


    public function checkRole()
    {
        $user = auth::user();
        $role_id = $user->role_id;

        return view('admin.approve.approve', compact('role_id'));
    }
}
