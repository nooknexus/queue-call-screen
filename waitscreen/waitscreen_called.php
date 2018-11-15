<?php
    include("..\connect.php");

    $sql = "SELECT
          	depq,
          	fullname,
          	status,
          	stationno
          FROM
          	ovst_queue_server
          WHERE
          	status = 1
          	AND CONCAT( SUBSTRING( YEAR ( CURRENT_DATE ( ) ) + 543, 3, 2 ), DATE_FORMAT( CURRENT_DATE, '%m%d' ) ) = SUBSTRING( vn, 1, 6 )
          	AND stationno IS NOT NULL
          ORDER BY
          	stationno ASC limit 5";

    $query2 = mysqli_query($objCon,$sql);
 ?>

<table  class="table table-bordered"   id="custom2" style="background-color:green;">
  <tr>
      <td colspan="2"  style="padding: 7px;text-align: center;font-size: 60px;background-color:yellow;color:black;">กำลังซักประวัติ</td>
    </tr>
    <?php
  while($result2=mysqli_fetch_array($query2,MYSQLI_ASSOC))
  {
  ?>
        <tr>
            <td><?=$result2["depq"];?></td>
            <td>โต๊ะที่ <?=$result2["stationno"]?></td>

        </tr>
        <?php
  }
  ?>

</table>
<?php mysqli_close($objCon); ?>