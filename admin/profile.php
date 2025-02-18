<?php
session_start();
$userid = $_SESSION['userid'];
if ($_SESSION['status'] != 'login') {
    echo "<script>
    alert('Anda harus login terlebih dahulu!');
    location.href = '../index.php';
    </script>";
    exit;
}

include('../config/koneksi.php');

$user_id = $_SESSION['userid'];
$query = "SELECT * FROM user WHERE userid = $user_id";
$result = mysqli_query($koneksi, $query);
$user = mysqli_fetch_assoc($result);

$albums_query = "SELECT * FROM album WHERE userid = $user_id";
$albums_result = mysqli_query($koneksi, $albums_query);

$photos_query = "SELECT * FROM foto WHERE userid = $user_id";
$photos_result = mysqli_query($koneksi, $photos_query);

$hitung_notif = "SELECT COUNT(*) AS belum_dibaca FROM notifications WHERE userid = '$userid' AND is_read = 0";
$hasil = mysqli_query($koneksi, $hitung_notif);
$belum_dibaca = mysqli_fetch_assoc($hasil)['belum_dibaca'];

$filter = isset($_GET['filter']) ? $_GET['filter'] : 'tanggal';
$order = isset($_GET['order']) && in_array($_GET['order'], ['ASC', 'DESC']) ? $_GET['order'] : 'DESC';

$userid = isset($_SESSION['userid']) ? $_SESSION['userid'] : null;

$albumid = isset($_GET['albumid']) ? mysqli_real_escape_string($koneksi, $_GET['albumid']) : null;

if ($albumid) {
    $query = "SELECT * FROM foto 
              INNER JOIN user ON foto.userid=user.userid 
              INNER JOIN album ON foto.albumid=album.albumid 
              WHERE foto.albumid='$albumid' AND foto.userid='$userid'";
} else {
    $query = "SELECT * FROM foto 
              INNER JOIN user ON foto.userid=user.userid 
              INNER JOIN album ON foto.albumid=album.albumid 
              WHERE foto.userid='$userid'";
}

if ($filter == 'like') {
    $query .= " ORDER BY (SELECT COUNT(*) FROM likefoto WHERE likefoto.fotoid = foto.fotoid) $order";
} elseif ($filter == 'komen') {
    $query .= " ORDER BY (SELECT COUNT(*) FROM komentarfoto WHERE komentarfoto.fotoid = foto.fotoid) $order";
} elseif ($filter == 'tanggal') {
    $query .= " ORDER BY foto.tanggalunggah $order, foto.fotoid $order";
}

