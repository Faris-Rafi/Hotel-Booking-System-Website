<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Hebat</title>
    <?php
        include "admin/faris_connect.php";
        include "faris_head.php";
        $faris_email = $_SESSION['email'];
    ?>
</head>
<body>
    <div class="main-container">
        <div class="cards">
            <h2 class="text-center mb-5 mt-5">Pesanan Saya</h2>
        </div>
        <div class="container-fluid">
            <div class="card col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped table-bordered table-hover" id="table-pesanan">
                            <thead>
                                <tr>
                                    <th class="text-center">Kode Reservasi</th>
                                    <th class="text-center">Tipe Kamar</th>
                                    <th class="text-center">Tanggal Check In</th>
                                    <th class="text-center">Tanggal Check Out</th>
                                    <th class="text-center">Jumlah Kamar</th>
                                    <th class="text-center">Total</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $mfarisrafi_tipekamar = mysqli_query($mfarisrafi_db_connect,"SELECT * FROM mfarisrafi_tipe_kamar");
                                    while($mfarisrafi_row = mysqli_fetch_array($mfarisrafi_tipekamar)){
                                        $mfarisrafi_nama[$mfarisrafi_row['mfarisrafi_id_tipe']] = $mfarisrafi_row['mfarisrafi_tipe_kamar'];
                                    }
                                    $mfarisrafi_cekIn = mysqli_query($mfarisrafi_db_connect,"SELECT distinct(mfarisrafi_kode_reservasi),mfarisrafi_no_reservasi,mfarisrafi_jumlah_kamar,mfarisrafi_status,mfarisrafi_id_tipe,mfarisrafi_check_in,mfarisrafi_check_out,mfarisrafi_total FROM mfarisrafi_reservasi WHERE mfarisrafi_email_tamu = '$faris_email' ORDER BY mfarisrafi_kode_reservasi DESC");
                                    while($mfarisrafi_row = mysqli_fetch_assoc($mfarisrafi_cekIn)) :
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $mfarisrafi_row['mfarisrafi_kode_reservasi'] ?></td>
                                    <td class="text-center"><?php echo $mfarisrafi_nama[$mfarisrafi_row['mfarisrafi_id_tipe']] ?></td>
                                    <td class="text-center"><?php echo $mfarisrafi_row['mfarisrafi_check_in'] ?></td>
                                    <td class="text-center" width="80px"><?php echo $mfarisrafi_row['mfarisrafi_check_out'] ?></td>
                                    <td class="text-center"><?php echo $mfarisrafi_row['mfarisrafi_jumlah_kamar'] ?></td>
                                    <td class="text-center"><?php echo 'Rp.' .number_format($mfarisrafi_row['mfarisrafi_total'],2) ?></td>
                                    <td class="text-center">
                                        <?php if($mfarisrafi_row['mfarisrafi_status'] == '') : ?>
                                        <a href="javascript:void(0)" class="btn btn-sm btn-danger cancel_reservasi" data-bs-id="<?php echo $mfarisrafi_row['mfarisrafi_no_reservasi'] ?>">Cancel</a>
                                        <a href="faris_invoice.php?id=<?php echo $mfarisrafi_row['mfarisrafi_kode_reservasi'] ?>" target="_blank" class="btn btn-sm btn-primary">Lihat</a>
                                        <?php else : ?>
                                        <a href="faris_invoice.php?id=<?php echo $mfarisrafi_row['mfarisrafi_kode_reservasi'] ?>" target="_blank" class="btn btn-sm btn-primary">Lihat</a>
                                        <?php endif ?>
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
        $(document).ready(function(){
            $('#table-pesanan').DataTable();
        });

        $('.cancel_reservasi').click(function(){
            _confirm('Apakah Anda Yakin?','cancel_reservasi',[$(this).attr("data-bs-id")])
        })

        function cancel_reservasi($id){
            $.ajax({
                url:'admin/faris_ajax.php?action=cancel_reservasi',
                method:'POST',
                data: {id:$id},
                beforeSend:function(){
                    $('.content').hide()
                    $('.loading').show()
                },
                success:function(){
                    alert_toast("Cancel Selesai",'danger')
				    setTimeout(function(){
					    location.reload()
				    },1000)        
                }
            })
        }
    </script>
</body>
</html>