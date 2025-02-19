<?php
session_start();
include '../config/koneksi.php';
$userid = $_SESSION['userid'];
if ($_SESSION['status'] != 'login') {
    echo "<script>
    alert('Anda harus login terlebih dahulu!');
    location.href = '../index.php'
    </script>";
}
$hitung_notif = "SELECT COUNT(*) AS belum_dibaca FROM notifications WHERE userid = '$userid' AND is_read = 0";
$hasil = mysqli_query($koneksi, $hitung_notif);
$belum_dibaca = mysqli_fetch_assoc($hasil)['belum_dibaca'];

$filter = isset($_GET['filter']) ? $_GET['filter'] : 'tanggal';
$order = isset($_GET['order']) && in_array(strtoupper($_GET['order']), ['ASC', 'DESC']) ? $_GET['order'] : 'DESC';

$per_page = 8;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page > 1) ? ($page * $per_page) - $per_page : 0;

$query = "SELECT * FROM foto 
          INNER JOIN user ON foto.userid = user.userid 
          INNER JOIN album ON foto.albumid = album.albumid";

if (isset($_GET['albumid'])) {
    $albumid = $_GET['albumid'];
    $query .= " WHERE foto.albumid = $albumid";
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

// Query untuk pagination
$query .= " LIMIT $start, $per_page";
$photos_result = mysqli_query($koneksi, $query);

// Query untuk menghitung total data (untuk pagination)
$total_query = "SELECT COUNT(*) AS total FROM foto";
if (isset($_GET['albumid'])) {
    $albumid = $_GET['albumid'];
    $total_query .= " WHERE albumid = $albumid";
}
$total_result = mysqli_query($koneksi, $total_query);
$total_row = mysqli_fetch_assoc($total_result);
$total = $total_row['total'];
$pages = ceil($total / $per_page);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fikri Galeri | Dashboard</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.css">
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

        .profile-card h3 {
            color: #333;
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .profile-card p {
            color: #777;
            font-size: 1rem;
        }

        .footer {
            background-color: #f8f9fa;
            color: #212529;
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
            font-size: 1rem;
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
                <ul class="mb-10 navbar-nav me-auto">
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
    <div class="container mt-3" style=" margin-bottom:20px;">

        <h2 class="text-secondary">
            <a href="?filter=random" class="link-offset-2 link-underline link-underline-opacity-0 text-secondary">Semua Foto</a>
        </h2>
        <div class="row" style="margin-top: 20px">
            <div class="col-md-9">
                <form method="GET" action="index.php">
                    <div class="row">
                        <div class="mb-2 col-md-4">
                            <select name="filter" class="form-select text-center" id="filterSelect">
                                <option value="" selected disabled>Pilih Berdasarkan</option>
                                <option value="like" <?php echo (isset($_GET['filter']) && $_GET['filter'] == 'like') ? 'selected' : ''; ?>>Berdasarkan Like</option>
                                <option value="komen" <?php echo (isset($_GET['filter']) && $_GET['filter'] == 'komen') ? 'selected' : ''; ?>>Berdasarkan Komentar</option>
                                <option value="tanggal" <?php echo (isset($_GET['filter']) && $_GET['filter'] == 'tanggal') ? 'selected' : ''; ?>>Berdasarkan Tanggal Unggah</option>
                                <option value="album" <?php echo (isset($_GET['filter']) && $_GET['filter'] == 'album') ? 'selected' : ''; ?>>Berdasarkan Album</option>
                            </select>
                        </div>

                        <div class="mb-2 col-md-4">
                            <select name="albumid" class="form-select text-center" id="albumSelect">
                                <option value="" selected disabled>Pilih Album</option>
                                <?php
                                $albums_query = "SELECT album.albumid, album.namaalbum, user.username 
                         FROM album 
                         JOIN user ON album.userid = user.userid";
                                $albums_result = mysqli_query($koneksi, $albums_query);
                                while ($album = mysqli_fetch_assoc($albums_result)) :
                                ?>
                                    <option value="<?php echo $album['albumid']; ?>" <?php if (isset($_GET['albumid']) && $_GET['albumid'] == $album['albumid']) echo 'selected'; ?>>
                                        <?php echo $album['namaalbum'] . ' (' . $album['username'] . ')'; ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                        <!-- Dropdown untuk memilih urutan -->
                        <div class="mb-2 col-md-4">
                            <select name="order" class="form-select text-center" id="orderSelect" disabled>
                                <option value="" selected disabled>Pilih Urutan</option>
                            </select>
                        </div>

                        <div class="col-md-12">
                            <button type="submit" class="btn hitam form-control">Filter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <?php

            $filter = isset($_GET['filter']) ? $_GET['filter'] : 'tanggal';
            $order = isset($_GET['order']) && in_array(strtoupper($_GET['order']), ['ASC', 'DESC']) ? $_GET['order'] : 'DESC';
            $albumid = isset($_GET['albumid']) ? $_GET['albumid'] : null;

            $query = "SELECT * FROM foto 
                      INNER JOIN user ON foto.userid = user.userid 
                      INNER JOIN album ON foto.albumid = album.albumid";

            if ($filter == 'album' && $albumid) {
                $query .= " WHERE foto.albumid = $albumid";
            }

            if ($filter == 'like') {
                $query .= " ORDER BY (SELECT COUNT(*) FROM likefoto WHERE likefoto.fotoid = foto.fotoid) $order";
            } elseif ($filter == 'komen') {
                $query .= " ORDER BY (SELECT COUNT(*) FROM komentarfoto WHERE komentarfoto.fotoid = foto.fotoid) $order";
            } elseif ($filter == 'tanggal') {
                $query .= " ORDER BY foto.tanggalunggah $order, foto.fotoid $order";
            } elseif ($filter == 'random') {
                $query .= " ORDER BY RAND()";
            }

            // Query untuk pagination
            $query .= " LIMIT $start, $per_page";
            $photos_result = mysqli_query($koneksi, $query);

            // Query untuk menghitung total data (untuk pagination)
            $total_query = "SELECT COUNT(*) AS total FROM foto";
            if ($filter == 'album' && $albumid) {
                $total_query .= " WHERE albumid = $albumid";
            }

            $total_result = mysqli_query($koneksi, $total_query);
            $total_row = mysqli_fetch_assoc($total_result);
            $total = $total_row['total'];
            $pages = ceil($total / $per_page);

            while ($data = mysqli_fetch_assoc($photos_result)) { ?>
                <div class="col-md-3">
                    <a type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['fotoid'] ?>">
                        <div class="card">
                            <img style="height: 12rem;" src="../assets/img/<?php echo $data['lokasifile'] ?>" class="card-img-top" title="<?php echo $data['judulfoto'] ?>">
                            <div class="text-center card-footer">

                                <?php
                                $fotoid = $data['fotoid'];
                                $ceksuka = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'");

                                if (mysqli_num_rows($ceksuka) == 1) { ?>
                                    <a href="../config/proses_like_index.php?fotoid=<?php echo $data['fotoid'] ?>" type="submit" name="batalsuka"> <i class="fa fa-heart"></i> </a>
                                <?php } else { ?>
                                    <a href="../config/proses_like_index.php?fotoid=<?php echo $data['fotoid'] ?>" type="submit" name="suka"> <i class="fa fa-heart-o"></i> </a>
                                <?php }

                                $like = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid'");
                                echo mysqli_num_rows($like) . ' Suka';
                                ?>
                                <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['fotoid'] ?>"> <i class="fa fa-comments-o"></i> </a>
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
                                                        <p><i class="fa fa-user-circle-o"></i> <strong><?php echo $data['username'] ?></strong></p>
                                                        <a href="../assets/img/<?php echo $data['lokasifile'] ?>" download class="btn hitam btn-sm">
                                                            <i class="fa fa-download"></i> Unduh
                                                        </a>
                                                    </div>
                                                    <strong><?php echo $data['judulfoto'] ?></strong>
                                                    <p align="left" class="text-secondary" style="font-size: 0.9em;"><?php echo $data['deskripsifoto'] ?></p>
                                                    <span class="badge bg-secondary"><?php echo $data['tanggalunggah'] ?></span>
                                                    <span class="badge bg-secondary"><?php echo $data['namaalbum'] ?></span>
                                                    <hr>
                                                    <form action="../config/proses_komentar_index.php" method="post">
                                                        <div class="input-group">
                                                            <input type="hidden" name="fotoid" value="<?php echo $data['fotoid'] ?>">
                                                            <div class="input-group">
                                                                <input type="text" name="isikomentar" placeholder="tambah komentar" class="form-control" required>
                                                                <button type="submit" name="kirimkomentar" class="btn btn-outline-secondary">Kirim</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <hr>
                                                    <?php
                                                    $fotoid = $data['fotoid'];
                                                    $komentar = mysqli_query($koneksi, "SELECT * FROM komentarfoto INNER JOIN user ON komentarfoto.userid = user.userid WHERE komentarfoto.fotoid='$fotoid' AND reply_komen IS NULL");
                                                    ?>

                                                    <h5 class="mb-3 text-secondary" style="font-size: 0.7em">
                                                        <strong><?php echo mysqli_num_rows($komentar); ?> Komentar</strong>
                                                    </h5>

                                                    <?php while ($row = mysqli_fetch_array($komentar)) { ?>
                                                        <div class="comment-item">
                                                            <p class="comment-author">
                                                                <i class="fa fa-user-circle-o"></i> <strong><?php echo $row['username']; ?></strong>
                                                            </p>
                                                            <div class="comment-content">
                                                                <p class="comment-text text-secondary" style="font-size: 0.9em;">
                                                                    <?php echo $row['isikomentar']; ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="comment-footer">
                                                            <p class="comment-date">
                                                                <small><?php echo date('d M Y', strtotime($row['tanggalkomentar'])); ?></small>
                                                            </p>
                                                        </div>
                                                        <?php
                                                        $replies = mysqli_query($koneksi, "SELECT * FROM komentarfoto INNER JOIN user ON komentarfoto.userid = user.userid WHERE reply_komen = '" . $row['komentarid'] . "'");
                                                        while ($reply = mysqli_fetch_array($replies)) {
                                                        ?>
                                                            <div class="comment-item" style="margin-left: 30px;">
                                                                <p class="comment-author">
                                                                <p><i class="fa fa-user-circle-o"></i> <strong><?php echo $reply['username']; ?></strong></p>
                                                                </p>
                                                                <div class="comment-content">
                                                                    <p class="comment-text text-secondary" style="font-size: 0.9em; margin-top:-15px">
                                                                        <?php echo $reply['isikomentar']; ?>
                                                                    </p>
                                                                    <p class="comment-date" style="margin-top: -17px;">
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

        <!-- Pagination -->
        <nav aria-label="Page navigation" style="margin-top: 25px;">
            <ul class="pagination justify-content-center">
                <?php if ($page > 1) { ?>
                    <li class="page-item">
                        <a class="page-link" href="index.php?page=<?php echo ($page - 1); ?>&filter=<?php echo $filter; ?><?php if (isset($_GET['albumid'])) echo '&albumid=' . $_GET['albumid']; ?>&order=<?php echo $order; ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php } ?>

                <?php for ($i = 1; $i <= $pages; $i++) { ?>
                    <li class="page-item <?php if ($page == $i) echo 'active'; ?>">
                        <a class="page-link" href="index.php?page=<?php echo $i; ?>&filter=<?php echo $filter; ?><?php if (isset($_GET['albumid'])) echo '&albumid=' . $_GET['albumid']; ?>&order=<?php echo $order; ?>"><?php echo $i; ?></a>
                    </li>
                <?php } ?>

                <?php if ($page < $pages) { ?>
                    <li class="page-item">
                        <a class="page-link" href="index.php?page=<?php echo ($page + 1); ?>&filter=<?php echo $filter; ?><?php if (isset($_GET['albumid'])) echo '&albumid=' . $_GET['albumid']; ?>&order=<?php echo $order; ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </nav>
    </div>

    <!-- <footer class="py-3 mt-3 shadow-lg d-flex justify-content-center fixed-bottom">
        <p>&copy;Fikri Bagja Ramadhan</p>
    </footer> -->

    <script src="../assets/js/bootstrap.min.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterSelect = document.getElementById('filterSelect');
        const orderSelect = document.getElementById('orderSelect');
        const albumSelect = document.getElementById('albumSelect');
        const urlParams = new URLSearchParams(window.location.search);

        // Pastikan albumSelect dan orderSelect dinonaktifkan secara default
        albumSelect.disabled = true;
        orderSelect.disabled = true;

        filterSelect.addEventListener('change', function() {
            const filterValue = filterSelect.value;

            // Reset dropdowns
            orderSelect.innerHTML = '';
            albumSelect.disabled = true; // Nonaktifkan album select secara default
            orderSelect.disabled = true; // Nonaktifkan order select secara default

            if (filterValue) {
                if (filterValue === 'like' || filterValue === 'komen') {
                    orderSelect.disabled = false; // Aktifkan order select
                    orderSelect.innerHTML = `
                        <option value="ASC" ${urlParams.get('order') === 'ASC' ? 'selected' : ''}>Tersedikit</option>
                        <option value="DESC" ${urlParams.get('order') === 'DESC' ? 'selected' : ''}>Terbanyak</option>
                    `;
                } else if (filterValue === 'tanggal') {
                    orderSelect.disabled = false; // Aktifkan order select
                    orderSelect.innerHTML = `
                        <option value="ASC" ${urlParams.get('order') === 'ASC' ? 'selected' : ''}>Terlama</option>
                        <option value="DESC" ${urlParams.get('order') === 'DESC' ? 'selected' : ''}>Terbaru</option>
                    `;
                } else if (filterValue === 'album') {
                    albumSelect.disabled = false; // Aktifkan album select
                }
            }
        });

        // Set initial values based on URL parameters
        if (urlParams.get('filter')) {
            filterSelect.value = urlParams.get('filter');
            filterSelect.dispatchEvent(new Event('change'));
        }
    });
</script>

</body>

</html>