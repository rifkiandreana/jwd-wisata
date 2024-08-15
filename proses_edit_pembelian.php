<?php
session_start();
include('koneksi.php');

// Pastikan pengguna sudah login
if (!isset($_SESSION['id'])) {
    header("Location: login.php"); // Redirect ke halaman login jika belum login
    exit();
}

$pembeli_id = $_SESSION['id'];
$tanggal_pembelian = $_POST['tanggal_pembelian'];
$jumlahs = $_POST['jumlah'];
$tambah_jumlahs = $_POST['tambah_jumlah'];
$bukti_pembayaran_baru = $_FILES['bukti_pembayaran_baru'];
$old_bukti_pembayaran = $_POST['old_bukti_pembayaran'];

// Proses item yang sudah ada
foreach ($jumlahs as $id => $jumlah) {
    $jumlah = intval($jumlah);

    // Hanya proses jika jumlah lebih dari 0
    if ($jumlah > 0) {
        // Ambil harga dari tabel daftar_harga
        $sql = "SELECT dh.harga
                FROM riwayat_pembelian rh
                JOIN daftar_harga dh ON rh.daftar_harga_id = dh.id
                WHERE rh.id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            $harga = $row['harga'];
            $total = $harga * $jumlah;

            // Update jumlah dan total di tabel riwayat_pembelian
            $sql = "UPDATE riwayat_pembelian SET jumlah = ?, total = ? WHERE id = ?";
            $stmt = $db->prepare($sql);
            $stmt->bind_param("idi", $jumlah, $total, $id);
            $stmt->execute();
        }
    }
}

// Proses item tambahan
foreach ($tambah_jumlahs as $id => $jumlah) {
    $jumlah = intval($jumlah);

    // Hanya proses jika jumlah lebih dari 0
    if ($jumlah > 0) {
        // Ambil harga dari tabel daftar_harga
        $sql = "SELECT harga FROM daftar_harga WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            $harga = $row['harga'];
            $total = $harga * $jumlah;

            // Simpan item tambahan ke tabel riwayat_pembelian
            $sql = "INSERT INTO riwayat_pembelian (pembeli_id, daftar_harga_id, jumlah, total, tanggal_pembelian) VALUES (?, ?, ?, ?, ?)";
            $stmt = $db->prepare($sql);
            $stmt->bind_param("iiids", $pembeli_id, $id, $jumlah, $total, $tanggal_pembelian);
            $stmt->execute();
        }
    }
}

// Proses bukti pembayaran
if ($bukti_pembayaran_baru['error'] === UPLOAD_ERR_OK) {
    $target_dir = "uploads/";

    // Hapus bukti pembayaran lama jika ada
    if ($old_bukti_pembayaran && file_exists($target_dir . $old_bukti_pembayaran)) {
        unlink($target_dir . $old_bukti_pembayaran);
    }

    // Nama file bukti pembayaran baru
    $file_ext = pathinfo($bukti_pembayaran_baru['name'], PATHINFO_EXTENSION);
    $new_bukti_pembayaran = uniqid() . '.' . $file_ext;
    $target_file = $target_dir . $new_bukti_pembayaran;

    // Pindahkan file ke direktori tujuan
    if (move_uploaded_file($bukti_pembayaran_baru['tmp_name'], $target_file)) {
        // Update nama file bukti pembayaran di database
        $sql = "UPDATE riwayat_pembelian SET bukti_pembayaran = ? WHERE tanggal_pembelian = ? AND pembeli_id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("ssi", $new_bukti_pembayaran, $tanggal_pembelian, $pembeli_id);
        $stmt->execute();
    }
}

// Update status menjadi 'pending' setelah edit
$sql = "UPDATE riwayat_pembelian SET status = 'pending' WHERE tanggal_pembelian = ? AND pembeli_id = ?";
$stmt = $db->prepare($sql);
$stmt->bind_param("si", $tanggal_pembelian, $pembeli_id);
$stmt->execute();

// Redirect atau tampilkan pesan sukses
header("Location: riwayat_pembelian.php");
exit();
?>
