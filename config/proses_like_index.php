<?php
session_start();
include 'koneksi.php';

$fotoid = $_GET['fotoid'];
$userid = $_SESSION['userid'];

$ceksuka = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'");

if (mysqli_num_rows($ceksuka) == 1) {
    while ($row = mysqli_fetch_array($ceksuka)) {
        $likeid = $row['likeid'];
        $query = mysqli_query($koneksi, "DELETE FROM likefoto WHERE likeid='$likeid'");
    }
} else {
    $tanggallike = date('Y-m-d');
    $query = mysqli_query($koneksi, "INSERT INTO likefoto (likeid, fotoid, userid, tanggallike) 
                                      VALUES('', '$fotoid', '$userid', '$tanggallike')");

    if ($query) {
        $result = mysqli_query($koneksi, "SELECT userid FROM foto WHERE fotoid='$fotoid'");
        $row = mysqli_fetch_assoc($result);
        $fotoOwnerId = $row['userid'];

        if ($fotoOwnerId != $userid) {
            $content = "menyukai foto Anda.";
            mysqli_query($koneksi, "INSERT INTO notifications (userid, action_userid, content, created_at, fotoid) 
                                     VALUES ('$fotoOwnerId', '$userid', '$content', NOW(), '$fotoid')");
        }
    }
}

echo "<script>location.href='../admin/index.php';</script>";
?>
