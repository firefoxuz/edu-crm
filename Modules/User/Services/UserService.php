<?php

namespace Modules\User\Services;

use Illuminate\Support\Facades\Hash;
use Modules\User\Entities\User;
use Modules\User\Enums\UserRoleEnum;

class UserService
{
    public static function create($full_name, $email, $password, UserRoleEnum $role)
    {
        return User::create([
            'full_name' => $full_name,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => $role
        ]);
    }
}
