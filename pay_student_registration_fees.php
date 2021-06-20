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

									//get payment price
									$sqlPay = mysql_query("SELECT * FROM payment_type WHERE p_type_id = 1");
									$rowPay = mysql_fetch_array($sqlPay);


									$displayPaymentForm = "no";

									if (isset($_POST['submit']))
									{
										$payment_date = $today;
										$student_ic = $_POST['student_ic'];
										$p_type_id = 1;
										$parent = $_SESSION['UserID'];


										//child
										$sqlStd = mysql_query("SELECT * FROM student WHERE ic = '$student_ic'");
										$rowStd = mysql_fetch_array($sqlStd);


										$sqlCheck = mysql_query("SELECT * FROM payment
																				WHERE student_ic = '$student_ic'
																				AND p_type_id = '$p_type_id'
																				AND payment_status != 'Declined'");


										$numRowCheck = mysql_fetch_array($sqlCheck);

										if($numRowCheck > 0)
										{
											echo "<div class='alert alert-danger alert-dismissible'>
													<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
													<strong>Sorry!</strong> You already sent your child $rowStd[name] payment for registration fees.
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
                  						<h4 class="card-title">Registration Fees Timetable</h4>
                  						<div class="table-responsive">
                    						<table class="table table-bordered" role="grid">
                      							<thead>
                        							<tr class="table-primary">
                          								<th>No</th>
                          								<th>Perkara/Jenis Yuran</th>
                          								<th>RM</th>
                        							</tr>
                      							</thead>
                      							<tbody>
													<!-- display data untuk fee umum -->
													<?php
														$bilUmum = 1;
														$jumlahUmum = 0;
														$sqlUmum = mysql_query("SELECT * FROM registration_fee WHERE fee_category_id = 1");
														while($rowUmum = mysql_fetch_array($sqlUmum))
														{
															echo "<tr>
																	<td>$bilUmum</td>
																	<td>$rowUmum[fee_type]</td>
																	<td>$rowUmum[fee]</td>
																	</tr>";
															
															$jumlahUmum += $rowUmum[fee];
															$bilUmum++;
														}
														
													?>
													

													<tr>
														<td colspan="3" class="text-center">BARANG KEPERLUAN PELAJAR</td>
													</tr>

													<tr>
														<td colspan="3" class="text-center">a. Pelajar Lelaki</td>
													</tr>
													
													<!-- display data untuk fee pelaajr lelaki -->
													<?php
														$bilLelaki = 1;
														$jumlahLelaki = 0;
														$sqlLelaki = mysql_query("SELECT * FROM registration_fee WHERE fee_category_id = 2");
														while($rowLelaki = mysql_fetch_array($sqlLelaki))
														{
															echo "<tr>
																	<td>$bilLelaki</td>
																	<td>$rowLelaki[fee_type]</td>
																	<td>$rowLelaki[fee]</td>
																	</tr>";
															
															$jumlahLelaki += $rowLelaki[fee];
															$bilLelaki++;
														}
														
													?>

													

													<tr>
														<td colspan="3" class="text-center">b. Pelajar Perempuan</td>
													</tr>
													
													<!-- display data untuk fee pelaajr ppuan -->
													<?php
														$bilPP = 1;
														$jumlahPP = 0;
														$sqlPP = mysql_query("SELECT * FROM registration_fee WHERE fee_category_id = 3");
														while($rowPP = mysql_fetch_array($sqlPP))
														{
															echo "<tr>
																	<td>$bilPP</td>
																	<td>$rowPP[fee_type]</td>
																	<td>$rowPP[fee]</td>
																	</tr>";
															
															
															$jumlahPP += $rowPP[fee];
															$bilPP++;
														}
														
														
														/* jumlah keseluruhan */
														$jumlahKeseluruhan = $jumlahUmum + $jumlahLelaki + $jumlahPP;
														$jumlahKeseluruhanFormat = number_format($jumlahKeseluruhan, 2, '.', '');
														
													?>


													<tr>
														<td colspan="2" class="text-right">JUMLAH KESELURUHAN</td>
														<td><?php echo $jumlahKeseluruhanFormat; ?></td>
													</tr>

                    							</tbody>
                    						</table>
                  						</div>
                					</div>
              					</div>
            				</div>
          				</div>
		  
						<div class="row">
            				<div class="col-12 grid-margin">
								<div class="card">
									<div class="card-body">
										<h4 class="card-title">Choose Student & Payment Option</h4>
										<form method="post" action="direct_payment_gateway.php" enctype="multipart/form-data">
										<input type="hidden" name="payment_date" value="<?php echo $today; ?>">
										<input type="hidden" name="p_type_id" value="1">
										<input type="hidden" name="amount" value="<?php echo $jumlahKeseluruhan; ?>">
										<div class="form-body">									
											<p class="card-description text-primary">
												<i class='menu-icon mdi mdi-account-star'></i> Choose student
											</p>
											<div class="row">
												<div class="col-md-4">
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
											</div>
											<hr />
											<p class="card-description text-primary">
												<i class="menu-icon mdi mdi-google-wallet"></i> Payment Details
											</p>
										</div>
										<div id="ob">
											<div class="form-body">
												<div class="row">
													
													<div class="col-md-4">
														<div class="form-group">
															<label>Amount need to pay <b>RM<?php echo $jumlahKeseluruhanFormat; ?></b>.</label>
															<input type="number" class="form-control" placeholder="Amount parent willing to pay" name="paid_amount" required />
														</div>
													</div>
													<div class="col-md-4">
														<div class="form-group">
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
										</div>
																				
										<br />
										<a href="dashboard.php" class="btn btn-outline-dark">
											<i class="mdi mdi-keyboard-backspace"></i> Cancel
										</a>
										<button type="submit" name="submit" class="btn btn-primary mr-2"><i class="mdi mdi-check"></i> Confirm</button>
									</form>
								</div>
							</div>
						</div>
					</div>		
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