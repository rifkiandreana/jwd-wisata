<?php
session_start();
include('koneksi.php');

// Pastikan pengguna sudah login
if (!isset($_SESSION['id'])) {
    header("Location: login.php"); // Redirect ke halaman login jika belum login
    exit();
}

$pembeli_id = $_SESSION['id'];
$tanggal_pembelian = $_GET['tanggal'];

// Ambil data pembelian berdasarkan tanggal pembelian
$sql = "SELECT rh.id, dh.nama, rh.jumlah, dh.harga, rh.daftar_harga_id, rh.bukti_pembayaran
        FROM riwayat_pembelian rh
        JOIN daftar_harga dh ON rh.daftar_harga_id = dh.id
        WHERE rh.pembeli_id = ? AND rh.tanggal_pembelian = ?";
$stmt = $db->prepare($sql);
$stmt->bind_param("is", $pembeli_id, $tanggal_pembelian);
$stmt->execute();
$result = $stmt->get_result();

$pembelian = [];
$daftar_harga_ids = [];
$bukti_pembayaran_lama = "";
while ($row = $result->fetch_assoc()) {
    $pembelian[] = $row;
    $daftar_harga_ids[] = $row['daftar_harga_id'];
    $bukti_pembayaran_lama = $row['bukti_pembayaran'];
}

// Ambil semua item dari daftar_harga yang belum terbeli
$daftar_harga_ids_placeholder = implode(',', array_fill(0, count($daftar_harga_ids), '?'));
$sql = "SELECT id, nama, harga FROM daftar_harga WHERE id NOT IN ($daftar_harga_ids_placeholder)";
$stmt = $db->prepare($sql);
$stmt->bind_param(str_repeat('i', count($daftar_harga_ids)), ...$daftar_harga_ids);
$stmt->execute();
$additional_items = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pembelian</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">Edit Pembelian - Tanggal: <?php echo htmlspecialchars($tanggal_pembelian); ?></h1>
        <form action="proses_edit_pembelian.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="tanggal_pembelian" value="<?php echo htmlspecialchars($tanggal_pembelian); ?>">
            <input type="hidden" name="old_bukti_pembayaran" value="<?php echo htmlspecialchars($bukti_pembayaran_lama); ?>">
            <?php foreach ($pembelian as $item) { ?>
            <div class="form-group">
                <label for="jumlah_<?php echo $item['id']; ?>"><?php echo htmlspecialchars($item['nama']); ?></label>
                <input type="number" class="form-control item-quantity" id="jumlah_<?php echo $item['id']; ?>" name="jumlah[<?php echo $item['id']; ?>]" value="<?php echo $item['jumlah']; ?>" data-harga="<?php echo $item['harga']; ?>">
            </div>
            <?php } ?>
            <h2 class="mt-4">Tambah Item Lainnya</h2>
            <?php while ($row = $additional_items->fetch_assoc()) { ?>
            <div class="form-group">
                <label for="tambah_jumlah_<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['nama']); ?> (Rp <?php echo number_format($row['harga'], 2, ',', '.'); ?>)</label>
                <input type="number" class="form-control item-quantity" id="tambah_jumlah_<?php echo $row['id']; ?>" name="tambah_jumlah[<?php echo $row['id']; ?>]" data-harga="<?php echo $row['harga']; ?>">
            </div>
            <?php } ?>
            <button type="button" class="btn btn-info" onclick="calculateTotal()">Hitung Total</button>
            <h3 id="totalPrice">Total: Rp 0</h3>
            <div>
                <label for="bukti_pembayaran_baru">Upload Bukti Pembayaran Baru:</label>
                <input type="file" name="bukti_pembayaran_baru" id="bukti_pembayaran_baru">
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    function calculateTotal() {
        let total = 0;
        const quantities = document.querySelectorAll('.item-quantity');

        quantities.forEach(input => {
            const harga = parseFloat(input.getAttribute('data-harga'));
            const jumlah = parseInt(input.value, 10);
            if (!isNaN(jumlah) && jumlah > 0) {
                total += harga * jumlah;
            }
        });

        document.getElementById('totalPrice').textContent = 'Total: Rp ' + total.toLocaleString('id-ID', { minimumFractionDigits: 2 });
    }
    </script>
</body>
</html>
