<?php

namespace Modules\User\Enums;

use Spatie\Enum\Laravel\Enum;
/**
 * @method static self admin()
 * @method static self manager()
 * @method static self cashier()
 * @method static self teacher()
 */
class UserRoleEnum extends Enum
{
    protected static function values()
    {
        return [
            'admin' => 1,
            'manager' => 2,
            'cashier' => 3,
            'teacher' => 4,
        ];
    }
}
