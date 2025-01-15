<?php
session_start();
include '../config/koneksi.php';
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
    <title>Fikri Galeri</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="index.php">Fikri Galeri</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse mt-2" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <a href="album.php" class="nav-link">Album</a>
                    <a href="foto.php" class="nav-link">Foto</a>
                </ul>
                <a href="profile.php" class="btn btn-outline-primary m-1">Profile</a>
                <a href="../config/aksi_logout.php" class="btn btn-outline-success m-1">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-4">
                <div class="card mt-2">
                    <div class="card-header">Tambah Foto</div>
                    <div class="card-body">
                        <form action="../config/aksi_foto.php" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="nama_album" class="form-label">Judul Foto</label>
                                <input type="text" class="form-control" name="judulfoto" required>
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea class="form-control" name="deskripsifoto" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Album</label>
                                <select class="form-select" name="albumid" required>
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
                                <label for="" class="form-label">File</label>
                                <input type="file" class="form-control" name="lokasifile" required>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary mt-2">Tambah Data</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card mt-2">
                    <div class="card-header">Data Galeri Foto</div>
                    <div class="card-body">
                        <table class="table">
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
                                $no = 1;
                                $userid = $_SESSION['userid'];
                                $sql = mysqli_query($koneksi, "SELECT * FROM foto WHERE userid='$userid'");
                                while ($data = mysqli_fetch_array($sql)) {
                                ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><img src="../assets/img/<?php echo $data['lokasifile'] ?>" width="100" alt=""></td>
                                        <td style="width: 100px;"><?php echo $data['judulfoto'] ?></td>
                                        <td style="width: 184px;"><?php echo $data['deskripsifoto'] ?></td>
                                        <td><?php echo $data['tanggalunggah'] ?></td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit<?php echo $data['fotoid'] ?>">
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
                                                                        // Assuming you already have a session with user info
                                                                        $user_id = $_SESSION['userid'];  // Get the logged-in user's ID

                                                                        // Fetch albums that belong to the current logged-in user
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
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus<?php echo $data['fotoid'] ?>">
                                                hapus
                                            </button>

                                            <div class="modal fade" id="hapus<?php echo $data['fotoid'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">hapus</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="../config/aksi_foto.php" method="post">
                                                                <input type="hidden" name="fotoid" value="<?php echo $data['fotoid'] ?>">
                                                                <h5 class="text-center">Apakah anda yakin ingin menghapus foto <strong><?php echo $data['judulfoto'] ?></strong>?</h5>
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
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="d-flex justify-content-center border-top mt-3 bg-light fixed-bottom">
        <p>&copy; UJIKOM RPL 2025 | Fikri Bagja Ramadhan</p>
    </footer>

    <script src="../assets/js/bootstrap.min.js"></script>
</body>

</html>