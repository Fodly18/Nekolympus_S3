<?php

namespace Nekolympus\Project\controllers\Web;

use Nekolympus\Project\core\Controller;
use Nekolympus\Project\core\DB;
use Nekolympus\Project\core\Request;
use Nekolympus\Project\helpers\Redirect;
use Nekolympus\Project\models\DetailSoal;
use Nekolympus\Project\models\LatihanSoal;

class LatihanController extends Controller
{
    public function createIndex()
    {
        $idGuru = $_SESSION['auth'];
        $data = DB::table('mapel_kelas')
            ->join('kelas', 'mapel_kelas.id_kelas', '=', 'kelas.id')
            ->join('mapel', 'mapel_kelas.id_mapel', '=', 'mapel.id')
            ->select(['mapel_kelas.id', 'kelas.kelas', 'mapel.nama'])
            ->where('mapel_kelas.id_guru', '=', $idGuru)
            ->get();

        return $this->view('guru.latihan-soal.create', ['data' => $data]);
    }

    public function create(Request $request)
    {
        $latSoal = LatihanSoal::create([
            'id_mapel_kelas' => $request->input('kelas'),
            'judul_soal' => $request->input('judul_tugas'),
            'jumlah_soal' => $request->input('jumlah_soal'),
            'tanggal_soal' => $request->input('tanggal_soal'),
            'deadline' => $request->input('tgl_deadline')
        ]);

        for ($i = 0; $i < $request->input('jumlah_soal'); $i++) {
            DetailSoal::create([
                'id_latihan_soal' => $latSoal,
                'soal' => $request->input("soal_$i"),
                'a' => $request->input("jawaban_a_$i"),
                'b' => $request->input("jawaban_b_$i"),
                'c' => $request->input("jawaban_c_$i"),
                'd' => $request->input("jawaban_d_$i"),
                'jawaban' => $request->input("jawaban_benar_$i"),
                'bobot_nilai' => $request->input("bobot_nilai_$i")
            ]);
        }

        return $this->redirect('/latihan-soal');
    }

    public function updateIndex($id)
    {
        $idGuru = $_SESSION['auth'];
        $kelas = DB::table('mapel_kelas')
            ->join('kelas', 'mapel_kelas.id_kelas', '=', 'kelas.id')
            ->join('mapel', 'mapel_kelas.id_mapel', '=', 'mapel.id')
            ->select(['mapel_kelas.id', 'kelas.kelas', 'mapel.nama'])
            ->where('mapel_kelas.id_guru', '=', $idGuru)
            ->get();

        $data = DB::table('latihan_soal')
            ->join('mapel_kelas', 'latihan_soal.id_mapel_kelas', '=', 'mapel_kelas.id')
            ->join('mapel', 'mapel_kelas.id_mapel', '=', 'mapel.id')
            ->join('kelas', 'mapel_kelas.id_kelas', '=', 'kelas.id')
            ->select(['latihan_soal.id', 'mapel.nama', 'mapel_kelas.id_kelas as awok', 'latihan_soal.judul_soal', 'latihan_soal.tanggal_soal', 'latihan_soal.deadline'])
            ->where('latihan_soal.id', '=', $id)
            ->first();

        return $this->view('guru.latihan-soal.update', ['data' => $data, 'kls' => $kelas]);
    }

    public function update(Request $request)
    {
        $latSoal = LatihanSoal::update($request->input('id'), [
            'judul_soal' => $request->input('judul_soal'),
            'tanggal_soal' => $request->input('tanggal_soal'),
            'deadline' => $request->input('tgl_deadline')
        ]);

        return $this->redirect('/latihan-soal');
    }


    public function delete($id)
    {
        LatihanSoal::delete($id);
            
        return $this->redirect('/latihan-soal');
    }
}
