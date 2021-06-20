<?php
include "conn/conn.php";
error_reporting(0);
session_start();
if (empty($_SESSION[UserID]) AND empty($_SESSION[Password]))
{
  		header('location:index.php');
}
else
{
	$nationality_id = intval($_POST['nat_id']);
	
	echo "<option value=''>- choose country -</option>";
	$sqlCt = mysql_query("SELECT * FROM country WHERE nationality_id = '$nationality_id'");
	while($rowCt = mysql_fetch_array($sqlCt))
	{
		echo "<option value='$rowCt[country_id]'>$rowCt[country]</option>";
	}
}
?>

