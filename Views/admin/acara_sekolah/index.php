<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<link rel="icon" href="/assets/img/logo.png" type="image/png">
	<link rel="stylesheet" href="/assets/css/dashboardberita.css">
	<title>Berita - Dashboard Admin</title>
</head>
<body>

	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<img src="/assets/img/logo.png" alt="Logo" class="icon" width="60" height="60">
			<span class="text">SDN 1 KALISAT</span>
		</a>
		<ul class="side-menu top">
			<li >
				<a href="/dashboard-admin">
					<i class='bx bxs-dashboard'></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
            <li class="active">
				<a href="/Acara_sekolah">
					<i class='bx bxs-photo-album' ></i>
					<span class="text">Acara_sekolah</span>
				</a>
			</li>
			<li>
				<a href="/Prestasi">
					<i class='bx bxs-trophy' ></i>
					<span class="text">Prestasi</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="/logout-admin" class="logout">
					<i class='bx bx-log-out' ></i>

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
        <main>
    <div class="head-title">
        <div class="left">
            <h1>Data Acara_sekolah</h1>
            <ul class="breadcrumb">
                <li><a href="/admin">Dashboard</a></li>
				<li><i class='bx bx-chevron-right'></i></li>
                <li><a href="/gallery">Gallery</a></li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li><a class="active" href="#">Acara_sekolah</a></li>
            </ul>
        </div>
        <a href="/Acara_sekolah/create" class="btn btn-primary">
            <i class='bx bx-plus'></i>
            <span>Tambah Acara_sekolah</span>
        </a>
    </div>

	<div class="search-bar-container">
	<input type="text" id="search-input" placeholder="Cari judul...">
		<i class='bx bx-search'></i>
	</div>
    <div class="table-container">
    <table class="data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Konten</th>
                <th>Tanggal</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php if (empty($data)): ?>
            <tr>
                <td colspan="7" class="empty-state">
                    <i class='bx bx-folder-open'></i>
                    <p>Belum ada data Berita tersedia</p>
                </td>
            </tr>
        <?php else: ?>
            <?php $no = 1; foreach ($data as $row): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars(strlen($row['judul']) > 20 ? substr($row['judul'], 0, 20) . '...' : $row['judul']); ?></td>
					<td><?= htmlspecialchars(strlen($row['konten']) > 20 ? substr($row['konten'], 0, 20) . '...' : $row['konten']); ?></td>
                    <td><?= htmlspecialchars($row['tanggal']); ?></td>          
					 <td><?= htmlspecialchars(strlen(basename($row['img'])) > 20 ? substr(basename($row['img']), 0, 20) . '...' : basename($row['img'])); ?></td>
                    <td class="action-buttons">
                        <a href="/Acara_sekolah/update/<?= urlencode($row['id']); ?>" class="btn btn-success btn-edit">
                            <i class='bx bx-edit-alt'></i>
                            <span>Edit</span>
                        </a>
						<a href="/Acara_sekolah/delete/<?= urlencode($row['id']); ?>" 
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
<style>
	/* Modal Overlay */
.modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000;
}

/* Sembunyikan modal secara default */
.hidden {
    display: none;
}

/* Konten Modal */
.modal-content {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    text-align: center;
    width: 300px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    animation: scaleIn 0.3s ease-in-out;
}

/* Animasi Scale In */
@keyframes scaleIn {
    from {
        transform: scale(0.8);
        opacity: 0;
    }
    to {
        transform: scale(1);
        opacity: 1;
    }
}

/* Modal Heading */
.modal-content h3 {
    margin-bottom: 10px;
    font-size: 20px;
    color: #333;
}

/* Modal Paragraph */
.modal-content p {
    margin-bottom: 20px;
    font-size: 16px;
    color: #555;
}

/* Tombol Modal */
.modal-buttons {
    display: flex;
    justify-content: space-around;
}

.modal-buttons .btn {
    padding: 10px 20px;
    border-radius: 5px;
    font-size: 14px;
    cursor: pointer;
    border: none;
    transition: all 0.3s ease;
}

/* Tombol Batal */
.modal-buttons .btn-cancel {
    background: #f44336;
    color: #fff;
}

.modal-buttons .btn-cancel:hover {
    background: #d32f2f;
}

/* Tombol Hapus */
.modal-buttons .btn-confirm {
    background: #4caf50;
    color: #fff;
}

.modal-buttons .btn-confirm:hover {
    background: #388e3c;
}

</style>


</main>
</section>
<script src="/assets/js/paket-tabel.js"></script>
</body>
</html>