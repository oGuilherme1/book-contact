<?php

declare(strict_types=1);

namespace Src\Contacts\Infra\Controllers\DeleteContact;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Src\Contacts\Application\Commands\DeleteContact\DeleteContactCommand;
use Src\Contacts\Application\Commands\DeleteContact\DeleteContactCommandHandler;
use Symfony\Component\HttpFoundation\Response;

class DeleteContactController extends Controller
{

    public function __construct(private DeleteContactCommandHandler $command)
    {
    }

    public function execute(Request $request): JsonResponse
    {            
        $command = new DeleteContactCommand( (int) $request->route('id') );

        $deleteContact = $this->command->handle($command);
        
        if(!$deleteContact['success']){
            return response()->json([
                'message' => $deleteContact['message']
            ], Response::HTTP_BAD_REQUEST);
            
        }

        return response()->json([
            'message' => $deleteContact['message']
        ], Response::HTTP_OK);
    }
}