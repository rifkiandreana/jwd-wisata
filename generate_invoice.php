<?php
require('fpdf/fpdf.php');
include('koneksi.php');

if (isset($_GET['invoice_id'])) {
    $invoice_id = $_GET['invoice_id'];

    // Ambil data pembelian dari database
    $sql = "SELECT rh.id, dh.nama, rh.jumlah, rh.total, rh.tanggal_pembelian, rh.tanggal_booking, p.nama as pembeli_nama, p.telepon
            FROM riwayat_pembelian rh
            JOIN daftar_harga dh ON rh.daftar_harga_id = dh.id
            JOIN data_pembeli p ON rh.pembeli_id = p.id
            WHERE rh.tanggal_pembelian = (
                SELECT tanggal_pembelian FROM riwayat_pembelian WHERE id = ?
            )";

    // Debugging: Periksa apakah prepare berhasil
    if ($stmt = $db->prepare($sql)) {
        $stmt->bind_param("i", $invoice_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC); // Mengambil semua data

        // Buat PDF Invoice
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);

        // Menambahkan Logo
        $pdf->Image('img/logo_wonderfull.png', 10, 10, 30);
        $pdf->Cell(0, 10, 'Invoice', 0, 1, 'C');
        $pdf->Ln(10);

        if (count($data) > 0) {
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(0, 10, 'Nama Pembeli     : ' . htmlspecialchars($data[0]['pembeli_nama']));
            $pdf->Ln(10);
            $pdf->Cell(0, 10, 'Nomor Telepon    : ' . htmlspecialchars($data[0]['telepon']));
            $pdf->Ln(10);
            $pdf->Cell(0, 10, 'Tanggal Pembelian: ' . htmlspecialchars($data[0]['tanggal_pembelian']));
            $pdf->Ln(10);
            $pdf->Cell(0, 10, 'Tanggal Booking  : ' . htmlspecialchars($data[0]['tanggal_booking']));
            $pdf->Ln(10);
            
            // Tabel Header
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(80, 10, 'Nama Item', 1);
            $pdf->Cell(30, 10, 'Jumlah', 1);
            $pdf->Cell(40, 10, 'Total', 1);
            $pdf->Ln();

            // Tabel Content
            $pdf->SetFont('Arial', '', 12);
            $total_sum = 0;
            foreach ($data as $row) {
                $pdf->Cell(80, 10, htmlspecialchars($row['nama']), 1);
                $pdf->Cell(30, 10, htmlspecialchars($row['jumlah']), 1);
                $pdf->Cell(40, 10, 'Rp ' . number_format($row['total'], 2, ',', '.'), 1);
                $pdf->Ln();
                $total_sum += $row['total'];
            }

            $pdf->Ln(10);
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell(110, 10, 'Total Keseluruhan:', 0);
            $pdf->Cell(40, 10, 'Rp ' . number_format($total_sum, 2, ',', '.'), 1);
        } else {
            $pdf->Cell(0, 10, 'No data found for the given invoice ID.');
        }

        $pdf->Ln(20);

        // Menambahkan Cap/Tanda Tangan
        $pdf->Image('img/ttd andre.jpg', 10, $pdf->GetY(), 50);
        $pdf->Ln(10);
        $pdf->Image('img/stempel.png', 10, $pdf->GetY(), 50);

        

        $pdf->Output();
    } else {
        // Tampilkan pesan kesalahan jika prepare gagal
        echo "Error preparing the SQL statement: " . $db->error;
        if ($result = $stmt->get_result()) {
            $data = $result->fetch_all(MYSQLI_ASSOC); // Mengambil semua data
            if (empty($data)) {
                echo "No data found for the given invoice ID.";
            }
        } else {
            echo "Error getting result: " . $stmt->error;
        }
    }
}
?>
