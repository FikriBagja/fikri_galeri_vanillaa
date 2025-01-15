<?php
session_start();
if ($_SESSION['status'] != 'login') {
    echo "<script>
    alert('Anda harus login terlebih dahulu!');
    location.href = '../index.php'
    </script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fikri Galeri | Dashboard</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <style>
        /* Custom styles for profile card */
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

        .profile-card h3 {
            color: #333;
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .profile-card p {
            color: #777;
            font-size: 1rem;
        }

        .nav-link {
            font-size: 1.1rem;
        }

        .footer {
            background-color: #f8f9fa;
            color: #212529;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="index.php">Fikri Galeri</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse mt-2" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a href="album.php" class="nav-link">Album</a>
                    </li>
                    <li class="nav-item">
                        <a href="foto.php" class="nav-link">Foto</a>
                    </li>
                </ul>
                <a href="profile.php" class="btn btn-outline-primary m-1">Profile</a>
                <a href="../config/aksi_logout.php" class="btn btn-outline-success m-1">Keluar</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
    <div class="row justify-content-center align-items-center h-screen">
        <div class="col-md-6">
            <div class="profile-card p-4 shadow-lg rounded bg-light">
                <h3 class="text-center text-primary mb-3">Selamat Datang <?php echo $_SESSION['username']; ?>!</h3>
                <h5 class="text-center text-secondary mb-4">Mau apa nih hari ini?</h5>
                
                <div class="text-center">
                    <a href="album.php" class="btn btn-primary m-2">Tambah Album</a>
                    <span class="text-secondary">atau</span>
                    <a href="foto.php" class="btn btn-success m-2">Tambah Foto</a>
                </div>
            </div>
        </div>
    </div>
</div>


    <footer class="footer d-flex justify-content-center border-top mt-5 py-3 fixed-bottom">
        <p>&copy; UJIKOM RPL 2025 | Fikri Bagja Ramadhan</p>
    </footer>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>