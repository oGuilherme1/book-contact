<?php

declare(strict_types=1);

namespace Src\Contacts\Application\UseCases\CreateContact;

use Exception;
use Src\Contacts\Application\DTOs\CreateContact\CreateContactDto;
use Src\Contacts\Application\DTOs\UploadImageStorage\UploadImageStorageDto;
use Src\Contacts\Application\UseCases\Storage\UploadImageStorageUseCase;
use Src\Contacts\Domain\Contact;
use Src\Contacts\Domain\ContactGateway;

class CreateContactUseCase
{
    private function __construct(private readonly ContactGateway $contactGateway, private readonly UploadImageStorageUseCase $uploadImage)
    {

    }

    public static function create(ContactGateway $contactGateway, UploadImageStorageUseCase $uploadImage): self
    {
        return new self($contactGateway, $uploadImage);
    }

    public function execute(CreateContactDto $inputDTO): array
    {
        try {

            $existingEmail = $this->contactGateway->findEmail($inputDTO->getEmail());

            if($existingEmail) {
                throw new Exception('This email already exists');
            }

            $uploadImageInputDTO = UploadImageStorageDto::create($inputDTO->getImage(), null);

            $uploadFile = $this->uploadImage->execute($uploadImageInputDTO);

            $aContact = Contact::create(
                null,
                $inputDTO->getIdUser(),
                $inputDTO->getName(),
                $inputDTO->getEmail(),
                $inputDTO->getPhone(),
                $uploadFile
            );

            $this->contactGateway->save($aContact->toArray());

            return [
                'message' => 'Contact created successfully',
                'success' => true
            ];

        } catch (Exception $e) {

            return  [
                'message' => $e->getMessage(),
                'success' => false
            ];
        }
    }
}