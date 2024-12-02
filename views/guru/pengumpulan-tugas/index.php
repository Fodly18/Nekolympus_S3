<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="/assets/css/dashboardadmin.css">
	<link rel="stylesheet" href="/assets/css/tablestyle.css">
	<style>
		.select {
			display: inline-block;
			width: auto;
			min-width: 600px;
			align-items: center;
			justify-content: center;
			margin-top: 10px;
			padding: 8px 12px;
			color: #333;
			background-color: #eee;
			border: 2px solid #bbb;
			cursor: pointer;
			border-radius: 5px;
			font-size: 14px;
			text-align: left;
			text-align-last: center;
			transition: border-color 0.3s ease;
		}

		.select:focus,
		.select:hover {
			outline: none;
			border: 2px solid #169dea;
		}

		.select option {
			background: #fff;
			color: #333;
			padding: 4px;
			text-align: left;
		}

		.btn-select{
			margin-left: 16px;
			padding: 8px 12px;
			color: #eee;
			background-color: #169dea;
			font-size: 14px;
			cursor: pointer;
			border: 2px solid #169dea;
			border-radius: 10px;
		}
	</style>
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
				<d class="left">
					<h1>Pengumpulan Tugas</h1>
					<ul class="breadcrumb">
						<li><a href="#">Pengumpulan Tugas</a></li>
						<li><i class='bx bx-chevron-right'></i></li>
						<li><a class="active" href="#">Daftar Tugas</a></li>
					</ul>
					<form action="/pengumpulan-tugas/filter" method="POST">
						<select class="select" name="filter">
							<option disabled selected value="">-- Pilih Judul Tugas --</option>
							<?php foreach($data as $row) :?>
								<option value=""><?= $row['judul_tugas'] ?></option>
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
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php if (empty($asd)): ?>
							<tr>
								<td colspan="5" class="empty-state">
									<i class='bx bx-folder-open'></i>
									<p>Belum Ada Siswa Yang Mengumpulkan Tugas</p>
								</td>
							</tr>
						<?php else: ?>
							<?php foreach ($asd as $row): ?>
								<tr>
									<td><?= $no++; ?></td>
									<td><?= htmlspecialchars($row['asd'] ?? 'Tidak Ditemukan'); ?></td>
									<td><?= htmlspecialchars($row['asd'] ?? 'Tidak Ditemukan'); ?></td>
									<td><?= htmlspecialchars($row['asd']); ?></td>
									<td class="action-buttons">
										<a href="/tugas-pembelajaran/update/<?= $row['id']; ?>" class="btn btn-success">
											<i class='bx bx-edit-alt'></i>
											<span>Tamppilkan</span>
										</a>
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

	<script src="/assets/js/dashboardguru.js"></script>
</body>

</html>