const allSideMenu = document.querySelectorAll("#sidebar .side-menu.top li a");
allSideMenu.forEach((item) => {
  const li = item.parentElement;

  item.addEventListener("click", function () {
    allSideMenu.forEach((i) => {
      i.parentElement.classList.remove("active");
    });
    li.classList.add("active");
  });
});

//fungsi hide sidebar
const menuBar = document.querySelector("#content nav .bx.bx-menu");
const sidebar = document.getElementById("sidebar");

menuBar.addEventListener("click", function () {
  sidebar.classList.toggle("hide");
});

const searchButton = document.querySelector(
  "#content nav form .form-input button"
);
const searchButtonIcon = document.querySelector(
  "#content nav form .form-input button .bx"
);
const searchForm = document.querySelector("#content nav form");

searchButton.addEventListener("click", function (e) {
  if (window.innerWidth < 576) {
    e.preventDefault();
    searchForm.classList.toggle("show");
    if (searchForm.classList.contains("show")) {
      searchButtonIcon.classList.replace("bx-search", "bx-x");
    } else {
      searchButtonIcon.classList.replace("bx-x", "bx-search");
    }
  }
});

if (window.innerWidth < 768) {
  sidebar.classList.add("hide");
} else if (window.innerWidth > 576) {
  searchButtonIcon.classList.replace("bx-x", "bx-search");
  searchForm.classList.remove("show");
}

window.addEventListener("resize", function () {
  if (this.innerWidth > 576) {
    searchButtonIcon.classList.replace("bx-x", "bx-search");
    searchForm.classList.remove("show");
  }
});

//ganti tema
const switchMode = document.getElementById("switch-mode");

switchMode.addEventListener("change", function () {
  if (this.checked) {
    document.body.classList.add("dark");
  } else {
    document.body.classList.remove("dark");
  }
});

//action untuk sidebar
document.addEventListener("DOMContentLoaded", function () {
  const sidebar = document.getElementById("sidebar");

  if (sidebar) {
    sidebar.addEventListener("click", function (event) {
      const clickedItem = event.target.closest("li");

      if (clickedItem) {
        const link = clickedItem.querySelector("a");
        if (link && link.getAttribute("href") !== "#") {
          const href = link.getAttribute("href");
          window.location.href = href;
        }
      }
    });
  }
});

function updateTime() {
  const now = new Date(); // Mendapatkan waktu saat ini
  const hours = String(now.getHours()).padStart(2, "0"); // Jam (2 digit)
  const minutes = String(now.getMinutes()).padStart(2, "0"); // Menit (2 digit)
  const seconds = String(now.getSeconds()).padStart(2, "0"); // Detik (2 digit)
  const day = now.toLocaleDateString("id-ID", { weekday: "long" }); // Hari dalam bahasa Indonesia
  const date = now.toLocaleDateString("id-ID"); // Tanggal dalam format lokal

  // Update elemen HTML
  document.getElementById(
    "current-time"
  ).textContent = `${hours}:${minutes}:${seconds}`;
  document.getElementById("current-date").textContent = `${day}, ${date}`;
}

// Jalankan fungsi pertama kali
updateTime();

// Update setiap detik
setInterval(updateTime, 1000);

// fungsi calender

document.addEventListener("DOMContentLoaded", function () {
  const today = new Date();
  const day = today.getDate();
  const month = today.getMonth() + 1; // Bulan dalam format 1-12
  const year = today.getFullYear();

  // Formatkan tanggal untuk dicocokkan dengan atribut data-date
  const todayDate = `${year}-${String(month).padStart(2, "0")}-${String(
    day
  ).padStart(2, "0")}`;

  // Cari semua elemen td dengan atribut data-date yang sesuai dengan hari ini
  const days = document.querySelectorAll(".calendar td[data-date]");
  days.forEach((dayElement) => {
    const dayData = dayElement.getAttribute("data-date");
    if (dayData === todayDate) {
      dayElement.classList.add("highlight"); // Tambahkan kelas highlight pada hari ini
    }
  });
});

// JavaScript untuk memperbarui waktu setiap detik
function updateClock() {
  const clockElement = document.getElementById("clock");
  // Ambil waktu saat ini
  const now = new Date();
  const hours = now.getHours().toString().padStart(2, "0");
  const minutes = now.getMinutes().toString().padStart(2, "0");
  const seconds = now.getSeconds().toString().padStart(2, "0");
  // Tampilkan di elemen jam
  clockElement.textContent = `${hours}:${minutes}:${seconds}`;
}
// Perbarui jam setiap detik
setInterval(updateClock, 1000);
// Jalankan langsung saat halaman dimuat
updateClock();
// addTodoButton.addEventListener('click', () => {
//     todoModal.classList.add('show');
//     todoModal.style.display = 'block';
// });


