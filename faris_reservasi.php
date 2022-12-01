<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        session_start(); 
        include "admin/faris_connect.php";
        include "faris_head.php"; 
        
        if(!empty($_SESSION)){
            $mfarisrafi_name = $_SESSION['nama'];
            $mfarisrafi_email = $_SESSION['email'];
            $mfarisrafi_nik = $_SESSION['nik'];
        }
        

        $mfarisrafi_id = $_GET['id'];
        $mfarisrafi_cekIn = $_GET['in'];
        $mfarisrafi_cekOut = $_GET['out'];
        $mfarisrafi_jumlahKamar = $_GET['kamar'];

        $mfarisrafi_time = abs(strtotime($mfarisrafi_cekOut) - strtotime($mfarisrafi_cekIn));

        $mfarisrafi_years = floor($mfarisrafi_time / (365*60*60*24));
        $mfarisrafi_months = floor(($mfarisrafi_time - $mfarisrafi_years * 365*60*60*24) / (30*60*60*24));
        $mfarisrafi_days = floor(($mfarisrafi_time - $mfarisrafi_years * 365*60*60*24 - $mfarisrafi_months*30*60*60*24)/ (60*60*24));

    ?>
    <title>Reservasi</title>
</head>
<body>
    <!-- TOAST -->
    <div class="toast p-2" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body text-white">
        </div>
    </div>
    <!-- TOAST END -->
    <!-- LOADING -->
    <div id="loading" class="loading" style="margin-top: 200px;">
        <img id="loading" class="mx-auto d-block" src="assets/img/Double Ring.svg" alt="">
    </div>
    <!-- LOADING END -->
    <div class="content" id="content" style="display: none;">
    <nav class="navbar navbar-expand-lg navbar-light topbar">
        <a href="index.php" class="btn btn-sm btn-warning"><i class="fa-solid fa-left-long"></i> Kembali</a>
    </nav>
    
    <div class="row d-flex flex-row py-5 side">
        <div class="col-md-4">
            <div class="h-100 p-5 border rounded-3 shadow-lg offset-1">
                <div class="panel" style="border-bottom: 1px solid black">
                    <h2>Detail Ruangan</h2>
                </div><br>
                <?php
                    $mfarisrafi_kamar = mysqli_query($mfarisrafi_db_connect,"SELECT * FROM mfarisrafi_tipe_kamar WHERE mfarisrafi_id_tipe = '$mfarisrafi_id'");
                    while($mfarisrafi_row = mysqli_fetch_assoc($mfarisrafi_kamar)) :
                ?>
                <img src="assets/img/<?php echo $mfarisrafi_row['mfarisrafi_foto'] ?>" alt="" width="250"><br><br>
                <h6>Nama Kamar : <?php echo $mfarisrafi_row['mfarisrafi_tipe_kamar'] ?></h6>
                <h6>Harga : <?php echo 'Rp.' .number_format($mfarisrafi_row['mfarisrafi_harga'],2) ?></h6>
                <h6>Jumlah kamar : <?php echo $mfarisrafi_jumlahKamar ?></h6>
                <h6>Maksimal Tamu : <?php echo $mfarisrafi_row['mfarisrafi_maksimal_tamu'] * $mfarisrafi_jumlahKamar ?></h6>
                <h6>Check In : <?php echo $mfarisrafi_cekIn ?></h6>
                <h6>Check Out : <?php echo $mfarisrafi_cekOut ?></h6>
                <h6>Durasi : <?php echo $mfarisrafi_days ?> Hari</h6>
                <h6>Total : <?php $mfarisrafi_total = $mfarisrafi_row['mfarisrafi_harga'] * $mfarisrafi_days * $mfarisrafi_jumlahKamar; echo 'Rp.'.number_format($mfarisrafi_total,2) ?></h6>
                <?php endwhile; ?>
            </div>    
        </div>
    
        <?php
            $mfarisrafi_query = mysqli_query($mfarisrafi_db_connect,"SELECT max(mfarisrafi_kode_reservasi) as kodeterbesar FROM mfarisrafi_reservasi");
            $mfarisrafi_data = mysqli_fetch_array($mfarisrafi_query);
            $mfarisrafi_kode = $mfarisrafi_data['kodeterbesar'];
            $mfarisrafi_urutan = (int) substr($mfarisrafi_kode, 4, 4);
            $mfarisrafi_urutan++;
            $mfarisrafi_huruf = "RSV-";
            $mfarisrafi_kode = $mfarisrafi_huruf . sprintf('%03s', $mfarisrafi_urutan);
        ?>
        <div class="col-md-6">
            <div class="h-100 p-5 border rounded-3 shadow-lg">
                <div class="panel" style="border-bottom: 1px solid black">
                    <h2>Reservasi</h2>
                </div><br>
                <form action="admin/faris_ajax.php?action=reservasi" method="post" id="form_reserve">
                    <input type="hidden" name="mfarisrafi_id" id="id-tipe" value="<?php echo $mfarisrafi_kode ?>">
                    <div class="form-group">
                        <label for="">No Identitas</label>
                        <?php if(!empty($_SESSION)) : ?>
                        <input type="hidden" class="form-control" name="mfarisrafi_nik" id="nik-pemesan" value="<?php echo $mfarisrafi_nik ?>">
                        <input type="number" class="form-control" name="mfarisrafi_nik" id="nik-pemesan" value="<?php echo $mfarisrafi_nik ?>" disabled>
                        <?php else : ?>
                        <input type="number" class="form-control" name="mfarisrafi_nik" id="nik-pemesan">
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="">Nama Pemesan</label>
                        <?php if(!empty($_SESSION)) : ?>
                        <input type="text" class="form-control" name="mfarisrafi_nama" id="nama-pemesan" value="<?php echo $mfarisrafi_name ?>" placeholder="Masukan Nama Lengkap" required>
                        <?php else : ?>
                        <input type="text" class="form-control" name="mfarisrafi_nama" id="nama-pemesan" placeholder="Masukan Nama Lengkap" required>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <?php if(!empty($_SESSION)) : ?>
                        <input type="email" class="form-control" name="mfarisrafi_email" id="email-pemesan" value="<?php echo $mfarisrafi_email ?>" placeholder="Masukan Alamat Email" required>
                        <?php else : ?>
                        <input type="email" class="form-control" name="mfarisrafi_email" id="email-pemesan" placeholder="Masukan Alamat Email" required>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="">No Telepon</label>
                        <input type="number" class="form-control" name="mfarisrafi_notlp" id="tlp-pemesan" placeholder="Masukan No Telepon" oninput="javascript: if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxLength="13" required>
                    </div>
                    <div class="form-group">
                        <label for="">Jumlah Tamu</label>
                        <?php
                            $mfarisrafi_maks = mysqli_query($mfarisrafi_db_connect,"SELECT * FROM mfarisrafi_tipe_kamar WHERE mfarisrafi_id_tipe = '$mfarisrafi_id'");
                            while($mfarisrafi_max = mysqli_fetch_assoc($mfarisrafi_maks)):
                        ?>
                        <input type="number" class="form-control" name="mfarisrafi_tamu" id="jumlah-tamu" min="1" max="<?php echo $mfarisrafi_max['mfarisrafi_maksimal_tamu'] * $mfarisrafi_jumlahKamar ?>" placeholder="Masukan Jumlah Tamu" required>
                        <?php endwhile ?>
                    </div>
                    <div class="form-group">
                        <label for="">Pesan (Optional)</label>
                        <textarea class="form-control" name="mfarisrafi_pesan" id="" cols="30" rows="" placeholder="Masukan Pesan (Optional)"></textarea>
                    </div>
                    <input type="hidden" type="date" class="form-control" name="mfarisrafi_cekIn" id="check-in" value="<?php echo $mfarisrafi_cekIn ?>">
                    <input type="hidden" type="date" class="form-control" name="mfarisrafi_cekOut" id="check-Out" value="<?php echo $mfarisrafi_cekOut ?>">
                    <input type="hidden" class="form-control" name="mfarisrafi_jumlah_kamar" id="jumlah-kamar" value="<?php echo $mfarisrafi_jumlahKamar ?>" >
                    <select class="form-select" name="mfarisrafi_kamar" id="tipe-kamar" hidden>
                        <?php 
                            $mfarisrafi_tipe = mysqli_query($mfarisrafi_db_connect,"SELECT * FROM mfarisrafi_tipe_kamar WHERE mfarisrafi_id_tipe = '$mfarisrafi_id'");
                            while($mfarisrafi_row = mysqli_fetch_assoc($mfarisrafi_tipe)):
                        ?>
                        <option value="<?php echo $mfarisrafi_row['mfarisrafi_id_tipe'] ?>"><?php echo $mfarisrafi_row['mfarisrafi_tipe_kamar'] ?></option>
                        <?php endwhile; ?>
                        </select>
                    <?php
                        $mfarisrafi_kamar2 = mysqli_query($mfarisrafi_db_connect,"SELECT * FROM mfarisrafi_tipe_kamar WHERE mfarisrafi_id_tipe = '$mfarisrafi_id'");
                        while($mfarisrafi_row = mysqli_fetch_assoc($mfarisrafi_kamar2)) :
                    ?>
                    <input type="hidden" name="mfarisrafi_harga" id="harga-total" value="<?php $mfarisrafi_total = $mfarisrafi_row['mfarisrafi_harga'] * $mfarisrafi_days * $mfarisrafi_jumlahKamar; echo $mfarisrafi_total ?>"><br>
                    <?php endwhile; ?>
                    <?php if(!empty($_SESSION)) : ?>
                    <button class="btn btn-md btn-primary" type="submit">Pesan Kamar</button>
                    <?php else : ?>
                    <a class="btn btn-md btn-primary" href="faris_login.php">Pesan Kamar</a>
                    <?php endif ?>
                </form>
            </div>    
        </div>
    </div>
    </div>
    <script>
        window.alert_toast = function($msg = '',$bg = ''){
        if($bg == 'success')
            $('#alert_toast').addClass('bg-success')
        if($bg == 'danger')
            $('#alert_toast').addClass('bg-danger')
        if($bg == 'info')
            $('#alert_toast').addClass('bg-info')
        if($bg == 'warning')
            $('#alert_toast').addClass('bg-warning')
        $('#alert_toast .toast-body').html($msg)
        $('#alert_toast').toast({delay:3000}).toast('show');
        }  

            $('#form_reserve').on('submit', function(event){
                event.preventDefault();
            $.ajax({
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                data: $(this).serialize(),
                beforeSend:function(){
                    $('#loading').show();
                    $('#content').hide();
                },
                success:function(){
                    alert_toast("Reservasi Berhasil",'success')
					setTimeout(function(){
						location.href = 'index.php?page=faris_pesanan'
					},1000)
                }
            });
        })
        $(document).ready(function(){
            $('.loading').fadeOut('fast', function(){
                $('.content').fadeIn(500);
            });
        });
    </script>
</body>
</html>