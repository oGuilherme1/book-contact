<?php

declare(strict_types=1);

namespace Src\Contacts\Application\UseCases\UpdateContact;

use Exception;
use Illuminate\Support\Facades\Log;
use Src\Contacts\Application\DTOs\UpdateContact\UpdateContactDto;
use Src\Contacts\Application\DTOs\UploadImageStorage\UploadImageStorageDto;
use Src\Contacts\Application\UseCases\Storage\UploadImageStorageUseCase;
use Src\Contacts\Domain\Contact;
use Src\Contacts\Domain\ContactGateway;

class UpdateContactUseCase
{
    private function __construct(private readonly ContactGateway $contactGateway, private readonly UploadImageStorageUseCase $uploadImage)
    {
    }

    public static function create(ContactGateway $contactGateway, UploadImageStorageUseCase $uploadImage): self
    {
        return new self($contactGateway, $uploadImage);
    }

    public function execute(UpdateContactDto $inputDTO): array
    {
        try{

            $contact = $this->contactGateway->get($inputDTO->getId());

            $aContact = Contact::fromArray($contact);
            $aContact->setName($inputDTO->getName());
            $aContact->setEmail($inputDTO->getEmail());
            $aContact->setPhone($inputDTO->getPhone());

            if($inputDTO->getImage() !== null) {
                $uploadImage = $this->uploadImage->execute(UploadImageStorageDto::create($inputDTO->getImage(), $contact['imageURL']));
                $aContact->setImageUrl($uploadImage ?? $contact['imageURL']);
            }

            $this->contactGateway->update($aContact->getId(), $aContact->toArray());

            return  [
                'message' => 'Contact updated successfully',
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