<?php 

declare(strict_types=1);

namespace Src\Users\Infra\Repositories;

use Src\Users\Domain\UserGateway;
use Src\Users\Infra\Models\User;

class UserRepository implements UserGateway
{
    public function get(string $document): array
    {
        $idUser = User::select('id')->where('document', $document); 

        return User::find($idUser)->toArray();
    
    }

    public function save(array $data): void
    {
        User::create($data);
    }

    public function findEmail(string $email): bool
    {
        return User::where('email', $email)->exists();
    }

}