<?php
session_start();
$userid = $_SESSION['userid'];
if ($_SESSION['status'] != 'login') {
    echo "<script>
    alert('Anda harus login terlebih dahulu!');
    location.href = '../index.php';
    </script>";
    exit;
}

include('../config/koneksi.php');

$user_id = $_SESSION['userid'];
$query = "SELECT * FROM user WHERE userid = $user_id";
$result = mysqli_query($koneksi, $query);
$user = mysqli_fetch_assoc($result);

$albums_query = "SELECT * FROM album WHERE userid = $user_id";
$albums_result = mysqli_query($koneksi, $albums_query);

$photos_query = "SELECT * FROM foto WHERE userid = $user_id";
$photos_result = mysqli_query($koneksi, $photos_query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fikri Galeri | Profile</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <style>
        .profile-card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            background-color: #fff;
            padding: 20px;
            text-align: center;
        }

        .profile-card img {
            border-radius: 50%;
            width: 150px;
            height: 150px;
            object-fit: cover;
            margin-bottom: 15px;
        }

        .album-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            background-color: #f9f9f9;
            margin-bottom: 20px;
        }

        .album-card img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .album-title {
            font-size: 1.25rem;
            font-weight: bold;
            margin-top: 10px;
        }

        .album-description {
            color: #555;
            margin-top: 5px;
        }

        .footer {
            background-color: #f8f9fa;
            color: #212529;
        }

        .album-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .album-item {
            flex: 0 0 48%;
        }

        .photo-info {
            margin-top: 10px;
            text-align: center;
        }

        .photo-title {
            font-weight: bold;
        }

        .photo-description {
            color: #777;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light shadow-lg p-3 bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="index.php">Fikri Galeri</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse mt-2" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="album.php" class="nav-link">Album</a>
                    </li>
                    <li class="nav-item">
                        <a href="foto.php" class="nav-link">Foto</a>
                    </li>
                </ul>
                <a href="profile.php" class="btn btn-outline-primary m-1">Profile</a>
                <a href="../config/aksi_logout.php" class="btn btn-outline-success m-1">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4 mb-4 p-3 d-flex justify-content-center">
        <div class="card p-4">
            <div class=" image d-flex flex-column justify-content-center align-items-center"> <button class="btn btn-secondary"> <img src="../assets/avatar/avatar.png" height="100" width="100" /></button> <span class="name mt-3"><strong><?php echo $user['namalengkap'] ?></strong></span> <span class="idd"><?php echo $user['email'] ?></span>
            </div>
        </div>
    </div>

    <div class="container mt-3">
    <div class="d-flex justify-content-between align-items-center w-100">
    <h3 class="text-secondary mb-0">Semua Foto <?php echo $user['username'] ?></h3>
    <div class="d-flex align-items-center">
        <h4 class="me-2 text-secondary">Album :</h4>
        <?php
        $album = mysqli_query($koneksi, "SELECT * FROM album WHERE userid='$userid'");
        while ($row = mysqli_fetch_assoc($album)) { ?>
            <a href="profile.php?albumid=<?php echo $row['albumid'] ?>" class="btn btn-outline-primary ms-2"><?php echo $row['namaalbum'] ?></a>
        <?php } ?>
    </div>
</div>
    <div class="row" style="margin-top : -20px">
        <?php
        if (isset($_GET['albumid'])) {
            $albumid = $_GET['albumid'];
            $query = mysqli_query($koneksi, "SELECT * FROM foto INNER JOIN user ON foto.userid=user.userid INNER JOIN album ON foto.albumid=album.albumid WHERE foto.albumid='$albumid' AND foto.userid='$userid'");
        } else {
            $query = mysqli_query($koneksi, "SELECT * FROM foto INNER JOIN user ON foto.userid=user.userid INNER JOIN album ON foto.albumid=album.albumid WHERE foto.userid='$userid'");
        }

        while ($data = mysqli_fetch_assoc($query)) { ?>
            <div class="col-md-3 mt-3">
                <a type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['fotoid'] ?>">
                    <div class="card">
                        <img style="height: 12rem;" src="../assets/img/<?php echo $data['lokasifile'] ?>" class="card-img-top" title="<?php echo $data['judulfoto'] ?>">
                        <div class="card-footer text-center">

                            <?php
                            $fotoid = $data['fotoid'];
                            $ceksuka = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'");

                            if (mysqli_num_rows($ceksuka) == 1) { ?>
                                <a href="../config/proses_like.php?fotoid=<?php echo $data['fotoid'] ?>" type="submit" name="batalsuka"> <i class="fa fa-heart"></i> </a>
                            <?php } else { ?>
                                <a href="../config/proses_like.php?fotoid=<?php echo $data['fotoid'] ?>" type="submit" name="suka"> <i class="fa-regular fa-heart"></i> </a>
                            <?php }

                            $like = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid'");
                            echo mysqli_num_rows($like) . ' Suka';
                            ?>
                            <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['fotoid'] ?>"> <i class="fa-regular fa-comment"></i> </a>
                            <?php
                            $jmlkomen = mysqli_query($koneksi, "SELECT * FROM komentarfoto WHERE fotoid = '$fotoid'");
                            echo mysqli_num_rows($jmlkomen) . ' Komentar';
                            ?>
                        </div>
                    </div>
                </a>
                <div class="modal fade" id="komentar<?php echo $data['fotoid'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <img src="../assets/img/<?php echo $data['lokasifile'] ?>" class="card-img-top" title="<?php echo $data['judulfoto'] ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <div class="m-2">
                                            <div class="overflow-auto">
                                                <div class="sticky-top">
                                                    <strong><?php echo $data['judulfoto'] ?></strong>
                                                </div>
                                                <p>Pembuat : <strong><?php echo $data['username'] ?></strong></p>                                                <span class="badge bg-secondary"><?php echo $data['tanggalunggah'] ?></span>
                                                <span class="badge bg-secondary"><?php echo $data['namaalbum'] ?></span>
                                                <hr>
                                                <p align="left"><?php echo $data['deskripsifoto'] ?></p>
                                                <hr>
                                                <form action="../config/proses_komentar.php" method="post">
                                                    <div class="input-group">
                                                        <input type="hidden" name="fotoid" value="<?php echo $data['fotoid'] ?>">
                                                        <input type="text" name="isikomentar" placeholder="tambah komentar" id="">
                                                        <div class="input-group-prepend">
                                                            <button type="submit" name="kirimkomentar" class="btn btn-outline-primary">Kirim</button>
                                                        </div>
                                                    </div>
                                                </form>
                                                <hr>
                                                <?php
                                                $fotoid = $data['fotoid'];
                                                $komentar = mysqli_query($koneksi, "SELECT * FROM komentarfoto inner join user on komentarfoto.userid = user.userid where komentarfoto.fotoid='$fotoid'");
                                                while ($row = mysqli_fetch_array($komentar)) { ?>
                                                    <p class="align-left">
                                                        <strong><?php echo $row['username'] ?></strong>
                                                        <?php echo $row['isikomentar'] ?>
                                                    </p>
                                                <?php } ?>

                                                <div class="sticky-bottom">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    </div>

    <footer class="footer d-flex justify-content-center border-top mt-5 py-3">
        <p>&copy;Fikri Bagja Ramadhan</p>
    </footer>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>