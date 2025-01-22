<?php
session_start();
include('config/koneksi.php');

// Pastikan hanya admin yang bisa mengakses halaman ini
if ($_SESSION['roleid'] != 1) { // 1 berarti admin
    header("Location: login.php");
    exit;
}

// Mengambil daftar pengguna yang statusnya 'pending'
$query = "SELECT * FROM user WHERE status='pending'";
$result = mysqli_query($koneksi, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Verifikasi Pengguna</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light shadow-lg p-3 bg-body-tertiary">
    <div class="container">
        <a class="navbar-brand" href="index.php">Fikri Galeri</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a href="admin.php" class="nav-link">Verifikasi Pengguna</a>
                </li>
            </ul>
            <a href="config/aksi_logout.php" class="btn btn-outline-success m-1">Logout</a>
        </div>
    </div>
</nav>

<div class="container py-5">
    <h2 class="text-center">Verifikasi Pengguna</h2>
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Email</th>
                <th>Nama Lengkap</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                        <td>{$no}</td>
                        <td>{$row['username']}</td>
                        <td>{$row['email']}</td>
                        <td>{$row['namalengkap']}</td>
                        <td>{$row['status']}</td>
                        <td>
                            <a href='config/approve.php?userid={$row['userid']}' class='btn btn-success btn-sm'>Setujui</a>
                            <a href='config/reject.php?userid={$row['userid']}' class='btn btn-danger btn-sm'>Tolak</a>
                        </td>
                    </tr>";
                $no++;
            }
            ?>
        </tbody>
    </table>
</div>

<footer class="d-flex justify-content-center border-top bg-light py-3">
    <p>&copy; Fikri Bagja Ramadhan</p>
</footer>

<script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
