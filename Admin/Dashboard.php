<?php
session_start();

if (!isset($_SESSION['valid']) || !isset($_SESSION['username'])) {  
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
    include '../layouts/admin/sidebar.php';
    include '../layouts/admin/header.php';
    ?>
    <main class="main container" id="main">
      <h1>Sidebar Menu</h1>
   </main>
</body>
</html>