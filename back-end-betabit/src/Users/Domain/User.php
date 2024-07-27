<?php

declare(strict_types=1);

namespace Src\Users\Domain;

class User 
{
    private function __construct(
        private readonly ?int $id,
        private readonly string $name,
        private readonly string $email,
        private readonly string $password
    )
    {
        
    }

    public static function create(?int $id, string $name, string $email, string $password): self
    {
        return new self(
            id: $id,
            name: $name,
            email: $email,
            password: $password
        );
    }

    public function toArray(): array 
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'],
            name: $data['name'],
            email: $data['email'],
            password: $data['password']
        );
    }
}