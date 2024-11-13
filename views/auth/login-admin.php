<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="/login-admin" method="POST">
        <input type="text" name="username" placeholder="username">
        <?php if (isset($errors['username'])): ?>
            <div class="error-message">
                <?php foreach ($errors['username'] as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <input type="password" name="password" placeholder="password">
        <?php if (isset($errors['password'])): ?>
            <div class="error-message">
                <?php foreach ($errors['password'] as $error): ?>
                    <p><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <button type="submit">Submit</button>
    </form>
    <?php if(isset($error)) :?>
        <p><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
</body>
</html>