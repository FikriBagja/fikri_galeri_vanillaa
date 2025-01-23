<?php
session_start();
include('koneksi.php');

if ($_SESSION['status'] != 'login') {
    echo "<script>
        alert('Anda harus login terlebih dahulu!');
        location.href = '../index.php';
    </script>";
    exit;
}

if (isset($_POST['editProfile'])) {
    $userid = $_POST['userid'];
    $username = $_POST['username'];
    $namalengkap =  $_POST['namalengkap'];
    $email =  $_POST['email'];
    $alamat =  $_POST['alamat'];

    $query = "UPDATE user SET 
              username='$username', 
              namalengkap='$namalengkap', 
              email='$email', 
              alamat='$alamat' 
              WHERE userid='$userid'";
    $hasil = mysqli_query($koneksi, $query);

    if ($hasil) {
        echo "<script>
            alert('Data Berhasil Diperbarui');
            location.href = '../admin/profile.php';
        </script>";
    } else {
        echo "<script>
            alert('Data Gagal Diperbarui');
            location.href = '../admin/profile.php';
        </script>";
    }
}
?>