// Eksekusi query
$photos_result = mysqli_query($koneksi, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fikri Galeri | Profile</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <style>
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

        .album-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 15px;
            background-color: #f9f9f9;
            margin-bottom: 20px;
        }

        .album-card img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }

        .album-title {
            font-size: 1.25rem;
            font-weight: bold;
            margin-top: 10px;
        }

        .album-description {
            color: #555;
            margin-top: 5px;
        }

        .footer {
            background-color: #f8f9fa;
            color: #212529;
        }

        .album-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .album-item {
            flex: 0 0 48%;
        }

        .photo-info {
            margin-top: 10px;
            text-align: center;
        }

        .photo-title {
            font-weight: bold;
        }

        .photo-description {
            color: #777;
        }

        .comment-item {
            padding: 1px 0;
            margin-bottom: 1px;
        }

        .comment-author {
            font-weight: bold;
            margin-bottom: 3px;
        }

        .comment-text {
            font-size: 0.9em;
            color: #333;
            flex: 1;
            margin-right: 10px;
        }

        .comment-content {
            display: flex;
            flex-direction: column;
        }

        .comment-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: -6px;
        }

        .comment-date {
            font-size: 0.8em;
            margin-top: -10px;
        }

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
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            font-weight: bold;
        }

        .navbar-nav .nav-link:hover {
            background-color: #f1f1f1;
            color: #007bff;
            transition: all 0.3s ease;
        }

        .hitam {
            border-color: #000;
            color: #000;
        }

        .hitam:hover {
            background-color: #000;
            color: #fff;
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
                <a href="profile.php" class="nav-link position-relative" 
                    style="margin-right: 30px; margin-bottom: 15px; margin-top:10px;">
                    <i class="fa-regular fa-user" style="font-weight: bold; font-size: 1.3em;"></i>
                </a>
                <a href="notifikasi.php" class="nav-link position-relative">
                    <i class="fa-regular fa-bell" style="font-weight: bold; font-size: 1.3em;"></i>
                    <span class="top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        <?php echo $belum_dibaca ?: '0'; ?>
                    </span>
                </a>
            </div>
        </div>
    </nav>

    <div class="container p-5 d-flex justify-content-center" style="margin-bottom: 100px; margin-top: 70px;">
        <div class="card shadow-lg border-0 rounded-4" style="width: 350px;">
            <div class="d-flex justify-content-center mt-4">
                <img src="../assets/avatar/avatar.png" height="120" width="120" class="rounded-circle border border-4 border-primary" alt="Profile Picture" title="<?php echo $user['username'] ?>" />
            </div>
            <div class="card-body text-center">
                <h3 class="card-title fw-bold"><?php echo $user['username'] ?></h3>
                <p class="card-text text-muted"><?php echo $user['namalengkap'] ?></p>

                <div class="mt-4">
                    <button type="button" class="btn btn-primary w-100 mb-3" data-bs-toggle="modal" data-bs-target="#editProfileModal">Edit Profile</button>
                    <a href="../config/aksi_logout.php" class="btn btn-outline-danger w-100">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../config/aksi_profile.php" method="post">
                        <input type="hidden" name="userid" value="<?php echo $user['userid']; ?>">

                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" value="<?php echo $user['username']; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="namalengkap" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" name="namalengkap" value="<?php echo $user['namalengkap']; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="<?php echo $user['email']; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" name="alamat" rows="3" required><?php echo $user['alamat']; ?></textarea>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" name="editProfile" class="btn btn-success">Edit</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-3">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center w-100" style="margin-bottom: 15px;">
            <h2 class="text-secondary">
                <a href="?filter=random" class="link-offset-2 link-underline link-underline-opacity-0 text-secondary">Semua Foto <?php echo $_SESSION['username'] ?></a>
            </h2>
        </div>

        <form method="GET" action="profile.php" class="mb-3">
            <div class="row">
                <div class="mb-2 col-md-4">
                    <select name="filter" class="form-select text-center" id="filterSelect">
                        <option value="" selected disabled>Pilih Berdasarkan</option>
                        <option value="like" <?php echo (isset($_GET['filter']) && $_GET['filter'] == 'like') ? 'selected' : ''; ?>>Berdasarkan Like</option>
                        <option value="komen" <?php echo (isset($_GET['filter']) && $_GET['filter'] == 'komen') ? 'selected' : ''; ?>>Berdasarkan Komentar</option>
                        <option value="tanggal" <?php echo (isset($_GET['filter']) && $_GET['filter'] == 'tanggal') ? 'selected' : ''; ?>>Berdasarkan Tanggal Unggah</option>
                    </select>
                </div>
                <div class="mb-2 col-md-4">
                        <select name="order" class="form-select text-center" id="orderSelect" disabled>
                            <option value="" selected disabled>Pilih Urutan</option>
                        </select>
                    </div>
                <div class="col-md-4">
                    <button type="submit" class="btn hitam form-control">Filter</button>
                </div>
            </div>
        </form>

        <div class="row" style="margin-top : -33px">
            <?php
            $filter = isset($_GET['filter']) ? $_GET['filter'] : 'tanggal';
            $order = isset($_GET['order']) && in_array($_GET['order'], ['ASC', 'DESC']) ? $_GET['order'] : 'DESC';

            $userid = isset($_SESSION['userid']) ? $_SESSION['userid'] : null;

            $albumid = isset($_GET['albumid']) ? mysqli_real_escape_string($koneksi, $_GET['albumid']) : null;

            if ($albumid) {
                $query = "SELECT * FROM foto 
                         INNER JOIN user ON foto.userid=user.userid 
                         INNER JOIN album ON foto.albumid=album.albumid 
                         WHERE foto.albumid='$albumid' AND foto.userid='$userid'";
            } else {
                $query = "SELECT * FROM foto 
                         INNER JOIN user ON foto.userid=user.userid 
                         INNER JOIN album ON foto.albumid=album.albumid 
                         WHERE foto.userid='$userid'";
            }

            if ($filter == 'like') {
                $query .= " ORDER BY (SELECT COUNT(*) FROM likefoto WHERE likefoto.fotoid = foto.fotoid) $order";
            } elseif ($filter == 'komen') {
                $query .= " ORDER BY (SELECT COUNT(*) FROM komentarfoto WHERE komentarfoto.fotoid = foto.fotoid) $order";
            } elseif ($filter == 'tanggal') {
                $query .= " ORDER BY foto.tanggalunggah $order, foto.fotoid $order";
            }

            if ($filter == 'random') {
                $query .= " ORDER BY RAND()";
            }
            $photos_result = mysqli_query($koneksi, $query);


            while ($data = mysqli_fetch_assoc($photos_result)) { ?>
                <div class="mt-3 col-md-3">
                    <a type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['fotoid'] ?>">
                        <div class="card">
                            <img style="height: 12rem;" src="../assets/img/<?php echo $data['lokasifile'] ?>" class="card-img-top" title="<?php echo $data['judulfoto'] ?>">
                            <div class="text-center card-footer">

                                <?php
                                $fotoid = $data['fotoid'];
                                $ceksuka = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'");

                                if (mysqli_num_rows($ceksuka) == 1) { ?>
                                    <a href="../config/proses_like.php?fotoid=<?php echo $data['fotoid'] ?>" type="submit" name="batalsuka"> <i class="fa fa-heart"></i> </a>
                                <?php } else { ?>
                                    <a href="../config/proses_like.php?fotoid=<?php echo $data['fotoid'] ?>" type="submit" name="suka"> <i class="fa-regular fa-heart"></i> </a>
                                <?php }

                                $like = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid'");
                                echo mysqli_num_rows($like) . ' Suka';
                                ?>
                                <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['fotoid'] ?>"> <i class="fa-regular fa-comment"></i> </a>
                                <?php
                                $jmlkomen = mysqli_query($koneksi, "SELECT * FROM komentarfoto WHERE fotoid = '$fotoid'");
                                echo mysqli_num_rows($jmlkomen) . ' Komentar';
                                ?>
                            </div>
                        </div>
                    </a>
                    <div class="modal fade" id="komentar<?php echo $data['fotoid'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <img src="../assets/img/<?php echo $data['lokasifile'] ?>" class="card-img-top" title="<?php echo $data['judulfoto'] ?>">
                                        </div>
                                        <div class="col-md-4">
                                            <div class="m-2">
                                                <div class="overflow-auto">
                                                    <div class="sticky-top d-flex justify-content-between align-items-center">
                                                        <p><strong><?php echo $data['username'] ?></strong></p>
                                                        <a href="../assets/img/<?php echo $data['lokasifile'] ?>" download class="btn btn-outline-secondary btn-sm">
                                                            <i class="fa fa-download"></i> Unduh
                                                        </a>
                                                    </div>
                                                    <strong><?php echo $data['judulfoto'] ?></strong>
                                                    <p align="left" class="text-secondary" style="font-size: 0.9em;"><?php echo $data['deskripsifoto'] ?></p>
                                                    <span class="badge bg-secondary"><?php echo $data['tanggalunggah'] ?></span>
                                                    <span class="badge bg-secondary"><?php echo $data['namaalbum'] ?></span>
                                                    <hr>
                                                    <form action="../config/proses_komentar.php" method="post">
                                                        <div class="input-group">
                                                            <input type="hidden" name="fotoid" value="<?php echo $data['fotoid'] ?>">
                                                            <div class="input-group">
                                                                <input type="text" name="isikomentar" placeholder="tambah komentar" class="form-control">
                                                                <button type="submit" name="kirimkomentar" class="btn btn-outline-secondary">Kirim</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <hr>
                                                    <?php
                                                    $fotoid = $data['fotoid'];
                                                    $komentar = mysqli_query($koneksi, "SELECT * FROM komentarfoto INNER JOIN user ON komentarfoto.userid = user.userid WHERE komentarfoto.fotoid='$fotoid' AND reply_komen IS NULL");
                                                    ?>

                                                    <h5 class="mb-3 text-secondary">
                                                        <strong><?php echo mysqli_num_rows($komentar); ?> Komentar</strong>
                                                    </h5>

                                                    <?php while ($row = mysqli_fetch_array($komentar)) { ?>
                                                        <div class="comment-item">
                                                            <p class="comment-author">
                                                                <strong><?php echo $row['username']; ?></strong>
                                                            </p>
                                                            <div class="comment-content">
                                                                <p class="comment-text text-secondary">
                                                                    <?php echo $row['isikomentar']; ?>
                                                                </p>
                                                                <div class="comment-footer">
                                                                    <p class="comment-date">
                                                                        <small><?php echo date('d M Y', strtotime($row['tanggalkomentar'])); ?></small>
                                                                    </p>

                                                                    <span class="text-secondary" style="font-size: 0.7em;" data-bs-toggle="collapse" href="#reply<?php echo $row['komentarid']; ?>" role="button" aria-expanded="false" aria-controls="reply<?php echo $row['komentarid']; ?>">Balas</span>
                                                                </div>

                                                                <div class="collapse" id="reply<?php echo $row['komentarid']; ?>">
                                                                    <form action="../config/proses_komentar.php" method="post">
                                                                        <div class="input-group">
                                                                            <input type="hidden" name="fotoid" value="<?php echo $fotoid; ?>">
                                                                            <input type="hidden" name="reply_komen" value="<?php echo $row['komentarid']; ?>">
                                                                            <input type="text" name="isikomentar" placeholder="Tulis balasan..." class="form-control">
                                                                            <button type="submit" name="kirimkomentar" class="btn btn-outline-secondary">Kirim</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <?php
                                                        $replies = mysqli_query($koneksi, "SELECT * FROM komentarfoto INNER JOIN user ON komentarfoto.userid = user.userid WHERE reply_komen = '" . $row['komentarid'] . "'");
                                                        while ($reply = mysqli_fetch_array($replies)) {
                                                        ?>
                                                            <div class="comment-item" style="margin-left: 30px;">
                                                                <p class="comment-author">
                                                                    <strong><?php echo $reply['username']; ?></strong>
                                                                </p>
                                                                <div class="comment-content">
                                                                    <p class="comment-text text-secondary">
                                                                        <?php echo $reply['isikomentar']; ?>
                                                                    </p>
                                                                    <p class="comment-date" style="margin-top: -16px;">
                                                                        <small><?php echo date('d M Y', strtotime($reply['tanggalkomentar'])); ?></small>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                    <?php } ?>


                                                    <div class="sticky-bottom">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <footer class="py-3 mt-5 shadow-lg d-flex justify-content-center">
        <p>&copy;Fikri Bagja Ramadhan</p>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterSelect = document.getElementById('filterSelect');
            const orderSelect = document.getElementById('orderSelect');
            const urlParams = new URLSearchParams(window.location.search);

            filterSelect.addEventListener('change', function() {
                const filterValue = filterSelect.value;
                orderSelect.innerHTML = '';

                if (filterValue) {
                    orderSelect.disabled = false;
                    if (filterValue === 'like' || filterValue === 'komen') {
                        orderSelect.innerHTML = `
                        <option value="ASC" ${urlParams.get('order') === 'ASC' ? 'selected' : ''}>Tersedikit</option>
                        <option value="DESC" ${urlParams.get('order') === 'DESC' ? 'selected' : ''}>Terbanyak</option>
                    `;
                    } else if (filterValue === 'tanggal') {
                        orderSelect.innerHTML = `
                        <option value="ASC" ${urlParams.get('order') === 'ASC' ? 'selected' : ''}>Terlama</option>
                        <option value="DESC" ${urlParams.get('order') === 'DESC' ? 'selected' : ''}>Terbaru</option>
                    `;
                    }
                } else {
                    orderSelect.disabled = true;
                    orderSelect.innerHTML = `<option value="" selected disabled>Pilih Urutan</option>`;
                }
            });

            if (urlParams.get('filter')) {
                filterSelect.value = urlParams.get('filter');
                filterSelect.dispatchEvent(new Event('change'));
            }
        });
    </script>


    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>