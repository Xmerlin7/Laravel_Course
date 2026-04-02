<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService
{

    public function getAllUsers()
    {
        return DB::table('users')->orderBy('id')->get();
    }

    public function createUser(array $data)
    {
        return DB::table('users')->insertGetId([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'role'     => 'user',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
