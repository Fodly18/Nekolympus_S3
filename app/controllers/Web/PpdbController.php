<?php
namespace Nekolympus\Project\controllers\Web;

use Nekolympus\Project\core\Controller;
use Nekolympus\Project\helpers\Redirect;
use Nekolympus\Project\core\DB;
use Nekolympus\Project\core\Request;
use Nekolympus\Project\models\PPDB;

class PpdbController extends Controller
{
    public function index()
    {
        $data = DB::table('ppdb')
            ->select(['ppdb.id', 'ppdb.tanggal_mulai', 'ppdb.tanggal_selesai', 'ppdb.img', 'ppdb.status']) 
            ->get();

        // Update status berdasarkan waktu saat ini
        foreach ($data as &$item) {
            $now = date('Y-m-d H:i:s');
            
            // Mengakses elemen array dengan menggunakan indeks
            if ($now >= $item['tanggal_mulai'] && $now <= $item['tanggal_selesai']) {
                $item['status'] = 'aktif'; // Mengubah status di array
            } elseif ($now > $item['tanggal_selesai']) {
                $item['status'] = 'non-aktif'; // Mengubah status di array
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
        $tgl_mulai = $request->input('tanggal_mulai');
        $tgl_selesai = $request->input('tanggal_selesai');
        $uploadedposter = $_FILES['img'] ?? null;

        $errors = []; // Initialize an array to hold error messages

        // Validasi tanggal
        $tgl_mulai = date('Y-m-d', strtotime($tgl_mulai));
        $today = date('Y-m-d'); // Tanggal hari ini dalam format Y-m-d
        
        if ($tgl_mulai < $today) {
            die("Error: Tanggal mulai tidak boleh sebelum hari ini.");
        }
        
        // Izinkan tanggal selesai sama dengan tanggal mulai
        $tgl_selesai = date('Y-m-d', strtotime($tgl_selesai));
        if ($tgl_selesai < $tgl_mulai) {
            die("Error: Tanggal selesai tidak boleh sebelum tanggal mulai.");
        }
        
        // Validasi hanya boleh ada 1 poster
        $posterCount = count(DB::table('ppdb')->get());
        
        if ($posterCount >= 2) {
            $errors['system'][] = "Tidak boleh ada lebih dari 1 poster.";
        }
        
        // Check if there are any errors
        if (!empty($errors)) {
            return $this->view('admin.Ppdb.create', ['errors' => $errors]);
        }

        // Validasi upload file img
        if (!$uploadedposter || $uploadedposter['error'] !== UPLOAD_ERR_OK) {
            die("Error: File img wajib diunggah.");
        }

        // Proses upload untuk img
        $filePath = null;
        if ($uploadedposter && $uploadedposter['error'] === UPLOAD_ERR_OK) {
            $uploadDir = '/gambar_ppdb/';
            $fileName = time() . '_' . basename($uploadedposter['name']);
            $filePath = $uploadDir . $fileName;
            $fullPath = __DIR__ . '/../../../public' . $filePath;

            if (!is_dir(dirname($fullPath))) {
                mkdir(dirname($fullPath), 0777, true);
            }

            if (!move_uploaded_file($uploadedposter['tmp_name'], $fullPath)) {
                die("Error: Gagal mengunggah file img.");
            }
        }

        // Simpan data ke database
        PPDB::create([
            'tanggal_mulai' => $tgl_mulai,
            'tanggal_selesai' => $tgl_selesai,
            'img' => $filePath, // Path untuk img
            'status' => 'non-aktif', // Default status
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
        error_log("Updating PPDB with ID: " . $id); // Debug statement

        $tgl_mulai = $request->input('tanggal_mulai');
        $tgl_selesai = $request->input('tanggal_selesai');
        $uploadedposter = $_FILES['img'] ?? null;

        // Validasi tanggal
        $tgl_mulai = date('Y-m-d', strtotime($tgl_mulai));
        $today = date('Y-m-d'); // Tanggal hari ini dalam format Y-m-d
        
        if ($tgl_mulai < $today) {
            die("Error: Tanggal mulai tidak boleh sebelum hari ini.");
        }
        
        // Izinkan tanggal selesai sama dengan tanggal mulai
        $tgl_selesai = date('Y-m-d', strtotime($tgl_selesai));
        if ($tgl_selesai < $tgl_mulai) {
            die("Error: Tanggal selesai tidak boleh sebelum tanggal mulai.");
        }

        // Ambil data lama dari database
        error_log("Updating PPDB with ID: " . $id); // Debug statement
        $ppdb = DB::table('ppdb')
        ->select(['id', 'img', 'status'])
            ->select(['id', 'img', 'status'])
            ->where('id', '=', $id)
            ->first();

        if (!$ppdb) {
            die("Error: Data dengan ID $id tidak ditemukan.");
        }

        error_log("PPDB record found: " . print_r($ppdb, true)); // Log the found record
        $filePath = $ppdb->img; // Default ke gambar lama
        if ($uploadedposter && $uploadedposter['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../../../public/gambar_ppdb/';
            $fileName = time() . '_' . basename($uploadedposter['name']);
            $filePath = '/gambar_ppdb/' . $fileName; // Path baru
            $fullPath = $uploadDir . $fileName;

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            if (move_uploaded_file($uploadedposter['tmp_name'], $fullPath)) {
                // Hapus file lama
                $oldFilePath = __DIR__ . '/../../../public' . $ppdb->img;
                if (!empty($ppdb->img) && file_exists($oldFilePath)) {
                    unlink($oldFilePath);
                }
            } else {
                die("Error: Gagal mengunggah file img.");
            }
        }

        // Update data
        PPDB::update($id, [
            'tanggal_mulai' => $tgl_mulai,
            'tanggal_selesai' => $tgl_selesai,
            'img' => $filePath, // Tetap gunakan path lama jika tidak ada file baru
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