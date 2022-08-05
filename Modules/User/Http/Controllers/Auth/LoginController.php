<?php

namespace Modules\User\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Modules\User\Services\Login\LoginContract;

class LoginController extends Controller
{
    public function __invoke(LoginContract $loginContract)
    {
        return response()->json($loginContract->login());
    }
}
