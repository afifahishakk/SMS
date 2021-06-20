<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "db_sms";

mysql_connect($server,$username,$password) or die("Connection Failed");
mysql_select_db($database) or die("Database can't be open");
?>
