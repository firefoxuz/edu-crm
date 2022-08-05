<?php

namespace Modules\User\Actions;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Modules\User\Entities\User;

class StoreUserAction
{
    public function store(FormRequest $formRequest)
    {
        $user = new User();
        $user->fill(
            array_replace(
                $formRequest->only($user->getFillable()),
                ['password' => Hash::make($formRequest->password)]
            )
        );
        $user->save();
        return $user;
    }
}
