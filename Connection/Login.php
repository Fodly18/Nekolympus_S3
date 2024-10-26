<?php
        include("koneksi.php");

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