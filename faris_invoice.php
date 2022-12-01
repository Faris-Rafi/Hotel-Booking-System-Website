<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <?php 
        session_start();
        include "admin/faris_connect.php";
        include "faris_head.php";
        
        $mfarisrafi_id = $_GET['id'];
        $mfarisrafi_date = date("Y-m-d");
        $mfarisrafi_kamar = mysqli_query($mfarisrafi_db_connect,"SELECT * FROM mfarisrafi_tipe_kamar");
        while($mfarisrafi_row = mysqli_fetch_assoc($mfarisrafi_kamar)){
          $mfarisrafi_nama[$mfarisrafi_row['mfarisrafi_id_tipe']] = $mfarisrafi_row['mfarisrafi_tipe_kamar'];
          $mfarisrafi_harga[$mfarisrafi_row['mfarisrafi_id_tipe']] = $mfarisrafi_row['mfarisrafi_harga'];
        }
        $mfarisrafi_reserve = mysqli_query($mfarisrafi_db_connect,"SELECT * FROM mfarisrafi_reservasi WHERE mfarisrafi_kode_reservasi = '$mfarisrafi_id'");
        $mfarisrafi_row = mysqli_fetch_assoc($mfarisrafi_reserve);
        $mfarisrafi_time = abs(strtotime($mfarisrafi_row['mfarisrafi_check_in']) - strtotime($mfarisrafi_row['mfarisrafi_check_out']));
        $mfarisrafi_years = floor($mfarisrafi_time / (365*60*60*24));
        $mfarisrafi_months = floor(($mfarisrafi_time - $mfarisrafi_years * 365*60*60*24) / (30*60*60*24));
        $mfarisrafi_days = floor(($mfarisrafi_time - $mfarisrafi_years * 365*60*60*24 - $mfarisrafi_months*30*60*60*24)/ (60*60*24));
    ?>
</head>
<body>
<div class="card mx-auto">
  <div class="card-body mx-4">
    <div class="container">
      <h2 class="text-center mt-4 text-danger">HOTEL HEBAT</h2>
      <p class="text-center my-3 mb-5" style="font-size: 20px;">Terima Kasih Telah Memesan Di Hotel Hebat</p>
      <div class="row">
        <ul class="list-unstyled">
          <li class="text-black">Nama : <?php echo $mfarisrafi_row['mfarisrafi_nama_pemesan'] ?></li>
          <li class="text-black mt-1">Kode : <span class="text-black"><?php echo $mfarisrafi_row['mfarisrafi_kode_reservasi'] ?></span></li>
          <li class="text-black mt-1">Check-In : <?php echo $mfarisrafi_row['mfarisrafi_check_in'] ?></li>
          <li class="text-black mt-1">Check-Out : <?php echo $mfarisrafi_row['mfarisrafi_check_out'] ?></li>
          </ul>
          <hr style="border: 1px solid black;">
        </div>
        <div class="row d-flex row-flex">
            <div class="mb-4">
              <span><?php echo $mfarisrafi_nama[$mfarisrafi_row['mfarisrafi_id_tipe']] ?> :</span>
              <span class="float-end">
                <?php echo 'Rp.'.number_format($mfarisrafi_harga[$mfarisrafi_row['mfarisrafi_id_tipe']],2) ?>
              </span>
            </div>
          <hr style="border: 1px solid black;">
      </div>
      <div class="row d-flex row-flex">
        <div class="mb-4">
          <span>Jumlah Kamar :</span>
          <span class="float-end">
            <?php echo $mfarisrafi_row['mfarisrafi_jumlah_kamar'] ?>
          </span>
        </div>
        <hr style="border: 1px solid black;">
      </div>
      <div class="row d-flex row-flex">
        <div class="mb-4">
          <span>Durasi Inap :</span>
          <span class="float-end">
            <?php echo $mfarisrafi_days ?>
          </span>
        </div>
        <hr style="border: 2px solid black;">
      </div>
      <div class="row d-flex row-flex text-black">
        <div class="mb-4 fw-bold">
          <span>Total :</span>
          <span class="float-end">
            <?php echo 'Rp.'.number_format($mfarisrafi_row['mfarisrafi_total'],2) ?>
          </span>
        </div>
        <hr style="border: 2px solid black;">
      </div>

    </div>
  </div>
</div>
<script>
  window.print();
</script>
</body>
</html>