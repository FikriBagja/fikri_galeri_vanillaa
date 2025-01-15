<?php
include'koneksi.php';

$username = $_POST['username'];
$password = md5($_POST['password']);
$email = $_POST['email'];
$namalengkap = $_POST['namalengkap'];
$alamat = $_POST['alamat'];

$sql = mysqli_query($koneksi, "INSERT INTO user (username, password, email, namalengkap, alamat) 
VALUES ('$username', '$password', '$email', '$namalengkap', '$alamat')");

if ($sql) {
    echo "<script>
            alert('Berhasil menyimpan data, Silahkan login');
            window.location.href = '../login.php';
          </script>";
} else {
    echo "<script>
            alert('Gagal menyimpan data: " . mysqli_error($koneksi) . "');
            window.history.back(); // Kembali ke halaman sebelumnya
          </script>";
}
?>