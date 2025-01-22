<?php
include('../config/koneksi.php');

if (isset($_GET['userid'])) {
    $userid = $_GET['userid'];
    $query = "UPDATE user SET status='rejected' WHERE userid='$userid'";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>
                alert('Pengguna ditolak!');
                location.href = '../admin.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menolak pengguna!');
                location.href = '../admin.php';
              </script>";
    }
}
?>