// popup todo list
// Ambil elemen yang dibutuhkan
const addTodoButton = document.getElementById("addTodoButton"); // Tombol add
const todoModal = document.getElementById("todoModal"); // Modal
const closeModal = document.querySelector(".close"); // Tombol close modal
const todoInput = document.getElementById("todoInput"); // Input field
const todoForm = document.getElementById("todoForm"); // Form
const todoList = document.getElementById("todoList"); // Daftar todo
// Menampilkan modal ketika tombol add diklik
addTodoButton.addEventListener("click", () => {
  todoModal.style.display = "block"; // Menampilkan modal
});
// Menutup modal ketika tombol close diklik
closeModal.addEventListener("click", () => {
  todoModal.style.display = "none"; // Menyembunyikan modal
});
// Menutup modal jika area luar modal diklik
window.addEventListener("click", (e) => {
  if (e.target == todoModal) {
    todoModal.style.display = "none"; // Menyembunyikan modal
  }
});
addTodoButton.addEventListener("click", () => {
  todoModal.classList.add("show");
  todoModal.style.display = "block";
});

todoForm.addEventListener("submit", (e) => {
  e.preventDefault(); // Mencegah form reload
  const todoText = todoInput.value.trim(); // Ambil nilai input

  // Validasi panjang karakter
  if (todoText.length > 25) {
    alert("Todo tidak boleh lebih dari 25 karakter.");
    return; // Menghentikan proses jika validasi gagal
  }

  if (todoText !== "") {
    // Membuat elemen li baru
    const li = document.createElement("li");
    li.classList.add("completed"); // Menambahkan class untuk status not-completed
    li.innerHTML = `
            <p>${todoText}</p>
            <i class='bx bx-trash'></i>  <!-- Ikon trash untuk menghapus todo -->
        `;

    // Menambahkan elemen li ke dalam todo list
    todoList.appendChild(li);

    // Menambahkan event listener untuk ikon trash
    const deleteButton = li.querySelector(".bx-trash");
    deleteButton.addEventListener("click", () => {
      // Menghapus item todo ketika ikon trash diklik
      li.remove();
      updateLocalStorage();
    });

    // Tambahkan todo ke localStorage
    saveTodoToLocalStorage(todoText);

    // Kosongkan input dan sembunyikan modal
    todoInput.value = "";
    todoModal.style.display = "none"; // Menyembunyikan modal setelah todo ditambahkan
  }
});

// Fungsi untuk menyimpan todo ke localStorage
function saveTodoToLocalStorage(todoText) {
  const todos = getTodosFromLocalStorage();
  const newTodo = {
    text: todoText,
    timestamp: new Date().getTime(), // Waktu saat todo ditambahkan
  };
  todos.push(newTodo);
  localStorage.setItem("todos", JSON.stringify(todos));
}
// Fungsi untuk mendapatkan todos dari localStorage
function getTodosFromLocalStorage() {
  const todos = localStorage.getItem("todos");
  return todos ? JSON.parse(todos) : [];
}
// Fungsi untuk memuat todo list dari localStorage
function loadTodos() {
  const todos = getTodosFromLocalStorage();
  const currentTime = new Date().getTime();
  todos.forEach((todo) => {
    // Hapus todo yang lebih dari 24 jam
    if (currentTime - todo.timestamp > 24 * 60 * 60 * 1000) {
      return; // Jangan tampilkan todo jika lebih dari 1 hari
    }
    const li = document.createElement("li");
    li.classList.add("completed"); // Menambahkan class untuk status not-completed
    li.innerHTML = `
            <p>${todo.text}</p>
            <i class='bx bx-trash'></i>
        `;
    // Menambahkan elemen li ke dalam todo list
    todoList.appendChild(li);
    // Menambahkan event listener untuk ikon trash
    const deleteButton = li.querySelector(".bx-trash");
    deleteButton.addEventListener("click", () => {
      // Menghapus item todo ketika ikon trash diklik
      li.remove();
      updateLocalStorage();
    });
  });
}
// Fungsi untuk memperbarui localStorage setelah item dihapus
function updateLocalStorage() {
  const todos = [];
  document.querySelectorAll(".todo-list li").forEach((item) => {
    todos.push({
      text: item.querySelector("p").textContent,
      timestamp: new Date().getTime(), // Memperbarui timestamp
    });
  });
  localStorage.setItem("todos", JSON.stringify(todos));
}
// Memuat todo list dari localStorage saat halaman dimuat
window.addEventListener("load", loadTodos);
