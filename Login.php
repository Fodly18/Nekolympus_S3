<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="../asset/logo.png" type="image/png">
    <title>Login Page</title>
    <link rel="stylesheet" href="./css/loginstyle.css">
</head>
<body>
    <div class="container">
        <?php
        include("./Connection/koneksi.php");

        try {
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

            if (isset($_POST['logIn'])) {
                $email = trim($_POST['email']);
                $password = $_POST['password'];

                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    throw new Exception("Format email tidak valid!");
                }

                $stmt = $connection->prepare("SELECT * FROM tb_admin WHERE email = ?");
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();

                if ($row && password_verify($password, $row['password'])) {
                    $_SESSION['valid'] = $row['email'];
                    $_SESSION['username'] = $row['nama'];
                    header("Location: HomeAdmin.php");
                    exit();
                } else {
                    throw new Exception("Email atau password salah!");
                }
            }
        } catch (Exception $e) {
            echo "<div class='message'><p>" . $e->getMessage() . "</p></div><br>";
            echo "<a href='javascript:self.history.back()'><button class='btn'>Kembali</button></a>";
        }
        ?>

        <div class="container-left">
            <h1>SDN 01 Kalisat</h1>
            <img src="../asset/duduk.png" alt="Login-png-duduk">
        </div>
        <div class="container-right">
            <h2>Log In</h2>
            <form method="post" action="">
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