<?php

declare(strict_types=1);

namespace Src\Users\Application\Commands\Logout;

use Src\Users\Application\Commands\Command;
use Src\Users\Application\Commands\CommandHandler;
use Src\Users\Application\DTOs\Logout\LogoutDto;
use Src\Users\Application\UseCases\Auth\LogoutUseCase;

class LogoutCommandHandler implements CommandHandler
{
    public function __construct(
        private readonly LogoutUseCase $useCase
    ) {
    }

    public function handle(Command $command)
    {  
        $inputDTO = LogoutDto::create(...$command->getProperties());
        return $this->useCase->execute($inputDTO);
    }
}