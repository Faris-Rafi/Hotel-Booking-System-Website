<?php
session_start();
Class Action {
    private $db;

    public function __construct() {
        ob_start();
        include "faris_connect.php";

        $this->db = $mfarisrafi_db_connect;
    }
    function __destruct() {
	    $this->db->close();
	    ob_end_flush();
	}


    function mfarisrafi_login(){
        $mfarisrafi_username = $_POST['mfarisrafi_username'];
        $mfarisrafi_password = md5($_POST['mfarisrafi_password']);
        $mfarisrafi_save = $this->db->query("SELECT * FROM mfarisrafi_user WHERE mfarisrafi_username_user = '$mfarisrafi_username' AND mfarisrafi_password_user = '$mfarisrafi_password'");
        $mfarisrafi_cek = $mfarisrafi_save->num_rows;
        if($mfarisrafi_cek > 0){
            $data = $mfarisrafi_save->fetch_assoc();
            $_SESSION['id'] = $data['mfarisrafi_id_user'];
            $_SESSION['role'] = $data['mfarisrafi_id_role'];
            $_SESSION['nama'] = $data['mfarisrafi_nama_user'];
            $_SESSION['username'] = $data['mfarisrafi_username_user'];
            return;
        }
    }

    function mfarisrafi_logout(){
        $_SESSION = [];
        session_unset();
        session_destroy();
        header("location: faris_login.php");
    }

    function mfarisrafi_saveKamar(){
        $mfarisrafi_id = $_POST['mfarisrafi_id'];
        $mfarisrafi_kamar = $_POST['mfarisrafi_nama_tipe'];
        $mfarisrafi_desc = $_POST['mfarisrafi_deskripsi_tipe'];
        $mfarisrafi_harga = $_POST['mfarisrafi_harga_tipe'];
        $mfarisrafi_max = $_POST['mfarisrafi_maksimal_tamu'];
        
        if($_FILES['mfarisrafi_foto_tipe']['tmp_name'] != ''){
            $mfarisrafi_fname =  uniqid("IMG", true).'_'.$_FILES['mfarisrafi_foto_tipe']['name'];
            $mfarisrafi_move =  move_uploaded_file($_FILES['mfarisrafi_foto_tipe']['tmp_name'],'../assets/img/'.$mfarisrafi_fname);

            if($mfarisrafi_id > 0){
                $mfarisrafi_save = $this->db->query("UPDATE mfarisrafi_tipe_kamar set mfarisrafi_tipe_kamar = '$mfarisrafi_kamar', mfarisrafi_deskripsi = '$mfarisrafi_desc', mfarisrafi_harga = '$mfarisrafi_harga', mfarisrafi_maksimal_tamu = '$mfarisrafi_max', mfarisrafi_foto = '$mfarisrafi_fname' where mfarisrafi_id_tipe = '$mfarisrafi_id'");
            }else{
                $mfarisrafi_save = $this->db->query("INSERT INTO mfarisrafi_tipe_kamar VALUES ('','$mfarisrafi_kamar','$mfarisrafi_desc','$mfarisrafi_fname','','$mfarisrafi_harga','$mfarisrafi_max','')");
            }
        }
        else{
            if($mfarisrafi_id > 0){
                $mfarisrafi_save = $this->db->query("UPDATE mfarisrafi_tipe_kamar set mfarisrafi_tipe_kamar = '$mfarisrafi_kamar', mfarisrafi_deskripsi = '$mfarisrafi_desc', mfarisrafi_harga = '$mfarisrafi_harga', mfarisrafi_maksimal_tamu = '$mfarisrafi_max' where mfarisrafi_id_tipe = '$mfarisrafi_id'");
            }else{
                $mfarisrafi_save = $this->db->query("INSERT INTO mfarisrafi_tipe_kamar VALUES ('','$mfarisrafi_kamar','$mfarisrafi_desc','','','$mfarisrafi_harga','$mfarisrafi_max','')");
            }
        }

        if($mfarisrafi_save){
            return;
        }

    }

    function mfarisrafi_deleteKamar(){
		extract($_POST);

        $mfarisrafi_save = $this->db->query("DELETE FROM mfarisrafi_tipe_kamar WHERE mfarisrafi_id_tipe = ".$id);

        if($mfarisrafi_save){
            return;
        }
	}

    function mfarisrafi_save_letak(){
        $mfarisrafi_id = $_POST['mfarisrafi_id'];
        $mfarisrafi_kode = $_POST['mfarisrafi_kode'];
        $mfarisrafi_id_tipe = $_POST['mfarisrafi_id_tipe'];
        $mfarisrafi_status = $_POST['mfarisrafi_status'];
        $mfarisrafi_lantai = $_POST['mfarisrafi_lantai'];

        if($mfarisrafi_id > 0){
            $mfarisrafi_save = $this->db->query("UPDATE mfarisrafi_kamar set  mfarisrafi_id_tipe = '$mfarisrafi_id_tipe', mfarisrafi_status = '$mfarisrafi_status', mfarisrafi_lantai = '$mfarisrafi_lantai' WHERE mfarisrafi_id_kamar = $mfarisrafi_id");
        }else{
            $mfarisrafi_insert = $this->db->query("INSERT INTO mfarisrafi_kamar VALUES ('','$mfarisrafi_kode','$mfarisrafi_id_tipe','$mfarisrafi_status','$mfarisrafi_lantai')");
            if($mfarisrafi_insert){
                $mfarisrafi_bed = $this->db->query("SELECT * FROM mfarisrafi_tipe_kamar WHERE mfarisrafi_id_tipe = '$mfarisrafi_id_tipe'");
                $mfarisrafi_jumlah = $mfarisrafi_bed->fetch_assoc();
                $mfarisrafi_a = $mfarisrafi_jumlah['mfarisrafi_jumlah_bed'];
                $mfarisrafi_jum = $mfarisrafi_a + 1;
                $mfarisrafi_save =  $this->db->query("UPDATE mfarisrafi_tipe_kamar set mfarisrafi_jumlah_bed = '$mfarisrafi_jum' WHERE mfarisrafi_id_tipe = '$mfarisrafi_id_tipe'");
            }    
        }

        if($mfarisrafi_save){
            return;
        }
    }

    function mfarisrafi_delete_letak(){
		extract($_POST);

        $mfarisrafi_delete = $this->db->query("DELETE FROM mfarisrafi_kamar WHERE mfarisrafi_id_kamar = ".$id);
        if($mfarisrafi_delete){
            $mfarisrafi_bed = $this->db->query("SELECT * FROM mfarisrafi_tipe_kamar WHERE mfarisrafi_id_tipe =".$tipe);
            $mfarisrafi_jumlah = $mfarisrafi_bed->fetch_assoc();
            $mfarisrafi_a = $mfarisrafi_jumlah['mfarisrafi_jumlah_bed'];
            $mfarisrafi_jum = $mfarisrafi_a - 1;
            $mfarisrafi_save =  $this->db->query("UPDATE mfarisrafi_tipe_kamar set mfarisrafi_jumlah_bed = '$mfarisrafi_jum' WHERE mfarisrafi_id_tipe = ".$tipe);
        }

        if($mfarisrafi_save){
            return;
        }
	}

    function mfarisrafi_savefasilitasKamar(){
        $mfarisrafi_id_tipe = $_POST['mfarisrafi_id_tipe'];
        $mfarisrafi_fasilitas = $_POST['mfarisrafi_fasilitas_tipe'];
        $mfarisrafi_save = $this->db->query("UPDATE mfarisrafi_tipe_kamar set mfarisrafi_fasilitas = '$mfarisrafi_fasilitas' WHERE mfarisrafi_id_tipe = '$mfarisrafi_id_tipe' ");

        if($mfarisrafi_save){
            return;
        }

    }

    function mfarisrafi_save_fasilitas_hotel(){
        $mfarisrafi_id = $_POST['mfarisrafi_id'];
        $mfarisrafi_nama_fasilitas = $_POST['mfarisrafi_nama_fasilitas'];
        $mfarisrafi_keterangan = $_POST['mfarisrafi_keterangan'];

        if($_FILES['mfarisrafi_foto']['tmp_name'] != ''){
            $mfarisrafi_fname =  uniqid("IMG", true).'_'.$_FILES['mfarisrafi_foto']['name'];
            $mfarisrafi_move =  move_uploaded_file($_FILES['mfarisrafi_foto']['tmp_name'],'../assets/img/'.$mfarisrafi_fname);
            if($mfarisrafi_id > 0){
                $mfarisrafi_save = $this->db->query("UPDATE mfarisrafi_fasilitas_hotel set mfarisrafi_nama_fasilitas = '$mfarisrafi_nama_fasilitas', mfarisrafi_keterangan = '$mfarisrafi_keterangan', mfarisrafi_foto = '$mfarisrafi_fname' WHERE mfarisrafi_id_hotel = '$mfarisrafi_id'");
            }else{
                $mfarisrafi_save = $this->db->query("INSERT INTO mfarisrafi_fasilitas_hotel VALUES ('','$mfarisrafi_nama_fasilitas','$mfarisrafi_keterangan','$mfarisrafi_fname')");
            }
        }
        else{
            if($mfarisrafi_id > 0){
                $mfarisrafi_save = $this->db->query("UPDATE mfarisrafi_fasilitas_hotel set mfarisrafi_nama_fasilitas = '$mfarisrafi_nama_fasilitas', mfarisrafi_keterangan = '$mfarisrafi_keterangan' WHERE mfarisrafi_id_hotel = '$mfarisrafi_id'");
            }else{
                $mfarisrafi_save = $this->db->query("INSERT INTO mfarisrafi_fasilitas_hotel VALUES ('','$mfarisrafi_nama_fasilitas','$mfarisrafi_keterangan','')");
            }
        }
       
        if($mfarisrafi_save){
            return;
        }

    }

    function mfarisrafi_delete_hotel(){
		extract($_POST);

        $mfarisrafi_save = $this->db->query("DELETE FROM mfarisrafi_fasilitas_hotel WHERE mfarisrafi_id_hotel = ".$id);

        if($mfarisrafi_save){
            return;
        }
	}


    function mfarisrafi_saveUser(){
        $mfarisrafi_id = $_POST['mfarisrafi_id'];
        $mfarisrafi_nama_user = $_POST['mfarisrafi_nama_user'];
        $mfarisrafi_email_user = $_POST['mfarisrafi_email_user'];
        $mfarisrafi_username = $_POST['mfarisrafi_username'];
        $mfarisrafi_password = md5($_POST['mfarisrafi_password']);
        $mfarisrafi_role = $_POST['mfarisrafi_role'];
        
        if($mfarisrafi_id > 0){
            $mfarisrafi_save = $this->db->query("UPDATE mfarisrafi_user set mfarisrafi_id_role = '$mfarisrafi_role', mfarisrafi_nama_user = '$mfarisrafi_nama_user', mfarisrafi_email_user = '$mfarisrafi_email_user', mfarisrafi_username_user = '$mfarisrafi_username', mfarisrafi_password_user = '$mfarisrafi_password' WHERE mfarisrafi_id_user = $mfarisrafi_id");
        }else{
            $mfarisrafi_save = $this->db->query("INSERT INTO mfarisrafi_user VALUES ('','$mfarisrafi_role','$mfarisrafi_nama_user','$mfarisrafi_email_user','$mfarisrafi_username','$mfarisrafi_password')");
        }
        
        if($mfarisrafi_save){
            return;
        }

    }

    function mfarisrafi_deleteUser(){
		extract($_POST);

        $mfarisrafi_save = $this->db->query("DELETE FROM mfarisrafi_user WHERE mfarisrafi_id_user = ".$id);

        if($mfarisrafi_save){
            return;
        }
	}

    function mfarisrafi_ubah_tamu(){
        $mfarisrafi_nik = $_POST['mfarisrafi_nik'];
        $mfarisrafi_nama = $_POST['mfarisrafi_nama'];
        $mfarisrafi_email = $_POST['mfarisrafi_email'];
        $mfarisrafi_username = $_POST['mfarisrafi_username'];
        $mfarisrafi_password = md5($_POST['mfarisrafi_password']);
        
        $mfarisrafi_save = $this->db->query("UPDATE mfarisrafi_tamu set mfarisrafi_nama_tamu = '$mfarisrafi_nama', mfarisrafi_email_tamu = '$mfarisrafi_email', mfarisrafi_username = '$mfarisrafi_username', mfarisrafi_password = '$mfarisrafi_password' WHERE mfarisrafi_no_identitas = '$mfarisrafi_nik'");

        if($mfarisrafi_save){
            return;
        }

    }

    function mfarisrafi_delete_pertanyaan(){
        $mfarisrafi_save = $this->db->query("DELETE FROM mfarisrafi_pertanyaan");

        if($mfarisrafi_save){
            return;
        }
	}

    function mfarisrafi_setting(){
        extract($_POST);
        $data = "mfarisrafi_cap1 = '$mfarisrafi_cap1'";
        $data .= ",mfarisrafi_cap2 = '$mfarisrafi_cap2'";
        $data .= ",mfarisrafi_cap3 = '$mfarisrafi_cap3'";
        
        if($_FILES['mfarisrafi_foto1']['tmp_name'] != ''){
            $mfarisrafi_fname1 =  uniqid("SLIDE", true).'_'.$_FILES['mfarisrafi_foto1']['name'];
            $mfarisrafi_move =  move_uploaded_file($_FILES['mfarisrafi_foto1']['tmp_name'],'../assets/img/'.$mfarisrafi_fname1);
            $data .= ",mfarisrafi_foto1 = '$mfarisrafi_fname1'";
        }
        if($_FILES['mfarisrafi_foto2']['tmp_name'] != ''){
            $mfarisrafi_fname2 =  uniqid("SLIDE", true).'_'.$_FILES['mfarisrafi_foto2']['name'];
            $mfarisrafi_move =  move_uploaded_file($_FILES['mfarisrafi_foto2']['tmp_name'],'../assets/img/'.$mfarisrafi_fname2);
            $data .= ",mfarisrafi_foto2 = '$mfarisrafi_fname2'";
        }
        if($_FILES['mfarisrafi_foto3']['tmp_name'] != ''){
            $mfarisrafi_fname3 =  uniqid("SLIDE", true).'_'.$_FILES['mfarisrafi_foto3']['name'];
            $mfarisrafi_move =  move_uploaded_file($_FILES['mfarisrafi_foto3']['tmp_name'],'../assets/img/'.$mfarisrafi_fname3);
            $data .= ",mfarisrafi_foto3 = '$mfarisrafi_fname3'";
        }

        $check = $this->db->query("SELECT * FROM mfarisrafi_site_settings");
        if($check->num_rows > 0){
            $mfarisrafi_save = $this->db->query("UPDATE mfarisrafi_site_settings set ".$data." where mfarisrafi_id =".$check->fetch_array()['mfarisrafi_id']);
        }else{
            $mfarisrafi_save = $this->db->query("INSERT mfarisrafi_site_settings set ".$data);
        }
        if($mfarisrafi_save){
            return;
        }

    }

    function mfarisrafi_isi_tentang(){
        $about = $_POST['about'];
        var_dump($about);
        $check = $this->db->query("SELECT * FROM mfarisrafi_site_settings");
        if($check->num_rows > 0){
            $mfarisrafi_save = $this->db->query("UPDATE mfarisrafi_site_settings set mfarisrafi_about = '$about' where mfarisrafi_id =".$check->fetch_array()['mfarisrafi_id']);
        }else{
            $mfarisrafi_save = $this->db->query("INSERT mfarisrafi_site_settings set ");
        }

        if($mfarisrafi_save){
            return;
        }

    }

    function mfarisrafi_reservasi_rsp(){
        $mfarisrafi_ids = $_POST['mfarisrafi_ids'];
        $mfarisrafi_niks = $_POST['mfarisrafi_niks'];
        $mfarisrafi_namas = $_POST['mfarisrafi_namas'];
        $mfarisrafi_emails = $_POST['mfarisrafi_emails'];
        $mfarisrafi_notlps = $_POST['mfarisrafi_notlps'];
        $mfarisrafi_cekIns = $_POST['mfarisrafi_cekIns'];
        $mfarisrafi_cekOuts = $_POST['mfarisrafi_cekOuts'];
        $mfarisrafi_jumlah_kamars = $_POST['mfarisrafi_jumlah_kamars'];
        $mfarisrafi_tamus = $_POST['mfarisrafi_tamus'];
        $mfarisrafi_pesans = $_POST['mfarisrafi_pesans'];
        $mfarisrafi_kamars = $_POST['mfarisrafi_kamars'];
        $mfarisrafi_no = rand();

        $mfarisrafi_time = abs(strtotime($mfarisrafi_cekOuts) - strtotime($mfarisrafi_cekIns));

        $mfarisrafi_years = floor($mfarisrafi_time / (365*60*60*24));
        $mfarisrafi_months = floor(($mfarisrafi_time - $mfarisrafi_years * 365*60*60*24) / (30*60*60*24));
        $mfarisrafi_days = floor(($mfarisrafi_time - $mfarisrafi_years * 365*60*60*24 - $mfarisrafi_months*30*60*60*24)/ (60*60*24));

        $mfarisrafi_tipeKamar = $this->db->query("SELECT * FROM mfarisrafi_tipe_kamar WHERE mfarisrafi_id_tipe = '$mfarisrafi_kamars'");
        $mfarisrafi_harga = $mfarisrafi_tipeKamar->fetch_assoc();
        $mfarisrafi_total = (int)$mfarisrafi_harga['mfarisrafi_harga'] * (int)$mfarisrafi_jumlah_kamars * (int)$mfarisrafi_days;

        $mfarisrafi_converts = (int)$mfarisrafi_jumlah_kamars;
        for($xs=1;$xs<=$mfarisrafi_converts;$xs++){
            $mfarisrafi_save = $this->db->query("INSERT INTO mfarisrafi_reservasi VALUES ('','$mfarisrafi_no','$mfarisrafi_ids','$mfarisrafi_niks','$mfarisrafi_namas','$mfarisrafi_emails','$mfarisrafi_notlps','$mfarisrafi_cekIns','$mfarisrafi_cekOuts','$mfarisrafi_jumlah_kamars','$mfarisrafi_tamus','$mfarisrafi_pesans','$mfarisrafi_kamars','','$mfarisrafi_total','$mfarisrafi_total','0','Belum Bayar')");
        }
    }

    function mfarisrafi_check_in(){
        $mfarisrafi_id = $_POST['mfarisrafi_id'];
        $mfarisrafi_kode = $_POST['mfarisrafi_kode_rsv'];
        $mfarisrafi_kamar = $_POST['mfarisrafi_kamar'];
        $mfarisrafi_pembayaran = $_POST['mfarisrafi_pembayaran'];
        $mfarisrafi_total = $_POST['mfarisrafi_total'];

        if($mfarisrafi_pembayaran == $mfarisrafi_total){
            $mfarisrafi_update = $this->db->query("INSERT INTO mfarisrafi_reserved_room VALUES ('','$mfarisrafi_id','$mfarisrafi_kode','$mfarisrafi_kamar')");
            if($mfarisrafi_update){
                $mfarisrafi_update2 = $this->db->query("UPDATE mfarisrafi_kamar set mfarisrafi_status = 'Tidak Tersedia' WHERE mfarisrafi_no_kamar = '$mfarisrafi_kamar'");
                if($mfarisrafi_update2){
                    $mfarisrafi_save = $this->db->query("UPDATE mfarisrafi_reservasi set mfarisrafi_status = 'Checked In', mfarisrafi_sisa_pembayaran = '0', mfarisrafi_status_pembayaran = 'Sudah Bayar' WHERE mfarisrafi_id_reservasi = '$mfarisrafi_id'");
                    if($mfarisrafi_save){
                        return;
                    }
                }
            }
        }else if($mfarisrafi_pembayaran > $mfarisrafi_total){
            $kembalian = $mfarisrafi_pembayaran - $mfarisrafi_total;
            $mfarisrafi_update = $this->db->query("INSERT INTO mfarisrafi_reserved_room VALUES ('','$mfarisrafi_id','$mfarisrafi_kode','$mfarisrafi_kamar')");
            if($mfarisrafi_update){
                $mfarisrafi_update2 = $this->db->query("UPDATE mfarisrafi_kamar set mfarisrafi_status = 'Tidak Tersedia' WHERE mfarisrafi_no_kamar = '$mfarisrafi_kamar'");
                if($mfarisrafi_update2){
                    $mfarisrafi_save = $this->db->query("UPDATE mfarisrafi_reservasi set mfarisrafi_status = 'Checked In', mfarisrafi_sisa_pembayaran = '0', mfarisrafi_kembalian = '$kembalian', mfarisrafi_status_pembayaran = 'Sudah Bayar' WHERE mfarisrafi_id_reservasi = '$mfarisrafi_id'");
                    if($mfarisrafi_save){
                        return;
                    }
                }
            }
        }else{
            $sisa_pembayaran = $mfarisrafi_total - $mfarisrafi_pembayaran;
            $mfarisrafi_update = $this->db->query("INSERT INTO mfarisrafi_reserved_room VALUES ('','$mfarisrafi_id','$mfarisrafi_kode','$mfarisrafi_kamar')");
            if($mfarisrafi_update){
                $mfarisrafi_update2 = $this->db->query("UPDATE mfarisrafi_kamar set mfarisrafi_status = 'Tidak Tersedia' WHERE mfarisrafi_no_kamar = '$mfarisrafi_kamar'");
                if($mfarisrafi_update2){
                    $mfarisrafi_save = $this->db->query("UPDATE mfarisrafi_reservasi set mfarisrafi_status = 'Checked In', mfarisrafi_sisa_pembayaran = '$sisa_pembayaran', mfarisrafi_status_pembayaran = 'Belum Lunas' WHERE mfarisrafi_id_reservasi = '$mfarisrafi_id'");
                    if($mfarisrafi_save){
                        return;
                    }
                }
            }
        }


        
    }

    function mfarisrafi_check_out(){
        $mfarisrafi_id = $_POST['mfarisrafi_id'];
        $mfarisrafi_kamar = $_POST['mfarisrafi_kamar'];

        $mfarisrafi_update = $this->db->query("DELETE FROM mfarisrafi_reserved_room WHERE mfarisrafi_id_reservasi = '$mfarisrafi_id '");
        if($mfarisrafi_update){
            $mfarisrafi_update2 = $this->db->query("UPDATE mfarisrafi_kamar set mfarisrafi_status = 'Tersedia' WHERE mfarisrafi_no_kamar = '$mfarisrafi_kamar'");
            if($mfarisrafi_update2){
                $mfarisrafi_save = $this->db->query("UPDATE mfarisrafi_reservasi set mfarisrafi_status = 'Checked Out', mfarisrafi_sisa_pembayaran = '0', mfarisrafi_kembalian = '0', mfarisrafi_status_pembayaran = 'Sudah Bayar' WHERE mfarisrafi_id_reservasi = '$mfarisrafi_id'");
                if($mfarisrafi_save){
                    return;
                }
            }
        }
    }

    function mfarisrafi_clear_laporan(){
        $mfarisrafi_save = $this->db->query("DELETE FROM mfarisrafi_reservasi WHERE mfarisrafi_status = 'Checked Out'");

        if($mfarisrafi_save){
            return;
        }
	}

    function mfarisrafi_register_tamu(){
        $mfarisrafi_no = $_POST['mfarisrafi_no'];
        $mfarisrafi_nama = $_POST['mfarisrafi_name'];
        $mfarisrafi_email = $_POST['mfarisrafi_email'];
        $mfarisrafi_username = $_POST['mfarisrafi_username'];
        $mfarisrafi_password = md5($_POST['mfarisrafi_password']);
        
        $mfarisrafi_reg = $this->db->query("INSERT INTO mfarisrafi_tamu VALUES ('$mfarisrafi_no','$mfarisrafi_nama','$mfarisrafi_email','$mfarisrafi_username','$mfarisrafi_password')");
        if($mfarisrafi_reg){
            $mfarisrafi_save = $this->db->query("SELECT * FROM mfarisrafi_tamu WHERE mfarisrafi_email_tamu = '$mfarisrafi_email' AND mfarisrafi_password = '$mfarisrafi_password'");
            $mfarisrafi_cek = $mfarisrafi_save->num_rows;
            if($mfarisrafi_cek > 0){
                $data = $mfarisrafi_save->fetch_assoc();
                $_SESSION['nik'] = $data['mfarisrafi_no_identitas'];
                $_SESSION['email'] = $data['mfarisrafi_email_tamu'];
                $_SESSION['nama'] = $data['mfarisrafi_nama_tamu'];
                $_SESSION['username'] = $data['mfarisrafi_username'];
                return;
            }
        }
    }

    function mfarisrafi_login_tamu(){
        $mfarisrafi_email = $_POST['mfarisrafi_email'];
        $mfarisrafi_password = md5($_POST['mfarisrafi_password']);
        $mfarisrafi_log = $this->db->query("SELECT * FROM mfarisrafi_tamu WHERE mfarisrafi_email_tamu = '$mfarisrafi_email' AND mfarisrafi_password = '$mfarisrafi_password'");
        $mfarisrafi_save = $mfarisrafi_log->num_rows;
        if($mfarisrafi_save > 0){
            $data = $mfarisrafi_log->fetch_assoc();
            $_SESSION['nik'] = $data['mfarisrafi_no_identitas'];
            $_SESSION['email'] = $data['mfarisrafi_email_tamu'];
            $_SESSION['nama'] = $data['mfarisrafi_nama_tamu'];
            $_SESSION['username'] = $data['mfarisrafi_username'];
            header("location: ../index.php?pesan=input");
        }else{
            header("location: ../faris_login.php?pesan=gagal");
        }
    }

    function mfarisrafi_edit_tamu(){
        $mfarisrafi_nik = $_POST['mfarisrafi_nik'];
        $mfarisrafi_nama = $_POST['mfarisrafi_nama'];
        $mfarisrafi_email = $_POST['mfarisrafi_email'];
        $mfarisrafi_username = $_POST['mfarisrafi_username'];
        $mfarisrafi_password = md5($_POST['mfarisrafi_password']);
        
        $mfarisrafi_edit = $this->db->query("UPDATE mfarisrafi_tamu set mfarisrafi_nama_tamu = '$mfarisrafi_nama', mfarisrafi_email_tamu = '$mfarisrafi_email', mfarisrafi_username = '$mfarisrafi_username', mfarisrafi_password = '$mfarisrafi_password' WHERE mfarisrafi_no_identitas = '$mfarisrafi_nik'");

        if($mfarisrafi_edit){
            $mfarisrafi_save = $this->db->query("SELECT * FROM mfarisrafi_tamu WHERE mfarisrafi_email_tamu = '$mfarisrafi_email' AND mfarisrafi_password = '$mfarisrafi_password'");
            $mfarisrafi_cek = $mfarisrafi_save->num_rows;
            if($mfarisrafi_cek > 0){
                $data = $mfarisrafi_save->fetch_assoc();
                $_SESSION['nik'] = $data['mfarisrafi_no_identitas'];
                $_SESSION['email'] = $data['mfarisrafi_email_tamu'];
                $_SESSION['nama'] = $data['mfarisrafi_nama_tamu'];
                $_SESSION['username'] = $data['mfarisrafi_username'];
                return;
            }
        }

    }

    function mfarisrafi_logout_tamu(){
        $_SESSION = [];
        session_unset();
        session_destroy();
        header("location:../index.php?pesan=logout");
    }

    function mfarisrafi_reservasi(){
        $mfarisrafi_id = $_POST['mfarisrafi_id'];
        $mfarisrafi_nik = $_POST['mfarisrafi_nik'];
        $mfarisrafi_nama = $_POST['mfarisrafi_nama'];
        $mfarisrafi_email = $_POST['mfarisrafi_email'];
        $mfarisrafi_notlp = $_POST['mfarisrafi_notlp'];
        $mfarisrafi_cekIn = $_POST['mfarisrafi_cekIn'];
        $mfarisrafi_cekOut = $_POST['mfarisrafi_cekOut'];
        $mfarisrafi_jumlah_kamar = $_POST['mfarisrafi_jumlah_kamar'];
        $mfarisrafi_tamu = $_POST['mfarisrafi_tamu'];
        $mfarisrafi_pesan = $_POST['mfarisrafi_pesan'];
        $mfarisrafi_kamar = $_POST['mfarisrafi_kamar'];
        $mfarisrafi_harga = $_POST['mfarisrafi_harga'];
        $mfarisrafi_no = rand();

        $mfarisrafi_convert = (int)$mfarisrafi_jumlah_kamar;
        for($x=1;$x<=$mfarisrafi_convert;$x++){
            $mfarisrafi_save = $this->db->query("INSERT INTO mfarisrafi_reservasi VALUES ('','$mfarisrafi_no','$mfarisrafi_id','$mfarisrafi_nik','$mfarisrafi_nama','$mfarisrafi_email','$mfarisrafi_notlp','$mfarisrafi_cekIn','$mfarisrafi_cekOut','$mfarisrafi_jumlah_kamar','$mfarisrafi_tamu','$mfarisrafi_pesan','$mfarisrafi_kamar','','$mfarisrafi_harga','$mfarisrafi_harga','0','Belum Bayar')");
        }
        
        if($mfarisrafi_save){
            header("location: ../index.php");
        }

    }

    function mfarisrafi_cancel_reservasi(){
        extract($_POST);

        $mfarisrafi_save = $this->db->query("DELETE FROM mfarisrafi_reservasi WHERE mfarisrafi_no_reservasi = ".$id);

        if($mfarisrafi_save){
            return;
        }
	}

    function mfarisrafi_pertanyaan(){
        extract($_POST);
        $data = " mfarisrafi_nama  = '$mfarisrafi_nama' ";
        $data .= ", mfarisrafi_email = '$mfarisrafi_email' ";
        $data .= ", mfarisrafi_pertanyaan = '$mfarisrafi_pertanyaan'";

        $mfarisrafi_save = $this->db->query("INSERT INTO mfarisrafi_pertanyaan set ".$data);

        if($mfarisrafi_save){
            return;
        }

    }
    
}

