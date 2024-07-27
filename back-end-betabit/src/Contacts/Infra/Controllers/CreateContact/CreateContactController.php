<?php

declare(strict_types=1);

namespace Src\Contacts\Infra\Controllers\CreateContact;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Src\Contacts\Application\Commands\CreateContact\CreateContactCommandHandler;
use Src\Contacts\Infra\Requests\CreateContact\CreateContactRequest;
use Symfony\Component\HttpFoundation\Response;

class CreateContactController extends Controller
{

    public function __construct(private CreateContactCommandHandler $command)
    {
    }

    public function execute(CreateContactRequest $request): JsonResponse
    {
        $createContact = $this->command->handle($request->toCommand());
        
        if(!$createContact['success']){
            return response()->json([
                'message' => $createContact['message']
            ], Response::HTTP_BAD_REQUEST);
            
        }

        return response()->json([
            'message' => $createContact['message']
        ], Response::HTTP_OK);
    }
}