<?php
session_start();
include('koneksi.php');

// Pastikan pengguna sudah login
if (!isset($_SESSION['id'])) {
    header("Location: login.php"); // Redirect ke halaman login jika belum login
    exit();
}

if (isset($_GET['tanggal'])) {
    $tanggal_pembelian = $_GET['tanggal'];

    // Hapus semua entri dengan tanggal pembelian yang sama
    $sql = "DELETE FROM riwayat_pembelian WHERE tanggal_pembelian = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("s", $tanggal_pembelian);
    $stmt->execute();

    header("Location: admin.php");
    exit();
}
?>
