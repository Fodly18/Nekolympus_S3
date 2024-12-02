<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="/assets/css/dashboardguru.css">
    <link rel="stylesheet" href="/assets/css/latsolstyle.css">
    <link rel="stylesheet" href="/assets/css/tablestyle.css">
    <style>
        .start-quiz {
            background: var(--light);
            padding: 24px;
            border-radius: 20px;
            margin-top: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--dark);
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid var(--grey);
            border-radius: 5px;
            font-size: 1rem;
        }

        .error-message {
            color: var(--red);
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .btn-container {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .form-hint {
            font-size: 0.75rem;
            color: var(--dark-grey);
            margin-top: 0.25rem;
        }

        .invalid-feedback {
            display: none;
            color: var(--red);
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        .form-control:invalid~.invalid-feedback {
            display: block;
        }
    </style>
    <title>Dashboard Guru Page</title>
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
                            <a class="active" href="#">Buat Latihan Soal</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="start-quiz">
    <?php if (isset($errors['system'])): ?>
        <div class="error-message" style="margin-bottom: 1rem;">
            <?= htmlspecialchars($errors['system'][0]) ?>
        </div>
    <?php endif; ?>

    <form action="/latihan-soal/create" method="post" id="start-quiz-form">
        <div class="form-group">
            <label for="judul_tugas">Judul Latihan Soal</label>
            <input type="text" class="form-control" id="judul_tugas" name="judul_tugas" required>
            <div class="form-hint">Masukkan Judul Latihan Soal</div>
            <?php if (isset($errors['judul_tugas'])): ?>
                <?php foreach ($errors['judul_tugas'] as $error): ?>
                    <div class="error-message"><?= htmlspecialchars($error) ?></div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="jumlah_soal">Jumlah Soal Latihan Soal</label>
            <input type="number" class="form-control" id="jumlah_soal" name="jumlah_soal" required>
            <div class="form-hint">Masukkan Jumlah Soal Latihan Soal</div>
            <?php if (isset($errors['jumlah_soal'])): ?>
                <?php foreach ($errors['jumlah_soal'] as $error): ?>
                    <div class="error-message"><?= htmlspecialchars($error) ?></div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="nilai">Nilai Latihan Soal</label>
            <input type="number" class="form-control" id="nilai" name="nilai" required>
            <div class="form-hint">Masukkan Nilai Latihan Soal</div>
        </div>
        <div class="btn-container">
            <button type="submit" class="btn btn-primary">
                <i class='bx bx-save'></i>
                <span>Lanjutkan</span>
            </button>
            <a href="/tugas-pembelajaran" class="btn btn-danger">
                <i class='bx bx-x'></i>
                <span>Batal</span>
            </a>
        </div>
    </form>
</div>

<div class="quiz-question" style="display:none">
    <!-- Kontainer soal akan muncul di sini -->
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const startQuizContainer = document.querySelector('.start-quiz');
        const quizQuestionContainer = document.querySelector('.quiz-question');
        const startQuizForm = document.getElementById('start-quiz-form');

        startQuizForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // Ambil jumlah soal dari input
            const totalQuestions = document.getElementById('jumlah_soal').value;

            // Sembunyikan container start-quiz
            startQuizContainer.style.display = 'none';

            // Mengosongkan container quiz-question agar tidak ada duplikasi soal
            quizQuestionContainer.innerHTML = '';

            // Tampilkan container quiz-question sesuai jumlah soal
            for (let i = 0; i < totalQuestions; i++) {
                const questionElement = document.createElement('div');
                questionElement.classList.add('question-container');
                questionElement.innerHTML = `
                    <div class="form-group">
                        <label for="soal_${i + 1}">Soal ${i + 1}</label>
                        <input type="text" class="form-control" id="soal_${i + 1}" name="soal_${i + 1}" required>
                    </div>
                    <div class="form-group">
                        <label for="jawaban_a_${i + 1}">Jawaban A</label>
                        <input type="text" class="form-control" id="jawaban_a_${i + 1}" name="jawaban_a_${i + 1}" required>
                    </div>
                    <div class="form-group">
                        <label for="jawaban_b_${i + 1}">Jawaban B</label>
                        <input type="text" class="form-control" id="jawaban_b_${i + 1}" name="jawaban_b_${i + 1}" required>
                    </div>
                    <div class="form-group">
                        <label for="jawaban_c_${i + 1}">Jawaban C</label>
                        <input type="text" class="form-control" id="jawaban_c_${i + 1}" name="jawaban_c_${i + 1}" required>
                    </div>
                    <div class="form-group">
                        <label for="jawaban_d_${i + 1}">Jawaban D</label>
                        <input type="text" class="form-control" id="jawaban_d_${i + 1}" name="jawaban_d_${i + 1}" required>
                    </div>
                    <div class="form-group">
                        <label for="jawaban_benar_${i + 1}">Jawaban Benar</label>
                        <input type="text" class="form-control" id="jawaban_benar_${i + 1}" name="jawaban_benar_${i + 1}" required>
                    </div>
                `;
                quizQuestionContainer.appendChild(questionElement);
            }

            // Tampilkan container quiz-question
            quizQuestionContainer.style.display = 'block';
        });
    });
</script>

        </main>
    </section>

    <script src="/assets/js/dashboardguru.js"></script>
</body>

</html>