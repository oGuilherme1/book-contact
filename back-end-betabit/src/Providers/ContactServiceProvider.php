<?php

namespace Src\Providers;

use Google\Cloud\Storage\StorageClient;
use Illuminate\Support\ServiceProvider;
use Kreait\Firebase\Storage;
use Src\Contacts\Application\UseCases\CreateContact\CreateContactUseCase;
use Src\Contacts\Application\UseCases\DeleteContact\DeleteContactUseCase;
use Src\Contacts\Application\UseCases\GetContact\GetContactUseCase;
use Src\Contacts\Application\UseCases\Storage\DeleteImageStorageUseCase;
use Src\Contacts\Application\UseCases\Storage\StorageGateway;
use Src\Contacts\Application\UseCases\Storage\UploadImageStorageUseCase;
use Src\Contacts\Application\UseCases\UpdateContact\UpdateContactUseCase;
use Src\Contacts\Domain\ContactGateway;
use Src\Contacts\Infra\Repositories\ContactRepository;
use Src\Contacts\Infra\StorageService\Firebase\UploadImageFiribase;

class ContactServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(CreateContactUseCase::class, function ($app) {
            return CreateContactUseCase::create($app->make(ContactGateway::class), $app->make(UploadImageStorageUseCase::class));
        });
        
        $this->app->singleton(UpdateContactUseCase::class, function ($app) {
            return UpdateContactUseCase::create($app->make(ContactGateway::class), $app->make(UploadImageStorageUseCase::class));
        });

        $this->app->singleton(DeleteContactUseCase::class, function ($app) {
            return DeleteContactUseCase::create($app->make(ContactGateway::class), $app->make(DeleteImageStorageUseCase::class));
        });

        $this->app->singleton(GetContactUseCase::class, function ($app) {
            return GetContactUseCase::create($app->make(ContactGateway::class));
        });

        $this->app->singleton(ContactGateway::class, function () {
            return new ContactRepository();
        });

        $this->app->singleton(UploadImageStorageUseCase::class, function ($app) {
            return UploadImageStorageUseCase::create($app->make(StorageGateway::class));
        });

        $this->app->singleton(DeleteImageStorageUseCase::class, function ($app) {
            return DeleteImageStorageUseCase::create($app->make(StorageGateway::class));
        });

        $this->app->singleton(StorageGateway::class, function () {
            return new UploadImageFiribase(new Storage(new StorageClient()));
        });

    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
