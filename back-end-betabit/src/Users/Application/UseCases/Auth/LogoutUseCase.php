<?php 

declare(strict_types=1);

namespace Src\Users\Application\UseCases\Auth;

use Exception;
use Illuminate\Support\Facades\Log;
use Src\Users\Application\DTOs\Logout\LogoutDto;

class LogoutUseCase
{
    private function __construct(private readonly LoginGateway $logoutGateway)
    {
        
    }

    public static function create(LoginGateway $logoutGateway): self
    {
        return new self($logoutGateway);
    }

    public function execute(LogoutDto $inputDTO): array
    {
        try{
            $logout = $this->logoutGateway->logout($inputDTO->getRequest());
            return [
                'message' => $logout->original["message"],
                'status' => true
            ];
        }
        catch (Exception $e) {
           
            return  [
                'error' => $e->getMessage(),
                'status' => false
            ];
        }
    }
}