<?php
session_start();
include('../koneksi.php');

// Pastikan pengguna sudah login
if (!isset($_SESSION['id'])) {
    header("Location: login.php"); // Redirect ke halaman login jika belum login
    exit();
}

$pembeli_id = $_SESSION['id'];
$daftar_harga_ids = $_POST['daftar_harga_id'];
$jumlahs = $_POST['jumlah'];
$tanggal_booking = $_POST['tanggal_booking']; // Ambil tanggal booking dari form

// Direktori penyimpanan file bukti pembayaran
$upload_dir = 'uploads/';
if (!file_exists($upload_dir)) {
    mkdir($upload_dir, 0755, true);
}

$bukti_pembayaran = null;
if (isset($_FILES['bukti_pembayaran']) && $_FILES['bukti_pembayaran']['error'] == UPLOAD_ERR_OK) {
    $tmp_name = $_FILES['bukti_pembayaran']['tmp_name'];
    $name = basename($_FILES['bukti_pembayaran']['name']);
    $upload_file = $upload_dir . $name;

    if (move_uploaded_file($tmp_name, $upload_file)) {
        $bukti_pembayaran = $name;
    }
}

foreach ($daftar_harga_ids as $index => $daftar_harga_id) {
    $jumlah = isset($jumlahs[$index]) ? intval($jumlahs[$index]) : 0;

    // Hanya proses jika jumlah lebih dari 0
    if ($jumlah > 0) {
        // Ambil harga dari tabel daftar_harga
        $sql = "SELECT harga FROM daftar_harga WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $daftar_harga_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            $harga = $row['harga'];
            $total = $harga * $jumlah;

            // Simpan riwayat pembelian
            $sql = "INSERT INTO riwayat_pembelian (pembeli_id, daftar_harga_id, jumlah, total, bukti_pembayaran, tanggal_booking) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $db->prepare($sql);
            $stmt->bind_param("iiidss", $pembeli_id, $daftar_harga_id, $jumlah, $total, $bukti_pembayaran, $tanggal_booking);
            $stmt->execute();
        }
    }
}

// Redirect atau tampilkan pesan sukses
ob_start();
header("Location: ../pembelian_sukses.php");
exit();
ob_end_flush();
?>
