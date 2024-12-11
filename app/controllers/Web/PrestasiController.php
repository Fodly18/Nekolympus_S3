<?php
namespace Nekolympus\Project\controllers\Web;

use Nekolympus\Project\core\Controller;
use Nekolympus\Project\helpers\Redirect;
use Nekolympus\Project\core\DB;
use Nekolympus\Project\core\Request;
use Nekolympus\Project\models\Prestasi;

class PrestasiController extends Controller {

public function index()
    {
        $data = DB::table('prestasi')
        ->select(['prestasi.id', 'prestasi.judul', 'prestasi.konten', 'prestasi.tanggal', 'prestasi.img','prestasi.img_sertifikat']) 
        ->get();
        return $this->view('admin.prestasi.index', ['data' => $data]);
    }


    public function createIndex()
    {
        return $this->view('admin.prestasi.create');
    }

    public function updateIndex($id)
{
    $prestasi = Prestasi::where('id', '=', $id)->first();

    if (!$prestasi) {
        die("Error: Acara dengan ID $id tidak ditemukan.");
    }

    return $this->view('admin.prestasi.update', ['data' => $prestasi]);
}

public function create(Request $request)
{
    $judul = $request->input('judul');
    $konten = $request->input('konten');
    $tanggal = $request->input('tanggal');
    $uploadedFile = $_FILES['img'] ?? null;
    $uploadedFileSertifikat = $_FILES['img_sertifikat'] ?? null;

    // Validasi input wajib
    if (empty($judul) || empty($konten) || empty($tanggal)) {
        die("Error: Semua kolom wajib diisi.");
    }

    // Validasi upload file img
    if (!$uploadedFile || $uploadedFile['error'] !== UPLOAD_ERR_OK) {
        die("Error: File img wajib diunggah.");
    }

    // Validasi upload file img_sertifikat
    if (!$uploadedFileSertifikat || $uploadedFileSertifikat['error'] !== UPLOAD_ERR_OK) {
        die("Error: File img_sertifikat wajib diunggah.");
    }

    // Proses upload untuk img
    $filePath = null;
    if ($uploadedFile && $uploadedFile['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '/img_gallery_Prestasi/';
        $fileName = time() . '_' . basename($uploadedFile['name']);
        $filePath = $uploadDir . $fileName;
        $fullPath = __DIR__ . '/../../../public' . $filePath;

        if (!is_dir(dirname($fullPath))) {
            mkdir(dirname($fullPath), 0777, true);
        }

        if (!move_uploaded_file($uploadedFile['tmp_name'], $fullPath)) {
            die("Error: Gagal mengunggah file img.");
        }
    }

    // Proses upload untuk img_sertifikat
    $filePathSertifikat = null;
    if ($uploadedFileSertifikat && $uploadedFileSertifikat['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '/img_gallery_Prestasi/';
        $fileNameSertifikat = time() . '_sertifikat_' . basename($uploadedFileSertifikat['name']);
        $filePathSertifikat = $uploadDir . $fileNameSertifikat;
        $fullPathSertifikat = __DIR__ . '/../../../public' . $filePathSertifikat;

        if (!is_dir(dirname($fullPathSertifikat))) {
            mkdir(dirname($fullPathSertifikat), 0777, true);
        }

        if (!move_uploaded_file($uploadedFileSertifikat['tmp_name'], $fullPathSertifikat)) {
            die("Error: Gagal mengunggah file img_sertifikat.");
        }
    }

    // Simpan data ke database
    Prestasi::create([
        'judul' => $judul,
        'konten' => $konten,
        'tanggal' => $tanggal,
        'img' => $filePath, // Path untuk img
        'img_sertifikat' => $filePathSertifikat // Path untuk img_sertifikat
    ]);

    return $this->redirect('/Prestasi')->with('success', 'Konten berhasil dibuat.');
}


public function update(Request $request)
{
    $id = $request->input('id');
    $judul = $request->input('judul');
    $konten = $request->input('konten');
    $tanggal = $request->input('tanggal');
    $uploadedFile = $_FILES['img'] ?? null;
    $uploadedFileSertifikat = $_FILES['img_sertifikat'] ?? null;

    // Validasi data wajib
    if (empty($judul) || empty($konten) || empty($tanggal)) {
        die("Error: Semua kolom wajib diisi.");
    }

    // Ambil data lama dari database
    $prestasi = DB::table('prestasi')
        ->select(['id', 'img', 'img_sertifikat'])
        ->where('id', '=', $id)
        ->first();

    if (!$prestasi) {
        die("Error: Data dengan ID $id tidak ditemukan.");
    }

    // Tangani file gambar
    $filePath = $prestasi['img']; // Default ke gambar lama
    if ($uploadedFile && $uploadedFile['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/../../../public/img_gallery_Prestasi/';
        $fileName = time() . '_' . basename($uploadedFile['name']);
        $filePath = '/img_gallery_Prestasi/' . $fileName; // Path baru
        $fullPath = $uploadDir . $fileName;

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        if (move_uploaded_file($uploadedFile['tmp_name'], $fullPath)) {
            // Hapus file lama
            $oldFilePath = __DIR__ . '/../../../public' . $prestasi['img'];
            if (!empty($prestasi['img']) && file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        } else {
            die("Error: Gagal mengunggah file img.");
        }
    }

    $filePathSertifikat = $prestasi['img_sertifikat']; // Default ke gambar lama
    if ($uploadedFileSertifikat && $uploadedFileSertifikat['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/../../../public/img_gallery_Prestasi/';
        $fileNameSertifikat = time() . '_sertifikat_' . basename($uploadedFileSertifikat['name']);
        $filePathSertifikat = '/img_gallery_Prestasi/' . $fileNameSertifikat;
        $fullPathSertifikat = $uploadDir . $fileNameSertifikat;

        if (move_uploaded_file($uploadedFileSertifikat['tmp_name'], $fullPathSertifikat)) {
            // Hapus file lama
            $oldFilePathSertifikat = __DIR__ . '/../../../public' . $prestasi['img_sertifikat'];
            if (!empty($prestasi['img_sertifikat']) && file_exists($oldFilePathSertifikat)) {
                unlink($oldFilePathSertifikat);
            }
        } else {
            die("Error: Gagal mengunggah file img_sertifikat.");
        }
    }

    // Update data
    Prestasi::update($id, [
        'judul' => $judul,
        'konten' => $konten,
        'tanggal' => $tanggal,
        'img' => $filePath, // Tetap gunakan path lama jika tidak ada file baru
        'img_sertifikat' => $filePathSertifikat, // Tetap gunakan path lama jika tidak ada file baru
    ]);

    return $this->redirect('/Prestasi')->with('success', 'Data berhasil diperbarui');
}



public function delete($id)
    {  
        $Prestasi = Prestasi::where('id', '=', $id)->first();

        if ($Prestasi) {
            
            $filePath = __DIR__ . '/../../../public' . $Prestasi->img;
            $filePathSertifikat = __DIR__ . '/../../../public' . $Prestasi->img_sertifikat;
    
            if (!empty($Prestasi->img) && file_exists($filePath)) {
                unlink($filePath);
            }
            if (!empty($Prestasi->img_sertifikat) && file_exists($$filePathSertifikat)) {
                unlink($$filePathSertifikat);
            }
 
            Prestasi::delete($id);
        } else {
            die("Error: Prestasi dengan ID $id tidak ditemukan.");
        }  
        return $this->redirect('/Prestasi');
    }


}