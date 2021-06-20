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
	 <script>
	function getSubcat(val) {
		$.ajax({
		type: "POST",
		url: "get_country.php",
		data:'nat_id='+val,
		success: function(data){
			$("#country_id").html(data);
		}
		});
	}
	
	</script>

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
									if (isset($_POST['submit']))
									{
										$ic = $_POST['ic'];
										$name = $_POST['name'];
										$dob = $_POST['dob'];
										$gender_id = $_POST['gender_id'];
										$address = $_POST['address'];
										$purpose = $_POST['purpose'];
										$parent = $_SESSION['UserID'];

										$file_location 	= $_FILES['photo']['tmp_name'];
										$file_type		= $_FILES['photo']['type'];
										$file_name		= $_FILES['photo']['name'];

										move_uploaded_file($file_location,"photo/$file_name");


										$file_location_ic 	= $_FILES['ic_copy']['tmp_name'];
										$file_type_ic		= $_FILES['ic_copy']['type'];
										$file_ic_copy		= $_FILES['ic_copy']['name'];

										move_uploaded_file($file_location_ic,"ic/$file_ic_copy");
									
										$addStd = mysql_query("INSERT INTO enrollment (ic,
																						name,
																						dob,																						
																						gender_id,
																						photo,
																						address,
																						ic_copy,
																						purpose,
																						parent)
																				VALUES ('$ic',
																						'$name',
																						'$dob',
																						'$gender_id',
																						'$file_name',
																						'$address',
																						'$file_ic_copy',
																						'$purpose',
																						'$parent')");


										if($addStd == true)
										{
											$ic = "";
											$name = "";
											$dob = "";
											$gender_id = "";
											$address = "";
										
											echo "<div class='alert alert-success alert-dismissible'>
																		<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
																		<strong>Thank you for the registration! </strong> Please wait for Admin approval before proceeding to the registration fee payment.
													</div>";
										}
										else
											echo "<div class='alert alert-danger alert-dismissible'>
													<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
													<strong>Sorry!</strong> Student with IC $ic already registered.
												</div>";
									}
								?>

              					<div class="card">
                					<div class="card-body">
                  						<h4 class="card-title"><?php echo "Student Enrollment Form"; ?></h4>
                  						<form method="post" enctype="multipart/form-data">
				  							<input type="hidden" class="form-control" name="class_id" value="<?php echo $class_id; ?>" />
											<p class="card-description text-primary">
                     							<i class='menu-icon mdi mdi-verified'></i> Terms & Condition
                    						</p>
											<hr />
											<ul class="list-star text-danger">
												<li>Open for children ages 7 and above.</li>
												<li>Please make sure all fields are filled in correctly.</li>
												<li>After received your application, we will issue an Acceptance / Reject to the parents / guardians of the child involved.</li>
											</ul>					
											<br />					
                    						<p class="card-description text-primary">
                    						  <i class='menu-icon mdi mdi-account-box'></i> Children Details
                    						</p>														
											<hr />
                    						<div class="row">
                      							<div class="col-md-3">
													<div class="form-group">
														<label>IC/Passport (eg: 032012015482)</label>
														<input type="number" class="form-control" name="ic" value="<?php echo $ic; ?>" placeholder="Children IC" required />
													</div>
                      							</div>
					  							<div class="col-md-6">
													<div class="form-group">
														<label>Name</label>
														<input type="text" class="form-control" name="name" value="<?php echo $name; ?>" placeholder="Children Name" required />
													</div>
                    						  	</div>
                      							<div class="col-md-3">
													<div class="form-group">
														<label>D.O.B</label>
														<input type="date" class="form-control" name="dob" value="<?php echo $dob; ?>" placeholder="Children D.O.B" required />
													</div>
                     		 					</div>
                    						</div>                
                    						<div class="row">
					  							<div class="col-md-3">
													<div class="form-group">
														<label>Gender</label>
														<select class="form-control" name="gender_id" required />
															<option value="">- choose gender -</option>
															<?php
																$sqlGender = mysql_query("SELECT * FROM gender");
																while($rowGender = mysql_fetch_array($sqlGender))
																{
																	if($rowGender[gender_id] == $gender_id)
																		echo "<option value='$rowGender[gender_id]' selected>$rowGender[gender]</option>";
																	else
																		echo "<option value='$rowGender[gender_id]'>$rowGender[gender]</option>";
																}
															?>
														</select>
													</div>
                      							</div>
					  							
					  							<div class="col-md-3">
													<div class="form-group">
													<label>Photo</label>
													<input type="file" class="form-control" name="photo" placeholder="Photo" required />
												</div>
                      						</div>
                    					</div>
					
										<div class="row">
                      						<div class="col-md-12">
												<div class="form-group">
													<label>Address</label>
													<textarea class="form-control" name="address" rows="5" placeholder="Home address" required><?php echo $address; ?></textarea>
												</div>
                      						</div>
					 					</div>
					
										<hr />
										<p class="card-description text-primary">
                    			 			<i class="mdi mdi-attachment"></i> IC/Passport Attachment
                    					</p>
					
										<div class="row">
                      						<div class="col-md-6">
												<div class="form-group">
													<label>Copy of Children IC/Passport</label><br />
													<input type="file" class="form-control" name="ic_copy" placeholder="IC Copy" required />
												</div>
                      						</div>
                    					</div>
										<hr />
										<p class="card-description text-primary">
                    					  <i class="mdi mdi-check-circle"></i> Registration Purpose
                    					</p>																	
										<div class="row">
                    						<div class="col-md-3">
												<div class="form-group">
													<div class="form-check form-check-warning">
														<label class="form-check-label">
															<input type="radio" name="purpose" value="Tahfiz" class="form-check-input" required /> Tahfiz
														</label>
													</div>
												</div>
                    						</div>
										<div class="col-md-3">
											<div class="form-group">
												<div class="form-check form-check-warning">
													<label class="form-check-label">
														<input type="radio" name="purpose" value="SPM" class="form-check-input" /> SPM
													</label>
												</div>
											</div>
                    					</div>
										<div class="col-md-3">
											<div class="form-group">
												<div class="form-check form-check-warning">
													<label class="form-check-label">
														<input type="radio" name="purpose" value="Both" class="form-check-input" /> Both (Tahfiz & SPM)
													</label>
												</div>
											</div>
                    					</div>
                    				</div>
                    				<br />
                    				<button type="reset" class="btn btn-outline-dark"><i class="mdi mdi-refresh"></i> Reset</button>
												<button type="submit" name="submit" class="btn btn-primary mr-2"><i class="mdi mdi-check"></i> Register</button>
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
	</body>
</html>
<?php } ?>