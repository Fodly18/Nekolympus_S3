<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="/assets/css/dashboardberita.css">
	<title>Dashboard Guru Page</title>
	<style>
		/* Warna tombol "Kembali" */
		.btn-cancel {
			background-color: white !important;
			/* Latar belakang putih */
			color: black !important;
			/* Teks hitam */
			border: 1px solid black !important;
			/* Garis tepi hitam */
		}

		/* Warna tombol "Hapus" */
		.btn-confirm {
			background-color: #cc183c;
			/* Latar belakang merah */
			color: white !important;
			/* Teks putih */
		}
	</style>
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
				<a href="/dashboard-guru">
					<i class='bx bxs-dashboard'></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
			<li class="active">
				<a href="/tugas-pembelajaran">
					<i class='bx bxs-doughnut-chart'></i>
					<span class="text">Tugas</span>
				</a>
			</li>
			<li>
				<a href="/pengumpulan-tugas">
					<i class='bx bxs-shopping-bag-alt'></i>
					<span class="text">Pengumpulan Tugas</span>
				</a>
			</li>
			<li>
				<a href="/latihan-soal">
					<i class='bx bxs-book-content'></i>
					<span class="text">Latihan Soal</span>
				</a>
			</li>
			<li>
				<a href="/penilaian-latihan-soal">
					<i class='bx bx-task'></i>
					<span class="text">Penilaian Latihan Soal</span>
				</a>
			</li>
		</ul>
		<ul class="side-menu">
			<li>
				<a href="/logout-guru" class="logout">
					<i class='bx bx-exit bx-flip-horizontal'></i>
					<span class="text">Logout</span>
				</a>
			</li>
		</ul>
	</section>
	<!-- SIDEBAR -->

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
					<h1>Data Tugas</h1>
					<ul class="breadcrumb">
						<li><a href="/dashboard-guru">Dashboard</a></li>
						<li><i class='bx bx-chevron-right'></i></li>
						<li><a class="active" href="#">Tabel Tugas</a></li>
					</ul>
				</div>
				<a href="/tugas-pembelajaran/create" class="btn btn-primary">
					<i class='bx bx-plus'></i>
					<span>Tambah Tugas</span>
				</a>
			</div>

			<div class="search-bar-container">
				<i class="bx bx-search"></i>
				<input type="text" id="search-input" placeholder="Cari judul...">
				<button type="button" id="search-button">Search</button>
			</div>

			<div class="table-container">
				<table class="data-table">
					<thead>
						<tr>
							<th>No</th>
							<th>Mata Pelajaran</th>
							<th>Kelas</th>
							<th>Judul Tugas</th>
							<th>Deskripsi</th>
							<th>Tanggal Tugas</th>
							<th>Deadline Tugas</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php if (empty($data)): ?>
							<tr>
								<td colspan="8" class="empty-state">
									<i class='bx bx-folder-open'></i>
									<p>Belum Ada Tugas Yang Tersedia</p>
								</td>
							</tr>
						<?php else: ?>
							<?php foreach ($data as $row): ?>
								<tr>
									<td align="center"><?= $no++; ?></td>
									<td align="center"><?= htmlspecialchars($row['nama'] ?? 'Tidak Ditemukan'); ?></td>
									<td align="center"><?= htmlspecialchars($row['kelas'] ?? 'Tidak Ditemukan'); ?></td>
									<td align="center"><?= htmlspecialchars($row['judul_tugas']); ?></td>
									<td><?= htmlspecialchars($row['deskripsi']); ?></td>
									<td align="center"><?= htmlspecialchars($row['tanggal_tugas']); ?></td>
									<td align="center"><?= htmlspecialchars($row['deadline']); ?></td>
									<td align="center" class="action-buttons">
										<a href="/tugas-pembelajaran/update/<?= $row['id']; ?>" class="btn btn-success">
											<i class='bx bx-edit-alt'></i>
											<span>Edit</span>
										</a>
										<a href="#"
											onclick="confirmDelete('/tugas-pembelajaran/delete/<?= $row['id']; ?>');"
											class="btn btn-danger">
											<i class='bx bx-trash'></i>
											<span>Hapus</span>
										</a>
										<script>
											function confirmDelete(deleteUrl) {
												swal("Apakah Anda Yakin Ingin Menghapus Data Ini?", {
														buttons: {
															cancel: {
																text: "Kembali",
																value: null,
																visible: true,
																className: "btn-cancel",
															},
															confirm: {
																text: "Hapus",
																value: true,
																visible: true,
																className: "btn-confirm",
															},
														},
													})
													.then((willDelete) => {
														if (willDelete) {
															window.location.href = deleteUrl;
														} else {
															swal("Data tidak jadi dihapus!", {
																icon: "info",
																timer: 2000,
																buttons: false,
															});
														}
													});
											}
										</script>
									</td>
								</tr>
							<?php endforeach; ?>
						<?php endif; ?>
					</tbody>
				</table>

			</div>
		</main>
	</section>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="/assets/js/paket-tabel.js"></script>
</body>

</html>