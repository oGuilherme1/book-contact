<?php

declare(strict_types=1);

namespace Src\Contacts\Application\Commands\DeleteContact;

use Src\Contacts\Application\Commands\Command;
use Src\Contacts\Application\Commands\CommandHandler;
use Src\Contacts\Application\DTOs\DeleteContact\DeleteContactDto;
use Src\Contacts\Application\UseCases\DeleteContact\DeleteContactUseCase;

class DeleteContactCommandHandler implements CommandHandler
{
    public function __construct(
        private readonly DeleteContactUseCase $useCase
    ) 
    {
    }

    public function handle(Command $command): array
    {
        $inputDTO = DeleteContactDto::create([...$command->getProperties()]);
        return $this->useCase->execute($inputDTO);
    }
}