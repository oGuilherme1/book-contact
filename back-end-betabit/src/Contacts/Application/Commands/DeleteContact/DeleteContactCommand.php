<?php

declare(strict_types=1);

namespace Src\Contacts\Application\Commands\DeleteContact;

use Src\Contacts\Application\Commands\Command;

class DeleteContactCommand extends Command
{
    public function __construct(
        public readonly int $id
    )
    {
    }
}