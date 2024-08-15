<?php
session_start();
include('koneksi.php');

// Pastikan pengguna sudah login
if (!isset($_SESSION['id'])) {
    header("Location: login.php"); // Redirect ke halaman login jika belum login
    exit();
}
$nama = $_SESSION['nama'];
// Ambil data daftar harga dari database
$sql = "SELECT * FROM daftar_harga";
$result = mysqli_query($db, $sql);

// Simpan data dalam array
$dataHarga = [];
while ($row = mysqli_fetch_assoc($result)) {
    $dataHarga[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Harga</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4 ">Daftar Harga</h1>
        <form action="proses/proses_pembelian.php" method="post" enctype="multipart/form-data">
            <p>Registrasi :</p>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($dataHarga[0]['nama']); ?></h5>
                            <p class="card-text">Harga: Rp <?php echo number_format($dataHarga[0]['harga'], 2, ',', '.'); ?></p>
                            <input type="hidden" name="daftar_harga_id[]" value="<?php echo $dataHarga[0]['id']; ?>">
                            <input type="number" name="jumlah[]" class="form-control item-quantity" placeholder="Jumlah" min="0" value="0" step="1" data-price="<?php echo $dataHarga[0]['harga']; ?>">
                        </div>
                    </div>
                </div>
                <!-- Contoh pemosisian manual untuk item kedua -->
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($dataHarga[1]['nama']); ?></h5>
                            <p class="card-text">Harga: Rp <?php echo number_format($dataHarga[1]['harga'], 2, ',', '.'); ?></p>
                            <input type="hidden" name="daftar_harga_id[]" value="<?php echo $dataHarga[1]['id']; ?>">
                            <input type="number" name="jumlah[]" class="form-control item-quantity" placeholder="Jumlah" min="0" value="0" step="1" data-price="<?php echo $dataHarga[1]['harga']; ?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($dataHarga[2]['nama']); ?></h5>
                            <p class="card-text">Harga: Rp <?php echo number_format($dataHarga[2]['harga'], 2, ',', '.'); ?></p>
                            <input type="hidden" name="daftar_harga_id[]" value="<?php echo $dataHarga[2]['id']; ?>">
                            <input type="number" name="jumlah[]" class="form-control item-quantity" placeholder="Jumlah" min="0" value="0" step="1" data-price="<?php echo $dataHarga[2]['harga']; ?>">
                        </div>
                    </div>
                </div>
            </div>
            <p>Tambahan :</p>
            <div class="row">
                <div class="col-md-2 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($dataHarga[3]['nama']); ?></h5>
                            <p class="card-text">Harga: Rp <?php echo number_format($dataHarga[3]['harga'], 2, ',', '.'); ?></p>
                            <input type="hidden" name="daftar_harga_id[]" value="<?php echo $dataHarga[3]['id']; ?>">
                            <input type="number" name="jumlah[]" class="form-control item-quantity" placeholder="Jumlah" min="0" value="0" step="1" data-price="<?php echo $dataHarga[3]['harga']; ?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-2 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($dataHarga[4]['nama']); ?></h5>
                            <p class="card-text">Harga: Rp <?php echo number_format($dataHarga[4]['harga'], 2, ',', '.'); ?></p>
                            <input type="hidden" name="daftar_harga_id[]" value="<?php echo $dataHarga[4]['id']; ?>">
                            <input type="number" name="jumlah[]" class="form-control item-quantity" placeholder="Jumlah" min="0" value="0" step="1" data-price="<?php echo $dataHarga[4]['harga']; ?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-2 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($dataHarga[5]['nama']); ?></h5>
                            <p class="card-text">Harga: Rp <?php echo number_format($dataHarga[5]['harga'], 2, ',', '.'); ?></p>
                            <input type="hidden" name="daftar_harga_id[]" value="<?php echo $dataHarga[5]['id']; ?>">
                            <input type="number" name="jumlah[]" class="form-control item-quantity" placeholder="Jumlah" min="0" value="0" step="1" data-price="<?php echo $dataHarga[5]['harga']; ?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-2 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($dataHarga[6]['nama']); ?></h5>
                            <p class="card-text">Harga: Rp <?php echo number_format($dataHarga[6]['harga'], 2, ',', '.'); ?></p>
                            <input type="hidden" name="daftar_harga_id[]" value="<?php echo $dataHarga[6]['id']; ?>">
                            <input type="number" name="jumlah[]" class="form-control item-quantity" placeholder="Jumlah" min="0" value="0" step="1" data-price="<?php echo $dataHarga[6]['harga']; ?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-2 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($dataHarga[7]['nama']); ?></h5>
                            <p class="card-text">Harga: Rp <?php echo number_format($dataHarga[7]['harga'], 2, ',', '.'); ?></p>
                            <input type="hidden" name="daftar_harga_id[]" value="<?php echo $dataHarga[7]['id']; ?>">
                            <input type="number" name="jumlah[]" class="form-control item-quantity" placeholder="Jumlah" min="0" value="0" step="1" data-price="<?php echo $dataHarga[7]['harga']; ?>">
                        </div>
                    </div>
                </div>
            </div>
            <p>Paket Wisata :</p>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($dataHarga[8]['nama']); ?></h5>
                            <p class="card-text">Harga: Rp <?php echo number_format($dataHarga[8]['harga'], 2, ',', '.'); ?></p>
                            <input type="hidden" name="daftar_harga_id[]" value="<?php echo $dataHarga[8]['id']; ?>">
                            <input type="number" name="jumlah[]" class="form-control item-quantity" placeholder="Jumlah" min="0" value="0" step="1" data-price="<?php echo $dataHarga[8]['harga']; ?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($dataHarga[9]['nama']); ?></h5>
                            <p class="card-text">Harga: Rp <?php echo number_format($dataHarga[9]['harga'], 2, ',', '.'); ?></p>
                            <input type="hidden" name="daftar_harga_id[]" value="<?php echo $dataHarga[9]['id']; ?>">
                            <input type="number" name="jumlah[]" class="form-control item-quantity" placeholder="Jumlah" min="0" value="0" step="1" data-price="<?php echo $dataHarga[9]['harga']; ?>">
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($dataHarga[10]['nama']); ?></h5>
                            <p class="card-text">Harga: Rp <?php echo number_format($dataHarga[10]['harga'], 2, ',', '.'); ?></p>
                            <input type="hidden" name="daftar_harga_id[]" value="<?php echo $dataHarga[10]['id']; ?>">
                            <input type="number" name="jumlah[]" class="form-control item-quantity" placeholder="Jumlah" min="0" value="0" step="1" data-price="<?php echo $dataHarga[10]['harga']; ?>">
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Input field untuk tanggal booking -->
            <div class="form-group mt-4">
                <label for="tanggal_booking">Tanggal Booking:</label>
                <input type="date" name="tanggal_booking" class="form-control" id="tanggal_booking" required>
            </div>

            <div class="form-group mt-4">
                <button type="button" class="btn btn-info" onclick="calculateTotal()">Hitung Total</button>
                <h3 id="totalPrice">Total: Rp 0</h3>
            </div>

            <div class="form-group mt-4">
            <select class="form-select" aria-label="Default select example">
                <option selected>Opsi Pembayaran</option>
                <option value="1">BCA | 2023017 | Rifki Andreana Sutrisno</option>
                <option value="2">Dana | 085899928968 | Rifki Andreana Sutrisno</option>
                <option value="3">BNI | 146782108 | Atep Rizal</option>
            </select>
            </div>

            <div class="form-group mt-4">
                <label for="bukti_pembayaran">Upload Bukti Pembayaran:</label>
                <input type="file" name="bukti_pembayaran" class="form-control" id="bukti_pembayaran" accept="image/*">
            </div>

        

            <button type="submit" class="btn btn-primary">Proses Pembelian</button>
            <a href="halaman_pembeli.php" class="btn btn-danger ml-5" onclick="return confirm('Are you sure you want to close this?');">Kembali</a>
        </form>
    </div>

  


    <footer>
            <div class=" mt-5" style="text-align: center; padding: 10px 0; border-top: 1px solid #444;">
                <p>&copy; 2024 Merakkecil.com. Semua Hak Dilindungi.</p>
            </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    function calculateTotal() {
        let total = 0;
        const quantities = document.querySelectorAll('.item-quantity');

        quantities.forEach(input => {
            const price = parseFloat(input.getAttribute('data-price').replace('.').replace(',', '.'));
            const quantity = parseInt(input.value, 10);
            if (!isNaN(quantity) && quantity > 0) {
                total += price * quantity;
            }
        });

        document.getElementById('totalPrice').textContent = 'Total: Rp ' + total.toLocaleString('id-ID', { minimumFractionDigits: 2 });
    }
    </script>
</body>
</html>
