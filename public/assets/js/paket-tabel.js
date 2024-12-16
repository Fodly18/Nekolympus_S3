const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');
allSideMenu.forEach(item=> {
	const li = item.parentElement;

	item.addEventListener('click', function () {
		allSideMenu.forEach(i=> {
			i.parentElement.classList.remove('active');
		})
		li.classList.add('active');
	})
});

//toggle sidebar
const menuBar = document.querySelector('#content nav .bx.bx-menu');
const sidebar = document.getElementById('sidebar');

menuBar.addEventListener('click', function () {
	sidebar.classList.toggle('hide');
})

// Cek keberadaan elemen-elemen yang berkaitan dengan search bar
const searchButton = document.querySelector('#content nav form .form-input button');
const searchButtonIcon = document.querySelector('#content nav form .form-input button .bx');
const searchForm = document.querySelector('#content nav form');

if (searchButton && searchButtonIcon && searchForm) {
    searchButton.addEventListener('click', function (e) {
        if (window.innerWidth < 576) {
            e.preventDefault();
            searchForm.classList.toggle('show');
            if (searchForm.classList.contains('show')) {
                searchButtonIcon.classList.replace('bx-search', 'bx-x');
            } else {
                searchButtonIcon.classList.replace('bx-x', 'bx-search');
            }
        }
    });

    window.addEventListener('resize', function () {
        if (window.innerWidth > 576) {
            searchButtonIcon.classList.replace('bx-x', 'bx-search');
            searchForm.classList.remove('show');
        }
    });
}

// Fungsi Dark Mode
const switchMode = document.getElementById('switch-mode');

switchMode.addEventListener('change', function () {
    if (this.checked) {
        document.body.classList.add('dark');
    } else {
        document.body.classList.remove('dark');
    }
});

// untuk filter search bar
const searchInput = document.getElementById('search-input');
const tableRows = document.querySelectorAll('table tbody tr');

searchInput.addEventListener('input', function () {
    const filter = searchInput.value.toLowerCase();
    tableRows.forEach(row => {
        const titleCell = row.querySelector('td:nth-child(2)');
        const titleText = titleCell 
            ? titleCell.textContent.toLowerCase().replace('...', '') // Hilangkan "..."
            : '';
        
        // Filter berdasarkan teks input
        if (titleText.includes(filter)) {
            row.style.display = ''; // Tampilkan baris
        } else {
            row.style.display = 'none'; // Sembunyikan baris
        }
    });
});



 // Pilih elemen modal dan tombol
 const modal = document.getElementById('confirmation-modal');
 const confirmButton = document.getElementById('confirm-button');
 const cancelButton = document.getElementById('cancel-button');
 let deleteUrl = '';

 // Pilih semua tombol hapus
 const deleteButtons = document.querySelectorAll('.delete-button');

deleteButtons.forEach(button => {
 button.addEventListener('click', function (event) {
     event.preventDefault(); // Cegah aksi default dari <a>
     deleteUrl = this.href;  // Ambil URL penghapusan
     modal.classList.remove('hidden'); // Tampilkan modal
 });
});


 // Tombol batal pada modal
 cancelButton.addEventListener('click', (event) => {
     event.preventDefault(); // Pastikan tidak ada aksi default
     modal.classList.add('hidden'); // Sembunyikan modal
     deleteUrl = ''; // Reset URL
 });

 // Tombol hapus pada modal
 confirmButton.addEventListener('click', (event) => {
     event.preventDefault(); // Pastikan tidak ada aksi default
     if (deleteUrl) {
         window.location.href = deleteUrl; // Lanjutkan penghapusan
     }
     modal.classList.add('hidden'); // Sembunyikan modal
 });

 // Cegah modal menutup jika klik di dalam konten modal
 modal.addEventListener('click', (event) => {
     if (event.target === modal) {
         modal.classList.add('hidden');
     }
 });