<?php
    if($_SESSION == NULL){
        header("location:faris_login.php");
    }
?>
<div class="main-container">
    <div class="cards">
        <h2 style="color: black; border-bottom: 1px solid #8FC5E9;">Reservasi</h2>
    </div>
    <div class="row d-flex flex-row">
        <div class="col-md-8 mx-auto">
            <div class="h-100 p-5 border rounded-3 shadow-lg text-black">
                <div class="panel" style="border-bottom: 1px solid black">
                    <h2>Detail Kamar</h2>
                </div><br>
                <form action="index.php?page=faris_reservasi2" method="post" id="form-reservasi">
                    <div class="row justify-content-between text-left">
                    <div class="form-group col-sm-6 d-flex flex-column">
                        <label for="">Tipe Kamar</label>
                        <select name="mfarisrafi_kamars" id="tipe-kamar" class="form-select">
                            <?php 
                                $mfarisrafi_kamar = mysqli_query($mfarisrafi_db_connect,"SELECT * FROM mfarisrafi_tipe_kamar ORDER BY mfarisrafi_id_tipe");
                                while($mfarisrafi_row = mysqli_fetch_assoc($mfarisrafi_kamar)) :
                            ?>
                            <option value="<?php echo $mfarisrafi_row['mfarisrafi_id_tipe'] ?>"><?php echo $mfarisrafi_row['mfarisrafi_tipe_kamar'] ?></option>
                            <?php endwhile ?>
                        </select>
                    </div>
                    <div class="form-group col-sm-6 d-flex flex-column">
                        <label for="">Jumlah Kamar</label>
                        <input type="number" class="form-control" name="mfarisrafi_jumlah_kamars" id="jumlah-kamar" placeholder="Masukan Jumlah Kamar" autocomplete="off" required>
                    </div>
                    <div class="form-group col-sm-6 d-flex flex-column">
                        <label for="">Check-In</label>
                        <input type="text" class="form-control" name="mfarisrafi_cekIns" id="check-in" placeholder="TT/BB/HH" autocomplete="off" required>
                    </div>
                    <div class="form-group col-sm-6 d-flex flex-column">
                        <label for="">Check-Out</label>
                        <input type="text" class="form-control" name="mfarisrafi_cekOuts" id="check-out" placeholder="TT/BB/HH" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="">Pesan (Optional)</label>
                        <textarea class="form-control" name="mfarisrafi_pesans" id="pesan" cols="30" rows="3" placeholder="Masukan Pesan (Optional)" autocomplete="off"></textarea>
                    </div>
                    </div><br>
                    <button type="submit" class="btn btn-sm btn-primary col-md-12" name="mfarisrafi_submitKamar">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $('#check-in').datepicker({
        inline: true,
        changeMonth: true, 
        changeYear: true, 
        dateFormat: 'yy-mm-dd',
        minDate: 0,
    });
    $('#check-out').datepicker({
        inline: true,
        changeMonth: true, 
        changeYear: true, 
        dateFormat: 'yy-mm-dd',
        minDate: 1,
    });
</script>