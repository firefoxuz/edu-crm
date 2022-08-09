<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\User\Enums\UserRoleEnum;

class UpdateUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'full_name' => 'string|max:255',
            'email' => 'string|email|max:255|unique:users',
            'role' => 'in:' . implode(',', UserRoleEnum::toValues()),
            'password' => 'string|min:6',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
