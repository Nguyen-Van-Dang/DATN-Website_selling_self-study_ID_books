<?php

namespace App\Repositories;

use App\Interfaces\ReelsRepositoryInterface;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Exception;

class ReelsRepository implements ReelsRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function index() {}
    public function create() {}
    public function store($data) {}
    public function getAll() {}
    public function getById($id) {}
    public function update(array $data, $id) {}
    public function delete($id) {}
}
