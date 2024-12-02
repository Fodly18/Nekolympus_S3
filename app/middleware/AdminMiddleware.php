<?php

namespace Nekolympus\Project\middleware;

class AdminMiddleware
{
    public function handle()
    {
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
            header('Location: /');
            exit;
        }
    }
}