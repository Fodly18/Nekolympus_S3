<!DOCTYPE html>
<html lang="en">
<?php
	use Nekolympus\Project\models\Siswa;
	use Nekolympus\Project\models\Guru;
	use Nekolympus\Project\models\Berita;
  use Nekolympus\Project\models\Prestasi;

	$totalSiswa = Siswa::count();
	$totalGuru = Guru::count();
	$totalBerita = Berita::count();
  $totalPrestasi= Prestasi::count();
	?>
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/Homepage.css">
    <link rel="icon" href="/assets/img/logo.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

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
      onclick="toggleMenu()"
    >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="/">Beranda</a>
          </li>
          <!-- Dropdown Profil -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="profilDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Profil
              <i class="fas fa-chevron-down"></i>
            </a>
            <ul class="dropdown-menu" aria-labelledby="profilDropdown">
              <li><a class="dropdown-item" href="/sejarah">Sejarah</a></li>
              <li><a class="dropdown-item" href="/Visi-misi">Visi dan Misi</a></li>
              <li><a class="dropdown-item" href="/strukture-organisasi">Struktur Organisasi</a></li>
            </ul>
          </li>
          <!-- Dropdown Gallery -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="galleryDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Gallery
              <i class="fas fa-chevron-down"></i> 
            </a>
            <ul class="dropdown-menu" aria-labelledby="galleryDropdown">
              <li><a class="dropdown-item" href="/acara_sekolah">Acara Sekolah</a></li>
              <li><a class="dropdown-item" href="/prestasi">Prestasi</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/berita">Berita</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/ppdb">PPDB</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/kontak">Kontak</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- navbar mobile -->
  <div id="mobile-menu" class="offcanvas-menu">
  <h1><a href="/">Beranda</a></h1>
  <button class="close-btn" onclick="toggleMenu()">&#10005;</button>
  <ul class="offcanvas-nav">
    <!-- Dropdown Profil -->
    <li>
    <button class="dropdown-toggle" onclick="toggleDropdown('profil-menu', this)">
  Profil
  <i class="fas fa-chevron-down"></i>
      </button>
      <ul id="profil-menu" class="dropdown-content">
        <li><a href="/sejarah">Sejarah</a></li>
        <li><a href="/Visi-misi">Visi dan Misi</a></li>
        <li><a href="/strukture-organisasi">Struktur Organisasi</a></li>
      </ul>
    </li>
    <!-- Dropdown Gallery -->
    <li>
      <button class="dropdown-toggle" onclick="toggleDropdown('gallery-menu',this)">
        Gallery
        <i class="fas fa-chevron-down"></i>
      </button>
      <ul id="gallery-menu" class="dropdown-content">
        <li><a href="/acara_sekolah">Acara Sekolah</a></li>
        <li><a href="/prestasi">Prestasi</a></li>
      </ul>
    </li>
    <li><a href="/berita">Berita</a></li>
    <li><a href="/ppdb">PPDB</a></li>
    <li><a href="/kontak">Kontak</a></li>
  </ul>
