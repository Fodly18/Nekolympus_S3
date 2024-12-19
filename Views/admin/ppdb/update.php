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
			<li>
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
			<li class="active">
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
					<h1>Edit Poster PPDB</h1>
					<ul class="breadcrumb">
						<li><a href="/admin">Dashboard</a></li>
						<li><i class='bx bx-chevron-right'></i></li>
						<li><a href="/#">Gallery</a></li>
						<li><i class='bx bx-chevron-right'></i></li>
						<li><a href="/Ppdb">PPDB</a></li>
						<li><i class='bx bx-chevron-right'></i></li>
						<li><a class="active" href="#">Edit Poster PPDB</a></li>
					</ul>
				</div>
			</div>

			<div class="form-container">
    <?php if (isset($errors['system'])): ?>
        <div class="warning-message mb-3">
            <?= htmlspecialchars($errors['system'][0]) ?>
        </div>
    <?php endif; ?>

    <form action="/Ppdb/update" method="post" id="updateForm" onsubmit="return validateForm()" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= htmlspecialchars($data->id ?? '') ?>">

        <!-- Tanggal Mulai -->
        <div class="form-group">
            <label for="tanggal_mulai">Tanggal Mulai:</label>
            <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" required value="<?= htmlspecialchars($data->tanggal_mulai ?? '') ?>">
            <?php if (isset($errors['tanggal_mulai'])): ?>
                <div class="error-message"><?= htmlspecialchars(implode(', ', $errors['tanggal_mulai'])) ?></div>
            <?php endif; ?>
        </div>

        <!-- Tanggal Selesai -->
        <div class="form-group">
            <label for="tanggal_selesai">Tanggal Selesai:</label>
            <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" required value="<?= htmlspecialchars($data->tanggal_selesai ?? '') ?>">
            <?php if (isset($errors['tanggal_selesai'])): ?>
                <div class="error-message"><?= htmlspecialchars(implode(', ', $errors['tanggal_selesai'])) ?></div>
            <?php endif; ?>
        </div>

        <!-- Upload Foto -->
        <div class="form-group">
            <label for="img">Upload Foto:</label>
            <input type="file" class="form-control" id="img" name="img" accept="image/*">
            <?php if (!empty($data->img)): ?>
                <p>Gambar saat ini:</p>
                <img src="<?= htmlspecialchars($data->img ?? '') ?>" alt="Gambar saat ini" style="max-width: 20%; height: auto; margin-top: 10px;">
            <?php endif; ?>
            <?php if (isset($errors['img'])): ?>
                <div class="error-message"><?= htmlspecialchars(implode(', ', $errors['img'])) ?></div>
            <?php endif; ?>
        </div>

        <!-- Submit & Cancel Buttons -->
        <div class="form-button">
            <button type="submit" class="btn btn-primary">
                <i class='bx bx-save'></i>
                <span>Simpan Perubahan</span>
            </button>
            <a href="/Ppdb" class="btn btn-danger">
                <i class='bx bx-x'></i>
                <span>Batal</span>
            </a>
        </div>
    </form>
</div>

	<!-- CONTENT -->
	<script src="/assets/js/dashboardadmin.js"></script>
	<script src="/assets/js/line-cart.js"></script>
    <script>
        function validateForm() {
            const tanggalMulai = document.getElementById('tanggal_mulai').value;
            const tanggalSelesai = document.getElementById('tanggal_selesai').value;

            if (new Date(tanggalMulai) > new Date(tanggalSelesai)) {
                document.querySelector('.warning-message').innerText = 'Tanggal mulai tidak boleh lebih besar dari tanggal selesai!';
                return false;
            }

            return true;
        }
    </script>
</body>
</html>
