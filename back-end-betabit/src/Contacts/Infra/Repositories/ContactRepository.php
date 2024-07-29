<?php 

declare(strict_types=1);

namespace Src\Contacts\Infra\Repositories;

use Illuminate\Support\Facades\Log;
use Src\Contacts\Domain\ContactGateway;
use Src\Contacts\Infra\Models\Contact;

class ContactRepository implements ContactGateway
{
    public function save(array $data): void
    {
        Contact::create($data);

        Log::info('Contact saved:', $data);
    }

    public function update(int $id, array $data): void
    {
        $contact = Contact::find($id);
        if ($contact) {
            $contact->update($data);
            Log::info('Contact updated:', ['id' => $id, 'data' => $data]);
        }
    }

    public function get(int $id): array
    {
        $contact = Contact::find($id);

        if ($contact) {
            Log::info('Contact fetched:', ['contact' => $contact->toArray()]);
            return $contact->toArray();
        }

        return [];
    }

    public function delete(int $id): void
    {
        $contact = Contact::find($id);
        if ($contact) {
            $contact->delete();
            Log::info('Contact deleted:', ['id' => $id]);
        }
    }

    public function findEmail(string $email, int $idUser): bool
    {
        $exists = Contact::where([
            ['idUser', '=', $idUser],
            ['email', '=', $email] 
        ])->exists();

        Log::info('Email checked:', ['email' => $email, 'exists' => $exists]);
        return $exists;
    }

    public function getAll(int $idUser): array
    {
        $contacts = Contact::where('idUser', $idUser)->get();
        Log::info('Contacts fetched:', ['contacts' => $contacts->toArray()]);
        return $contacts->toArray();
    }
}