<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>เช็คอิน</title>
    <link rel="stylesheet" href="../dist/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Niramit" rel="stylesheet">
  </head>
  <body style="font-family: 'Niramit', sans-serif;">
<?php
$js = <<<JS
$(function () {
    //barcode prompt


    //play beep
    var sound = document.getElementById("beep");
    sound.play()

});
JS;


 ?>

    <div class="container">

    <form id="signup" method="POST">

        <div class="header">

            <div class="row">
              <div class="col-md-2" style="padding-top: 10px;">
                <img src="../dist/img/logoMOPH.png" width="100%" />
              </div>
              <div class="col-md-8">
                <h1 style="font-size: 100px;" class="text-center">เข้าคิวห้องยา</h1>
              </div>
            </div>

        </div>

        <div class="sep"></div>

        <div class="inputs">
          <label class="text-center">กรุณานำใบสลิปคิวของท่าน</label>
          <label class="text-center">สแกนที่หน้าเครื่อง</label>
          
          <div class="input-group">
                                        
                    <input class="inputs" id='barcode' name="barcode" type="text"  placeholder="" autocomplete="off">
                    <span class="input-group-addon" style="margin-top: 25px;background-color:white;border: 0px;"> <img src="../dist/img/supermarket-scanner.png" height="60px" /></span>
          </div>
    

          
            <?php
            if (!empty($_POST['barcode'])) {
                $barcode = $_POST['barcode'];
                echo "<div class='alert alert-success' role='alert'><h2><i class='fa fa-check-circle' style='font-size:35px;color:green'></i> ลงทะเบียนเรียบร้อยแล้ว</h2><p class='pull-right'> VN =  $barcode</p></div>";
                //  database exceute  here.
                if ($barcode==1){
                  $js = '';
                }
            }
            ?>
          
          <div class="alert alert-info" role="alert">
                <h2 class="text-center">กรุณารอเจ้าหน้าที่เรียกคิว</h2>
          </div>
        </div>

    </form>

</div>


      <audio id="beep" src="./assets/beep-07.wav" autostart="false" ></audio>

      <!--javascript section-->
      <script src="../dist/bootstrap.min.js"></script>
      <script src="./assets/jquery/jquery-3.3.1.min.js"></script>
      <script>

          $(function () {
              //barcode prompt
              $('#barcode').focus();


          });

      </script>
      <script>
        <?=$js; ?>
      </script>
      <!--javascript section-->
  </body>
</html>
