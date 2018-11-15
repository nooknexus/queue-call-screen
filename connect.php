<?php
		$db_config=array(
    /*"host"=>"192.168.191.2",  // กำหนด host
    "user"=>"bk11252", // กำหนดชื่อ user
    "pass"=>"bk11252",   // กำหนดรหัสผ่าน
    "dbname"=>"hosxp",*/  // กำหนดชื่อฐานข้อมูล
		"host"=>"192.168.199.80",  // กำหนด host
    "user"=>"sa", // กำหนดชื่อ user
    "pass"=>"sa",   // กำหนดรหัสผ่าน
    "dbname"=>"najan",  // กำหนดชื่อฐานข้อมูล
    "charset"=>"utf8"  // กำหนด charset
);
$objCon = @new mysqli($db_config["host"], $db_config["user"], $db_config["pass"], $db_config["dbname"]);

if(mysqli_connect_error()) {
    die('Connect Error (' . mysqli_connect_errno() . ') '. mysqli_connect_error());
    exit;
}

$objCon->set_charset("utf8");
?>
