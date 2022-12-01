<?php
    session_start();
    include "faris_connect.php";
    if(isset($_GET['id'])){
        $mfarisrafi_hotel = mysqli_query($mfarisrafi_db_connect,"SELECT * FROM mfarisrafi_fasilitas_hotel WHERE mfarisrafi_id_hotel = ".$_GET['id']);
        foreach($mfarisrafi_hotel->fetch_array() as $k =>$v){
            $meta[$k] = $v;
        }
    }
?>
<div class="container-fluid">
    <img src="assets/img/<?php echo $meta['mfarisrafi_foto'] ?>" width="220" alt="" class="offset-3 mb-5">
    <img src="../assets/img/<?php echo $meta['mfarisrafi_foto'] ?>" width="220" alt="" class="offset-3 mb-5">
    <p class="text-black offset-1">Nama : <?php echo $meta['mfarisrafi_nama_fasilitas'] ?></p>
    <p class="text-black offset-1">Deskripsi : <?php echo $meta['mfarisrafi_keterangan'] ?></p>
</div>
