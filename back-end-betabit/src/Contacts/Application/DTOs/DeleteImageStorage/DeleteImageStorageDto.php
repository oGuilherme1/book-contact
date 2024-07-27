<?php

declare(strict_types=1);

namespace Src\Contacts\Application\DTOs\DeleteImageStorage;


class DeleteImageStorageDto
{
    private function __construct(
        public readonly string $image,
    )
    {
    }

    public static function create(string $image): self
    {
        return new self($image);
    }

    public function getImage(): string
    {
        return $this->image;
    }

}