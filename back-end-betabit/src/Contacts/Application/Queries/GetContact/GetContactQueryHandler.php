<?php

declare(strict_types=1);

namespace Src\Contacts\Application\Queries\GetContact;

use Src\Contacts\Application\DTOs\GetContact\GetContactDto;
use Src\Contacts\Application\Queries\Query;
use Src\Contacts\Application\Queries\QueryHandler;
use Src\Contacts\Application\UseCases\GetContact\GetContactUseCase;

class GetContactQueryHandler implements QueryHandler
{
    public function __construct(
        private readonly GetContactUseCase $useCase
    )
    {
    }

    public function handle(Query $command)
    {
        $inputDTO = GetContactDto::create($command->id, $command->idUser);
        return $this->useCase->execute($inputDTO);
    }
}