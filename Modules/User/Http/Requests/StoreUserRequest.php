<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\User\Enums\UserRoleEnum;

class StoreUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required|in:' . implode(',', UserRoleEnum::toValues()),
            'password' => 'required|string|min:6',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
