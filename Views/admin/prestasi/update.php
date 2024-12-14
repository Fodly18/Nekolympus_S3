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
			<li >
				<a href="/dashboard-admin">
					<i class='bx bxs-dashboard'></i>
					<span class="text">Dashboard</span>
				</a>
			</li>
            <li>
				<a href="/Acara_sekolah">
					<i class='bx bxs-photo-album' ></i>
					<span class="text">Acara_sekolah</span>
				</a>
			</li>
            <li class="active">
				<a href="/Prestasi">
					<i class='bx bxs-trophy' ></i>
					<span class="text">Prestasi</span>
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
			<a href="#" class="nav-link">Categories</a>
			<form action="#">
				<div class="form-input">
					<input type="search" placeholder="Search...">
					<button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
				</div>
			</form>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
			<a href="#" class="notification">
				<i class='bx bxs-bell'></i>
				<span class="num">8</span>
			</a>
			<a href="#" class="profile">
				<img src="img/people.png">
			</a>
		</nav>
		<!-- NAVBAR -->
		<!-- MAIN -->
<main>
    <div class="head-title">
        <div class="left">
            <h1>Edit Prestasi</h1>
            <ul class="breadcrumb">
                <li><a href="/admin">Dashboard</a></li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li><a href="/Acara_sekolah">Gallery</a></li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li><a class="active" href="#">Edit Prestasi</a></li>
            </ul>
        </div>
    </div>

    <div class="form-container">
        <?php if (isset($errors['system'])): ?>
            <div class="error-message" style="margin-bottom: 1rem;">
                <?= htmlspecialchars($errors['system'][0]) ?>
            </div>
        <?php endif; ?>

        <form action="/Prestasi/update" method="post" id="updateForm" onsubmit="return validateForm()" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= htmlspecialchars($data->id) ?>">

    <!-- Input Judul -->
    <div class="form-group">
        <label for="judul">Judul</label>
        <input type="text" class="form-control" id="judul" name="judul" required maxlength="255" value="<?= htmlspecialchars($data->judul) ?>">
        <?php if (isset($errors['judul'])): ?>
            <?php foreach ($errors['judul'] as $error): ?>
                <div class="error-message"><?= htmlspecialchars($error) ?></div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!-- Input Konten -->
    <div class="form-group">
        <label for="konten">Konten</label>
        <textarea class="form-control" id="konten" name="konten" rows="8" required><?= htmlspecialchars($data->konten) ?></textarea>
        <?php if (isset($errors['konten'])): ?>
            <?php foreach ($errors['konten'] as $error): ?>
                <div class="error-message"><?= htmlspecialchars($error) ?></div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!-- Input Tanggal -->
    <div class="form-group">
        <label for="tanggal">Tanggal</label>
        <input type="date" class="form-control" id="tanggal" name="tanggal" required value="<?= htmlspecialchars($data->tanggal) ?>">
        <?php if (isset($errors['tanggal'])): ?>
            <?php foreach ($errors['tanggal'] as $error): ?>
                <div class="error-message"><?= htmlspecialchars($error) ?></div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!-- Upload Foto -->
    <div class="form-group">
        <label for="img">Upload Foto</label>
        <input type="file" class="form-control" id="img" name="img" accept="image/*">
        <?php if (!empty($data->img)): ?>
            <br>
            <p>Foto Saat Ini:</p>
            <img src="<?= htmlspecialchars($data->img) ?>" alt="Gambar saat ini" style="max-width: 30%; height: auto; margin-top: 10px;">
        <?php else: ?>
            <p style="color: gray;">Tidak ada gambar yang diunggah sebelumnya.</p>
        <?php endif; ?>
        <?php if (isset($errors['img'])): ?>
            <?php foreach ($errors['img'] as $error): ?>
                <div class="error-message"><?= htmlspecialchars($error) ?></div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!-- Upload Foto Sertifikat -->
    <div class="form-group">
        <label for="img_sertifikat">Upload Foto Sertifikat</label>
        <input type="file" class="form-control" id="img_sertifikat" name="img_sertifikat" accept="image/*">
        <?php if (!empty($data->img_sertifikat)): ?>
            <br>
            <p>Foto Sertifikat Saat Ini:</p>
            <img src="<?= htmlspecialchars($data->img_sertifikat) ?>" alt="Gambar sertifikat saat ini" style="max-width: 30%; height: auto; margin-top: 10px;">
        <?php else: ?>
            <p style="color: gray;">Tidak ada sertifikat yang diunggah sebelumnya.</p>
        <?php endif; ?>
        <?php if (isset($errors['img_sertifikat'])): ?>
            <?php foreach ($errors['img_sertifikat'] as $error): ?>
                <div class="error-message"><?= htmlspecialchars($error) ?></div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <!-- Tombol Submit -->
    <div class="form-button">
        <button type="submit" class="btn btn-primary">
            <i class='bx bx-save'></i>
            <span>Simpan Perubahan</span>
        </button>
        <a href="/Prestasi" class="btn btn-danger">
            <i class='bx bx-x'></i>
            <span>Batal</span>
        </a>
    </div>
</form>


    </div>
</main>


	</section>
	<!-- CONTENT -->
	<script src="/assets/js/dashboardadmin.js"></script>
	<script src="/assets/js/line-cart.js"></script>

</body>
</html>