</div>


  <!-- BANNER -->
  <div class="banner">
    <img class="banner-img" src="assets/img/Langit.jpg" alt="Banner JPG" />
    <img class="png-pager" src="assets/img/Pager - Copy.png" alt="pager PNG" />
    <img class="png-bangunan1" src="assets/img/bb3.png" alt="bangunan1 PNG" />
    <img class="png-org1" src="assets/img/org1.png" alt="anak-anak PNG" />
    <img class="png-org2" src="assets/img/org2.png" alt="anak-anak 2 PNG" />
    <img class="png-pdg1" src="assets/img/pdg1.png" alt="pedagang PNG" />
    <img class="png-tiang" src="assets/img/flagpule-removebg-preview.PNG" alt="tiang-bangunan PNG" />
    <img class="png-pohon1" src="assets/img/pohon1.png" alt="pohon1 PNG" />
    <img class="png-pohon2" src="assets/img/pohon2.png" alt="pohon2 PNG" />

  </div>

  <!-- CONTENT Sambutan -->
  <section class="sambutan-container">
    <div class="sambutan-text fade-in">
    <h2>
    <span class="icon-decorator">🎓</span> Sambutan Kepala Sekolah
    <span class="line-decorator"></span>
  </h2>
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
  <div class="title-underline fade-in"></div>
  <p class="statistics-description fade-in">
    SDN 1 Kalisat berkomitmen untuk memberikan pendidikan berkualitas dengan dukungan tenaga pendidik profesional dan fasilitas yang memadai. Berikut adalah statistik yang menunjukkan pencapaian dan kapasitas sekolah kami:
  </p>
  <div class="statistics-container fade-in">
    <!-- Gambar Statistik -->
    <div class="statistics-image">
      <img
        src="assets/img/statistika_gambar.png"
        alt="Statistik Sekolah"
        class="statistics-img"
      />
      <p class="image-caption">
        Grafik dan data statistik sekolah kami mencerminkan dedikasi terhadap pendidikan.
      </p>
    </div>
    <!-- Konten Statistik -->
    <div class="statistics-content">
      <div class="stat-items">
        <div class="stat-item fade-in">
          <i class="fas fa-users icon"></i>
          <div class="stat-value"><?= htmlspecialchars($totalSiswa, ENT_QUOTES, 'UTF-8'); ?></div>
          <div class="stat-label">Jumlah Siswa</div>
        </div>
        <div class="stat-item fade-in">
          <i class="fas fa-chalkboard-teacher icon"></i>
          <div class="stat-value"><?= htmlspecialchars($totalGuru, ENT_QUOTES, 'UTF-8'); ?></div>
          <div class="stat-label">Jumlah Guru</div>
        </div>
        <div class="stat-item fade-in">
          <i class="fa-solid fa-newspaper icon"></i>
          <div class="stat-value"><?= htmlspecialchars($totalBerita, ENT_QUOTES, 'UTF-8'); ?></div>
          <div class="stat-label">Jumlah Berita</div>
        </div>
        <div class="stat-item fade-in">
          <i class="fas fa-graduation-cap icon"></i>
          <div class="stat-value">100</div>
          <div class="stat-label">Lulusan Tahun Ini</div>
        </div>
        <div class="stat-item fade-in">
          <i class="fas fa-trophy icon"></i>
          <div class="stat-value"><?= htmlspecialchars($totalPrestasi, ENT_QUOTES, 'UTF-8'); ?></div>
          <div class="stat-label">Penghargaan</div>
        </div>
      </div>
    </div>
  </div>
</section>

  <!-- Content news -->
  <section class="news-section">
    <h2 class="section-title fade-in">Kumpulan Berita</h2>
    <div class="section-title-underline fade-in"></div>
    <p class="section-description fade-in">Dapatkan informasi terbaru tentang kegiatan, pengumuman, dan prestasi sekolah kami.</p>
    <div class="news-container">
        <button class="arrow left-arrow" onclick="scrollNews(-1)">
            &#10094;
        </button>
        <div class="news-wrapper fade-in">
            <?php foreach ($berita as $row): ?>
                <a href="/berita#berita-<?= urlencode($row['id']); ?>" class="news-item">
                    <img src="<?= htmlspecialchars($row['img'] ?? '/path/to/default.jpg'); ?>" 
                         alt="Gambar Berita" 
                         class="news-img" />
                    <h3 class="news-title"><?= htmlspecialchars($row['judul']); ?></h3>
                    <div class="news-divider"></div>
                    <p class="news-description">
                        <?= htmlspecialchars(substr($row['konten'], 0, 200)) . (strlen($row['konten']) > 200 ? '...' : ''); ?>
                    </p>
                </a>
            <?php endforeach; ?>
        </div>
        <button class="arrow right-arrow" onclick="scrollNews(1)">
            &#10095;
        </button>
    </div>
</section>



