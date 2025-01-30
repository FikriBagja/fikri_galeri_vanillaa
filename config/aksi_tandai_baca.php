<?php
session_start();
include '../config/koneksi.php';

$userid = $_SESSION['userid'];

$query = "UPDATE notifications SET is_read = 1 WHERE userid = '$userid' AND is_read = 0";
if (mysqli_query($koneksi, $query)) {
    header("Location: ../admin/notifikasi.php?status=berhasil_tandai");
    exit;
} else {
    header("Location: ../admin/notifikasi.php?status=gagal_tandai");
    exit;
}
?>
