<?php
namespace Nekolympus\Project\controllers\Web;

use Nekolympus\Project\core\Controller;
use Nekolympus\Project\helpers\Redirect;
use Nekolympus\Project\core\DB;
use Nekolympus\Project\core\Request;
use Nekolympus\Project\models\PPDB;
use Nekolympus\Project\core\QueryBuilder;


class PpdbController extends Controller
{
    public function index()
{
    $data = DB::table('ppdb')
        ->select(['ppdb.id', 'ppdb.tanggal_mulai', 'ppdb.tanggal_selesai', 'ppdb.img', 'ppdb.status']) 
        ->get();

    // Update status berdasarkan waktu saat ini
    foreach ($data as &$item) {
        $now = date('Y-m-d H:i:s'); // Mendapatkan waktu sekarang
        
        // Memeriksa status berdasarkan rentang tanggal
        if ($now >= $item['tanggal_mulai'] && $now <= $item['tanggal_selesai']) {
            $item['status'] = 'aktif'; // Status aktif jika dalam rentang tanggal mulai dan selesai
        } elseif ($now > $item['tanggal_selesai']) {
            $item['status'] = 'non-aktif'; // Status non-aktif jika sudah lewat tanggal selesai
        } elseif ($now < $item['tanggal_mulai']) {
            $item['status'] = 'belum dimulai'; // Status belum dimulai jika tanggal mulai lebih besar dari sekarang
        }
    }

    return $this->view('admin.Ppdb.index', ['data' => $data]);
}

    public function createIndex()
    {
        return $this->view('admin.Ppdb.create');
    }

    public function create(Request $request)
    {
        $tgl_mulai = date('Y-m-d', strtotime($request->input('tanggal_mulai')));
        $tgl_selesai = date('Y-m-d', strtotime($request->input('tanggal_selesai')));
        $uploadedposter = $_FILES['img'] ?? null;
        $today = date('Y-m-d');
        $errors = [];
    
        // Validasi tanggal
        if ($tgl_mulai < $today) {
            $errors[] = "Tanggal mulai tidak boleh sebelum hari ini.";
        }
    
        if ($tgl_selesai < $tgl_mulai) {
            $errors[] = "Tanggal selesai tidak boleh sebelum tanggal mulai.";
        }
    
        // Menentukan status berdasarkan tanggal
        $status = 'belum dimulai';  // Default status
    
        if ($today >= $tgl_mulai && $today <= $tgl_selesai) {
            $status = 'aktif'; // Jika hari ini berada di rentang tanggal mulai dan selesai
        } elseif ($today > $tgl_selesai) {
            $status = 'non-aktif'; // Jika hari ini lebih dari tanggal selesai
        }
    
        // Query jumlah poster aktif
        $activePosterCount = DB::table('ppdb')->where('status', '=', 'aktif')->count();
    
        if ($activePosterCount >= 1) {
            $errors[] = "Tidak boleh ada lebih dari 1 poster aktif.";
        }
    
        // Validasi upload file img
        $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        $maxFileSize = 2 * 1024 * 1024; // 2MB
    
        if (!$uploadedposter || $uploadedposter['error'] !== UPLOAD_ERR_OK) {
            $errors[] = "File img wajib diunggah.";
        } elseif (!in_array($uploadedposter['type'], $allowedTypes)) {
            $errors[] = "Jenis file tidak didukung. Hanya JPEG/PNG yang diperbolehkan.";
        } elseif ($uploadedposter['size'] > $maxFileSize) {
            $errors[] = "Ukuran file melebihi 2MB.";
        }
    
        if (!empty($errors)) {
            return $this->view('admin.Ppdb.create', ['errors' => $errors]);
        }
    
        // Proses upload img
        $uploadDir = '/gambar_ppdb/';
        $fileName = time() . '_' . basename($uploadedposter['name']);
        $filePath = $uploadDir . $fileName;
        $fullPath = __DIR__ . '/../../../public' . $filePath;
    
        if (!is_dir(dirname($fullPath))) {
            mkdir(dirname($fullPath), 0777, true);
        }
    
        if (!move_uploaded_file($uploadedposter['tmp_name'], $fullPath)) {
            return $this->view('admin.Ppdb.create', ['errors' => ["Gagal mengunggah file img."]]);
        }
    
        // Simpan data dengan status yang sudah ditentukan
        PPDB::create([
            'tanggal_mulai' => $tgl_mulai,
            'tanggal_selesai' => $tgl_selesai,
            'img' => $filePath,
            'status' => $status,
        ]);
    
        return $this->redirect('/Ppdb')->with('success', 'Konten berhasil dibuat.');
    }
    



