<?php
		$db_config=array(
    /*"host"=>"192.168.191.2",  // กำหนด host
    "user"=>"bk11252", // กำหนดชื่อ user
    "pass"=>"bk11252",   // กำหนดรหัสผ่าน
    "dbname"=>"hosxp",  // กำหนดชื่อฐานข้อมูล*/
		"host"=>"localhost",  // กำหนด host
    "user"=>"root", // กำหนดชื่อ user
    "pass"=>"",   // กำหนดรหัสผ่าน
    "dbname"=>"test",  // กำหนดชื่อฐานข้อมูล
    "charset"=>"utf8"  // กำหนด charset
);
$objCon = @new mysqli($db_config["host"], $db_config["user"], $db_config["pass"], $db_config["dbname"]);

if(mysqli_connect_error()) {
    die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
    exit;
}

$objCon->set_charset("utf8");
?>
