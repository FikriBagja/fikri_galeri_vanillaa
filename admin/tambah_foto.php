<?php
include '../config/koneksi.php';
session_start();
if ($_SESSION['status'] != 'login') {
    echo "<script>
    alert('Anda harus login terlebih dahulu!');
    location.href = '../index.php'
    </script>";
}
$userid = $_SESSION['userid'];

$hitung_notif = "SELECT COUNT(*) AS belum_dibaca FROM notifications WHERE userid = '$userid' AND is_read = 0";
$hasil = mysqli_query($koneksi, $hitung_notif);
$belum_dibaca = mysqli_fetch_assoc($hasil)['belum_dibaca'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fikri Galeri | Tambah Foto</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.css">
    <style>
        .navbar-nav .nav-link:hover {
            background-color: #f1f1f1;
            color: #007bff;
            transition: all 0.3s ease;
        }

        .navbar-nav .nav-link i:hover {
            color: #007bff;
            transition: color 0.3s ease;
        }

        .navbar-light .navbar-nav .nav-link {
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .navbar-nav .nav-link.active {
            background-color: #000;
            color: white;
            border-radius: 5px;
            font-weight: bold;
        }

        .navbar-nav .nav-link:hover {
            background-color: #f1f1f1;
            color: #000;
            transition: all 0.3s ease;
        }


        .table th,
        .table td {
            vertical-align: middle;
        }

        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6;
            text-align: center;
        }

        .table th {
            background-color: #007bff;
            color: white;
        }

        .table td {
            background-color: #ffffff;
        }

        .btn-custom {
            padding: 6px 12px;
            font-size: 0.875rem;
            border-radius: 4px;
        }

        .btn-ya {
            background-color: #000;
            color: white;
        }

        .btn-ya:hover {
            border-color: #000;
            color: #000;

        }
        .hitam {
            border-color: #000;
            color: #000;
        }

        .hitam:hover {
            background-color: #000;
            color: #fff;
        }
        .custom-mt{
            margin-top: 20px;
        }
        @media (max-width: 576px) {
            .custom-mt{
                margin-top: 90px !important;
            }
        }
    </style>
</head>

<body>
    <nav class="p-10 shadow-lg navbar navbar-expand-lg navbar-light bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand fw-bold" href="index.php">Fikri Galeri</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="mt-1 collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="album.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'album.php' || basename($_SERVER['PHP_SELF']) == 'tambah_album.php') ? 'active' : ''; ?>">Album</a>
                    </li>
                    <li class="nav-item">
                        <a href="foto.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'foto.php' || basename($_SERVER['PHP_SELF']) == 'tambah_foto.php') ? 'active' : ''; ?>">Foto</a>
                    </li>
                </ul>
                <a href="profile.php" class="nav-link position-relative" style="margin-right: 30px; margin-bottom: 15px; margin-top:14px;">
                    <i class="fa fa-user-o" style="font-weight: bold; font-size: 1.3em;"></i>
                </a>
                <a href="notifikasi.php" class="nav-link position-relative">
                    <i class="fa fa-bell-o" style="font-weight: bold; font-size: 1.3em;"></i>
                    <span class="top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        <?php echo $belum_dibaca ?: '0'; ?>
                    </span>
                </a>
            </div>
        </div>
    </nav>

    <div class="container custom-mt">
        <h2 class="mt-3 text-secondary text-center">Tambah Foto</h2>
        <div class="mb-5 row justify-content-center">
            <div class="col-md-8">
                <div class="mt-3 border-0 shadow-sm card">
                    <div class="card-header bg-dark text-white">
                        <h5 class="card-title mb-0">Tambah Foto Baru</h5>
                    </div>
                    <div class="card-body">
                        <form action="../config/aksi_foto.php" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="judulfoto" class="form-label">Judul Foto</label>
                                <input type="text" class="form-control" id="judulfoto" name="judulfoto" placeholder="Masukkan judul foto" required>
                            </div>
                            <div class="mb-3">
                                <label for="deskripsifoto" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="deskripsifoto" name="deskripsifoto" rows="4" placeholder="Masukkan deskripsi foto" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="albumid" class="form-label">Album</label>
                                <select class="form-select" id="albumid" name="albumid" required>
                                    <option value="">Pilih Album</option>
                                    <?php
                                    $user_id = $_SESSION['userid'];
                                    $sql_album = mysqli_query($koneksi, "SELECT * FROM album WHERE userid = '$user_id'");
                                    while ($data = mysqli_fetch_array($sql_album)) {
                                    ?>
                                        <option value="<?php echo $data['albumid'] ?>"><?php echo $data['namaalbum'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="lokasifile" class="form-label">File</label>
                                <input type="file" class="form-control" id="lokasifile" name="lokasifile" required>
                            </div>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="submit" name="submit" class="btn btn-ya">Tambah Foto</button>
                                <button type="reset" class="btn hitam">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <footer class="py-3 mt-4 shadow-lg d-flex justify-content-center text-center bg-light">
        <p class="mb-0">&copy; Fikri Bagja Ramadhan</p>
    </footer> -->

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>