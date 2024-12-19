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

        .form-group-quiz {
            margin-bottom: 16px;
        }

        .form-group-quiz label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--dark);
            font-weight: 250;
        }

        .form-group-quiz .input-wrapper {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-group-quiz input[type="checkbox"] {
            transform: scale(1.5);
            margin: 0;
        }

        .form-control {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid var(--grey);
            border-radius: 5px;
            font-size: 1rem;
        }

        .form-control-answer {
            flex-grow: 1;
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

        .quiz-question {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-top: 20px;
        }

        .question-container {
            padding: 15px;
            background: #f4f4f4;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .quiz-layer {
            background: var(--light);
            padding: 24px;
            border-radius: 20px;
            margin-top: 20px;
            box-shadow: 1 2px 4px rgba(0, 0, 0, 0.1);
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

                <!-- Form untuk input soal -->
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
                        <label for="kelas">Mapel Kelas</label>
                        <select class="form-control" id="kelas" name="kelas" required>
                            <option value="" disabled selected>-- Pilih Mapel Dan Kelas --</option>
                            <?php foreach ($data as $row): ?>
                                <option value="<?= htmlspecialchars($row['id']); ?>">
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

                    <div class="form-group">
                        <label for="tanggal-soal">Tanggal dan Jam Latihan Soal Dibuka</label>
                        <input type="datetime-local" class="form-control" id="tanggal-soal" name="tanggal_soal" required>
                        <div class="form-hint">Masukkan Tanggal dan Jam Latihan Soal Dibuka</div>
                        <?php if (isset($errors['deadline'])): ?>
                            <?php foreach ($errors['deadline'] as $error): ?>
                                <div class="error-message"><?= htmlspecialchars($error) ?></div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="tgl-deadline">Tanggal dan Jam Deadline Latihan Soal</label>
                        <input type="datetime-local" class="form-control" id="tgl-deadline" name="tgl_deadline" required>
                        <div class="form-hint">Masukkan Tanggal dan Jam Deadline Latihan Soal</div>
                        <?php if (isset($errors['deadline'])): ?>
                            <?php foreach ($errors['deadline'] as $error): ?>
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

                    <!-- Tombol buat soal -->
                    <div class="btn-container">
                        <button type="button" class="btn btn-primary" id="create-quiz-btn">
                            <i class='bx bx-save'></i>
                            <span>Buat Soal</span>
                        </button>
                    </div>

                    <!-- Form soal akan muncul disini -->
                    <div class="quiz-layer" id="quiz-layer" style="display: none;">
                        <div class="quiz-question" id="quiz-question-container">

                        </div>
                        <div class="btn-container">
                            <button type="submit" class="btn btn-primary">
                                <i class='bx bx-save'></i>
                                <span>Simpan Latihan Soal</span>
                            </button>
                            <a href="/latihan-soal" class="btn btn-danger" id="cancel-quiz-btn">
                                <i class='bx bx-x'></i>
                                <span>Batal</span>
                            </a>
                        </div>
                    </div>
                </form>


            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const createQuizBtn = document.getElementById('create-quiz-btn');
                    const cancelQuizBtn = document.getElementById('cancel-quiz-btn');
                    const quizLayer = document.getElementById('quiz-layer');
                    const quizQuestionContainer = document.getElementById('quiz-question-container');
                    const jumlahSoalInput = document.getElementById('jumlah_soal');
                    const errorMessage = document.getElementById('error-message'); // Tempat menampilkan pesan error

                    // Fungsi untuk menghitung total bobot nilai dan validasi
                    function calculateTotalBobot() {
                        const bobotInputs = document.querySelectorAll('[id^="bobot_nilai_"]');
                        let totalBobot = 0;
                        let isValid = true;

                        // Menjumlahkan total bobot dan memeriksa apakah ada nilai yang melebihi 100
                        bobotInputs.forEach(input => {
                            totalBobot += parseInt(input.value) || 0; // Menambahkan bobot soal, default 0 jika tidak ada nilai
                        });

                        if (totalBobot > 100) {
                            isValid = false;
                        }

                        if (!isValid) {
                            errorMessage.textContent = 'Jumlah Nilai tidak bisa lebih dari 100';
                            errorMessage.style.color = 'red';
                        } else {
                            errorMessage.textContent = '';
                        }
                        return isValid;
                    }

                    // Fungsi untuk membuat soal
                    createQuizBtn.addEventListener('click', function() {
                        const totalQuestions = parseInt(jumlahSoalInput.value);

                        if (totalQuestions > 50) {
                            alert('Jumlah soal tidak boleh lebih dari 50');
                            jumlahSoalInput.value = 50; // Membatasi jumlah soal maksimal 50
                            return;
                        }

                        // Menghapus soal yang sudah ada jika ada
                        quizQuestionContainer.innerHTML = '';

                        // Menampilkan form soal
                        quizLayer.style.display = 'block';

                        // Menghitung bobot per soal berdasarkan jumlah soal
                        const maxBobotPerSoal = Math.floor(100 / totalQuestions);

                        // Membuat soal sesuai jumlah yang diinput
                        for (let i = 0; i < totalQuestions; i++) {
                            const questionElement = document.createElement('div');
                            questionElement.classList.add('question-container');
                            questionElement.innerHTML = `
                                <div class="form-group-quiz">
                                    <label for="soal_${i}">Soal No ${i + 1}</label>
                                    <input type="text" class="form-control" id="soal_${i}" name="soal_${i}" required>
                                </div>
                                <div class="form-group-quiz">
                                <label>Centang Jawaban Benar Pada Salah Satu Jawaban</label>
                                    <label for="jawaban_a_${i}">Jawaban A</label>
                                    <div class="input-wrapper">
                                        <input type="checkbox" name="jawaban_benar_${i}" value="a" id="jawaban_a_checkbox_${i}" required>
                                        <input type="text" class="form-control-answer" id="jawaban_a_${i}" name="jawaban_a_${i}" required>
                                    </div>
                                </div>
                                <div class="form-group-quiz">
                                    <label for="jawaban_b_${i}">Jawaban B</label>
                                    <div class="input-wrapper">
                                        <input type="checkbox" name="jawaban_benar_${i}" value="b" id="jawaban_b_checkbox_${i}" required>
                                        <input type="text" class="form-control-answer" id="jawaban_b_${i}" name="jawaban_b_${i}" required>
                                    </div>
                                </div>
                                <div class="form-group-quiz">
                                    <label for="jawaban_c_${i}">Jawaban C</label>
                                    <div class="input-wrapper">
                                        <input type="checkbox" name="jawaban_benar_${i}" value="c" id="jawaban_c_checkbox_${i}" required>
                                        <input type="text" class="form-control-answer" id="jawaban_c_${i}" name="jawaban_c_${i}" required>
                                    </div>
                                </div>
                                <div class="form-group-quiz">
                                    <label for="jawaban_d_${i}">Jawaban D</label>
                                    <div class="input-wrapper">
                                        <input type="checkbox" name="jawaban_benar_${i}" value="d" id="jawaban_d_checkbox_${i}" required>
                                        <input type="text" class="form-control-answer" id="jawaban_d_${i}" name="jawaban_d_${i}" required>
                                    </div>
                                </div>
                                <div class="form-group-quiz">
                                    <label for="bobot_nilai_${i}">Bobot Nilai (Max ${maxBobotPerSoal})</label>
                                    <input type="number" class="form-control" id="bobot_nilai_${i}" name="bobot_nilai_${i}" max="${maxBobotPerSoal}" required>
                                </div>
                            `;
                            quizQuestionContainer.appendChild(questionElement);

                            // Menambahkan event listener pada input bobot nilai
                            const bobotNilaiInput = document.getElementById(`bobot_nilai_${i}`);
                            bobotNilaiInput.addEventListener('input', function() {
                                // Validasi bobot nilai tidak melebihi maxBobotPerSoal
                                if (parseInt(bobotNilaiInput.value) > maxBobotPerSoal) {
                                    bobotNilaiInput.setCustomValidity(`Bobot tidak bisa lebih dari ${maxBobotPerSoal}`);
                                } else {
                                    bobotNilaiInput.setCustomValidity('');
                                }
                                calculateTotalBobot(); // Hitung dan validasi total bobot setiap kali nilai berubah
                            });

                            const answerCheckboxes = [
                                document.getElementById(`jawaban_a_checkbox_${i}`),
                                document.getElementById(`jawaban_b_checkbox_${i}`),
                                document.getElementById(`jawaban_c_checkbox_${i}`),
                                document.getElementById(`jawaban_d_checkbox_${i}`)
                            ];

                            answerCheckboxes.forEach(function(checkbox) {
                                checkbox.addEventListener('change', function() {
                                    // Jika checkbox ini dicentang, centang hanya checkbox ini dan nonaktifkan yang lainnya
                                    if (checkbox.checked) {
                                        answerCheckboxes.forEach(function(otherCheckbox) {
                                            if (otherCheckbox !== checkbox) {
                                                otherCheckbox.checked = false; // Uncheck
                                                otherCheckbox.disabled = true; // Nonaktifkan
                                            }
                                        });
                                    } else {
                                        // Mengaktifkan kembali checkbox lainnya jika tidak dicentang
                                        answerCheckboxes.forEach(function(otherCheckbox) {
                                            otherCheckbox.disabled = false;
                                        });
                                    }
                                });
                            });
                        }
                    });

                    // Ketika tombol "Batal" ditekan
                    cancelQuizBtn.addEventListener('click', function() {
                        // Menghapus semua soal yang telah dimasukkan
                        quizQuestionContainer.innerHTML = '';
                        // Menyembunyikan form soal dan kembali ke tampilan awal
                        quizLayer.style.display = 'none';
                        // Mengosongkan input jumlah soal
                        jumlahSoalInput.value = '';
                        // Menghapus pesan error
                        errorMessage.textContent = '';
                    });
                });
            </script>



        </main>
    </section>
    <script src="/assets/js/dashboardguru.js"></script>
</body>

</html>