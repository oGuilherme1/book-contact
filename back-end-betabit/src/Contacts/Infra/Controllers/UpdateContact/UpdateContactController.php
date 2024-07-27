<?php

declare(strict_types=1);

namespace Src\Contacts\Infra\Controllers\UpdateContact;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Src\Contacts\Application\Commands\UpdateContact\UpdateContactCommandHandler;
use Src\Contacts\Infra\Requests\UpdateContact\UpdateContactRequest;
use Symfony\Component\HttpFoundation\Response;

class UpdateContactController extends Controller
{

    public function __construct(private UpdateContactCommandHandler $command)
    {
    }

    public function execute(UpdateContactRequest $request): JsonResponse
    {
        $updateContact = $this->command->handle($request->toCommand());
        
        if(!$updateContact['success']){
            return response()->json([
                'message' => $updateContact['message']
            ], Response::HTTP_BAD_REQUEST);
            
        }

        return response()->json([
            'message' => $updateContact['message']
        ], Response::HTTP_OK);
    }
}