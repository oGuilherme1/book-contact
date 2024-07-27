<?php

declare(strict_types=1);

namespace Src\Contacts\Application\UseCases\Storage;

use Exception;
use Src\Contacts\Application\DTOs\UploadImageStorage\UploadImageStorageDto;

class UploadImageStorageUseCase
{
    private function __construct(
        private StorageGateway $gateway
    ) {
    }

    public static function create(StorageGateway $gateway): self
    {
        return new self($gateway);
    }

    public function execute(UploadImageStorageDto $inputDTO): string
    {
        try {

            return $this->gateway->uploadImage($inputDTO->getImage(), $inputDTO->getOldImageUrl());
            
        } catch (Exception $e) {

            throw new Exception($e->getMessage());
        }
    }
}
