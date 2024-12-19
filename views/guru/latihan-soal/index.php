<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="/assets/css/dashboardadmin.css">
	<link rel="stylesheet" href="/assets/css/tablestyle.css">
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
			<li>
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
			<li class="active">
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
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
				</div>
			</form>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
			<a href="#" class="profile">
				<a href="/settings" class="profile">
					<img src="img/people.png">
				</a>
			</a>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Latihan Soal</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Latihan Soal</a>
						</li>
						<li><i class='bx bx-chevron-right'></i></li>
						<li>
							<a class="active" href="#">Beranda</a>
						</li>
					</ul>
				</div>
				<a href="/latihan-soal/create" class="btn btn-primary">
					<i class='bx bx-plus'></i>
					<span>Tambah Latihan Soal</span>
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
							<th>Judul Soal</th>
							<th>Jumlah Soal</th>
							<th>Tgl Soal</th>
							<th>Tgl Deadline</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php if (empty($data)): ?>
							<tr>
								<td colspan="6" class="empty-state">
									<i class='bx bx-folder-open'></i>
									<p>Belum Ada Latihan Soal Yang Tersedia</p>
								</td>
							</tr>
						<?php else: ?>
							<?php foreach ($data as $row): ?>
								<tr>
									<td align="center"><?= $no++; ?></td>
									<td align="center"><?= htmlspecialchars($row['judul_soal']); ?></td>
									<td align="center"><?= htmlspecialchars($row['jumlah_soal']); ?></td>
									<td align="center"><?= htmlspecialchars($row['tanggal_soal']); ?></td>
									<td align="center"><?= htmlspecialchars($row['deadline']); ?></td>
									<td align="center" class="action-buttons">
										<a href="/latihan-soal/update/<?= $row['id']; ?>" class="btn btn-success">
											<i class='bx bx-edit-alt'></i>
											<span>Edit</span>
										</a>
										<a href="#"
											onclick="confirmDelete('/latihan-soal/delete/<?= $row['id']; ?>');"
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
		<!-- MAIN -->
	</section>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="/assets/js/dashboardadmin.js"></script>\	
</body>
</html>