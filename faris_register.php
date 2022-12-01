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
        header("location: index.php");
    }
    ?>
    <title>Register</title>
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
                <div class="col-xl-6">
                    <div class="card bg-dark ">
                        <div class="card-body p-5 bg-dark">
                            <h3 class="mb-4 text-center text-light">Register</h3>
                            <form action="admin/faris_ajax.php?action=register_tamu" id="register-tamu" method="post">
                                <div class="form-group mb-3">
                                    <label class="form-label text-light" for="">No Identitas</label>
                                    <input type="number" name="mfarisrafi_no" id="no_id" class="form-control" autocomplete="off"  placeholder="Masukan No Identitas" oninput="javascript: if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxLength="16" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label text-light" for="">Nama Lengkap</label>
                                    <input type="text" name="mfarisrafi_name" id="name" class="form-control" autocomplete="off" placeholder="Masukan Nama Lengkap" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label text-light" for="">Email</label>
                                    <input type="email" name="mfarisrafi_email" id="email" class="form-control" autocomplete="off" placeholder="Masukan Email" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label text-light" for="">Username</label>
                                    <input type="text" name="mfarisrafi_username" id="username" class="form-control" autocomplete="off" placeholder="Masukan Username" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label class="form-label text-light" for="">Password</label>
                                    <input type="password" name="mfarisrafi_password" id="password" class="form-control" placeholder="Masukan Password" required>
                                </div>
                                <button type="submit" class="btn btn-primary col-12" type="submit">Daftar</button>
                            </form>
                        </div>
                        <a href="faris_login.php" class="text-center pb-4" style="text-decoration: none;">Sudah Punya Akun</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function(){
            $('#register-tamu').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: $(this).serialize(),
                    success:function(){
                        location.href= "/faris_login.php";
                        location.reload();
                    }
                });
            });
        });
    </script>
</body>
</html>