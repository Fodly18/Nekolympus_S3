<?php

namespace Nekolympus\Project\controllers\Api;

use Nekolympus\Project\core\Controller;
use Nekolympus\Project\core\DB;
use Nekolympus\Project\core\Request;
use Nekolympus\Project\models\Siswa;

class HomeController extends Controller
{
    public function getJadwal()
    {
        $token = (new Request)->bearerToken();

        $user = Siswa::where('token', '=', $token)->first();

        if(!$user){
            return $this->json([
                'status' => 'errors',
                'message' => 'Unauthenticated.'
            ], 401);
        }

        $jadwal = DB::table('siswa')
                    ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id')
                    ->join('jadwal', 'kelas.id', '=', 'jadwal.id_kelas')
                    ->join('mapel', 'jadwal.id_kelas', '=', 'mapel.id')
                    ->where('siswa.id', '=', $user->id)
                    ->select(['jadwal.id', 'mapel.nama', 'jadwal.hari', 'jadwal.jam_mulai', 'jadwal.jam_selesai'])
                    ->get();

        return $this->json([
            'status' => 'success',
            'data' => $jadwal
        ]);
    }

    public function getWaliKelas()
    {
        $token = (new Request)->bearerToken();

        $user = Siswa::where('token', '=', $token)->first();

        if(!$user){
            return $this->json([
                'status' => 'errors',
                'message' => 'Unauthenticated.'
            ], 401);
        }

        $walikelas = DB::table('siswa')
                        ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id')
                        ->join('guru', 'kelas.id_guru', '=', 'guru.id')
                        ->where('siswa.id', '=', $user->id)
                        ->select(['guru.nama'])
                        ->first();

        return $this->json([
            'status' => 'success',
            'data' => $walikelas
        ]);
    }
}