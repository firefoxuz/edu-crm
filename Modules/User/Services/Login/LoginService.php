<?php

namespace Modules\User\Services\Login;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Modules\User\Events\UserLogginedInEvent;
use Modules\User\Exceptions\LoginValidationException;

class LoginService implements LoginContract
{
    private $request;

    private $model;

    private $auth;

    public function __construct(FormRequest $request, Model $model)
    {
        $this->request = $request;
        $this->model = $model;
        $this->auth = app()->make('auth');
    }

    public function login(): array
    {
        $data = $this->request->validated();

        if (!$this->auth->attempt($data)) {
            throw LoginValidationException::withMessages(
                [
                    'email' => 'User not found'
                ],
            );
        }

        UserLogginedInEvent::dispatch($this->request->get('email'));

        return $this->generateToken();
    }

    private function generateToken(): array
    {
        $user = $this->model
            ->newQuery()
            ->where('email', $this->request->get('email'))
            ->firstOrFail();

        $token = $user->createToken('authToken')->plainTextToken;

        return [
            'access_token' => $token,
            'token_type' => 'Bearer'
        ];
    }


}
