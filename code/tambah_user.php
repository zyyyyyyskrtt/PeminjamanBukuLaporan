<?php
include 'koneksi.php';
if (isset($_POST['simpan'])) {
    mysqli_query($conn, "INSERT INTO users VALUES (
        NULL,
        '$_POST[username]',
        '$_POST[password]',
        '$_POST[nama]'
    )");
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-light">

<div class="container mt-5">
<div class="card shadow">
<div class="card-body">
<h3 class="page-title">👤 Tambah User</h3>

<form method="post">
    <div class="mb-3">
        <label>Username</label>
        <input type="text" name="username" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Nama Lengkap</label>
        <input type="text" name="nama" class="form-control" required>
    </div>
    <button name="simpan" class="btn btn-primary">Simpan</button>
    <a href="index.php" class="btn btn-secondary">Kembali</a>
</form>

</div>
</div>
</div>

</body>
</html>
