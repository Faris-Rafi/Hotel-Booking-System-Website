<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Admin</title>
    <?php include "faris_head.php" ?>
    <?php 
    session_start();
    if (!empty($_SESSION)) {
        header("location: index.php?page=faris_dashboard");
    }
    ?>
    <style>
        body{
            background: #0f2453;
        }
    </style>
</head>
<body>
    <section class="vh-100">
        <div class="container h-100">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-xl-5">
                    <div class="card">
                        <div class="card-body p-5">
                            <h3 class="mb-4 text-center">Login</h3>
                            <form action="faris_ajax.php?action=login" id="login" method="post">
                                <div class="form-group mb-3">
                                    <label class="form-label" for="">Username</label>
                                    <input type="text" name="mfarisrafi_username" id="username" class="form-control">
                                </div>
                                <div class="form-group mb-4">
                                    <label class="form-label" for="typePasswordX-2">Password</label>
                                    <input type="password" name="mfarisrafi_password" id="password" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary col-12" type="submit">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function(){
            $('#login').on('submit', function(event){
                event.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: $(this).serialize(),
                    success:function(){
                        location.reload();
                    }
                });
            });
        });
    </script>

</body>
</html>