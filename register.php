<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fikri Galeri | Register</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <style>
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
        }

        .yes:hover {
            background-color: #000;
            color: #fff;
        }

        .mt-custom{
            margin-top: 10px;
        }
        @media (max-width: 576px) {
            .custom-mt {
                margin-top: 90px !important;
            }
            .mt-custom{
                margin-top: 95px!important;
            }
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
                <a href="login.php" class="mb-2 btn hitam">Login</a>
            </div>
        </div>
    </nav>
    <div class="container py-4 custom-mt">
        <div class="rounded row justify-content-center">
            <div class="col-md-4">
                <div class="shadow-lg card">
                    <div class="p-4">
                        <div class="text-center">
                            <h3 class="fw-bold">Register</h3>
                        </div>
                        <form action="config/aksi_register.php" method="post">
                            <label for="" class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" required>
                            <label for="" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                            <label for="" class="form-label">email</label>
                            <input type="email" name="email" class="form-control" required>
                            <label for="" class="form-label">Nama Lengkap</label>
                            <input type="text" name="namalengkap" class="form-control" required>
                            <label for="" class="form-label">Alamat</label>
                            <input type="text" name="alamat" class="form-control" required>
                            <div class="mt-2 d-grid">
                                <button class="btn yes" type="submit" name="kirim">Daftar</button>
                            </div>
                        </form>
                        <hr>
                        <p class="text-center">Sudah punya akun ? <a href="login.php" class="link-offset-2 link-underline link-underline-opacity-0 text-dark">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <footer class="py-3 shadow-lg mt-custom d-flex justify-content-center">
        <p>&copy;Fikri Bagja Ramadhan</p>
    </footer> -->
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>