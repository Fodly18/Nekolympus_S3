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
			<li>
				<a href="#">

					<i class='bx bxs-book'></i>
					<span class="text">Data Admin</span>

				</a>
			</li>
			<li>
				<a href="/guru">
					<i class='bx bxs-group' ></i>
					<span class="text">Guru</span>
				</a>
			</li>
			<li>

				<a href="#">
					<i class='bx bxs-group' ></i>
					<span class="text">Siswa</span>
				</a>
			</li>
			<li class="active">
				<a href="/Berita">

					<i class='bx bxs-news' ></i>
					<span class="text">Berita</span>
				</a>
			</li>
			<li>
				<a href="#">

					<i class='bx bxs-receipt' ></i>

					<span class="text">PPDB</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="#">
					<i class='bx bxs-cog'></i>
					<span class="text">Settings</span>
				</a>
			</li>
			<li>

				<a href="/logout-admin" class="logout">
					<i class='bx bxs-log-out-circle' ></i>

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
			<a href="#" class="nav-link">Categories</a>
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
				</div>
			</form>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
			<a href="#" class="notification">
				<i class='bx bxs-bell'></i>
				<span class="num">8</span>
			</a>
			<a href="#" class="profile">
				<img src="img/people.png">
			</a>
		</nav>
		<!-- NAVBAR -->
        <main>
    <div class="head-title">
        <div class="left">
            <h1>Data Berita</h1>
            <ul class="breadcrumb">
                <li><a href="/admin">Dashboard</a></li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li><a class="active" href="#">Berita</a></li>
            </ul>
        </div>
        <a href="/Berita/create" class="btn btn-primary">
            <i class='bx bx-plus'></i>
            <span>Tambah Berita</span>
        </a>
    </div>

    <div class="table-container">
    <table class="data-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Konten</th>
                <th>Tanggal</th>
                <th>Pembuat</th>
                <th>Image</th>
            </tr>
        </thead>
        <tbody>
        <?php if (empty($data)): ?>
            <tr>
                <td colspan="6" class="empty-state">
                    <i class='bx bx-folder-open'></i>
                    <p>Belum ada data Berita tersedia</p>
                </td>
            </tr>
        <?php else: ?>
            <?php $no = 1; foreach ($data as $row): ?>
                <?php 
                    // Mengambil data gambar (BLOB)
                    $imgData = $row['img']; // Kolom 'img' berisi data BLOB
                    
                    // Mengonversi BLOB ke base64
                    $base64Image = base64_encode($imgData);
                    // Membuat URL gambar base64
                    $imageSrc = 'data:image/jpeg;base64,' . $base64Image;
                    
                    // Encode data lainnya menjadi JSON
                    $dataEncoded = json_encode([
                        'id' => $row['id'],
                        'img' => $imageSrc, // Kirim gambar dalam base64
                        'judul' => $row['judul'],
                        'konten' => $row['konten'],
                        'tanggal' => $row['tanggal'],
                        'admin_id' => $row['admin_id']
                    ], JSON_HEX_APOS | JSON_HEX_QUOT | JSON_UNESCAPED_UNICODE);
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($row['judul']); ?></td>
                    <td><?= htmlspecialchars(substr($row['konten'], 0, 50)) . '...'; ?></td>
                    <td><?= htmlspecialchars($row['tanggal']); ?></td>
                    <td><?= htmlspecialchars($row['admin_id']); ?></td>
                    <td>
                        <!-- Menggunakan data JSON yang telah di-encode -->
                        <button class="btn btn-info" onclick="showPreview(<?= $dataEncoded ?>)">
                            <i class='bx bx-show'></i>
                            <span>Preview</span>
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</div>

</main>

<!-- Modal untuk Preview -->
<div id="previewModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close" onclick="closePreview()">&times;</span>
        <div class="card-view">
            <img id="previewImage" src="" alt="Image" class="preview-image">
            <h2 id="previewTitle"></h2>
            <p id="previewContent"></p>
            <small id="previewDate"></small>
            <span id="previewAuthor"></span>
        </div>
    </div>
</div>


	</section>
	<!-- CONTENT -->
<script>
 function showPreview(data) {
    console.log(data); // Cek data yang dikirim dari PHP

    // Menampilkan gambar dalam format base64
    document.getElementById('previewImage').src = data.img;
    document.getElementById('previewTitle').textContent = data.judul;
    document.getElementById('previewContent').textContent = data.konten;
    document.getElementById('previewDate').textContent = `Tanggal: ${data.tanggal}`;
    document.getElementById('previewAuthor').textContent = `Pembuat: ${data.admin_id}`;
    
    // Menampilkan modal
    document.getElementById('previewModal').style.display = 'flex';
}

function closePreview() {
    document.getElementById('previewModal').style.display = 'none';
}

</script>

</body>
</html>
