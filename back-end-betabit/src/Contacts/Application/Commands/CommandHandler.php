<?php

declare(strict_types=1);

namespace Src\Contacts\Application\Commands;

interface CommandHandler
{
    public function handle(Command $command);
}