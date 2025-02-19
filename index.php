<?php
session_start();
include 'config/koneksi.php';
$filter = isset($_GET['filter']) ? $_GET['filter'] : 'tanggal';
$order = isset($_GET['order']) && in_array(strtoupper($_GET['order']), ['ASC', 'DESC']) ? $_GET['order'] : 'DESC';

$query = "SELECT * FROM foto 
          INNER JOIN user ON foto.userid = user.userid 
          INNER JOIN album ON foto.albumid = album.albumid ORDER BY RAND()";

$photos_result = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fikri Galeri | Home</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
    <style>
        .comment-item {
            padding: 1px 0;
            margin-bottom: 1px;
        }

        .comment-author {
            font-weight: bold;
            margin-bottom: 3px;
        }

        .comment-text {
            font-size: 1rem;
            color: #333;
            flex: 1;
            margin-right: 10px;
        }

        .comment-content {
            display: flex;
            flex-direction: column;
        }

        .comment-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: -6px;
        }

        .comment-date {
            font-size: 0.8em;
            margin-top: -10px;
        }

        .btn-outline-success {
            border-color: #000;
            color: #000;
        }

        .btn-outline-success:hover {
            background-color: #000;
            color: #fff;
        }

        .zoom img {
            transition: transform 0.3s ease;
        }

        .zoom:hover img {
            transform: scale(1.1);
        }

        .custom-img {
            width: 100%;
            height: 100px;
            object-fit: cover;
        }

        .custom-width {
            width: 500px;
        }

        @media (max-width: 576px) {
            .mt-sm-negative {
                margin-top: 5px;
            }

            .custom-img {
                width: 200px;
                height: 175px;
            }

            .custom-width {
                width: 340px;
            }
        }

        .btn-cust {
            background-color: #000;
            color: #fff;
        }

        .btn-cust:hover {
            background-color: #000;
            color: #fff;
        }

        .hitam {
            border-color: #000;
            color: #000;
        }

        .hitam:hover {
            background-color: #000;
            color: #fff;
        }
    </style>
</head>

