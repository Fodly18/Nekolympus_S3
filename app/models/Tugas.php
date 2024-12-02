<?php

namespace Nekolympus\Project\models;

use Nekolympus\Project\core\Model;

class Tugas extends Model
{
    protected static $table = 'tugas';
    protected static $guarded = ['id'];


    public static function getWithRelations()
    {
        $joins = [
            ['type' => 'inner', 'table' => 'mapel_kelas', 'on' => 'tugas.id_mapel_kelas = mapel_kelas.id'],
            ['type' => 'inner', 'table' => 'mapel', 'on' => 'mapel_kelas.id_mapel = mapel.id'],
            ['type' => 'inner', 'table' => 'kelas', 'on' => 'mapel_kelas.id_kelas = kelas.id']
        ];
        $columns = "tugas.id, mapel.nama_mapel, kelas.nama_kelas, tugas.judul_tugas, tugas.tanggal_tugas, tugas.deadline";
        return self::join($joins, $columns);
    }
}
