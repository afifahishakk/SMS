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
						$a_id = $_POST['a_id'];
						$student_ic = $_POST['student_ic'];
						$a_type_id = $_POST['a_type_id'];
						$BM = $_POST['BM'];
						$BA = $_POST['BA'];
						$MM = $_POST['MM'];
						$SN = $_POST['SN'];
						$SEJ = $_POST['SEJ'];
						$PQS = $_POST['PQS'];
						$PSI = $_POST['PSI'];
						$year = $_POST['year'];
						
						
						
						$sql = mysql_query("UPDATE academic SET student_ic = '$student_ic',
																	a_type_id = '$a_type_id',
																	BM = '$BM',
																	BA = '$BA',
																	MM = '$MM',
																	SN = '$SN',
																	SEJ = '$SEJ',
																	PQS = '$PQS',
																	PSI = '$PSI',
																	year  = '$year'
																	WHERE a_id = '$a_id'");
															
						
														
							if($sql == true)
							{
							
								echo "<div class='alert alert-success alert-dismissible'>
															<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
															<strong>Thank you!</strong> Student academic performance successfully updated.
										</div>";
							}
							else
								echo "<div class='alert alert-danger alert-dismissible'>
										<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
										<strong>Sorry!</strong> error.
									</div>";
						
						
						
					}
					
					$a_id = $_GET[a_id];
					$sql = mysql_query("SELECT * FROM academic WHERE a_id = '$a_id'");
					$row = mysql_fetch_array($sql);

			?>
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Update Student Academic Performance</h4>

                  <form method="post" enctype="multipart/form-data">
				  <input type="hidden" name="a_id" value=<?php echo $a_id; ?> />
                    <p class="card-description text-primary">
                      <i class='menu-icon mdi mdi-book-open-page-variant'></i> Update Academic Performance Details
                    </p>
					
					<hr />
					
                    <div class="row">
                      <div class="col-md-4">
						<div class="form-group">
							<label>Student</label>
							<select class="form-control" name="student_ic" required />
							<option value="">- choose student -</option>
							<?php
								$sqlStd = mysql_query("SELECT * FROM enrollment");
								while($rowStd = mysql_fetch_array($sqlStd))
								{
									if(($rowStd[status] == "Processing") || ($rowStd[status] == "Rejected"))
										echo "<option class='bg-danger text-white' value='$rowStd[ic]' disabled>$rowStd[name]</option>";
									else if($rowStd[ic] == $row[student_ic])
										echo "<option value='$rowStd[ic]' selected>$rowStd[name]</option>";
									else
										echo "<option value='$rowStd[ic]'>$rowStd[name]</option>";
								}
							?>
							</select>
						</div>
                      </div>
					  <div class="col-md-4">
						<div class="form-group">
							<label>Exam Type</label>
							<select class="form-control" name="a_type_id" required />
							<option value="">- choose exam -</option>
							<?php
								$sqlJP = mysql_query("SELECT * FROM academic_type");
								while($rowJP = mysql_fetch_array($sqlJP))
								{
									if($rowJP[a_type_id] == $row[a_type_id])
										echo "<option value='$rowJP[a_type_id]' selected>$rowJP[a_type]</option>";
									else
										echo "<option value='$rowJP[a_type_id]'>$rowJP[a_type]</option>";
								}
							?>
							</select>
						</div>
                      </div>
                    </div>
					
					<div class="row">
					  <div class="col-md-4">
						<div class="form-group">
							<label>Bahasa Melayu</label>
							<input type="text" class="form-control" name="BM" value="<?php echo $row[BM]; ?>" placeholder="Keputusan Bahasa Melayu" required />
						</div>
                      </div>
					  <div class="col-md-4">
						<div class="form-group">
							<label>Bahasa Arab</label>
							<input type="text" class="form-control" name="BA" value="<?php echo $row[BA]; ?>" placeholder="Keputusan Bahasa Arab" required />
						</div>
                      </div>
                    </div>
					
					<div class="row">
					  <div class="col-md-4">
						<div class="form-group">
							<label>Matematik</label>
							<input type="text" class="form-control" name="MM" value="<?php echo $row[MM]; ?>" placeholder="Keputusan Matematik" required />
						</div>
                      </div>
					  <div class="col-md-4">
						<div class="form-group">
							<label>Sains</label>
							<input type="text" class="form-control" name="SN" value="<?php echo $row[SN]; ?>" placeholder="Keputusan Sains" required />
						</div>
                      </div>
                    </div>
					
					
					<div class="row">
					  <div class="col-md-4">
						<div class="form-group">
							<label>Sejarah</label>
							<input type="text" class="form-control" name="SEJ" value="<?php echo $row[SEJ]; ?>" placeholder="Keputusan Sejarah" required />
						</div>
                      </div>
					  <div class="col-md-4">
						<div class="form-group">
							<label>Pendidikan Quran Sunnah</label>
							<input type="text" class="form-control" name="PQS" value="<?php echo $row[PQS]; ?>" placeholder="Keputusan Pendidikan Quran Sunnah" required />
						</div>
                      </div>
                    </div>
					
					
					<div class="row">
					  <div class="col-md-4">
						<div class="form-group">
							<label>Pendidikan Syariah Islamiah</label>
							<input type="text" class="form-control" name="PSI" value="<?php echo $row[PSI]; ?>" placeholder="Pendidikan Syariah Islamiah" required />
						</div>
                      </div>
					  <div class="col-md-4">
						<div class="form-group">
							<label>Year</label>
							<input type="number" class="form-control" name="year" value="<?php echo $row[year]; ?>" placeholder="Year" required />
						</div>
                      </div>
                    </div>
                   
                    
                    
                    <br />
                    <a href="manage_academic_performance.php" class="btn btn-outline-dark">
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