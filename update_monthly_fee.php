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
						$m_fee_id = $_POST['m_fee_id'];
						$fee = $_POST['fee'];
						$year = $_POST['year'];
						
						//cek samada data fee dan tahun dah ada atau belum
						$sqlCheck = mysql_query("SELECT * FROM monthly_fee WHERE year = '$year' AND fee = '$fee'");
						$numRowCheck = mysql_num_rows($sqlCheck);
						
						if($numRowCheck > 0)
						{
							echo "<div class='alert alert-danger alert-dismissible'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>Sorry!</strong> Monthly fee RM$fee for year $year already existed.
								</div>";
						}
						else
						{
							
							$sql = mysql_query("UPDATE monthly_fee SET year = '$year',
																		fee = '$fee'
																		WHERE m_fee_id = '$m_fee_id'");
																
							
															
							if($sql == true)
							{
							
								echo "<div class='alert alert-success alert-dismissible'>
															<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
															<strong>Thank you!</strong> Monthly fee details for year $year successfully updated.
										</div>";
							
								
								$fee = "";
								$year = "";
							}
							else
								echo "<div class='alert alert-danger alert-dismissible'>
										<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
										<strong>Sorry!</strong> error.
									</div>";
						}
						
					}
					
					$m_fee_id = $_GET[m_fee_id];
					$sql = mysql_query("SELECT * FROM monthly_fee WHERE m_fee_id = '$m_fee_id'");
					$row = mysql_fetch_array($sql);

			?>
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Update Monthly Fee</h4>

                  <form method="post" enctype="multipart/form-data">
				  <input type="hidden" class="form-control" name="m_fee_id" value="<?php echo $row[m_fee_id]; ?>" required />
                    
                    <p class="card-description text-primary">
                      <i class="mdi mdi-windows"></i> Update Monthly Fee Details
                    </p>
					
					<hr />
					
                    <div class="row">
					  <div class="col-md-3">
						<div class="form-group">
							<label>Fee</label>
							<input type="number" class="form-control" name="fee" value="<?php echo $row[fee]; ?>" placeholder="Fee" required />
						</div>
                      </div>
					  <div class="col-md-3">
						<div class="form-group">
							<label>Year</label>
							<select class='form-control' style='width: 100%;' name='year' required>
								<option value=''>- choose year -</option>
								<?php
								
									if($row[year] == '2020')
									{
										echo "<option value='2020' selected>2020</option>
												<option value='2021'>2021</option>
												<option value='2022'>2022</option>
												<option value='2023'>2023</option>
												<option value='2024'>2024</option>
												<option value='2025'>2025</option>";
									}
									else if($row[year] == '2021')
									{
										echo "<option value='2020'>2020</option>
												<option value='2021' selected>2021</option>
												<option value='2022'>2022</option>
												<option value='2023'>2023</option>
												<option value='2024'>2024</option>
												<option value='2025'>2025</option>";
									}
									else if($row[year] == '2022')
									{
										echo "<option value='2020'>2020</option>
												<option value='2021'>2021</option>
												<option value='2022' selected>2022</option>
												<option value='2023'>2023</option>
												<option value='2024'>2024</option>
												<option value='2025'>2025</option>";
									}
									else if($row[year] == '2023')
									{
										echo "<option value='2020'>2020</option>
												<option value='2021'>2021</option>
												<option value='2022'>2022</option>
												<option value='2023' selected>2023</option>
												<option value='2024'>2024</option>
												<option value='2025'>2025</option>";
									}
									else if($row[year] == '2024')
									{
										echo "<option value='2020'>2020</option>
												<option value='2021'>2021</option>
												<option value='2022'>2022</option>
												<option value='2023'>2023</option>
												<option value='2024' selected>2024</option>
												<option value='2025'>2025</option>";
									}
									else if($row[year] == '2025')
									{
										echo "<option value='2020'>2020</option>
												<option value='2021'>2021</option>
												<option value='2022'>2022</option>
												<option value='2023'>2023</option>
												<option value='2024'>2024</option>
												<option value='2025' selected>2025</option>";
									}
								?>
								
							</select>
						</div>
                      </div>
					  
                    </div>
                   
                    
                    
                    <br />
                    <a href="manage_monthly_fee.php" class="btn btn-outline-dark">
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