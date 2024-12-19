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
            <li>
                <a href="/guru">
                    <i class='bx bxs-group'></i>
                    <span class="text">Data Guru</span>
                </a>
            </li>
            <li class="active">
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
                    <input type="search" placeholder="Cari...">
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
                    <h1>Tambah Mata Pelajaran</h1>
                    <ul class="breadcrumb">
                        <li><a href="/admin">Dashboard</a></li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li><a href="/mapel">Mata Pelajaran</a></li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li><a class="active" href="#">Tambah Mapel</a></li>
                    </ul>
                </div>
            </div>

            <div class="form-container">
                <?php if (isset($errors['system'])): ?>
                    <div class="error-message" style="margin-bottom: 1rem;">
                        <?= htmlspecialchars($errors['system'][0]) ?>
                    </div>
                <?php endif; ?>

                <form action="/mapel/create" method="post" id="createForm">
                <div class="form-group">
                        <label for="nama">Mata Pelajaran</label>
                        <input type="text" class="form-control" id="nama" name="nama" required 
                               maxlength="100" aria-describedby="namaHint">
                        <div id="namaHint" class="form-hint">Masukkan Nama Mata Pelajaran</div>
                        <?php if (isset($errors['nama'])): ?>
                            <?php foreach ($errors['nama'] as $error): ?>
                                <div class="error-message"><?= htmlspecialchars($error) ?></div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <div class="btn-container">
                        <button type="submit" class="btn btn-primary">
                            <i class='bx bx-save'></i>
                            <span>Simpan</span>
                        </button>
                        <a href="/mapel" class="btn btn-danger">
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
