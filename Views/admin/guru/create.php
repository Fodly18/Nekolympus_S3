<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="/assets/css/dataguruadmin.css">
    <link rel="stylesheet" href="/assets/css/dashboardadmin.css">
    <title>Tambah Data Guru - Admin Dashboard</title>
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
			<li class="active">
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
			<li>
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
                    <h1>Tambah Data Guru</h1>
                    <ul class="breadcrumb">
                        <li><a href="/admin">Dashboard</a></li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li><a href="/guru">Data Guru</a></li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li><a class="active" href="#">Tambah Guru</a></li>
                    </ul>
                </div>
            </div>

            <div class="form-container">
                <?php if (isset($errors['system'])): ?>
                    <div class="error-message" style="margin-bottom: 1rem;">
                        <?= htmlspecialchars($errors['system'][0]) ?>
                    </div>
                <?php endif; ?>

                <form action="/guru/create" method="post" id="createForm" onsubmit="return validateForm()">
                    <div class="form-group">
                        <label for="nip">NIP</label>
                        <input type="text" class="form-control" id="nip" name="nip" required 
                               pattern="[0-9]{18}" maxlength="18" aria-describedby="nipHint">
                        <div id="nipHint" class="form-hint">NIP harus 18 digit angka</div>
                        <?php if (isset($errors['nip'])): ?>
                            <?php foreach ($errors['nip'] as $error): ?>
                                <div class="error-message"><?= htmlspecialchars($error) ?></div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama" name="nama" required 
                               maxlength="100" aria-describedby="namaHint">
                        <div id="namaHint" class="form-hint">Masukkan nama lengkap</div>
                        <?php if (isset($errors['nama'])): ?>
                            <?php foreach ($errors['nama'] as $error): ?>
                                <div class="error-message"><?= htmlspecialchars($error) ?></div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="nomor_hp">Nomor HP</label>
                        <input type="tel" class="form-control" id="nomor_hp" name="nomor_hp" required 
                               pattern="[0-9]{10,13}" maxlength="13" aria-describedby="nomorHpHint">
                        <div id="nomorHpHint" class="form-hint">Nomor HP harus 10-13 digit angka</div>
                        <?php if (isset($errors['nomor_hp'])): ?>
                            <?php foreach ($errors['nomor_hp'] as $error): ?>
                                <div class="error-message"><?= htmlspecialchars($error) ?></div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required 
                               minlength="6" aria-describedby="passwordHint">
                        <div id="passwordHint" class="form-hint">Password minimal 6 karakter</div>
                        <?php if (isset($errors['password'])): ?>
                            <?php foreach ($errors['password'] as $error): ?>
                                <div class="error-message"><?= htmlspecialchars($error) ?></div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <div class="btn-container">
                        <button type="submit" class="btn btn-primary">
                            <i class='bx bx-save'></i>
                            <span>Simpan</span>
                        </button>
                        <a href="/guru" class="btn btn-danger">
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
        // Add dark mode toggle functionality
        const switchMode = document.getElementById('switch-mode');
        
        switchMode.addEventListener('change', function() {
            document.body.classList.toggle('dark', this.checked);
        });

        // Form validation
        function validateForm() {
            const nip = document.getElementById('nip').value;
            const nomor_hp = document.getElementById('nomor_hp').value;
            const password = document.getElementById('password').value;

            // Validate NIP
            if (!/^[0-9]{18}$/.test(nip)) {
                alert('NIP harus 18 digit angka');
                return false;
            }

            // Validate phone number
            if (!/^[0-9]{10,13}$/.test(nomor_hp)) {
                alert('Nomor HP harus berupa 10-13 digit angka');
                return false;
            }

            // Validate password
            if (password.length < 6) {
                alert('Password minimal 6 karakter');
                return false;
            }

            return true;
        }

        // Add input event listeners for real-time validation
        document.getElementById('nomor_hp').addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '').slice(0, 13);
        });

        document.getElementById('nip').addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '').slice(0, 18);
        });
    </script>
</body>
</html>
