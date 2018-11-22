<?php require "../connect.php";?>
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
    $datethai = "select CONCAT( SUBSTRING( YEAR ( CURRENT_DATE ( ) ) + 543, 3, 2 ), DATE_FORMAT( CURRENT_DATE, '%m%d' ) ) curdate";
    $query1 = mysqli_query($objCon, $datethai);
    $result1 = mysqli_fetch_array($query1, MYSQLI_ASSOC);
    $curdate = implode($result1);
    //echo $curdate;

    //  database exceute  here.
    $sql = "SELECT * FROM ovst_queue_server WHERE vn = '$barcode' AND $curdate = SUBSTRING( vn, 1, 6 )";
    $query = mysqli_query($objCon, $sql);
    $result = mysqli_fetch_array($query, MYSQLI_ASSOC);
    $vn = $result["vn"];
    $hn = $result["hn"];
    $fullname = $result["fullname"];
    $depq = $result["depq"];

    if ($vn != "") {
        $sql2 = "SELECT * from ovst_queue_server_dep where vn = '$vn' and dep_visit = 'drug'";
        $query2 = mysqli_query($objCon, $sql2);
        $result2 = mysqli_fetch_array($query2, MYSQLI_ASSOC);
        $dep_visit = $result2["dep_visit"];

        if ($dep_visit == "drug") {
            //echo "เช็คอินซ้ำ";
            echo "<div class='alert alert-danger' role='alert'><h2><i class='fa fa-close' style='font-size:35px;color:red'></i> ขออภัยคุณเช็คอินไปแล้ว</h2></div>";
        } else {
            //echo "ยังไม่ได้เช็คอิน";
            $msgdep = "ovst_queue-Drug-".$curdate;
            //echo $msgdep;

            $sql3 = "select get_serialnumber('$msgdep')";
            $query3 = mysqli_query($objCon, $sql3);
            $result3 = mysqli_fetch_array($query3, MYSQLI_ASSOC);
            $serial = implode($result3);

            $sql4 = "INSERT into ovst_queue_server_dep (vn,hn,dep_visit,dep,depq,fullname,time_visit,status) VALUES ('$vn','$hn','drug',LPAD('$serial', 4, '0'),'$depq','$fullname',CURRENT_TIME(),'1')";
             
            if (mysqli_query($objCon, $sql4)) {
                $js = '';
                echo "<div class='alert alert-success' role='alert'><h2><i class='fa fa-check-circle' style='font-size:35px;color:green'></i> ลงทะเบียนเรียบร้อยแล้ว</h2><p class='pull-right'> VN =  $barcode</p></div>";
            } else {
                echo "Error: " . $sql4 . "<br>" . mysqli_error($objCon);
            }

        }

    } else {
        echo "<div class='alert alert-danger' role='alert'><h2><i class='fa fa-close' style='font-size:35px;color:red'></i> ไม่มีชื่อคุณในระบบคิว</h2></div>";
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
        <?=$js;?>
      </script>
      <!--javascript section-->
  </body>
</html>
