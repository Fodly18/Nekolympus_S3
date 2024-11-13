<?php

namespace Nekolympus\Project\helpers;

class Redirect
{
    public static function back($defaultUrl = '/')
    {
        // Memeriksa apakah ada referer
        if (isset($_SERVER['HTTP_REFERER'])) {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {
            // Jika tidak ada referer, redirect ke URL default
            header('Location: ' . $defaultUrl);
        }
        exit;
    }
}