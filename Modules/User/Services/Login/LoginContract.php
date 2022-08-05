<?php

namespace Modules\User\Services\Login;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;

interface LoginContract
{
    public function __construct(FormRequest $request, Model $model);

    public function login(): array;
}
