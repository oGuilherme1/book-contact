<?php

declare(strict_types=1);

namespace Src\Contacts\Infra\Controllers\GetContact;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Src\Contacts\Application\Queries\GetContact\GetContactQuery;
use Src\Contacts\Application\Queries\GetContact\GetContactQueryHandler;
use Symfony\Component\HttpFoundation\Response;

class GetContactController extends Controller
{

    public function __construct(private GetContactQueryHandler $command)
    {
    }

    public function execute(Request $request): JsonResponse
    {
        $id = $request->route('id');
        $command = new GetContactQuery($id, $request->user()->id);

        $deleteContact = $this->command->handle($command);

        if(!$deleteContact['success']){
            return response()->json([
                'message' => $deleteContact['message']
            ], Response::HTTP_BAD_REQUEST);
            
        }

        return response()->json([
            'data' => $deleteContact['data']
        ], Response::HTTP_OK);
    }
}