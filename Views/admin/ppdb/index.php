<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<link rel="icon" href="/assets/img/logo.png" type="image/png">
    <link rel="stylesheet" href="/assets/css/dashboardberita.css">
	<title>PPDB - Dashboard Admin</title>
</head>
<body>

	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<img src="/assets/img/logo.png" alt="Logo" class="icon" width="60" height="60">
			<span class="text">SDN 1 KALISAT</span>
		</a>
		<ul class="side-menu top">
			<li>
				<a href="/dashboard-admin">
					<i class='bx bxs-dashboard'></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li>
				<a href="/guru">
					<i class='bx bxs-group'></i>
					<span class="text">Guru</span>
				</a>
			</li>
			<li>
				<a href="/siswa">
					<i class='bx bxs-group'></i>
					<span class="text">Siswa</span>
				</a>
			</li>
			<li>
				<a href="/Acara_sekolah">
					<i class='bx bxs-photo-album' ></i>
					<span class="text">Gallery</span>
				</a>
			</li>
			<li>
				<a href="/Berita">
					<i class='bx bxs-news' ></i>
					<span class="text">Berita</span>
				</a>
			</li>
			<li class="active">
				<a href="/Ppdb">
					<i class='bx bxs-receipt' ></i>
					<span class="text">PPDB</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="/logout-admin" class="logout">
					<i class='bx bx-log-out'></i>
					<span class="text">Logout</span>
				</a>
			</li>
		</ul>
	</section>

	<!-- CONTENT -->
	<section id="content">
		<!-- NAVBAR -->
		<nav>
			<i class='bx bx-menu'></i>
		<!-- mode malam -->
			<div class="dark-mode-switch">
        <p>Dark Mode</p>
        <input type="checkbox" id="switch-mode" hidden>
        <label for="switch-mode" class="switch-mode"></label>
            </div>
		</nav>
		<!-- NAVBAR -->
    
    	<!-- MAIN -->
        <main>
    <div class="head-title">
        <div class="left">
            <h1>Data Poster PPDB</h1>
            <ul class="breadcrumb">
                <li><a href="/admin">Dashboard</a></li>
				<li><i class='bx bx-chevron-right'></i></li>
                <li><a class="active" href="#">PPDB</a></li>
            </ul>
        </div>
        <a href="/Ppdb/create" class="btn btn-primary">
            <i class='bx bx-plus'></i>
            <span>Tambah Poster PPDB</span>
        </a>
    </div>

    <div class="table-container">
    <table class="data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($data)): ?>
                <tr>
                    <td colspan="6" class="empty-state">
                        <i class='bx bx-folder-open'></i>
                        <p>Belum ada Poster PPDB yang Aktif</p>
                    </td>
                </tr>
            <?php else: ?>
                <?php 
                $no = 1; 
                $currentDate = date('Y-m-d');
                foreach ($data as $row): 
                    // Tentukan status berdasarkan tanggal mulai dan selesai
                    $status = 'Non-Aktif'; // Default status
                    if ($currentDate >= $row['tanggal_mulai'] && $currentDate <= $row['tanggal_selesai']) {
                        $status = 'Aktif';
                    } elseif ($currentDate < $row['tanggal_mulai']) {
                        $status = 'Belum Dimulai';
                    }
                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td>
                            <img 
                                src="<?= htmlspecialchars($row['img']); ?>" 
                                alt="Poster <?= htmlspecialchars($row['tanggal_mulai']); ?>" 
                                class="poster-thumbnail">
                        </td>
                        <td><?= htmlspecialchars($row['tanggal_mulai']); ?></td>
                        <td><?= htmlspecialchars($row['tanggal_selesai']); ?></td>
                        <td><?= $status; ?></td> <!-- Menampilkan status -->
                        <td class="action-buttons">
                            <a href="/Ppdb/update/<?= urlencode($row['id']); ?>" class="btn btn-success btn-edit">
                                <i class='bx bx-edit-alt'></i>
                                <span>Edit</span>
                            </a>
                            <a 
                                href="/Ppdb/delete/<?= urlencode($row['id']); ?>" 
                                class="btn btn-danger btn-delete delete-button"> 
                                <i class='bx bx-trash'></i>
                                <span>Hapus</span>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>


<!-- Modal Konfirmasi -->
<div id="confirmation-modal" class="modal hidden">
    <div class="modal-content">
        <h3>Konfirmasi Penghapusan</h3>
        <p>Apakah Anda yakin ingin menghapus data ini?</p>
        <div class="modal-buttons">
            <button id="cancel-button" class="btn btn-cancel">Batal</button>
            <button id="confirm-button" class="btn btn-confirm">Hapus</button>
        </div>
    </div>
</div>

<!-- Modal Konfirmasi Berhasil ketika sesudah delete -->
<div id="success-modal" class="modal hidden">
    <div class="modal-content">
        <div class="success-content">
            <div class="trash-bin">
                <div class="lid"></div>
                <div class="bin"></div>
                <div class="trash"></div>
            </div>
            <p>Data sudah dihapus!</p>
        </div>
    </div>
</div>

</main>
</section>
<script src="/assets/js/paket-tabel.js"></script>
</body>
</html>