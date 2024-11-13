<?php

namespace Nekolympus\Project\middleware;

use Nekolympus\Project\helpers\Redirect;

class AuthMiddleware
{
    public function handle()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /' );
            exit;
        }
    }
}