<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/dataguruadmin.css">
    <link rel="stylesheet" href="/assets/css/dashboardadmin.css">
    <title>Data Mata Pelajaran - Admin Dashboard</title>
</head>
<body>
    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="/admin" class="brand">
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
					<i class='bx bxs-group' ></i>
					<span class="text">Guru</span>
				</a>
			</li>
			<li>
				<a href="/kelas">
					<i class='bx bxs-news' ></i>
					<span class="text">Kelas</span>
				</a>
			</li>
			<li>
				<a href="/mapel">
					<i class='bx bxs-book-content' ></i>
					<span class="text">Mapel</span>
				</a>
			</li>
			<li>
				<a href="/mapelkelas">
					<i class='bx bx-book-open' ></i>
					<span class="text">Mapel-Kelas</span>
				</a>
			</li>
			<li class="active">
				<a href="/jadwal">
					<i class='bx bxs-book' ></i>
					<span class="text">Jadwal</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="/logout-admin" class="logout">
					<i class='bx bxs-log-out-circle' ></i>
					<span class="text">Logout</span>
				</a>
			</li>
		</ul>
    </section>

    <!-- CONTENT -->
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
            <h1>Data Jadwal</h1>
            <ul class="breadcrumb">
                <li><a href="/admin">Dashboard</a></li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li><a class="active" href="#">Data Jadwal</a></li>
            </ul>
        </div>
        <a href="/jadwal/create" class="btn btn-primary">
            <i class='bx bx-plus'></i>
            <span>Tambah Jadwal</span>
        </a>
    </div>

    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Mata Pelajaran</th>
                    <th>Nama Kelas</th>
                    <th>Nama Guru</th>
                    <th>Hari</th>
                    <th>Jam</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($data)): ?>
                    <tr>
                        <td colspan="7" class="empty-state">
                            <i class='bx bx-folder-open'></i>
                            <p>Belum ada data Jadwal tersedia</p>
                        </td>
                    </tr>
                <?php else: ?>
                    <?php $no = 1; foreach ($data as $row): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($row['nama_mapel']); ?></td>
                            <td><?= htmlspecialchars($row['nama_kelas']); ?></td>
                            <td><?= htmlspecialchars($row['nama_guru']); ?></td>
                            <td><?= htmlspecialchars($row['hari']); ?></td>
                            <td><?= htmlspecialchars($row['jam_mulai']) . " - " . htmlspecialchars($row['jam_selesai']); ?></td>
                            <td class="action-buttons">
                                <a href="/jadwal/update/<?= $row['id']; ?>" class="btn btn-success">
                                    <i class='bx bx-edit-alt'></i>
                                    <span>Edit</span>
                                </a>
                                <a href="/jadwal/delete/<?= $row['id']; ?>"
                                   onclick="return confirm('Apakah Anda yakin ingin menghapus data Jadwal ini?');"
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

    </section>

    <script src="/assets/js/dashboardadmin.js"></script>
    <script>
        const switchMode = document.getElementById('switch-mode');
        switchMode.addEventListener('change', function () {
            document.body.classList.toggle('dark', this.checked);
        });
    </script>
</body>
</html>
