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
						$fee = $_POST['fee'];
						$year = $_POST['year'];
						
						//cek samada tahun dah ada atau belum
						$sqlCheck = mysql_query("SELECT * FROM monthly_fee WHERE year = '$year'");
						$numRowCheck = mysql_num_rows($sqlCheck);
						
						if($numRowCheck > 0)
						{
							echo "<div class='alert alert-danger alert-dismissible'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>Sorry!</strong> Monthly fee for year $year already existed.
								</div>";
						}
						else
						{
							
							$sql = mysql_query("INSERT INTO monthly_fee (fee, year)
																	VALUES ('$fee', '$year')");
																
							
															
							if($sql == true)
							{
								$fee = "";
								$year = "";
							
								echo "<div class='alert alert-success alert-dismissible'>
															<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
															<strong>Thank you!</strong> Monthly fee details for year $year successfully recorded.
										</div>";
							}
							else
								echo "<div class='alert alert-danger alert-dismissible'>
										<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
										<strong>Sorry!</strong> error.
									</div>";
						}
						
					}

			?>
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Record Monthly Fee</h4>

                  <form method="post" enctype="multipart/form-data">
                    <p class="card-description text-primary">
                      <i class="mdi mdi-windows"></i> Record Monthly Fee Details
                    </p>
					
					<hr />
					
                    <div class="row">
					  <div class="col-md-3">
						<div class="form-group">
							<label>Fee</label>
							<input type="number" class="form-control" name="fee" value="<?php echo $fee; ?>" placeholder="Fee" required />
						</div>
                      </div>
					  <div class="col-md-3">
						<div class="form-group">
							<label>Year</label>
							<select class='form-control' style='width: 100%;' name='year' required>
								<option value=''>- choose year -</option>
								<option value='2020'>2020</option>
								<option value='2021'>2021</option>
								<option value='2022'>2022</option>
								<option value='2023'>2023</option>
								<option value='2024'>2024</option>
								<option value='2025'>2025</option>
							</select>
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