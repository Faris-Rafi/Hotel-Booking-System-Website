<?php
    if($_SESSION == NULL){
        header("location:faris_login.php");
    }
?>
<div class="main-container">
            <div class="cards">
                <h2 style="color: black; border-bottom: 1px solid #8FC5E9;">Tamu</h2>
            </div>
            <div class="container-fluid">
        <div class="card col-lg-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-hover" id="table-tamu">
                        <thead>
                            <tr>
                                <th class="text-center">No Identitas</th>
                                <th class="text-center">Nama Tamu</th>
                                <th class="text-center">Email Tamu</th>
                                <th class="text-center">Username</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $mfarisrafi_tamu = mysqli_query($mfarisrafi_db_connect,"SELECT * FROM mfarisrafi_tamu");
                                while($mfarisrafi_row = mysqli_fetch_assoc($mfarisrafi_tamu)) :
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $mfarisrafi_row['mfarisrafi_no_identitas'] ?></td>
                                <td class="text-center"><?php echo $mfarisrafi_row['mfarisrafi_nama_tamu'] ?></td>
                                <td class="text-center"><?php echo $mfarisrafi_row['mfarisrafi_email_tamu'] ?></td>
                                <td class="text-center"><?php echo $mfarisrafi_row['mfarisrafi_username'] ?></td>
                                <td class="text-center">
                                    <a class="btn btn-sm btn-success ubah-tamu" href="javascript:void(0)" data-bs-email="<?php echo $mfarisrafi_row['mfarisrafi_email_tamu'] ?>">Ubah</a>
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
</div>
<script>
    $('.ubah-tamu').click(function(){
        form_modal('Ubah Tamu','faris_manage-tamu.php?email='+$(this).attr("data-bs-email"))
    })

    $(document).ready(function(){
        $('#table-tamu').DataTable()
    })
</script>