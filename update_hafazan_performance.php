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
						date_default_timezone_set("Asia/Kuala_Lumpur");
						
						$h_id = $_POST['h_id'];
						$student_ic = $_POST['student_ic'];
						$date = $_POST['date'];
						
						$day = date("D", strtotime($date));
						$month = date("M", strtotime($date));
						$year = date("Y", strtotime($date));
						
						
						// function get week bagi bulan tertentu
						ceil(date('d')/7);
						function getWeekday($date){
						  return ceil(date('d',strtotime($date))/7);
						}
						$week = ceil(date('d')/7);
						
						//get day position
						if($day == "Sun")
							$day_position = 1;
						else if($day == "Mon")
							$day_position = 2;
						else if($day == "Tue")
							$day_position = 3;
						else if($day == "Wed")
							$day_position = 4;
						else if($day == "Thu")
							$day_position = 5;
						else if($day == "Fri")
							$day_position = 6;
						
						
						$talaqi_start_juz = $_POST['talaqi_start_juz'];
						$talaqi_start_surah = $_POST['talaqi_start_surah'];
						$talaqi_start_halaman = $_POST['talaqi_start_halaman'];
						$talaqi_end_juz = $_POST['talaqi_end_juz'];
						$talaqi_end_surah = $_POST['talaqi_end_surah'];
						$talaqi_end_halaman = $_POST['talaqi_end_halaman'];
						
						$hafazan_start_juz = $_POST['hafazan_start_juz'];
						$hafazan_start_surah = $_POST['hafazan_start_surah'];
						$hafazan_start_halaman = $_POST['hafazan_start_halaman'];
						$hafazan_end_juz = $_POST['hafazan_end_juz'];
						$hafazan_end_surah = $_POST['hafazan_end_surah'];
						$hafazan_end_halaman = $_POST['hafazan_end_halaman'];
						
						$ulangan_baru_start_juz = $_POST['ulangan_baru_start_juz'];
						$ulangan_baru_start_surah = $_POST['ulangan_baru_start_surah'];
						$ulangan_baru_start_halaman = $_POST['ulangan_baru_start_halaman'];
						$ulangan_baru_end_juz = $_POST['ulangan_baru_end_juz'];
						$ulangan_baru_end_surah = $_POST['ulangan_baru_end_surah'];
						$ulangan_baru_end_halaman = $_POST['ulangan_baru_end_halaman'];
						
						$ulangan_lama_start_juz = $_POST['ulangan_lama_start_juz'];
						$ulangan_lama_start_surah = $_POST['ulangan_lama_start_surah'];
						$ulangan_lama_start_halaman = $_POST['ulangan_lama_start_halaman'];
						$ulangan_lama_end_juz = $_POST['ulangan_lama_end_juz'];
						$ulangan_lama_end_surah = $_POST['ulangan_lama_end_surah'];
						$ulangan_lama_end_halaman = $_POST['ulangan_lama_end_halaman'];
						
						
						$remark = $_POST['remark'];
						
						$sql = mysql_query("UPDATE hafazan SET student_ic = '$student_ic',
																	date = '$date',
																	day = '$day',
																	day_position = '$day_position',
																	week = '$week',
																	month = '$month',
																	year = '$year',
																	talaqi_start_juz = '$talaqi_start_juz',
																	talaqi_start_surah = '$talaqi_start_surah',
																	talaqi_start_halaman = '$talaqi_start_halaman',
																	talaqi_end_juz = '$talaqi_end_juz',
																	talaqi_end_surah = '$talaqi_end_surah',
																	talaqi_end_halaman = '$talaqi_end_halaman',
																	hafazan_start_juz = '$hafazan_start_juz',
																	hafazan_start_surah = '$hafazan_start_surah',
																	hafazan_start_halaman = '$hafazan_start_halaman',
																	hafazan_end_juz = '$hafazan_end_juz',
																	hafazan_end_surah = '$hafazan_end_surah',
																	hafazan_end_halaman = '$hafazan_end_halaman',
																	ulangan_baru_start_juz = '$ulangan_baru_start_juz',
																	ulangan_baru_start_surah = '$ulangan_baru_start_surah',
																	ulangan_baru_start_halaman = '$ulangan_baru_start_halaman',
																	ulangan_baru_end_juz = '$ulangan_baru_end_juz',
																	ulangan_baru_end_surah = '$ulangan_baru_end_surah',
																	ulangan_baru_end_halaman = '$ulangan_baru_end_halaman',
																	ulangan_lama_start_juz = '$ulangan_lama_start_juz',
																	ulangan_lama_start_surah = '$ulangan_lama_start_surah',
																	ulangan_lama_start_halaman = '$ulangan_lama_start_halaman',
																	ulangan_lama_end_juz = '$ulangan_lama_end_juz',
																	ulangan_lama_end_surah = '$ulangan_lama_end_surah',
																	ulangan_lama_end_halaman = '$ulangan_lama_end_halaman',
																	remark = '$remark'
																	WHERE h_id = '$h_id'");
															
						
														
							if($sql == true)
							{
							
								echo "<div class='alert alert-success alert-dismissible'>
															<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
															<strong>Thank you!</strong> Student hafazan performance details successfully updated.
										</div>";
							}
							else
								echo "<div class='alert alert-danger alert-dismissible'>
													<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
													<strong>Sorry</strong> error.
												</div>";
							
						
						
						
					}
					
					$h_id = $_GET[h_id];
					$sql = mysql_query("SELECT * FROM hafazan WHERE h_id = '$h_id'");
					$row = mysql_fetch_array($sql);

			?>
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Update Student Hafazan Performance</h4>

                  <form method="post" enctype="multipart/form-data">
				  <input type="hidden" name="h_id" value="<?php echo $row[h_id]; ?>">
                    <p class="card-description text-primary">
                      <i class='menu-icon mdi mdi-book-open-page-variant'></i> Update Student Hafazan Performance Details
                    </p>
					
					<hr />
					
                    <div class="row">
                      <div class="col-md-6">
						<div class="form-group">
							<label>Student</label>
							<select class="form-control" name="student_ic" required />
							<option value="">- choose -</option>
							<?php
								$sqlStd = mysql_query("SELECT * FROM enrollment WHERE purpose != 'SPM'");
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
					  <div class="col-md-6">
						<div class="form-group">
							<label>Date</label>
							<input type="date" class="form-control" name="date" value="<?php echo $row['date']; ?>" placeholder="Date" required />
						</div>
                      </div>
                    </div>
					
					<div class="row">
								  <div class="col-md-12">
									<div class="form-group">
										<div class="table-responsive">
											<table class="table dataTable no-footer" role="grid">
											  <thead>
												<tr class="table-primary" style="text-align:center;">
												  <th rowspan="2">Activity</th>
												  <th colspan="3">Start</th>
												  <th colspan="3">End</th>
												</tr>
											  </thead>
											  <tbody>
												<tr class="table-success">
													<td></td>
													<td>Juz</td>
													<td>Surah</td>
													<td>Page</td>
													<td>Juz</td>
													<td>Surah</td>
													<td>Page</td>
												</tr>
												<tr>
													<td>Talaqqi</td>
													<td><input type="text" class="form-control" style="width:auto;" name="talaqi_start_juz" value="<?php echo $row[talaqi_start_juz]; ?>" required /></td>
													<td><input type="text" class="form-control" style="width:auto;" name="talaqi_start_surah" value="<?php echo $row[talaqi_start_surah]; ?>" required /></td>
													<td><input type="text" class="form-control" style="width:auto;" name="talaqi_start_halaman" value="<?php echo $row[talaqi_start_halaman]; ?>" required /></td>
													<td><input type="text" class="form-control" style="width:auto;" name="talaqi_end_juz" value="<?php echo $row[talaqi_end_juz]; ?>" required /></td>
													<td><input type="text" class="form-control" style="width:auto;" name="talaqi_end_surah" value="<?php echo $row[talaqi_end_surah]; ?>" required /></td>
													<td><input type="text" class="form-control" style="width:auto;" name="talaqi_end_halaman" value="<?php echo $row[talaqi_end_halaman]; ?>" required /></td>
												</tr>
												
												<tr>
													<td>New Hafazan</td>
													<td><input type="text" class="form-control" style="width:auto;" name="hafazan_start_juz" value="<?php echo $row[hafazan_start_juz]; ?>" required /></td>
													<td><input type="text" class="form-control" style="width:auto;" name="hafazan_start_surah" value="<?php echo $row[hafazan_start_surah]; ?>" required /></td>
													<td><input type="text" class="form-control" style="width:auto;" name="hafazan_start_halaman" value="<?php echo $row[hafazan_start_halaman]; ?>" required /></td>
													<td><input type="text" class="form-control" style="width:auto;" name="hafazan_end_juz" value="<?php echo $row[hafazan_end_juz]; ?>" required /></td>
													<td><input type="text" class="form-control" style="width:auto;" name="hafazan_end_surah" value="<?php echo $row[hafazan_end_surah]; ?>" required /></td>
													<td><input type="text" class="form-control" style="width:auto;" name="hafazan_end_halaman" value="<?php echo $row[hafazan_end_halaman]; ?>" required /></td>
												</tr>
												</tr>
												
												<tr>
													<td>Repeat New Hafazan</td>
													<td><input type="text" class="form-control" style="width:auto;" name="ulangan_baru_start_juz" value="<?php echo $row[ulangan_baru_start_juz]; ?>" required /></td>
													<td><input type="text" class="form-control" style="width:auto;" name="ulangan_baru_start_surah" value="<?php echo $row[ulangan_baru_start_surah]; ?>" required /></td>
													<td><input type="text" class="form-control" style="width:auto;" name="ulangan_baru_start_halaman" value="<?php echo $row[ulangan_baru_start_halaman]; ?>" required /></td>
													<td><input type="text" class="form-control" style="width:auto;" name="ulangan_baru_end_juz" value="<?php echo $row[ulangan_baru_end_juz]; ?>" required /></td>
													<td><input type="text" class="form-control" style="width:auto;" name="ulangan_baru_end_surah" value="<?php echo $row[ulangan_baru_end_surah]; ?>" required /></td>
													<td><input type="text" class="form-control" style="width:auto;" name="ulangan_baru_end_halaman" value="<?php echo $row[ulangan_baru_end_halaman]; ?>" required /></td>
												</tr>
												
												<tr>
													<td>Repeat Previous Hafazan</td>
													<td><input type="text" class="form-control" style="width:auto;" name="ulangan_lama_start_juz" value="<?php echo $row[ulangan_lama_start_juz]; ?>" required /></td>
													<td><input type="text" class="form-control" style="width:auto;" name="ulangan_lama_start_surah" value="<?php echo $row[ulangan_lama_start_surah]; ?>" required /></td>
													<td><input type="text" class="form-control" style="width:auto;" name="ulangan_lama_start_halaman" value="<?php echo $row[ulangan_lama_start_halaman]; ?>" required /></td>
													<td><input type="text" class="form-control" style="width:auto;" name="ulangan_lama_end_juz" value="<?php echo $row[ulangan_lama_end_juz]; ?>" required /></td>
													<td><input type="text" class="form-control" style="width:auto;" name="ulangan_lama_end_surah" value="<?php echo $row[ulangan_lama_end_surah]; ?>" required /></td>
													<td><input type="text" class="form-control" style="width:auto;" name="ulangan_lama_end_halaman" value="<?php echo $row[ulangan_lama_end_halaman]; ?>" required /></td>
												</tr>
												
												<tr>
													<td>Remark</td>
													<td colspan="3"><textarea name="remark" rows="5" class="form-control" placeholder="Please write your remark for student hafazan performance here..." required><?php echo $row[remark]; ?></textarea></td>
													<td></td>
													<td></td>
													<td></td>
												</tr>
												
											  </tbody>
											</table>
										  </div>
									</div>
								  </div>
								</div>
                   
                    
                    
                    <br />
                    <a href="manage_hafazan_performance.php" class="btn btn-outline-dark">
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