<?php
session_start();
include('koneksi.php');

// Pastikan admin sudah login
if (!isset($_SESSION['id'])) {
    header("Location: login_admin.php"); // Redirect ke halaman login jika belum login atau bukan admin
    exit();
}

$username = $_SESSION['username'];

// Ambil semua pembelian
$sql_pembelian = "SELECT rh.id, dh.nama, rh.jumlah, rh.total, rh.tanggal_pembelian, rh.status, rh.bukti_pembayaran
        FROM riwayat_pembelian rh
        JOIN daftar_harga dh ON rh.daftar_harga_id = dh.id
        ORDER BY rh.tanggal_pembelian";
$result_pembelian = $db->query($sql_pembelian);


// Handle form submission for updating status
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['invoice_id']) && isset($_POST['status'])) {
        $invoice_id = $_POST['invoice_id'];
        $status = $_POST['status'];

        $sql_update = "UPDATE riwayat_pembelian SET status = ? WHERE id = ?";
        $stmt_update = $db->prepare($sql_update);
        $stmt_update->bind_param("si", $status, $invoice_id);
        $stmt_update->execute();

        // Redirect setelah update
        header("Location: admin.php");
        exit();
    }
}

// Handle form submission for new berita
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'upload') {
        $judul = $_POST['judul'];
        $sumber = $_POST['sumber'];
        $link = $_POST['link'];

        // Handle file upload
        if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
            $gambar = $_FILES['gambar']['name'];
            $tmp_name = $_FILES['gambar']['tmp_name'];
            $upload_dir = 'uploads/';
            $upload_file = $upload_dir . basename($gambar);
            move_uploaded_file($tmp_name, $upload_file);
        } else {
            $gambar = null;
        }

        // Insert berita into database
        $sql_insert_berita = "INSERT INTO berita (judul, sumber, link, gambar) VALUES (?, ?, ?, ?)";
        $stmt_insert_berita = $db->prepare($sql_insert_berita);
        $stmt_insert_berita->bind_param("ssss", $judul, $sumber, $link, $gambar);
        $stmt_insert_berita->execute();
    } elseif ($_POST['action'] === 'delete') {
        $id = $_POST['id'];

        // Delete berita from database
        $sql_delete_berita = "DELETE FROM berita WHERE id = ?";
        $stmt_delete_berita = $db->prepare($sql_delete_berita);
        $stmt_delete_berita->bind_param("i", $id);
        $stmt_delete_berita->execute();
    } elseif ($_POST['action'] === 'update') {
        $id = $_POST['id'];
        $judul = $_POST['judul'];
        $sumber = $_POST['sumber'];
        $link = $_POST['link'];

        // Update berita in database
        $sql_update_berita = "UPDATE berita SET judul = ?, sumber = ?, link = ? WHERE id = ?";
        $stmt_update_berita = $db->prepare($sql_update_berita);
        $stmt_update_berita->bind_param("sssi", $judul, $sumber, $link, $id);
        $stmt_update_berita->execute();
    }

    // Redirect after processing form
    header("Location: admin.php");
    exit();
}

// Fetch all berita from database
$sql_berita = "SELECT * FROM berita ORDER BY tanggal DESC";
$result_berita = $db->query($sql_berita);

// Ambil data penjualan bulanan untuk grafik
$sql_penjualan_bulanan = "SELECT DATE_FORMAT(tanggal_pembelian, '%Y-%m') AS bulan, SUM(total) AS total_penjualan
    FROM riwayat_pembelian
    GROUP BY bulan
    ORDER BY bulan";
$result_penjualan_bulanan = $db->query($sql_penjualan_bulanan);

$labels = [];
$data = [];

while ($row = $result_penjualan_bulanan->fetch_assoc()) {
    $labels[] = $row['bulan'];
    $data[] = $row['total_penjualan'];
}

