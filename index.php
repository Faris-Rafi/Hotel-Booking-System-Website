<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel-Hebat</title>
    <?php
        session_start(); 
        include "admin/faris_connect.php";
        include "faris_head.php"; 
    ?>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- TOAST -->
    <div class="toast p-2" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body text-white">
        </div>
    </div>
    <!-- TOAST END -->

    <!-- LOADING -->
    <div class="loading" style="margin-top: 200px;">
        <img class="mx-auto d-block" src="assets/img/Double Ring.svg" alt="">
    </div>
    <!-- LOADING END -->

    <div class="content" style="display: none;">

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-light topbar">
        <a class="navbar-brand title" href="#">Hotel Hebat</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse a-item" id="navbarCollapse">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item a-item active">
                    <a class="nav-link" href="index.php?page=faris_home#" style="color: yellow !important;">Beranda</a>
                </li>
                <li class="nav-item a-item">
                    <a class="nav-link" href="index.php?page=faris_home#pesanKamar">Pesan</a>
                </li>
                <li class="nav-item a-item">
                    <a class="nav-link" href="index.php?page=faris_home#facility">Fasilitas</a>
                </li>
                <li class="nav-item a-item">
                    <a class="nav-link" href="index.php?page=faris_home#rooms">Ruangan</a>
                </li>
                <li class="nav-item a-item">
                    <a class="nav-link" href="index.php?page=faris_home#about">Tentang</a>
                </li>
                <li class="nav-item a-item">
                    <a class="nav-link" href="index.php?page=faris_home#contact">Hubungi Kami</a>
                </li>
            </ul>
            <ul class="navbar-nav mx-auto">
                <li class="nav-item a-item">
                    <?php if(empty($_SESSION)) : ?>
                    <a class="nav-link" href="faris_login.php"><i class="fa-solid fa-arrow-right-to-bracket a-item"></i> Login</a>
                    <?php else : ?>
                        <div class="dropdown">
                            <button onclick="dropfunction()" class="btn btn-none text-white dropdown-toggle" type="button" id="dropdownMenu2">
                                <i class="fa-solid fa-circle-user"></i><span> <?php echo $_SESSION['username'] ?></span>
                            </button>
                            <ul class="dropdown-menu" id="myDropdown" aria-labelledby="dropdownMenu2">
                                <li><button class="dropdown-item text-center text-uppercase" onclick="location.href ='faris_profile.php'" type="button"><i class="fa-solid fa-user"></i> Profile</button></li>
                                <li><hr style="border-bottom: 1px solid black;"></li>
                                <li><button class="dropdown-item text-center text-uppercase" type="button" onclick="location.href = 'index.php?page=faris_pesanan'"><i class="fa-solid fa-bed"></i> Pesanan Saya</button></li>
                                <li><hr style="border-bottom: 2px solid black;"></li>
                                <li><button class="dropdown-item text-black text-center text-uppercase" onclick="location.href ='admin/faris_ajax.php?action=logout_tamu'"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</button></li>
                            </ul>
                        </div>                
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </nav>
    <!-- NAVBAR END -->

    <!-- BUTTON SCROLL UP -->
    <button onclick="scrollToUp()" id="scroll-button"><i class="fa-solid fa-arrow-up-long"></i></button>
    <!-- BUTTON SCROLL UP ENDS -->

    <?php 
        $page = isset($_GET['page']) ? $_GET['page'] : "faris_home";
        include $page.'.php';
    ?>

     <!-- MODAL CONFIRM -->
     <div class="modal fade" id="confirm_modal" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title mx-auto">Konfirmasi</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="delete_content">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" id='confirm' onclick="">Delete</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL CONFIRM END -->

        <!-- MODAL FORM -->
        <div class="modal fade" id="form_modal" role='dialog'>
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id='submit' onclick="$('#form_modal form').submit()">Save</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL FORM END -->

        <!-- MODAL MORE -->
        <div class="modal fade" id="more_modal" role='dialog'>
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL MORE END -->

    <?php include "faris_footer.php" ?>
</div>
</body>
</html>