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
						$r_fee_id = $_POST['r_fee_id'];
						$fee_category_id = $_POST['fee_category_id'];
						$fee_type = $_POST['fee_type'];
						$fee = $_POST['fee'];
						
						$sql = mysql_query("UPDATE registration_fee SET fee_category_id = '$fee_category_id',
																		fee_type = '$fee_type',
																		fee = '$fee'
																		WHERE r_fee_id = '$r_fee_id'");
															
						
														
						if($sql == true)
						{
							$fee_category_id = "";
							$fee_type = "";
							$fee = "";
						
							echo "<div class='alert alert-success alert-dismissible'>
														<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
														<strong>Thank you!</strong> Details for registration fee successfully updated.
									</div>";
						}
						else
							echo "<div class='alert alert-danger alert-dismissible'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>Sorry!</strong> erro.
								</div>";
					}
					
					$r_fee_id = $_GET[r_fee_id];
					$sql = mysql_query("SELECT * FROM registration_fee WHERE r_fee_id = '$r_fee_id'");
					$row = mysql_fetch_array($sql);

			?>
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Update Registration Fee</h4>

                  <form method="post" enctype="multipart/form-data">
				  <input type="hidden" class="form-control" name="r_fee_id" value="<?php echo $row[r_fee_id]; ?>" required />
                    <p class="card-description text-primary">
                      <i class="mdi mdi-windows"></i> Update Registration Fee Details
                    </p>
					
					<hr />
					
                    <div class="row">
					  <div class="col-md-3">
						<div class="form-group">
							<label>Category</label>
							<select class="form-control" name="fee_category_id" required />
								<option value="">- choose category -</option>
								<?php
									$sqlFc = mysql_query("SELECT * FROM fee_category");
									while($rowFc = mysql_fetch_array($sqlFc))
									{
										if($rowFc[fee_category_id] == $row[fee_category_id])
											echo "<option value='$rowFc[fee_category_id]' selected>$rowFc[fee_category]</option>";
										else
											echo "<option value='$rowFc[fee_category_id]'>$rowFc[fee_category]</option>";
									}
									
								?>
							</select>
						</div>
                      </div>
					  <div class="col-md-3">
						<div class="form-group">
							<label>Type</label>
							<input type="text" class="form-control" name="fee_type" value="<?php echo $row[fee_type]; ?>" placeholder="Fee Type" required />
						</div>
                      </div>
					  <div class="col-md-3">
						<div class="form-group">
							<label>Fee</label>
							<input type="number" class="form-control" name="fee" value="<?php echo $row[fee]; ?>" placeholder="Fee" required />
						</div>
                      </div>
					  
                    </div>
                   
                    
                    
                    <br />
                    <a href="manage_reg_fee.php" class="btn btn-outline-dark">
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