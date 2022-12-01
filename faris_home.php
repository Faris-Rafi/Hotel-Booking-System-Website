    <?php
        $mfarisrafi_settings = mysqli_query($mfarisrafi_db_connect,"SELECT * FROM mfarisrafi_site_settings");
        $mfarisrafi_setting = mysqli_fetch_assoc($mfarisrafi_settings);
    ?>
    <!-- SLIDESHOW -->
    <div id="myCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img style="opacity: 0.7;" class="bd-placeholder-img" src="assets/img/<?php echo $mfarisrafi_setting['mfarisrafi_foto1'] ?>" width="100%" height="600px">

                <div class="container">
                    <div class="carousel-caption">
                        <h1 class="text-black fw-bold"><?php echo $mfarisrafi_setting['mfarisrafi_cap1'] ?></h1>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img style="opacity: 0.7;" class="bd-placeholder-img" src="assets/img/<?php echo $mfarisrafi_setting['mfarisrafi_foto2'] ?>" width="100%" height="600px">

                <div class="container">
                    <div class="carousel-caption">
                        <h1 class="text-black fw-bold"><?php echo $mfarisrafi_setting['mfarisrafi_cap2'] ?></h1>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img style="opacity: 0.7;" class="bd-placeholder-img" src="assets/img/<?php echo $mfarisrafi_setting['mfarisrafi_foto3'] ?>" width="100%" height="600px">

                <div class="container">
                    <div class="carousel-caption">
                        <h1 class="text-black fw-bold"><?php echo $mfarisrafi_setting['mfarisrafi_cap3'] ?></h1>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- SLIDESHOW END -->

    <!-- RESERVATION BUTTON -->
    <div class="py-4 text-center reserved" style="overflow-x: hidden;" id="pesanKamar">
    <h2 class="text-white mb-4">PESAN KAMAR</h2>
        <form action="index.php?page=faris_check-kamar" method="post" class="row align-items-center offset-2">
            <div class="col-auto text-white">
                <label for="">Check-In</label>
                <input type="text" name="mfarisrafi_cek_in" id="check-in" class="form-control" autocomplete="off" placeholder="TT/BB/HH" required>
            </div>
            <div class="col-auto text-white">
                <label for="">Check-Out</label>
                <input type="text" name="mfarisrafi_cek_out" id="check-out" class="form-control" autocomplete="off" placeholder="TT/BB/HH" required>
            </div>
            <div class="col-auto text-white">
                <label for="">Jumlah Kamar</label>
                <input type="number" name="mfarisrafi_jumlah_kamar" id="jumlah-kamar" class="form-control" placeholder="Masukkan Jumlah Kamar" required>
            </div>
            <div class="col-auto text-white">
                <button class="btn btn-primary mt-4" id="cek-btn">Cek Ketersediaan</button>
            </div>
        </form>
    </div>
    <!-- RESERVATION BUTTON END -->

    <!-- FACILITY & SERVICES -->
    <div class="b-example-divider" id="facility"></div>

    <div class="parallax">
        <div class="row">
            <h2 class="text-white text-center fw-bold display-6 py-4">Fasilitas & Pelayanan</h2>
        </div>
        <div class="row d-flex flex-row justify-content-center g-1 py-5">
            <?php
                $mfarisrafi_fasilitas = mysqli_query($mfarisrafi_db_connect,"SELECT * FROM mfarisrafi_fasilitas_hotel ORDER BY mfarisrafi_id_hotel");
                while($mfarisrafi_row = mysqli_fetch_assoc($mfarisrafi_fasilitas)) :
            ?>
            <div class="col-md-3">
                <div class="h-100 p-5 text-white text-center bg-none border rounded-3">
                    <h2><?php echo $mfarisrafi_row['mfarisrafi_nama_fasilitas'] ?></h2>
                    <p><?php echo $mfarisrafi_row['mfarisrafi_keterangan'] ?></p>
                    <a href="javascript:void(0)" data-bs-id="<?php echo $mfarisrafi_row['mfarisrafi_id_hotel'] ?>" class="btn btn-outline-light lihat-hotel">Lihat Selengkapnya</a>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
    <!-- FACILITY & SERVICES END -->

    <!-- ROOMS FACILITY -->
    <div class="b-example-divider" id="rooms"></div>

    <div class="py-3 text-center" style="background: #0f2453;">
        <h1 class="display-6 fw-bold text-white">Fasilitas Ruangan</h1>
    </div>
    
    <?php
        $mfarisrafi_kamar = mysqli_query($mfarisrafi_db_connect,"SELECT * FROM mfarisrafi_tipe_kamar ORDER BY mfarisrafi_id_tipe");
        while($mfarisrafi_row = mysqli_fetch_assoc($mfarisrafi_kamar)):
    ?>
    <div class="b-example-divider"></div>

    <div class="container col-sm-10 px-4 py-5">
        <div class="row flex-lg-row-reverse align-items-center g-5 py-2">
            <div class="col-10 col-sm-8 col-lg-6">
                <img src="assets/img/<?php echo $mfarisrafi_row['mfarisrafi_foto'] ?>" class="d-block mx-lg-auto img-fluid" width="400" height="100">
            </div>
            <div class="col-lg-6">
                <h1 class="display-5 fw-bold lh-1 mb-3"><?php echo $mfarisrafi_row['mfarisrafi_tipe_kamar'] ?></h1>
                <p class="lead"><?php echo $mfarisrafi_row['mfarisrafi_deskripsi'] ?></p>
                <p class="lead text-success"><?php echo 'Rp.'.number_format($mfarisrafi_row['mfarisrafi_harga'],2) ?> / Hari</p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                    <a href="javascript:void(0)" class="btn btn-outline-secondary btn-lg px-4 me-md-2 lihat-kamar" id="lihat-kamar" data-bs-id="<?php echo $mfarisrafi_row['mfarisrafi_id_tipe'] ?>">Lihat Selengkapnya</a>
                    <a href="#pesanKamar" class="btn btn-primary btn-lg px-4 me-md-2">Pesan</a>
                </div>
            </div>
        </div>
    </div>
    <?php endwhile; ?>
    
    <!-- ROOMS FACILITY END -->

    <!-- ABOUT -->
    <div class="b-example-divider" id="about"></div>

    <div class="px-4 py-5 my-5 text-center">
        <h1 class="display-5 fw-bold">Tentang</h1>
        <div class="col-lg-6 mx-auto">
            <p class="lead mb-4"><?php echo $mfarisrafi_setting['mfarisrafi_about'] ?></p>
        </div>
    </div>
    <!-- ABOUT END -->

    <!-- CONTACT US -->
    <div class="b-example-divider" id="contact"></div>

    <div class="parallax-2">
    <div class="p-5 bg-none rounded-3 ">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold text-center text-white">Hubungi Kami</h1>
        </div>
        <div class="row align-items-md-stretch">
            <div class="col-md-6">
                <div class="h-100 p-5 text-white bg-dark rounded-3">
                    <h2>Punya Pertanyaan?</h2><br>
                    <form action="admin/faris_ajax.php?action=pertanyaan" method="post" class="form-group" id="form-pertanyaan">
                        <label for="">Nama Lengkap :</label>
                        <input type="text" name="mfarisrafi_nama" class="form-control" required><br>
                        <label for="">Email :</label>
                        <input type="email" name="mfarisrafi_email" class="form-control" required><br>
                        <label for="">Pertanyaan :</label>
                        <textarea name="mfarisrafi_pertanyaan" id="" cols="20" rows="3" class="form-control" required></textarea><br>
                        <button class="btn btn-outline-primary" type="submit">Submit</button>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="h-100 p-5 bg-light border rounded-3">
                    <h2>Kontak</h2><br>
                    <p>No. Telepon : +62 895271352</p><br>
                    <p>Email : Contact@Hotelhebat.com</p><br>
                    <p>Alamat : Mount Liar No. 875</p><br>
                    <a href="#"><i class="fa-brands fa-facebook display-6 text-dark"></i></a>
                    <a href="#"><i class="fa-brands fa-twitter display-6 text-dark"></i></a>
                    <a href="#"><i class="fa-brands fa-google-plus display-6 text-dark"></i></a>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- CONTACT US END -->