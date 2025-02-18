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
    <title>Fikri Galeri | Album</title>
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

        .btn-approve {
            background-color: #28a745;
            width: 90px;
            color: white;
        }

        .btn-approve:hover {
            background-color: #218838;
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
                <a href="profile.php" class="nav-link position-relative" style="margin-right: 30px; margin-bottom: 15px; margin-top:15px;">
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
            <h2 class="text-secondary">Album <?php echo $user['username'] ?></h2>
            <h3><a href="tambah_album.php" class="btn hitam" style="width: 150px;">Tambah Album</a></h3>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table mt-3 table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Album</th>
                                <th>Deskripsi</th>
                                <th>Tanggal Buat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $userid = $_SESSION['userid'];
                            $per_page = 5;
                            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                            $start_from = ($page - 1) * $per_page;

                            $sql = mysqli_query($koneksi, "SELECT * FROM album WHERE userid='$userid' LIMIT $start_from, $per_page");

                            $no = $start_from + 1;
                            while ($data = mysqli_fetch_array($sql)) {
                            ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $data['namaalbum'] ?></td>
                                    <td>
                                        <?php
                                        $deskripsi = $data['deskripsi'];
                                        $kata = explode(' ', $deskripsi);

                                        if (count($kata) > 10) {
                                            $deskripsi = implode(' ', array_slice($kata, 0, 10)) . '...';
                                        } else {
                                            $deskripsi = implode(' ', $kata);
                                        }

                                        echo $deskripsi;
                                        ?>
                                    </td>
                                    <td><?php echo $data['tanggalbuat'] ?></td>
                                    <td>
                                        <button type="button" class="btn yes" data-bs-toggle="modal" data-bs-target="#edit<?php echo $data['albumid'] ?>">
                                            Edit
                                        </button>

                                        <div class="modal fade" id="edit<?php echo $data['albumid'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="../config/aksi_album.php" method="post">
                                                            <input type="hidden" name="albumid" value="<?php echo $data['albumid'] ?>">
                                                            <div class="mb-3">
                                                                <label for="nama_album" class="form-label">Nama Album</label>
                                                                <input type="text" class="form-control" id="namaalbum" name="namaalbum" value="<?php echo $data['namaalbum'] ?>" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                                                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required><?php echo $data['deskripsi'] ?></textarea>
                                                            </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" name="edit" class="btn btn-primary">Edit Data</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="button" class="btn btn-reject" data-bs-toggle="modal" data-bs-target="#hapus<?php echo $data['albumid'] ?>">
                                            Hapus
                                        </button>

                                        <div class="modal fade" id="hapus<?php echo $data['albumid'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="../config/aksi_album.php" method="post">
                                                            <input type="hidden" name="albumid" value="<?php echo $data['albumid'] ?>">
                                                            <h5 class="text-center">Apakah Anda yakin ingin menghapus album <strong><?php echo $data['namaalbum'] ?></strong>?</h5>
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
                    $result = mysqli_query($koneksi, "SELECT COUNT(albumid) AS total FROM album WHERE userid='$userid'");
                    $row = mysqli_fetch_array($result);
                    $total_records = $row['total'];
                    $total_pages = ceil($total_records / $per_page);

                    echo '<nav aria-label="Page navigation example"><ul class="pagination justify-content-center">';
                    for ($i = 1; $i <= $total_pages; $i++) {
                        echo '<li class="page-item"><a class="page-link" href="album.php?page=' . $i . '">' . $i . '</a></li>';
                    }
                    echo '</ul></nav>';
                    ?>
                </div>
            </div>
        </div>
    </div>


    <!-- <footer class="py-3 mt-5 shadow-lg d-flex justify-content-center text-center">
        <p>&copy;Fikri Bagja Ramadhan</p>
    </footer> -->

    <script src="../assets/js/bootstrap.min.js"></script>
</body>

</html>