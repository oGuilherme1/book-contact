<?php

declare(strict_types=1);

namespace Src\Contacts\Application\Commands\UpdateContact;

use Illuminate\Http\UploadedFile;
use Src\Contacts\Application\Commands\Command;

class UpdateContactCommand extends Command
{
    public function __construct(
        public readonly int $id,
        public readonly ?string $name,
        public readonly ?string $email,
        public readonly ?string $phone,
        public readonly ?UploadedFile $image
    )
    {
    }
}