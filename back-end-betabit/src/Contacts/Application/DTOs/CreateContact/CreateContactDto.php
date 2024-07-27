<?php

declare(strict_types=1);

namespace Src\Contacts\Application\DTOs\CreateContact;

use Illuminate\Http\UploadedFile;

class CreateContactDto
{
    public function __construct(
        private readonly ?int $id,
        public readonly int $idUser,
        public readonly string $name,
        public readonly string $email,
        public readonly string $phone,
        public readonly UploadedFile $image
    )
    {
    }

    public static function create(array $data): self
    {
        return new self(
            id: $data['id'],
            idUser: $data['idUser'],
            name: $data['name'],
            email: $data['email'],
            phone: $data['phone'],
            image: $data['image']
        );
    }
    
    public function getId(): ?int 
    {
        return $this->id;
    }

    public function getIdUser(): int
    {
        return $this->idUser;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getImage(): UploadedFile
    {
        return $this->image;
    }

    public function getAll(): array
    {
        return get_object_vars($this);
    }
}