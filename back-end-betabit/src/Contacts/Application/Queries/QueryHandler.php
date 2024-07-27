<?php

declare(strict_types=1);

namespace Src\Contacts\Application\Queries;

interface QueryHandler
{
    public function handle(Query $query);
}