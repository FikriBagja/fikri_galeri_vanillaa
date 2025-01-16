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

                </ul>
                <a href="register.php" class="btn btn-outline-primary m-1">Daftar</a>
                <a href="login.php" class="btn btn-outline-success m-1">Masuk</a>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
    <div class="row justify-content-center align-items-center h-screen mt-5" style="margin-top: 50px;">
        <div class="col-md-6">
            <div class="profile-card p-4 shadow-lg rounded bg-light" style="margin-top: 75px;">
                <h3 class="text-center text-primary mb-3">Selamat Datang Di Fikri Galeri</h3>
                <h5 class="text-center text-secondary">ingin melihat foto foto disini?</h5>
                <h5 class="text-center text-secondary mb-4">silahkan login terlebih dahulu!</h5>
                
                <div class="text-center">
                    <a href="login.php" class="btn btn-primary m-2">Masuk</a>
                    <span class="text-secondary">atau</span>
                    <a href="register.php" class="btn btn-success m-2">Daftar</a>
                </div>
            </div>
        </div>
    </div>
</div>
    <footer class="d-flex justify-content-center border-top mt-3 bg-light fixed-bottom">
        <p>&copy;Fikri Bagja Ramadhan</p>
    </footer>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>