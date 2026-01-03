<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Sistem Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav class="navbar navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand">📚 Perpustakaan</a>
    <div>
      <a href="tambah_user.php" class="btn btn-outline-light btn-sm">User</a>
      <a href="tambah_buku.php" class="btn btn-outline-light btn-sm">Buku</a>
      <a href="pinjam.php" class="btn btn-outline-light btn-sm">Peminjaman</a>
    </div>
  </div>
</nav>

<div class="container mt-4">
    <div class="card shadow">
        <div class="card-body">
            <h3 class="page-title">📖 Data Buku</h3>

            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Judul</th>
                        <th>Pengarang</th>
                        <th>Stok</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $q = mysqli_query($conn, "SELECT * FROM buku");
                while ($d = mysqli_fetch_assoc($q)) {
                ?>
                    <tr>
                        <td><?= $d['judul']; ?></td>
                        <td><?= $d['pengarang']; ?></td>
                        <td><span class="badge bg-success"><?= $d['stok']; ?></span></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<footer>
    Sistem Perpustakaan © 2026
</footer>

</body>
</html>
