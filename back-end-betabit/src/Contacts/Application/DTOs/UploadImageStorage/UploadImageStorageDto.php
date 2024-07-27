<?php

declare(strict_types=1);

namespace Src\Contacts\Application\DTOs\UploadImageStorage;

use Illuminate\Http\UploadedFile;

class UploadImageStorageDto
{
    private function __construct(
        public readonly UploadedFile $image,
        public readonly ?string $oldImageUrl
    )
    {
    }

    public static function create(UploadedFile $image, ?string $oldImageUrl): self
    {
        return new self($image, $oldImageUrl);
    }

    public function getImage(): UploadedFile
    {
        return $this->image;
    }

    public function getOldImageUrl(): ?string
    {
        return $this->oldImageUrl;
    }
}