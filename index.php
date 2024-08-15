<?php
include('koneksi.php');

// Ambil berita terbaru
$sql = "SELECT * FROM berita ORDER BY tanggal DESC";
$result = $db->query($sql);
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="style.css">
    <title>Merak Kecil</title>
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar fixed-top navbar-light bg-light">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center w-100">
                <div class="logo">
                    <a href=""><img src="img/logo_wonderfull.png" class="navbar-brand" alt="Logo"></a>
                </div>
                <div class="menu" id="menu">
                    <ul class="navbar-menu">
                        <li><a href="#home">Home</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="#tiket">Ticket</a></li>
                        <li><a href="#artikel">Article</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->


    <!-- Home -->
    <section id="home">
        <div class="background">
            <div class="text">
                <h4>WELCOME TO</h4>
                <h1 class="fw-bold">PULAU MERAK KECIL</h1>
                <!-- <figure>
                    <blockquote class="blockquote">
                        <p>"Bersama bintang. Bersama bulan. Bersama langit malam. Cukup dengan melihat alam, kamu merasakan kedamaian."</p>
                    </blockquote>
                    <figcaption class="blockquote-footer fs-3">
                       <cite title="Source Title">Rohmatikal Maskur</cite>
                    </figcaption>
                </figure>
                <figure class="text-center"> -->

                <p class="fs-5">Camping | Snorkling | Diving</p>
                
            </div>
        
        </div>
    </section>
    <!-- End Home -->

    <!-- Section About -->
    <section id="about">
        <div class="container-fluid">
            <div class="container">
            <div class="row justify-content-center">
                <div class="col-10">
                <h1 class="text-center fw-bold">About Merak Kecil</h1>
                <hr />
                </div>
                <div class="col-10 mt-3">
                <figure>
                    <blockquote class="blockquote">
                    <p>"Bersama bintang. Bersama bulan. Bersama langit malam. Cukup dengan melihat alam, kamu merasakan kedamaian."</p>
                    </blockquote>
                    <figcaption class="blockquote-footer fs-5">
                    <cite title="Source Title">Rohmatikal Maskur</cite>
                    </figcaption>
                </figure>
                <h3 style="text-align: justify;">
                    Pulau Merak Kecil adalah permata tersembunyi di pesisir Banten, menawarkan keindahan alam yang memukau dengan pantai berpasir putih, air laut jernih, dan pemandangan matahari terbenam yang menakjubkan. Ideal untuk liburan yang tenang, pulau ini juga menyediakan berbagai aktivitas seperti snorkeling, berjemur, dan menjelajahi kehidupan laut yang berwarna-warni. Kunjungi Pulau Merak Kecil dan rasakan petualangan yang tidak terlupakan di surga tropis ini.
                </h3>
                </div>
                <div class="col-10 mt-3">
                <div class="row">
                    <div class="col-12 col-md-6 mb-3 mb-md-0">
                    <iframe width="100%" height="335" src="https://www.youtube.com/embed/79XShocgPqo?si=CQb2TuuDY5Bo-psi" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                    </div>
                    <div class="col-12 col-md-6 map-container">
                    <iframe width="100%" height="335" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7936.78230938165!2d105.99097490145769!3d-5.940705025665347!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e4190ec76af6481%3A0xc16e9b615009bcc1!2sMerak%20Kecil!5e0!3m2!1sid!2sid!4v1722183840863!5m2!1sid!2sid" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        <img src="img/wave (8).svg" alt="">
    </section>
    <!-- End Section About -->
    
    <!-- Galeri -->
