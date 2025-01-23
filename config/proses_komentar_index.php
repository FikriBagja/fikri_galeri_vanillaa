<?php
include '../config/koneksi.php';
session_start();

if (isset($_POST['kirimkomentar'])) {
    $fotoid = $_POST['fotoid'];
    $isikomentar = $_POST['isikomentar'];
    $userid = $_SESSION['userid'];

    if (isset($_POST['reply_komen'])) {
        $reply_komen = $_POST['reply_komen'];
        $query = "INSERT INTO komentarfoto (fotoid, userid, isikomentar, reply_komen, tanggalkomentar) 
                  VALUES ('$fotoid', '$userid', '$isikomentar', '$reply_komen', NOW())";
    } else {
        $query = "INSERT INTO komentarfoto (fotoid, userid, isikomentar, tanggalkomentar) 
                  VALUES ('$fotoid', '$userid', '$isikomentar', NOW())";
    }

    if (mysqli_query($koneksi, $query)) {
        header("Location: ../admin/index.php?fotoid=$fotoid");
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>
