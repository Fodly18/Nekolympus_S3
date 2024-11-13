<?php

namespace Nekolympus\Project\models;

use Nekolympus\Project\core\Model;

class Admin extends Model
{
    protected static $table = 'admin';
    protected static $guarded = ['id'];
}