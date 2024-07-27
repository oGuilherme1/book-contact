<?php

declare(strict_types=1);

namespace Src\Users\Domain;

interface UserGateway 
{
    public function get(string $document): array;
    public function save(array $data): void;
    public function findEmail(string $email): bool;
}