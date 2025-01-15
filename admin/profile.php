<?php
session_start();
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

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="index.php">Fikri Galeri</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse mt-2" id="navbarNav">
                <ul class="navbar-nav me-auto">
                <li class="nav-item">
                        <a href="home.php" class="nav-link">Home</a>
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

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="profile-card">
                    <h3>Selamat Datang, <?php echo $user['username']; ?>!</h3>
                    <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
                    <p><strong>Alamat:</strong> <?php echo $user['alamat'] ?: 'Not set'; ?></p>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-12">
                <h4>Album <?php echo $_SESSION['username'] ?></h4>
                <div class="album-container">
                    <?php while ($album = mysqli_fetch_assoc($albums_result)) { ?>
                        <div class="album-item">
                            <div class="album-card">
                                <div class="d-flex justify-content-between">
                                    <h5 class="album-title text-start"><?php echo $album['namaalbum']; ?></h5>
                                    <p class="album-description text-end"><?php echo $album['deskripsi'] ?: 'No description available.'; ?></p>
                                </div>
                                <?php
                                $album_id = $album['albumid'];
                                $album_photos_query = "SELECT * FROM foto WHERE albumid = $album_id";
                                $album_photos_result = mysqli_query($koneksi, $album_photos_query);
                                ?>
                                <div class="row">
                                    <?php while ($photo = mysqli_fetch_assoc($album_photos_result)) { ?>
                                        <div class="col-md-4 mb-3">
                                            <img src="../assets/img/<?php echo $photo['lokasifile']; ?>" class="img-fluid" alt="Photo">
                                            <div class="photo-info">
                                                <p class="photo-title flex text-start"><?php echo $photo['judulfoto']; ?></p>
                                                <p class="photo-description flex text-start"><?php echo $photo['deskripsifoto'] ?: 'No description available.'; ?></p>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer d-flex justify-content-center border-top mt-5 py-3">
        <p>&copy; UJIKOM RPL 2025 | Fikri Bagja Ramadhan</p>
    </footer>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>