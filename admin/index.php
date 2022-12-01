<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Hotel Hebat - Management</title>
    <?php
        session_start();
        include "faris_connect.php";
        if($_SESSION == NULL){
            header("location:faris_login.php");
        } 
        include "faris_head.php"; 
    ?>
</head>
<body>

    <!-- TOAST -->
    <div class="toast p-2" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body text-white">
        </div>
    </div>
    <!-- TOAST END -->

    <!-- LOADING -->
    <div class="loading" style="margin-top: 200px;">
        <img class="mx-auto d-block" src="../assets/img/Double Ring.svg" alt="">
    </div>
    <!-- LOADING END -->

    <div class="content w-100" style="display: none;">
        <div class="wrapper">
        <?php include "faris_topbar.php"; ?>
        <?php include "faris_sidebar.php"; ?>

        <?php 
            $page = isset($_GET['page']) ? $_GET['page'] : "faris_dashboard";
            include $page.'.php';
        ?>
        </div>
        <!-- MODAL CONFIRM -->
        <div class="modal fade" id="confirm_modal" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title mx-auto">Konfirmasi</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="delete_content">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" id='confirm' onclick="">Delete</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL CONFIRM END -->

        <!-- MODAL FORM -->
        <div class="modal fade" id="form_modal" role='dialog'>
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL FORM END -->

        <!-- MODAL MORE -->
        <div class="modal fade" id="more_modal" role='dialog'>
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL MORE END -->
    </div>
    <script>
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
    </script>
</body>
</html>