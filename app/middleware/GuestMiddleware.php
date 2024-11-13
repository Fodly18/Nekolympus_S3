<?php

namespace Nekolympus\Project\middleware;

use Nekolympus\Project\helpers\Redirect;

class GuestMiddleware
{
    public function handle()
    {
        if (isset($_SESSION['user'])) {
            if($_SESSION['user_role'] == 'admin'){
                header('Location: /dashboard-admin');
                exit;
            }else if($_SESSION['user_role'] == 'guru'){
                header('Location: /dashboard-guru');
                exit;
            }
        }
    }
}