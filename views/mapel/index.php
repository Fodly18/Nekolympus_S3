<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Auto Increment</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 8px;
        }
    </style>
</head>
<body>
<button><a href="/create">tambah</a></button>
<table>
    <tr>
        <th>No</th>
        <th>Data</th>
    </tr>

    <?php foreach($data as $row):?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $row['nama'] ?></td>
            <td><button><a href="/update/<?= $row['id']?>">update</a></button></td>
            <td><form action="post"><button><a href="/delete/<?= $row['id']?>">delete</a></button></form></td>
        </tr> 
    <?php endforeach; ?>
</table>

</body>
</html>
