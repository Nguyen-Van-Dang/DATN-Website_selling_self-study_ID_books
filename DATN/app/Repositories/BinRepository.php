<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;

class BinRepository
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

        return view('admin.bin.bin', compact('role_id'));
    }
}
