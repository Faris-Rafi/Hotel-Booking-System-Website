<?php
    if($_SESSION == NULL){
        header("location:faris_login.php");
    }
    $mfarisrafi_room = mysqli_query($mfarisrafi_db_connect,"SELECT * FROM mfarisrafi_kamar WHERE mfarisrafi_status = 'Tersedia'");
    $mfarisrafi_room_count = mysqli_num_rows($mfarisrafi_room);
    $mfarisrafi_check_in = mysqli_query($mfarisrafi_db_connect,"SELECT * FROM mfarisrafi_reservasi WHERE mfarisrafi_status = 'Checked In'");
    $mfarisrafi_in_count = mysqli_num_rows($mfarisrafi_check_in);
    $mfarisrafi_check_out = mysqli_query($mfarisrafi_db_connect,"SELECT * FROM mfarisrafi_reservasi WHERE mfarisrafi_status = 'Checked Out'");
    $mfarisrafi_out_count = mysqli_num_rows($mfarisrafi_check_out);
    $mfarisrafi_guest = mysqli_query($mfarisrafi_db_connect,"SELECT * FROM mfarisrafi_tamu");
    $mfarisrafi_guest_count = mysqli_num_rows($mfarisrafi_guest);
?>
<div class="main-container">
            <div class="cards">
                <h2 style="color: black; border-bottom: 1px solid #8FC5E9;">Dashboard</h2>
            </div>
            <div class="row align-items-md mt-4" style="margin-left: 90px;">
                <div class="col-md-6">
                    <div class="h-100 w-75 p-3 shadow-lg bg-light border rounded-3">
                        <div class="text-black text-center" style="border-bottom: 1px solid black;">
                            <h1><i class="fa-solid fa-bed display-6"></i></h1>
                            <p class="text-black">Room Available</p>
                        </div>
                        <div class="text-center text-black">
                            <h1><?php echo $mfarisrafi_room_count ?></h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="h-100 w-75 p-3 shadow-lg bg-light border rounded-3">
                        <div class="text-black text-center" style="border-bottom: 1px solid black;">
                            <h1><i class="fa-solid fa-calendar-check"></i></h1>
                            <p class="text-black">Check In</p>
                        </div>
                        <div class="text-center text-black">
                            <h1><?php echo $mfarisrafi_in_count ?></h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row align-items-md mt-5" style="margin-left: 90px;">
                <div class="col-md-6">
                    <div class="h-100 w-75 p-3 shadow-lg bg-light border rounded-3">
                        <div class="text-black text-center" style="border-bottom: 1px solid black;">
                            <h1><i class="fa-solid fa-calendar-xmark"></i></h1>
                            <p class="text-black">Check Out</p>
                        </div>
                        <div class="text-center text-black">
                            <h1><?php echo $mfarisrafi_out_count ?></h1>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="h-100 w-75 p-3 shadow-lg bg-light border rounded-3">
                        <div class="text-black text-center" style="border-bottom: 1px solid black;">
                            <h1><i class="fa-solid fa-users"></i></h1>
                            <p class="text-black">Guest</p>
                        </div>
                        <div class="text-center text-black">
                            <h1><?php echo  $mfarisrafi_guest_count  ?></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>