    public function updateIndex()
    {
        return $this->view('admin.Ppdb.update');
    }

    public function update(Request $request)
{
    $id = $request->input('id');
    $tgl_mulai = $request->input('tanggal_mulai');
    $tgl_selesai = $request->input('tanggal_selesai');
    $uploadedposter = $_FILES['img'] ?? null;

    $tgl_mulai = date('Y-m-d', strtotime($tgl_mulai));
    $tgl_selesai = date('Y-m-d', strtotime($tgl_selesai));
    $today = date('Y-m-d');

    if ($tgl_mulai < $today) {
        die("Error: Tanggal mulai tidak boleh sebelum hari ini.");
    }
    if ($tgl_selesai < $tgl_mulai) {
        die("Error: Tanggal selesai tidak boleh sebelum tanggal mulai.");
    }

    // Ambil data lama
    $ppdb = DB::table('ppdb')->where('id', '=', $id)->first();
    if (!$ppdb) {
        die("Error: Data dengan ID $id tidak ditemukan.");
    }

    $filePath = $ppdb->img; // Default ke gambar lama
    if ($uploadedposter && $uploadedposter['error'] === UPLOAD_ERR_OK) {
        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        $fileExtension = pathinfo($uploadedposter['name'], PATHINFO_EXTENSION);

        if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
            die("Error: Hanya file dengan ekstensi .jpg, .jpeg, atau .png yang diperbolehkan.");
        }

        $uploadDir = __DIR__ . '/../../../public/gambar_ppdb/';
        $fileName = time() . '_' . basename($uploadedposter['name']);
        $filePath = '/gambar_ppdb/' . $fileName;
        $fullPath = $uploadDir . $fileName;

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        if (move_uploaded_file($uploadedposter['tmp_name'], $fullPath)) {
            $oldFilePath = __DIR__ . '/../../../public' . $ppdb->img;
            if (!empty($ppdb->img) && file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }
        } else {
            die("Error: Gagal mengunggah file img.");
        }
    }

    // Tentukan status baru
    $status = 'belum dimulai';
    if ($tgl_mulai <= $today && $tgl_selesai >= $today) {
        $status = 'aktif';
    } elseif ($tgl_selesai < $today) {
        $status = 'non-aktif';
    }

    // Update data
    PPDB::update($id, [
        'tanggal_mulai' => $tgl_mulai,
        'tanggal_selesai' => $tgl_selesai,
        'img' => $filePath,
        'status' => $status,
    ]);

    return $this->redirect('/Ppdb')->with('success', 'Data berhasil diperbarui');
}


    public function delete($id)
    {  
        $ppdb = PPDB::where('id', '=', $id)->first();

        if ($ppdb) {
            
            $filePath = __DIR__ . '/../../../public' . $ppdb->img;
    
            if (!empty($ppdb->img) && file_exists($filePath)) {
                unlink($filePath);
            }
            
            PPDB::delete($id);
        } else {
            die("Error: Berita dengan ID $id tidak ditemukan.");
        }  
        return $this->redirect('/Ppdb');
    }

    public function deleteExpiredData()
    {
        $now = date('Y-m-d H:i:s');
        $expiredData = DB::table('ppdb')
            ->where('tanggal_selesai', '<', $now)
            ->get();

        foreach ($expiredData as $data) {
        foreach ($expiredData as $data) {
                $this->delete($data->id);
            }
        
            return true; // Atau log untuk admin
        }
    }
}