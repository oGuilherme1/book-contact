<?php

declare(strict_types=1);

namespace Src\Contacts\Application\DTOs\GetContact;

class GetContactDto
{
    private function __construct(
        public ?int $id,
        public int $idUser
    )
    {
    }

    public static function create(?int $id = null, int $idUser): self
    {
        return new self($id, $idUser);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUser(): int
    {
        return $this->idUser;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'id_user' => $this->idUser
        ];
    }
}