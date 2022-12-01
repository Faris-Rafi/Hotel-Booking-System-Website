<?php
    session_start();
    include "faris_connect.php";
    if($_SESSION == NULL){
        header("location:faris_login.php");
    }
    if(isset($_GET['id'])){
        $mfarisrafi_hotel = mysqli_query($mfarisrafi_db_connect,"SELECT * FROM mfarisrafi_fasilitas_hotel WHERE mfarisrafi_id_hotel = ".$_GET['id']);
        foreach($mfarisrafi_hotel->fetch_array() as $k =>$v){
            $meta[$k] = $v;
        }
    }
?>
    <div class="container-fluid">
        <form action="faris_ajax.php?action=save_fasilitas_hotel" method="post" id="manage-fasilitas-kamar" class="form-group" enctype="multipart/form-data">
            <input type="hidden" name="mfarisrafi_id" id="id=hotel" value="<?php echo isset($meta['mfarisrafi_id_hotel']) ? $meta['mfarisrafi_id_hotel']: '' ?>">
            <div class="form-group">
                <label for="" class="text-dark">Nama Fasilitas</label>
                <input type="text" class="form-control" name="mfarisrafi_nama_fasilitas" id="nama-fasilitas" placeholder="Masukkan Nama Fasilitas" value="<?php echo isset($meta['mfarisrafi_nama_fasilitas']) ? $meta['mfarisrafi_nama_fasilitas']: '' ?>">
            </div>
            <div class="form-group">
                <label for="" class="text-dark">Keterangan</label>
                <textarea name="mfarisrafi_keterangan" id="keterangan-hotel" class="form-control" placeholder="Masukkan Keterangan" rows="3"><?php echo isset($meta['mfarisrafi_keterangan']) ? $meta['mfarisrafi_keterangan']: '' ?></textarea>
            </div>
            <div class="form-group">
                <label for="" class="text-dark">Foto</label><br>
                <img src="<?php echo isset($meta['mfarisrafi_foto']) ? '../assets/img/'.$meta['mfarisrafi_foto'] :'' ?>" alt="" id="img" style="max-width: 150px;">
                <input type="file" name="mfarisrafi_foto" id="foto-fasilitas" class="form-control" onchange="displayImg(this,$(this))">
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
        $('#manage-fasilitas-kamar').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                data:  new FormData($(this)[0]),
                cache: false,
		        contentType: false,
		        processData: false,
                beforeSend:function(){
                    $('.content').hide()
                    $('.loading').show()
                },
                success:function(){
                    alert_toast("Data Berhasil Ditambah",'success')
					setTimeout(function(){
						location.reload()
					},1000)
                    
                }
            });
        });
    });
</script>