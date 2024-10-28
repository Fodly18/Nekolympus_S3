<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
    <link rel="icon" href="/assets/img/logo.png" type="image/png">
	<link rel="stylesheet" type="text/css" href="/assets/css/loginstyle.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<img class="wave" src="/assets/img/wavelog.png">
	<div class="container">
		<div class="img">
			<img src="/assets/img/bglogin.svg">
		</div>
		<div class="login-content">
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
                    header("Location: /DashAdmin.php");
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
            <form action="" method="post">
				<img src="/assets/img/avlogin.svg">
				<h2 class="title">Welcome</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Username</h5>
           		   		<input type="text" class="input">
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Password</h5>
           		    	<input type="password" class="input">
            	   </div>
            	</div>
            	<a href="ForgotPass.php">Forgot Password?</a>
            	<input type="submit" class="btn" value="Login">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="/assets/js/login.js"></script>
</body>
</html>