<?php

namespace Nekolympus\Project\middleware;

use Nekolympus\Project\core\Request;

class ApiMiddleware
{
    public function handle($next)
    {
        $request = new Request();
        $token = $request->bearerToken();

        if (!$token || !$this->validateToken($token)) {
            header('Content-Type: application/json');
            http_response_code(401);
            echo json_encode([
                'status' => 'error',
                'message' => 'Unauthenticated.'
            ]);
            exit;
        }

        // Lanjutkan ke middleware atau controller berikutnya
        return $next();
    }

    private function validateToken($token)
    {
        // Contoh validasi token di database
        $user = \Nekolympus\Project\models\Siswa::where('token', '=', $token)->first();
        return $user !== null;
    }
}
