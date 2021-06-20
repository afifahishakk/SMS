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
						
						// upload photo
						$photo_location	= $_FILES['photo']['tmp_name'];
						$photo_type		= $_FILES['photo']['type'];
						$photo_name		= $_FILES['photo']['name'];
						
						// upload ic
						$ic_location 	= $_FILES['ic_attachment']['tmp_name'];
						$ic_type		= $_FILES['ic_attachment']['type'];
						$ic_name		= $_FILES['ic_attachment']['name'];
						
						if ((empty($photo_location)) && (empty($ic_location)))
						{
							$sql = mysql_query("UPDATE parent SET name = '$name',
																			email = '$email',
																			phone_no = '$phone_no',
																			gender_id = '$gender_id',
																			address = '$address',
																			occupation = '$occupation',
																			salary = '$salary',
																			relationship_id = '$relationship_id'
																			WHERE username = '$username'");
						}
						else if (empty($photo_location))
						{
							move_uploaded_file($ic_location,"ic/$ic_name");
							
							$sql = mysql_query("UPDATE parent SET name = '$name',
																			email = '$email',
																			phone_no = '$phone_no',
																			gender_id = '$gender_id',
																			address = '$address',
																			occupation = '$occupation',
																			salary = '$salary',
																			relationship_id = '$relationship_id',
																			ic_attachment = '$ic_name'
																			WHERE username = '$username'");
						}
						else if (empty($ic_location))
						{
							move_uploaded_file($file_location,"photo/$file_name");
							
							$sql = mysql_query("UPDATE parent SET name = '$name',
																			email = '$email',
																			phone_no = '$phone_no',
																			gender_id = '$gender_id',
																			photo = '$photo_name',
																			address = '$address',
																			occupation = '$occupation',
																			salary = '$salary',
																			relationship_id = '$relationship_id'
																			WHERE username = '$username'");
						}
						else
						{
							move_uploaded_file($file_location,"photo/$file_name");
							move_uploaded_file($file_location,"ic/$ic_name");
							
							$sql = mysql_query("UPDATE parent SET name = '$name',
																			email = '$email',
																			phone_no = '$phone_no',
																			gender_id = '$gender_id',
																			photo = '$photo_name',
																			address = '$address',
																			occupation = '$occupation',
																			salary = '$salary',
																			relationship_id = '$relationship_id',
																			ic_attachment = '$ic_name'
																			WHERE username = '$username'");
						}
						
						
						
						if($sql == true)
						{
						
							echo "<div class='alert alert-success alert-dismissible'>
														<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
														<strong>Thank you!</strong> Parent account is successfully updated.
									</div>";
						}
						else
							echo "<div class='alert alert-danger alert-dismissible'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>Sorry!</strong> error.
								</div>";
					}
					
					$username = $_GET['username'];
					$sql = mysql_query("SELECT * FROM parent WHERE username = '$username'");
					$row = mysql_fetch_array($sql);

			?>
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Update Parent</h4>

                  <form method="post" enctype="multipart/form-data">
                    <p class="card-description text-primary">
                      <i class="mdi mdi-account-box"></i> Update Parent Details
                    </p>
					<hr />
                    <div class="row">
                      <div class="col-md-6">
						<div class="form-group">
							<label>Parent ID</label>
							<input type="text" class="form-control" name="username" value="<?php echo $row[username]; ?>" placeholder="Parent ID" readonly />
						</div>
                      </div>
					  <div class="col-md-6">
						<div class="form-group">
							<label>Name</label>
							<input type="text" class="form-control" name="name" value="<?php echo $row[name]; ?>" placeholder="Name" required />
						</div>
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-md-3">
						<div class="form-group">
							<label>Email</label>
							<input type="email" class="form-control" name="email" value="<?php echo $row[email]; ?>" placeholder="Email Address" required />
						</div>
                      </div>
					  <div class="col-md-3">
						<div class="form-group">
							<label>Phone No.</label>
							<input type="number" class="form-control" name="phone_no" value="<?php echo $row[phone_no]; ?>" placeholder="Phone No." required />
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
							<label>New Photo <span class="badge badge-warning">(if any)</span></label>
							<input type="file" class="form-control" name="photo" placeholder="Photo" />
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
							<label>Occupation</label>
							<input type="text" class="form-control" name="occupation" value="<?php echo $row[occupation]; ?>" placeholder="Occupation" required />
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
							<label>Relationship</label>
							<select class="form-control" name="relationship_id" required />
							<option value="">- choose relationship -</option>
							<?php
								$sqlRel = mysql_query("SELECT * FROM relationship");
								while($rowRel = mysql_fetch_array($sqlRel))
								{
									if($rowRel[relationship_id] == $row[relationship_id])
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
							<label>Reupload ic <span class="badge badge-warning">(if necessary)</span></label>
							<input type="file" class="form-control" name="ic_attachment" placeholder="IC Attachment" />
						</div>
                      </div>
                    </div>
                   
                    
                    
                    <br />
					<a href="manage_parent.php" class="btn btn-outline-dark">
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
<?php
}
?>