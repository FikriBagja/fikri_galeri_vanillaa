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

$per_page = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start_from = ($page - 1) * $per_page;

// Query utama untuk mengambil notifikasi dengan pagination
$query = "SELECT notifications.id, notifications.content, notifications.created_at, notifications.is_read, user.username AS action_user, foto.lokasifile AS foto_path
    FROM notifications
    JOIN user ON notifications.action_userid = user.userid
    LEFT JOIN foto ON foto.fotoid = notifications.fotoid
    WHERE notifications.userid = '$userid'
    ORDER BY notifications.created_at DESC
    LIMIT $start_from, $per_page";

$result = mysqli_query($koneksi, $query);

// Query untuk menghitung total notifikasi (untuk pagination)
$total_query = "SELECT COUNT(*) AS total FROM notifications WHERE userid = '$userid'";
$total_result = mysqli_query($koneksi, $total_query);
$total_row = mysqli_fetch_assoc($total_result);
$total = $total_row['total'];
$pages = ceil($total / $per_page);

$hitung_notif = "SELECT COUNT(*) AS belum_dibaca FROM notifications WHERE userid = '$userid' AND is_read = 0";
$hasil = mysqli_query($koneksi, $hitung_notif);
$belum_dibaca = mysqli_fetch_assoc($hasil)['belum_dibaca'];

$no = $start_from + 1;

?>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fikri Galeri | Notifikasi</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.css">
    <style>
        .notification-card {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            background-color: #f9f9f9;
        }

        .notification-unread {
            font-weight: bold;
            background-color: #eaeaea;
        }

        .notification-content {
            flex-grow: 1;
            margin-left: 15px;
        }

        .notification-time {
            color: #888;
            font-size: 0.9em;
        }

        .notification-img {
            width: 80px;
            height: 80px;
            border-radius: 8px;
            object-fit: cover;
        }

        .username {
            font-weight: bold;
        }

        .footer {
            background-color: #f8f9fa;
            color: #212529;
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .action-buttons form {
            display: inline;
            margin-left: 10px;
        }

        .action-buttons button {
            border: none;
            background-color: transparent;
            font-size: 1.2rem;
            color: #007bff;
            cursor: pointer;
        }

        .action-buttons button:hover {
            color: #0056b3;
        }

        .action-form {
            position: relative;
            display: inline-block;
        }

        .tooltip-text {
            visibility: hidden;
            opacity: 0;
            width: 180px;
            background-color: #333;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 5px;
            position: absolute;
            z-index: 1;
            bottom: 125%;
            left: 50%;
            margin-left: -90px;
            transition: opacity 0.3s;
            font-size: 12px;
        }

        @media (max-width: 576px) {
            .tooltip-text {
                margin-left: -180px !important;
            }
        }

        .action-form:hover .tooltip-text {
            visibility: visible;
            opacity: 1;
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
                    <i class="fa fa-bell-o" style="font-weight: bold; font-size: 1.3em; margin-top:4px;"></i>
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
    <div class="container mt-3" style=" margin-bottom:20px;">
        <div class="header-container">
            <h2 class="text-secondary" style="margin-bottom: 20px;">Notifikasi</h2>
            <?php if (mysqli_num_rows($result) > 0) : ?>
                <div class="action-buttons">
                    <form action="../config/aksi_tandai_baca.php" method="POST" class="action-form">
                        <button type="submit" class="btn btn-warning btn-sm">
                            <i class="fa fa-check-circle-o"></i>
                            <span class="tooltip-text">Tandai Semua Dibaca</span>
                        </button>
                    </form>

                    <form action="../config/aksi_clear_notifikasi.php" method="POST" class="action-form">
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fa fa-trash-o"></i>
                            <span class="tooltip-text">Hapus Semua Notifikasi</span>
                        </button>
                    </form>

                </div>
            <?php endif; ?>
        </div>

        <?php if (isset($_GET['status'])) : ?>
            <?php if ($_GET['status'] == 'success') : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Semua notifikasi berhasil dihapus.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php elseif ($_GET['status'] == 'error') : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Terjadi kesalahan saat menghapus notifikasi.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <?php if (isset($_GET['status'])) : ?>
            <?php if ($_GET['status'] == 'berhasil_tandai') : ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Semua notifikasi berhasil ditandai sebagai dibaca.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php elseif ($_GET['status'] == 'gagal_tandai') : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Terjadi kesalahan saat menandai sebagai dibaca.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <?php if (mysqli_num_rows($result) > 0) : ?>
            <?php while ($row = mysqli_fetch_assoc($result)) :
                $date = new DateTime($row['created_at'], new DateTimeZone('Asia/Jakarta'));
                $timeAgo = $date->getTimestamp();
            ?>
                <?php
                $isUnread = ($row['is_read'] == 0);
                $cardClass = $isUnread ? 'notification-card notification-unread' : 'notification-card';
                ?>
                <div class="<?php echo $cardClass; ?>">
                    <div class="notification-content">
                        <p style="width: 90%;">
                            <span class="username"><?php echo htmlspecialchars($row['action_user']); ?></span>
                            <?php echo htmlspecialchars($row['content']); ?>
                        </p>
                        <div class="notification-time" style="margin-top: -10px;">
                            <?php
                            echo '<small class="time-ago" data-time="' . $timeAgo . '">' . $date->format('Y-m-d H:i:s') . '</small>';
                            ?>
                        </div>
                    </div>
                    <img src="../assets/img/<?php echo $row['foto_path'] ?>" alt="Foto yang di-like atau dikomentari" class="notification-img">
                </div>
            <?php endwhile; ?>

        <?php else : ?>
            <p>Tidak ada notifikasi untuk Anda.</p>
        <?php endif; ?>
    </div>

    <!-- <footer class="py-3 mt-5 footer d-flex justify-content-center border-top">
        <p>&copy;Fikri Bagja Ramadhan</p>
    </footer> -->
    <nav aria-label="Page navigation" class="no-print">
        <ul class="pagination justify-content-center">
            <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
                <a class="page-link" href="notifikasi.php?page=<?php echo ($page - 1); ?>">Kembali</a>
            </li>
            <?php for ($i = 1; $i <= $pages; $i++) : ?>
                <li class="page-item <?php if ($page == $i) echo 'active'; ?>">
                    <a class="page-link" href="notifikasi.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>
            <li class="page-item <?php if ($page >= $pages) echo 'disabled'; ?>">
                <a class="page-link" href="notifikasi.php?page=<?php echo ($page + 1); ?>">Lanjut</a>
            </li>
        </ul>
    </nav>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            setTimeout(function() {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(alert => {
                    alert.classList.remove('show');
                    alert.classList.add('fade');
                });
            }, 5000);
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
    <script src="../assets/js/bootstrap.bundle.min.js"></script>

</body>

</html>