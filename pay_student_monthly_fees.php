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
?>

<!DOCTYPE html>
<html lang="en">
	<!-- head -->
	<?php include "layout/head.php";?>
	<style>
		.none {
			display:none;
		}
	</style>

	<body>
  		<div class="container-scroller">
    		<!-- partial:../../partials/_navbar.html -->
    		<?php include "layout/top.php";?>
	
    		<!-- partial -->
    		<div class="container-fluid page-body-wrapper">
      			<!-- partial:../../partials/_sidebar.html -->
       			<?php include "layout/menu.php";?>
	   
      			<!-- partial -->
      			<div class="main-panel">
        			<div class="content-wrapper">
         				<div class="row">
            				<div class="col-12 grid-margin">
								<?php
									date_default_timezone_set("Asia/Kuala_Lumpur");
									$today = date("Y-m-d");
									$currentYear = date("Y");
									
									//echo $currentYear;


									$displayPaymentForm = "no";

									if (isset($_POST['submit']))
									{
										$payment_date = $today;
										$student_ic = $_POST['student_ic'];
										$p_type_id = 2;
										$month = $_POST['month'];
										$year = $_POST['year'];
										$parent = $_SESSION['UserID'];

										/* PAPAR NAMA BULAN */
										if($month == 1)
											$month_name = "Jan";
										else if($month == 2)
											$month_name = "Feb";
										else if($month == 3)
											$month_name = "Mac";
										else if($month == 4)
											$month_name = "Apr";
										else if($month == 5)
											$month_name = "May";
										else if($month == 6)
											$month_name = "June";
										else if($month == 7)
											$month_name = "July";
										else if($month == 8)
											$month_name = "Aug";
										else if($month == 9)
											$month_name = "Sept";
										else if($month == 10)
											$month_name = "Oct";
										else if($month == 11)
											$month_name = "Nov";
										else if($month == 12)
											$month_name = "Dec";


										//child
										$sqlStd = mysql_query("SELECT * FROM enrollment WHERE ic = '$student_ic'");
										$rowStd = mysql_fetch_array($sqlStd);


										$sqlCheck = mysql_query("SELECT * FROM payment
																				WHERE student_ic = '$student_ic'
																				AND p_type_id = '$p_type_id'
																				AND month = '$month'
																				AND year = '$year'
																				AND payment_status != 'Declined'");


										$numRowCheck = mysql_fetch_array($sqlCheck);

										if($numRowCheck > 0)
										{
											echo "<div class='alert alert-danger alert-dismissible'>
													<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
													<strong>Sorry!</strong> You already submit payment for $month_name $year monthly fees for child $rowStd[name] .
												</div>";
										}
										else
										{
											$displayPaymentForm = "yes";
											$payment_date = $payment_date;
											$student_ic = $student_ic;
											$p_type_id = $p_type_id;
											$parent = $parent;

											
										}

									}
				  				?>
              				<div class="card">
                				<div class="card-body">
                  					<h4 class="card-title">Monthly Fees</h4>

                  					<form method="post" enctype="multipart/form-data">
                   					<p class="card-description text-primary">
                   					  <i class='menu-icon mdi mdi-google-wallet'></i> Fill in the following details
                   					</p>					
									<hr />
                    
                    				<div class="row">
									  	<div class="col-md-3">
											<div class="form-group">
												<label>Student</label>
												<select class="form-control" name="student_ic" required />
													<option value="">- choose student -</option>
													<?php
														$sqlStd = mysql_query("SELECT * FROM enrollment");
														while($rowStd = mysql_fetch_array($sqlStd))
														{
															if(($rowStd[status] == "Processing") || ($rowStd[status] == "Rejected"))
																echo "<option class='bg-danger text-white' value='$rowStd[ic]' disabled>$rowStd[name]</option>";
															else
																echo "<option value='$rowStd[ic]'>$rowStd[name]</option>";
														}
													?>
												</select>
											</div>
                    				  	</div>
									  	<div class="col-md-3">
											<div class="form-group">
												<label>Month</label>
												<select class="form-control" name="month" required />
													<option value=''>- choose month -</option>
													<option value='01'>January</option>
													<option value='02'>February</option>
													<option value='03'>March</option>
													<option value='04'>April</option>
													<option value='05'>May</option>
													<option value='06'>June</option>
													<option value='07'>July</option>
													<option value='08'>August</option>
													<option value='09'>September</option>
													<option value='10'>October</option>
													<option value='11'>November</option>
													<option value='12'>December</option>
												</select>
											</div>
                    				  	</div>
									  	<div class="col-md-3">
											<div class="form-group">
												<label>Year</label>
												<select class="form-control" name="year" required />
													<option value=''>- choose year -</option>
													<option value='2020'>2020</option>
													<option value='2021'>2021</option>
													<option value='2022'>2022</option>
													<option value='2023'>2023</option>
													<option value='2024'>2024</option>
													<option value='2025'>2025</option>
												</select>
											</div>
                    				 	</div>
                    				</div>
                    					<br />
                   						<button type="reset" class="btn btn-outline-dark"><i class="mdi mdi-refresh"></i> Reset</button>
										<button type="submit" name="submit" class="btn btn-primary mr-2"><i class="mdi mdi-arrow-right"></i> Proceed</button>
                					</form>
            					</div>
              				</div>
            			</div>
          			</div>
		  
		  			<?php
						if($displayPaymentForm == "yes")
						{
							$year = $_POST['year'];
							//get payment price
							$sqlPay = mysql_query("SELECT * FROM monthly_fee WHERE year = '$year'");
							$rowPay = mysql_fetch_array($sqlPay);
							
							if($rowPay[fee] == "")
							{
								echo "<div class='row'>
            
										<div class='col-12 grid-margin'>
										
										  <div class='card'>
											<div class='card-body'>
											  <h4 class='card-title'>Monthly Payment Details for Year $year</h4>
								
								
												<div class='alert alert-danger alert-dismissible'>
													<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
													<strong>Sorry!</strong> Monthly fee for year <b>$year</b> not yet being setup.
												</div>
											</div>
										  </div>
										</div>
									</div>";
							}
							else
							{
								echo "<div class='row'>
            
									<div class='col-12 grid-margin'>
									
									  <div class='card'>
										<div class='card-body'>
										  <h4 class='card-title'>Monthly Payment Details for Year $year</h4>

										  <form method='post' action='direct_payment_gateway.php' enctype='multipart/form-data'>
										  <input type='hidden' name='payment_date' value='$payment_date'>
										  <input type='hidden' name='student_ic' value='$student_ic'>
										  <input type='hidden' name='p_type_id' value='$p_type_id'>
										  <input type='hidden' name='month' value='$month'>
										  <input type='hidden' name='year' value='$year'>
										  <input type='hidden' name='parent' value='$parent'>
										  <input type='hidden' name='amount' value='$rowPay[fee]'>
													<div class='form-body'>
														<div class='row'>
													
															<div class='col-md-4'>
																<div class='form-group'>
																	<label>Amount need to pay <b>RM$rowPay[fee]</b>.</label>
																	<input type='number' class='form-control' placeholder='Amount parent willing to pay' name='paid_amount' required />
																</div>
															</div>
															<div class='col-md-4'>
																<div class='form-group'>
																	<label>Status</label>
																	<select name='payment_status' class='form-control' required>
																		<option value=''>- choose status -</option>
																		<option value='Partial Paid'>Partial Paid</option>
																		<option value='Paid'>Paid</option>
																	</select>
																</div>
															</div>
														</div>
													</div>
													
													
													
											
											
											<br />
											<a href='dashboard.php' class='btn btn-outline-dark'>
												<i class='mdi mdi-keyboard-backspace'></i> Cancel
											</a>
											<button type='submit' name='submit' class='btn btn-primary mr-2'><i class='mdi mdi-check'></i> Confirm</button>
										  </form>
										</div>
									  </div>
									</div>
								  </div>";
							}
									
							
							
						}
					?>				
        		</div>

        		<!-- content-wrapper ends -->
        		<!-- partial:../../partials/_footer.html -->
        		<?php include "layout/footer.php";?>
		
        	<!-- partial -->
      		</div>
      		<!-- main-panel ends -->
    		</div>
    		<!-- page-body-wrapper ends -->
  			</div>
  		<!-- container-scroller -->
  		<!-- plugins:js -->
  		<!-- SCRIPT -->
  		<?php include "layout/script.php";?>
   		<script>
			$("input[type='radio']").change(function(){
			
			if($(this).val()=="Online Banking")
			{
				$("#ob").show();
			}
			else
			{
				   $("#ob").hide(); 
			}

			if($(this).val()=="Cash")
			{
				$("#cc").show();
			}
			else
			{
				   $("#cc").hide(); 
			}

			});
		</script>
	
		<script>
			function ckChange(ckType){
				var ckName = document.getElementsByName(ckType.name);
				var checked = document.getElementById(ckType.id);
			
				if (checked.checked) {
				  for(var i=0; i < ckName.length; i++){
				
					  if(!ckName[i].checked){
						  ckName[i].disabled = true;
					  }else{
						  ckName[i].disabled = false;
					  }
				  } 
				}
				else {
				  for(var i=0; i < ckName.length; i++){
					ckName[i].disabled = false;
				  } 
				}    
			}
		</script>
	</body>
</html>
<?php } ?>