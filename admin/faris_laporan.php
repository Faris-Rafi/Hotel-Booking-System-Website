<?php
    if($_SESSION == NULL){
        header("location:faris_login.php");
    }
?>
<div class="main-container">
    <div class="cards">
        <h2 style="color: black; border-bottom: 1px solid #8FC5E9;">Laporan</h2>
    </div>
    <div class="container-fluid">
    <div class="card col-lg-12">
            <div class="card">
                <div class="card-body row d-flex flex-row g-1 justify-content-between">
                    <a href="faris_print.php" target="_blank" class="btn btn-sm btn-primary col-md-1" id="print">Print</a>
                    <a class="btn btn-sm btn-danger col-md-1" id="clear">Clear</a>
                </div>
            </div>
        </div>
        <div class="card col-lg-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped table-bordered table-hover" id="table-laporan">
                        <thead>
                            <tr>
                                <th class="text-center">Kode Reservasi</th>
                                <th class="text-center">Tipe Kamar</th>
                                <th class="text-center">Tanggal Check In</th>
                                <th class="text-center">Tanggal Check Out</th>
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
                                $mfarisrafi_cekIn = mysqli_query($mfarisrafi_db_connect,"SELECT distinct(mfarisrafi_kode_reservasi),mfarisrafi_id_tipe,mfarisrafi_check_in,mfarisrafi_check_out,mfarisrafi_total FROM mfarisrafi_reservasi WHERE mfarisrafi_status = 'Checked Out' ORDER BY mfarisrafi_kode_reservasi DESC");
                                while($mfarisrafi_row = mysqli_fetch_assoc($mfarisrafi_cekIn)) :
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $mfarisrafi_row['mfarisrafi_kode_reservasi'] ?></td>
                                <td class="text-center"><?php echo $mfarisrafi_nama[$mfarisrafi_row['mfarisrafi_id_tipe']] ?></td>
                                <td class="text-center"><?php echo $mfarisrafi_row['mfarisrafi_check_in'] ?></td>
                                <td class="text-center"><?php echo $mfarisrafi_row['mfarisrafi_check_out'] ?></td>
                                <td class="text-center"><?php echo 'Rp.' .number_format($mfarisrafi_row['mfarisrafi_total'],2) ?></td>
                                <td class="text-center"><a href="../faris_invoice.php?id=<?php echo $mfarisrafi_row['mfarisrafi_kode_reservasi'] ?>" target="_blank" class="btn btn-sm btn-primary">Lihat</a></td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div class="modal fade" id="delete-laporan-modal" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title mx-auto">Laporan</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <p>Apa Anda Yakin?</p>
                </div>
            </div>
            <div class="modal-footer">
                <a href="faris_ajax.php?action=clear_laporan" class="btn btn-sm btn-danger" id="clear_laporan">Clear</a>
                <a class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</a>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    $('#clear').click(function(){
        _confirm('Apakah Anda Yakin Ingin Hapus Semua Ini?','delete_laporan',[''])
    })

    function delete_laporan($id){
        $.ajax({
            url:'faris_ajax.php?action=delete_laporan',
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
        $('#table-laporan').DataTable({
            "aaSorting": [],
            columnDefs: [{
            orderable: false,
            targets: 4
            }]
        });
        $('.dataTables_length').addClass('bs-select');
    });
</script>