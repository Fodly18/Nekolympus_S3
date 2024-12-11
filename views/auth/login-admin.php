<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="/assets/css/login.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link rel="icon" href="/assets/img/logo.png" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />
    <title>Admin Login Page</title>
</head>

<body>
<div class="container" id="container">
    <div class="sign-in">
        <form action="/login-admin" method="POST">
        <h1>
            Selamat Datang<br>
            Di Login Admin
        </h1>
                <div class="error-global">
            <?php if (isset($errors['login'])): ?>
                <p><?php echo htmlspecialchars($errors['login']); ?></p>
            <?php endif; ?>
        </div>
                    <!-- Username Input -->
        <div class="input-group">
            <input type="text" name="username" placeholder="Username" />
            <div class="error-placeholder <?php echo isset($errors['username']) ? 'active' : ''; ?>">
                <?php if (isset($errors['username'])): ?>
                    <p><?php echo htmlspecialchars($errors['username'][0]); ?></p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Password Input -->
        <div class="input-group">
            <input type="password" name="password" id="password" placeholder="Password" />
            <div class="error-placeholder <?php echo isset($errors['password']) ? 'active' : ''; ?>">
                <?php if (isset($errors['password'])): ?>
                    <p><?php echo htmlspecialchars($errors['password'][0]); ?></p>
                <?php endif; ?>
            </div>
        </div>


            <!-- Login Button -->
            <button>Log In</button>
        </form>
    </div>
    <div class="toogle-container">
    <div class="toogle">
        <div class="toogle-panel">
            <h4>APLIKASI PEMBELAJARAN DIGITAL</h4>
            <h4>DAN</h4>
            <h4>MONITORING SISWA</h4>
            <br>
            <img src="/assets/img/logo.png" alt="logo">
            <br>
            <h2>SDN 1 KALISAT</h2>
        </div>
    </div>
</div>
</div>
</body>
</html>