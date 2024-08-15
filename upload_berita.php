<?php
session_start();
include('koneksi.php');

// Pastikan admin sudah login
if (!isset($_SESSION['id'])) {
    header("Location: login_admin.php"); // Redirect ke halaman login jika belum login atau bukan admin
    exit();
}

// Proses upload berita
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $judul = $_POST['judul'];
    $konten = $_POST['konten'];
    $gambar = null;

    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == UPLOAD_ERR_OK) {
        $gambar = $_FILES['gambar']['name'];
        move_uploaded_file($_FILES['gambar']['tmp_name'], "uploads/".$gambar);
    }

    $sql = "INSERT INTO berita (judul, konten, gambar) VALUES (?, ?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("sss", $judul, $konten, $gambar);
    $stmt->execute();

    // Redirect setelah upload
    header("Location: admin.php");
    exit();
}
?>
