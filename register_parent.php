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
					$username = "";
					if (isset($_POST['submit']))
					{
						
						$username = $_POST['username'];
						$name = $_POST['name'];
						$email = $_POST['email'];
						$phone_no = $_POST['phone_no'];
						$gender_id = $_POST['gender_id'];
						
						/* new attribute */
						$address = $_POST['address'];
						$occupation = $_POST['occupation'];
						$salary = $_POST['salary'];
						$relationship_id = $_POST['relationship_id'];
						
						$addLogin = mysql_query("INSERT INTO login (UserID, Password, UserLvl)
															VALUES ('$username', '$username', '4')");
										
						if($addLogin == true)
						{
							// upload photo
							$file_location 	= $_FILES['photo']['tmp_name'];
							$file_type		= $_FILES['photo']['type'];
							$photo_name		= $_FILES['photo']['name'];
							
							move_uploaded_file($file_location,"photo/$photo_name");
							
							// upload ic
							$file_location 	= $_FILES['ic_attachment']['tmp_name'];
							$file_type		= $_FILES['ic_attachment']['type'];
							$ic_name		= $_FILES['ic_attachment']['name'];
							
							move_uploaded_file($file_location,"ic/$ic_name");
												
							$addParent = mysql_query("INSERT INTO parent (username,
																					name,
																					gender_id,
																					phone_no,
																					email,
																					photo,
																					address,
																					occupation,
																					salary,
																					relationship_id,
																					ic_attachment)
																			VALUES ('$username',
																					'$name',
																					'$gender_id',
																					'$phone_no',
																					'$email',
																					'$photo_name',
																					'$address',
																					'$occupation',
																					'$salary',
																					'$relationship_id',
																					'$ic_name')");
															
							
							if($addParent == true)
							{
								$username = "";
								$name = "";
								$gender_id = "";
								$phone_no = "";
								$email = "";
								$password = "";
								$cpassword = "";
								$address = "";
								$occupation = "";
								$salary = "";
								$relationship_id = "";
								
								echo "<div class='alert alert-success alert-dismissible'>
															<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
															<strong>Thank you!</strong> Parent account successfully created.
										</div>";
							}
							
							
							
						}
						else
							echo "<div class='alert alert-danger alert-dismissible'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>Sorry!</strong> Username $username already being used.
								</div>";
					}

			?>
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Register Parent</h4>

                  <form method="post" enctype="multipart/form-data">
                    <p class="card-description text-primary">
                      <i class="mdi mdi-account-box"></i> Add Parent Details
                    </p>
					<hr />
                    <div class="row">
                      <div class="col-md-6">
						<div class="form-group">
							<label>Parent ID</label>
							<input type="text" class="form-control" name="username" value="<?php echo $username; ?>" placeholder="Parent ID" required />
						</div>
                      </div>
					  <div class="col-md-6">
						<div class="form-group">
							<label>Name</label>
							<input type="text" class="form-control" name="name" value="<?php echo $name; ?>" placeholder="Name" required />
						</div>
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-md-3">
						<div class="form-group">
							<label>Email</label>
							<input type="email" class="form-control" name="email" value="<?php echo $email; ?>" placeholder="Email Address" required />
						</div>
                      </div>
					  <div class="col-md-3">
						<div class="form-group">
							<label>Phone No.</label>
							<input type="number" class="form-control" name="phone_no" value="<?php echo $phone_no; ?>" placeholder="Phone No." required />
						</div>
                      </div>
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
							<label>Home Address</label>
							<textarea class="form-control" name="address" rows="5" placeholder="Home Address" required><?php echo $address; ?></textarea>
						</div>
                      </div>
                    </div>
					
					<div class="row">
                      <div class="col-md-3">
						<div class="form-group">
							<label>Occupation</label>
							<input type="text" class="form-control" name="occupation" value="<?php echo $occupation; ?>" placeholder="Occupation" required />
						</div>
                      </div>
					  <div class="col-md-3">
						<div class="form-group">
							<label>Salary</label>
							<input type="number" step="0.01" class="form-control" name="salary" value="<?php echo $salary; ?>" placeholder="Salary" required />
						</div>
                      </div>
					  <div class="col-md-3">
						<div class="form-group">
							<label>Relationship</label>
							<select class="form-control" name="relationship_id" required />
							<option value="">- choose relationship -</option>
							<?php
								$sqlRel = mysql_query("SELECT * FROM relationship");
								while($rowRel = mysql_fetch_array($sqlRel))
								{
									if($rowRel[relationship_id] == $relationship_id)
										echo "<option value='$rowRel[relationship_id]' selected>$rowRel[relationship]</option>";
									else
										echo "<option value='$rowRel[relationship_id]'>$rowRel[relationship]</option>";
								}
							?>
							</select>
						</div>
                      </div>
					  <div class="col-md-3">
						<div class="form-group">
							<label>IC Attachment</label>
							<input type="file" class="form-control" name="ic_attachment" placeholder="IC Attachment" required />
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
<?php
}
?>