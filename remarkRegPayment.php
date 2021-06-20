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
	date_default_timezone_set("Asia/Kuala_Lumpur");
	$today = date("Y-m-d");
	
	$url = $_POST['url'];
	
	if($url == "dashboard")
		$link = "dashboard.php";
	else
		$link = "registration_payment.php";
		
		
	$payment_id = $_POST['payment_id'];
	$amount = $_POST['amount'];
	$existing_paid_amount = $_POST['existing_paid_amount'];
	$paid_amount = $_POST['paid_amount'];
	$new_paid_amount = 	$existing_paid_amount + $paid_amount ;
	$balance = $amount - $new_paid_amount;
	$payment_status = $_POST['payment_status'];
	
	
	
	//jika status Declined
	if($payment_status == "Declined")
	{
		$update = mysql_query("UPDATE payment SET payment_status = 'Declined' WHERE payment_id = '$payment_id'");
	}
	else
	{
		$update = mysql_query("UPDATE payment SET paid_amount = '$new_paid_amount',
												balance = '$balance',
												payment_status = '$payment_status'
												WHERE payment_id = '$payment_id'");
	}
	
	
	
	header('location:' . $link . '?act=display&payment_status=' . $payment_status . '&payment_id=' . $payment_id);
}

?>