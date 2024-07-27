<?php

declare(strict_types=1);

namespace Src\Contacts\Infra\StorageService\Firebase;

use Kreait\Firebase\Exception\FirebaseException;
use Src\Contacts\Application\UseCases\Storage\StorageGateway;

class UploadImageFiribase implements StorageGateway
{
    private $storage;
    private $storagePath = 'images/';
    public function __construct()
    {
        $firebase = app('firebase.storage');
        $this->storage = $firebase->getBucket();
    }
    public function uploadImage(object $image, ?string $oldImageUrl = null): string
    {
        try {
            if ($oldImageUrl) {
                $this->deleteImage($oldImageUrl);
            }

            $uniqueId = uniqid('', true);
            $filename = $uniqueId . '_' . $image->getClientOriginalName();

            $upload = $this->storage->upload(
                fopen($image->getRealPath(), 'r'),
                [
                    'predefinedAcl' => 'publicRead',
                    'name' => $this->storagePath . $filename,
                ]
            );

            $publicUrl = 'https://storage.googleapis.com/' . $this->storage->name() . '/' . $this->storagePath . rawurlencode($filename);
            
            return $publicUrl;

        } catch (FirebaseException $e) {

            throw new \Exception("Failed to upload image: " . $e->getMessage());
        }
    }

    public function deleteImage(string $oldImageUrl): void
    {
        try {
            // Extrair o nome do arquivo da URL
            $filename = $this->extractFilenameFromUrl($oldImageUrl);

            // Excluir o arquivo do bucket
            $object = $this->storage->object($this->storagePath . $filename);
            $object->delete();

        } catch (FirebaseException $e) {
            throw new \Exception("Failed to delete old image: " . $e->getMessage());
        }
    }

    private function extractFilenameFromUrl(string $url): string
    {
        // A URL deve ser convertida para obter o nome do arquivo
        $parsedUrl = parse_url($url);
        $path = $parsedUrl['path'] ?? '';

        // Remover o prefixo do caminho do storage
        return basename($path);
    }
}
