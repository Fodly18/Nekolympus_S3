<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="/assets/css/dashboardadmin.css">
    <link rel="stylesheet" href="/assets/css/tablestyle.css">

    <title>Dashboard Guru Page</title>

    <style>
        /* Reset dasar untuk margin dan padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Mengatur font dasar */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }

        /* Container utama */
        main {
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Judul Halaman */
        .head-title {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .head-title h1 {
            font-size: 24px;
            color: #333;
        }

        .breadcrumb {
            list-style: none;
            display: flex;
            gap: 5px;
        }

        .breadcrumb li {
            font-size: 14px;
            color: #777;
        }

        .breadcrumb li a {
            text-decoration: none;
            color: #007bff;
        }

        .breadcrumb li a.active {
            color: #333;
        }

        .breadcrumb li i {
            color: #777;
        }

        /* Form Section */
        .start-quiz {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        /* Form Group */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
            font-size: 16px;
            color: #333;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            color: #333;
        }

        .form-control:focus {
            border-color: #007bff;
            outline: none;
        }

        .form-hint {
            font-size: 12px;
            color: #777;
            margin-top: 5px;
        }

        .error-message {
            font-size: 12px;
            color: #ff0000;
            margin-top: 5px;
        }

        /* Tombol Submit */
        .btn {
            background-color: #007bff;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        /* Responsif */
        @media (max-width: 768px) {
            .head-title {
                flex-direction: column;
                align-items: flex-start;
            }

            .head-title h1 {
                font-size: 20px;
                margin-bottom: 10px;
            }

            .breadcrumb {
                flex-wrap: wrap;
            }

            .breadcrumb li {
                font-size: 12px;
            }

            .start-quiz {
                padding: 15px;
            }
        }
    </style>
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
            <li>
                <a href="/pengumpulan-tugas">
                    <i class='bx bxs-shopping-bag-alt'></i>
                    <span class="text">Pengumpulan Tugas</span>
                </a>
            </li>
            <li class="active">
                <a href="/latihan-soal">
                    <i class='bx bxs-message-dots'></i>
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

        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Latihan Soal</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">Latihan Soal</a>
                        </li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                            <a class="active" href="#">Edit Latihan Soal</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="start-quiz">
                <!-- Form untuk input soal -->
                <form action="/latihan-soal/update" method="post">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($data['id']); ?>">
                    <!-- Judul Latihan Soal -->
                    <div class="form-group">
                        <label for="judul_soal">Judul Latihan Soal</label>
                        <input type="text" class="form-control" id="judul_soal" name="judul_soal" required value="<?= htmlspecialchars($data['judul_soal']); ?>">
                        <div class="form-hint">Masukkan Judul Latihan Soal</div>
                        <?php if (isset($errors['judul_soal'])): ?>
                            <?php foreach ($errors['judul_soal'] as $error): ?>
                                <div class="error-message"><?= htmlspecialchars($error) ?></div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <!-- Mapel dan Kelas -->
                    <div class="form-group">
                        <label for="kelas">Mapel Kelas</label>
                        <select class="form-control" id="kelas" name="kelas" required>
                            <option value="" disabled selected>-- Pilih Mapel Dan Kelas --</option>
                            <?php foreach ($kls as $row): ?>
                                <option value="<?= htmlspecialchars($row['id']); ?>">
                                    <?= $row['id'] == $data['awok'] ? 'selected' : ''; ?>
                                    <?= htmlspecialchars($row['kelas']) . ' - ' . htmlspecialchars($row['nama']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="form-hint">Pilih Kelas Dan Mapel Yang Tersedia</div>
                        <?php if (isset($errors['kelas'])): ?>
                            <?php foreach ($errors['kelas'] as $error): ?>
                                <div class="error-message"><?= htmlspecialchars($error) ?></div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <!-- Tanggal dan Jam Deadline -->
                    <div class="form-group">
                        <label for="tanggal_soal">Tanggal dan Jam Latihan Soal Dibuka</label>
                        <input type="datetime-local" class="form-control" id="tanggal-soal" name="tanggal_soal" required value="<?= htmlspecialchars($data['tanggal_soal']); ?>">
                        <div class="form-hint">Ubah Tanggal dan Jam Latihan Soal Dibuka</div>
                        <?php if (isset($errors['tanggal_soal'])): ?>
                            <?php foreach ($errors['tanggal_soal'] as $error): ?>
                                <div class="error-message"><?= htmlspecialchars($error) ?></div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="tgl-deadline">Tanggal dan Jam Deadline Latihan Soal</label>
                        <input type="datetime-local" class="form-control" id="tgl-deadline" name="tgl_deadline" required value="<?= htmlspecialchars($data['deadline']); ?>">
                        <div class="form-hint">Ubah Tanggal dan Jam Deadline Latihan Soal</div>
                        <?php if (isset($errors['deadline'])): ?>
                            <?php foreach ($errors['deadline'] as $error): ?>
                                <div class="error-message"><?= htmlspecialchars($error) ?></div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <!-- Tombol Submit -->
                    <div class="btn-container">
                        <button type="submit" class="btn btn-primary">
                            <i class='bx bx-save'></i>
                            <span>Simpan Perubahan</span>
                        </button>
                        <a href="/" class="btn btn-danger" id="cancel-quiz-btn">
                            <i class='bx bx-x'></i>
                            <span>Batal</span>
                        </a>
                    </div>
                </form>
            </div>
        </main>

    </section>

    <script src="/assets/js/dashboarguru.js"></script>
    <script>
        // Add dark mode toggle functionality
        const switchMode = document.getElementById('switch-mode');

        switchMode.addEventListener('change', function() {
            if (this.checked) {
                document.body.classList.add('dark');
            } else {
                document.body.classList.remove('dark');
            }
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

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('bx-show');
                toggleIcon.classList.add('bx-hide');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('bx-hide');
                toggleIcon.classList.add('bx-show');
            }
        }

        // Add input event listeners for real-time validation
        document.getElementById('nomor_hp').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '').slice(0, 13);
        });

        document.getElementById('nip').addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '').slice(0, 18);
        });
    </script>
</body>

</html>