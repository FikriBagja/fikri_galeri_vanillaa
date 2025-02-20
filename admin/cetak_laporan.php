<?php
session_start();
require_once '../vendor/autoload.php'; // Sesuaikan path jika perlu
include '../config/koneksi.php';

use Dompdf\Dompdf;
use Dompdf\Options;

date_default_timezone_set('Asia/Jakarta');
// Pastikan user sudah login
if ($_SESSION['status'] != 'login') {
    echo "<script>
            alert('Anda harus login terlebih dahulu!');
            location.href = '../index.php';
          </script>";
    exit;
}

$userid = $_SESSION['userid'];

// Ambil parameter dari URL (misalnya, dari form filter)
$albumid = isset($_GET['albumid']) ? $_GET['albumid'] : null;
$sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'album.namaalbum';
$sort_order = isset($_GET['sort_order']) ? $_GET['sort_order'] : 'ASC';

// Fungsi untuk menghasilkan data laporan (gunakan fungsi yang sama dari laporan.php)
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

// Mulai buffering output
ob_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Laporan Galeri</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12pt;
            margin: 20px;
        }

        .header {
            text-align: center;
        }

        .header img {
            max-width: 100px;
            /* Ukuran logo */
        }

        h1 {
            margin: 0;
            font-size: 24pt;
        }

        h2 {
            margin: 0;
            font-size: 18pt;
        }

        p {
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        img {
            max-width: 80px;
            max-height: 80px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Fikri Galeri</h1>
        <p>jl Lorem ipsum dolor sit amet no 123</p>
        <p>082123456789 | fikrigaleri@gmail.com</p>
    </div>
    <hr style="border: 1px solid black;">
    <br>
    <div class="info">
        <h2>Laporan Album</h2>
        <p style="text-align: left; margin-top:20px;">Dicetak oleh: <?php echo $_SESSION['username']; ?></p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
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
                        <td><?php echo $row['namaalbum']; ?></td>
                        <td><?php echo $row['jumlah_foto']; ?></td>
                        <td><?php echo $row['jumlah_like']; ?></td>
                        <td><?php echo $row['jumlah_komen']; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="5">Tidak ada data.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
<br>
    <p>Terima kasih atas perhatian Anda.</p>
    <p style="text-align: right; margin-top:-25px;"> Cimahi, 
    <?php echo date('d-m-Y'); ?>
    </p>
    <p style="text-align: right; margin-top:65px; margin-right:10px;">.........................</p>
    <div>

    </div>
</body>

</html>
<?php
// Simpan output HTML ke dalam variabel
$html = ob_get_clean();

// Konfigurasi Dompdf
$options = new Options();
$options->set('defaultFont', 'Arial');

// Instantiate Dompdf dengan konfigurasi
$dompdf = new Dompdf($options);

// Load HTML
$dompdf->loadHtml($html);

// (Optional) Atur ukuran dan orientasi kertas
$dompdf->setPaper('A4', 'portrait');

// Render HTML sebagai PDF
$dompdf->render();

// Kirim PDF ke browser untuk diunduh
$filename = 'laporan_galeri_' . date('YmdHis') . '.pdf';
$dompdf->stream($filename, ['Attachment' => 1]);

exit(0);
?>