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

									//get payment price
									$sqlPay = mysql_query("SELECT * FROM monthly_fee WHERE year = '$currentYear'");
									$rowPay = mysql_fetch_array($sqlPay);

									$displayPaymentForm = "no";

									if (isset($_POST['submit']))
									{
										


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

											echo "<div class='alert alert-success alert-dismissible'>
													<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
													<strong>Please</strong> proceed with the payment below.
												</div>";
										}

									}
				  				?>
              				<div class="card">
                				<div class="card-body">
                  					<h4 class="card-title">Monthly Fees</h4>

                  					<form method="post" enctype="multipart/form-data">
                   					<p class="card-description text-primary">
                   					  <i class='menu-icon mdi mdi-account-star'></i> Fill in the following details
                   					</p>					
									<hr />
                    
                    				<div class="row">
									  	<div class="col-md-3">
											<div class="form-group">
												<label>Child</label>
												<select class="form-control" name="student_ic" required />
													<option value="">- choose your child -</option>
													<?php
														$sqlStd = mysql_query("SELECT * FROM enrollment WHERE parent = '$_SESSION[UserID]'");
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
							echo "<div class='row'>
            
									<div class='col-12 grid-margin'>
									
									  <div class='card'>
										<div class='card-body'>
										  <h4 class='card-title'>Payment Option</h4>

										  <form method='post' action='payment_gateway.php' enctype='multipart/form-data'>
										  <input type='text' name='payment_date' value='$payment_date'>
										  <input type='text' name='student_ic' value='$student_ic'>
										  <input type='text' name='p_type_id' value='$p_type_id'>
										  <input type='text' name='month' value='$month'>
										  <input type='text' name='year' value='$year'>
										  <input type='text' name='parent' value='$parent'>
										  <input type='text' name='amount' value='$rowPay[fee]'>
													<div class='form-body'>
														<p class='card-description text-primary'>
														<i class='menu-icon mdi mdi-google-wallet'></i> Choose payment option
														</p>
														<div class='row'>
															<div class='col-md-3'>
																<div class='form-group'>
																  <div class='form-radio'>
																	<label class='form-check-label'>
																	  <input type='radio' class='form-check-input' data-id='cc' name='payment_option' value='Cash'> Cash
																	</label>
																  </div>
																</div>
															</div>
															<div class='col-md-3'>
																<div class='form-group'>
																  <div class='form-radio'>
																	<label class='form-check-label'>
																	  <input type='radio' class='form-check-input' data-id='ob' name='payment_option' value='Online Banking' required> Online Banking
																	</label>
																  </div>
																</div>
															</div>
														</div>
													</div>
													<hr />
													<div id='ob' class='none'>
														<div class='form-body'>
															<div class='row'>
																<div class='col-md-4'>
																	<div class='form-group'>
																		<label>Transfer/Bank in <b>RM$rowPay[fee] Monthly Fees</b> or any amount you willing to pay to the following account:</label><br />
																		<span class='badge badge-primary'>Holder Name : PTSDI SDN BHD</span><br />
																		<span class='badge badge-warning'>Account Number : 771237765777</span>
																	</div>
																</div>
																<div class='col-md-4'>
																	<div class='form-group'>
																		<label>Amount</label>
																		<input type='number' class='form-control' placeholder='Amount you willing to pay' name='paid_amount' />
																	</div>
																</div>
																<div class='col-md-4'>
																	<div class='form-group'>
																		<label>Upload payment proof</label>
																		<input type='file' class='form-control' style='padding: 0.36rem 0.55rem;' placeholder='Upload payment proof' name='proof' />
																	</div>
																</div>
															</div>
														</div>
														
														
													
													</div>
													
													
													
													<div id='cc' class='none'>
														<div class='form-body'>
															<div class='row'>
																<div class='col-md-6'>
																	<div class='form-group'>
																		<label class='text-danger'>Please provide total amount of <b>RM$rowPay[fee]</b> or any amount you willing to pay once you visit our Tahfiz to complete the registration payment. Thank you</label><br />
																	</div>
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