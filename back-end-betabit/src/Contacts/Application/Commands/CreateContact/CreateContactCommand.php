<?php

declare(strict_types=1);

namespace Src\Contacts\Application\Commands\CreateContact;

use Illuminate\Http\UploadedFile;
use Src\Contacts\Application\Commands\Command;

class CreateContactCommand extends Command
{
    public function __construct(
        public readonly ?int $id,
        public readonly int $idUser,
        public readonly string $name,
        public readonly string $email,
        public readonly string $phone,
        public readonly UploadedFile $image
    )
    {
    }
}