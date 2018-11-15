<?php
    include("..\connect.php");

    $sql = "SELECT count(tt.depq) total FROM (SELECT
            	q.depq,
            	q.fullname,
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
            ) tt where tt.xray = 0 or tt.lab = 0
            ";

    $query = mysqli_query($objCon, $sql);
    $result = mysqli_fetch_array($query, MYSQLI_ASSOC);
    echo "<b>รอ แล็ป/เอ็กส์เรย์ ทั้งหมด " .$result['total']. " คน</b>";
 ?>
