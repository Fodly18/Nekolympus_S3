<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="/assets/css/dataguruadmin.css">
    <link rel="stylesheet" href="/assets/css/dashboardadmin.css">
    <title>Data Guru - Admin Dashboard</title>
</head>
<body>
    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="/admin" class="brand">
            <i class='bx bxs-school'></i>
            <span class="text">SDN 1 KALISAT</span>
        </a>
		<ul class="side-menu top">
			<li>
				<a href="/dashboard-admin">
					<i class='bx bxs-dashboard'></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li class="active">
				<a href="/guru">
					<i class='bx bxs-group' ></i>
					<span class="text">Guru</span>
				</a>
			</li>
			<li>
				<a href="/siswa">
					<i class='bx bxs-group' ></i>
					<span class="text">Siswa</span>
				</a>
			</li>
			<li>
				<a href="/berita">
					<i class='bx bxs-news' ></i>
					<span class="text">Berita</span>
				</a>
			</li>
			<li>
				<a href="/ppdb">
					<i class='bx bxs-news' ></i>
					<span class="text">PPDB</span>
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
					<i class='bx bxs-receipt' ></i>
					<span class="text">Mapel</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-receipt' ></i>
					<span class="text">Mapel-Kelas</span>
				</a>
			</li>
			<li>
				<a href="#">
					<i class='bx bxs-receipt' ></i>
					<span class="text">Jadwal</span>
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
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Cari guru...">
                    <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <input type="checkbox" id="switch-mode" hidden>
            <label for="switch-mode" class="switch-mode"></label>
            <a href="#" class="profile">
                <img src="/assets/img/people.png" alt="Profile">
            </a>
        </nav>

        <!-- MAIN -->
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Data Guru</h1>
                    <ul class="breadcrumb">
                        <li><a href="/admin">Dashboard</a></li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li><a class="active" href="#">Data Guru</a></li>
                    </ul>
                </div>
                <a href="/guru/create" class="btn btn-primary">
                    <i class='bx bx-plus'></i>
                    <span>Tambah Guru</span>
                </a>
            </div>

            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Nomor HP</th>
                            <th>NIP</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($data)): ?>
                            <tr>
                                <td colspan="5" class="empty-state">
                                    <i class='bx bx-folder-open'></i>
                                    <p>Belum ada data guru tersedia</p>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php $no = 1; foreach ($data as $row): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= htmlspecialchars($row['nama']); ?></td>
                                    <td><?= htmlspecialchars($row['nomor_hp']); ?></td>
                                    <td><?= htmlspecialchars($row['nip']); ?></td>
                                    <td class="action-buttons">
                                        <a href="/guru/update/<?= $row['id']; ?>" class="btn btn-success">
                                            <i class='bx bx-edit-alt'></i>
                                            <span>Edit</span>
                                        </a>
                                        <a href="/guru/delete/<?= $row['id']; ?>" 
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
    </section>

    <script src="/assets/js/dashboardadmin.js"></script>
</body>
</html>
