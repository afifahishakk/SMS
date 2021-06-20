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
	
		$payment_option = $_POST['payment_option'];
	
	

		// function utk	generate unique id
		$queryx_ = "SELECT * FROM payment ORDER BY payment_id DESC LIMIT 1";
		$queryx  = mysql_query($queryx_)or die(mysql_error());
		$fetchx  = mysql_fetch_array($queryx);

		if($fetchx[0]==NULL)
			$payment_id = "PAY00001";
		else
		{
			$patterns 	  = array("/[123456789].*/",);
			$replacements = '';
			$x= preg_replace($patterns, $replacements, $fetchx[0]);
			$x_= explode($x, $fetchx[0]);
			$nolast		= implode("",$x_);

			$newlast	= $nolast + 1;
			$length		= strlen($x);
			$initlength = strlen($nolast);
			$newlength  = strlen($newlast);
			$last		= substr($fetchx[0], -1);
			$zero		= substr($fetchx[0], 0, $length);
			
			if($newlength > $initlength)
				$zero = substr($zero, 0, -1);

			$payment_id  = $zero.$newlast;
		}

		$payment_date = $_POST['payment_date'];
		$student_ic = $_POST['student_ic'];
		$p_type_id = $_POST['p_type_id'];
		$month = $_POST['month'];
		$year = $_POST['year'];
		$parent = $_POST['parent'];
		$amount = $_POST['amount'];
		$paid_amount = $_POST['paid_amount'];
		$balance = $amount - $paid_amount;
		
		
		//upload payment proof function
		$lokasi_file 	= $_FILES['proof']['tmp_name'];
		$tipe_file		= $_FILES['proof']['type'];
		$nama_file		= $_FILES['proof']['name'];

		move_uploaded_file($lokasi_file,"proof/$nama_file");
		
		
																
		mysql_query("INSERT INTO payment (payment_id,
												payment_date,
												student_ic,
												p_type_id,
												month,
												year,
												payment_option,
												amount,
												paid_amount,
												balance,
												proof,
												parent) 
									VALUES ('$payment_id',
												'$payment_date',
												'$student_ic',
												'$p_type_id',
												'$month',
												'$year',
												'$payment_option',
												'$amount',
												'$paid_amount',
												'$balance',
												'$nama_file',
												'$parent')");
				
		
			echo "<script>window.alert('Your payment is processing... We will respond you ASAP. Thank You!'); window.location=('payment_history.php')</script>";

			
	
	
	
}
?>