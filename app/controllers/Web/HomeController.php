<?php

namespace Nekolympus\Project\controllers\Web;

use Nekolympus\Project\core\Controller;
use Nekolympus\Project\core\DB;
use Nekolympus\Project\core\Helper;
use Nekolympus\Project\core\View;
use Nekolympus\Project\core\Request;
use Nekolympus\Project\models\Berita;

class HomeController extends Controller
{
    public function index()
    {
        $data = DB::table('berita')
        ->join('admin', 'berita.admin_id', '=', 'admin.id') // Menghubungkan berita dengan admin
        ->select(['berita.id', 'berita.judul', 'berita.konten', 'berita.tanggal', 'berita.img', 'admin.username']) // Pilih kolom yang diperlukan
        ->orderBy('berita.tanggal', 'desc')
        ->get();

        return $this->view('home.index', ['berita' => $data]);
    }


    public function sejarah()
    {
        return  $this->view('html.sejarah');
    }

    public function Visi_misi()
    {
    return $this->view('html.Visi-misi');
    
    }
    public function strukture_organisasi()
    {
    return $this->view('html.Struktur-Organisasi');
    
    }
    public function acara_sekolah()
    {
    return $this->view('html.Acara-Sekolah');
    
    }
    public function prestasi()
    {
    return $this->view('html.Prestasi');
    
    }
    public function berita()
    {
        $data = DB::table('berita')
        ->join('admin', 'berita.admin_id', '=', 'admin.id') // Menghubungkan berita dengan admin
        ->select(['berita.id', 'berita.judul', 'berita.konten', 'berita.tanggal', 'berita.img', 'admin.username']) // Pilih kolom yang diperlukan
        ->orderBy('berita.tanggal', 'desc')
        ->get();

        return $this->view('html.Berita', ['berita' => $data]);
    
    }
    public function ppdb()
    {
    return $this->view('html.ppdb');
    
    }
    public function kontak()
    {
    return $this->view('html.kontak');
    
    }
    public function blog()
    {
        $data = DB::table('berita')
        ->join('admin', 'berita.admin_id', '=', 'admin.id') // Menghubungkan berita dengan admin
        ->select(['berita.id', 'berita.judul', 'berita.konten', 'berita.tanggal', 'berita.img', 'admin.username']) // Pilih kolom yang diperlukan
        ->orderBy('berita.tanggal', 'desc')
        ->get();
        return $this->view('html.blog', ['berita' => $data]);
    
    }

    public function blogDetail($id)
{
     // Validasi ID agar hanya menerima angka
     if (!is_numeric($id)) {
        die("Error: ID tidak valid.");
    }

    // Query untuk mengambil data berita berdasarkan ID
    $data = DB::table('berita')
        ->join('admin', 'berita.admin_id', '=', 'admin.id') // Menghubungkan berita dengan admin
        ->select([
            'berita.id',
            'berita.judul',
            'berita.konten',
            'berita.tanggal',
            'berita.img',
            'admin.username'
        ]) // Pilih kolom yang diperlukan
        ->where('berita.id', '=', $id) // Filter berdasarkan ID
        ->first(); // Mengambil hanya satu data

    // Jika berita tidak ditemukan, tampilkan pesan error
    if (!$data) {
        die("Error: Berita tidak ditemukan.");
    }

    // Return ke view blog dengan data berita
    return $this->view('html.blog', ['berita' => $data]);
}



}