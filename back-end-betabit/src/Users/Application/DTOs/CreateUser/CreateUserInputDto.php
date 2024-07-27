<?php

declare(strict_types=1);

namespace Src\Users\Application\DTOs\CreateUser;

use Src\Users\Enums\DocumentTypeEnum;
use Src\Users\Enums\UserTypeEnum;

class CreateUserInputDto 
{
    private function __construct(
        private readonly string $name,
        private readonly string $email,
        private readonly string $password
    )
    {
        
    }

    public static function create(array $data): self
    {
        return new self(
            name: $data['name'],
            email: $data['email'],
            password: $data['password']
        );
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
    public function getAll(): array
    {
        return get_object_vars($this);
    }
}