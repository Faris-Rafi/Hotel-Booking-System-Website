<?php
    if($_SESSION == NULL){
        header("location:faris_login.php");
    }
?>
<div class="main-container">
    <div class="cards">
        <h2 style="color: black; border-bottom: 1px solid #8FC5E9;">Fasilitas Hotel</h2>
    </div>
    <div class="container-fluid">
        <div class="card col-lg-12">
            <div class="card">
                <div class="card-body">
                    <a class="btn btn-md btn-primary col-md-2 offset-md-10" id="manage-hotel">Tambah Fasilitas +</a>
                </div>
            </div>
        </div>
        <div class="card col-lg-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover" id="table-fasilitas-hotel"> 
                        <thead>
                            <tr>
                                <th class="text-center">NO</th>
                                <th class="text-center ">Nama fasilitas</th>
                                <th class="text-center">Keterangan</th>
                                <th class="text-center">Foto</th>
                                <th class="text-center" width="150px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $mfarisrafi_no = 1;
                            $mfarisrafi_fasilitas = mysqli_query($mfarisrafi_db_connect,"SELECT * FROM mfarisrafi_fasilitas_hotel ORDER BY mfarisrafi_id_hotel");
                            while($mfarisrafi_row = $mfarisrafi_fasilitas -> fetch_assoc()) :
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $mfarisrafi_no++ ?></td>
                                <td class="text-center"><?php echo $mfarisrafi_row['mfarisrafi_nama_fasilitas'] ?></td>
                                <td class="text-center" width="280"><?php echo $mfarisrafi_row['mfarisrafi_keterangan'] ?></td>
                                <td class="text-center"><img src="../assets/img/<?php echo $mfarisrafi_row['mfarisrafi_foto'] ?>" width="160" height="80"></td>
                                <td class="text-center">
                                <a class="btn btn-sm btn-primary lihat-hotel" href="javascript:void(0)" data-bs-id="<?php echo $mfarisrafi_row['mfarisrafi_id_hotel'] ?>">Lihat</a> | 
                                <a class="btn btn-sm btn-success ubah-hotel" href="javascript:void(0)" data-bs-id="<?php echo $mfarisrafi_row['mfarisrafi_id_hotel'] ?>">Ubah</a> | 
                                <a class="btn btn-sm btn-danger delete_hotel" href="javascript:void(0)" data-bs-id="<?php echo $mfarisrafi_row['mfarisrafi_id_hotel'] ?>">Hapus</a>
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
    $('#manage-hotel').click(function(){
        form_modal('Tambah Fasilitas','faris_manage-hotel.php')
    })

    $('.lihat-hotel').click(function(){
        _more('Lihat Fasilitas','faris_lihat-hotel.php?id='+$(this).attr("data-bs-id"))
    })

    $('.ubah-hotel').click(function(){
        form_modal('Ubah Fasilitas','faris_manage-hotel.php?id='+$(this).attr("data-bs-id"))
    })

    $('.delete_hotel').click(function(){
        _confirm('Apakah Anda Yakin Ingin Hapus Fasilitas Ini?','delete_hotel',[$(this).attr("data-bs-id")])
    })

    function delete_hotel($id){
        $.ajax({
            url:'faris_ajax.php?action=delete_hotel',
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

    $(document).ready(function(){
        $('#table-fasilitas-hotel').DataTable()
    });
</script>