<?php

namespace Modules\User\Actions;

use Modules\User\Entities\User;

class DestroyUserAction
{
    public function destroy($user_id)
    {
        $user = User::query()->findOrFail($user_id);
        $user->delete();
        return $user;
    }
}
