<?php

namespace Nekolympus\Project\core;

class Helper
{
    /**
     * Mengenkripsi password menggunakan bcrypt.
     *
     * @param string $password
     * @return string
     */
    public static function bcryptEncrypt($password)
    {
        // Encrypt password using bcrypt
        return password_hash($password, PASSWORD_BCRYPT);
    }

    /**
     * Memverifikasi password dengan bcrypt.
     *
     * @param string $password
     * @param string $hashedPassword
     * @return bool
     */
    public static function bcryptVerify($password, $hashedPassword)
    {
        if (is_null($hashedPassword)) {
            return false;
        }
        // Verify the password using bcrypt
        return password_verify($password, $hashedPassword);
    }
}
