<?php
    session_start();
    include "faris_connect.php";
    if($_SESSION == NULL){
        header("location:faris_login.php");
    }
    if(isset($_GET['id'])){
        $mfarisrafi_tipe = mysqli_query($mfarisrafi_db_connect,"SELECT * FROM mfarisrafi_tipe_kamar WHERE mfarisrafi_id_tipe = ".$_GET['id']);
        foreach($mfarisrafi_tipe->fetch_array() as $k =>$v){
            $meta[$k] = $v;
        }
    }
?>
    <div class="container-fluid">
        <form action="faris_ajax.php?action=save_kamar" method="post" id="manage_kamar" class="form-group" enctype="multipart/form-data">
            <input type="hidden" name="mfarisrafi_id" value="<?php echo isset($meta['mfarisrafi_id_tipe']) ? $meta['mfarisrafi_id_tipe']: '' ?>">
            <div class="form-group">
                <label for="nama">Nama Tipe</label>
                <input type="text" name="mfarisrafi_nama_tipe" id="nama-tipe" class="form-control" placeholder="Masukkan Tipe Kamar" value="<?php echo isset($meta['mfarisrafi_tipe_kamar']) ? $meta['mfarisrafi_tipe_kamar']: '' ?>">
            </div>
            <div class="form-group">
                <label for="">Maksimal Tamu</label>
                <input type="number" name="mfarisrafi_maksimal_tamu" id="maksimal-tamu" class="form-control" placeholder="Masukkan Maksimal Tamu" value="<?php echo isset($meta['mfarisrafi_maksimal_tamu']) ? $meta['mfarisrafi_maksimal_tamu']: '' ?>">
            </div>
            <div class="form-group">
                <label for="">Harga</label>
                <input type="number" name="mfarisrafi_harga_tipe" id="harga-tipe" class="form-control" placeholder="Masukkan Harga Kamar" value="<?php echo isset($meta['mfarisrafi_harga']) ? $meta['mfarisrafi_harga']: '' ?>">
            </div>
            <div class="form-group">
                <label for="">Deskripsi</label>
                <textarea name="mfarisrafi_deskripsi_tipe" id="deskripsi-tipe" class="form-control" placeholder="Masukkan Deskripsi" rows="3"><?php echo isset($meta['mfarisrafi_deskripsi']) ? $meta['mfarisrafi_deskripsi']: '' ?></textarea>
            </div>
            <div class="form-group">
                <label for="">Foto</label><br>
                <img src="<?php echo isset($meta['mfarisrafi_foto']) ? '../assets/img/'.$meta['mfarisrafi_foto'] :'' ?>" alt="" id="img" style="max-width: 150px;">
                <input type="file" name="mfarisrafi_foto_tipe" id="foto-tipe" class="form-control" onchange="displayImg(this,$(this))"><br>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id='submit'>Save</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </form>
    </div>

<script>
    function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#img').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
    $(document).ready(function() {
        $('#manage_kamar').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                data: new FormData($(this)[0]),
                cache: false,
		        contentType: false,
		        processData: false,
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