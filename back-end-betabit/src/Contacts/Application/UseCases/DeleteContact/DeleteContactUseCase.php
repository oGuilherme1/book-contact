<?php

declare(strict_types=1);

namespace Src\Contacts\Application\UseCases\DeleteContact;

use Exception;
use Src\Contacts\Application\DTOs\DeleteContact\DeleteContactDto;
use Src\Contacts\Application\DTOs\DeleteImageStorage\DeleteImageStorageDto;
use Src\Contacts\Application\UseCases\Storage\DeleteImageStorageUseCase;
use Src\Contacts\Application\UseCases\Storage\UploadImageStorageUseCase;
use Src\Contacts\Domain\ContactGateway;

class DeleteContactUseCase
{
    private function __construct(private readonly ContactGateway $contactGateway, private readonly DeleteImageStorageUseCase $deleteImage)
    {
        
    }

    public static function create(ContactGateway $contactGateway, DeleteImageStorageUseCase $deleteImage): self
    {
        return new self($contactGateway, $deleteImage);
    }

    public function execute(DeleteContactDto $inputDTO): array
    {
        try {

            $contact = $this->contactGateway->get($inputDTO->getId());

            if($contact === []) {
                throw new Exception('Contact not found');
            }

            $deleteImageDTO = DeleteImageStorageDto::create($contact['imageURL']);

            $this->deleteImage->execute($deleteImageDTO);

            $this->contactGateway->delete($inputDTO->getId());

            return [
                'message' => 'Contact deleted successfully',
                'success' => true
            ];
            
        } catch (Exception $e) {
            return [
                'message' => $e->getMessage(),
                'success' => false
            ];
        }
    }
}