<!DOCTYPE html>
<html lang="en">
<?php
use Nekolympus\Project\core\DB;
use Nekolympus\Project\models\LatihanSoal;
use Nekolympus\Project\models\Tugas;

$guruId = $_SESSION['auth'] ?? null;
$GuruName = 'Bapak/Ibu Guru';

if ($guruId) {
    $guru = DB::table('guru')->where('id', '=', $guruId)->first();
    if ($guru && isset($guru['nama'])) {
        $guruName = trim($guru['nama']);
    }
}

	$totalLatsol = LatihanSoal::count();
	$totalTugas = Tugas::count();
	?>


<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<link rel="icon" href="/assets/img/logo.png" type="image/png">
	<link rel="stylesheet" href="/assets/css/dashboardadmin.css">
	<title>Dashboard Admin Page</title>
</head>

<body>

	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="#" class="brand">
			<img src="/assets/img/logo.png" alt="Logo" class="icon" width="60" height="60">
			<span class="text">SDN 1 KALISAT</span>
		</a>
		<ul class="side-menu top">
			<li  class="active">
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
				<a href="/logout-guru" class="logout">
					<i class='bx bx-exit bx-flip-horizontal'></i>
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
			<!-- Ucapan Selamat Datang -->
			<div class="welcome-message">
            <p>Selamat Datang, <strong><?php echo htmlspecialchars($guruName); ?></strong></p>
        </div>

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
					<h1>Dashboard</h1>
					<ul class="breadcrumb">
						<li>
							<a href="/dashboard-admin">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right'></i></li>
						<li>
							<a class="active" href="#">Home</a>
						</li>
					</ul>
				</div>
				<div class="clock-container">
					<div class="clock" id="clock">
						<?php
						echo date("H:i:s"); // Menampilkan waktu server
						?>
					</div>
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
			</ul>


			<div class="table-data">
				<div class="todo">
					<div class="head">
						<h3>Todos</h3>
						<!-- Tombol untuk menambah Todo List -->
						<i class='bx bx-plus' id="addTodoButton"></i>
					</div>

					<!-- Modal Pop-Up untuk menambahkan Todo List -->
					<div id="todoModal" class="modal">
						<div class="modal-content">
							<span class="close">&times;</span>
							<h3>Tambah To-Do List</h3>
							<form id="todoForm">
								<input type="text" id="todoInput" placeholder="Masukkan to-do list..." required>
								<button type="submit" class="btn-submit">Tambahkan</button>
							</form>
						</div>
					</div>

					<!-- Daftar To-Do List -->
					<ul class="todo-list" id="todoList">
						<!-- Items akan ditambahkan di sini -->
					</ul>
				</div>

				<?php
				function build_calendar($month, $year)
				{
					$daysOfWeek = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
					$firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);
					$numberDays = date('t', $firstDayOfMonth);
					$dateComponents = getdate($firstDayOfMonth);
					$monthName = $dateComponents['month'];
					$dayOfWeek = $dateComponents['wday'];

					$calendar = "<table class='calendar'>";
					$calendar .= "<caption>$monthName $year</caption>";
					$calendar .= "<tr>";

					foreach ($daysOfWeek as $day) {
						$calendar .= "<th class='header'>$day</th>";
					}

					$calendar .= "</tr><tr>";

					if ($dayOfWeek > 0) {
						$calendar .= str_repeat("<td class='empty'></td>", $dayOfWeek);
					}

					$currentDay = 1;
					while ($currentDay <= $numberDays) {
						if ($dayOfWeek == 7) {
							$dayOfWeek = 0;
							$calendar .= "</tr><tr>";
						}

						$date = "$year-$month-" . str_pad($currentDay, 2, "0", STR_PAD_LEFT);

						// Modify this section to add events or highlights
						$calendar .= "<td class='day' data-date='$date'>$currentDay</td>";

						$currentDay++;
						$dayOfWeek++;
					}

					if ($dayOfWeek != 7) {
						$remainingDays = 7 - $dayOfWeek;
						$calendar .= str_repeat("<td class='empty'></td>", $remainingDays);
					}

					$calendar .= "</tr>";
					$calendar .= "</table>";
					return $calendar;
				}

				// Mendapatkan bulan dan tahun saat ini
				$month = date('m');
				$year = date('Y');

				// Jika ada request untuk pindah bulan
				if (isset($_GET['month']) && isset($_GET['year'])) {
					$month = $_GET['month'];
					$year = $_GET['year'];
				}

				?>

				<div class="calendar-container">
					<?php
					echo build_calendar($month, $year);
					?>
				</div>
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->

	<script src="/assets/js/dashboardadmin.js"></script>
	<script src="/assets/js/line-cart.js"></script>

</body>

</html>