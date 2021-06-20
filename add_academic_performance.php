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
						$a_type_id = $_POST['a_type_id'];
						$BM = $_POST['BM'];
						$BA = $_POST['BA'];
						$MM = $_POST['MM'];
						$SN = $_POST['SN'];
						$SEJ = $_POST['SEJ'];
						$PQS = $_POST['PQS'];
						$PSI = $_POST['PSI'];
						$year = $_POST['year'];
						
						
						//get exam name
						$sqlExam = mysql_query("SELECT * FROM academic_type WHERE a_type_id = '$a_type_id'");
						$rowExam = mysql_fetch_array($sqlExam);
						
						
						//cek samada dah ada atau belum
						$sqlCheck = mysql_query("SELECT * FROM academic WHERE student_ic = '$student_ic'
																				AND a_type_id = '$a_type_id'
																				AND year = '$year'");
						
						$numRowCheck = mysql_fetch_array($sqlCheck);
						
						if($numRowCheck > 0)
						{
							echo "<div class='alert alert-danger alert-dismissible'>
										<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
										<strong>Sorry!</strong> Seems the student academic performance exam $rowExam[a_type] for year $year already recorded. 
									</div>";
						}
						else
						{
							$sql = mysql_query("INSERT INTO academic (student_ic,
																	a_type_id,
																	BM,
																	BA,
																	MM,
																	SN,
																	SEJ,
																	PQS,
																	PSI,
																	year)
																VALUES ('$student_ic',
																			'$a_type_id',
																			'$BM',
																			'$BA',
																			'$MM',
																			'$SN',
																			'$SEJ',
																			'$PQS',
																			'$PSI',
																			'$year')");
															
						
														
							if($sql == true)
							{
								$student_ic = "";
								$a_type_id = "";
								$BM = "";
								$BA = "";
								$MM = "";
								$SN = "";
								$SEJ = "";
								$PQS = "";
								$PSI = "";
								$year = "";
							
								echo "<div class='alert alert-success alert-dismissible'>
															<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
															<strong>Thank you!</strong> Student academic performance successfully recorded.
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
                  <h4 class="card-title">Add Student Academic Performance</h4>

                  <form method="post" enctype="multipart/form-data">
                    <p class="card-description text-primary">
                      <i class='menu-icon mdi mdi-book-open-page-variant'></i> Add Academic Performance Details
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
									if($rowJP[a_type_id] == $a_type_id)
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
							<input type="text" class="form-control" name="BM" value="<?php echo $BM; ?>" placeholder="Keputusan Bahasa Melayu" required />
						</div>
                      </div>
					  <div class="col-md-4">
						<div class="form-group">
							<label>Bahasa Arab</label>
							<input type="text" class="form-control" name="BA" value="<?php echo $BA; ?>" placeholder="Keputusan Bahasa Arab" required />
						</div>
                      </div>
                    </div>
					
					<div class="row">
					  <div class="col-md-4">
						<div class="form-group">
							<label>Matematik</label>
							<input type="text" class="form-control" name="MM" value="<?php echo $MM; ?>" placeholder="Keputusan Matematik" required />
						</div>
                      </div>
					  <div class="col-md-4">
						<div class="form-group">
							<label>Sains</label>
							<input type="text" class="form-control" name="SN" value="<?php echo $SN; ?>" placeholder="Keputusan Sains" required />
						</div>
                      </div>
                    </div>
					
					
					<div class="row">
					  <div class="col-md-4">
						<div class="form-group">
							<label>Sejarah</label>
							<input type="text" class="form-control" name="SEJ" value="<?php echo $SEJ; ?>" placeholder="Keputusan Sejarah" required />
						</div>
                      </div>
					  <div class="col-md-4">
						<div class="form-group">
							<label>Pendidikan Quran Sunnah</label>
							<input type="text" class="form-control" name="PQS" value="<?php echo $PQS; ?>" placeholder="Keputusan Pendidikan Quran Sunnah" required />
						</div>
                      </div>
                    </div>
					
					
					<div class="row">
					  <div class="col-md-4">
						<div class="form-group">
							<label>Pendidikan Syariah Islamiah</label>
							<input type="text" class="form-control" name="PSI" value="<?php echo $PSI; ?>" placeholder="Pendidikan Syariah Islamiah" required />
						</div>
                      </div>
					  <div class="col-md-4">
						<div class="form-group">
							<label>Year</label>
							<select class="form-control" name="year" required />
													<option value=''>- choose -</option>
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