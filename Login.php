<?php
require("./Connection/koneksi.php");
session_start();

if (isset($_POST['logIn'])) {
    $email = trim($_POST['email']);
    $pass = $_POST['password'];

    if (!empty($email) && !empty($pass)) {
        if ($Connection) {
            $stmt = $Connection->prepare("SELECT * FROM tb_admin WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                if (password_verify($pass, $row['password'])) {
                    $_SESSION['admin_id'] = $row['admin_id'];
                    $_SESSION['nama'] = $row['nama'];
                    $_SESSION['level_id'] = $row['level_id'];
                    header('Location: HomeAdmin.php');
                    exit();
                } else {
                    $_SESSION['error'] = 'User atau password salah!';
                    header('Location: Login.php');
                    exit();
                }
            } else {
                $_SESSION['error'] = 'User tidak ditemukan!';
                header('Location: Login.php');
                exit();
            }
        } else {
            die("Koneksi database gagal!");
        }
    } else {
        echo 'Data tidak boleh kosong!';
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="../asset/logo.png" type="image/png">
    <title>Login Page</title>
    <link rel="stylesheet" href="/css/loginstyle.css">
</head>
<body>
    <div class="container">
        <div class="container-left">
            <h1>SDN 01 Kalisat</h1>
            <img src="../asset/duduk.png" alt="Login-png-duduk">
        </div>
        <div class="container-right">
            <h2>Log In</h2>
            <form method="post" action="Login.php">
                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" id="email" required>
                    <label for="email">Email</label>
                </div>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" id="password" required>
                    <label for="password">Password</label>
                </div>  
                <div class="remnreco">
                    <label>
                        <input type="checkbox" name="remember" id="remember">
                        Remember Me
                    </label>
                    <p class="recover">
                        <a href="Forgot.html">Forgot Password?</a>
                    </p>
                </div>
                <button type="submit" name="logIn">Log In</button>
            </form>
        </div>
    </div>
</body>
</html>