<?php
include('koneksi.php');

if (isset($_POST['kirim'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $email = $_POST['email'];
    $namalengkap = $_POST['namalengkap'];
    $alamat = $_POST['alamat'];
    $role_id = 2; 
    $status = 'pending'; 

    $query = "INSERT INTO user (username, password, email, namalengkap, alamat, roleid, status) 
              VALUES ('$username', '$password', '$email', '$namalengkap', '$alamat', '$role_id', '$status')";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>
                alert('Pendaftaran berhasil! Tunggu konfirmasi admin');
                location.href = '../login.php';
              </script>";
    } else {
        echo "<script>
                alert('Pendaftaran gagal! Silakan coba lagi.');
                location.href = '../register.php';
              </script>";
    }
}
?>
