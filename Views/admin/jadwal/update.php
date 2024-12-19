<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="/assets/css/dataguruadmin.css">
    <link rel="stylesheet" href="/assets/css/dashboardadmin.css">
    <title>Edit Mata Pelajaran - Admin Dashboard</title>
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
            <h1>Update Jadwal</h1>
            <ul class="breadcrumb">
                <li><a href="/admin">Dashboard</a></li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li><a href="/jadwal">Jadwal</a></li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li><a class="active" href="#">Update Jadwal</a></li>
            </ul>
        </div>
    </div>

    <div class="form-container">
        <!-- Pesan error sistem -->
        <?php if (isset($errors['system'])): ?>
            <div class="error-message" style="margin-bottom: 1rem;">
                <?= htmlspecialchars($errors['system'][0]) ?>
            </div>
        <?php endif; ?>

        <!-- Form Update Jadwal -->
        <form action="/jadwal/update/<?= htmlspecialchars($jadwal['id']); ?>" method="post" id="updateForm">
            <!-- Pilih Mata Pelajaran -->
            <div class="form-group">
                <label for="mapel_id">Mata Pelajaran</label>
                <select name="mapel_id" id="mapel_id" class="form-control" required>
                    <option value="" disabled>Pilih Mata Pelajaran</option>
                    <?php foreach ($mapel as $m): ?>
                        <option value="<?= htmlspecialchars($m['id']) ?>" <?= $jadwal['mapel_id'] == $m['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($m['nama']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if (isset($errors['mapel_id'])): ?>
                    <?php foreach ($errors['mapel_id'] as $error): ?>
                        <div class="error-message"><?= htmlspecialchars($error) ?></div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- Pilih Kelas -->
            <div class="form-group">
                <label for="kelas_id">Kelas</label>
                <select name="kelas_id" id="kelas_id" class="form-control" required>
                    <option value="" disabled>Pilih Kelas</option>
                    <?php foreach ($kelas as $k): ?>
                        <option value="<?= htmlspecialchars($k['id']) ?>" <?= $jadwal['kelas_id'] == $k['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($k['nama']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if (isset($errors['kelas_id'])): ?>
                    <?php foreach ($errors['kelas_id'] as $error): ?>
                        <div class="error-message"><?= htmlspecialchars($error) ?></div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- Pilih Guru -->
            <div class="form-group">
                <label for="guru_id">Guru</label>
                <select name="guru_id" id="guru_id" class="form-control" required>
                    <option value="" disabled>Pilih Guru</option>
                    <?php foreach ($guru as $g): ?>
                        <option value="<?= htmlspecialchars($g['id']) ?>" <?= $jadwal['guru_id'] == $g['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($g['nama']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if (isset($errors['guru_id'])): ?>
                    <?php foreach ($errors['guru_id'] as $error): ?>
                        <div class="error-message"><?= htmlspecialchars($error) ?></div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- Pilih Hari -->
            <div class="form-group">
                <label for="hari">Hari</label>
                <select name="hari" id="hari" class="form-control" required>
                    <option value="" disabled>Pilih Hari</option>
                    <?php foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $hari): ?>
                        <option value="<?= $hari ?>" <?= $jadwal['hari'] == $hari ? 'selected' : '' ?>>
                            <?= $hari ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if (isset($errors['hari'])): ?>
                    <?php foreach ($errors['hari'] as $error): ?>
                        <div class="error-message"><?= htmlspecialchars($error) ?></div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- Jam Mulai dan Jam Selesai -->
            <div class="form-group">
                <label for="jam_mulai">Jam Mulai</label>
                <input type="time" name="jam_mulai" id="jam_mulai" class="form-control" value="<?= htmlspecialchars($jadwal['jam_mulai']); ?>" required>
                <?php if (isset($errors['jam_mulai'])): ?>
                    <?php foreach ($errors['jam_mulai'] as $error): ?>
                        <div class="error-message"><?= htmlspecialchars($error) ?></div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="jam_selesai">Jam Selesai</label>
                <input type="time" name="jam_selesai" id="jam_selesai" class="form-control" value="<?= htmlspecialchars($jadwal['jam_selesai']); ?>" required>
                <?php if (isset($errors['jam_selesai'])): ?>
                    <?php foreach ($errors['jam_selesai'] as $error): ?>
                        <div class="error-message"><?= htmlspecialchars($error) ?></div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <!-- Tombol Aksi -->
            <div class="btn-container">
                <button type="submit" class="btn btn-primary">
                    <i class='bx bx-save'></i>
                    <span>Simpan</span>
                </button>
                <a href="/jadwal" class="btn btn-danger">
                    <i class='bx bx-x'></i>
                    <span>Batal</span>
                </a>
            </div>
        </form>
    </div>
</main>


    </section>

    <script src="/assets/js/dashboardadmin.js"></script>
    <script>
        // Toggle dark mode
        const switchMode = document.getElementById('switch-mode');
        switchMode.addEventListener('change', function () {
            document.body.classList.toggle('dark', this.checked);
        });
    </script>
</body>
</html>
