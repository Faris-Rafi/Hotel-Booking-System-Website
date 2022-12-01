<div class="main-container">
    <div class="cards">
        <h2 style="color: black; border-bottom: 1px solid #8FC5E9;">Pertanyaan</h2>
    </div>
    <div class="container-fluid">
        <div class="card col-lg-12">
            <div class="card">
                <div class="card-body">
                    <a class="btn btn-sm btn-danger offset-11 col-md-1" id="clear">Clear</a>
                </div>
            </div>
        </div>
        <div class="card col-lg-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-hover" id="table-pertanyaan">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Pertanyaan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $mfarisrafi_no = 1;
                                $mfarisrafi_pertanyaan = mysqli_query($mfarisrafi_db_connect,"SELECT * FROM mfarisrafi_pertanyaan");
                                while($mfarisrafi_row = mysqli_fetch_assoc($mfarisrafi_pertanyaan)) :
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $mfarisrafi_no++ ?></td>
                                <td class="text-center"><?php echo $mfarisrafi_row['mfarisrafi_nama'] ?></td>
                                <td class="text-center"><?php echo $mfarisrafi_row['mfarisrafi_email'] ?></td>
                                <td class="text-center"><?php echo $mfarisrafi_row['mfarisrafi_pertanyaan'] ?></td>
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
    $('#clear').click(function(){
        _confirm('Apakah Anda Yakin Ingin Hapus Semua Ini?','delete_pertanyaan',[''])
    })

    function delete_pertanyaan($id){
        $.ajax({
            url:'faris_ajax.php?action=delete_pertanyaan',
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
        $('#table-pertanyaan').DataTable()
    })
</script>