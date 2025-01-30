<?php
session_start();
include '../config/koneksi.php';

// Pastikan pengguna sudah login
if ($_SESSION['status'] != 'login') {
    echo "<script>
    alert('Anda harus login terlebih dahulu!');
    location.href = '../index.php'
    </script>";
    exit;
}

$userid = $_SESSION['userid'];

// Hapus semua notifikasi milik user yang login
$query = "DELETE FROM notifications WHERE userid = '$userid'";

if (mysqli_query($koneksi, $query)) {
    echo "<script>
    alert('Semua notifikasi berhasil dihapus.');
    location.href = '../admin/notifikasi.php';
    </script>";
} else {
    echo "<script>
    alert('Terjadi kesalahan saat menghapus notifikasi: " . mysqli_error($koneksi) . "');
    location.href = '../admin/notifikasi.php';
    </script>";
}
?>
