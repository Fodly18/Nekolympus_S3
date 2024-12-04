<?php

namespace Nekolympus\Project\controllers\Api;

use DateTime;
use Nekolympus\Project\core\Controller;
use Nekolympus\Project\core\DB;
use Nekolympus\Project\core\Request;
use Nekolympus\Project\models\DetailSoal;
use Nekolympus\Project\models\PengumpulanTugas;
use Nekolympus\Project\models\PenilaianSoal;
use Nekolympus\Project\models\Siswa;

class TugasController extends Controller
{
    public function getMapelKelas()
    {
        $token = (new Request)->bearerToken();

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

    public function getTugas($id)
    {
        $token = (new Request)->bearerToken();

        $user = Siswa::where('token', '=', $token)->first();

        if(!$user){
            return $this->json([
                'status' => 'errors',
                'message' => 'Unauthenticated.'
            ], 401);
        }

        $tugas = DB::table('tugas')
                    ->where('id_mapel_kelas', '=', $id)
                    ->select(['id', 'judul_tugas', 'tanggal_tugas', 'deadline'])
                    ->get();

        return $this->json([
            'status' => 'success',
            'data' => $tugas
        ]);
    }

    public function getDetailTugas($id)
    {
        $token = (new Request)->bearerToken();

        $user = Siswa::where('token', '=', $token)->first();

        if(!$user){
            return $this->json([
                'status' => 'errors',
                'message' => 'Unauthenticated.'
            ], 401);
        }

        $tugas = DB::table('tugas')
                    ->where('id', '=', $id)
                    ->select(['id', 'judul_tugas', 'deskripsi', 'tanggal_tugas', 'deadline'])
                    ->get();

        return $this->json([
            'status' => 'success',
            'data' => $tugas
        ]);
    }

    public function SubmitTugas(Request $request)
    {
        $token = $request->bearerToken();

        $user = Siswa::where('token', '=', $token)->first();

        if(!$user){
            return $this->json([
                'status' => 'errors',
                'message' => 'Unauthenticated.'
            ], 401);
        }

        if(!$request->validate([
            'id_tugas' => 'required',
            'foto' => 'required'
        ])) {
            return $this->json([
                'status' => 'errors',
                'message' => 'validation error',
                'data' => $request->getErrors()
            ]);
        }

        $tugas = DB::table('pengumpulan_tugas')
                ->where('id_tugas', '=', $request->input('id_tugas'))
                ->where('id_siswa', '=', $user->id)
                ->select(['id'])
                ->first();
        $dateTime = new DateTime();
        if(!$tugas) {
            PengumpulanTugas::create([
                'id_tugas' => $request->input('id_tugas'),
                'id_siswa' => $user->id,
                'foto' => $request->input('foto'),
                'tanggal' => $dateTime->format('Y-m-d H:i:s')
            ]);
        }else{
            PengumpulanTugas::update($tugas['id'], [
                'foto' => $request->input('foto'),
                'tanggal' => $dateTime->format('Y-m-d H:i:s')
            ]);
        }

        return $this->json([
            'status' => 'success',
            'message' => 'Tugas berhasil di submit'
        ]);
    }

    public function getNilaiTugas($id)
    {
        $token = (new Request)->bearerToken();

        $user = Siswa::where('token', '=', $token)->first();

        if(!$user){
            return $this->json([
                'status' => 'errors',
                'message' => 'Unauthenticated.'
            ], 401);
        }

        $nilai = DB::table('pengumpulan_tugas')
                    ->select(['foto','grade', 'tanggal'])
                    ->where('id_tugas', '=', $id)
                    ->where('id_siswa', '=', $user->id)
                    ->first();

        return $this->json([
            'status' => 'success',
            'data' => $nilai
        ]);
    }

    public function getLatihanSoal($id)
    {
        $token = (new Request)->bearerToken();

        $user = Siswa::where('token', '=', $token)->first();

        if(!$user){
            return $this->json([
                'status' => 'errors',
                'message' => 'Unauthenticated.'
            ], 401);
        }

        $tugas = DB::table('latihan_soal')
                    ->where('id_mapel_kelas', '=', $id)
                    ->select(['id', 'judul_soal', 'tanggal_soal', 'deadline'])
                    ->get();

        return $this->json([
            'status' => 'success',
            'data' => $tugas
        ]);
    }

    public function getDetailLatihanSoal($id)
    {
        $token = (new Request)->bearerToken();

        $user = Siswa::where('token', '=', $token)->first();

        if(!$user){
            return $this->json([
                'status' => 'errors',
                'message' => 'Unauthenticated.'
            ], 401);
        }

        $tugas = DB::table('latihan_soal')
                    ->where('id', '=', $id)
                    ->select(['id', 'judul_soal', 'jumlah_soal', 'tanggal_soal', 'deadline'])
                    ->get();

        return $this->json([
            'status' => 'success',
            'data' => $tugas
        ]);
    }

    public function LatihanSoal($id)
    {
        $token = (new Request)->bearerToken();

        $user = Siswa::where('token', '=', $token)->first();

        if (!$user) {
            return $this->json([
                'status' => 'errors',
                'message' => 'Unauthenticated.',
            ], 401);
        }

        $page = (int) $_GET['page'];

        $soal = DB::table('detail_soal')
            ->select(['id', 'soal', 'a', 'b', 'c', 'd', 'jawaban'])
            ->where('id_latihan_soal', '=', $id)
            ->paginate(1, $page); // 1 soal per halaman

        return $this->json([
            'status' => 'success',
            'data' => $soal,
        ]);
    }

    public function SubmitLatihanSoal(Request $request)
    {
        $token = (new Request)->bearerToken();

        $user = Siswa::where('token', '=', $token)->first();

        if (!$user) {
            return $this->json([
                'status' => 'errors',
                'message' => 'Unauthenticated.',
            ], 401);
        }

        $Idsiswa = $request->input('id_siswa');
        $datas = $request->input('answer');
        $dateTime = new DateTime();

        foreach($datas as $data) {

            $jawabanBenar = DetailSoal::where('id', '=', $data['id_latihan_soal'])->first();
            $nilai = 0;

            if($jawabanBenar->jawaban == $data['jawaban']){
                $nilai = $jawabanBenar->bobot_nilai;
            }else{
                $nilai = 0;
            }

            PenilaianSoal::create([
                'id_detail_soal' => $data['id_latihan_soal'],
                'id_siswa' => $Idsiswa,
                'jawaban' => $data['jawaban'],
                'nilai' => $nilai,
                'tanggal' => $dateTime->format('Y-m-d H:i:s')
            ]);
        }

        return $this->json([
            'status' => 'success',
            'message' => 'Latihan Soal Berhasil Di Submit'
        ]);

    }

    public function getNilaiSoal($id)
    {
        $token = (new Request)->bearerToken();

        $user = Siswa::where('token', '=', $token)->first();

        if (!$user) {
            return $this->json([
                'status' => 'errors',
                'message' => 'Unauthenticated.',
            ], 401);
        }

        $nilai = DB::table('latihan_soal')
                    ->join('detail_soal', 'latihan_soal.id', '=', 'detail_soal.id_latihan_soal')
                    ->join('penilaian_soal', 'detail_soal.id', '=', 'penilaian_soal.id_detail_soal')
                    ->select(['SUM(penilaian_soal.nilai) as Nilai'])
                    ->where('latihan_soal.id', '=', $id)
                    ->where('penilaian_soal.id_siswa', '=', $user->id)
                    ->first();

        return $this->json([
            'status' => 'success',
            'data' => $nilai
        ]);
    }
}