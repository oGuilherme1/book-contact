<?php

declare(strict_types=1);

namespace Src\Contacts\Application\DTOs\DeleteContact;

class DeleteContactDto
{

    private function __construct(
        public readonly int $id
    )
    {
    }

    public static function create(array $data): self
    {
        return new self(
            id: $data['id']
        );
    }

    public function getId(): int
    {
        return $this->id;
    }

    
}