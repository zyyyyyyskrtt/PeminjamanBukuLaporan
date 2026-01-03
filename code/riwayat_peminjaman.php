<?php
include 'koneksi.php';

/* =========================
   PROSES HAPUS
========================= */
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];

    // ambil id buku dulu
    $q = mysqli_query($conn, "SELECT id_buku FROM peminjaman WHERE id_pinjam='$id'");
    $d = mysqli_fetch_assoc($q);

    // kembalikan stok
    mysqli_query($conn, "UPDATE buku SET stok = stok + 1 WHERE id_buku='$d[id_buku]'");

    // hapus peminjaman
    mysqli_query($conn, "DELETE FROM peminjaman WHERE id_pinjam='$id'");

    header("Location: riwayat_peminjaman.php");
    exit;
}

/* =========================
   PROSES EDIT STATUS
========================= */
if (isset($_GET['kembali'])) {
    $id = $_GET['kembali'];

    mysqli_query($conn, "UPDATE peminjaman SET status='Dikembalikan' WHERE id_pinjam='$id'");

    header("Location: riwayat_peminjaman.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Peminjaman</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
<div class="card shadow">
<div class="card-body">

<h3 class="page-title mb-4">📋 Riwayat Peminjaman Buku</h3>

<table class="table table-bordered table-striped">
<thead class="table-dark">
<tr>
    <th>No</th>
    <th>Nama Peminjam</th>
    <th>Judul Buku</th>
    <th>Tanggal Pinjam</th>
    <th>Deadline</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>
</thead>
<tbody>

<?php
$no = 1;
$query = mysqli_query($conn, "
    SELECT p.id_pinjam, u.nama_lengkap, b.judul, p.tgl_pinjam, p.deadline, p.status
    FROM peminjaman p
    JOIN users u ON p.id_user = u.id_user
    JOIN buku b ON p.id_buku = b.id_buku
    ORDER BY p.id_pinjam DESC
");

while ($data = mysqli_fetch_assoc($query)) {
?>
<tr>
    <td><?= $no++; ?></td>
    <td><?= $data['nama_lengkap']; ?></td>
    <td><?= $data['judul']; ?></td>
    <td><?= $data['tgl_pinjam']; ?></td>
    <td><?= $data['deadline']; ?></td>
    <td>
        <?php if ($data['status'] == 'Dipinjam') { ?>
            <span class="badge bg-warning text-dark">Dipinjam</span>
        <?php } else { ?>
            <span class="badge bg-success">Dikembalikan</span>
        <?php } ?>
    </td>
    <td>
        <?php if ($data['status'] == 'Dipinjam') { ?>
            <a href="?kembali=<?= $data['id_pinjam']; ?>" 
               class="btn btn-success btn-sm"
               onclick="return confirm('Tandai buku sebagai dikembalikan?')">
               Kembalikan
            </a>
        <?php } ?>

        <a href="?hapus=<?= $data['id_pinjam']; ?>" 
           class="btn btn-danger btn-sm"
           onclick="return confirm('Yakin hapus data ini?')">
           Hapus
        </a>
    </td>
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