<footer class="footer">
  <div class="container">
    <div class="row">
      <!-- Logo -->
      <div class="col-md-3 logo-section">
        <img src="assets/img/logo.png" alt="Logo SDN 1 Kalisat" class="footer-logo">
      </div>

      <!-- Tentang Kami -->
      <div class="col-md-3 about-section">
        <h5>Tentang Kami</h5>
        <p>
          SDN 1 Kalisat adalah sekolah dasar yang berkomitmen untuk memberikan
          pendidikan terbaik bagi anak-anak. Kami berfokus pada pengembangan
          karakter dan akademik siswa.
        </p>
      </div>

      <!-- Kontak -->
      <div class="col-md-3 kontak-section">
        <h5>Kontak</h5>
        <ul>
          <li><i class="fas fa-map-marker-alt"></i> Jl. Kalisat No. 1, Jember</li>
          <li><i class="fas fa-phone"></i> (0331) 123456</li>
          <li><i class="fas fa-envelope"></i> info@sdn1kalisat.sch.id</li>
        </ul>
      </div>

      <!-- Lokasi -->
      <div class="col-md-3 lokasi-section content-alamat">
        <h5>Alamat</h5>
        <a href="https://www.google.com/maps/search/?api=1&query=SDN+1+Kalisat,+Jember" target="_blank">
          <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3950.8970015713357!2d111.45046627405344!3d-8.009557579918342!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e79733e2dbc9155%3A0x4aaf9dd2609da5a9!2sSDN%201%20Kalisat!5e0!3m2!1sen!2sid!4v1731520584344!5m2!1sen!2sid"
            width="100%" height="150" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </a>
        <p>Jl. Kapuas No.50, Gabahan, Kalisat, Kec. Bungkal, Kabupaten Ponorogo, Jawa Timur 63462</p>
      </div>
    </div>

    <!-- Sosial Media -->
    <div class="row mt-4">
      <div class="col text-center">
        <h5>Ikuti Kami</h5>
        <ul class="social-icons">
          <li><a href="https://facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
          <li><a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a></li>
          <li><a href="https://instagram.com" target="_blank"><i class="fab fa-instagram"></i></a></li>
          <li><a href="https://linkedin.com" target="_blank"><i class="fab fa-linkedin-in"></i></a></li>
        </ul>
      </div>
    </div>

    <!-- Copyright -->
    <div class="text-center mt-4">
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

    const newsWrapper = document.querySelector('.news-wrapper');
const newsItems = document.querySelectorAll('.news-item');

itemWidth = newsItems[0].offsetWidth + parseInt(getComputedStyle(newsItems[0]).marginRight);

let currentIndex = 0;

function updateMaxIndex() {
  const visibleItems = Math.floor(newsWrapper.offsetWidth / itemWidth);
  const maxIndex = Math.max(newsItems.length - visibleItems, 0);
  return maxIndex;
}

function scrollNews(direction, speed = 1) {
   const scrollAmount = direction * itemWidth * speed;
   newsWrapper.scrollLeft += scrollAmount;
}



// Menambahkan event listener untuk menangani perubahan ukuran
window.addEventListener('resize', () => {
  itemWidth = newsItems[0].offsetWidth + parseInt(getComputedStyle(newsItems[0]).marginRight);  // Update itemWidth jika ukuran berubah
  const maxIndex = updateMaxIndex(); // Memperbarui maxIndex saat ukuran layar berubah
});



const visibleItems = Math.floor(newsWrapper.offsetWidth / itemWidth); // Menentukan jumlah item yang bisa terlihat
const maxIndex = newsItems.length - visibleItems; // Batas maksimal indeks

console.log('itemWidth:', itemWidth);
console.log('visibleItems:', visibleItems);
console.log('maxIndex:', maxIndex);
console.log('currentIndex:', currentIndex);
console.log('newsWrapper.offsetWidth:', newsWrapper.offsetWidth);



function toggleMenu() {
  const mobileMenu = document.getElementById("mobile-menu");
  mobileMenu.classList.toggle("active");
}

function toggleDropdown(menuId, button) {
  const menu = document.getElementById(menuId);
  menu.classList.toggle('active');
  button.classList.toggle('active'); // Menambahkan/menghapus rotasi ikon
}

  </script>
  
  
</body>
</html>
