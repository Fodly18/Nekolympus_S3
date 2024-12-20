function toggleMenu() {
    const mobileMenu = document.getElementById("mobile-menu");
    mobileMenu.classList.toggle("active");
  }
  
  
  function toggleDropdown(menuId, button) {
    const menu = document.getElementById(menuId);
    menu.classList.toggle('active');
    button.classList.toggle('active'); // Menambahkan/menghapus rotasi ikon
  }

  window.addEventListener('load', function () {
    const loader = document.getElementById('loader');
    loader.classList.add('hidden'); // Tambahkan kelas untuk memicu animasi
});