$labels_json = json_encode($labels);
$data_json = json_encode($data);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding-top: 56px; /* Adjust according to your navbar height */
        }
        .sidebar, .navbar {
            height: auto;
            width: auto;
            background-color: aliceblue;
            
        }
        
        .sidebar a {
            text-decoration: none;
            color: #000;
            display: block;
            padding: 10px;
        }
        .sidebar a:hover {
            background-color: #e9ecef;
        }
        .content {
            display: none;
        }
        .active {
            display: block;
        }

    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <a class="navbar-brand" href="#"><?php echo htmlspecialchars($username); ?></a>
        <a href="index.php"class="btn btn-secondary mt-1  ml-auto" id="brand" onclick="return confirm('Are you sure you want to close this?');"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-escape" viewBox="0 0 16 16">
            <path d="M8.538 1.02a.5.5 0 1 0-.076.998 6 6 0 1 1-6.445 6.444.5.5 0 0 0-.997.076A7 7 0 1 0 8.538 1.02"/>
            <path d="M7.096 7.828a.5.5 0 0 0 .707-.707L2.707 2.025h2.768a.5.5 0 1 0 0-1H1.5a.5.5 0 0 0-.5.5V5.5a.5.5 0 0 0 1 0V2.732z"/>
            </svg>
        </a>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 d-md-block sidebar">
                <h4>Merak Kecil</h4>
                <a href="#" id="home-link">Home</a>
                <a href="#" id="settings-link">Settings</a>
                <a href="#" id="reports-link">Reports</a>
            </nav>

            <!-- Main content -->
            <main id="main-content" class="col-md-10 ml-sm-auto px-4">
                <!-- Home Content -->
                <div id="home-content" class="content active">
                    <h1>Admin Dashboard</h1>
                    <h2>Pending Invoices</h2>
                    <!-- Isi dari halaman Home (Pending Invoices) -->
                    <!-- .... -->
                    <div class="container mt-4">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Tanggal Pembelian</th>
                                <th>ID</th>
                                <th>Nama Item</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Bukti Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $grouped_data = [];
                                while ($row = $result_pembelian->fetch_assoc()) {
                                    $grouped_data[$row['tanggal_pembelian']][] = $row;
                                }
                                
                                // Urutkan $grouped_data berdasarkan tanggal secara menurun (dari yang terbaru ke yang terlama)
                                krsort($grouped_data);
                                
                                foreach ($grouped_data as $tanggal => $items) { ?>
                                <tr>
                                    <td rowspan="<?php echo count($items); ?>"><?php echo htmlspecialchars($tanggal); ?></td>
                                    <td><?php echo htmlspecialchars($items[0]['id']); ?></td>
                                    <td><?php echo htmlspecialchars($items[0]['nama']); ?></td>
                                    <td><?php echo htmlspecialchars($items[0]['jumlah']); ?></td>
                                    <td>Rp <?php echo number_format($items[0]['total'], 2, ',', '.'); ?></td>
                                    <td rowspan="<?php echo count($items); ?>"><?php echo htmlspecialchars($items[0]['status']); ?></td>
                                    <td rowspan="<?php echo count($items); ?>">
                                        <?php if ($items[0]['bukti_pembayaran']) { ?>
                                            <a href="uploads/<?php echo htmlspecialchars($items[0]['bukti_pembayaran']); ?>" target="_blank">Lihat Bukti</a>
                                        <?php } else { ?>
                                            Tidak Ada Bukti
                                        <?php } ?>
                                    </td>
                                    <td rowspan="<?php echo count($items); ?>">
                                        <form method="post" action="">
                                            <input type="hidden" name="invoice_id" value="<?php echo $items[0]['id']; ?>">
                                            <select name="status" class="form-control">
                                                <option value="pending" <?php if ($items[0]['status'] == 'pending') echo 'selected'; ?>>Pending</option>
                                                <option value="approved" <?php if ($items[0]['status'] == 'approved') echo 'selected'; ?>>Approved</option>
                                            </select>
                                            <button type="submit" class="btn btn-primary mt-2">Update Status</button>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="delete_pembelian_admin.php?tanggal=<?php echo urlencode($tanggal); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete all items for this date?');">Delete</a>
                                    </td>
                                </tr>
                                <?php for ($i = 1; $i < count($items); $i++) { ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($items[$i]['id']); ?></td>
                                        <td><?php echo htmlspecialchars($items[$i]['nama']); ?></td>
                                        <td><?php echo htmlspecialchars($items[$i]['jumlah']); ?></td>
                                        <td>Rp <?php echo number_format($items[$i]['total'], 2, ',', '.'); ?></td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </tbody>

                    </table>
                    </div>
                </div>

                <!-- Settings (Upload Berita) Content -->
                <div id="settings-content" class="content">
                    <h2>Upload Berita Baru</h2>
                    <form method="post" action="admin.php" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="judul">Judul Berita</label>
                            <input type="text" class="form-control" id="judul" name="judul" required>
                        </div>
                        <div class="form-group">
                            <label for="sumber">Sumber Berita</label>
                            <input type="text" class="form-control" id="sumber" name="sumber" required>
                        </div>
                        <div class="form-group">
                            <label for="link">Link Berita</label>
                            <input type="url" class="form-control" id="link" name="link" required>
                        </div>
                        <div class="form-group">
                            <label for="gambar">Gambar Berita</label>
                            <input type="file" class="form-control-file" id="gambar" name="gambar">
                        </div>
                        <input type="hidden" name="action" value="upload">
                        <button type="submit" class="btn btn-primary">Upload Berita</button>
                    </form>
                    <!-- .... -->
                        <!-- Table Berita -->
                    <h2 class="mt-5">Daftar Berita</h2>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Judul</th>
                                <th>Sumber</th>
                                <th>Link</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result_berita->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                                    <td><?php echo htmlspecialchars($row['judul']); ?></td>
                                    <td><?php echo htmlspecialchars($row['sumber']); ?></td>
                                    <td><a href="<?php echo htmlspecialchars($row['link']); ?>" target="_blank">Link Berita</a></td>
                                    <td><?php if ($row['gambar']) { ?>
                                            <img src="uploads/<?php echo htmlspecialchars($row['gambar']); ?>" alt="<?php echo htmlspecialchars($row['judul']); ?>" width="100">
                                        <?php } else { ?>
                                            Tidak ada gambar
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <form method="post" action="">
                                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                            <button type="submit" name="action" value="delete" class="btn btn-danger">Delete</button>
                                        </form>
                                        <form method="post" action="">
                                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                            <div class="form-group">
                                                <label for="judul">Judul Berita</label>
                                                <input type="text" class="form-control" name="judul" value="<?php echo htmlspecialchars($row['judul']); ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="sumber">Sumber Berita</label>
                                                <input type="text" class="form-control" name="sumber" value="<?php echo htmlspecialchars($row['sumber']); ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="link">Link Berita</label>
                                                <input type="text" class="form-control" name="link" value="<?php echo htmlspecialchars($row['link']); ?>" required>
                                            </div>
                                            <button type="submit" name="action" value="update" class="btn btn-primary">Update</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>

                        <!-- Untuk diagram  -->
                    </table>
                </div>
                  <!-- Reports Content -->
                <div id="reports-content" class="content">
                    <h2 id="download-chart" >Penjualan Bulanan</h2>
                    <canvas id="sales-chart" width="600" height="200"></canvas>
                    <!-- <a href="data:image/png;base64," class="btn btn-primary mt-3">Download Diagram</a> -->
                </div>
            </main>
        </div>
    </div>


    <script>
        document.getElementById('settings-link').addEventListener('click', function() {
            document.getElementById('home-content').classList.remove('active');
            document.getElementById('settings-content').classList.add('active');
        });

        document.getElementById('home-link').addEventListener('click', function() {
            document.getElementById('settings-content').classList.remove('active');
            document.getElementById('home-content').classList.add('active');
        });
    </script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Data untuk Chart.js
        var ctx = document.getElementById('sales-chart').getContext('2d');
        var salesChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo $labels_json; ?>,
                datasets: [{
                    label: 'Total Penjualan',
                    data: <?php echo $data_json; ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Set download link
        document.getElementById('download-chart').href = 'data:image/png;base64,' + btoa(document.getElementById('sales-chart').toDataURL('image/png').split(',')[1]);
        
        // Toggle content visibility
        document.getElementById('home-link').addEventListener('click', function() {
            document.querySelectorAll('.content').forEach(function(el) {
                el.classList.remove('active');
            });
            document.getElementById('home-content').classList.add('active');
        });

        document.getElementById('settings-link').addEventListener('click', function() {
            document.querySelectorAll('.content').forEach(function(el) {
                el.classList.remove('active');
            });
            document.getElementById('settings-content').classList.add('active');
        });

        document.getElementById('reports-link').addEventListener('click', function() {
            document.querySelectorAll('.content').forEach(function(el) {
                el.classList.remove('active');
            });
            document.getElementById('reports-content').classList.add('active');
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>