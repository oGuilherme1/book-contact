<?php

declare(strict_types=1);

namespace Src\Users\Application\Commands\CreateUser;

use Src\Users\Application\Commands\Command;

class CreateUserCommand extends Command
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $password
    ) {
    }
}