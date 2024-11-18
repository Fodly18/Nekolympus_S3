<?php

namespace Nekolympus\Project\core;

use Nekolympus\Project\databases\Database;

class DB
{
    public static function table($table)
    {
        return new QueryBuilder((new Database())->getConnection(), $table);
    }
}