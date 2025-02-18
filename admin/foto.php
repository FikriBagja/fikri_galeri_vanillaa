<?php
session_start();
include '../config/koneksi.php';
if ($_SESSION['status'] != 'login') {
    echo "<script>
    alert('Anda harus login terlebih dahulu!');
    location.href = '../index.php'
    </script>";
}
$userid = $_SESSION['userid'];
$query = "SELECT * FROM user WHERE userid = $userid";
$result = mysqli_query($koneksi, $query);
$user = mysqli_fetch_assoc($result);

$hitung_notif = "SELECT COUNT(*) AS belum_dibaca FROM notifications WHERE userid = '$userid' AND is_read = 0";
$hasil = mysqli_query($koneksi, $hitung_notif);
$belum_dibaca = mysqli_fetch_assoc($hasil)['belum_dibaca'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fikri Galeri | Foto</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.css">

    <style>
        .navbar-nav .nav-link:hover {
            background-color: #f1f1f1;
            color: #007bff;
            transition: all 0.3s ease;
        }

        .navbar-nav .nav-link i:hover {
            color: #fff;
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
            background-color: #000;
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


        .btn-reject {
            background-color: red;
            width: 75px;
            color: #fff;
        }

        .btn-reject:hover {
            border-color: red;
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

        .yes {
            background-color: #000;
            color: #fff;
            width: 75px;
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
            </div>
        </div>
    </nav>

    <div class="container mt-3">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="text-secondary">Foto <?php echo $user['username'] ?></h2>
            <h3><a href="tambah_foto.php" class="btn hitam" style="width: 150px;">Tambah Foto</a></h3>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table mt-3 table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Foto</th>
                                <th>Judul Foto</th>
                                <th>Deskripsi</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $userid = $_SESSION['userid'];
                            $per_page = 5;
                            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                            $start_from = ($page - 1) * $per_page;

                            $sql = mysqli_query($koneksi, "SELECT * FROM foto WHERE userid='$userid' LIMIT $start_from, $per_page");
                            $no = $start_from + 1;
                            while ($data = mysqli_fetch_array($sql)) {
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo $no++ ?></td>
                                    <td class="text-center"><img src="../assets/img/<?php echo $data['lokasifile'] ?>" width="100" alt=""></td>
                                    <td class="text-center"><?php echo $data['judulfoto'] ?></td>
                                    <td style="width: 400px;" class="text-left">
                                        <?php
                                        $deskripsi = $data['deskripsifoto'];
                                        $kata = explode(' ', $deskripsi);

                                        if (count($kata) > 10) {
                                            $deskripsi = implode(' ', array_slice($kata, 0, 10)) . '...';
                                        } else {
                                            $deskripsi = implode(' ', $kata); 
                                        }

                                        echo $deskripsi;
                                        ?>
                                    </td>
                                    <td class="text-center"><?php echo $data['tanggalunggah'] ?></td>
                                    <td class="text-center">
                                        <button type="button" class="btn yes" data-bs-toggle="modal" data-bs-target="#edit<?php echo $data['fotoid'] ?>">
                                            Edit
                                        </button>

                                        <div class="modal fade" id="edit<?php echo $data['fotoid'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="../config/aksi_foto.php" method="post" enctype="multipart/form-data">
                                                            <input type="hidden" name="fotoid" value="<?php echo $data['fotoid'] ?>">
                                                            <div class="mb-3">
                                                                <label for="nama_album" class="form-label">Judul Foto</label>
                                                                <input type="text" class="form-control" name="judulfoto" value="<?php echo $data['judulfoto'] ?>" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                                                <textarea class="form-control" name="deskripsifoto" value="<?php echo $data['deskripsifoto'] ?>" rows="3" required><?php echo $data['deskripsifoto'] ?></textarea>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Album</label>
                                                                <select class="form-select" name="albumid">
                                                                    <option value="">Pilih Album</option>
                                                                    <?php
                                                                    $user_id = $_SESSION['userid'];
                                                                    $sql_album = mysqli_query($koneksi, "SELECT * FROM album WHERE userid = '$user_id'");
                                                                    while ($data_album = mysqli_fetch_array($sql_album)) {
                                                                    ?>
                                                                        <option <?php if ($data_album['albumid'] == $data['albumid']) { ?> selected="selected" <?php } ?> value="<?php echo $data_album['albumid']; ?>">
                                                                            <?php echo $data_album['namaalbum']; ?>
                                                                        </option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                            <label for="" class="form-label">Foto</label>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="mb-3">
                                                                        <img src="../assets/img/<?php echo $data['lokasifile'] ?>" width="100" alt="">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <div class="mb-3">
                                                                        <label for="" class="form-label">Ganti File</label>
                                                                        <input type="file" class="form-control" name="lokasifile">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" name="edit" class="btn btn-primary">Edit Data</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-reject" data-bs-toggle="modal" data-bs-target="#hapus<?php echo $data['fotoid'] ?>">
                                            Hapus
                                        </button>

                                        <div class="modal fade" id="hapus<?php echo $data['fotoid'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="../config/aksi_foto.php" method="post">
                                                            <input type="hidden" name="fotoid" value="<?php echo $data['fotoid'] ?>">
                                                            <h5 class="text-center">Apakah Anda yakin ingin menghapus foto <strong><?php echo $data['judulfoto'] ?></strong>?</h5>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" name="hapus" class="btn btn-primary">Hapus Data</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <?php
                    $result = mysqli_query($koneksi, "SELECT COUNT(fotoid) AS total FROM foto WHERE userid='$userid'");
                    $row = mysqli_fetch_array($result);
                    $total_records = $row['total'];
                    $total_pages = ceil($total_records / $per_page);

                    echo '<nav aria-label="Page navigation example"><ul class="pagination justify-content-center">';
                    for ($i = 1; $i <= $total_pages; $i++) {
                        echo '<li class="page-item"><a class="page-link" href="foto.php?page=' . $i . '">' . $i . '</a></li>';
                    }
                    echo '</ul></nav>';
                    ?>
                </div>
            </div>
        </div>
    </div>


    <footer class="py-3 mt-5 shadow-lg d-flex justify-content-center">
        <p>&copy;Fikri Bagja Ramadhan</p>
    </footer>


    <script src="../assets/js/bootstrap.min.js"></script>
</body>

</html>