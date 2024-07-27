<?php

declare(strict_types=1);

namespace Src\Contacts\Domain;

interface ContactGateway 
{
    public function save(array $data): void;
    public function update(int $id, array $data): void;
    public function get(int $id): array;
    public function getAll(int $idUSer): array;
    public function delete(int $id): void;
    public function findEmail(string $email): bool;
    
}