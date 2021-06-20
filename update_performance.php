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
						$student_ic = $_POST['student_ic'];
						$hafazan = $_POST['hafazan'];
						$exam = $_POST['exam'];
						
						$sql = mysql_query("UPDATE performance SET hafazan = '$hafazan',
																	exam = '$exam'
																	WHERE student_ic = '$student_ic'");
															
						
														
						if($sql == true)
						{
						
							echo "<div class='alert alert-success alert-dismissible'>
														<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
														<strong>Thank you!</strong> Performance details successfully updated.
									</div>";
						}
						else
							echo "<div class='alert alert-danger alert-dismissible'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>Sorry!</strong> error.
								</div>";
					}
					
					$p_id = $_GET['p_id'];
					$sql = mysql_query("SELECT * FROM performance WHERE p_id = '$p_id'");
					$row = mysql_fetch_array($sql);
					

			?>
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Update Student Performance</h4>

                  <form method="post" enctype="multipart/form-data">
                    <p class="card-description text-primary">
                      <i class='menu-icon mdi mdi-book-open-page-variant'></i> Update Performance Details
                    </p>
					
					<hr />
					
                    <div class="row">
                      <div class="col-md-4">
						<div class="form-group">
							<label>Student</label>
							<input type="text" class="form-control" name="student_ic" value="<?php echo $row[student_ic]; ?>" placeholder="Student IC" readonly />
							
						</div>
                      </div>
					  <div class="col-md-4">
						<div class="form-group">
							<label>Hafazan</label>
							<input type="text" class="form-control" name="hafazan" value="<?php echo $row[hafazan]; ?>" placeholder="Hafazan Result" required />
							
						</div>
                      </div>
					  <div class="col-md-4">
						<div class="form-group">
							<label>Exam</label>
							<input type="text" class="form-control" name="exam" value="<?php echo $row[exam]; ?>" placeholder="Exam Result" required />
							
						</div>
                      </div>
                    </div>
                   
                    
                    
                    <br />
                    <a href="manage_performance.php" class="btn btn-outline-dark">
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