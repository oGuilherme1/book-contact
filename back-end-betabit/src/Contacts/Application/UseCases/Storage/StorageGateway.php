<?php

declare(strict_types=1);

namespace Src\Contacts\Application\UseCases\Storage;


interface StorageGateway
{
    public function uploadImage(object $image): string;
    public function deleteImage(string $image): void;

}