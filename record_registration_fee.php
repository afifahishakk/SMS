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
						$fee_category_id = $_POST['fee_category_id'];
						$fee_type = $_POST['fee_type'];
						$fee = $_POST['fee'];
						
						$sql = mysql_query("INSERT INTO registration_fee (fee_category_id, fee_type, fee)
																VALUES ('$fee_category_id', '$fee_type', '$fee')");
															
						
														
						if($sql == true)
						{
							$fee_category_id = "";
							$fee_type = "";
							$fee = "";
						
							echo "<div class='alert alert-success alert-dismissible'>
														<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
														<strong>Thank you!</strong> New details for registration fee successfully added.
									</div>";
						}
						else
							echo "<div class='alert alert-danger alert-dismissible'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>Sorry!</strong> erro.
								</div>";
					}

			?>
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Add Registration Fee</h4>

                  <form method="post" enctype="multipart/form-data">
                    <p class="card-description text-primary">
                      <i class="mdi mdi-windows"></i> Add Registration Fee Details
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
										if($rowFc[fee_category_id] == $fee_category_id)
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
							<input type="text" class="form-control" name="fee_type" value="<?php echo $fee_type; ?>" placeholder="Fee Type" required />
						</div>
                      </div>
					  <div class="col-md-3">
						<div class="form-group">
							<label>Fee</label>
							<input type="number" class="form-control" name="fee" value="<?php echo $fee; ?>" placeholder="Fee" required />
						</div>
                      </div>
					  
                    </div>
                   
                    
                    
                    <br />
                    <button type="reset" class="btn btn-outline-dark"><i class="mdi mdi-refresh"></i> Reset</button>
					<button type="submit" name="submit" class="btn btn-primary mr-2"><i class="mdi mdi-check"></i> Submit</button>
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