<body>
    <nav class="p-10 shadow-lg navbar navbar-expand-lg navbar-light bg-body-tertiary">
        <div class="container">
            <a class="fw-bold navbar-brand" href="index.php">Fikri Galeri</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="mt-2 collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">

                </ul>
                <a href="login.php" class="mb-2 btn btn-outline-success">Login</a>
            </div>
        </div>
    </nav>
    <div class="container mt-3" style=" margin-bottom:20px;">

        <h2 class="text-secondary">
            <a href="?filter=random" class="link-offset-2 link-underline link-underline-opacity-0 text-secondary">Semua Foto</a>
        </h2>

        <div class="row">

            <?php
            while ($data = mysqli_fetch_assoc($photos_result)) {
                $fotoid = $data['fotoid'];
            ?>
                <div class="col-md-3">
                    <a type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['fotoid'] ?>">
                        <div class="card">
                            <img style="height: 12rem;" src="assets/img/<?php echo $data['lokasifile'] ?>" class="card-img-top" title="<?php echo $data['judulfoto'] ?>">
                            <div class="text-center card-footer">
                                <a href="#" onclick="showModal()"><i class="fa fa-heart-o"></i></a>

                                <div id="modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; text-align: center; z-index: 9999;">
                                    <div style="background-color: white; padding: 20px; border-radius: 10px; width: 300px;">
                                        <p>Anda harus login dulu untuk menyukai foto</p>
                                        <button onclick="goBack()">Kembali</button>
                                        <button onclick="goToLogin()">Login</button>
                                    </div>
                                </div>
                                <?php
                                $like = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid'");
                                echo mysqli_num_rows($like) . ' Suka';
                                ?>

                                <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['fotoid'] ?>"> <i class="fa fa-comments-o"></i>
                                </a>
                                <?php
                                $jmlkomen = mysqli_query($koneksi, "SELECT * FROM komentarfoto WHERE fotoid = '$fotoid'");
                                echo mysqli_num_rows($jmlkomen) . ' Komentar';                                                                                                                                                                                                  ?>
                            </div>
                        </div>
                    </a>
                    <div class="modal fade" id="komentar<?php echo $data['fotoid'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <img src="assets/img/<?php echo $data['lokasifile'] ?>" class="card-img-top" title="<?php echo $data['judulfoto'] ?>">
                                        </div>
                                        <div class="col-md-4">
                                            <div class="m-2">
                                                <div class="overflow-auto">
                                                    <div class="sticky-top d-flex justify-content-between align-items-center">
                                                        <p><strong><?php echo $data['username'] ?></strong></p>
                                                        <!-- Tombol Unduh -->
                                                        <p class="btn hitam btn-sm" onclick="showModal2()">
                                                            <i class="fa fa-download"></i> Unduh
                                                        </p>

                                                        <!-- Modal -->
                                                        <div id="modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; text-align: center; z-index: 9999;">
                                                            <div style="background-color: white; padding: 20px; border-radius: 10px; width: 300px;">
                                                                <p>Anda harus login untuk mengunduh gambar.</p>
                                                                <button onclick="goBack()">Kembali</button>
                                                                <button onclick="goToLogin()">Login</button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <strong><?php echo $data['judulfoto'] ?></strong>
                                                    <p align="left" class="text-secondary" style="font-size: 0.9em;"><?php echo $data['deskripsifoto'] ?></p>
                                                    <span class="badge bg-secondary"><?php echo $data['tanggalunggah'] ?></span>
                                                    <span class="badge bg-secondary"><?php echo $data['namaalbum'] ?></span>

                                                    <hr>
                                                    <?php
                                                    $fotoid = $data['fotoid'];
                                                    $komentar = mysqli_query($koneksi, "SELECT * FROM komentarfoto INNER JOIN user ON komentarfoto.userid = user.userid WHERE komentarfoto.fotoid='$fotoid' AND reply_komen IS NULL");
                                                    ?>

                                                    <h5 class="mb-3 text-secondary" style="font-size: 0.7em">
                                                        <strong><?php echo mysqli_num_rows($komentar); ?> Komentar</strong>
                                                    </h5>

                                                    <?php while ($row = mysqli_fetch_array($komentar)) { ?>
                                                        <div class="comment-item">
                                                            <p class="comment-author">
                                                                <strong><?php echo $row['username']; ?></strong>
                                                            </p>
                                                            <div class="comment-content">
                                                                <p class="comment-text text-secondary" style="font-size: 0.9em;">
                                                                    <?php echo $row['isikomentar']; ?>
                                                                </p>
                                                            </div>
                                                        </div>

                                                        <?php
                                                        $replies = mysqli_query($koneksi, "SELECT * FROM komentarfoto INNER JOIN user ON komentarfoto.userid = user.userid WHERE reply_komen = '" . $row['komentarid'] . "'");
                                                        while ($reply = mysqli_fetch_array($replies)) {
                                                        ?>
                                                            <div class="comment-item" style="margin-left: 30px;">
                                                                <p class="comment-author">
                                                                    <strong><?php echo $reply['username']; ?></strong>
                                                                </p>
                                                                <div class="comment-content">
                                                                    <p class="comment-text text-secondary" style="font-size: 0.9em;">
                                                                        <?php echo $reply['isikomentar']; ?>
                                                                    </p>
                                                                    <p class="comment-date" style="margin-top: -17px;">
                                                                        <small><?php echo date('d M Y', strtotime($reply['tanggalkomentar'])); ?></small>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
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
    <script>
        function showModal() {
            document.getElementById("modal").style.display = "flex";
        }

        function goBack() {
            document.getElementById("modal").style.display = "none";
        }

        function goToLogin() {
            window.location.href = "login.php";
        }

        function showModal2() {
            document.getElementById("modal").style.display = "flex";
        }

        // Menutup modal
        function goBack() {
            document.getElementById("modal").style.display = "none";
        }

        // Mengarahkan ke halaman login
        function goToLogin() {
            window.location.href = "login.php";
        }
    </script>

    <!-- <footer class="py-3 mt-3 shadow-lg d-flex justify-content-center fixed-bottom">
        <p>&copy;Fikri Bagja Ramadhan</p>
    </footer> -->


    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>