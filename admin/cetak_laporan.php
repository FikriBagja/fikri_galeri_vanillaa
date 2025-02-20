<?php
session_start();
include '../config/koneksi.php';

if ($_SESSION['status'] != 'login') {
    echo "<script>
    alert('Anda harus login terlebih dahulu!');
    location.href = '../index.php';
    </script>";
}

$userid = $_SESSION['userid'];

// Ambil data laporan (sesuaikan dengan logika filter yang ada di laporan.php)
$albumid = isset($_GET['albumid']) ? $_GET['albumid'] : null;
$sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'album.namaalbum';
$sort_order = isset($_GET['sort_order']) ? $_GET['sort_order'] : 'ASC';

// Function untuk mencetak laporan (ambil dari laporan.php atau sesuaikan)
function generateReport($koneksi, $userid, $albumid = null, $sort_by = 'album.namaalbum', $sort_order = 'ASC')
{
    $whereClause = "WHERE album.userid = '$userid'";
    if ($albumid) {
        $whereClause .= " AND album.albumid = '$albumid'";
    }

    $orderBy = "ORDER BY $sort_by $sort_order";

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
              $orderBy";

    $result = mysqli_query($koneksi, $query);
    $data = [];

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    }

    return $data;
}

$reportData = generateReport($koneksi, $userid, $albumid, $sort_by, $sort_order);

?>
<!DOCTYPE html>
<html>

<head>
    <title>Fikri Galeri | Cetak Laporan</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
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
            text-align: center;
        }

        .table th {
            background-color: #000;
            color: #000;
            text-align: center;
        }

        .img-thumbnail {
            max-width: 100px;
            max-height: 100px;
            object-fit: cover;
        }

        /* Gaya khusus cetak */
        @media print {
            body {
                font-size: 12pt;
            }

            .header {
                text-align: center;
                margin-bottom: 20px;
            }

            .user-info {
                margin-bottom: 10px;
            }

            .table {
                width: 100%;
            }

            .table th,
            .table td {
                border: 1px solid #000 !important;
                padding: 5px;
            }

            .img-thumbnail {
                max-width: 100px;
                max-height: 100px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Fikri Galeri</h1>
        </div>
        <br><br>
        <div class="user-info">
            Dicetak oleh: <?php echo $_SESSION['username']; ?><br>
            Tanggal: <?php echo date('d-m-Y H:i:s'); ?>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Foto Album</th>
                    <th>Nama Album</th>
                    <th style="width: 50px;">Jumlah Foto</th>
                    <th style="width: 50px;">Jumlah Like</th>
                    <th style="width: 50px;">Jumlah Komentar</th>
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
        window.print();
    </script>
</body>

</html>
