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


// Fungsi Dark Mode disimpan di localstorage agar tidak ke reset
const switchMode = document.getElementById('switch-mode');
document.addEventListener('DOMContentLoaded', () => {
    const darkModeEnabled = localStorage.getItem('darkMode') === 'enabled';
    if (darkModeEnabled) {
        document.body.classList.add('dark');
        switchMode.checked = true; 
    }
});

switchMode.addEventListener('change', function () {
    if (this.checked) {
        document.body.classList.add('dark');
        localStorage.setItem('darkMode', 'enabled'); 
    } else {
        document.body.classList.remove('dark');
        localStorage.setItem('darkMode', 'disabled'); 
    }
});



//fungsi search bar
const searchButton = document.getElementById('search-button');
const searchInput = document.getElementById('search-input');
const tableRows = document.querySelectorAll('table tbody tr');

// Pastikan elemen-elemen ada
if (searchButton && searchInput && tableRows.length > 0) {
    // Tambahkan event listener pada tombol search
    searchButton.addEventListener('click', function () {
        const filter = searchInput.value.toLowerCase().trim();

        tableRows.forEach(row => {
            const titleCell = row.querySelector('td:nth-child(2)');
            const titleText = titleCell 
                ? titleCell.textContent.toLowerCase().replace('...', '') // Hilangkan "..."
                : '';

            // Filter berdasarkan teks input
            if (filter !== '' && titleText.includes(filter)) {
                row.style.display = ''; // Tampilkan baris
            } else {
                row.style.display = 'none'; // Sembunyikan baris
            }
        });

        // Tambahkan feedback jika tidak ada hasil pencarian
        if (!Array.from(tableRows).some(row => row.style.display === '')) {
            console.log('Tidak ada hasil yang cocok.');
            alert('Tidak ada hasil yang cocok dengan kata kunci Anda.');
        }
    });
}



//buat confimaasi delete pada tabel
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