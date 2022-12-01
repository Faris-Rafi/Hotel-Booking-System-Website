<style>
    .carousel{
        position: sticky;
    }

    .carousel-fade .carousel-item {
        opacity: 0;
        transition-duration: .6s;
        transition-property: opacity;
    }
   
    .carousel-fade  .carousel-item.active,
    .carousel-fade  .carousel-item-next.carousel-item-left,
    .carousel-fade  .carousel-item-prev.carousel-item-right {
        opacity: 1;
    }
   
    .carousel-fade .active.carousel-item-left,
    .carousel-fade  .active.carousel-item-right {
        opacity: 0;
    }
   
    .carousel-fade  .carousel-item-next,
    .carousel-fade .carousel-item-prev,
    .carousel-fade .carousel-item.active,
    .carousel-fade .active.carousel-item-left,
    .carousel-fade  .active.carousel-item-prev {
        transform: translateX(0);
        transform: translate3d(0, 0, 0);
    }

    .carousel-indicators button {
        width: 10px!important;
        height: 10px!important;
        border-radius: 50%;
    }

    .carousel-caption{
        top: 30%;
    }

</style>
<?php
    $mfarisrafi_setting = mysqli_query($mfarisrafi_db_connect,"SELECT * FROM mfarisrafi_site_settings");
    $mfarisrafi_row = mysqli_fetch_assoc($mfarisrafi_setting);
?>
<div class="main-container">
    <div class="cards">
        <h2 style="color: black; border-bottom: 1px solid #8FC5E9;">Slideshow</h2>
    </div>
    <div id="myCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img style="opacity: 0.7;" class="bd-placeholder-img" src="../assets/img/<?php echo $mfarisrafi_row['mfarisrafi_foto1'] ?>" width="100%" height="400px">

                <div class="container">
                    <div class="carousel-caption">
                        <h1 class="text-black fw-bold"><?php echo $mfarisrafi_row['mfarisrafi_cap1'] ?></h1>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img style="opacity: 0.7;" class="bd-placeholder-img" src="../assets/img/<?php echo $mfarisrafi_row['mfarisrafi_foto2'] ?>" width="100%" height="400px">

                <div class="container">
                    <div class="carousel-caption">
                        <h1 class="text-black fw-bold"><?php echo $mfarisrafi_row['mfarisrafi_cap2'] ?></h1>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img style="opacity: 0.7;" class="bd-placeholder-img" src="../assets/img/<?php echo $mfarisrafi_row['mfarisrafi_foto3'] ?>" width="100%" height="400px">

                <div class="container">
                    <div class="carousel-caption">
                        <h1 class="text-black fw-bold"><?php echo $mfarisrafi_row['mfarisrafi_cap3'] ?></h1>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <hr style="border-bottom: 2px solid black;">
    <form action="faris_ajax.php?action=setting" method="post" id="setting" enctype="multipart/form-data">
        <div class="form-group">
            <label class="text-black">Gambar 1</label><br>
            <img src="<?php echo isset($mfarisrafi_row['mfarisrafi_foto1']) ? '../assets/img/'.$mfarisrafi_row['mfarisrafi_foto1'] :'' ?>" alt="" id="img1" style="max-width: 150px;">
            <input type="file" name="mfarisrafi_foto1" id="foto-tipe" class="form-control" onchange="displayImg1(this,$(this))"><br>
        </div>
        <div class="form-group">
            <label class="text-black">Gambar 2</label><br>
            <img src="<?php echo isset($mfarisrafi_row['mfarisrafi_foto2']) ? '../assets/img/'.$mfarisrafi_row['mfarisrafi_foto2'] :'' ?>" alt="" id="img2" style="max-width: 150px;">
            <input type="file" name="mfarisrafi_foto2" id="foto-tipe" class="form-control" onchange="displayImg2(this,$(this))"><br>
        </div>
        <div class="form-group">
            <label class="text-black">Gambar 3</label><br>
            <img src="<?php echo isset($mfarisrafi_row['mfarisrafi_foto3']) ? '../assets/img/'.$mfarisrafi_row['mfarisrafi_foto3'] :'' ?>" alt="" id="img3" style="max-width: 150px;">
            <input type="file" name="mfarisrafi_foto3" id="foto-tipe" class="form-control" onchange="displayImg3(this,$(this))"><br>
        </div>
        <hr style="border-bottom: 1px solid black;">
        <div class="form-group">
            <label class="text-black">Caption 1</label>
            <input type="text" name="mfarisrafi_cap1" class="form-control" value="<?php echo $mfarisrafi_row['mfarisrafi_cap1'] ?>"><br>
        </div>
        <div class="form-group">
            <label class="text-black">Caption 2</label>
            <input type="text" name="mfarisrafi_cap2" class="form-control" value="<?php echo $mfarisrafi_row['mfarisrafi_cap2'] ?>"><br>
        </div>
        <div class="form-group">
            <label class="text-black">Caption 3</label>
            <input type="text" name="mfarisrafi_cap3" class="form-control" value="<?php echo $mfarisrafi_row['mfarisrafi_cap3'] ?>"><br>
        </div>
        <button type="submit" class="btn btn-primary col-md-12">Save</button>
    </form>
</div>
<script>
    function displayImg1(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#img1').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
    function displayImg2(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#img2').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
    function displayImg3(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#img3').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}

    $('#setting').on('submit', function(event){
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
                alert_toast("Data Berhasil Diupdate",'success')
				setTimeout(function(){
					location.reload()
				},1000)
                    
            }
        });
    })
</script>