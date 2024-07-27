<?php

declare(strict_types=1);

namespace Src\Contacts\Application\Commands\UpdateContact;

use Src\Contacts\Application\Commands\Command;
use Src\Contacts\Application\Commands\CommandHandler;
use Src\Contacts\Application\DTOs\UpdateContact\UpdateContactDto;
use Src\Contacts\Application\UseCases\UpdateContact\UpdateContactUseCase;

class UpdateContactCommandHandler implements CommandHandler
{
    public function __construct(
        private readonly UpdateContactUseCase $useCase
    ) 
    {
    }

    public function handle(Command $command): array
    {
        $inputDTO = UpdateContactDto::create([...$command->getProperties()]);
        return $this->useCase->execute($inputDTO);
    }
}