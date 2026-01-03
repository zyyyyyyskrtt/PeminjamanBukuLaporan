<?php
include 'koneksi.php';
if (isset($_POST['simpan'])) {
    mysqli_query($conn, "INSERT INTO buku VALUES (
        NULL,
        '$_POST[judul]',
        '$_POST[pengarang]',
        '$_POST[stok]'
    )");
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-light">

<div class="container mt-5">
<div class="card shadow">
<div class="card-body">
<h3 class="page-title">➕ Tambah Buku</h3>

<form method="post">
    <div class="mb-3">
        <label>Judul</label>
        <input type="text" name="judul" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Pengarang</label>
        <input type="text" name="pengarang" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Stok</label>
        <input type="number" name="stok" class="form-control" required>
    </div>
    <button name="simpan" class="btn btn-primary">Simpan</button>
    <a href="index.php" class="btn btn-secondary">Kembali</a>
</form>

</div>
</div>
</div>

</body>
</html>
