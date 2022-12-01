<?php
    if($_SESSION == NULL){
        header("location:faris_login.php");
    }
?>
<div class="main-container">
    <div class="cards">
        <h2 style="color: black; border-bottom: 1px solid #8FC5E9;">Check Out</h2>
    </div>
    <div class="container-fluid">
        <div class="card col-lg-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover" id="table-check-out">
                        <thead>
                            <tr>
                                <th class="text-center">Kode Reservasi</th>
                                <th class="text-center">Nama Tamu</th>
                                <th class="text-center">Tanggal Check In</th>
                                <th class="text-center">Tanggal Check Out</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $mfarisrafi_cekIn = mysqli_query($mfarisrafi_db_connect,"SELECT * FROM mfarisrafi_reservasi ORDER BY mfarisrafi_kode_reservasi DESC");
                                while($mfarisrafi_row = mysqli_fetch_assoc($mfarisrafi_cekIn)) :
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $mfarisrafi_row['mfarisrafi_kode_reservasi'] ?></td>
                                <td class="text-center"><?php echo $mfarisrafi_row['mfarisrafi_nama_pemesan'] ?></td>
                                <td class="text-center"><?php echo $mfarisrafi_row['mfarisrafi_check_in'] ?></td>
                                <td class="text-center"><?php echo $mfarisrafi_row['mfarisrafi_check_out'] ?></td>
                                <td class="text-center">
                                    <?php if($mfarisrafi_row['mfarisrafi_status'] == 'Checked In') : ?>
                                    <a class="btn btn-sm btn-danger check_out" href="javascript:void(0)" data-bs-id="<?php echo $mfarisrafi_row['mfarisrafi_id_reservasi'] ?>">Check Out</a>
                                    <?php elseif($mfarisrafi_row['mfarisrafi_status'] == 'Checked Out') : ?>
                                    <span class="badge bg-warning">Checked Out</span>
                                    <?php endif; ?>
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
    $('.check_out').click(function(){
        form_modal('Check Out','faris_manage-check-out.php?id='+$(this).attr("data-bs-id"))
    })

    $(document).ready(function(){ 
        $('#table-check-out').DataTable()
    });
</script>