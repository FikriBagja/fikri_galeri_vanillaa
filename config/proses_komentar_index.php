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
        $result = mysqli_query($koneksi, "SELECT userid FROM foto WHERE fotoid='$fotoid'");
        $row = mysqli_fetch_assoc($result);
        $fotoOwnerId = $row['userid'];

        if ($fotoOwnerId != $userid) {
            $content = "mengomentari foto Anda";
            mysqli_query($koneksi, "INSERT INTO notifications (userid, action_userid, content, created_at) 
                                     VALUES ('$fotoOwnerId', '$userid', '$content', NOW())");
        }

        header("Location: ../admin/index.php?fotoid=$fotoid");
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>
