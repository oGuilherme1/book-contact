<?php

declare(strict_types=1);

namespace Src\Contacts\Application\UseCases\GetContact;

use Exception;
use Src\Contacts\Application\DTOs\GetContact\GetContactDto;
use Src\Contacts\Domain\ContactGateway;

class GetContactUseCase
{

    private function __construct(private readonly ContactGateway $contactGateway)
    {
    }

    public static function create(ContactGateway $contactGateway): self
    {
        return new self($contactGateway);
    }

    public function execute(GetContactDto $inputDTO): array
    {
        try {
            $contacts = $this->contactGateway->getAll($inputDTO->idUser);
            return [
                'data' => $contacts,
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
