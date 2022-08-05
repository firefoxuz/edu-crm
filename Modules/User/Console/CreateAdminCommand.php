<?php

namespace Modules\User\Console;

use Illuminate\Console\Command;
use InvalidArgumentException;
use Modules\User\Enums\UserRoleEnum;
use Modules\User\Services\UserService;

class CreateAdminCommand extends Command
{
    protected $signature = 'create:admin {email} {password}';

    protected $description = 'create admin for panel';

    public function handle()
    {

        $is_created = UserService::create(
            'Administrator',
            $this->argument('email'),
            $this->argument('password'),
            UserRoleEnum::admin(),
        );

        if (!$is_created) {
            throw new InvalidArgumentException('Invalid argument');
        }

        $this->info('Admin created successfully');
    }
}
