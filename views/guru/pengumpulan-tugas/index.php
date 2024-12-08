<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="/assets/css/dashboardadmin.css">
	<link rel="stylesheet" href="/assets/css/tablestyle.css">
	<title>Dashboard Guru Page</title>
</head>

<body>
	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="/dashboard-guru" class="brand">
			<i class='bx bxs-smile'></i>
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
			<li class="active">
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
				<a href="/settings">
					<i class='bx bxs-cog'></i>
					<span class="text">Settings</span>
				</a>
			</li>
			<li>
				<a href="/logout-guru" class="logout">
					<i class='bx bxs-log-out-circle'></i>
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
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Pengumpulan Tugas</h1>
					<ul class="breadcrumb">
						<li><a href="#">Pengumpulan Tugas</a></li>
						<li><i class='bx bx-chevron-right'></i></li>
						<li><a class="active" href="#">Daftar Tugas</a></li>
					</ul>
					<form action="/pengumpulan-tugas/filter" method="POST">
						<select class="select" name="filter">
							<option disabled selected value="">-- Pilih Judul Tugas --</option>
							<?php foreach ($data as $row) : ?>
								<option value="<?= $row['id']; ?>"><?= $row['judul_tugas'] ?></option>
							<?php endforeach; ?>
						</select>
						<button class="btn-select">Pilih Judul</button>
					</form>
				</div>
			</div>

			<div class="table-container">
				<table class="data-table">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Siswa</th>
							<th>Kelas</th>
							<th>Tanggal Mengumpulkan</th>
							<th>Nilai Tugas</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php if (empty($dataTugas)): ?>
							<tr>
								<td colspan="6" class="empty-state">
									<i class='bx bx-folder-open'></i>
									<p>Belum Ada Siswa Yang Mengumpulkan Tugas</p>
								</td>
							</tr>
						<?php else: ?>
							<?php foreach ($dataTugas as $row): ?>
								<tr>
									<td><?= $no++; ?></td>
									<td><?= htmlspecialchars($row['nama'] ?? 'Tidak Ditemukan'); ?></td>
									<td><?= htmlspecialchars($row['kelas'] ?? 'Tidak Ditemukan'); ?></td>
									<td><?= htmlspecialchars($row['tanggal']); ?></td>
									<td><?= htmlspecialchars($row['grade'] ?? 'Belum Dinilai'); ?></td>
									<td class="action-buttons">
										<a href="/pengumpulan-tugas/show/<?= $row['id']; ?>" class="btn btn-success" id="btn-show-tugas">
											<i class='bx bx-edit-alt'></i>
											<span class="show-tugas">Tampilkan</span>
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
	<script src="/assets/js/dashboardguru.js"></script>
</body>

</html>