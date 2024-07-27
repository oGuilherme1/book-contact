<?php

declare(strict_types=1);

namespace Src\Contacts\Application\UseCases\Storage;

use Exception;
use Src\Contacts\Application\DTOs\DeleteImageStorage\DeleteImageStorageDto;

class DeleteImageStorageUseCase
{
    private function __construct(
        private StorageGateway $gateway
    ) {
    }

    public static function create(StorageGateway $gateway): self
    {
        return new self($gateway);
    }

    public function execute(DeleteImageStorageDto $inputDTO): void
    {
        try {

            $this->gateway->deleteImage($inputDTO->getImage());
            
        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }
    }
}
