<?php
session_start();
include('koneksi.php');

// Pastikan pengguna sudah login
if (!isset($_SESSION['id'])) {
    header("Location: login.php"); // Redirect ke halaman login jika belum login
    exit();
}

// Ambil data dari session
$nama = $_SESSION['nama'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Pembelian Paket Wisata</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            margin-top: 40px;
        }
        .card img {
            height: 300px;
            object-fit: cover;
        }
        .card-link {
            text-decoration: none;
            color: #007bff;
        }
        .card-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Selamat Datang, <?php echo htmlspecialchars($nama); ?>!</h1>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <img src="img/tiket.png" alt="Gambar 1" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">Riwayat Pembelian</h5>
                        <a href="riwayat_pembelian.php" class="card-link">Kunjungi Halaman</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <img src="img/loket.png" alt="Gambar 2" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">Pesan Tiket</h5>
                        <a href="pembeli.php" class="card-link">Kunjungi Halaman</a>
                    </div>
                </div>
            </div>
        </div>
        <a href="index.php" class="btn btn-danger mt-5" onclick="return confirm('Are you sure you want to close this?');">Kembali</a>
    </div>
    <footer>
            <div class="fixed-bottom" style="text-align: center; padding: 10px 0; border-top: 1px solid #444;">
                <p>&copy; 2024 Merakkecil.com. Semua Hak Dilindungi.</p>
            </div>
    </footer>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

