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
			
				  
						$displayPaymentForm = "no";
					
						if (isset($_POST['submit']))
						{
							$payment_date = $today;
							$std_ic = $_POST['std_ic'];
							$p_type_id = $_POST['p_type_id'];
							$parent = $_SESSION['UserID'];
							
							
							$sqlCheck = mysql_query("SELECT * FROM booking
																	WHERE package_id = '$package_id'
																	AND booking_date = '$booking_date'
																	AND slot_id = '$slot_id'
																	AND barber_id = '$barber_id'
																	AND booking_status != 'Cancelled'
																	AND booking_status != 'Completed'");
							
							
							$numRowCheck = mysql_fetch_array($sqlCheck);
							
							if($numRowCheck > 0)
							{
								echo "<div class='alert alert-danger alert-dismissible'>
										<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
										<strong>Sorry!</strong> Choice overlaped.
									</div>";
							}
							else
							{
								$displayPaymentForm = "yes";
								$std_ic = $std_ic;
								$booking_date = $booking_date;
								$slot_id = $slot_id;
								$barber_id = $barber_id;
								
								echo "<div class='alert alert-success alert-dismissible'>
										<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
										<strong>Please</strong> proceed with the payment below.
									</div>";
							}
								
						}
				  ?>
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Student Payment</h4>

                  <form method="post" enctype="multipart/form-data">
                    <p class="card-description text-primary">
                      <i class='menu-icon mdi mdi-account-star'></i> Choose child & payment type
                    </p>
					
					<hr />
                    
                    <div class="row">
					  <div class="col-md-6">
						<div class="form-group">
							<label>Child</label>
							<select class="form-control" name="std_ic" required />
							<option value="">- choose your child -</option>
							<?php
								$sqlStd = mysql_query("SELECT * FROM student WHERE parent = '$_SESSION[UserID]'");
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
					  <div class="col-md-6">
						<div class="form-group">
							<label>Payment For</label>
							<select class="form-control" name="p_type_id" required />
							<option value="">- choose payment type -</option>
							<?php
								$sqlPType = mysql_query("SELECT * FROM payment_type");
								while($rowPType = mysql_fetch_array($sqlPType))
								{
									if($rowPType[p_type_id] == $p_type_id)
										echo "<option value='$rowPType[p_type_id]'>$rowPType[p_type] (RM$rowPType[price])</option>";
									else
										echo "<option value='$rowPType[p_type_id]'>$rowPType[p_type] (RM$rowPType[price])</option>";
								}
							?>
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
										  <input type='hidden' name='package_id' value='$package_id'>
										  <input type='hidden' name='booking_date' value='$booking_date'>
										  <input type='hidden' name='slot_id' value='$slot_id'>
										  <input type='hidden' name='barber_id' value='$barber_id'>
													<div class='form-body'>
														<p class='card-description text-primary'>
														<i class='menu-icon mdi mdi-google-wallet'></i> Choose payment option
														</p>
														<div class='row'>
															<div class='col-md-4'>
																<div class='form-group'>
																  <div class='form-radio'>
																	<label class='form-check-label'>
																	  <input type='radio' class='form-check-input' data-id='dm' name='payment_option' value='Cash Deposit' required> Cash Deposit
																	</label>
																  </div>
																</div>
															</div>
															<div class='col-md-4'>
																<div class='form-group'>
																  <div class='form-radio'>
																	<label class='form-check-label'>
																	  <input type='radio' class='form-check-input' data-id='cc' name='payment_option' value='Credit Card'> Credit Card
																	</label>
																  </div>
																</div>
															</div>
														</div>
													</div>
													<hr />
													<div id='dm' class='none'>
														<div class='form-body'>
															<div class='row'>
																<div class='col-md-4'>
																	<div class='form-group'>
																		<label>Transfer/Bank in stated amount to</label><br />
																		<span class='badge badge-info'>Holder Name : AMMAR BARBER SDN BHD</span><br />
																		<span class='badge badge-danger'>Account Number : 551230065555</span>
																	</div>
																</div>
																<div class='col-md-4'>
																	<div class='form-group'>
																		<label>Upload payment proof</label>
																		<input type='file' class='form-control' placeholder='Upload payment proof' name='proof' />
																	</div>
																</div>
															</div>
														</div>
														
														
													
													</div>
													
													
													
													<div id='cc' class='none'>
														<span class='badge badge-danger'>**You will be redirected to credit card payment gateway.</span>
													</div>
											
											
											<br />
											<a href='dashboard.php' class='btn btn-secondary'>
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
   
	if($(this).val()=="Cash Deposit")
	{
		$("#dm").show();
	}
	else
	{
		   $("#dm").hide(); 
	}
	
	if($(this).val()=="Credit Card")
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
<?php
}
?>