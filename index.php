<?php
session_start();
include 'config/koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fikri Galeri | Home</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <style>
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
        
        .custom-width{
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
    <div class="container mt-5">
        <div class="h-screen mt-5 row justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="p-4 mt-4 rounded shadow-lg mt-sm-negative mt-md-4 profile-card bg-light">
                    <h3 class="mb-3 text-center text-bold">Selamat Datang di Fikri Galeri!</h3>
                    <h5 class="text-center text-secondary">Temukan koleksi foto menarik dan inspiratif hanya di sini. Jelajahi, bagikan, dan nikmati setiap momen.</h5>
                    <div class="mt-4 text-center row">
                        <div class="mb-2 col-6 col-md-3 zoom">
                            <img src="assets/avatar/1 (1).jpg" class="rounded img-fluid custom-img"  alt="Foto 1">
                        </div>
                        <div class="mb-2 col-6 col-md-3 zoom">
                            <img src="assets/avatar/3.jpg" class="rounded img-fluid custom-img"  alt="Foto 2">
                        </div>
                        <div class="mb-2 col-6 col-md-3 zoom">
                            <img src="assets/avatar/1 (2).jpg" class="rounded img-fluid custom-img"  alt="Foto 3">
                        </div>
                        <div class="mb-2 col-6 col-md-3 zoom">
                            <img src="assets/avatar/2.jpg" class="rounded img-fluid custom-img"  alt="Foto 3">
                        </div>
                    </div>
                    <div class="text-center">
                        <a href="login.php" class="p-2 mt-3 rounded btn btn-primary custom-width">Masuk Untuk Memulai</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <footer class="py-3 mt-3 shadow-lg d-flex justify-content-center fixed-bottom">
        <p>&copy;Fikri Bagja Ramadhan</p>
    </footer> -->
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>