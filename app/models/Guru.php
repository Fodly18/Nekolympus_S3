<?php

namespace Nekolympus\Project\models;

use Nekolympus\Project\core\Model;
use Nekolympus\Project\core\DB;

class Guru extends Model
{
    protected static $table = 'guru'; // Nama tabel di database
    protected static $guarded = ['id']; // Kolom yang tidak bisa diisi langsung

}
