<!-- FOOTER -->
<footer class="sticky-bottom col-md-12 py-2">
        <p class="text-center text-white">&copy; 2022 Hotel Hebat, Inc</p>
</footer>
<!-- FOOTER END -->

<!-- ADDITIONAL JAVASCRIPT -->
<script>
    function dropfunction() {
		document.getElementById("myDropdown").classList.toggle("show");
	}

    window.form_modal = function($title = '' , $url=''){
            $.ajax({
                url:$url,
                error:err=>{
                console.log()
                alert("An error occured")
                },
                success:function(resp){
                    if(resp){
                        $('#form_modal .modal-title').html($title)
                        $('#form_modal .modal-body').html(resp)
                        $('#form_modal').modal('show')
                    }
                }
            })
        }
        window._confirm = function($msg='',$func='',$params = []){
            $('#confirm_modal #confirm').attr('onclick',$func+"("+$params.join(',')+")")
            $('#confirm_modal .modal-body').html($msg)
            $('#confirm_modal').modal('show')
        }
        window._more = function($title = '', $url = ''){
           $.ajax({
               url:$url,
               error:err=>{
                   alert("An error occured")
               },
               success:function(resp){
                   if(resp){
                        $('#more_modal .modal-title').html($title)
                        $('#more_modal .modal-body').html(resp)
                        $('#more_modal').modal('show')
                   }
               }
           })
        }
        window.alert_toast = function($msg = '',$bg = ''){

            if($bg == 'success')
                $('#alert_toast').addClass('bg-success')
            if($bg == 'danger')
                $('#alert_toast').addClass('bg-danger')
            if($bg == 'info')
                $('#alert_toast').addClass('bg-info')
            if($bg == 'warning')
                $('#alert_toast').addClass('bg-warning')
            $('#alert_toast .toast-body').html($msg)
            $('#alert_toast').toast({delay:3000}).toast('show');
        }  
        $(document).ready(function(){
            $('.loading').fadeOut('fast', function(){
                $('.content').fadeIn(500);
            });
        })

        $('#check-in').datepicker({
            inline: true,
            changeMonth: true, 
            changeYear: true, 
            dateFormat: 'yy-mm-dd',
            minDate: 0,
        });
        $('#check-out').datepicker({
            inline: true,
            changeMonth: true, 
            changeYear: true, 
            dateFormat: 'yy-mm-dd',
            minDate: 1,
        });
        var mybutton = document.getElementById("scroll-button");

        window.onscroll = function() {scrollFunction()};

        function scrollFunction() {
            if (document.body.scrollTop > 600 || document.documentElement.scrollTop > 600) {
                mybutton.style.display = "block";
            } else {
                mybutton.style.display = "none";
            }
        }

        function scrollToUp() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }
        $('.lihat-hotel').click(function(){
            _more('Lihat Fasilitas','admin/faris_lihat-hotel.php?id='+$(this).attr("data-bs-id"))
        })

        $('.lihat-kamar').click(function(){
            _more('Lihat Kamar','admin/faris_lihat-kamar.php?id='+$(this).attr("data-bs-id"))
        })

        $(document).ready(function(){
            $('#form-pertanyaan').on('submit', function(event){
                event.preventDefault();
            $.ajax({
                type: $(this).attr('method'),
                url: $(this).attr('action'),
                data: $(this).serialize(),
                timeout: 1500,
                beforeSend:function(){
                    $('.loading').show();
                    $('.content').hide();
                },
                success:function(){
                    alert_toast("Pertanyaan Telah Direkam",'success')
					setTimeout(function(){
						location.reload()
					},1000)
                }
            });
            });
        })
    </script>