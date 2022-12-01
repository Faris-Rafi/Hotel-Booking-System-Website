<?php include "faris_connect.php" ?>
<?php
    session_start();
    if($_SESSION == NULL){
        header("location:faris_login.php");
    }
?>
    <div class="container-fluid">
        <form action="faris_ajax.php?action=save_fasilitasKamar" method="post" id="manage_fasilitasKamar" class="form-group">
            <label for="" class="text-black">Tipe Kamar</label>
            <select name="mfarisrafi_id_tipe" id="tipe-kamar" class="form-select">
                <?php
                    $mfarisrafi_tipe = mysqli_query($mfarisrafi_db_connect,"SELECT * FROM mfarisrafi_tipe_kamar order by mfarisrafi_id_tipe");
                    while($mfarisrafi_row = mysqli_fetch_assoc($mfarisrafi_tipe)) :
                ?>
                <option value="<?php echo $mfarisrafi_row['mfarisrafi_id_tipe'] ?>"><?php echo $mfarisrafi_row['mfarisrafi_tipe_kamar'] ?></option>
                <?php endwhile; ?>
            </select>
            <label for="" class="text-black">Fasilitas</label>
            <textarea name="mfarisrafi_fasilitas_tipe" id="fasilitas-tipe" class="form-control" placeholder="Masukkan Fasilitas" rows="3"></textarea>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id='submit'>Save</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>

<script>
    $(document).ready(function() {
        $('#manage_fasilitasKamar').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                data:  $(this).serialize(),
                beforeSend:function(){
                    $('.content').hide()
                    $('.loading').show()
                },
                success:function(){
                    $('#form_modal').modal('hide')
                    alert_toast("Data Berhasil Ditambah",'success')
					setTimeout(function(){
						location.reload()
					},1000)
                    
                }
            });
        })
    });
</script>