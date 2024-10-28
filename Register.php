<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="icon" href="/assets/img/logo.png" type="image/png">
  <link rel="stylesheet" href="/assets/css/register.css">
  <title>Register Page</title>
</head>
<body>
  <div class="container">
    <div class="containerbx form-box">
      <?php
      include("./Connection/koneksi.php");

      try {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

        if (isset($_POST['register'])) {
          $fullname = trim($_POST['fullname']);
          $email = trim($_POST['email']);
          $password = $_POST['password'];
          $confirm_password = $_POST['confirm_password'];

          if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<div class='message'><p>Format email tidak valid!</p></div><br>";
          } 
          elseif (strlen($password) < 8) {
            echo "<div class='message'><p>Password minimal 8 karakter!</p></div><br>";
          } 

          elseif ($password !== $confirm_password) {
            echo "<div class='message'><p>Password dan konfirmasi password tidak cocok!</p></div><br>";
          } else {
            $stmt = $connection->prepare("SELECT email FROM tb_admin WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
              echo "<div class='message'><p>Email sudah terdaftar, coba gunakan email lain!</p></div><br>";
              echo "<a href='javascript:self.history.back()'><button class='btn'>Kembali</button></a>";
            } else {

              $hashed_password = password_hash($password, PASSWORD_DEFAULT);

              $stmt = $connection->prepare("INSERT INTO tb_admin (nama, email, password) VALUES (?, ?, ?)");
              $stmt->bind_param("sss", $fullname, $email, $hashed_password);
              $stmt->execute();

              header("Location: Login.php");
              exit();
            }
          }
        }
      } catch (Exception $e) {
        error_log($e->getMessage(), 3, '/var/log/app_errors.log');
        echo "<div class='message'><p>Terjadi kesalahan. Silakan coba lagi nanti.</p></div><br>";
        echo "<a href='javascript:self.history.back()'><button class='btn'>Kembali</button></a>";
      }
      ?>
      <form method="post" action="">
        <div class="field input mb-3">
          <i class="fa-solid fa-user"></i>
          <input type="text" name="fullname" placeholder="Full Name" id="fullname" required />
        </div>
        <div class="field input mb-3">
          <i class="fas fa-envelope"></i>
          <input type="email" name="email" placeholder="Email" id="email" required />
        </div>
        <div class="field input mb-3">
          <i class="fas fa-lock"></i>
          <input type="password" name="password" placeholder="Create Password" id="password" required />
        </div>
        <div class="field input mb-3">
          <i class="fas fa-lock"></i>
          <input type="password" name="confirm_password" placeholder="Confirm Password" id="confirm_password" required />
        </div>
        <button class="btn" type="submit" name="register">Register</button>
      </form>
    </div>
  </div>
</body>

</html>
