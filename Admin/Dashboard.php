<?php
session_start();

if (!isset($_SESSION['valid']) || !isset($_SESSION['username'])) {
    // Jika belum login, redirect ke halaman login
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Page</title>
</head>
<body>
<?php 
include '../layouts/adminside.php'; 
?>
</body>
</html>