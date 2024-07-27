<?php

declare(strict_types=1);

namespace Src\Contacts\Domain;

class Contact 
{
    private function __construct(
        private readonly ?int $id,
        private int $idUser,
        private string $name,
        private string $email,
        private string $phone,
        private string $imageURL
    )
    {
        
    }

    public static function create(?int $id, int $idUser, string $name, string $email, string $phone, string $imageURL): self
    {
        return new self(
            id: $id,
            idUser: $idUser,
            name: $name,
            email: $email,
            phone: $phone,
            imageURL: $imageURL
        );
    }

    public function toArray(): array 
    {
        return [
            'idUser' => $this->idUser,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'imageURL' => $this->imageURL
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            idUser: $data['idUser'],
            name: $data['name'],
            email: $data['email'],
            phone: $data['phone'],
            imageURL: $data['imageURL']
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

    public function getImageURL(): string
    {
        return $this->imageURL;
    }

    public function setName(?string $name): void
    {
        if($name !== null){
            $this->name = $name;
        }
    }

    public function setEmail(?string $email): void
    {
        if($email !== null){
            $this->email = $email;
        }
    }

    public function setPhone(?string $phone): void
    {
        if($phone !== null){
            $this->phone = $phone;
        }
    }

    public function setImageURL(?string $imageURL): void
    {
        if($imageURL !== null){
            $this->imageURL = $imageURL;
        }
    }

    public function setIdUser(int $idUser): void
    {
        $this->idUser = $idUser;
    }
}