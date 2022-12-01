<?php
    if($_SESSION == NULL){
        header("location:faris_login.php");
    }

    $mfarisrafi_kamars = $_POST['mfarisrafi_kamars'];
    $mfarisrafi_jumlah_kamars = $_POST['mfarisrafi_jumlah_kamars'];
    $mfarisrafi_cekIns = $_POST['mfarisrafi_cekIns'];
    $mfarisrafi_cekOuts = $_POST['mfarisrafi_cekOuts'];
    $mfarisrafi_pesans = $_POST['mfarisrafi_pesans'];

    $mfarisrafi_time = abs(strtotime($mfarisrafi_cekOuts) - strtotime($mfarisrafi_cekIns));

    $mfarisrafi_years = floor($mfarisrafi_time / (365*60*60*24));
    $mfarisrafi_months = floor(($mfarisrafi_time - $mfarisrafi_years * 365*60*60*24) / (30*60*60*24));
    $mfarisrafi_days = floor(($mfarisrafi_time - $mfarisrafi_years * 365*60*60*24 - $mfarisrafi_months*30*60*60*24)/ (60*60*24));

    $mfarisrafi_query = mysqli_query($mfarisrafi_db_connect,"SELECT max(mfarisrafi_kode_reservasi) as kodeterbesar FROM mfarisrafi_reservasi");
    $mfarisrafi_data = mysqli_fetch_array($mfarisrafi_query);
    $mfarisrafi_kode = $mfarisrafi_data['kodeterbesar'];
    $mfarisrafi_urutan = (int) substr($mfarisrafi_kode, 4, 4);
    $mfarisrafi_urutan++;
    $mfarisrafi_huruf = "RSV-";
    $mfarisrafi_kode = $mfarisrafi_huruf . sprintf('%03s', $mfarisrafi_urutan);
?>
<div class="main-container">
    <div class="cards">
        <h2 style="color: black; border-bottom: 1px solid #8FC5E9;">Reservasi</h2>
    </div>
    <div class="row d-flex flex-row">
        <div class="col-md-6">
            <div class="h-100 p-5 border rounded-3 shadow-lg text-black">
                <div class="panel" style="border-bottom: 1px solid black">
                    <h2>Detail Ruangan</h2>
                </div><br>
                <?php
                    $mfarisrafi_kamar = mysqli_query($mfarisrafi_db_connect,"SELECT * FROM mfarisrafi_tipe_kamar WHERE mfarisrafi_id_tipe = '$mfarisrafi_kamars'");
                    while($mfarisrafi_row = mysqli_fetch_assoc($mfarisrafi_kamar)) :
                ?>
                <img src="../assets/img/<?php echo $mfarisrafi_row['mfarisrafi_foto'] ?>" alt="" width="250"><br><br>
                <h6>Nama Kamar : <?php echo $mfarisrafi_row['mfarisrafi_tipe_kamar'] ?></h6>
                <h6>Harga : <?php echo 'Rp.' .number_format($mfarisrafi_row['mfarisrafi_harga'],2) ?></h6>
                <h6>Jumlah kamar : <?php echo $mfarisrafi_jumlah_kamars ?></h6>
                <h6>Maksimal Tamu : <?php echo $mfarisrafi_row['mfarisrafi_maksimal_tamu'] * $mfarisrafi_jumlah_kamars ?></h6>
                <h6>Check In : <?php echo $mfarisrafi_cekIns ?></h6>
                <h6>Check Out : <?php echo $mfarisrafi_cekOuts ?></h6>
                <h6>Durasi : <?php echo $mfarisrafi_days ?> Hari</h6>
                <h6>Total : <?php $mfarisrafi_total = $mfarisrafi_row['mfarisrafi_harga'] * $mfarisrafi_days * $mfarisrafi_jumlah_kamars; echo 'Rp.'.number_format($mfarisrafi_total,2) ?></h6>
                <?php endwhile; ?>
            </div>    
        </div>
        <div class="col-md-6">
            <div class="h-100 p-5 border rounded-3 shadow-lg text-black">
                <div class="panel" style="border-bottom: 1px solid black">
                    <h2>Data Diri</h2>
                </div><br>
                <form action="faris_ajax.php?action=reservasi_rsp" method="post" id="form-reservasi">
                    <input type="hidden" name="mfarisrafi_ids" id="rsv_kode" value="<?php echo $mfarisrafi_kode ?>">
                    <input type="date" class="form-control" name="mfarisrafi_cekIns" id="check-in" value="<?php echo $mfarisrafi_cekIns ?>" hidden>
                    <input type="date" class="form-control" name="mfarisrafi_cekOuts" id="check-Out" value="<?php echo $mfarisrafi_cekOuts ?>" hidden>
                    <input type="hidden" name="mfarisrafi_jumlah_kamars" id="jumlah-kamar" value="<?php echo $mfarisrafi_jumlah_kamars ?>">
                    <input type="hidden" name="mfarisrafi_kamars" id="tipe-kamar" value="<?php echo $mfarisrafi_kamars ?>">
                    <textarea name="mfarisrafi_pesans" id="" cols="30" rows="" placeholder="Masukan Pesan (Optional)" hidden><?php echo $mfarisrafi_pesans ?></textarea>
                    <div class="row justify-content-between text-left">
                    <div class="form-group">
                        <label for="">No Identitas</label>
                        <input type="number" class="form-control" name="mfarisrafi_niks" id="nik-pemesan" placeholder="Masukan No Identitas" autocomplete="off" oninput="javascript: if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxLength="16" required>
                    </div>
                    <div class="form-group">
                        <label for="">Nama Pemesan</label>
                        <input type="text" class="form-control" name="mfarisrafi_namas" id="nama-pemesan" placeholder="Masukan Nama Pemesan" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="">Email Pemesan</label>
                        <input type="email" class="form-control" name="mfarisrafi_emails" id="email-pemesan" placeholder="Masukan Email Pemesan" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="">No Telepon</label>
                        <input type="number" class="form-control" name="mfarisrafi_notlps" id="notlp-pemesan" placeholder="Masukan No Telepon" autocomplete="off" oninput="javascript: if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxLength="13" required>
                    </div>
                    <div class="form-group">
                        <label for="">Jumlah Tamu</label>
                        <?php
                            $mfarisrafi_maks = mysqli_query($mfarisrafi_db_connect,"SELECT * FROM mfarisrafi_tipe_kamar WHERE mfarisrafi_id_tipe = '$mfarisrafi_kamars'");
                            while($mfarisrafi_max = mysqli_fetch_assoc($mfarisrafi_maks)):
                        ?>
                        <input type="number" class="form-control" name="mfarisrafi_tamus" id="jumlah-tamu" min="1" max="<?php echo $mfarisrafi_max['mfarisrafi_maksimal_tamu'] * $mfarisrafi_jumlah_kamars ?>" placeholder="Masukan Jumlah Tamu" required>
                        <?php endwhile ?>
                    </div>
                    </div><br>
                    <button type="submit" class="btn btn-sm btn-primary col-md-12" name="mfarisrafi_submitKamar">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
        $('#form-reservasi').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                data: $(this).serialize(),
                beforeSend:function(){
                    $('.content').hide()
                    $('.loading').show()
                },
                success:function(){
                    alert_toast("Reservasi Berhasil",'success')
					setTimeout(function(){
						location.href = 'index.php?page=faris_check-in'
					},1000)
                    
                }
            });
        })
</script>