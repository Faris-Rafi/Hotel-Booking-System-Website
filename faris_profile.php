<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Hebat</title>
    <?php
        session_start();
        include "admin/faris_connect.php";
        include "faris_head.php";

        $mfarisrafi_nama = $_SESSION['nama'];
        $mfarisrafi_email = $_SESSION['email'];
    ?>
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
        <a href="index.php?page=faris_home" class="btn btn-sm btn-warning"><i class="fa-solid fa-left-long"></i> Kembali</a>
    </nav>
    <div class="row d-flex flex-row justify-content-center g-1 py-5">
        <?php
            $mfarisrafi_user = mysqli_query($mfarisrafi_db_connect,"SELECT * FROM mfarisrafi_tamu WHERE mfarisrafi_email_tamu = '$mfarisrafi_email'");
            while($mfarisrafi_row = mysqli_fetch_assoc($mfarisrafi_user)) :
        ?>
        <div class="col-md-8">
            <div class="h-100 p-5 text-black border rounded-3">
                <h1>Profile</h1>
                <form action="admin/faris_ajax.php?action=edit_tamu" method="post" id="form-tamu">
                <input type="hidden" name="mfarisrafi_nik" class="form-control" value="<?php echo $mfarisrafi_row['mfarisrafi_no_identitas'] ?>">
                    <div class="form-group">
                        <label for="">NIK</label>
                        <input type="text" class="form-control" value="<?php echo $mfarisrafi_row['mfarisrafi_no_identitas'] ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="">Nama Lengkap</label>
                        <input type="text" name="mfarisrafi_nama" class="form-control" value="<?php echo $mfarisrafi_row['mfarisrafi_nama_tamu'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" name="mfarisrafi_email" class="form-control" value="<?php echo $mfarisrafi_row['mfarisrafi_email_tamu'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" name="mfarisrafi_username" class="form-control" value="<?php echo $mfarisrafi_row['mfarisrafi_username'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" name="mfarisrafi_password" class="form-control" required>
                    </div><br>
                    <button type="submit" class="btn btn-sm btn-primary col-md-12">Ubah</button>
                </form>
            </div>
        </div>
        <?php endwhile; ?>
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

        $('#form-tamu').on('submit', function(event){
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
                    alert_toast("Data Berhasil Diubah",'success')
					setTimeout(function(){
						location.reload()
					},1000)
                }
            });
        });

        $(document).ready(function(){
            $('.loading').fadeOut('fast', function(){
                $('.content').fadeIn(500);
            });
        });
    </script>
</body>
</html>