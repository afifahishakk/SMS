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
										$parent = $_POST['parent'];

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
																						nationality_id,
																						country_id,
																						gender_id,
																						photo,
																						address,
																						ic_copy,
																						purpose,
																						status,
																						parent)
																				VALUES ('$ic',
																						'$name',
																						'$dob',
																						'$nationality_id',
																						'$country_id',
																						'$gender_id',
																						'$file_name',
																						'$address',
																						'$file_ic_copy',
																						'$purpose',
																						'Approved',
																						'$parent')");


										if($addStd == true)
										{
											$ic = "";
											$name = "";
											$dob = "";
											$nationality_id = "";
											$gender_id = "";
											$address = "";
										
											echo "<div class='alert alert-success alert-dismissible'>
																		<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
																		<strong>Thank you for the registration! </strong> New student information is added.
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
                     							<i class='menu-icon mdi mdi-account-box'></i> Student Details
                    						</p>					
											<hr />
                    						<div class="row">
                      							<div class="col-md-3">
													<div class="form-group">
														<label>Student IC</label>
														<input type="number" class="form-control" name="ic" value="<?php echo $ic; ?>" placeholder="Student IC" required />
													</div>
                      							</div>
					 							<div class="col-md-6">
													<div class="form-group">
														<label>Name</label>
														<input type="text" class="form-control" name="name" value="<?php echo $name; ?>" placeholder="Student Name" required />
													</div>
                      							</div>
                      							<div class="col-md-3">
													<div class="form-group">
														<label>D.O.B</label>
														<input type="date" class="form-control" name="dob" value="<?php echo $dob; ?>" placeholder="Student D.O.B" required />
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
					  						<!-- <div class="col-md-3">
												<div class="form-group">
													<label>Nationality</label>
													<select class="form-control" name="nationality_id" required />
														<option value="">- choose nationality -</option>
														<?php
															$sqlNationality = mysql_query("SELECT * FROM nationality");
															while($rowNationality = mysql_fetch_array($sqlNationality))
															{
																if($rowNationality[nationality_id] == $nationality_id)
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
														</select>
													</div>
                      							</div> -->
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
															
										<p class="card-description text-primary">
                      						<i class="mdi mdi-attachment"></i> IC Attachment
                    					</p>
															
										<div class="row">
                    					  	<div class="col-md-6">
												<div class="form-group">
													<label>Copy of Student IC</label><br />
													<input type="file" class="form-control" name="ic_copy" placeholder="IC Copy" required />
												</div>
                    					 	</div>
                    					</div>
															
										<p class="card-description text-primary">
                    					  <i class="mdi mdi-account-multiple"></i> Parent
                    					</p>
															
										<div class="row">
                    					  	<div class="col-md-6">
												<div class="form-group">
													<label>Parent</label><br />
													<select class="form-control" name="parent" required />
														<option value="">- choose parent -</option>
														<?php
															$sqlP= mysql_query("SELECT * FROM parent");
															while($rowP = mysql_fetch_array($sqlP))
															{
																if($rowP[username] == $parent)
																	echo "<option value='$rowP[username]' selected>$rowP[name]</option>";
																else
																	echo "<option value='$rowP[username]'>$rowP[name]</option>";
															}
														?>
													</select>
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