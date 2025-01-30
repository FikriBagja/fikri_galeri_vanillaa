<?php
session_start();
include '../config/koneksi.php';

if ($_SESSION['status'] != 'login') {
    header("Location: ../index.php");
    exit;
}

$userid = $_SESSION['userid'];

$query = "DELETE FROM notifications WHERE userid = '$userid'";

if (mysqli_query($koneksi, $query)) {
    header("Location: ../admin/notifikasi.php?status=success");
    exit;
} else {
    header("Location: ../admin/notifikasi.php?status=error");
    exit;
}
?>
