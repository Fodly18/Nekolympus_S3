<?php

namespace Nekolympus\Project\models;

use Nekolympus\Project\core\Model;
use Nekolympus\Project\core\DB;

class Kelas extends Model
{
    protected static $table = 'kelas'; // Nama tabel di database
    protected static $guarded = ['id']; // Kolom yang tidak bisa diisi langsung

}
