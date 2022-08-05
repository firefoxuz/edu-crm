<?php

namespace Modules\User\Actions;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Modules\User\Entities\User;

class UpdateUserAction
{
    public function update(FormRequest $formRequest, $user_id)
    {
        $user = User::query()->findOrFail($user_id);
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
