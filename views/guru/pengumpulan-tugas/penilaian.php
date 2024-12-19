<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="/assets/css/dashboardadmin.css">
    <link rel="stylesheet" href="/assets/css/tablestyle.css">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }

        .card {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .card img {
            max-width: 650px;
            max-height: 650px;
            object-fit: contain;
            object-position: center;
            border-radius: 8px;
        }

        .card h2 {
            margin-bottom: 10px;
        }

        .card p {
            margin: 5px 0;
            margin-top: 1rem;
            margin-bottom: 1rem;
        }

        .card .foto {
            margin-top: 10px;
        }
    </style>
    <title>Dashboard Guru Page</title>
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
            <li class="active">
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
                    <i class='bx bx-exit bx-flip-horizontal' ></i>
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

        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Pengumpulan Tugas</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">Pengumpulan Tugas</a></li>
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li><a class="active" href="#">Daftar Pengumpulan</a></li>
                    </ul>
                </div>
            </div>
            <div class="table-container">
                <div class="card">
                    <form action="/penilaian-siswa" method="post">
                        <h2>Data Tugas Siswa</h2>
                        <input type="hidden" name="id" value="<?= $data['id']; ?>">
                        <p><strong>NISN:</strong> <?php echo htmlspecialchars($data['nisn']); ?></p>
                        <p><strong>Nama Siswa:</strong> <?php echo htmlspecialchars($data['nama']); ?></p>

                        <div class="foto">
                            <p><strong>Foto Tugas:</strong></p>
                            <img src="data:image/jpg;base64,<?php echo htmlspecialchars($data['foto']); ?>" alt="Foto Tugas">
                        </div>
                        <select class="select-nilai" name="grade">
                            <option disabled selected value="">-- Pilih Nilai --</option>
                            <option value="A">A</option>
                            <option value="B+">B+</option>
                            <option value="B">B</option>
                            <option value="C+">C+</option>
                            <option value="C">C</option>
                            <option value="D+">D+</option>
                            <option value="D">D</option>
                            <option value="E">E</option>
                        </select>
                        <div class="btn-container">
                            <button type="submit" class="btn btn-primary">
                                <i class='bx bx-save'></i>
                                <span>Nilai Tugas</span>
                            </button>
                            <a href="/pengumpulan-tugas" class="btn btn-danger">
                                <i class='bx bx-x'></i>
                                <span>Batal</span>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </main>
</body>

</html>