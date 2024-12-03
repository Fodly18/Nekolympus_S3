<?php

namespace Nekolympus\Project\controllers\Web;

use Nekolympus\Project\core\Controller;
use Nekolympus\Project\helpers\Redirect;
use Nekolympus\Project\core\DB;
use Nekolympus\Project\core\Request;
use Nekolympus\Project\models\Berita;

class BeritaController extends Controller
{
    // Menampilkan daftar berita
    public function index()
    {
        $data = Berita::all();
        return $this->view('admin.berita.index', ['data' => $data]);
    }


    public function createIndex()
    {
        return $this->view('admin.berita.create');
    }


    public function create(Request $request)
{
    // Pastikan sesi pengguna aktif
    if (!isset($_SESSION['user'])) {
        die("Error: Anda harus login untuk membuat berita.");
    }

    // Ambil admin_id dari sesi pengguna
    $admin_id = $_SESSION['auth'];

    // Ambil input dari form
    $judul = $request->input('judul');
    $konten = $request->input('konten');
    $tanggal = $request->input('tanggal');
    $uploadedFile = $_FILES['img'];

    // Validasi input
    if (empty($judul) || empty($konten) || empty($tanggal)) {
        die("Error: Semua kolom wajib diisi.");
    }

    // Proses file upload
    if ($uploadedFile['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/../../../public/uploads/'; // Path ke folder uploads
        $fileName = time() . '_' . basename($uploadedFile['name']); // Membuat nama file unik
        $filePath = $uploadDir . $fileName;

        // Buat folder jika belum ada
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        if (move_uploaded_file($uploadedFile['tmp_name'], $filePath)) {
            // Simpan data ke database
            Berita::create([
                'judul' => $judul,
                'konten' => $konten,
                'tanggal' => $tanggal,
                'admin_id' => $admin_id,
                'img' => $filePath
            ]);

            // Redirect ke halaman daftar berita
            header("Location: /Berita");
            exit;
        } else {
            die("Error: Gagal mengunggah file.");
        }
    } else {
        die("Error: File wajib diunggah.");
    }
}


 
    
}
