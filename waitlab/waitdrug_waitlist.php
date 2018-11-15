<?php
    include("../connect.php");

    $sql = "SELECT
    o.depq depq,o.fullname fullname,o.stationno stationno,p.image image
  FROM
    ovst_queue_server_dep o
    left outer JOIN patient_image p on p.hn = o.hn
  WHERE
  o.dep_visit = 'lab'
    AND CONCAT( SUBSTRING( YEAR ( CURRENT_DATE ( ) ) + 543, 3, 2 ), DATE_FORMAT( CURRENT_DATE, '%m%d' ) ) = SUBSTRING( o.vn, 1, 6 )
    and o.status = 1
    AND o.stationno IS NULL order by o.depq limit 5";

    $query2 = mysqli_query($objCon, $sql);
 ?>
 <style>
 table{
  text-align: justify;
  text-align-last: center;
  vertical-align: bottom;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
 }
 table td, table th {
    border: 1px solid black;
}
 #vertical{
    display: table-cell;
    text-align: center;
    vertical-align: middle;
    font-size: 40px;
    font-weight: 600;
 }
  </style>
  <div style="background-color:#D50000;color:white;padding-top:1px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
          <h2 style="text-align: center;font-size: 60px;">รอเรียก</h2>

        </div>
<table class="table"  id="custom" style="color: black;background-color: #B2DFDB;">

  <tr style="background-color:#00695C;color:white;">
    <th>เลขคิว</th>
    <th colspan="2">ชื่อ - นามสกุล</th>

  </tr>
  <?php
while ($result2=mysqli_fetch_array($query2, MYSQLI_ASSOC)) {
     ?>
      <tr>
          <td id="vertical" style="color:#E65100;"><b><?=$result2["depq"]; ?></b></td>
          <td id="vertical"><?=$result2["fullname"]; ?></td>
          <td><?php
          if (empty($result2['image'])){
            echo '<img class="img-thumbnail" width="100px" image" src="../dist/img/avatar.png" />';
          }else{
            echo '<img class="img-thumbnail" width="100px" image" src="data:image/jpeg;base64,'.base64_encode( $result2['image'] ).'"/>';
          }?>
          </td>

      </tr>
      <?php
 }
?>


</table>
