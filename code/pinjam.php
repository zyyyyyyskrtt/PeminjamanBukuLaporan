<?php
include 'koneksi.php';

// PROSES PINJAM (POST → REDIRECT → GET)
if (isset($_POST['pinjam'])) {
    $user = $_POST['user'];
    $buku = $_POST['buku'];
    $tgl = date('Y-m-d');
    $deadline = date('Y-m-d', strtotime('+7 days'));

    mysqli_query($conn, "INSERT INTO peminjaman VALUES (
        NULL,
        '$user',
        '$buku',
        '$tgl',
        '$deadline',
        'Dipinjam'
    )");

    mysqli_query($conn, "UPDATE buku SET stok = stok - 1 WHERE id_buku='$buku'");

    header("Location: pinjam.php?status=sukses");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Peminjaman Buku</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS Custom -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav class="navbar navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php">📚 Perpustakaan</a>
    <a href="index.php" class="btn btn-outline-light btn-sm">Dashboard</a>
  </div>
</nav>

<div class="container mt-5">

    <?php if (isset($_GET['status']) && $_GET['status'] == 'sukses') { ?>
        <div class="alert alert-success">
            ✅ Buku berhasil dipinjam!
        </div>
    <?php } ?>

    <div class="card shadow">
        <div class="card-body">
            <h3 class="page-title mb-4">📄 Peminjaman Buku</h3>

            <form method="post">
                <div class="mb-3">
                    <label class="form-label">User</label>
                    <select name="user" class="form-select" required>
                        <option value="">-- Pilih User --</option>
                        <?php
                        $u = mysqli_query($conn, "SELECT * FROM users");
                        while ($d = mysqli_fetch_assoc($u)) {
                            echo "<option value='$d[id_user]'>$d[nama_lengkap]</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Buku</label>
                    <select name="buku" class="form-select" required>
                        <option value="">-- Pilih Buku --</option>
                        <?php
                        $b = mysqli_query($conn, "SELECT * FROM buku WHERE stok > 0");
                        while ($d = mysqli_fetch_assoc($b)) {
                            echo "<option value='$d[id_buku]'>$d[judul] (Stok: $d[stok])</option>";
                        }
                        ?>
                    </select>
                </div>

                <button name="pinjam" class="btn btn-success">Pinjam</button>
                <a href="index.php" class="btn btn-secondary">Kembali</a>
            </form>

        </div>
    </div>
</div>

<footer>
    Sistem Perpustakaan © 2026
</footer>

</body>
</html>
