<?php

namespace Nekolympus\Project\controllers\Api;

use Nekolympus\Project\core\Controller;
use Nekolympus\Project\core\DB;
use Nekolympus\Project\core\Request;
use Nekolympus\Project\models\Siswa;

class TugasController extends Controller
{
    public function getMapelKelas(Request $request)
    {
        $token = $request->bearerToken();

        $user = Siswa::where('token', '=', $token)->first();

        if(!$user){
            return $this->json([
                'status' => 'errors',
                'message' => 'Unauthenticated.'
            ], 401);
        }

        $mapelKelas = DB::table('siswa')
                        ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id')
                        ->join('mapel_kelas', 'kelas.id', '=', 'mapel_kelas.id_kelas')
                        ->join('mapel', 'mapel_kelas.id_mapel', '=', 'mapel.id')
                        ->join('guru', 'mapel_kelas.id_guru', '=', 'guru.id')
                        ->where('siswa.id', '=', $user->id)
                        ->select(['mapel_kelas.id', 'mapel.nama as nama_mapel', 'guru.nama as nama_guru'])
                        ->get();
        
        return $this->json([
            'status' => 'success',
            'data' => $mapelKelas
        ]);
    }
}