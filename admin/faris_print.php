<?php
session_start();
include "faris_connect.php";
include "faris_head.php";
$mfarisrafi_date = date("Y-m-d");
    if($_SESSION == NULL){
        header("location:faris_login.php");
    }
?>
<div class="main-container">
    <div class="cards text-center">
        <h1 class="text-danger text-center">Hebat Hotel</h1>
        <span class="text-black text-center">Tanggal : <?php echo $mfarisrafi_date ?>, Alamat : Mount Liar No. 875</span>
        <p class="text-black text-center" style="border-bottom: 2px solid black">Telp : +62 895271352 , Email : hotelhebat@hebathotel.com</p>
    </div>
    <div class="container-fluid">
        <h3 class="text-center">LAPORAN PEMBAYARAN</h3>
        <div class="card col-lg-12">
            <div class="card">
                <div class="card-body row d-flex flex-row g-1">
                    <table class="table table-striped table-bordered table-hover" id="table-laporan">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Kode Reservasi</th>
                                <th class="text-center">Tipe Kamar</th>
                                <th class="text-center">Jumlah Kamar</th>
                                <th class="text-center">Tanggal Check In</th>
                                <th class="text-center">Tanggal Check Out</th>
                                <th class="text-center">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $mfarisrafi_no = 1;
                                $mfarisrafi_tipekamar = mysqli_query($mfarisrafi_db_connect,"SELECT * FROM mfarisrafi_tipe_kamar");
                                while($mfarisrafi_row = mysqli_fetch_array($mfarisrafi_tipekamar)){
                                    $mfarisrafi_nama[$mfarisrafi_row['mfarisrafi_id_tipe']] = $mfarisrafi_row['mfarisrafi_tipe_kamar'];
                                }
                                $mfarisrafi_cekIn = mysqli_query($mfarisrafi_db_connect,"SELECT distinct(mfarisrafi_kode_reservasi),mfarisrafi_id_tipe,mfarisrafi_check_in,mfarisrafi_check_out,mfarisrafi_jumlah_kamar,mfarisrafi_total FROM mfarisrafi_reservasi WHERE mfarisrafi_status = 'Checked Out' ORDER BY mfarisrafi_kode_reservasi DESC"); 
                                while($mfarisrafi_row = mysqli_fetch_assoc($mfarisrafi_cekIn)) :
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $mfarisrafi_no++ ?></td>
                                <td class="text-center"><?php echo $mfarisrafi_row['mfarisrafi_kode_reservasi'] ?></td>
                                <td class="text-center"><?php echo $mfarisrafi_nama[$mfarisrafi_row['mfarisrafi_id_tipe']] ?></td>
                                <td class="text-center"><?php echo $mfarisrafi_row['mfarisrafi_jumlah_kamar'] ?></td>
                                <td class="text-center"><?php echo $mfarisrafi_row['mfarisrafi_check_in'] ?></td>
                                <td class="text-center"><?php echo $mfarisrafi_row['mfarisrafi_check_out'] ?></td>
                                <td class="text-center"><?php echo 'Rp.' .number_format($mfarisrafi_row['mfarisrafi_total'],2) ?></td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                    <div class="row d-flex row-flex justify-content-between text-left">
                        <div class="col-sm-12">
                            <span class="text-center offset-1">Dicetak Oleh </span>
                            <span class="text-center offset-6">Penanggung Jawab </span>
                        </div> 
                    </div>
                    <div class="row d-flex row-flex text-left mt-5">
                            <hr style="border-top: 2px solid black; width: 20%;" class="offset-1"></hr>
                            <hr style="border-top: 2px solid black; width: 25%;" class="offset-5"></hr>
                        
                    </div>
                                      
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
<script>
    window.print();
</script>