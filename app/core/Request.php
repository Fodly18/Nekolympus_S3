<?php

namespace Nekolympus\Project\core;

class Request
{
    public $data = [];
    public $errors = []; // Store errors here
    private $bearerToken; // To store the bearer token

    public function __construct()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_SERVER['CONTENT_TYPE']) && strpos($_SERVER['CONTENT_TYPE'], 'application/json') !== false) {
                $this->data = json_decode(file_get_contents('php://input'), true);
            } else {
                $this->data = $_POST;
            }
        }

        // Extract the bearer token from the Authorization header
        $this->bearerToken = $this->getBearerToken();
    }

    public function input($key = null)
    {
        if ($key) {
            return isset($this->data[$key]) ? $this->data[$key] : null;
        }
        return $this->data;
    }

    public function validate(array $rules)
    {
        $validation = new Validation();
        $isValid = $validation->validate($this->data, $rules);

        if (!$isValid) {
            $this->errors = $validation->errors(); // Store errors
            return false;
        }

        return true;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function getBearerToken()
    {
        $headers = apache_request_headers(); // Get all headers
        if (isset($headers['Authorization'])) {
            // Split the header into parts
            $parts = explode(' ', $headers['Authorization']);
            if (count($parts) === 2 && strtolower($parts[0]) === 'bearer') {
                return $parts[1]; // Return the token
            }
        }
        return null; // Return null if no bearer token is found
    }

    public function bearerToken()
    {
        return $this->bearerToken; // Return the stored bearer token
    }

}