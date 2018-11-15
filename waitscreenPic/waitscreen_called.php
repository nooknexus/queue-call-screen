<?php
    require("../connect.php");

    $sql = "SELECT
          	depq,
          	fullname,
          	status,
          	stationno,p.image image
          FROM
          	ovst_queue_server o
        		left outer JOIN patient_image p on p.hn = o.hn
          WHERE
          	status = 1
          	AND CONCAT( SUBSTRING( YEAR ( CURRENT_DATE ( ) ) + 543, 3, 2 ), DATE_FORMAT( CURRENT_DATE, '%m%d' ) ) = SUBSTRING( vn, 1, 6 )
          	AND stationno IS NOT NULL
          ORDER BY
          	stationno ASC limit 4";

    $query2 = mysqli_query($objCon,$sql);
 ?>

<table  class="table table-bordered"   id="custom2" style="background-color:green;">
  <tr>
      <td colspan="3"  style="padding: 7px;text-align: center;font-size: 60px;background-color:yellow;color:black;">กำลังรับบริการ</td>
    </tr>
    <?php
  while($result2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
  {
  ?>
        <tr>
            <td>
              <?php
              if (empty($result2['image'])){
                echo '<img class="img-thumbnail" width="130px" image" src="../dist/img/avatar.png" />';
              }else{
                echo '<img class="img-thumbnail" width="130px" image" src="data:image/jpeg;base64,'.base64_encode( $result2['image'] ).'"/>';
              }?>
            </td>
            <td><?=$result2["depq"];?></td>
            <td>โต๊ะที่ <?=$result2["stationno"]?></td>

        </tr>
        <?php
  }
  mysqli_close($objCon);
  ?>

</table>
