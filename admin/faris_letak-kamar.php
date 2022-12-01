<?php
    if($_SESSION == NULL){
        header("location:faris_login.php");
    }
    $mfarisrafi_id_tipe = mysqli_query($mfarisrafi_db_connect,"SELECT * FROM mfarisrafi_tipe_kamar");
    while($mfarisrafi_row = mysqli_fetch_assoc($mfarisrafi_id_tipe)){
        $mfarisrafi_nama[$mfarisrafi_row['mfarisrafi_id_tipe']] = $mfarisrafi_row['mfarisrafi_tipe_kamar'];
    }
?>
<div class="main-container">
    <div class="cards">
        <h2 style="color: black; border-bottom: 1px solid #8FC5E9;">Letak Kamar</h2>
    </div>
    <div class="container-fluid">
        <div class="card col-lg-12">
            <div class="card">
                <div class="card-body">
                    <a class="btn btn-md btn-primary col-md-2 offset-md-10" id="tambah-letak">Tambah Kamar +</a>
                </div>
            </div>
        </div>
        <div class="card col-lg-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover" id="table-letak-kamar">
                        <thead>
                            <tr>
                                <th class="text-center">No Kamar</th>
                                <th class="text-center">Tipe Kamar</th>
                                <th class="text-center">Lantai</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $mfarisrafi_kamar = mysqli_query($mfarisrafi_db_connect,"SELECT * FROM mfarisrafi_kamar ORDER BY mfarisrafi_no_kamar");
                                while($mfarisrafi_row = mysqli_fetch_assoc($mfarisrafi_kamar)) :
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $mfarisrafi_row['mfarisrafi_no_kamar'] ?></td>
                                <td class="text-center"><?php echo $mfarisrafi_nama[$mfarisrafi_row['mfarisrafi_id_tipe']] ?></td>
                                <td class="text-center"><?php echo $mfarisrafi_row['mfarisrafi_lantai'] ?></td>
                                <td class="text-center">
                                    <?php if($mfarisrafi_row['mfarisrafi_status'] == 'Tersedia') : ?>
                                    <span class="badge bg-success">Tersedia</span>
                                    <?php else : ?>
                                    <span class="badge bg-danger">Tidak Tersedia</span>
                                    <?php endif; ?>             
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-sm btn-success ubah-letak" href="javascript:void(0)" data-bs-id="<?php echo $mfarisrafi_row['mfarisrafi_id_kamar'] ?>">Ubah</a> | 
                                    <a class="btn btn-sm btn-danger delete_letak" href="javascript:void(0)" data-bs-id="<?php echo $mfarisrafi_row['mfarisrafi_id_kamar'] ?>" data-bs-tipe="<?php echo $mfarisrafi_row['mfarisrafi_id_tipe'] ?>">hapus</a>
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
    $('#tambah-letak').click(function(){
        form_modal('Tambah Kamar','faris_manage-letak.php')
    })

    $('.ubah-letak').click(function(){
        form_modal('Ubah Kamar','faris_manage-letak.php?id='+$(this).attr("data-bs-id"))
    })

    $('.delete_letak').click(function(){
        _confirm('Apakah Anda Yakin Ingin Hapus Kamar Ini?','delete_letak',[$(this).attr("data-bs-id"),$(this).attr("data-bs-tipe")])
    })

    function delete_letak($id,$tipe){
        $.ajax({
            url:'faris_ajax.php?action=delete_letak',
            method:'POST',
            data: {id:$id,tipe:$tipe},
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

    $(document).ready(function(){
        $('#table-letak-kamar').DataTable()
    });
</script>