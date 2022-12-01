<?php
    session_start();
    include "faris_connect.php";
    if($_SESSION == NULL){
        header("location:faris_login.php");
    }

    $percent = 10/100;
    if(isset($_GET['id'])){
        $mfarisrafi_id_tipe = mysqli_query($mfarisrafi_db_connect,"SELECT * FROM mfarisrafi_tipe_kamar");
        while($mfarisrafi_row2 = mysqli_fetch_assoc($mfarisrafi_id_tipe)){
            $mfarisrafi_nama[$mfarisrafi_row2['mfarisrafi_id_tipe']] = $mfarisrafi_row2['mfarisrafi_tipe_kamar'];
        }
        $mfarisrafi_tipe = mysqli_query($mfarisrafi_db_connect,"SELECT * FROM mfarisrafi_reservasi WHERE mfarisrafi_id_reservasi = ".$_GET['id']);
        foreach($mfarisrafi_tipe->fetch_array() as $k =>$v){
            $meta[$k] = $v;
        }
    }
?>
    <div class="container-fluid">
        <table class="table table-responsive table-bordered">
            <tbody>
                <tr>
                    <td><b>Nama Pemesan</b></td>
                    <td><?php echo $meta['mfarisrafi_nama_pemesan'] ?></td>
                </tr>
                <tr>
                    <td><b>Tipe Kamar</b></td>
                    <td><?php echo $mfarisrafi_nama[$meta['mfarisrafi_id_tipe']] ?></td>
                </tr>
                <tr>
                    <td><b>Check-In</b></td>
                    <td><?php echo $meta['mfarisrafi_check_in'] ?></td>
                </tr>
                <tr>
                    <td><b>Check-Out</b></td>
                    <td><?php echo $meta['mfarisrafi_check_out'] ?></td>
                </tr>
                <tr>
                    <td><b>Jumlah Kamar</b></td>
                    <td><?php echo $meta['mfarisrafi_jumlah_kamar'] ?></td>
                </tr>
                <tr>
                    <td><b>Total</b></td>
                    <td><?php echo 'Rp.'.number_format($meta['mfarisrafi_total'],2,",",".") ?></td>
                </tr>
                <tr>
                    <td><b>Down Payment</b></td>
                    <td><?php echo 'Rp.'.number_format($meta['mfarisrafi_total'] * $percent,2,",",".") ?></td>
                </tr>
            </tbody>
        </table>
        <form action="faris_ajax.php?action=check_in" method="post" id="check-in">
            <input type="hidden" class="form-control" name="mfarisrafi_id" value="<?php echo $meta['mfarisrafi_id_reservasi'] ?>">
            <input type="hidden" class="form-control" name="mfarisrafi_kode_rsv" value="<?php echo $meta['mfarisrafi_kode_reservasi'] ?>">
            <input type="hidden" name="mfarisrafi_total" value="<?php echo $meta['mfarisrafi_total'] ?>">
            <div class="form-group">
                <label for="" class="text-black">No Kamar</label>
                <select name="mfarisrafi_kamar" id="no-kamar" class="form-select">
                    <?php
                        $mfarisrafi_idtipe = $mfarisrafi_row_info['mfarisrafi_id_tipe'];
                        $mfarisrafi_kamar = mysqli_query($mfarisrafi_db_connect,"SELECT * FROM mfarisrafi_kamar WHERE mfarisrafi_id_tipe = ".$meta['mfarisrafi_id_tipe']." and mfarisrafi_status = 'Tersedia' ORDER BY mfarisrafi_no_kamar");
                        while($mfarisrafi_no_kamar = mysqli_fetch_assoc($mfarisrafi_kamar)) :
                    ?>
                    <option value="<?php echo $mfarisrafi_no_kamar['mfarisrafi_no_kamar'] ?>"><?php echo $mfarisrafi_no_kamar['mfarisrafi_no_kamar'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Pembayaran</label>
                <input type="number" min="<?php echo $meta['mfarisrafi_total'] * $percent ?>" class="form-control" name="mfarisrafi_pembayaran" placeholder="Masukkan Pembayaran" required>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id='submit'>Save</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
    <script>
        $('#check-in').on('submit', function(event){
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
                    $('#form_modal').modal('hide')
                    alert_toast("Check In Berhasil",'success')
					setTimeout(function(){
						location.reload()
					},1000)
                    
                }
            });
        })
    </script>