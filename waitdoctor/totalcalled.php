<?php
    require("../connect.php");

    $sql = "SELECT
          	COUNT( vn ) as total
          FROM
          	ovst_queue_server
          WHERE
          	STATUS = 2
          	AND CONCAT( SUBSTRING( YEAR ( CURRENT_DATE ( ) ) + 543, 3, 2 ), DATE_FORMAT( CURRENT_DATE, '%m%d' ) ) = SUBSTRING( vn, 1, 6 )
          	AND stationno IS NOT NULL";

    $query = mysqli_query($objCon, $sql);
    $result = mysqli_fetch_array($query, MYSQLI_ASSOC);
    echo "<b>ทั้งหมด " .$result['total']. " คน</b>";
    mysqli_close($objCon);
 ?>
