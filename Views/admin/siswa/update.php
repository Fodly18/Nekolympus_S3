<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="/assets/css/dataguruadmin.css">
    <link rel="stylesheet" href="/assets/css/dashboardadmin.css">
    <title>Edit Data Siswa - Admin Dashboard</title>
</head>
<body>
    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="/admin" class="brand">
            <i class='bx bxs-school'></i>
            <span class="text">SDN 1 KALISAT</span>
        </a>
        <ul class="side-menu top">
            <li>
                <a href="/admin">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li class="active">
                <a href="/guru">
                    <i class='bx bxs-group'></i>
                    <span class="text">Data Guru</span>
                </a>
            </li>
            <li>
                <a href="/mapel">
                    <i class='bx bxs-book'></i>
                    <span class="text">Mata Pelajaran</span>
                </a>
            </li>
            <li>
                <a href="/siswa">
                    <i class='bx bxs-user-detail'></i>
                    <span class="text">Data Siswa</span>
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
                <a href="/logout" class="logout">
                    <i class='bx bxs-log-out-circle'></i>
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
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Cari..." aria-label="Search">
                    <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <input type="checkbox" id="switch-mode" hidden>
            <label for="switch-mode" class="switch-mode"></label>
            <a href="#" class="profile">
                <img src="/assets/img/people.png" alt="Profile">
            </a>
        </nav>

        <!-- MAIN -->
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Edit Data Siswa</h1>
                    <ul class="breadcrumb">
                        <li><a href="/admin">Dashboard</a></li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li><a href="/siswa">Data Siswa</a></li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li><a class="active" href="#">Edit Siswa</a></li>
                    </ul>
                </div>
            </div>

            <div class="form-container">
                <?php if (isset($errors['system'])): ?>
                    <div class="error-message" style="margin-bottom: 1rem;">
                        <?= htmlspecialchars($errors['system'][0]) ?>
                    </div>
                <?php endif; ?>

                <form action="/siswa/update" method="post" id="updateForm" onsubmit="return validateForm()">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($data->id) ?>">
                    
                    <div class="form-group">
                        <label for="nisn">NISN</label>
                        <input type="text" class="form-control" id="nisn" name="nisn" required 
                               pattern="[0-9]{10}" maxlength="10"
                               value="<?= htmlspecialchars($data->nisn) ?>" aria-describedby="nisnHint">
                        <div id="nisnHint" class="form-hint">NISN harus 10 digit angka</div>
                        <?php if (isset($errors['nisn'])): ?>
                            <?php foreach ($errors['nisn'] as $error): ?>
                                <div class="error-message"><?= htmlspecialchars($error) ?></div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama" name="nama" required 
                               maxlength="100" value="<?= htmlspecialchars($data->nama) ?>">
                        <?php if (isset($errors['nama'])): ?>
                            <?php foreach ($errors['nama'] as $error): ?>
                                <div class="error-message"><?= htmlspecialchars($error) ?></div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="nomor_hp">Nomor HP</label>
                        <input type="tel" class="form-control" id="nomor_hp" name="nomor_hp" required 
                               pattern="[0-9]{10,13}" maxlength="13"
                               value="<?= htmlspecialchars($data->nomor_hp) ?>" aria-describedby="nomorHpHint">
                        <div id="nomorHpHint" class="form-hint">Nomor HP harus 10-13 digit angka</div>
                        <?php if (isset($errors['nomor_hp'])): ?>
                            <?php foreach ($errors['nomor_hp'] as $error): ?>
                                <div class="error-message"><?= htmlspecialchars($error) ?></div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="password">Password Baru (Kosongkan jika tidak ingin mengubah)</label>
                        <div class="password-container">
                            <input type="password" class="form-control" id="password" name="password" 
                                   minlength="6" aria-describedby="passwordHint">
                            <i class='bx bx-show toggle-password' onclick="togglePassword()"></i>
                        </div>
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
                            <span>Simpan Perubahan</span>
                        </button>
                        <a href="/siswa" class="btn btn-danger">
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
            const nisn = document.getElementById('nisn').value;
            const nomor_hp = document.getElementById('nomor_hp').value;
            const password = document.getElementById('password').value;

            // Validate nisn
            if (!/^[0-9]{10}$/.test(nisn)) {
                alert('NISN harus 10 digit angka');
                return false;
            }

            // Validate phone number
            if (!/^[0-9]{10,13}$/.test(nomor_hp)) {
                alert('Nomor HP harus berupa 10-13 digit angka');
                return false;
            }

            // Validate password only if it's not empty
            if (password && password.length < 6) {
                alert('Password minimal 6 karakter');
                return false;
            }

            return true;
        }

        // Toggle password visibility
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.querySelector('.toggle-password');
            
            const isPasswordVisible = passwordInput.type === 'text';
            passwordInput.type = isPasswordVisible ? 'password' : 'text';
            toggleIcon.classList.toggle('bx-show', isPasswordVisible);
            toggleIcon.classList.toggle('bx-hide', !isPasswordVisible);
        }

        // Add input event listeners for real-time validation
        document.getElementById('nomor_hp').addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '').slice(0, 13);
        });

        document.getElementById('nisn').addEventListener('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);
        });
    </script>
</body>
</html>
