<?php

namespace Nekolympus\Project\core;

class ResultSet
{
    protected $results;

    public function __construct($results)
    {
        $this->results = $results;
    }

    public function first()
    {
        return !empty($this->results) ? (object) $this->results[0] : null;
    }

    public function get()
    {
        return array_map(function ($item) {
            return (object) $item; // Mengubah setiap item menjadi objek
        }, $this->results);
    }
}