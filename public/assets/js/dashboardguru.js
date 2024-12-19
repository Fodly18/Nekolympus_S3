// Menangani menu sidebar
const allSideMenu = document.querySelectorAll("#sidebar .side-menu.top li a");
allSideMenu.forEach((item) => {
  const li = item.parentElement;
  item.addEventListener("click", function () {
    allSideMenu.forEach((i) => i.parentElement.classList.remove("active"));
    li.classList.add("active");
  });
});

// Menangani tombol hide sidebar
const menuBar = document.querySelector("#content nav .bx.bx-menu");
const sidebar = document.getElementById("sidebar");
menuBar.addEventListener("click", function () {
  sidebar.classList.toggle("hide");
});

// Filter pencarian pada tabel
const searchInput = document.getElementById("search-input");
const tableRows = document.querySelectorAll("table tbody tr");
searchInput.addEventListener("input", function () {
  const filter = searchInput.value.toLowerCase();
  tableRows.forEach((row) => {
    const titleCell = row.querySelector("td:nth-child(2)");
    const titleText = titleCell ? titleCell.textContent.toLowerCase().replace("...", "") : "";
    row.style.display = titleText.includes(filter) ? "" : "none";
  });
});

// Tombol pencarian untuk layar kecil
const searchButton = document.querySelector("#content nav form .form-input button");
const searchButtonIcon = document.querySelector("#content nav form .form-input button .bx");
const searchForm = document.querySelector("#content nav form");
if (searchButton && searchButtonIcon && searchForm) {
  searchButton.addEventListener("click", function (e) {
    if (window.innerWidth < 576) {
      e.preventDefault();
      searchForm.classList.toggle("show");
      const isShown = searchForm.classList.contains("show");
      searchButtonIcon.classList.replace(isShown ? "bx-search" : "bx-x", isShown ? "bx-x" : "bx-search");
    }
  });

  window.addEventListener("resize", function () {
    if (window.innerWidth > 576) {
      searchButtonIcon.classList.replace("bx-x", "bx-search");
      searchForm.classList.remove("show");
    }
  });
}

// Menyembunyikan sidebar jika layar kecil
if (window.innerWidth < 768) {
  sidebar.classList.add("hide");
} else if (window.innerWidth > 576) {
  searchButtonIcon?.classList.replace("bx-x", "bx-search");
  searchForm?.classList.remove("show");
}

window.addEventListener("resize", function () {
  if (this.innerWidth > 576) {
    searchButtonIcon?.classList.replace("bx-x", "bx-search");
    searchForm?.classList.remove("show");
  }
});

// Mengganti tema (light/dark)
const switchMode = document.getElementById("switch-mode");
switchMode.addEventListener("change", function () {
  document.body.classList.toggle("dark", this.checked);
});

// Navigasi sidebar ke URL
document.addEventListener("DOMContentLoaded", function () {
  const sidebar = document.getElementById("sidebar");
  sidebar?.addEventListener("click", function (event) {
    const clickedItem = event.target.closest("li");
    if (clickedItem) {
      const link = clickedItem.querySelector("a");
      const href = link?.getAttribute("href");
      if (href && href !== "#") {
        window.location.href = href;
      }
    }
  });
});

