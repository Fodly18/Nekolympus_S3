<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="/update/" method="post">
        <input type="hidden" name="id" value="<?= $data->id ?>">
        <input type="text" name="mapel" value="<?= $data->nama ?>">
        <button type="submit">buat</button>
    </form>
    <?php if (isset($errors['mapel'])): ?>
        <?php foreach ($errors['mapel'] as $error): ?>
            <p><?php echo htmlspecialchars($error); ?></p>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>