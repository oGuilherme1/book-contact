<?php

declare(strict_types=1);

namespace Src\Contacts\Application\DTOs\UpdateContact;

use Illuminate\Http\UploadedFile;

class UpdateContactDto
{
    private function __construct(
        public readonly int $id,
        public readonly ?string $name,
        public readonly ?string $email,
        public readonly ?string $phone,
        public readonly ?UploadedFile $image
    ) {
    }

    public static function create(array $data): self
    {
        return new self(
            id: $data['id'],
            name: $data['name'],
            email: $data['email'],
            phone: $data['phone'],
            image: $data['image']
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'image' => $this->image
        ];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getImage(): ?UploadedFile
    {
        return $this->image;
    }

}