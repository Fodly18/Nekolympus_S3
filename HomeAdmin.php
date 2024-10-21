<?php 
   session_start();

   include("./Connection/koneksi.php");
   if(!isset($_SESSION['valid'])){
    header("Location: Login.php");
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Home</title>
</head>
<body>
    <div class="nav">
        <div class="right-links">
            <?php 
            $id = $_SESSION['admin_id'];
            $query = mysqli_query($connection,"SELECT * FROM tb_admin WHERE admin_id=$id");

            while($result = mysqli_fetch_assoc($query)){
                $res_Uname = $result['Username'];
                $res_Email = $result['Email'];
            }
            ?>
        </div>
    </div>
    <main>
       <div class="main-box top">
          <div class="top">
            <div class="box">
                <p>Hello <b><?php echo $res_Uname ?></b>, Welcome</p>
            </div>
            <div class="box">
                <p>Your email is <b><?php echo $res_Email ?></b>.</p>
            </div>
          </div>
          <div class="bottom">
          </div>
       </div>

    </main>
</body>
</html>