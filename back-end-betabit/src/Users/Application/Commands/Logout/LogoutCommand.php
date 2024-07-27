<?php

declare(strict_types=1);

namespace Src\Users\Application\Commands\Logout;

use Src\Users\Application\Commands\Command;
use Illuminate\Http\Request;

class LogoutCommand extends Command
{
    public function __construct(
        public readonly Request $request,
    ) {
    }
}