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
		   
				$ic = $_GET['ic'];
				$sql = mysql_query("SELECT * FROM enrollment WHERE ic = '$ic'");
				$row = mysql_fetch_array($sql);
				
				
				
				$act=$_GET['act'];
				
				if($act == "approved")
				{
						
						$ic = $_GET[ic];
						$setStatus = mysql_query("UPDATE enrollment SET status = 'Approved' WHERE ic = '$ic'");
						
						if($setStatus == true)
						{
							echo "<div class='alert alert-success alert-dismissible'>
										<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
										<strong>Thank you!</strong> Student enrollment successfully approved.
								 </div>";
						}
				}
				else if($act == "reject")
				{
						
						$ic = $_GET[ic];
						$class_id = $_GET[class_id];
						
						$setStatus = mysql_query("UPDATE enrollment SET status = 'Rejected' WHERE ic = '$ic'");
						
						$updateAvailability = mysql_query("UPDATE classes SET availability = (availability + 1) WHERE class_id = '$class_id'");
						
						if($setStatus == true)
						{
							echo "<div class='alert alert-danger alert-dismissible'>
										<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
										<strong>Sorry!</strong> Student enrollment was rejected.
								 </div>";
						}
				}
				
				if($_SESSION[UserLvl] != 4)
				{
					if($row[status] == "Processing")
					{
						$displayAction = "<a href='enrollment_details.php?act=approved&ic=$row[ic]' class='btn btn-primary float-right mt-4 ml-2'><i class='mdi mdi-check'></i> Approve</a>
											<a href='enrollment_details.php?act=reject&ic=$row[ic]&class_id=$rowClass[class_id]' class='btn btn-danger float-right mt-4 ml-2'><i class='mdi mdi-alert-outline'></i> Reject</a>
											";
					}
					else
					{
						$displayAction = "<button class='btn btn-primary float-right mt-4 ml-2' disabled><i class='mdi mdi-check'></i> Approve</button>
											<button  class='btn btn-danger float-right mt-4 ml-2' disabled><i class='mdi mdi-alert-outline'></i> Reject</button>
											";
					}
				}
				
				
				
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
						<li>Children with Malaysian Citizen status only.</li>
						<li>Open for children ages 13 to 17 years.</li>
						<li>We will issue an Acceptance / Reject to the parents / guardians of the child involved.</li>
					</ul>
					
					<br />
					
                    <p class="card-description text-primary">
                      <i class='menu-icon mdi mdi-account-box'></i> Children Details
                    </p>
					
					<hr />
                    <div class="row">
                      <div class="col-md-4">
						<div class="form-group">
							<label>Children IC</label>
							<input type="number" class="form-control" name="ic" value="<?php echo $row[ic]; ?>" placeholder="Children IC" readonly />
						</div>
                      </div>
					  <div class="col-md-4">
						<div class="form-group">
							<label>Name</label>
							<input type="text" class="form-control" name="name" value="<?php echo $row[name]; ?>" placeholder="Children Name" readonly />
						</div>
                      </div>
                      <div class="col-md-4">
						<div class="form-group">
							<label>D.O.B</label>
							<input type="date" class="form-control" name="dob" value="<?php echo $row[dob]; ?>" placeholder="Children D.O.B" readonly />
						</div>
                      </div>
                    </div>
                    
                    <div class="row">
					  <div class="col-md-4">
						<div class="form-group">
							<label>Gender</label>
							<select class="form-control" name="gender_id" disabled />
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
					  <div class="col-md-4">
						<div class="form-group">
							<label>Nationality</label>
							<select class="form-control" name="nationality_id" disabled />
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
					  <div class="col-md-4">
						<div class="form-group">
							<label>Country</label>
							<select class="form-control" name="country_id" disabled />
							<option value="">- choose country -</option>
							<?php
								$sqlCt = mysql_query("SELECT * FROM country");
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
                    </div>
					
					<div class="row">
                      <div class="col-md-12">
						<div class="form-group">
							<label>Address</label>
							<textarea class="form-control" name="address" rows="5" placeholder="Home address" readonly><?php echo $row[address]; ?></textarea>
						</div>
                      </div>
					 </div>
					
					<hr />
					<p class="card-description text-primary">
                      <i class="mdi mdi-attachment"></i> IC Attachment
                    </p>
					
					<div class="row">
                      <div class="col-md-6">
						<div class="form-group">
							<label>Copy of Child IC</label><br />
							<p class="font-small-3">
								<?php
									echo "<a href='#modal' data-toggle='modal' data-target='#details$row[ic]' title='view ic'>
											View
											</a>";
								
									/* popup modal untuk melihat ic anak/student */
									include "modal_view_child_ic.php";
								?>
							</p>
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
								<?php
									if($row[purpose] == "Tahfiz")
										echo "<input type='radio' name='purpose' value='Tahfiz' class='form-check-input' checked readonly /> Tahfiz";
									else if($row[purpose] == "SPM")
										echo "<input type='radio' name='purpose' value='SPM' class='form-check-input' checked readonly /> SPM";
									else if($row[purpose] == "Both")
										echo "<input type='radio' name='purpose' value='Both' class='form-check-input' checked readonly /> Both (Tahfiz & SPM)";
								?>
								</label>
							</div>
						</div>
                      </div>
					  
                    </div>
					
                    
                    
                    <br />
					<?php
					
					if($_SESSION[UserLvl] != 4)
					{
					?>
                    <a href="<?php echo "view_enrollment.php?class_id=$rowClass[class_id]"; ?>" class="btn btn-outline-dark  float-left mt-4 ml-2">
						<i class="mdi mdi-keyboard-backspace"></i> Back
					</a>
					<?php
					}
					?>
					<?php echo $displayAction; ?>
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