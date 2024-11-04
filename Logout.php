<?php
session_start();
session_unset(); // Menghapus semua variabel sesi
session_destroy(); // Mengakhiri sesi
header("Location: index.html"); // Redirect ke halaman login
exit;
?>
