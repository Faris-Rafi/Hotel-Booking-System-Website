<?php
    session_start();
    include "faris_connect.php";
    if($_SESSION == NULL){
        header("location:faris_login.php");
    }

    if(isset($_GET['id'])){
        $mfarisrafi_kamar = mysqli_query($mfarisrafi_db_connect,"SELECT * FROM mfarisrafi_kamar WHERE mfarisrafi_id_kamar = ".$_GET['id']);
        foreach($mfarisrafi_kamar->fetch_array() as $k =>$v){
            $meta[$k] = $v;
        }
        $mfarisrafi_tipe = mysqli_query($mfarisrafi_db_connect,"SELECT * FROM mfarisrafi_tipe_kamar WHERE mfarisrafi_id_tipe =".$meta['mfarisrafi_id_tipe']);
        foreach($mfarisrafi_tipe->fetch_array() as $k =>$v){
            $meta[$k] = $v;
        }
    }

    $mfarisrafi_query = mysqli_query($mfarisrafi_db_connect,"SELECT max(mfarisrafi_no_kamar) as kodeterbesar FROM mfarisrafi_kamar");
    $mfarisrafi_data = mysqli_fetch_array($mfarisrafi_query);
    $mfarisrafi_kode = $mfarisrafi_data['kodeterbesar'];
    $mfarisrafi_urutan = (int) substr($mfarisrafi_kode, 5, 5);
    $mfarisrafi_urutan++;
    $mfarisrafi_huruf = "ROOM-";
    $mfarisrafi_kode = $mfarisrafi_huruf . sprintf('%03s', $mfarisrafi_urutan);
?>
    <div class="container-fluid">
        <form action="faris_ajax.php?action=save_letak" method="post" id="manage_letak" class="form-group" enctype="multipart/form-data">
            <input type="hidden" name="mfarisrafi_id" id="id-kamar" value="<?php echo isset($meta['mfarisrafi_id_kamar']) ? $meta['mfarisrafi_id_kamar']: '' ?>">
            <div class="form-group">
                <label for="">No Kamar</label>
                <input type="text" class="form-control" name="mfarisrafi_kode" id="id-tipe" value="<?php echo isset($meta['mfarisrafi_no_kamar']) ? $meta['mfarisrafi_no_kamar']: $mfarisrafi_kode ?>">
            </div>
            <div class="form-group">
                <label for="nama">Nama Tipe</label>
                <select name="mfarisrafi_id_tipe" class="form-select" id="id-tipe">
                    <?php
                        $mfarisrafi_tipe = mysqli_query($mfarisrafi_db_connect,"SELECT * FROM mfarisrafi_tipe_kamar ");
                        while($mfarisrafi_row = mysqli_fetch_assoc($mfarisrafi_tipe)) :
                    ?>
                    <option value="<?php echo isset($meta['mfarisrafi_id_tipe']) ? $meta['mfarisrafi_id_tipe']: $mfarisrafi_row['mfarisrafi_id_tipe'] ?>"><?php echo isset($meta['mfarisrafi_tipe_kamar']) ? $meta['mfarisrafi_tipe_kamar']: $mfarisrafi_row['mfarisrafi_tipe_kamar'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="">Lantai</label>
                <input type="number" name="mfarisrafi_lantai" id="lantai-kamar" class="form-control" placeholder="Masukkan Lantai Kamar" value="<?php echo isset($meta['mfarisrafi_lantai']) ? $meta['mfarisrafi_lantai']: ''?>">
            </div>
            <div class="form-group">
                <label for="">Status</label>
                <select name="mfarisrafi_status" class="form-select" id="status">
                    <option value="Tersedia">Tersedia</option>
                    <option value="Tidak Tersedia">Tidak Tersedia</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id='submit'>Save</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>

<script>
    $(document).ready(function() {
        $('#manage_letak').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                data: $(this).serialize(),
                beforeSend:function(){
                    $('.content').hide()
                    $('.loading').show()
                },
                success:function(){
                    $('#form_modal').modal('hide')
                    alert_toast("Data Berhasil Ditambah",'success')
					setTimeout(function(){
						location.reload()
					},1000)
                    
                }
            });
        })
    });
</script>