<?php
    if($_SESSION == NULL){
        header("location:faris_login.php");
    }
?>
<div class="main-container">
    <div class="cards">
        <h2 style="color: black; border-bottom: 1px solid #8FC5E9;">User</h2>
    </div>
    <div class="container-fluid">
        <div class="card col-lg-12">
            <div class="card">
                <div class="card-body">
                <a class="btn btn-md btn-primary col-md-2 offset-md-10" id="tambah-user">Tambah User +</a>
                </div>
            </div>
        </div>
        <div class="card col-lg-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover" id="table-user">
                        <thead>
                            <tr>
                                <th class="text-center">NO</th>
                                <th class="text-center">Nama Pengguna</th>
                                <th class="text-center">Role Pengguna</th>
                                <th class="text-center">Email Pengguna</th>
                                <th class="text-center">Username</th>
                                <th class="text-center" width="75px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $mfarisrafi_no = 1;
                            $mfarisrafi_role = mysqli_query($mfarisrafi_db_connect,"SELECT * FROM mfarisrafi_role ORDER BY mfarisrafi_id_role");
                            $mfarisrafi_user = mysqli_query($mfarisrafi_db_connect,"SELECT * FROM mfarisrafi_user ORDER BY mfarisrafi_id_user");

                            while($mfarisrafi_row = mysqli_fetch_assoc($mfarisrafi_role)){
                            $mfarisrafi_role_name[$mfarisrafi_row['mfarisrafi_id_role']] = $mfarisrafi_row['mfarisrafi_jenis_role'];
                            }
                            while($mfarisrafi_row = mysqli_fetch_assoc($mfarisrafi_user)) :
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $mfarisrafi_no++ ?></td>
                                <td class="text-center"><?php echo $mfarisrafi_row['mfarisrafi_nama_user'] ?></td>
                                <td class="text-center"><?php echo $mfarisrafi_role_name[$mfarisrafi_row['mfarisrafi_id_role']] ?></td>
                                <td class="text-center"><?php echo $mfarisrafi_row['mfarisrafi_email_user'] ?></td>
                                <td class="text-center"><?php echo $mfarisrafi_row['mfarisrafi_username_user'] ?></td>
                                <td class="text-center">
                                    <a class="btn btn-sm btn-success ubah-user" href="javascript:void(0)" data-bs-id="<?php echo $mfarisrafi_row['mfarisrafi_id_user'] ?>">Ubah</a> | 
                                    <a class="btn btn-sm btn-danger delete_user" href="javascript:void(0)" data-bs-id="<?php echo $mfarisrafi_row['mfarisrafi_id_user'] ?>">Hapus</a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('#tambah-user').click(function(){
        form_modal('Tambah User','faris_manage-user.php')
    })

    $('.ubah-user').click(function(){
        form_modal('Ubah User','faris_manage-user.php?id='+$(this).attr("data-bs-id"))
    })

    $('.delete_user').click(function(){
        _confirm('Apakah Anda Yakin Ingin Hapus User Ini?','delete_user',[$(this).attr("data-bs-id")])
    })

    function delete_user($id){
        $.ajax({
            url:'faris_ajax.php?action=delete_user',
            method:'POST',
            data: {id:$id},
            beforeSend:function(){
                $('.content').hide()
                $('.loading').show()
            },
            success:function(){
                alert_toast("Data Berhasil Dihapus",'danger')
				setTimeout(function(){
					location.reload()
				},1000)        
            }
        })
    }

    $(document).ready(function() {
        $('#table-user').DataTable()
    });
</script>