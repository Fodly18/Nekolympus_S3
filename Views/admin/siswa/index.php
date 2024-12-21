<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="/assets/css/dataguruadmin.css">
    <link rel="stylesheet" href="/assets/css/dashboardadmin.css">
    <title>Data Siswa - Admin Dashboard</title>
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
			<li  class="active">
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
			<li>
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
            <h1>Data Siswa</h1>
            <ul class="breadcrumb">
                <li><a href="/admin">Dashboard</a></li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li><a class="active" href="#">Data Siswa</a></li>
            </ul>
        </div>
        <a href="/siswa/create" class="btn btn-primary">
            <i class='bx bx-plus'></i>
            <span>Tambah Siswa</span>
        </a>
    </div>

    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>NISN</th>
                    <th>Nomor HP</th>
                    <th>Kelas</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($data)): ?>
                    <tr>
                        <td colspan="6" class="empty-state">
                            <i class='bx bx-folder-open'></i>
                            <p>Belum ada data siswa tersedia</p>
                        </td>
                    </tr>
                <?php else: ?>
                    <?php $no = 1; foreach ($data as $row): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($row['nama']); ?></td>
                            <td><?= htmlspecialchars($row['nisn']); ?></td>
                            <td><?= htmlspecialchars($row['nomor_hp']); ?></td>
                            <td><?= htmlspecialchars($row['kelas']); ?></td>
                            <td class="action-buttons">
                                        <a href="/siswa/update/<?= $row['id']; ?>" class="btn btn-success">
                                            <i class='bx bx-edit-alt'></i>
                                            <span>Edit</span>
                                        </a>
                                        <a href="/siswa/delete/<?= $row['id']; ?>" 
                                           onclick="return confirm('Apakah Anda yakin ingin menghapus data guru <?= htmlspecialchars($row['nama']); ?>?');"
                                           class="btn btn-danger">
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
</main>


    

    <script src="/assets/js/dashboardadmin.js"></script>
    <script>
        // Add dark mode toggle functionality
        const switchMode = document.getElementById('switch-mode');
        
        switchMode.addEventListener('change', function() {
            if(this.checked) {
                document.body.classList.add('dark');
            } else {
                document.body.classList.remove('dark');
            }
        });
    </script>
</body>
</html>
