<?php

namespace Nekolympus\Project\middleware;

use Nekolympus\Project\helpers\Redirect;

class GuruMiddleware
{
    public function handle()
    {
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'guru') {
            header('Location: /');
            exit;
        }
    }
}