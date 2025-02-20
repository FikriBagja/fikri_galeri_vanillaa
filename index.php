<?php
session_start();
include 'config/koneksi.php';

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
    <title>Fikri Galeri | Home</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
    <style>
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

        .btn-outline-success {
            border-color: #000;
            color: #000;
        }

        .btn-outline-success:hover {
            background-color: #000;
            color: #fff;
        }

        .zoom img {
            transition: transform 0.3s ease;
        }

        .zoom:hover img {
            transform: scale(1.1);
        }

        .custom-img {
            width: 100%;
            height: 100px;
            object-fit: cover;
        }

        .custom-width {
            width: 500px;
        }

        @media (max-width: 576px) {
            .mt-sm-negative {
                margin-top: 5px;
            }

            .custom-img {
                width: 200px;
                height: 175px;
            }

            .custom-width {
                width: 340px;
            }
        }

        .btn-cust {
            background-color: #000;
            color: #fff;
        }

        .btn-cust:hover {
            background-color: #000;
            color: #fff;
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
            <a class="fw-bold navbar-brand" href="index.php">Fikri Galeri</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="mt-2 collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">

                </ul>
                <a href="login.php" class="mb-2 btn btn-outline-success">Login</a>
            </div>
        </div>
    </nav>

    <div class="container mt-3" style=" margin-bottom:20px;">

        <h2 class="text-secondary">
            Semua Foto
        </h2>

        <div class="row" style="margin-top: 20px">
            <div class="col-md-6">
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

            while ($data = mysqli_fetch_assoc($photos_result)) {
                $fotoid = $data['fotoid'];
            ?>
                <div class="col-md-3">
                    <a type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['fotoid'] ?>">
                        <div class="card">
                            <img style="height: 12rem;" src="assets/img/<?php echo $data['lokasifile'] ?>" class="card-img-top" title="<?php echo $data['judulfoto'] ?>">
                            <div class="text-center card-footer">
                                <a href="#" onclick="showModal()"><i class="fa fa-heart-o"></i></a>

                                <div id="modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center; text-align: center; z-index: 9999;">
                                    <div style="background-color: white; padding: 20px; border-radius: 10px; width: 300px;">
                                        <p>Anda harus login terlebih dahulu</p>
                                        <button onclick="goBack()">Kembali</button>
                                        <button onclick="goToLogin()">Login</button>
                                    </div>
                                </div>
                                <?php
                                $like = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid'");
                                echo mysqli_num_rows($like) . ' Suka';
                                ?>
                                <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['fotoid'] ?>"> <i class="fa fa-comments-o"></i>
                                </a>
                                <?php
                                $jmlkomen = mysqli_query($koneksi, "SELECT * FROM komentarfoto WHERE fotoid = '$fotoid'");
                                echo mysqli_num_rows($jmlkomen) . ' Komentar';                                                                                                                                                                                                  ?>
                            </div>
                        </div>
                    </a>
                    <div class="modal fade" id="komentar<?php echo $data['fotoid'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <img src="assets/img/<?php echo $data['lokasifile'] ?>" class="card-img-top" title="<?php echo $data['judulfoto'] ?>">
                                        </div>
                                        <div class="col-md-4">
                                            <div class="m-2">
                                                <div class="overflow-auto">
                                                    <div class="sticky-top d-flex justify-content-between align-items-center">
                                                        <p><i class="fa fa-user-circle-o"></i> <strong><?php echo $data['username'] ?></strong></p>
                                                        <p class="btn hitam btn-sm" onclick="showModal()">
                                                            <i class="fa fa-download"></i> Unduh
                                                        </p>

                                                    </div>

                                                    <strong><?php echo $data['judulfoto'] ?></strong>
                                                    <p align="left" class="text-secondary" style="font-size: 0.9em;"><?php echo $data['deskripsifoto'] ?></p>
                                                    <span class="badge bg-secondary"><?php echo $data['tanggalunggah'] ?></span>
                                                    <span class="badge bg-secondary"><?php echo $data['namaalbum'] ?></span>

                                                    <hr>
                                                    <?php
                                                    $fotoid = $data['fotoid'];
                                                    $komentar = mysqli_query($koneksi, "SELECT * FROM komentarfoto INNER JOIN user ON komentarfoto.userid = user.userid WHERE komentarfoto.fotoid='$fotoid' AND reply_komen IS NULL");
                                                    ?>

                                                    <h5 class="mb-3 text-secondary" style="font-size: 0.7em">
                                                        <strong><?php echo mysqli_num_rows($komentar); ?> Komentar</strong>
                                                    </h5>

                                                    <?php while ($row = mysqli_fetch_array($komentar)) {
                                                        $date = new DateTime($row['tanggalkomentar'], new DateTimeZone('Asia/Jakarta'));
                                                        $timeAgo = $date->getTimestamp();
                                                    ?>
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
                                                                <?php
                                                                echo '<small class="time-ago" data-time="' . $timeAgo . '">' . $date->format('Y-m-d H:i:s') . '</small>';
                                                                ?>
                                                            </p>
                                                        </div><?php
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
                                                                        <?php
                                                                        echo '<small class="time-ago" data-time="' . $timeAgo . '">' . $date->format('Y-m-d H:i:s') . '</small>';
                                                                        ?> </p>
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
        <nav aria-label="Page navigation" style="margin-top: 25px;">
            <ul class="pagination justify-content-center">
                <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
                    <a class="page-link" href="index.php?page=<?php echo ($page - 1); ?>&filter=<?php echo $filter; ?><?php if (isset($_GET['albumid'])) echo '&albumid=' . $_GET['albumid']; ?>&order=<?php echo $order; ?>" aria-label="Previous">
                        <span aria-hidden="true">Kembali</span>
                    </a>
                </li>

                <?php for ($i = 1; $i <= $pages; $i++) { ?>
                    <li class="page-item <?php if ($page == $i) echo 'active'; ?>">
                        <a class="page-link" href="index.php?page=<?php echo $i; ?>&filter=<?php echo $filter; ?><?php if (isset($_GET['albumid'])) echo '&albumid=' . $_GET['albumid']; ?>&order=<?php echo $order; ?>"><?php echo $i; ?></a>
                    </li>
                <?php } ?>

                <li class="page-item <?php if ($page >= $pages) echo 'disabled'; ?>">
                    <a class="page-link" href="index.php?page=<?php echo ($page + 1); ?>&filter=<?php echo $filter; ?><?php if (isset($_GET['albumid'])) echo '&albumid=' . $_GET['albumid']; ?>&order=<?php echo $order; ?>" aria-label="Next">
                        <span aria-hidden="true">Lanjut</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <script>
        function showModal() {
            document.getElementById("modal").style.display = "flex";
        }

        function goBack() {
            document.getElementById("modal").style.display = "none";
        }

        function goToLogin() {
            window.location.href = "login.php";
        }

        function showModal2() {
            document.getElementById("modal").style.display = "flex";
        }

        function goBack() {
            document.getElementById("modal").style.display = "none";
        }

        function goToLogin() {
            window.location.href = "login.php";
        }

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

        function updateTimeAgo() {
            let elements = document.querySelectorAll('.time-ago');
            let now = Math.floor(Date.now() / 1000);

            elements.forEach(el => {
                let commentTime = parseInt(el.getAttribute('data-time'));
                console.log(`Debug JS: Komentar pada ${commentTime}, sekarang ${now}, selisih ${now - commentTime} detik`);

                let timeDiff = now - commentTime;
                el.textContent = getTimeAgoText(timeDiff);
            });
        }

        function getTimeAgoText(seconds) {
            if (seconds < 60) return `${seconds} detik yang lalu`;
            let minutes = Math.floor(seconds / 60);
            if (minutes < 60) return `${minutes} menit yang lalu`;
            let hours = Math.floor(minutes / 60);
            if (hours < 24) return `${hours} jam yang lalu`;
            let days = Math.floor(hours / 24);
            if (days < 7) return `${days} hari yang lalu`;
            let weeks = Math.floor(days / 7);
            if (weeks < 4) return `${weeks} minggu yang lalu`;
            let months = Math.floor(days / 30);
            if (months < 12) return `${months} bulan yang lalu`;
            let years = Math.floor(days / 365);
            return `${years} tahun yang lalu`;
        }

        setInterval(updateTimeAgo, 1000);
        updateTimeAgo();
    </script>

    <!-- <footer class="py-3 mt-3 shadow-lg d-flex justify-content-center fixed-bottom">
        <p>&copy;Fikri Bagja Ramadhan</p>
    </footer> -->


    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>