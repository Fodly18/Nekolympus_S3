<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="/assets/css/dataguruadmin.css">
    <link rel="stylesheet" href="/assets/css/dashboardadmin.css">
    <title>Tambah Mata Pelajaran - Admin Dashboard</title>
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
				<a href="mapelkelas">
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
            <h1>Tambah Jadwal</h1>
            <ul class="breadcrumb">
                <li><a href="/admin">Dashboard</a></li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li><a href="/jadwal">Jadwal</a></li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li><a class="active" href="#">Tambah Jadwal</a></li>
            </ul>
        </div>
    </div>

    <div class="form-container">
        <?php if (isset($errors['system'])): ?>
            <div class="error-message" style="margin-bottom: 1rem;">
                <?= htmlspecialchars($errors['system'][0]) ?>
            </div>
        <?php endif; ?>

        <form action="/jadwal/create" method="post" id="createForm">
            <div class="form-group">
                <label for="id_mapel">Mata Pelajaran</label>
                <select class="form-control" id="id_mapel" name="id_mapel" required>
                    <option value="" disabled selected>Pilih Mata Pelajaran</option>
                    <?php foreach ($mapel as $item): ?>
                        <option value="<?= htmlspecialchars($item->id) ?>">
                            <?= htmlspecialchars($item->nama) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if (isset($errors['id_mapel'])): ?>
                    <?php foreach ($errors['id_mapel'] as $error): ?>
                        <div class="error-message"><?= htmlspecialchars($error) ?></div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="id_kelas">Kelas</label>
                <select class="form-control" id="id_kelas" name="id_kelas" required>
                    <option value="" disabled selected>Pilih Kelas</option>
                    <?php foreach ($kelas as $item): ?>
                        <option value="<?= htmlspecialchars($item->id) ?>">
                            <?= htmlspecialchars($item->nama) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if (isset($errors['id_kelas'])): ?>
                    <?php foreach ($errors['id_kelas'] as $error): ?>
                        <div class="error-message"><?= htmlspecialchars($error) ?></div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="hari">Hari</label>
                <input type="text" class="form-control" id="hari" name="hari" placeholder="Contoh: Senin" required>
                <?php if (isset($errors['hari'])): ?>
                    <?php foreach ($errors['hari'] as $error): ?>
                        <div class="error-message"><?= htmlspecialchars($error) ?></div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="jam_mulai">Jam Mulai</label>
                <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" required>
                <?php if (isset($errors['jam_mulai'])): ?>
                    <?php foreach ($errors['jam_mulai'] as $error): ?>
                        <div class="error-message"><?= htmlspecialchars($error) ?></div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="jam_selesai">Jam Selesai</label>
                <input type="time" class="form-control" id="jam_selesai" name="jam_selesai" required>
                <?php if (isset($errors['jam_selesai'])): ?>
                    <?php foreach ($errors['jam_selesai'] as $error): ?>
                        <div class="error-message"><?= htmlspecialchars($error) ?></div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

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
        switchMode.addEventListener('change', function() {
            if (this.checked) {
                document.body.classList.add('dark');
            } else {
                document.body.classList.remove('dark');
            }
        });
    </script>
</body>
</html>
