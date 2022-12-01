<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "faris_head.php"; ?>
    <?php 
    session_start();
    if (!empty($_SESSION)) {
        header("location:index.php?page=faris_home");
    }
    if(isset($_GET['pesan'])){
        if($_GET['pesan'] == 'gagal'){
            echo "<script>alert('Maaf Email Atau Password Salah')</script>";
        }else{
            echo "<script>alert('Login Berhasil')</script>";
        }
    }
    ?>
    <title>Login</title>
    <style>
        body{
            background: #0f2453;
        }
        a{
            color: white;
            transition: 0.3s;
            transition-property: color;
        }
        a:hover{
            color: yellow;
        }
    </style>
</head>
<body>
    <section class="vh-100">
        <div class="container h-100">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-xl-5">
                    <div class="card bg-dark p-3">
                        <div class="card-body p-5 bg-dark">
                            <h3 class="mb-4 text-center text-light">Login</h3>
                            <form action="admin/faris_ajax.php?action=login_tamu" id="login" method="post">
                                <div class="form-group mb-3">
                                    <label class="form-label text-light" for="">Email</label>
                                    <input type="email" name="mfarisrafi_email" id="email" class="form-control" autocomplete="off" placeholder="Masukan Email" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label class="form-label text-light" for="">Password</label>
                                    <input type="password" name="mfarisrafi_password" id="password" class="form-control" placeholder="Masukan Password" required>
                                </div>
                                <button type="submit" class="btn btn-primary col-12" type="submit">Login</button>
                            </form>
                        </div>
                        <a href="faris_register.php" class="text-center pb-4" style="text-decoration: none;">Buat Akun Baru</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $('#login').on('submit', function(event){
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
                    alert_toast("Login Berhasil",'success')
					setTimeout(function(){
						location.href = 'index.php?page=faris_home'
					},1000)
                }
            });
    </script>
</body>
</html>