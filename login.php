<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fikri Galeri | Login</title>
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
        .yes:hover{
            background-color: #000;
            color: #fff;
        }

        @media (max-width: 576px) {
            .custom-mt{
                margin-top: 200px !important;
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
                <a href="register.php" class="mb-2 btn hitam">Register</a>
            </div>
        </div>
    </nav>
    
    <div class="container py-4 mt-5 custom-mt">
        <div class="rounded row justify-content-center">
            <div class="col-md-4">
                <div class="shadow-lg card">
                    <div class="p-4">
                        <div class="text-center">
                            <h3 class="fw-bold">Login</h3>
                        </div>
                        <form action="config/aksi_login.php" method="post">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="p-2 mb-3 form-control" required>
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="p-2 mb-3 form-control" required>
                            <div class="mt-2 mb-3 d-grid">
                                <button class="p-2 btn yes" type="submit" name="kirim">Login</button>
                            </div>
                        </form>
                        <p class="text-center">Belum punya akun ? <a href="register.php" class="link-offset-2 link-underline link-underline-opacity-0 text-dark">Daftar</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="py-3 mt-3 shadow-lg d-flex justify-content-center fixed-bottom">
        <p>&copy;Fikri Bagja Ramadhan</p>
    </footer>
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>