<?php
    if($_SESSION == NULL){
        header("location:faris_login.php");
    }
?>
<div class="main-container">
    <div class="cards">
        <h2 style="color: black; border-bottom: 1px solid #8FC5E9;">Check In</h2>
    </div>
    <div class="container-fluid">
        <div class="card col-lg-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover" id="table-reserve">
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
                                $mfarisrafi_cekIn = mysqli_query($mfarisrafi_db_connect,"SELECT * FROM mfarisrafi_reservasi ORDER BY mfarisrafi_id_reservasi DESC");
                                while($mfarisrafi_row = mysqli_fetch_assoc($mfarisrafi_cekIn)) :
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $mfarisrafi_row['mfarisrafi_kode_reservasi'] ?></td>
                                <td class="text-center"><?php echo $mfarisrafi_row['mfarisrafi_nama_pemesan'] ?></td>
                                <td class="text-center"><?php echo $mfarisrafi_row['mfarisrafi_check_in'] ?></td>
                                <td class="text-center"><?php echo $mfarisrafi_row['mfarisrafi_check_out'] ?></td>
                                <td class="text-center">
                                    <?php if($mfarisrafi_row['mfarisrafi_status'] == 'Checked In') : ?>
                                    <span class="badge bg-warning">Checked In</span>
                                    <?php elseif($mfarisrafi_row['mfarisrafi_status'] == 'Checked Out') : ?>
                                    <span class="badge bg-warning">Checked Out</span>
                                    <?php else : ?>
                                    <a class="btn btn-sm btn-success check_in" href="javascript:void(0)" data-bs-id="<?php echo $mfarisrafi_row['mfarisrafi_id_reservasi'] ?>">Check In</a>
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
    $('.check_in').click(function(){
        form_modal('Check In','faris_manage-check-in.php?id='+$(this).attr("data-bs-id"))
    })

    $(document).ready(function(){
        $('#table-reserve').DataTable()
    });
</script>