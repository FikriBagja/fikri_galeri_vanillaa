<?php
session_start();
include '../config/koneksi.php';
$userid = $_SESSION['userid'];
if ($_SESSION['status'] != 'login') {
    echo "<script>
    alert('Anda harus login terlebih dahulu!');
    location.href = '../index.php';
    </script>";
}
$albumid = isset($_GET['albumid']) ? $_GET['albumid'] : null;

// Function untuk mencetak laporan
function generateReport($koneksi, $userid, $albumid = null)
{
    $whereClause = "WHERE album.userid = '$userid'";
    if ($albumid) {
        $whereClause .= " AND album.albumid = '$albumid'";
    }

    $query = "SELECT album.albumid, album.namaalbum, 
                     (SELECT lokasifile FROM foto WHERE albumid = album.albumid ORDER BY tanggalunggah DESC LIMIT 1) as lokasifile,
                     COUNT(DISTINCT foto.fotoid) as jumlah_foto, 
                     COUNT(DISTINCT likefoto.likeid) as jumlah_like,    
                     COUNT(DISTINCT komentarfoto.komentarid) as jumlah_komen
              FROM album
              LEFT JOIN foto ON album.albumid = foto.albumid
              LEFT JOIN likefoto ON foto.fotoid = likefoto.fotoid
              LEFT JOIN komentarfoto ON foto.fotoid = komentarfoto.fotoid
              $whereClause
              GROUP BY album.albumid, album.namaalbum
              ORDER BY album.namaalbum";

    $result = mysqli_query($koneksi, $query);
    $data = [];

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    }

    return $data;
}

$reportData = generateReport($koneksi, $userid, $albumid);
$hitung_notif = "SELECT COUNT(*) AS belum_dibaca FROM notifications WHERE userid = '$userid' AND is_read = 0";
$hasil = mysqli_query($koneksi, $hitung_notif);
$belum_dibaca = mysqli_fetch_assoc($hasil)['belum_dibaca'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Galeri Foto</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.css">

    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .table th {
            background-color: #000;
            color: #fff;
        }

        .img-thumbnail {
            max-width: 100px;
            max-height: 100px;
            object-fit: cover;
        }

        .filter-form {
            margin-bottom: 20px;
        }

        @media print {
            .container {
                text-align: center;
            }

            .navbar {
                display: none;
            }

            .no-print {
                display: none;
            }

            h1 {
                margin-top: 50px;
                font-size: 24px;
            }

            .table {
                margin-top: 20px;
                margin-left: auto;
                margin-right: auto;
                width: 100%;
            }

            .header-print {
                display: block;
                margin-bottom: 20px;
                text-align: center;
                font-size: 16px;
            }

            .header-print span {
                display: inline-block;
                width: 45%;
            }
        }

        .yes {
            background-color: #000;
            color: #fff;
        }

        .yes:hover {
            border-color: #000;
            color: #000;
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
                        <a href="album.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'album.php') ? 'active' : ''; ?>">Album</a>
                    </li>
                    <li class="nav-item">
                        <a href="foto.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'foto.php') ? 'active' : ''; ?>">Foto</a>
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
                <a href="laporan.php" class="nav-link position-relative" style="margin-right: 30px; margin-bottom: 15px; margin-top:14px;">
                    <i class="fa fa-file-text-o" style="font-weight: bold; font-size: 1.3em;"></i>
                </a>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1 class="mt-3 text-secondary">Laporan</h1>
        
        <!-- Filter Album -->
        <div class="filter-form no-print">
            <form method="GET" action="laporan.php">
                <div class="row">
                    <div class="col-md-4">
                        <select name="albumid" class="form-control">
                            <option value="">Semua Album</option>
                            <?php
                            $albums_query = "SELECT * FROM album WHERE userid = '$userid'";
                            $albums_result = mysqli_query($koneksi, $albums_query);
                            while ($album = mysqli_fetch_assoc($albums_result)) :
                            ?>
                                <option value="<?php echo $album['albumid']; ?>" <?php if ($albumid == $album['albumid']) echo 'selected'; ?>>
                                    <?php echo $album['namaalbum']; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary">Filter</button>
                        <button type="button" class="btn yes" onclick="printReport()">Cetak Laporan</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Laporan Header - Username dan Tanggal -->
        <div id="print-header" class="header-print no-print" style="display: none; margin-top:50px;">
            <span>Username: <?php echo $_SESSION['username']; ?></span>
            <span id="print-date">Tanggal Cetak: </span>
        </div>

        <!-- Tabel Laporan -->
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Foto Album</th>
                    <th>Nama Album</th>
                    <th>Jumlah Foto</th>
                    <th>Jumlah Like</th>
                    <th>Jumlah Komentar</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($reportData) > 0) : ?>
                    <?php foreach ($reportData as $key => $row) : ?>
                        <tr>
                            <td><?php echo $key + 1; ?></td>
                            <td>
                                <?php if ($row['lokasifile']) : ?>
                                    <img src="../assets/img/<?php echo $row['lokasifile']; ?>" alt="Foto Album" class="img-thumbnail">
                                <?php else : ?>
                                    Tidak Ada Foto
                                <?php endif; ?>
                            </td>
                            <td><?php echo $row['namaalbum']; ?></td>
                            <td><?php echo $row['jumlah_foto']; ?></td>
                            <td><?php echo $row['jumlah_like']; ?></td>
                            <td><?php echo $row['jumlah_komen']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="6">Tidak ada data.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script>
        function printReport() {
            // Menampilkan header untuk username dan tanggal cetak
            var header = document.getElementById('print-header');
            header.style.display = 'block';
            
            // Mengambil tanggal saat ini
            var currentDate = new Date();
            var dateString = currentDate.toLocaleDateString('id-ID', {
                weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
            });

            // Menampilkan tanggal cetak di header
            document.getElementById('print-date').innerText = 'Tanggal Cetak: ' + dateString;

            // Menambahkan event listener untuk menyembunyikan header setelah cetak
            window.onafterprint = function() {
                header.style.display = 'none';
            };

            // Mencetak laporan
            window.print();
        }
    </script>

    <script src="../assets/js/bootstrap.min.js"></script>
</body>

</html>
