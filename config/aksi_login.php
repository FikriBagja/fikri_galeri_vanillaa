<?php
session_start();
include 'koneksi.php';

$username = $_POST['username'];
$password = md5($_POST['password']);

$query = mysqli_query($koneksi, "SELECT * FROM user WHERE BINARY username = '$username' AND password = '$password' AND status = 'approved'");

$cek = mysqli_num_rows($query);

if ($cek > 0) {
    $data = mysqli_fetch_array($query);
    $_SESSION['username'] = $data['username'];
    $_SESSION['userid'] = $data['userid'];
    $_SESSION['roleid'] = $data['roleid'];  
    $_SESSION['status'] = 'login';

    if ($data['roleid'] == 1) {
        echo "
        <script>
        alert('Login sebagai Admin berhasil!');
        location.href = '../admin.php'; 
        </script>
        ";
    } else if ($data['roleid'] == 2) {
        echo "
        <script>
        alert('Login sebagai Pengguna berhasil!');
        location.href = '../admin/index.php'; 
        </script>
        ";
    }
} else {
    echo "<script>
    alert('Username atau Password salah');
    location.href = '../login.php';
    </script>";
}
?>
