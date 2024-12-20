<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/Acara-Sekolah.css">
    <link rel="stylesheet" href="/assets/css/loading.css">
    <link rel="icon" href="/assets/img/logo.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>
<!-- Loader Container -->
<div id="loader">
    <img src="assets/animation/loading.svg" alt="Loading Animation">
</div>

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
        <li><a href="/visi-misi">Visi dan Misi</a></li>
        <li><a href="/struktur-organisasi">Struktur Organisasi</a></li>
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

    <!-- Banner  -->
    <div class="banner">
        <img class="banner-jpg" src="/assets/img/bnn.jpeg" alt="Banner JPG">
    </div>

    <?php
// Jumlah acara per halaman
$eventsPerPage = 6;

// Ambil halaman saat ini dari parameter URL, default ke 1
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Hitung offset berdasarkan halaman saat ini
$offset = ($currentPage - 1) * $eventsPerPage;

// Ambil total jumlah acara
$totalEvents = count($acara_sekolah);

// Hitung jumlah halaman
$totalPages = ceil($totalEvents / $eventsPerPage);

// Ambil acara yang sesuai untuk halaman saat ini
$currentEvents = array_slice($acara_sekolah, $offset, $eventsPerPage);
?>

<section id="gallery">
    <div class="container">
        <h2 class="text-center mb-4">Galeri Kegiatan</h2>
        <div class="row">
            <?php foreach ($currentEvents as $item): ?>
                <div class="col-md-4 mb-4">
                    <div class="card gallery-card" data-src="<?= htmlspecialchars($item['id']); ?>">
                        <img src="<?= htmlspecialchars($item['img'] ?? '/path/to/default.jpg'); ?>" alt="gambar" class="news-img">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($item['judul']); ?></h5>
                            <p class="card-text"><?= htmlspecialchars($item['konten']); ?></p>
                            <p class="card-date text-muted">Dibuat pada: <?= htmlspecialchars($item['tanggal']); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Pagination -->
        <div class="pagination">
            <?php if ($currentPage > 1): ?>
                <a href="?page=<?= $currentPage - 1; ?>" class="prev-btn">Sebelumnya</a>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?= $i; ?>" class="page-btn <?= $i === $currentPage ? 'active' : ''; ?>">
                    <?= $i; ?>
                </a>
            <?php endfor; ?>

            <?php if ($currentPage < $totalPages): ?>
                <a href="?page=<?= $currentPage + 1; ?>" class="next-btn">Berikutnya</a>
            <?php endif; ?>
        </div>
    </div>

    <!-- Modal untuk memperbesar gambar -->
    <div id="gallery-modal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="modal-img">
    </div>
</section>



    
 <!-- FOOTER -->
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
   // Modal functionality
// Mendapatkan elemen modal
const modal = document.getElementById('gallery-modal');
const modalImg = document.getElementById('modal-img');
const closeModal = document.querySelector('#gallery-modal .close');

// Menambahkan event listener pada setiap gambar
document.querySelectorAll('.gallery-card img').forEach(img => {
    img.addEventListener('click', function () {
        const imageUrl = this.getAttribute('src'); // Ambil URL gambar dari atribut src
        if (imageUrl) {
            modalImg.src = imageUrl; // Setel src modal dengan URL gambar
            modal.style.display = 'flex'; // Tampilkan modal
        } else {
            console.error('URL gambar tidak valid:', imageUrl);
        }
    });
});

// Menutup modal saat tombol close diklik
closeModal.addEventListener('click', function () {
    modal.style.display = 'none';
    modalImg.src = ''; // Reset src modal
});

// Menutup modal saat area di luar gambar diklik
modal.addEventListener('click', function (event) {
    if (event.target === modal) {
        modal.style.display = 'none';
        modalImg.src = ''; // Reset src modal
    }
});


    </script>
    <script src="/assets/js/satuuntuksemua.js"></script>
</body>

</html>