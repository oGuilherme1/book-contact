<?php

declare(strict_types=1);

namespace Src\Contacts\Application\Queries\GetContact;

use Src\Contacts\Application\Queries\Query;

class GetContactQuery implements Query
{
    public function __construct(
        public readonly ?int $id,
        public readonly int $idUser
    )
    {
    }
}