<?php
session_start();
include('config/koneksi.php');

if ($_SESSION['roleid'] != 1) {
    header("Location: login.php");
    exit;
}

$query = "SELECT * FROM user WHERE status='pending'";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fikri Galeri | Admin - Verifikasi Pengguna</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <style>
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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a href="admin.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'admin.php') ? 'active' : ''; ?>">Verifikasi Pengguna</a>
                    </li>
                </ul>
                <a href="config/aksi_logout.php" class="m-1 btn hitam">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container py-5">
        <h2 class="text-secondary">Verifikasi Pengguna</h2>
        <div class=" table-responsive">
        <table class="table mt-4 table-bordered table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Nama Lengkap</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                            <td>{$no}</td>
                            <td>{$row['username']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['namalengkap']}</td>
                            <td>{$row['status']}</td>
                            <td>
                                <a href='config/approve.php?userid={$row['userid']}' class='btn yes btn-custom'>Setujui</a>
                                <a href='config/reject.php?userid={$row['userid']}' class='btn btn-reject btn-custom'>Tolak</a>
                            </td>
                        </tr>";
                    $no++;
                }
                ?>
            </tbody>
        </table>
        </div>
    </div>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>