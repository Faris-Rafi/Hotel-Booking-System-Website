<?php
    session_start();
    include "faris_connect.php";
    if($_SESSION == NULL){
        header("location:faris_login.php");
    }
    if(isset($_GET['id'])){
        $mfarisrafi_id_tipe2 = mysqli_query($mfarisrafi_db_connect,"SELECT * FROM mfarisrafi_tipe_kamar");
        while($mfarisrafi_row3 = mysqli_fetch_assoc($mfarisrafi_id_tipe2)){
            $mfarisrafi_nama2[$mfarisrafi_row3['mfarisrafi_id_tipe']] = $mfarisrafi_row3['mfarisrafi_tipe_kamar'];
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
                    <td><?php echo $mfarisrafi_nama2[$meta['mfarisrafi_id_tipe']] ?></td>
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
                    <td><b>Sisa Pembayaran</b></td>
                    <td><?php echo 'Rp.'.number_format($meta['mfarisrafi_sisa_pembayaran'],2,",",".") ?></td>
                </tr>
                <tr>
                    <td><b>Kembalian</b></td>
                    <td><?php echo 'Rp.'.number_format($meta['mfarisrafi_kembalian'],2,",",".") ?></td>
                </tr>
            </tbody>
        </table>
        <form action="faris_ajax.php?action=check_out" method="post" id="check-out">
            <input type="hidden" class="form-control" name="mfarisrafi_id" value="<?php echo $meta['mfarisrafi_id_reservasi'] ?>">
            <?php 
                $mfarisrafi_kamar2 = mysqli_query($mfarisrafi_db_connect,"SELECT * FROM mfarisrafi_reserved_room WHERE mfarisrafi_id_reservasi = ".$_GET['id']); 
                while($mfarisrafi_no_kamar = mysqli_fetch_assoc($mfarisrafi_kamar2)) :
            ?>
            <input type="hidden" class="form-control" name="mfarisrafi_kamar" value="<?php echo $mfarisrafi_no_kamar['mfarisrafi_no_kamar'] ?>">
            <?php endwhile; ?>
            <div class="form-group">
                <label for="">Sisa Pembayaran</label>
                <input type="number" name="mfarisrafi_pembayaran" class="form-control" placeholder="Masukkan Sisa Pembayaran" min="<?php echo $meta['mfarisrafi_sisa_pembayaran'] ?>" max="<?php echo $meta['mfarisrafi_sisa_pembayaran'] ?>" required>
            </div>
            <div class="form-group">
                <label for="">Kembalian</label>
                <input type="number" class="form-control" name="mfarisrafi_kembalian" placeholder="Masukkan Kembalian" min="<?php echo $meta['mfarisrafi_kembalian'] ?>" max="<?php echo $meta['mfarisrafi_kembalian'] ?>" required>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id='submit'>Save</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
    <script>
        $('#check-out').on('submit', function(event){
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
                    alert_toast("Check Out Berhasil",'danger')
					setTimeout(function(){
						location.reload()
					},1000)
                    
                }
            });
        })
    </script>