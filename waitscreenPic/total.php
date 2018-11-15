<?php
    include("../connect.php");

    $sql = "SELECT
          	COUNT( vn ) as total
          FROM
          	ovst_queue_server
          WHERE
          	STATUS = 1
          	AND CONCAT( SUBSTRING( YEAR ( CURRENT_DATE ( ) ) + 543, 3, 2 ), DATE_FORMAT( CURRENT_DATE, '%m%d' ) ) = SUBSTRING( vn, 1, 6 )
          	AND stationno IS NULL";

    $query = mysqli_query($objCon, $sql);
    $result = mysqli_fetch_array($query, MYSQLI_ASSOC);
    echo "<b>ขณะนี้มีผู้รอคิวทั้งสิ้น " .$result['total']. " คน</b>";
 ?>
