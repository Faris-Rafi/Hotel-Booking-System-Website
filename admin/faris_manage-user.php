<?php
    session_start();
    include "faris_connect.php";
    if($_SESSION == NULL){
        header("location:faris_login.php");
    }
    if(isset($_GET['id'])){
        $mfarisrafi_user = mysqli_query($mfarisrafi_db_connect,"SELECT * FROM mfarisrafi_user WHERE mfarisrafi_id_user = ".$_GET['id']);
        foreach($mfarisrafi_user->fetch_array() as $k =>$v){
            $meta[$k] = $v;
        }
    }
?>
    <div class="container-fluid">
        <form action="faris_ajax.php?action=save_user" method="post" id="manage_user" class="form-group">
            <input type="hidden" name="mfarisrafi_id" id="id-user" value="<?php echo isset($meta['mfarisrafi_id_user']) ? $meta['mfarisrafi_id_user']: '' ?>">
            <div class="form-group">
                <label for="">Nama Lengkap</label>
                <input type="text" name="mfarisrafi_nama_user" id="nama-user" class="form-control" placeholder="Masukkan Nama Lengkap" value="<?php echo isset($meta['mfarisrafi_nama_user']) ? $meta['mfarisrafi_nama_user']: '' ?>">
            </div>
            <div class="form-group">
                <label for="">Role User</label>
                <select name="mfarisrafi_role" id="role-user" class="form-select">
                    <?php 
                        $mfarisrafi_role = mysqli_query($mfarisrafi_db_connect,"SELECT * FROM mfarisrafi_role ORDER BY mfarisrafi_id_role");
                        while($mfarisrafi_row = mysqli_fetch_assoc($mfarisrafi_role)):
                    ?>
                    <option value="<?php echo $mfarisrafi_row['mfarisrafi_id_role'] ?>"><?php echo $mfarisrafi_row['mfarisrafi_jenis_role'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Email User</label>
                <input type="email" name="mfarisrafi_email_user" id="email_user" class="form-control" placeholder="Masukkan Email" value="<?php echo isset($meta['mfarisrafi_email_user']) ? $meta['mfarisrafi_email_user']: '' ?>">
            </div>
            <div class="form-group">
                <label for="">Username</label>
                <input type="text" class="form-control" name="mfarisrafi_username" id="username" placeholder="Masukkan Username" value="<?php echo isset($meta['mfarisrafi_username_user']) ? $meta['mfarisrafi_username_user']: '' ?>">
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="password" class="form-control" name="mfarisrafi_password" id="password" placeholder="Masukkan Password" required>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id='submit'>Save</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>
<script>
     $(document).ready(function() {
        $('#manage_user').on('submit', function(event){
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
                    alert_toast("Data Berhasil Ditambah",'success')
					setTimeout(function(){
						location.reload()
					},1000)
                    
                }
            });
        })
    });
</script>