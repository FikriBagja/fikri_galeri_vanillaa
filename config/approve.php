<?php
include('../config/koneksi.php');

if (isset($_GET['userid'])) {
    $userid = $_GET['userid'];
    $query = "UPDATE user SET status='approved' WHERE userid='$userid'";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>
                alert('Pengguna berhasil disetujui!');
                location.href = '../admin.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menyetujui pengguna!');
                location.href = '../admin.php';
              </script>";
    }
}
?>
