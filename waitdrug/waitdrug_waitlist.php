<?php
    require("../connect.php");

    $sql = "SELECT
            	depq,
            	fullname,
            	status

            FROM
            	ovst_queue_server
            WHERE
            	status = 1
            	AND CONCAT( SUBSTRING( YEAR ( CURRENT_DATE ( ) ) + 543, 3, 2 ), DATE_FORMAT( CURRENT_DATE, '%m%d' ) ) = SUBSTRING( vn, 1, 6 )
            	AND stationno IS NULL
            ORDER BY
            	time_visit ASC limit 9";

    $query2 = mysqli_query($objCon, $sql);
 ?>
<table class="table table-bordered"  id="custom" style="color: white;background-color: blue;">
  <tr>
    <th>เลขคิว</th>
    <th>ชื่อ - นามสกุล</th>
    <th>
      สถานะ
    </th>
  </tr>
  <?php
while ($result2=mysqli_fetch_array($query2, MYSQLI_ASSOC)) {
     ?>
      <tr>
          <td style="text-align: justify;color:yellow;"><b><?=$result2["depq"]; ?></b></td>
          <td><?=$result2["fullname"]; ?></td>
          <td style="font-size: 25px;"><?=$result2["status"]=='1'?'กำลังจัดยา':''; ?></td>

      </tr>
      <?php
 }
 mysqli_close($objCon);
?>


</table>
