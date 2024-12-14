<?php

namespace Nekolympus\Project\controllers\Web;

use Nekolympus\Project\core\Controller;
use Nekolympus\Project\core\DB;
use Nekolympus\Project\core\Request;
use Nekolympus\Project\models\LatihanSoal;
use Nekolympus\Project\models\PengumpulanTugas;
use Nekolympus\Project\models\Tugas;

class DashboardController extends Controller
{
    public function indexAdmin()
    {
        return $this->view('admin.index');
    }

    //Ini Punya Guru
    public function indexGuru()
    {
        return $this->view('guru.index');
    }

    public function tugasGuru()
    {
        $idGuru = $_SESSION['auth'];
        $data = DB::table('tugas')
            ->join('mapel_kelas', 'tugas.id_mapel_kelas', '=', 'mapel_kelas.id')
            ->join('kelas', 'mapel_kelas.id_kelas', '=', 'kelas.id')
            ->join('mapel', 'mapel_kelas.id_mapel', '=', 'mapel.id')
            ->select(['tugas.id', 'mapel.nama', 'kelas.kelas', 'tugas.judul_tugas', 'tugas.deskripsi', 'tugas.tanggal_tugas', 'tugas.deadline'])
            ->where('mapel_kelas.id_guru', '=', $idGuru)
            ->get();
        $no = 1;
        return $this->view('guru.tugas.index', ['data' => $data, 'no' => $no]);
    }

    public function latsolGuru()
    {
        $data = LatihanSoal::all();
        $no = 1;
        return $this->view('guru.latihan-soal.index', ['data' => $data, 'no' => $no]);
    }

    public function submitTugas()
    {
        $idGuru = $_SESSION['auth'];
        $tugas = DB::table('tugas')
            ->join('mapel_kelas', 'tugas.id_mapel_kelas', '=', 'mapel_kelas.id')
            ->select(['tugas.id', 'tugas.judul_tugas'])
            ->where('mapel_kelas.id_guru', '=', $idGuru)
            ->get();
        $no = 1;
        return $this->view('guru.pengumpulan-tugas.index', ['data' => $tugas, 'no' => $no]);
    }

    public function submitTugasFilter(Request $request)
    {
        $idGuru = $_SESSION['auth'];
        $tugas = DB::table('tugas')
            ->join('mapel_kelas', 'tugas.id_mapel_kelas', '=', 'mapel_kelas.id')
            ->select(['tugas.id', 'tugas.judul_tugas'])
            ->where('mapel_kelas.id_guru', '=', $idGuru)
            ->get();
        $no = 1;

        $data = DB::table('pengumpulan_tugas')
            ->join('siswa', 'pengumpulan_tugas.id_siswa', '=', 'siswa.id')
            ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id')
            ->select(['pengumpulan_tugas.id', 'siswa.nama', 'kelas.kelas', 'pengumpulan_tugas.tanggal', 'pengumpulan_tugas.grade'])
            ->where('pengumpulan_tugas.id_tugas', '=', $request->input('filter'))
            ->get();
        return $this->view('guru.pengumpulan-tugas.index', ['data' => $tugas, 'no' => $no, 'dataTugas' => $data]);
    }

    public function nilaiTugas($id)
    {
        $tugas = DB::table('pengumpulan_tugas')
            ->join('siswa', 'pengumpulan_tugas.id_siswa', '=', 'siswa.id')
            ->select(['pengumpulan_tugas.id', 'siswa.nisn', 'siswa.nama', 'pengumpulan_tugas.foto'])
            ->where('pengumpulan_tugas.id', '=', $id)
            ->first();

        return $this->view('guru.pengumpulan-tugas.penilaian', ['data' => $tugas]);
    }

    public function submitNilaiTugas(Request $request)
    {
        PengumpulanTugas::update($request->input('id'), [
            'grade' => $request->input('grade')
        ]);

        return $this->redirect('/pengumpulan-tugas');
    }

    public function penilaian()
    {
        $idGuru = $_SESSION['auth'];
        $latihan = DB::table('latihan_soal')
            ->join('mapel_kelas', 'latihan_soal.id_mapel_kelas', '=', 'mapel_kelas.id')
            ->select(['latihan_soal.id', 'latihan_soal.judul_soal'])
            ->where('mapel_kelas.id_guru', '=', $idGuru)
            ->get();
        $no = 1;
        return $this->view('guru.penilaian.index', ['data' => $latihan, 'no' => $no]);
    }

    public function penilaianFilter(Request $request)
    {
        $idGuru = $_SESSION['auth'];

        $latihan = DB::table('latihan_soal')
            ->join('mapel_kelas', 'latihan_soal.id_mapel_kelas', '=', 'mapel_kelas.id')
            ->select(['latihan_soal.id', 'latihan_soal.judul_soal'])
            ->where('mapel_kelas.id_guru', '=', $idGuru)
            ->get();

        $no = 1;

        $data = DB::table('penilaian_soal')
            ->join('detail_soal', 'penilaian_soal.id_detail_soal', '=', 'detail_soal.id')
            ->join('latihan_soal', 'detail_soal.id_latihan_soal', '=', 'latihan_soal.id')
            ->join('siswa', 'penilaian_soal.id_siswa', '=', 'siswa.id')
            ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id')
            ->select(['siswa.nama', 'kelas.kelas'])
            ->addSelect('SUM(penilaian_soal.nilai) AS total_nilai')
            ->where('latihan_soal.id', '=', $request->input('filter-nilai')) // Filter by latihan_soal ID
            ->groupBy(['siswa.nama', 'kelas.kelas']) 
            ->get();


        return $this->view('guru.penilaian.index', ['data' => $latihan, 'no' => $no, 'dataLatihan' => $data]);
    }

    public function settingGuru()
    {
        return $this->view('guru.settings.index');
    }

    public function logoutGuru()
    {
        return $this->view('guru.logout');
    }
}
