<?php
    if($_SESSION == NULL){
        header("location:faris_login.php");
    }
?>
<div class="main-container">
    <div class="cards">
        <h2 style="color: black; border-bottom: 1px solid #8FC5E9;">Fasilitas Kamar</h2>
    </div>
    <div class="container-fluid">
        <div class="card col-lg-12">
            <div class="card">
                <div class="card-body">
                    <a class="btn btn-md btn-primary col-md-3 offset-md-9" id="tambah-fasilitas">Tambah / Edit Fasilitas +</a>
                </div>
            </div>
        </div>
        <div class="card col-lg-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover" id="table-fasilitas-kamar">
                        <thead>
                            <tr>
                                <th class="text-center">NO</th>
                                <th class="text-center">Tipe Kamar</th>
                                <th class="text-center">Fasilitas Kamar</th>
                                <th class="text-center">Foto Kamar</th>
                                <th class="text-center">Aksi</th>
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
                                <td class="text-center" width="250"><?php echo $mfarisrafi_row['mfarisrafi_fasilitas'] ?></td>
                                <td class="text-center"><img src="../assets/img/<?php echo $mfarisrafi_row['mfarisrafi_foto'] ?>" width="100" height="60"></td>
                                <td class="text-center">
                                    <a class="btn btn-sm btn-primary lihat-kamar" href="javascript:void(0)" id="lihat-kamar" data-bs-id="<?php echo $mfarisrafi_row['mfarisrafi_id_tipe'] ?>">Lihat</a>
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
    $('#tambah-fasilitas').click(function(){
        form_modal('Tambah / Edit Fasilitas','faris_manage-fasilitas.php')
    })

    $('.lihat-kamar').click(function(){
        _more('Lihat Kamar','faris_lihat-kamar.php?id='+$(this).attr("data-bs-id"))
    })

    $(document).ready(function(){
        $('#table-fasilitas-kamar').DataTable()
    });
</script>