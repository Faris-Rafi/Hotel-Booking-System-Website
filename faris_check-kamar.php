
    <?php
        include "admin/faris_connect.php";
        include "faris_head.php";
        
        $mfarisrafi_cekIn = $_POST['mfarisrafi_cek_in'];
        $mfarisrafi_cekOut = $_POST['mfarisrafi_cek_out'];
        $mfarisrafi_jumlahKamar = $_POST['mfarisrafi_jumlah_kamar'];
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
                <img class="bd-placeholder-img" src="assets/img/image1-slideshow.jpg" width="100%" height="600px">

                <div class="container">
                    <div class="carousel-caption">
                        <h1>Hotel Hebat</h1>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="bd-placeholder-img" src="assets/img/image2-slideshow.jpg" width="100%" height="600px">

                <div class="container">
                    <div class="carousel-caption">
                        <h1>Hotel Hebat</h1>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="bd-placeholder-img" src="assets/img/image3-slideshow.jpg" width="100%" height="600px">

                <div class="container">
                    <div class="carousel-caption">
                        <h1>Hotel Hebat</h1>
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
    <div class="py-4 text-center reserved" style="overflow-x: hidden;">
        <form action="index.php?page=faris_check-kamar#rooms" method="post" class="row align-items-center offset-2">
            <div class="col-auto text-white">
                <label for="">Check-In</label>
                <input type="text" name="mfarisrafi_cek_in" id="check-in" autocomplete="off" placeholder="TT/BB/HH" class="form-control" value="<?php echo $mfarisrafi_cekIn ?>">
            </div>
            <div class="col-auto text-white">
                <label for="">Check-Out</label>
                <input type="text" name="mfarisrafi_cek_out" id="check-out" autocomplete="off" placeholder="TT/BB/HH" class="form-control" value="<?php echo $mfarisrafi_cekOut ?>">
            </div>
            <div class="col-auto text-white">
                <label for="">Jumlah Kamar</label>
                <input type="number" name="mfarisrafi_jumlah_kamar" id="jumlah-kamar" class="form-control" placeholder="Masukkan Jumlah Kamar" value="<?php echo $mfarisrafi_jumlahKamar ?>">
            </div>
            <div class="col-auto text-white">
                <button class="btn btn-primary mt-4">Cek Ketersediaan</button>
            </div>
        </form>
    </div>
    <!-- RESERVATION BUTTON END -->

    <!-- ROOMS FACILITY -->
    <div class="b-example-divider" id="rooms"></div>

    <div class="py-4 text-center">
        <h1 class="display-6 fw-bold">Ruangan Yang Tersedia</h1>
    </div>
    <?php
    $mfarisrafi_tipe = mysqli_query($mfarisrafi_db_connect,"SELECT * FROM mfarisrafi_tipe_kamar");
    $mfarisrafi_array = array();
    while($mfarisrafi_row = mysqli_fetch_assoc($mfarisrafi_tipe)){
        $mfarisrafi_array[$mfarisrafi_row['mfarisrafi_id_tipe']] = $mfarisrafi_row;
    }
    $mfarisrafi_kamar = mysqli_query($mfarisrafi_db_connect,"SELECT distinct(mfarisrafi_id_tipe),mfarisrafi_id_tipe from mfarisrafi_kamar where mfarisrafi_status = 'Tersedia' ");
    while($mfarisrafi_row = mysqli_fetch_assoc($mfarisrafi_kamar)):

    ?>
    <div class="b-example-divider"></div>

    <div class="container col-sm-10 px-4 py-5">
        <div class="row flex-lg-row-reverse align-items-center g-5 py-2">
            <div class="col-10 col-sm-8 col-lg-6">
                <img src="assets/img/<?php echo $mfarisrafi_array[$mfarisrafi_row['mfarisrafi_id_tipe']]['mfarisrafi_foto']; ?>" class="d-block mx-lg-auto img-fluid" width="400" height="100">
            </div>
            <div class="col-lg-6">
                <h1 class="display-5 fw-bold lh-1 mb-3"><?php echo $mfarisrafi_array[$mfarisrafi_row['mfarisrafi_id_tipe']]['mfarisrafi_tipe_kamar']; ?></h1>
                <p class="lead"><?php echo $mfarisrafi_array[$mfarisrafi_row['mfarisrafi_id_tipe']]['mfarisrafi_deskripsi']; ?></p>
                <p class="lead text-success"><?php echo 'Rp.'.number_format($mfarisrafi_array[$mfarisrafi_row['mfarisrafi_id_tipe']]['mfarisrafi_harga'],2) ?> / Hari</p>
                <?php
                    $ids = $mfarisrafi_row['mfarisrafi_id_tipe'];
                    $mfarisrafi_status1 = mysqli_query($mfarisrafi_db_connect,"SELECT * FROM mfarisrafi_kamar WHERE mfarisrafi_id_tipe = '$ids' AND mfarisrafi_status = 'Tersedia'");
                    $mfarisrafi_stats1 = mysqli_num_rows($mfarisrafi_status1)
                ?>
                <?php if($mfarisrafi_stats1 <= 5): ?>
                <p class="text-danger"><?php echo $mfarisrafi_stats1 ?> Kamar Tersedia</p>
                <?php else : ?>
                <p class="text-success"><?php echo $mfarisrafi_stats1 ?> Kamar Tersedia</p>
                <?php endif; ?>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start">
                    <a href="javascript:void(0)" class="btn btn-outline-secondary btn-lg px-4 me-md-2 lihat-kamar" id="lihat-kamar" data-bs-id="<?php echo $mfarisrafi_row['mfarisrafi_id_tipe'] ?>">Lihat Selengkapnya</a>
                    <?php if($mfarisrafi_jumlahKamar > $mfarisrafi_stats1) : ?>
                    <button class="btn btn-primary btn-lg px-4" disabled>Pesan</button>
                    <?php else : ?>
                    <a href="faris_reservasi.php?id=<?php echo $mfarisrafi_row['mfarisrafi_id_tipe'] ?>&in=<?php echo $mfarisrafi_cekIn ?>&out=<?php echo $mfarisrafi_cekOut ?>&kamar=<?php echo $mfarisrafi_jumlahKamar ?>" class="btn btn-primary btn-lg px-4">Pesan</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php endwhile; ?>

    <!-- ROOMS FACILITY END -->

</body>
</html>