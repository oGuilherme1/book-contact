<?php

declare(strict_types=1);

namespace Src\Contacts\Application\Commands\CreateContact;

use Src\Contacts\Application\Commands\Command;
use Src\Contacts\Application\Commands\CommandHandler;
use Src\Contacts\Application\DTOs\CreateContact\CreateContactDto;
use Src\Contacts\Application\UseCases\CreateContact\CreateContactUseCase;

class CreateContactCommandHandler implements CommandHandler
{
    public function __construct(
        private readonly CreateContactUseCase $useCase
    ) 
    {
    }

    public function handle(Command $command): array
    {
        $inputDTO = CreateContactDto::create([...$command->getProperties()]);
        return $this->useCase->execute($inputDTO);
    }
}