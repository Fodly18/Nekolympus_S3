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
        ->orderBy('berita.id', 'desc')
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
        $data = DB::table('acara_sekolah')
        ->select(['acara_sekolah.id', 'acara_sekolah.judul', 'acara_sekolah.konten', 'acara_sekolah.tanggal', 'acara_sekolah.img']) // Pilih kolom yang diperlukan
        ->orderBy('acara_sekolah.tanggal', 'desc')
        ->orderBy('acara_sekolah.id', 'desc')
        ->get();
        return $this->view('html.Acara-Sekolah', ['acara_sekolah' => $data]);
    
    }
    public function prestasi()
    {
        $data = DB::table('prestasi')
        ->select(['prestasi.id', 'prestasi.judul', 'prestasi.konten', 'prestasi.tanggal', 'prestasi.img','prestasi.img_sertifikat']) // Pilih kolom yang diperlukan
        ->orderBy('prestasi.tanggal', 'desc')
        ->orderBy('prestasi.id', 'desc')
        ->get();
        return $this->view('html.Prestasi', ['prestasi' => $data]);
    
    }
    public function berita()
    {
        $data = DB::table('berita')
        ->join('admin', 'berita.admin_id', '=', 'admin.id') // Menghubungkan berita dengan admin
        ->select(['berita.id', 'berita.judul', 'berita.konten', 'berita.tanggal', 'berita.img', 'admin.username']) // Pilih kolom yang diperlukan
        ->orderBy('berita.tanggal', 'desc')
        ->orderBy('berita.id', 'desc')
        ->get();

        return $this->view('html.Berita', ['berita' => $data]);
    
    }
    public function ppdb()
{
    // Ambil semua data PPDB tanpa filter status
    $data = DB::table('ppdb')
        ->select(['id', 'tanggal_mulai', 'tanggal_selesai', 'img', 'status'])
        ->orderBy('tanggal_mulai', 'desc')
        ->get();

    // Update status berdasarkan waktu saat ini
    foreach ($data as &$item) {
        $now = date('Y-m-d H:i:s'); // Mendapatkan waktu sekarang
        
        // Tentukan status berdasarkan rentang tanggal
        if ($now >= $item['tanggal_mulai'] && $now <= $item['tanggal_selesai']) {
            $item['status'] = 'aktif'; // Status aktif jika dalam rentang tanggal mulai dan selesai
        } elseif ($now > $item['tanggal_selesai']) {
            $item['status'] = 'non-aktif'; // Status non-aktif jika sudah lewat tanggal selesai
        } elseif ($now < $item['tanggal_mulai']) {
            $item['status'] = 'belum dimulai'; // Status belum dimulai jika tanggal mulai lebih besar dari sekarang
        }
    }

    // Kirim data ke tampilan
    return $this->view('html.ppdb', ['data' => $data]);
}


    


    public function kontak()
    {
    
        return $this->view('html.kontak');
    }
    // send wa
    public function sendWhatsAppMessage(Request $request)
    {
        // Validasi input
        if (!$request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ])) {
            // Jika validasi gagal, tampilkan formulir dengan error
            return $this->view('html.kontak', ['errors' => $request->getErrors()]);
        }

        // Ambil data dari form
        $name = $request->input('name');
        $email = $request->input('email');
        $message = $request->input('message');

        // Format pesan untuk WhatsApp
        $whatsappMessage = "Pesan Baru:\n\n"
            . "Nama: $name\n"
            . "Email: $email\n"
            . "Pesan:\n$message";

        // Kirim ke WhatsApp
        $whatsappNumber = '6289697639441'; // Ganti dengan nomor WhatsApp Anda
        $this->redirectToWhatsapp($whatsappNumber, $whatsappMessage);

       
    }
    private function redirectToWhatsapp($number, $message)
    {
        $encodedMessage = urlencode($message);
        header("Location: https://wa.me/$number?text=$encodedMessage");
        exit;
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