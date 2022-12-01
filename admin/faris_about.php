<?php
    $mfarisrafi_setting = mysqli_query($mfarisrafi_db_connect,"SELECT * FROM mfarisrafi_site_settings");
    $mfarisrafi_row = mysqli_fetch_assoc($mfarisrafi_setting);
?>
<div class="main-container">
    <div class="cards">
        <h2 style="color: black; border-bottom: 1px solid #8FC5E9;">Tentang Hotel</h2>
    </div>
    <form action="faris_ajax.php?action=isi_tentang" method="post" id="about-form" enctype="multipart/form-data">
        <div class="form-group text-black">
		    <textarea name="about" id="about"><?php echo isset($mfarisrafi_row['mfarisrafi_about']) ? $mfarisrafi_row['mfarisrafi_about'] : '' ?></textarea>
	    </div><br>
        <button type="submit" class="btn btn-primary col-md-12">Save</button>
    </form>
</div>
<script>
    ClassicEditor
		.create( document.querySelector( '#about' ), {
			// toolbar: [ 'heading', '|', 'bold', 'italic', 'link' ]
		} )
		.then( editor => {
			window.editor = editor;
		} )
		.catch( err => {
			console.error( err.stack );
		} );

    $('#about-form').on('submit', function(event){
        event.preventDefault();
        $.ajax({
            type: $(this).attr('method'),
            method: $(this).attr('method'),
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
                alert_toast("Data Berhasil Ditambah",'success')
				setTimeout(function(){
					location.reload()
				},1000)
                    
            }
        });
    })
</script>