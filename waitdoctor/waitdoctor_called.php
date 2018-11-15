<?php
    require("../connect.php");

    $sql = "SELECT
            	q.depq as depq,
            	q.fullname as fullname,
              q.name as name,
            	q.STATUS as status,
              q.stationno as station
            FROM
            	ovst_queue_server q
            	LEFT OUTER JOIN ovst_queue_server_time t ON t.vn = q.vn
            WHERE
            	STATUS = 2
            	AND CONCAT( SUBSTRING( YEAR ( CURRENT_DATE ( ) ) + 543, 3, 2 ), DATE_FORMAT( CURRENT_DATE, '%m%d' ) ) = SUBSTRING( q.vn, 1, 6 )
              and q.stationno > 0
              and t.station = 'doctor'
            ORDER BY
            	t.time_start ASC
            	LIMIT 7";

    $query2 = mysqli_query($objCon, $sql);
 ?>

<table class="table table-bordered"  id="custom" style="color: white;background-color: green;">
  <tr>
      <td colspan="3"  style="padding: 0px;text-align: center;font-size: 50px;background-color:yellow;color:black;">พบแพทย์</td>
    </tr>

  <tr>
    <th width="25%">เลขคิว</th>
    <th  width="50%">ชื่อ</th>
    <th  width="25%" style="font-size: 20px">ห้องตรวจ</th>
  </tr>

  <?php
while ($result2=mysqli_fetch_array($query2, MYSQLI_ASSOC)) {
     ?>
      <tr>
          <td style="text-align: justify;color:white;text-align:center"><b><?=$result2["depq"]; ?></b></td>
          <td style="font-weight: bold;"><?=$result2["name"]; ?></td>
          <td style="text-align:center;font-weight: bold;">
            <?=$result2["station"]!='0'?$result2["station"]:''; ?>
          </td>
      </tr>
      <?php
 }
 mysqli_close($objCon);
?>


</table>
