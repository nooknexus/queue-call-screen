<?php
    require("../connect.php");

    $sql = "SELECT * FROM (SELECT
            	q.depq,
            	q.fullname,
              q.opdq  ,
              (
 SELECT count(*) total
 FROM ovst_queue_server s
 left join ovst_queue_server_time t1 on s.vn = t1.vn
 WHERE CONCAT( SUBSTRING( YEAR ( CURRENT_DATE ( ) ) + 543, 3, 2 ), DATE_FORMAT( CURRENT_DATE, '%m%d' ) ) = SUBSTRING( s.vn, 1, 6 ) and s.status = 2  and s.time_visit < q.time_visit
 ) qtotal ,
            	if(position('N' in group_concat(x.confirm_all))>0,0,if(position('Y' in group_concat(x.confirm_all))>0,1,null))  xray,
            	if(position('N' in group_concat(l.confirm_report))>0,0,if(position('Y' in group_concat(l.confirm_report))>0,1,null)) lab

            FROM
            	ovst_queue_server q
            	LEFT OUTER JOIN ovst_queue_server_time t ON t.vn = q.vn
            	LEFT OUTER JOIN lab_head l ON l.vn = q.vn
            	LEFT OUTER JOIN xray_head x ON x.vn = q.vn
            WHERE
            	STATUS = 2
            	AND CONCAT( SUBSTRING( YEAR ( CURRENT_DATE ( ) ) + 543, 3, 2 ), DATE_FORMAT( CURRENT_DATE, '%m%d' ) ) = SUBSTRING( q.vn, 1, 6 )
            	AND q.stationno IS NULL

            	GROUP BY q.vn

            ORDER BY
            	t.time_start ASC
            ) tt where (tt.xray <> 0 or tt.lab <> 0) or (tt.lab is null and tt.xray is null) limit 7";

    $query2 = mysqli_query($objCon, $sql);
 ?>
<table class="table table-bordered"  id="custom" style="color: white;background-color: blue;">
  <tr>
      <td colspan="3"  style="padding: 0px;text-align: center;font-size: 50px;background-color:#800000;color:white;">รอเรียกคิว</td>
    </tr>
  <tr>
    <th>เลขคิว</th>
    <th>ชื่อ - นามสกุล</th>
    <th style="font-size:25px;">
      รอโดยประมาณ
    </th>
  </tr>

  <?php
  $i = 5;
while ($result2=mysqli_fetch_array($query2, MYSQLI_ASSOC)) {
    $queuetotal= $result2["qtotal"];
     ?>
      <tr>
          <td style="text-align: justify;color:yellow;"><b><?=$result2["depq"]; ?></b></td>
          <td><?=$result2["fullname"]; ?></td>
          <td style="font-size: 25px;text-align:right;text-align:center;color:yellow;">

            <?php
            $sumtotal = $queuetotal*$i;

            if ($sumtotal>=60){
              function convertToHoursMins($sumtotal, $format = '%02d:%02d') {
                  if ($sumtotal < 1) {
                      return;
                  }
                  $hours = floor($sumtotal / 60);
                  $minutes = ($sumtotal % 60);
                  return sprintf($format, $hours, $minutes);
              }
              echo convertToHoursMins($i, '%02d ช.ม %02d นาที');

            }else{
              echo $sumtotal."นาที";
            }

            ?>

          </td>
      </tr>
      <?php
 }
 mysqli_close($objCon);
?>

</table>
