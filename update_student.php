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
										$nationality_id = $_POST['nationality_id'];
										$country_id = $_POST['country_id'];
										$gender_id = $_POST['gender_id'];
										$address = $_POST['address'];
										$purpose = $_POST['purpose'];
										$parent = $_SESSION['UserID'];

										$file_location 	= $_FILES['photo']['tmp_name'];
										$file_type		= $_FILES['photo']['type'];
										$file_name		= $_FILES['photo']['name'];

										


										$file_location_ic 	= $_FILES['ic_copy']['tmp_name'];
										$file_type_ic		= $_FILES['ic_copy']['type'];
										$file_ic_copy		= $_FILES['ic_copy']['name'];

										
										
										if ((empty($file_location)) && (empty($file_location_ic)))
										{
											$update = mysql_query("UPDATE enrollment SET name = '$name',
																						dob = '$dob',
																						nationality_id = '$nationality_id',
																						country_id = '$country_id',
																						gender_id = '$gender_id',
																						address = '$address',
																						purpose = '$purpose'
																						WHERE ic = '$ic'");
										}
										else if (empty($file_location))
										{
											move_uploaded_file($file_location_ic,"ic/$file_ic_copy");
											
											$update = mysql_query("UPDATE enrollment SET name = '$name',
																						dob = '$dob',
																						nationality_id = '$nationality_id',
																						country_id = '$country_id',
																						gender_id = '$gender_id',
																						address = '$address',
																						ic_copy = '$file_ic_copy',
																						purpose = '$purpose'
																						WHERE ic = '$ic'");
										}
										else if (empty($file_location_ic))
										{
											move_uploaded_file($file_location,"photo/$file_name");
											
											$update = mysql_query("UPDATE enrollment SET name = '$name',
																						dob = '$dob',
																						nationality_id = '$nationality_id',
																						country_id = '$country_id',
																						gender_id = '$gender_id',
																						photo = '$file_name',
																						address = '$address',
																						purpose = '$purpose'
																						WHERE ic = '$ic'");
										}
										else
										{
											move_uploaded_file($file_location,"photo/$file_name");
											move_uploaded_file($file_location_ic,"ic/$file_ic_copy");
											
											$update = mysql_query("UPDATE enrollment SET name = '$name',
																						dob = '$dob',
																						nationality_id = '$nationality_id',
																						country_id = '$country_id',
																						gender_id = '$gender_id',
																						photo = '$file_name',
																						address = '$address',
																						ic_copy = '$file_ic_copy',
																						purpose = '$purpose'
																						WHERE ic = '$ic'");
										}
									
										


										if($update == true)
										{
										
											echo "<div class='alert alert-success alert-dismissible'>
																		<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
																		<strong>Thank you!</strong> Student details successfully updated.
													</div>";
										}
										else
											echo "<div class='alert alert-danger alert-dismissible'>
													<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
													<strong>Sorry!</strong> Student error.
												</div>";
									}
									
									
									$ic = $_GET[ic];
									$sql = mysql_query("SELECT * FROM enrollment WHERE ic = '$ic'");
									$row = mysql_fetch_array($sql);
								?>

              					<div class="card">
                					<div class="card-body">
                  						<h4 class="card-title"><?php echo "Student Enrollment Form"; ?></h4>
                  						<form method="post" enctype="multipart/form-data">
				  							<input type="hidden" class="form-control" name="class_id" value="<?php echo $row[class_id]; ?>" />
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
                    						  <i class='menu-icon mdi mdi-account-box'></i> Student Details
                    						</p>														
											<hr />
                    						<div class="row">
                      							<div class="col-md-3">
													<div class="form-group">
														<label>IC/Passport (eg: 032012015482)</label>
														<input type="number" class="form-control" name="ic" value="<?php echo $row[ic]; ?>" placeholder="Student IC" readonly />
													</div>
                      							</div>
					  							<div class="col-md-6">
													<div class="form-group">
														<label>Name</label>
														<input type="text" class="form-control" name="name" value="<?php echo $row[name]; ?>" placeholder="Student Name" required />
													</div>
                    						  	</div>
                      							<div class="col-md-3">
													<div class="form-group">
														<label>D.O.B</label>
														<input type="date" class="form-control" name="dob" value="<?php echo $row[dob]; ?>" placeholder="Student D.O.B" required />
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
																	if($rowGender[gender_id] == $row[gender_id])
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
														<label>Nationality</label>
														<select class="form-control" name="nationality_id" onChange="getSubcat(this.value);" required />
															<option value="">- choose nationality -</option>
															<?php
																$sqlNationality = mysql_query("SELECT * FROM nationality");
																while($rowNationality = mysql_fetch_array($sqlNationality))
																{
																	if($rowNationality[nationality_id] == $row[nationality_id])
																		echo "<option value='$rowNationality[nationality_id]' selected>$rowNationality[nationality]</option>";
																	else
																		echo "<option value='$rowNationality[nationality_id]'>$rowNationality[nationality]</option>";
																}
															?>
														</select>
													</div>
                      							</div>
												<div class="col-md-3">
													<div class="form-group">
														<label>Country</label>
														<select class="form-control" name="country_id" id="country_id" required />
															<option value="">- choose country -</option>
															<?php
															$sqlCt = mysql_query("SELECT * FROM country WHERE country_id = '$row[country_id]'");
															while($rowCt = mysql_fetch_array($sqlCt))
															{
																if($rowCt[country_id] == $row[country_id])
																	echo "<option value='$rowCt[country_id]' selected>$rowCt[country]</option>";
																else
																	echo "<option value='$rowCt[country_id]'>$rowCt[country]</option>";
															}
															?>
														</select>
													</div>
                      							</div>
					  							<div class="col-md-3">
													<div class="form-group">
													<label>New Photo <span class="badge badge-warning">(if necessary)</span></label>
													<input type="file" class="form-control" name="photo" placeholder="Photo" />
												</div>
                      						</div>
                    					</div>
					
										<div class="row">
                      						<div class="col-md-12">
												<div class="form-group">
													<label>Address</label>
													<textarea class="form-control" name="address" rows="5" placeholder="Home address" required><?php echo $row[address]; ?></textarea>
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
													<label>Reupload Copy of Student IC/Passport <span class="badge badge-warning">(if necessary)</span></label>
													<input type="file" class="form-control" name="ic_copy" placeholder="IC Copy" />
												</div>
                      						</div>
                    					</div>
										<hr />
										<p class="card-description text-primary">
                    					  <i class="mdi mdi-check-circle"></i> Registration Purpose
                    					</p>
										
										<?php
											if($row[purpose] == "Tahfiz")
											{
												echo "<div class='row'>
														<div class='col-md-3'>
															<div class='form-group'>
																<div class='form-check form-check-warning'>
																	<label class='form-check-label'>
																		<input type='radio' name='purpose' value='Tahfiz' class='form-check-input' checked required /> Tahfiz
																	</label>
																</div>
															</div>
														</div>
													<div class='col-md-3'>
														<div class='form-group'>
															<div class='form-check form-check-warning'>
																<label class='form-check-label'>
																	<input type='radio' name='purpose' value='SPM' class='form-check-input' /> SPM
																</label>
															</div>
														</div>
													</div>
													<div class='col-md-3'>
														<div class='form-group'>
															<div class='form-check form-check-warning'>
																<label class='form-check-label'>
																	<input type='radio' name='purpose' value='Both' class='form-check-input' /> Both (Tahfiz & SPM)
																</label>
															</div>
														</div>
													</div>
												</div>";
											}
											else if($row[purpose] == "SPM")
											{
												echo "<div class='row'>
														<div class='col-md-3'>
															<div class='form-group'>
																<div class='form-check form-check-warning'>
																	<label class='form-check-label'>
																		<input type='radio' name='purpose' value='Tahfiz' class='form-check-input' checked /> Tahfiz
																	</label>
																</div>
															</div>
														</div>
													<div class='col-md-3'>
														<div class='form-group'>
															<div class='form-check form-check-warning'>
																<label class='form-check-label'>
																	<input type='radio' name='purpose' value='SPM' class='form-check-input' required /> SPM
																</label>
															</div>
														</div>
													</div>
													<div class='col-md-3'>
														<div class='form-group'>
															<div class='form-check form-check-warning'>
																<label class='form-check-label'>
																	<input type='radio' name='purpose' value='Both' class='form-check-input' /> Both (Tahfiz & SPM)
																</label>
															</div>
														</div>
													</div>
												</div>";
											}
											else if($row[purpose] == "Both")
											{
												echo "<div class='row'>
														<div class='col-md-3'>
															<div class='form-group'>
																<div class='form-check form-check-warning'>
																	<label class='form-check-label'>
																		<input type='radio' name='purpose' value='Tahfiz' class='form-check-input' checked /> Tahfiz
																	</label>
																</div>
															</div>
														</div>
													<div class='col-md-3'>
														<div class='form-group'>
															<div class='form-check form-check-warning'>
																<label class='form-check-label'>
																	<input type='radio' name='purpose' value='SPM' class='form-check-input' /> SPM
																</label>
															</div>
														</div>
													</div>
													<div class='col-md-3'>
														<div class='form-group'>
															<div class='form-check form-check-warning'>
																<label class='form-check-label'>
																	<input type='radio' name='purpose' value='Both' class='form-check-input' required /> Both (Tahfiz & SPM)
																</label>
															</div>
														</div>
													</div>
												</div>";
											}
										
										?>
										
                    				<br />
										<a href="enrollment_list.php" class="btn btn-outline-dark">
												<i class="mdi mdi-keyboard-backspace"></i> Back
											</a>
											<button type="submit" name="submit" class="btn btn-primary mr-2"><i class="mdi mdi-check"></i> Update</button>
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