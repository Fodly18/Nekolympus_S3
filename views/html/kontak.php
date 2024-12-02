<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/kontak.css">
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
            <a class="nav-link" href="/">Beranda</a>
          </li>
          <!-- Dropdown Profil -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="profilDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Profil
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
            <a class="nav-link" href="/blog">blog</a>
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


    </header>
    <!-- Banner  -->
    <div class="banner">
        <img class="banner-jpg" src="/assets/img/bnn.jpeg" alt="Banner JPG">
    </div>

    <!-- sejarah -->
    <section id="contact">
        <div class="contact-container">      

            <!-- Formulir Kontak -->
            <form action="#" method="POST" class="contact-form">
            <h2>Hubungi kami :</h2>
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="nam" name="name" placeholder="Your Name" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" placeholder="Your Email" required>
                </div>
                
                <div class="form-group">
                    <label for="message">Pesan:</label>
                    <textarea id="message" name="message" rows="5" placeholder="Your Message" required></textarea>
                </div>
                
                <button type="submit" class="submit-btn">Kirim pesan</button>
            </form>
    
            <!-- Informasi Kontak -->
            <div class="contact-info">
                <h3>Informasi kami :</h3>
                <p><strong >Alamat:</strong> 
                <li>Jl. Kapuas No.50, Gabahan,</li>
                <li>Kalisat, Kec. Bungkal,</li>
                <li>Kabupaten Ponorogo,</li>
                <li>Jawa Timur 63462</li>
                </p>
                <p><strong >Email:</strong>  sdnkalisat01@gmail.com</p>
                <p><strong >No Telp:</strong> .</p>
            </div>
        </div>
    </section>
    
</div>
 <!-- FOOTER -->
<footer class="footer">
  <div class="container">
    <div class="row">
      <!-- Tentang Kami dengan Logo -->
      <div class="col-md-4 about-section d-flex">
        <img src="assets/img/logo.png" alt="Logo SDN 1 Kalisat" class="footer-logo">
        <div>
          <h5>Tentang Kami</h5>
          <p>
            SDN 1 Kalisat adalah sekolah dasar yang berkomitmen untuk memberikan
            pendidikan terbaik bagi anak-anak. Kami berfokus pada pengembangan
            karakter dan akademik siswa.
          </p>
        </div>
      </div>

      <!-- Kontak -->
      <div class="col-md-4 kontak">
        <h5>Kontak</h5>
        <ul>
          <li>Alamat: Jl. Kalisat No. 1, Jember</li>
          <li>Telepon: (0331) 123456</li>
          <li>Email: info@sdn1kalisat.sch.id</li>
        </ul>
      </div>

      <!-- Lokasi -->
      <div class="col-md-4 lokasi">
        <h5>Alamat</h5>
        <a href="https://www.google.com/maps/search/?api=1&query=SDN+1+Kalisat,+Jember" target="_blank">
          <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3950.8970015713357!2d111.45046627405344!3d-8.009557579918342!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e79733e2dbc9155%3A0x4aaf9dd2609da5a9!2sSDN%201%20Kalisat!5e0!3m2!1sen!2sid!4v1731520584344!5m2!1sen!2sid"
            width="100%" height="150" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </a>
      </div>
    </div>

    <!-- Copyright -->
    <div class="text-center mt-4">
      <p>&copy; 2024 SDN 1 Kalisat. All rights reserved.</p>
    </div>
  </div>
</footer>
</body>
</html>