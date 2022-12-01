<?php
ob_start();
$mfarisrafi_action = $_GET['action'];
include 'faris_action.php';
$mfarisrafi_crud = new Action();

if($mfarisrafi_action == 'login'){
    $mfarisrafi_save = $mfarisrafi_crud->mfarisrafi_login();
    if($mfarisrafi_save)
        echo $mfarisrafi_save;
}

if($mfarisrafi_action == 'logout'){
    $mfarisrafi_save = $mfarisrafi_crud->mfarisrafi_logout();
    if($mfarisrafi_save)
        echo $mfarisrafi_save;
}

if($mfarisrafi_action == 'save_kamar'){
    $mfarisrafi_save = $mfarisrafi_crud->mfarisrafi_saveKamar();
    if($mfarisrafi_save)
        echo $mfarisrafi_save;
}

if($mfarisrafi_action == 'delete_kamar'){
    $mfarisrafi_save = $mfarisrafi_crud->mfarisrafi_deleteKamar();
    if($mfarisrafi_save)
        echo $mfarisrafi_save;
}

if($mfarisrafi_action == 'save_letak'){
    $mfarisrafi_save = $mfarisrafi_crud->mfarisrafi_save_letak();
    if($mfarisrafi_save)
        echo $mfarisrafi_save;
}

if($mfarisrafi_action == 'delete_letak'){
    $mfarisrafi_save = $mfarisrafi_crud->mfarisrafi_delete_letak();
    if($mfarisrafi_save)
        echo $mfarisrafi_save;
}

if($mfarisrafi_action == 'save_fasilitasKamar'){
    $mfarisrafi_save = $mfarisrafi_crud->mfarisrafi_savefasilitasKamar();
    if($mfarisrafi_save)
        echo $mfarisrafi_save;
}

if($mfarisrafi_action == 'save_fasilitas_hotel'){
    $mfarisrafi_save = $mfarisrafi_crud->mfarisrafi_save_fasilitas_hotel();
    if($mfarisrafi_save)
        echo $mfarisrafi_save;
}

if($mfarisrafi_action == 'delete_hotel'){
    $mfarisrafi_save = $mfarisrafi_crud->mfarisrafi_delete_hotel();
    if($mfarisrafi_save)
        echo $mfarisrafi_save;
}

if($mfarisrafi_action == 'save_user'){
    $mfarisrafi_save = $mfarisrafi_crud->mfarisrafi_saveUser();
    if($mfarisrafi_save)
        echo $mfarisrafi_save;
}

if($mfarisrafi_action == 'delete_user'){
    $mfarisrafi_save = $mfarisrafi_crud->mfarisrafi_deleteUser();
    if($mfarisrafi_save)
        echo $mfarisrafi_save;
}

if($mfarisrafi_action == 'ubah_tamu'){
    $mfarisrafi_save = $mfarisrafi_crud->mfarisrafi_ubah_tamu();
    if($mfarisrafi_save)
        echo $mfarisrafi_save;
}

if($mfarisrafi_action == 'delete_pertanyaan'){
    $mfarisrafi_save = $mfarisrafi_crud->mfarisrafi_delete_pertanyaan();
    if($mfarisrafi_save)
        echo $mfarisrafi_save;
}

if($mfarisrafi_action == 'setting'){
    $mfarisrafi_save = $mfarisrafi_crud->mfarisrafi_setting();
    if($mfarisrafi_save)
        echo $mfarisrafi_save;
}

if($mfarisrafi_action == 'isi_tentang'){
    $mfarisrafi_save = $mfarisrafi_crud->mfarisrafi_isi_tentang();
    if($mfarisrafi_save)
        echo $mfarisrafi_save;
}

if($mfarisrafi_action == 'reservasi_rsp'){
    $mfarisrafi_save = $mfarisrafi_crud->mfarisrafi_reservasi_rsp();
    if($mfarisrafi_save)
        echo $mfarisrafi_save;
}

if($mfarisrafi_action == 'check_in'){
    $mfarisrafi_save = $mfarisrafi_crud->mfarisrafi_check_in();
    if($mfarisrafi_save)
        echo $mfarisrafi_save;
}

if($mfarisrafi_action == 'check_out'){
    $mfarisrafi_save = $mfarisrafi_crud->mfarisrafi_check_out();
    if($mfarisrafi_save)
        echo $mfarisrafi_save;
}

if($mfarisrafi_action == 'delete_laporan'){
    $mfarisrafi_save = $mfarisrafi_crud->mfarisrafi_clear_laporan();
    if($mfarisrafi_save)
        echo $mfarisrafi_save;
}

if($mfarisrafi_action == 'register_tamu'){
    $mfarisrafi_save = $mfarisrafi_crud->mfarisrafi_register_tamu();
    if($mfarisrafi_save)
        echo $mfarisrafi_save;
}

if($mfarisrafi_action == 'login_tamu'){
    $mfarisrafi_save = $mfarisrafi_crud->mfarisrafi_login_tamu();
    if($mfarisrafi_save)
        echo $mfarisrafi_save;
}

if($mfarisrafi_action == 'edit_tamu'){
    $mfarisrafi_save = $mfarisrafi_crud->mfarisrafi_edit_tamu();
    if($mfarisrafi_save)
        echo $mfarisrafi_save;
}

if($mfarisrafi_action == 'logout_tamu'){
    $mfarisrafi_save = $mfarisrafi_crud->mfarisrafi_logout_tamu();
    if($mfarisrafi_save)
        echo $mfarisrafi_save;
}

if($mfarisrafi_action == 'reservasi'){
    $mfarisrafi_save = $mfarisrafi_crud->mfarisrafi_reservasi();
    if($mfarisrafi_save)
        echo $mfarisrafi_save;
}

if($mfarisrafi_action == 'pertanyaan'){
    $mfarisrafi_save = $mfarisrafi_crud->mfarisrafi_pertanyaan();
    if($mfarisrafi_save)
        echo $mfarisrafi_save;
}

if($mfarisrafi_action == 'cancel_reservasi'){
    $mfarisrafi_save = $mfarisrafi_crud->mfarisrafi_cancel_reservasi();
    if($mfarisrafi_save)
        echo $mfarisrafi_save;
}
