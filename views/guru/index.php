<!DOCTYPE html>
<html lang="en">
<?php

use Nekolympus\Project\models\LatihanSoal;
use Nekolympus\Project\models\Tugas;

$totalLatsol = LatihanSoal::count();
$totalTugas = Tugas::count();


$currentDate = date('l, d F Y');
$currentTime = date('H:i:s');

?>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<link rel="stylesheet" href="/assets/css/dashboardadmin.css">
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
			<li class="active">
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
					<h1>Dashboard</h1>
					<ul class="breadcrumb">
						<li>
							<a href="#">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right'></i></li>
						<li>
							<a class="active" href="#">Home</a>
						</li>
					</ul>
				</div>
			</div>

			<ul class="box-info">
				<li>
					<i class='bx bxs-calendar-check'></i>
					<span class="text">
						<p>Jumlah Tugas</p>
						<h3><?= htmlspecialchars($totalTugas, ENT_QUOTES, 'UTF-8'); ?></h3>
					</span>
				</li>
				<li>
					<i class='bx bxs-group'></i>
					<span class="text">
						<p>Jumlah Latihan Soal</p>
						<h3><?= htmlspecialchars($totalLatsol, ENT_QUOTES, 'UTF-8'); ?></h3>
					</span>
				</li>
				<li>
					<i class='bx bxs-time-five'></i>
					<span class="text">
						<h3 id="current-time"></h3>
						<p id="current-date"></p>
					</span>
				</li>
			</ul>

			<div class="jdwl-border">
				<h2>Jadwal Hari Ini</h2>
				<table>
					<thead>
						<tr>
							<th>Mata Pembelajaran</th>
							<th>Kelas</th>
							<th>Jam</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td data-label="Mata Pembelajaran">Matematika</td>
							<td data-label="Kelas">5A</td>
							<td data-label="Jam">08:00 - 09:30</td>
						</tr>
						<tr>
							<td data-label="Mata Pembelajaran">Bahasa Indonesia</td>
							<td data-label="Kelas">5B</td>
							<td data-label="Jam">09:30 - 11:00</td>
						</tr>
					</tbody>

				</table>
			</div>
			</div>
		</main>
		<!-- MAIN -->
	</section>

	<script src="/assets/js/dashboardguru.js"></script>
</body>

</html>