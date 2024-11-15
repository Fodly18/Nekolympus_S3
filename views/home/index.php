<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/Homepage.css">
    <link rel="icon" href="/assets/img/logo.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>
   <!-- navbar -->
   <nav class="navbar navbar-expand-lg bg-custom">
    <div class="container-fluid">
      <a class="navbar-brand logo" href="#">
        <img src="assets/img/logo.png" class="logo-img" alt="Logo" />
        <div class="header-text">
          <span class="main-text">SDN 1 Kalisat</span>
          <span class="sub-text">Kalisat - Jember</span>
        </div>
      </a>
      <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbarNav"
        aria-controls="navbarNav"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="/index.html">Beranda</a>
          </li>
          <!-- Dropdown Profil -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="profilDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Profil
            </a>
            <ul class="dropdown-menu" aria-labelledby="profilDropdown">
              <li><a class="dropdown-item" href="/Views/sejarah.html">Sejarah</a></li>
              <li><a class="dropdown-item" href="/Views/Visi-misi.html">Visi dan Misi</a></li>
              <li><a class="dropdown-item" href="/Views/Struktur-Organisasi.html">Struktur Organisasi</a></li>
            </ul>
          </li>
          <!-- Dropdown Gallery -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="galleryDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Gallery
            </a>
            <ul class="dropdown-menu" aria-labelledby="galleryDropdown">
              <li><a class="dropdown-item" href="/Views/Acara-Sekolah.html">Acara Sekolah</a></li>
              <li><a class="dropdown-item" href="/Views/Prestasi.html">Prestasi</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/Views/Berita.html">Berita</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/Views/ppdb.html">PPDB</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/Views/kontak.html">Kontak</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const navbarToggler = document.querySelector('.navbar-toggler');
      const navbarCollapse = document.querySelector('.navbar-collapse');
  
      navbarToggler.addEventListener('click', function () {
        if (navbarCollapse.style.display === 'none' || navbarCollapse.style.display === '') {
          navbarCollapse.style.display = 'block'; // Menampilkan navbar
        } else {
          navbarCollapse.style.display = 'none'; // Menyembunyikan navbar
        }
      });
    });
  </script><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


  <!-- BANNER -->
  <div class="banner">
    <img class="banner-img" src="assets/img/Langit.jpg" alt="Banner JPG" />
    <img class="png" src="assets/img/Pager - Copy.png" alt="Banner PNG" />
  </div>

  <!-- CONTENT Sambutan -->
  <section class="sambutan-container">
    <div class="sambutan-text fade-in">
      <h2>Sambutan Kepala Sekolah</h2>
      <p>
        Selamat datang di website resmi SDN 1 Kalisat. Kami sangat senang Anda
        mengunjungi situs ini untuk mengetahui lebih lanjut tentang sekolah
        kami, kegiatan-kegiatan yang kami laksanakan, dan visi-misi pendidikan
        yang kami terapkan. Kami berharap informasi yang kami sampaikan
        melalui website ini dapat memberikan wawasan yang bermanfaat bagi
        semua pengunjung.
      </p>
    </div>
    <div class="sambutan-foto fade-in">
      <img src="assets/img/kepsek.jpeg" alt="Foto Kepala Sekolah" />
      <p class="nama-kepala-sekolah">HASANATUN TOYIBA, S.Pd h</p>
    </div>
  </section>

  <!-- Statistika Content -->
  <section class="statistics-section">
    <h2 class="section-title fade-in">Statistik Sekolah</h2>
    <p class="statistics-description fade-in">
      Berikut adalah data statistik penting mengenai sekolah kami, mencakup
      jumlah siswa, guru, dan berbagai informasi lainnya yang mencerminkan
      kualitas pendidikan.
    </p>
    <div class="statistics-container fade-in">
      <div class="statistics-image">
        <img
          src="assets/img/statistika_gambar.png"
          alt="Statistik Sekolah"
          class="statistics-img"
        />
      </div>
      <div class="statistics-content">
        <div class="stat-items">
          <div class="stat-item fade-in">
            <i class="fas fa-users"></i>
            <div class="stat-value">350</div>
            <div class="stat-label">Jumlah Siswa</div>
          </div>
          <div class="stat-item fade-in">
            <i class="fas fa-chalkboard-teacher"></i>
            <div class="stat-value">20</div>
            <div class="stat-label">Jumlah Guru</div>
          </div>
          <div class="stat-item fade-in">
            <i class="fas fa-book"></i>
            <div class="stat-value">1500</div>
            <div class="stat-label">Jumlah Buku</div>
          </div>
          <div class="stat-item fade-in">
            <i class="fas fa-graduation-cap"></i>
            <div class="stat-value">100</div>
            <div class="stat-label">Lulusan Tahun Ini</div>
          </div>
          <div class="stat-item fade-in">
            <i class="fas fa-trophy"></i>
            <div class="stat-value">5</div>
            <div class="stat-label">Penghargaan</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Content news -->
  <section class="news-section">
    <h2 class="section-title fade-in">Kumpulan Berita</h2>
    <div class="news-container">
      <button class="arrow left-arrow" onclick="scrollNews(-1)">
        &#10094;
      </button>
      <div class="news-wrapper fade-in">
        <div class="news-item">
          <img src="assets/img/foto1.jpg" alt="Berita 1" class="news-img" />
          <h3 class="news-title">Judul Berita 1</h3>
          <p class="news-description">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Sint
            voluptatibus unde facilis, vitae doloremque cumque. Voluptatibus
            laborum atque dolores perspiciatis repellendus? Natus vitae quos
            recusandae ad possimus voluptate quae tempore.
          </p>
        </div>
        <div class="news-item">
          <img src="assets/img/foto2.jpg" alt="Berita 2" class="news-img" />
          <h3 class="news-title">Judul Berita 2</h3>
          <p class="news-description">
            Deskripsi singkat tentang berita 2. Ini menjelaskan konten berita
            dengan lebih detail.
          </p>
        </div>
        <div class="news-item">
          <img src="assets/img/foto3.jpg" alt="Berita 3" class="news-img" />
          <h3 class="news-title">Judul Berita 3</h3>
          <p class="news-description">
            Deskripsi singkat tentang berita 3. Ini menjelaskan konten berita
            dengan lebih detail.
          </p>
        </div>
        <div class="news-item">
          <img src="assets/img/foto4.jpg" alt="Berita 4" class="news-img" />
          <h3 class="news-title">Judul Berita 4</h3>
          <p class="news-description">
            Deskripsi singkat tentang berita 4. Ini menjelaskan konten berita
            dengan lebih detail.
          </p>
        </div>
        <div class="news-item">
          <img src="assets/img/foto5.jpg" alt="Berita 5" class="news-img" />
          <h3 class="news-title">Judul Berita 5</h3>
          <p class="news-description">
            Deskripsi singkat tentang berita 5. Ini menjelaskan konten berita
            dengan lebih detail.
          </p>
        </div>
        <div class="news-item">
          <img src="assets/img/foto6.jpg" alt="Berita 6" class="news-img" />
          <h3 class="news-title">Judul Berita 6</h3>
          <p class="news-description">
            Deskripsi singkat tentang berita 6. Ini menjelaskan konten berita
            dengan lebih detail.
          </p>
        </div>
      </div>
      <button class="arrow right-arrow" onclick="scrollNews(1)">
        &#10095;
      </button>
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="footer">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <h5>Tentang Kami</h5>
          <p>
            SDN 1 Kalisat adalah sekolah dasar yang berkomitmen untuk
            memberikan pendidikan terbaik bagi anak-anak. Kami berfokus pada
            pengembangan karakter dan akademik siswa.
          </p>
        </div>
        <div class="col-md-4">
          <h5>Kontak</h5>
          <ul>
            <li>Alamat: Jl. Kalisat No. 1, Jember</li>
            <li>Telepon: (0331) 123456</li>
            <li>Email: info@sdn1kalisat.sch.id</li>
          </ul>
        </div>
        <div class="col-md-4">
          <h5>Ikuti Kami</h5>
          <ul class="social-media">
            <li>
              <a href="#"><i class="fab fa-facebook-f"></i> Facebook</a>
            </li>
            <li>
              <a href="#"><i class="fab fa-twitter"></i> Twitter</a>
            </li>
            <li>
              <a href="#"><i class="fab fa-instagram"></i> Instagram</a>
            </li>
          </ul>
        </div>
      </div>
      <div class="text-center">
        <p>&copy; 2024 SDN 1 Kalisat. All rights reserved.</p>
      </div>
    </div>
  </footer>

  <script>
    const statItems = document.querySelectorAll(".stat-item");

    statItems.forEach((item) => {
      item.addEventListener("mouseover", () => {
        item.style.transform = "scale(1.1) rotateY(10deg)";
      });

      item.addEventListener("mouseout", () => {
        item.style.transform = "scale(1) rotateY(0deg)";
      });
    });
  </script>

  <script>
    const elementsToShow = document.querySelectorAll(".fade-in");

    const showElements = (entries, observer) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add("visible");
          observer.unobserve(entry.target);
        }
      });
    };

    const observer = new IntersectionObserver(showElements);

    elementsToShow.forEach((element) => {
      observer.observe(element);
    });

    function scrollNews(direction) {
  const wrapper = document.querySelector('.news-wrapper');
  const scrollAmount = 300; // Sesuaikan dengan lebar item berita
  wrapper.scrollBy({
    left: direction * scrollAmount,
    behavior: 'smooth',
  });
}

  </script>
  
</body>
</html>