<?php

declare(strict_types=1);

namespace Src\Users\Application\DTOs\Logout;

use Illuminate\Http\Request;

class LogoutDto 
{
    private function __construct(
        private readonly Request $request,
    )
    {
        
    }

    public static function create(Request $request): self
    {
        return new self(
            request: $request,
        );
    }

    public function getRequest() 
    {
        return $this->request;
    }

}