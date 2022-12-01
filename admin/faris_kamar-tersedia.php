<div class="main-container">
            <div class="cards">
                <h2 style="color: black; border-bottom: 1px solid #8FC5E9;">Kamar Yang Tersedia</h2>
            </div>
            <div class="row d-flex flex-row align-items-md mt-5 mx-auto">
            <?php
                $mfarisrafi_tipe = mysqli_query($mfarisrafi_db_connect,"SELECT * FROM mfarisrafi_tipe_kamar");
                $mfarisrafi_array = array();
                while($mfarisrafi_row = mysqli_fetch_assoc($mfarisrafi_tipe)){
                    $mfarisrafi_array[$mfarisrafi_row['mfarisrafi_id_tipe']] = $mfarisrafi_row;
                }
                $mfarisrafi_kamar = mysqli_query($mfarisrafi_db_connect,"SELECT distinct(mfarisrafi_id_tipe),mfarisrafi_id_tipe from mfarisrafi_kamar where mfarisrafi_status = 'Tersedia' ");
                while($mfarisrafi_row = mysqli_fetch_assoc($mfarisrafi_kamar)):

            ?>
                <div class="col-md-6 mb-4">
                    <div class="h-100 p-2 shadow-lg bg-light border rounded-3">
                        <img src="../assets/img/<?php echo $mfarisrafi_array[$mfarisrafi_row['mfarisrafi_id_tipe']]['mfarisrafi_foto']; ?>" class="d-block mx-lg-auto img-fluid mt-4" width="200" height="100">
                        <h2 class="fw-bold mb-3 text-center text-black"><?php echo $mfarisrafi_array[$mfarisrafi_row['mfarisrafi_id_tipe']]['mfarisrafi_tipe_kamar']; ?></h2>
                        <p class="text-center text-black"><?php echo $mfarisrafi_array[$mfarisrafi_row['mfarisrafi_id_tipe']]['mfarisrafi_fasilitas']; ?></p>
                        <?php
                            $ids = $mfarisrafi_row['mfarisrafi_id_tipe'];
                            $mfarisrafi_status1 = mysqli_query($mfarisrafi_db_connect,"SELECT * FROM mfarisrafi_kamar WHERE mfarisrafi_id_tipe = '$ids' AND mfarisrafi_status = 'Tersedia'");
                            $mfarisrafi_stats1 = mysqli_num_rows($mfarisrafi_status1)
                        ?>
                        <?php if($mfarisrafi_stats1 <= 5): ?>
                        <p class="text-danger text-center"><?php echo $mfarisrafi_stats1 ?> Kamar Tersedia</p>
                        <?php else : ?>
                        <p class="text-success text-center"><?php echo $mfarisrafi_stats1 ?> Kamar Tersedia</p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>
            </div>
        </div>
        </div>
    </div>
</div>