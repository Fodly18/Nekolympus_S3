<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sejarah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/sejarah.css">
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

    <!-- Banner  -->
    <div class="banner">

        <img class="banner-jpg" src="/assets/img/banner-sejarah.jpg" alt="Banner JPG">
    </div>

    <!-- Sejarah -->
<div class="container-sejarah">
    <div class="sejarah-content">
        <p><strong>Sejarah Singkat Sekolah</strong></p>
        <p>Yang dimaksud dengan sejarah dalam profil ini adalah tapakan atau jalan laju perkembangan UPTD Satuan Pendidikan SDN Kalisat 01, sejak didirikan hingga saat ini. Laju perkembangan UPTD Satuan Pendidikan SDN Kalisat 01 sejak didirikan hingga saat ini melalui sejumlah tahapan perkembangan dan pengembangan program, sebagaimana tertuang sebagai berikut.</p>
        
        <p><strong> Masa Sebelum Penggabungan atau Regrouping</strong></p>
        <p>Tanah yang ditempati oleh SDN Kalisat 01 sudah dikuasai dan ditempati oleh SDN Kalisat 01 sejak tahun 1911. Dimana pada saat itu sekolah hanya memiliki 6 Rombel. Pada saat itu pula berdiri juga sekolah lain yaitu SDN Kalisat 02 dan SDN Kalisat 04, masing-masing sekolah tersebut memiliki 6 rombel dan kegiatan pembelajaran berjalan secara beriringan.</p>
        
        <p><strong> Masa Penggabungan atau Regrouping</strong></p>
        <p>Sesuai SK Bupati Jember No. 41 tahun 2007 tentang Penggabungan, Penghapusan dan Pendirian Sekolah Dasar Negeri Kabupaten Jember, dibentuklah lembaga baru yang bernama SDN Kalisat 01 yang merupakan gabungan dari:</p>
        <ul>
            <li>SDN Kalisat 01</li>
            <li>SDN Kalisat 02</li>
            <li>SDN Kalisat 04</li>
        </ul>
        <p>Lembaga baru ini memiliki NPSN 20524909. Pada saat penggabungan, batas-batas tanah juga berubah menjadi:</p>
        <ul>
            <li>Utara: Selokan</li>
            <li>Barat: Selokan</li>
            <li>Selatan: Tanah Pak Djamal</li>
            <li>Timur: Jalan Patimura</li>
        </ul>
        <p>Luas tanah berubah menjadi 5673 m², yang penggunaannya terbagi atas bangunan gedung sekolah seluas 160 m² dan taman bermain 900 m². Tanah tersebut terletak di Jalan Patimura RT. 001 RW. 01 Desa Kalisat Kecamatan Kalisat Kabupaten Jember.</p>
        <p>Sesuai Peraturan Bupati Jember Nomor 34 Tahun 2018 tanggal 26 November 2018, tentang Nomenklatur UPTD Satuan Pendidikan Formal dan Non Formal Se Kab. Jember, SDN Kalisat 01 berubah nama menjadi Unit Pelaksana Teknis Daerah (UPTD) Satuan Pendidikan SDN Kalisat 01, dan digunakan sampai saat ini.</p>
        <p>UPTD Satuan Pendidikan SDN Kalisat 01 sudah beberapa kali mengalami perubahan kepemimpinan sejak penggabungan, hingga akhirnya menjadi Sekolah Penggerak Angkatan Ke-3. Pada tahun 2021, UPTD Satuan Pendidikan SDN Kalisat 01 mendapat bantuan berupa renovasi gedung sebanyak 3 kelas serta bantuan TIK berupa Chromebook sebanyak 15 unit.</p>

        <p><strong>Masa Perkembangan Program</strong></p>
        <p>Masa perkembangan program merupakan kegiatan yang dilakukan untuk mengembangkan program sesuai dengan perkembangan kurikulum dan kebutuhan masyarakat. Pada masa perkembangan ini, setapak demi setapak, UPTD Satuan Pendidikan SDN Kalisat 01 mengembangkan sejumlah program dan keunggulan, baik secara akademik maupun non-akademik, yaitu program reguler (intrakurikuler), program ekstrakurikuler, serta program rutin lainnya.</p>
    </div>
</div>

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

<script src="/assets/js/satuuntuksemua.js"></script>
</body>
</html>