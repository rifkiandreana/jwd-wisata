<?php
session_start();
include('koneksi.php');

// Pastikan pengguna sudah login
if (!isset($_SESSION['id'])) {
    header("Location: login.php"); // Redirect ke halaman login jika belum login
    exit();
}

$pembeli_id = $_SESSION['id'];


// Ambil riwayat pembelian dari database

$sql = "SELECT rh.id, dh.nama, rh.jumlah, rh.total, rh.tanggal_pembelian, rh.status
        FROM riwayat_pembelian rh
        JOIN daftar_harga dh ON rh.daftar_harga_id = dh.id
        WHERE rh.pembeli_id = ?
        ORDER BY rh.tanggal_pembelian";
$stmt = $db->prepare($sql);
$stmt->bind_param("i", $pembeli_id);
$stmt->execute();
$result = $stmt->get_result();

// Kelompokkan data berdasarkan tanggal pembelian
$grouped_data = [];
while ($row = $result->fetch_assoc()) {
    $grouped_data[$row['tanggal_pembelian']][] = $row;
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pembelian</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1 class="mb-4">Riwayat Pembelian</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tanggal Pembelian</th>
                    <th>Nama Item</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Invoice</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($grouped_data as $tanggal => $items) { ?>
                    <tr>
                        <td rowspan="<?php echo count($items); ?>"><?php echo htmlspecialchars($tanggal); ?></td>
                        <td><?php echo htmlspecialchars($items[0]['nama']); ?></td>
                        <td><?php echo htmlspecialchars($items[0]['jumlah']); ?></td>
                        <td>Rp <?php echo number_format($items[0]['total'], 2, ',', '.'); ?></td>
                        <td rowspan="<?php echo count($items); ?>">
                            <?php echo htmlspecialchars($items[0]['status']); ?>
                        </td>
                        <td rowspan="<?php echo count($items); ?>">
                            <?php if ($items[0]['status'] == 'approved') { ?>
                                <a href="generate_invoice.php?invoice_id=<?php echo $items[0]['id']; ?>" class="btn btn-success">Download Invoice</a>
                            <?php } else { ?>
                                <span class="text-muted">Invoice pending approval</span>
                            <?php } ?>
                        </td>
                        <td rowspan="<?php echo count($items); ?>">
                            <a href="edit_pembelian.php?tanggal=<?php echo urlencode($tanggal); ?>" class="btn btn-warning btn-sm">Edit Pesanan</a>
                        </td>
                    </tr>
                    <?php for ($i = 1; $i < count($items); $i++) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($items[$i]['nama']); ?></td>
                            <td><?php echo htmlspecialchars($items[$i]['jumlah']); ?></td>
                            <td>Rp <?php echo number_format($items[$i]['total'], 2, ',', '.'); ?></td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
        <a href="halaman_pembeli.php" class="btn btn-danger">Kembali</a>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

