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
	
		$payment_option = "cash";
	
	

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
		
		$payment_status = $_POST['payment_status'];
		
		
		//get parent name
		$sqlP = mysql_query("SELECT * FROM parent p, enrollment e
											WHERE p.username = e.parent
											AND e.ic = '$student_ic'");
		$rowP = mysql_fetch_array($sqlP);
		
		
																
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
												payment_status,
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
												'$payment_status',
												'$rowP[username]')");
				
			if($p_type_id == 1)
				echo "<script>window.alert('Thank You! Registration payment fee successfully recorded.'); window.location=('registration_payment.php')</script>";
			else
				echo "<script>window.alert('Thank You! Monthly payment fee successfully recorded.'); window.location=('monthly_payment.php')</script>";

			
			
	
	
	
}
?>