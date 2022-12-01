<?php
    session_start();
    include "faris_connect.php";
    if(isset($_GET['id'])){
        $mfarisrafi_tipe = mysqli_query($mfarisrafi_db_connect,"SELECT * FROM mfarisrafi_tipe_kamar WHERE mfarisrafi_id_tipe = ".$_GET['id']);
        foreach($mfarisrafi_tipe->fetch_array() as $k =>$v){
            $meta[$k] = $v;
        }
    }
?>
<div class="container-fluid">
    <img src="assets/img/<?php echo $meta['mfarisrafi_foto'] ?>" width="220" alt="" class="offset-3 mb-5">
    <img src="../assets/img/<?php echo $meta['mfarisrafi_foto'] ?>" width="220" alt="" class="offset-3 mb-5">
    <p class="text-black offset-1">Nama : <?php echo $meta['mfarisrafi_tipe_kamar'] ?></p>
    <p class="text-black offset-1">Fasilitas : <?php echo $meta['mfarisrafi_fasilitas'] ?></p>
    <p class="text-black offset-1">Deskripsi : <?php echo $meta['mfarisrafi_deskripsi'] ?></p>
    <p class="text-black offset-1">Jumlah Kamar : <?php echo $meta['mfarisrafi_jumlah_bed'] ?></p>
    <?php
        $mfarisrafi_status = mysqli_query($mfarisrafi_db_connect,"SELECT * FROM mfarisrafi_kamar WHERE mfarisrafi_id_tipe = ".$_GET['id']." AND mfarisrafi_status = 'Tersedia'");
        $mfarisrafi_stats = mysqli_num_rows($mfarisrafi_status)
    ?>
    <?php if($mfarisrafi_stats <= 5): ?>
    <p class="text-danger offset-1">Status : <?php echo $mfarisrafi_stats ?> Kamar Tersedia</p>
    <?php else : ?>
    <p class="text-success offset-1">Status : <?php echo $mfarisrafi_stats ?> Kamar Tersedia</p>
    <?php endif; ?>
    <p class="text-black offset-1">Harga Kamar : <?php echo "Rp.".number_format($meta['mfarisrafi_harga'],2) ?></p>
</div>