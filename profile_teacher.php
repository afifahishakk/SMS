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
						$phone = $_POST['phone'];
						$gender_id = $_POST['gender_id'];
						$UserLvl = 2;
						
						/*new attribute*/
						$nationality_id = $_POST['nationality_id'];
						$type = $_POST['type'];
						$address = $_POST['address'];
						$marriage_status = $_POST['marriage_status'];
						$salary = $_POST['salary'];
						$ic_no = $_POST['ic_no'];
						
						$spouse_name = $_POST['spouse_name'];
						$spouse_email = $_POST['spouse_email'];
						$spouse_phone = $_POST['spouse_phone'];
						$spouse_occupation = $_POST['spouse_occupation'];
						$spouse_workplace_address = $_POST['spouse_workplace_address'];
						
									
						$file_location 	= $_FILES['photo']['tmp_name'];
						$file_type		= $_FILES['photo']['type'];
						$file_name		= $_FILES['photo']['name'];
						
						$ic_location 	= $_FILES['ic_attachment']['tmp_name'];
						$ic_type		= $_FILES['ic_attachment']['type'];
						$ic_name		= $_FILES['ic_attachment']['name'];
						
						if ((empty($file_location)) && (empty($ic_location)))
						{
							$sql = mysql_query("UPDATE teacher SET name = '$name',
																			email = '$email',
																			phone = '$phone',
																			gender_id = '$gender_id',
																			nationality_id = '$nationality_id',
																			type = '$type',
																			address = '$address',
																			marriage_status = '$marriage_status',
																			salary = '$salary',
																			ic_no = '$ic_no',
																			spouse_name = '$spouse_name',
																			spouse_email = '$spouse_email',
																			spouse_phone = '$spouse_phone',
																			spouse_occupation = '$spouse_occupation',
																			spouse_workplace_address = '$spouse_workplace_address'
																			WHERE username = '$username'");
						}
						else if (empty($file_location))
						{
							move_uploaded_file($ic_location,"ic/$ic_name");
							
							$sql = mysql_query("UPDATE teacher SET name = '$name',
																			email = '$email',
																			phone = '$phone',
																			gender_id = '$gender_id',
																			nationality_id = '$nationality_id',
																			type = '$type',
																			address = '$address',
																			marriage_status = '$marriage_status',
																			salary = '$salary',
																			ic_no = '$ic_no',
																			ic_attachment = '$ic_name',
																			spouse_name = '$spouse_name',
																			spouse_email = '$spouse_email',
																			spouse_phone = '$spouse_phone',
																			spouse_occupation = '$spouse_occupation',
																			spouse_workplace_address = '$spouse_workplace_address'
																			WHERE username = '$username'");
						}
						else if (empty($ic_location))
						{
							move_uploaded_file($file_location,"photo/$file_name");
							
							$sql = mysql_query("UPDATE teacher SET name = '$name',
																			email = '$email',
																			phone = '$phone',
																			gender_id = '$gender_id',
																			photo = '$file_name',
																			nationality_id = '$nationality_id',
																			type = '$type',
																			address = '$address',
																			marriage_status = '$marriage_status',
																			salary = '$salary',
																			ic_no = '$ic_no',
																			spouse_name = '$spouse_name',
																			spouse_email = '$spouse_email',
																			spouse_phone = '$spouse_phone',
																			spouse_occupation = '$spouse_occupation',
																			spouse_workplace_address = '$spouse_workplace_address'
																			WHERE username = '$username'");
						}
						else
						{
							move_uploaded_file($file_location,"photo/$file_name");
							move_uploaded_file($ic_location,"ic/$ic_name");
							
							$sql = mysql_query("UPDATE teacher SET name = '$name',
																			email = '$email',
																			phone = '$phone',
																			gender_id = '$gender_id',
																			photo = '$file_name',
																			nationality_id = '$nationality_id',
																			type = '$type',
																			address = '$address',
																			marriage_status = '$marriage_status',
																			salary = '$salary',
																			ic_no = '$ic_no',
																			ic_attachment = '$ic_name',
																			spouse_name = '$spouse_name',
																			spouse_email = '$spouse_email',
																			spouse_phone = '$spouse_phone',
																			spouse_occupation = '$spouse_occupation',
																			spouse_workplace_address = '$spouse_workplace_address'
																			WHERE username = '$username'");
						}
														
						if($sql == true)
						{
						
							echo "<div class='alert alert-success alert-dismissible'>
														<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
														<strong>Thank you!</strong> Your account is successfully updated.
									</div>";
						}
						else
							echo "<div class='alert alert-danger alert-dismissible'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>Sorry!</strong> error.
								</div>";
					}
					
					
					$username = $_SESSION[UserID];
					$sql = mysql_query("SELECT * FROM teacher WHERE username = '$username'");
					$row = mysql_fetch_array($sql);

			?>
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Update Profile</h4>

                  <form method="post" enctype="multipart/form-data">
                    <p class="card-description text-primary">
                      <i class="mdi mdi-account-box"></i> Update Profile Details
                    </p>
					
					<hr />
                    <div class="row">
                      <div class="col-md-3">
						<div class="form-group">
							<label>Teacher ID</label>
							<input type="text" class="form-control" name="username" value="<?php echo $row[username]; ?>" placeholder="Teacher ID" readonly />
						</div>
                      </div>
					  <div class="col-md-3">
						<div class="form-group">
							<label>Name</label>
							<input type="text" class="form-control" name="name" value="<?php echo $row[name]; ?>" placeholder="Name" required />
						</div>
                      </div>
					  <div class="col-md-3">
						<div class="form-group">
							<label>Email</label>
							<input type="email" class="form-control" name="email" value="<?php echo $row[email]; ?>" placeholder="Email Address" required />
						</div>
                      </div>
					  <div class="col-md-3">
						<div class="form-group">
							<label>Phone No.</label>
							<input type="number" class="form-control" name="phone" value="<?php echo $row[phone]; ?>" placeholder="Phone No." required />
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
							<label>New Photo <span class="badge badge-warning">(if necessary)</span></label>
							<input type="file" class="form-control" name="photo" placeholder="Photo" />
						</div>
                      </div>
					   <div class="col-md-3">
						<div class="form-group">
							<label>Nationality</label>
							<select class="form-control" name="nationality_id" required />
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
							<label>Teacher Type</label>
							<select class="form-control" name="type" required />
							<option value="">- choose type -</option>
							<?php
								
									if($row[type] == "Tahfiz")
									{
										echo "<option value='Tahfiz' selected>Tahfiz</option>";
										echo "<option value='Academic'>Academic</option>";
									}
									else if($row[type] == "Academic")
									{
										echo "<option value='Tahfiz'>Tahfiz</option>";
										echo "<option value='Academic' selected>Academic</option>";
									}
									else
									{
										echo "<option value='Tahfiz'>Tahfiz</option>";
										echo "<option value='Academic'>Academic</option>";
									}
									
								
							?>
							</select>
						</div>
                      </div>
                    </div>
					
						<div class="row">
                      <div class="col-md-12">
						<div class="form-group">
							<label>Home Address</label>
							<textarea class="form-control" name="address" rows="5" placeholder="Home Address" required><?php echo $row[address]; ?></textarea>
						</div>
                      </div>
                    </div>
					
					<div class="row">
                      <div class="col-md-3">
						<div class="form-group">
							<label>Status</label>
							<input type="text" class="form-control" name="marriage_status" value="<?php echo $row[marriage_status]; ?>" placeholder="Marriage Status" required />
						</div>
                      </div>
					  <div class="col-md-3">
						<div class="form-group">
							<label>Salary</label>
							<input type="number" step="0.01" class="form-control" name="salary" value="<?php echo $row[salary]; ?>" placeholder="Salary" required />
						</div>
                      </div>
					  <div class="col-md-3">
						<div class="form-group">
							<label>IC No.</label>
							<input type="number" class="form-control" name="ic_no" value="<?php echo $row[ic_no]; ?>" placeholder="IC No." required />
						</div>
                      </div>
					  <div class="col-md-3">
						<div class="form-group">
							<label>Reupload ic <span class="badge badge-warning">(if necessary)</span></label>
							<input type="file" class="form-control" name="ic_attachment" placeholder="IC Attachment" />
						</div>
                      </div>
                    </div>
					
					<hr />
					<p class="card-description text-primary">
                      <i class="mdi mdi-heart"></i> Spouse Details <span class="badge badge-warning">(for status married only)</span>
                    </p>
					
					<div class="row">
                      <div class="col-md-3">
						<div class="form-group">
							<label>Spouse Name</label>
							<input type="spouse_name" class="form-control" name="spouse_name" value="<?php echo $row[spouse_name]; ?>" placeholder="Spouse Name" />
						</div>
                      </div>
					  <div class="col-md-3">
						<div class="form-group">
							<label>Email</label>
							<input type="email" class="form-control" name="spouse_email" value="<?php echo $row[spouse_email]; ?>" placeholder="Email" />
						</div>
                      </div>
					  <div class="col-md-3">
						<div class="form-group">
							<label>Phone No.</label>
							<input type="number" class="form-control" name="spouse_phone" value="<?php echo $row[spouse_phone]; ?>" placeholder="Phone No." />
						</div>
                      </div>
					  
					  <div class="col-md-3">
						<div class="form-group">
							<label>Occupation</label>
							<input type="text" class="form-control" name="spouse_occupation" value="<?php echo $row[spouse_occupation]; ?>" placeholder="Spouse Occupation" />
						</div>
                      </div>
                    </div>
					
						<div class="row">
                      <div class="col-md-12">
						<div class="form-group">
							<label>Workplace Address</label>
							<textarea class="form-control" name="spouse_workplace_address" rows="5" placeholder="Workplace Address" ><?php echo $row[spouse_workplace_address]; ?></textarea>
						</div>
                      </div>
                    </div>
					
				
                    
                    
                    <br />
                    <button type="reset" class="btn btn-outline-dark"><i class="mdi mdi-refresh"></i> Reset</button>
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
<?php
}
?>