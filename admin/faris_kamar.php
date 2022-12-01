<?php
    if($_SESSION == NULL){
        header("location:faris_login.php");
    }
?>
<div class="main-container">
    <div class="cards">
        <h2 style="color: black; border-bottom: 1px solid #8FC5E9;">Kamar</h2>
    </div>
    <div class="container-fluid">
        <div class="card col-lg-12">
            <div class="card">
                <div class="card-body">
                    <a class="btn btn-md btn-primary col-md-2 offset-md-10" id="tambah-kamar">Tambah Kamar +</a>
                </div>
            </div>
        </div>
        <div class="card col-lg-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover" id="table-kamar">
                        <thead>
                            <tr>
                                <th class="text-center">NO</th>
                                <th class="text-center">Tipe Kamar</th>
                                <th class="text-center">Jumlah Kamar</th>
                                <th class="text-center">Foto Kamar</th>
                                <th class="text-center w-25">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $mfarisrafi_no = 1;
                            $mfarisrafi_tipe = mysqli_query($mfarisrafi_db_connect,"SELECT * FROM mfarisrafi_tipe_kamar ORDER BY mfarisrafi_id_tipe");
                            while($mfarisrafi_row = $mfarisrafi_tipe -> fetch_assoc()) :
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $mfarisrafi_no++ ?></td>
                                <td class="text-center"><?php echo $mfarisrafi_row['mfarisrafi_tipe_kamar'] ?></td>
                                <td class="text-center"><?php echo $mfarisrafi_row['mfarisrafi_jumlah_bed'] ?></td>
                                <td class="text-center"><img src="../assets/img/<?php echo $mfarisrafi_row['mfarisrafi_foto'] ?>" width="100" height="60"></td>
                                <td class="text-center">
                                    <a class="btn btn-sm btn-primary lihat-kamar" href="javascript:void(0)" data-bs-id="<?php echo $mfarisrafi_row['mfarisrafi_id_tipe'] ?>">Lihat</a> |
                                    <a class="btn btn-sm btn-success ubah-kamar" href="javascript:void(0)" data-bs-id="<?php echo $mfarisrafi_row['mfarisrafi_id_tipe'] ?>">Ubah</a> | 
                                    <a class="btn btn-sm btn-danger delete_kamar" href="javascript:void(0)" data-bs-id="<?php echo $mfarisrafi_row['mfarisrafi_id_tipe'] ?>">Hapus</a>
                            
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
    $('#tambah-kamar').click(function(){
        form_modal('Tambah Kamar','faris_manage-kamar.php')
    })

    $('.lihat-kamar').click(function(){
        _more('Lihat Kamar','faris_lihat-kamar.php?id='+$(this).attr("data-bs-id"))
    })

    $('.ubah-kamar').click(function(){
        form_modal('Ubah Kamar','faris_manage-kamar.php?id='+$(this).attr("data-bs-id"))
    })

    $('.delete_kamar').click(function(){
        _confirm('Apakah Anda Yakin Ingin Hapus Kamar Ini?','delete_kamar',[$(this).attr("data-bs-id")])
    })

    function delete_kamar($id){
        $.ajax({
            url:'faris_ajax.php?action=delete_kamar',
            method:'POST',
            data: {id:$id},
            beforeSend:function(){
                $('.content').hide()
                $('.loading').show()
            },
            success:function(){
                $('#form_modal').modal('hide')
                alert_toast("Data Berhasil Dihapus",'danger')
				setTimeout(function(){
					location.reload()
				},1000)        
            }
        })
    }
    
    $(document).ready(function() {    
        $('#table-kamar').DataTable()
    });
</script>