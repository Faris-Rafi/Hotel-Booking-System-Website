<?php

    $mfarisrafi_db_connect = mysqli_connect("localhost","root","","mfarisrafi_dbhotel");

    if(mysqli_connect_error()){
    echo "Koneksi Ke Database Gagal : ".mysqli_connect_error();
    }

?>