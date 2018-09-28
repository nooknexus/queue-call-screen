<?php
    include("..\connect.php");

    $sql = "SELECT
          	depq,
          	name
          FROM
          	ovst_queue_server
          WHERE
          	status = 1
          	AND CONCAT( SUBSTRING( YEAR ( CURRENT_DATE ( ) ) + 543, 3, 2 ), DATE_FORMAT( CURRENT_DATE, '%m%d' ) ) = SUBSTRING( vn, 1, 6 )
          	AND stationno IS NOT NULL
          ORDER BY
          	stationno ASC limit 7";

    $query2 = mysqli_query($objCon, $sql);
 ?>

<table class="table table-bordered"  id="custom" style="color: white;background-color: green;">
  <tr>
      <td colspan="2"  style="padding: 0px;text-align: center;font-size: 50px;background-color:white;color:black;">รอพบแพทย์</td>
    </tr>
  <tr>
    <th>เลขคิว</th>
    <th>ชื่อ</th>

  </tr>
  <?php
while ($result2=mysqli_fetch_array($query2, MYSQLI_ASSOC)) {
     ?>
      <tr>
          <td style="text-align: justify;color:white;text-align:center"><b><?=$result2["depq"]; ?></b></td>
          <td><?=$result2["name"]; ?></td>
      </tr>
      <?php
 }
?>


</table>
