<?php
    session_start();
    include "faris_connect.php";
    if($_SESSION == NULL){
        header("location:faris_login.php");
    }

    if(isset($_GET['email'])){
        $mfarisrafi_email = $_GET['email'];
        $mfarisrafi_tamu = mysqli_query($mfarisrafi_db_connect,"SELECT * FROM mfarisrafi_tamu WHERE mfarisrafi_email_tamu = '$mfarisrafi_email'");
        foreach($mfarisrafi_tamu->fetch_array() as $k =>$v){
            $meta[$k] = $v;
        }
    }

?>
    <div class="container-fluid">
        <form action="faris_ajax.php?action=ubah_tamu" method="post" id="form-tamu">
            <div class="form-group">
                <label for="">NIK</label>
                <input type="hidden" name="mfarisrafi_nik" class="form-control" value="<?php echo $meta['mfarisrafi_no_identitas'] ?>">
                <input type="number" name="mfarisrafi_nik" class="form-control" value="<?php echo $meta['mfarisrafi_no_identitas'] ?>" disabled>
            </div>
            <div class="form-group">
                <label for="">Nama Lengkap</label>
                <input type="text" name="mfarisrafi_nama" class="form-control" value="<?php echo $meta['mfarisrafi_nama_tamu'] ?>">
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="text" name="mfarisrafi_email" class="form-control" value="<?php echo $meta['mfarisrafi_email_tamu'] ?>">
            </div>
            <div class="form-group">
                <label for="">Username</label>
                <input type="text" name="mfarisrafi_username" class="form-control" value="<?php echo $meta['mfarisrafi_username'] ?>">
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="password" name="mfarisrafi_password" class="form-control" required>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id='submit'>Save</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>                                               
    </div>

    <script>
        $('#form-tamu').on('submit', function(event){
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
                    alert_toast("Data Berhasil Diedit",'success')
					setTimeout(function(){
						location.reload()
					},1000)
                    
                }
            });
        });
    </script>