<?php

namespace Modules\User\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\User\Entities\User;
use Modules\User\Enums\UserRoleEnum;

class UserFactory extends Factory
{
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'full_name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'role' => UserRoleEnum::toValues()[rand(0, count(UserRoleEnum::toValues()) - 1)],
            'email_verified_at' => null,
            'password' => Hash::make(123456), // password
            'remember_token' => Str::random(10),
        ];
    }


}
