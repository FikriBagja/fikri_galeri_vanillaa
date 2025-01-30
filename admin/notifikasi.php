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

$query = "SELECT notifications.content, notifications.created_at, notifications.is_read, user.username AS action_user, foto.lokasifile AS foto_path
    FROM notifications
    JOIN user ON notifications.action_userid = user.userid
    LEFT JOIN foto ON foto.fotoid = notifications.fotoid
    WHERE notifications.userid = '$userid'
    ORDER BY notifications.created_at DESC";

$result = mysqli_query($koneksi, $query);

$hitung_notif = "SELECT COUNT(*) AS belum_dibaca FROM notifications WHERE userid = '$userid' AND is_read = 0";
$hasil = mysqli_query($koneksi, $hitung_notif);
$belum_dibaca = mysqli_fetch_assoc($hasil)['belum_dibaca'];
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fikri Galeri | Notifikasi</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
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
            width: 60px;
            height: 60px;
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

    </style>


</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light shadow-lg p-3 bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="index.php">Fikri Galeri</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse mt-1" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link">Home</a>
                    </li>
                    <a href="album.php" class="nav-link">Album</a>
                    <a href="foto.php" class="nav-link">Foto</a>
                    <a href="notifikasi.php" class="nav-link position-relative">
                        Notifikasi <i class="fa-regular fa-bell"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            <?php echo $belum_dibaca ?: '0'; ?>
                        </span>
                    </a>
                </ul>
                <a href="profile.php" class="btn btn-outline-primary m-1">Profile</a>
                <a href="../config/aksi_logout.php" class="btn btn-outline-success m-1">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container mt-3">
        <h2 class="text-secondary" style="margin-bottom: 20px;">Notifikasi</h2>

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
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <?php
                $isUnread = ($row['is_read'] == 0);
                $cardClass = $isUnread ? 'notification-card notification-unread' : 'notification-card';
                ?>
                <div class="<?php echo $cardClass; ?>">
                    <div class="notification-content">
                        <p>
                            <span class="username"><?php echo htmlspecialchars($row['action_user']); ?></span>
                            <?php echo htmlspecialchars($row['content']); ?>
                        </p>
                        <div class="notification-time" style="margin-top: -10px;">
                            <?php echo date('d M Y H:i', strtotime($row['created_at'])); ?>
                        </div>
                    </div>
                    <img src="../assets/img/<?php echo $row['foto_path'] ?>" alt="Foto yang di-like atau dikomentari" class="notification-img">
                </div>
            <?php endwhile; ?>

        <?php else : ?>
            <p>Tidak ada notifikasi untuk Anda.</p>
        <?php endif; ?>
    </div>

    <div class="container mt-3 d-flex justify-content-between">
        <?php if (mysqli_num_rows($result) > 0) : ?>

            <form action="../config/aksi_tandai_baca.php" method="POST">
                <button type="submit" class="btn btn-warning">Tandai Semua Dibaca</button>
            </form>

            <form action="../config/aksi_clear_notifikasi.php" method="POST">
                <button type="submit" class="btn btn-danger">Hapus Semua Notifikasi</button>
            </form>

        <?php endif; ?>
    </div>
    <footer class="footer d-flex justify-content-center border-top mt-5 py-3">
        <p>&copy;Fikri Bagja Ramadhan</p>
    </footer>
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
    </script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>

</body>

</html>