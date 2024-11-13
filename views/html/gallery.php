<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/gallery.css">
    <link rel="icon" href="/assets/img/logo.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>
   <!-- navbar -->
   <nav class="navbar navbar-expand-lg bg-custom">
    <div class="container-fluid">
      <a class="navbar-brand logo" href="#">
        <img src="/assets/img/logo.png" class="logo-img" alt="Logo" />
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


    <!-- Banner  -->
    <div class="banner">
        <img class="banner-jpg" src="/assets/img/bnn.jpeg" alt="Banner JPG">
    </div>

  <!-- Gallery -->
<section id="gallery">
    <div class="container">
        <h2 class="text-center mb-4">Galeri Kegiatan</h2>
        <div class="row">
            <!-- Contoh Card Gambar 1 -->
            <div class="col-md-4 mb-4">
                <div class="card gallery-card" data-src="/assets/img/foto1.jpg">
                    <img src="/assets/img/foto1.jpg" class="card-img-top" alt="Kegiatan 1">
                    <div class="card-body">
                        <p class="card-text">Deskripsi kegiatan 1 di sini.</p>
                    </div>
                </div>
            </div>

            <!-- Contoh Card Gambar 2 -->
            <div class="col-md-4 mb-4">
                <div class="card gallery-card" data-src="/assets/img/foto2.jpg">
                    <img src="/assets/img/foto2.jpg" class="card-img-top" alt="Kegiatan 2">
                    <div class="card-body">
                        <p class="card-text">Deskripsi kegiatan 2 di sini.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card gallery-card" data-src="/assets/img/foto3.jpg">
                    <img src="/assets/img/foto3.jpg" class="card-img-top" alt="Kegiatan 3">
                    <div class="card-body">
                        <p class="card-text">Deskripsi kegiatan 3 di sini.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card gallery-card" data-src="/assets/img/foto4.jpg">
                    <img src="/assets/img/foto4.jpg" class="card-img-top" alt="Kegiatan 3">
                    <div class="card-body">
                        <p class="card-text">Deskripsi kegiatan 3 di sini.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card gallery-card" data-src="/assets/img/foto5.jpg">
                    <img src="/assets/img/foto5.jpg" class="card-img-top" alt="Kegiatan 3">
                    <div class="card-body">
                        <p class="card-text">Deskripsi kegiatan 3 di sini.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card gallery-card" data-src="/assets/img/foto6.jpg">
                    <img src="/assets/img/foto6.jpg" class="card-img-top" alt="Kegiatan 3">
                    <div class="card-body">
                        <p class="card-text">Deskripsi kegiatan 3 di sini.</p>
                    </div>
                </div>
            </div>

            
        </div>
    </div>

    <!-- Modal untuk memperbesar gambar -->
    <div id="gallery-modal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="modal-img">
    </div>
</section>


        </div>
    </div>
</section>

    
 <!-- FOOTER -->
 <footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h5>Tentang Kami</h5>
                <p>SDN 1 Kalisat adalah sekolah dasar yang berkomitmen untuk memberikan pendidikan terbaik bagi anak-anak. Kami berfokus pada pengembangan karakter dan akademik siswa.</p>
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
                    <li><a href="#"><i class="fab fa-facebook-f"></i> Facebook</a></li>
                    <li><a href="#"><i class="fab fa-twitter"></i> Twitter</a></li>
                    <li><a href="#"><i class="fab fa-instagram"></i> Instagram</a></li>
                </ul>
            </div>
        </div>
        <div class="text-center">
            <p>&copy; 2024 SDN 1 Kalisat. All rights reserved.</p>
        </div>
    </div>
</footer>

<script>
   // Modal functionality
const modal = document.getElementById('gallery-modal');
const modalImg = document.getElementById('modal-img');
const closeBtn = document.getElementsByClassName('close')[0];

// Membuka modal ketika card diklik
document.querySelectorAll('.gallery-card').forEach(card => {
    card.addEventListener('click', function() {
        const imgSrc = this.getAttribute('data-src');
        modal.style.display = 'flex';
        modalImg.src = imgSrc;
    });
});

// Menutup modal ketika tombol close diklik
closeBtn.onclick = function() {
    modal.style.display = 'none';
}

// Menutup modal ketika area di luar gambar diklik
modal.onclick = function(event) {
    if (event.target === modal) {
        modal.style.display = 'none';
    }
}

    </script>
    
</body>

</html>