<!-- Terbaru -->
    <section id="galeri">
        <div class="container-fluid">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="buttons text-center">
                        <h1>See what's on this Island?</h1>
                        <button id="showPhoto"><i class="fas fa-camera"></i> Show Photos</button>
                        <button id="showVideo"><i class="fas fa-video"></i> Show Videos</button>
                    </div>
                    <!-- Konten untuk foto dan video berada di bawah tombol -->
                    <div id="photoContent" class="content active">
                        <div id="photoCarousel" class="carousel slide photo-carousel" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <!-- Indikator untuk foto -->
                                <!-- (Sama seperti sebelumnya) -->
                                <li data-target="#photoCarousel" data-slide-to="0" class="active"></li>
                                <li data-target="#photoCarousel" data-slide-to="1"></li>
                                <li data-target="#photoCarousel" data-slide-to="2"></li>
                                <li data-target="#photoCarousel" data-slide-to="3"></li>
                                <li data-target="#photoCarousel" data-slide-to="4"></li>
                                <li data-target="#photoCarousel" data-slide-to="5"></li>
                                <li data-target="#photoCarousel" data-slide-to="6"></li>
                                <li data-target="#photoCarousel" data-slide-to="7"></li>
                                <li data-target="#photoCarousel" data-slide-to="8"></li>
                                <li data-target="#photoCarousel" data-slide-to="9"></li>
                            </ol>
                            <div class="carousel-inner">
                                <!-- Item carousel foto -->
                                <!-- (Sama seperti sebelumnya) -->
                                <div class="carousel-item active">
                                <img src="img/pp-1 (1).jpg" class="d-block w-100" alt="Slide 1">
                                </div>
                                <div class="carousel-item">
                                <img src="img/pp-1 (2).jpg" class="d-block w-100" alt="Slide 2">
                                </div>
                                <div class="carousel-item">
                                <img src="img/pp-1 (3).jpg" class="d-block w-100" alt="Slide 3">
                                </div>
                                <div class="carousel-item">
                                <img src="img/pp-1 (4).jpg" class="d-block w-100" alt="Slide 4">
                                </div>
                                <div class="carousel-item">
                                <img src="img/pp-1 (5).jpg" class="d-block w-100" alt="Slide 5">
                                </div>
                                <div class="carousel-item">
                                <img src="img/pp-1 (6).jpg" class="d-block w-100" alt="Slide 6">
                                </div>
                                <div class="carousel-item">
                                <img src="img/pp-2 (1).jpeg" class="d-block w-100" alt="Slide 7">
                                </div>
                                <div class="carousel-item">
                                <img src="img/pp-2 (2).jpg" class="d-block w-100" alt="Slide 8">
                                </div>
                                <div class="carousel-item">
                                <img src="img/pp-2(4).webp" class="d-block w-100" alt="Slide 9">
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#photoCarousel" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#photoCarousel" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>

                    <div id="videoContent" class="content">
                        <div id="videoCarousel" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <!-- Indikator untuk video -->
                                <li data-target="#videoCarousel" data-slide-to="0" class="active"></li>
                                <li data-target="#videoCarousel" data-slide-to="1"></li>
                                <li data-target="#videoCarousel" data-slide-to="2"></li>
                                <li data-target="#videoCarousel" data-slide-to="3"></li>
                                <li data-target="#videoCarousel" data-slide-to="4"></li>
                                <!-- (Sama seperti sebelumnya) -->
                            </ol>
                            <div class="carousel-inner">
                                <!-- Item carousel video -->
                                <div class="carousel-item active">
                                <iframe src="https://www.youtube.com/embed/atUCBhPyoGI?si=HIaUB9wILuyIEKPI" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                </div>
                                <div class="carousel-item">
                                <iframe src="https://www.youtube.com/embed/7gnn7DxykgY?si=n04ix5NiMUjcUmv3" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                </div>
                                <div class="carousel-item">
                                <iframe src="https://www.youtube.com/embed/Z_h670DeUSM?si=r-XZNvwBekoCK1mV" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                </div>
                                <div class="carousel-item">
                                <iframe src="https://www.youtube.com/embed/2tbCF0z9R_4?si=DvHVUuhU8P5DKggw" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                </div>
                                <div class="carousel-item">
                                <iframe src="https://www.youtube.com/embed/bwXjq-l0JgA?si=bW9IDXl-gy-eZ0n5" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                                </div>
                                <!-- (Sama seperti sebelumnya) -->
                            </div>
                            <a class="carousel-control-prev" href="#videoCarousel" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#videoCarousel" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- End Galeri-->
    <!-- Tiket -->
    <section id="tiket">
        <img src="img/wave (9).svg" alt="">
        <div class="container-fluid">
            <div class="container">
            <div class="row justify-content-center">
                <div class="col-10">
                    <h1 class="fw-bold">Detail Harga?</h1>
                <hr />
                </div>
                <div class="col-10 mt-3">
                <div class="row ">
                    <div class="col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Registrasi</h5>
                                <p class="card-text ">Umum 20k <br>Pelajar 10k <br> Penyeberangan 30k</p>
                            </div>
                            </div>
                        </div>
                    <div class="col-sm-6">
                        <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Penyewaan & Fasilitas</h5>
                            <p class="card-text scroll1">Hamock 20k <br>Nesting 10k <br> Lampu 30k <br> Kompor 20k<br> Gas 30k <br> Matras/Tikar <br> Mushola <br> Toilet</p>
                        </div>
                        </div>
                    </div>
                </div>
             
                </div>
                <div class="col-10 mt-3">
                    <div class="row">
                    <h4>Paket Wisata yang Tersedia:</h4>
                    </div>
                    <div class="card mb-3">
                    
                    <!-- <img src="img/Camping.png" class="card-img-top w-50 h-50" alt="..."> -->
                    <div class="card-body">
                        <h5 class="card-title">Paket Marlin</h5>
                        <p class="card-text">Tenda kapasitas 6 orang + Kompor + Gas + Nesting + Lampu.</p>
                        <p class="card-text"><small class="text-muted">Rp 250.000</small></p>
                        <hr>
                        <h5 class="card-title">Paket Penyu</h5>
                        <p class="card-text">Tenda kapasitas 4 orang + Kompor + Gas + Nesting + Lampu.</p>
                        <p class="card-text"><small class="text-muted">Rp 200.000</small></p>
                        <hr>
                        <h5 class="card-title">Paket Nemo</h5>
                        <p class="card-text">Tenda kapasitas 2 orang + Kompor + Gas + Nesting + Lampu.</p>
                        <p class="card-text"><small class="text-muted">Rp 150.000</small></p>
                    </div>
                    </div>
                    <div class="card text-center">
                    
                    <div class="card-body">
                        <h5 class="card-title">Makin penasaran kan???</h5>
                        <p class="card-text">Masaa iya liburan cuma scroll tiktok dan netflix doang? yakinn gamau liat serpihan surga si banten ini??</p>
                        <a href="login.php" target="_blank" class="btn btn-primary">Yukk Pesan Tiket</a>
                    </div>
                </div>
                </div>             
            </div>            
            </div>  
        </div>
    </section>
    <!-- End Tiket -->

    <!-- Artikel  -->
    <section>
    <div id="carouselBerita" class="carousel slide mt-4" data-ride="carousel">
    <ol class="carousel-indicators">
        <?php
        $indicatorIndex = 0;
        while ($row = $result->fetch_assoc()) {
            $activeClass = ($indicatorIndex === 0) ? 'active' : '';
            echo "<li data-target=\"#carouselBerita\" data-slide-to=\"$indicatorIndex\" class=\"$activeClass\"></li>";
            $indicatorIndex++;
        }
        $result->data_seek(0); // Reset result set pointer
        ?>
    </ol>
    <div class="carousel-inner">
        <?php
        $itemIndex = 0;
        while ($row = $result->fetch_assoc()) {
            $activeClass = ($itemIndex === 0) ? 'active' : '';
            ?>
            <div class="carousel-item <?php echo $activeClass; ?>">
                <?php if ($row['gambar']) { ?>
                    <img src="uploads/<?php echo htmlspecialchars($row['gambar']); ?>" class="d-block w-100" alt="Gambar Berita">
                <?php } ?>
                <div class="carousel-caption d-none d-md-block">
                    <h5 style="color: black;"><?php echo htmlspecialchars($row['judul']); ?></h5>
                    <p style="color: black;">>Sumber: <?php echo htmlspecialchars($row['sumber']); ?></p>
                    <a href="<?php echo htmlspecialchars($row['link']); ?>" target="_blank">Baca Selengkapnya</a>
                </div>
            </div>
            <?php
            $itemIndex++;
        }
        ?>
    </div>
    <a class="carousel-control-prev" href="#carouselBerita" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselBerita" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

    </section>

    <!-- End Artikel -->


    <!-- Footer -->
    <section>
    <footer style="background-color: #fff; color: black; padding: 20px 0; margin-top :20px;">
    <div class="footer-container">
        <!-- Bagian kontak -->
        <div class="footer-section">
            <h3>Alamat</h3>
            <iframe width="80%" height="auto" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7936.78230938165!2d105.99097490145769!3d-5.940705025665347!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e4190ec76af6481%3A0xc16e9b615009bcc1!2sMerak%20Kecil!5e0!3m2!1sid!2sid!4v1722183840863!5m2!1sid!2sid" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        <!-- Bagian tautan penting -->
        <div class="footer-section">
            <h3>Tautan Penting</h3>
            <ul>
                <li><a href="#">Beranda</a></li>
                <li><a href="#about">Tentang Merak Kecil</a></li>
                <li><a href="#tiket">Paket Wisata</a></li>
                <li><a href="#artikel">Artikel</a></li>
            </ul>
        </div>

        <!-- Bagian sosial media -->
        <div class="footer-section">
            <h3>Informasi</h3>
            <div class="social-icons">
                <a href="https://www.youtube.com/@anakpulomeraktv5173" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-youtube" viewBox="0 0 16 16">
                        <path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.01 2.01 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.01 2.01 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31 31 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.01 2.01 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A100 100 0 0 1 7.858 2zM6.4 5.209v4.818l4.157-2.408z"/>
                    </svg>
                </a>
                <a href="https://www.tiktok.com/@anakpulo.official" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-tiktok" viewBox="0 0 16 16">
                        <path d="M9 0h1.98c.144.715.54 1.617 1.235 2.512C12.895 3.389 13.797 4 15 4v2c-1.753 0-3.07-.814-4-1.829V11a5 5 0 1 1-5-5v2a3 3 0 1 0 3 3z"/>
                    </svg>
                </a>
                <a href="https://www.instagram.com/pulaumerakkecil/" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                        <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334"/>
                    </svg>
                </a>
                <a href="https://wa.me/+6285213493563?text=Hallo!" target="_blank">
                    <svg xmlns="http://www.w3.org/2000/svg" style="color: black;" width="25" height="25" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                        <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
            <div style="text-align: center; padding: 10px 0; border-top: 1px solid #444;">
                <p>&copy; 2024 Merakkecil.com. <a href="login_admin.php" target="_blank" class="text-body-secondary">Semua Hak Dilindungi.</a></p>
            </div>
        </footer>
    </section>

    <!-- End Footer -->
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
    <script>
          document.getElementById('showPhoto').addEventListener('click', function() {
            document.getElementById('photoContent').classList.add('active');
            document.getElementById('videoContent').classList.remove('active');
        });

        document.getElementById('showVideo').addEventListener('click', function() {
            document.getElementById('photoContent').classList.remove('active');
            document.getElementById('videoContent').classList.add('active');
        });
    </script>
   
     <script src="script.js"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>