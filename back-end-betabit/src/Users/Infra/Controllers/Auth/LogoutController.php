<?php

namespace Src\Users\Infra\Controllers\Auth;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Src\Users\Application\Commands\Logout\LogoutCommandHandler;
use Symfony\Component\HttpFoundation\Response;
use Src\Users\Infra\Controllers\Controller;
use Src\Users\Infra\Requests\Auth\LogoutRequest;

class LogoutController extends Controller
{
    public function __construct(private LogoutCommandHandler $commandHandler)
    {
    }

    public function execute(LogoutRequest $request): JsonResponse
    {
        $logout = $this->commandHandler->handle($request->toCommand());

        if(!$logout['status']){
            return response()->json([
                'error' => $logout['error']
            ], Response::HTTP_BAD_REQUEST);
        }

        return response()->json([
            'message' => $logout['message']
        ], Response::HTTP_OK);
    }
}
