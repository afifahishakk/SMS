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
<style>
body {
	zoom: 70%; }
</style>

<body onload="window.print()">
    <!-- partial:../../partials/_navbar.html -->
	
    <!-- partial -->
      <!-- partial:../../partials/_sidebar.html -->
	   
      <!-- partial -->
          <div class="row">
            
            
           
            
            
            <div class="col-12 grid-margin">
			<?php
					
					$student_ic = $_GET[student_ic];
					$name = $_GET[name];
					
					/* get week month year */
					$sqlWMY = mysql_query("SELECT * FROM hafazan WHERE student_ic = '$student_ic'");
					$rowWMY = mysql_fetch_array($sqlWMY);
					
					/* sun */
					$sqlSun = mysql_query("SELECT * FROM hafazan WHERE student_ic = '$student_ic' AND day = 'Sun'");
					$rowSun = mysql_fetch_array($sqlSun);
					
					$sunDateString = str_replace('-', '/', $rowSun['date']);
					$sunDateStringFormat = date('d/m/Y', strtotime($sunDateString));
					
					if($sunDateStringFormat == "01/01/1970")
						$sunDateStringFormat = "- - -";
					
					
					/* mon */
					$sqlMon = mysql_query("SELECT * FROM hafazan WHERE student_ic = '$student_ic' AND day = 'Mon'");
					$rowMon = mysql_fetch_array($sqlMon);
					
					$monDateString = str_replace('-', '/', $rowMon['date']);
					$monDateStringFormat = date('d/m/Y', strtotime($monDateString));
					
					if($monDateStringFormat == "01/01/1970")
						$monDateStringFormat = "- - -";
					
					
					/* tue */
					$sqlTue = mysql_query("SELECT * FROM hafazan WHERE student_ic = '$student_ic' AND day = 'Tue'");
					$rowTue = mysql_fetch_array($sqlTue);
					
					$tueDateString = str_replace('-', '/', $rowTue['date']);
					$tueDateStringFormat = date('d/m/Y', strtotime($tueDateString));
					
					
					if($tueDateStringFormat == "01/01/1970")
						$tueDateStringFormat = "- - -";
					
					
					/* wed */
					$sqlWed = mysql_query("SELECT * FROM hafazan WHERE student_ic = '$student_ic' AND day = 'Wed'");
					$rowWed = mysql_fetch_array($sqlWed);
					
					$wedDateString = str_replace('-', '/', $rowWed['date']);
					$wedDateStringFormat = date('d/m/Y', strtotime($wedDateString));
					
					
					if($wedDateStringFormat == "01/01/1970")
						$wedDateStringFormat = "- - -";
					
					/* thu */
					$sqlThu = mysql_query("SELECT * FROM hafazan WHERE student_ic = '$student_ic' AND day = 'Thu'");
					$rowThu = mysql_fetch_array($sqlThu);
					
					$thuDateString = str_replace('-', '/', $rowThu['date']);
					$thuDateStringFormat = date('d/m/Y', strtotime($thuDateString));
					
					
					if($thuDateStringFormat == "01/01/1970")
						$thuDateStringFormat = "- - -";
					
					
					/* fri */
					$sqlFri = mysql_query("SELECT * FROM hafazan WHERE student_ic = '$student_ic' AND day = 'Fri'");
					$rowFri = mysql_fetch_array($sqlFri);
					
					$friDateString = str_replace('-', '/', $rowFri['date']);
					$friDateStringFormat = date('d/m/Y', strtotime($friDateString));
					
					
					
					if($friDateStringFormat == "01/01/1970")
						$friDateStringFormat = "- - -";

			?><div class='visible'>
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Hafazan Performance Details</h4>

                  <form method="post" enctype="multipart/form-data">
				  <input type="hidden" name="student_ic" value="<?php echo $rowWMY[student_ic]; ?>">
					
					<hr />
					
                    <div class="row">
                      <div class="col-md-6">
						<div class="form-group">
							<label><b>Student</b></label>
							<p><?php echo $name; ?></p>
						</div>
                      </div>
					  <div class="col-md-2">
						<div class="form-group">
							<label><b>Week</b></label>
							<p><?php echo $rowWMY[week]; ?></p>
						</div>
                      </div>
					  <div class="col-md-2">
						<div class="form-group">
							<label><b>Month</b></label>
							<p><?php echo $rowWMY[month]; ?></p>
						</div>
                      </div>
					  <div class="col-md-2">
						<div class="form-group">
							<label><b>Year</b></label>
							<p><?php echo $rowWMY[year]; ?></p>
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
												  <th>Date/Day</th>
												  <th>Activity</th>
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
													<td>Juz</td>
												</tr>
												<tr class="table-warning">
													<td><?php echo $sunDateStringFormat . " (Sun)"; ?></td>
													<td>Talaqqi</td>
													<td><?php echo $rowSun[talaqi_start_juz]; ?></td>
													<td><?php echo $rowSun[talaqi_start_surah]; ?></td>
													<td><?php echo $rowSun[talaqi_start_halaman]; ?></td>
													<td><?php echo $rowSun[talaqi_end_juz]; ?></td>
													<td><?php echo $rowSun[talaqi_end_surah]; ?></td>
													<td><?php echo $rowSun[talaqi_end_halaman]; ?></td>
												</tr>
												
												<tr class="table-warning">
													<td></td>
													<td>New Hafazan</td>
													<td><?php echo $rowSun[hafazan_start_juz]; ?></td>
													<td><?php echo $rowSun[hafazan_start_surah]; ?></td>
													<td><?php echo $rowSun[hafazan_start_halaman]; ?></td>
													<td><?php echo $rowSun[hafazan_end_juz]; ?></td>
													<td><?php echo $rowSun[hafazan_end_surah]; ?></td>
													<td><?php echo $rowSun[hafazan_end_halaman]; ?></td>
												</tr>
												
												<tr class="table-warning">
													<td></td>
													<td>Repeat New Hafazan</td>
													<td><?php echo $rowSun[ulangan_baru_start_juz]; ?></td>
													<td><?php echo $rowSun[ulangan_baru_start_surah]; ?></td>
													<td><?php echo $rowSun[ulangan_baru_start_halaman]; ?></td>
													<td><?php echo $rowSun[ulangan_baru_end_juz]; ?></td>
													<td><?php echo $rowSun[ulangan_baru_end_surah]; ?></td>
													<td><?php echo $rowSun[ulangan_baru_end_halaman]; ?></td>
												</tr>
												
												<tr class="table-warning">
													<td></td>
													<td>Repeat Previous Hafazan</td>
													<td><?php echo $rowSun[ulangan_lama_start_juz]; ?></td>
													<td><?php echo $rowSun[ulangan_lama_start_surah]; ?></td>
													<td><?php echo $rowSun[ulangan_lama_start_halaman]; ?></td>
													<td><?php echo $rowSun[ulangan_lama_end_juz]; ?></td>
													<td><?php echo $rowSun[ulangan_lama_end_surah]; ?></td>
													<td><?php echo $rowSun[ulangan_lama_end_halaman]; ?></td>
												</tr>
												
												<tr class="table-warning">
													<td></td>
													<td>Remark</td>
													<td colspan="3"><?php echo $rowSun[remark]; ?></td>
													<td></td>
													<td></td>
													<td></td>
												</tr>
												
												
												
												<tr class="table-secondary">
													<td><?php echo $monDateStringFormat . " (Mon)"; ?></td>
													<td>Talaqqi</td>
													<td><?php echo $rowMon[talaqi_start_juz]; ?></td>
													<td><?php echo $rowMon[talaqi_start_surah]; ?></td>
													<td><?php echo $rowMon[talaqi_start_halaman]; ?></td>
													<td><?php echo $rowMon[talaqi_end_juz]; ?></td>
													<td><?php echo $rowMon[talaqi_end_surah]; ?></td>
													<td><?php echo $rowMon[talaqi_end_halaman]; ?></td>
												</tr>
												
												<tr class="table-secondary">
													<td></td>
													<td>New Hafazan</td>
													<td><?php echo $rowMon[hafazan_start_juz]; ?></td>
													<td><?php echo $rowMon[hafazan_start_surah]; ?></td>
													<td><?php echo $rowMon[hafazan_start_halaman]; ?></td>
													<td><?php echo $rowMon[hafazan_end_juz]; ?></td>
													<td><?php echo $rowMon[hafazan_end_surah]; ?></td>
													<td><?php echo $rowMon[hafazan_end_halaman]; ?></td>
												</tr>
												
												<tr class="table-secondary">
													<td></td>
													<td>Repeat New Hafazan</td>
													<td><?php echo $rowMon[ulangan_baru_start_juz]; ?></td>
													<td><?php echo $rowMon[ulangan_baru_start_surah]; ?></td>
													<td><?php echo $rowMon[ulangan_baru_start_halaman]; ?></td>
													<td><?php echo $rowMon[ulangan_baru_end_juz]; ?></td>
													<td><?php echo $rowMon[ulangan_baru_end_surah]; ?></td>
													<td><?php echo $rowMon[ulangan_baru_end_halaman]; ?></td>
												</tr>
												
												<tr class="table-secondary">
													<td></td>
													<td>Repeat Previous Hafazan</td>
													<td><?php echo $rowMon[ulangan_lama_start_juz]; ?></td>
													<td><?php echo $rowMon[ulangan_lama_start_surah]; ?></td>
													<td><?php echo $rowMon[ulangan_lama_start_halaman]; ?></td>
													<td><?php echo $rowMon[ulangan_lama_end_juz]; ?></td>
													<td><?php echo $rowMon[ulangan_lama_end_surah]; ?></td>
													<td><?php echo $rowMon[ulangan_lama_end_halaman]; ?></td>
												</tr>
												
												<tr class="table-secondary">
													<td></td>
													<td>Remark</td>
													<td colspan="3"><?php echo $rowMon[remark]; ?></td>
													<td></td>
													<td></td>
													<td></td>
												</tr>
												
												
												<tr class="table-warning">
													<td><?php echo $tueDateStringFormat . " (Tue)"; ?></td>
													<td>Talaqqi</td>
													<td><?php echo $rowTue[talaqi_start_juz]; ?></td>
													<td><?php echo $rowTue[talaqi_start_surah]; ?></td>
													<td><?php echo $rowTue[talaqi_start_halaman]; ?></td>
													<td><?php echo $rowTue[talaqi_end_juz]; ?></td>
													<td><?php echo $rowTue[talaqi_end_surah]; ?></td>
													<td><?php echo $rowTue[talaqi_end_halaman]; ?></td>
												</tr>
												
												<tr class="table-warning">
													<td></td>
													<td>New Hafazan</td>
													<td><?php echo $rowTue[hafazan_start_juz]; ?></td>
													<td><?php echo $rowTue[hafazan_start_surah]; ?></td>
													<td><?php echo $rowTue[hafazan_start_halaman]; ?></td>
													<td><?php echo $rowTue[hafazan_end_juz]; ?></td>
													<td><?php echo $rowTue[hafazan_end_surah]; ?></td>
													<td><?php echo $rowTue[hafazan_end_halaman]; ?></td>
												</tr>
												
												<tr class="table-warning">
													<td></td>
													<td>Repeat New Hafazan</td>
													<td><?php echo $rowTue[ulangan_baru_start_juz]; ?></td>
													<td><?php echo $rowTue[ulangan_baru_start_surah]; ?></td>
													<td><?php echo $rowTue[ulangan_baru_start_halaman]; ?></td>
													<td><?php echo $rowTue[ulangan_baru_end_juz]; ?></td>
													<td><?php echo $rowTue[ulangan_baru_end_surah]; ?></td>
													<td><?php echo $rowTue[ulangan_baru_end_halaman]; ?></td>
												</tr>
												
												<tr class="table-warning">
													<td></td>
													<td>Repeat Previous Hafazan</td>
													<td><?php echo $rowTue[ulangan_lama_start_juz]; ?></td>
													<td><?php echo $rowTue[ulangan_lama_start_surah]; ?></td>
													<td><?php echo $rowTue[ulangan_lama_start_halaman]; ?></td>
													<td><?php echo $rowTue[ulangan_lama_end_juz]; ?></td>
													<td><?php echo $rowTue[ulangan_lama_end_surah]; ?></td>
													<td><?php echo $rowTue[ulangan_lama_end_halaman]; ?></td>
												</tr>
												
												<tr class="table-warning">
													<td></td>
													<td>Remark</td>
													<td colspan="3"><?php echo $rowTue[remark]; ?></td>
													<td></td>
													<td></td>
													<td></td>
												</tr>
												
												
												<tr class="table-secondary">
													<td><?php echo $wedDateStringFormat . " (Wed)"; ?></td>
													<td>Talaqqi</td>
													<td><?php echo $rowWed[talaqi_start_juz]; ?></td>
													<td><?php echo $rowWed[talaqi_start_surah]; ?></td>
													<td><?php echo $rowWed[talaqi_start_halaman]; ?></td>
													<td><?php echo $rowWed[talaqi_end_juz]; ?></td>
													<td><?php echo $rowWed[talaqi_end_surah]; ?></td>
													<td><?php echo $rowWed[talaqi_end_halaman]; ?></td>
												</tr>
												
												<tr class="table-secondary">
													<td></td>
													<td>New Hafazan</td>
													<td><?php echo $rowWed[hafazan_start_juz]; ?></td>
													<td><?php echo $rowWed[hafazan_start_surah]; ?></td>
													<td><?php echo $rowWed[hafazan_start_halaman]; ?></td>
													<td><?php echo $rowWed[hafazan_end_juz]; ?></td>
													<td><?php echo $rowWed[hafazan_end_surah]; ?></td>
													<td><?php echo $rowWed[hafazan_end_halaman]; ?></td>
												</tr>
												</tr>
												
												<tr class="table-secondary">
													<td></td>
													<td>Repeat New Hafazan</td>
													<td><?php echo $rowWed[ulangan_baru_start_juz]; ?></td>
													<td><?php echo $rowWed[ulangan_baru_start_surah]; ?></td>
													<td><?php echo $rowWed[ulangan_baru_start_halaman]; ?></td>
													<td><?php echo $rowWed[ulangan_baru_end_juz]; ?></td>
													<td><?php echo $rowWed[ulangan_baru_end_surah]; ?></td>
													<td><?php echo $rowWed[ulangan_baru_end_halaman]; ?></td>
												</tr>
												
												<tr class="table-secondary">
													<td></td>
													<td>Repeat Previous Hafazan</td>
													<td><?php echo $rowWed[ulangan_lama_start_juz]; ?></td>
													<td><?php echo $rowWed[ulangan_lama_start_surah]; ?></td>
													<td><?php echo $rowWed[ulangan_lama_start_halaman]; ?></td>
													<td><?php echo $rowWed[ulangan_lama_end_juz]; ?></td>
													<td><?php echo $rowWed[ulangan_lama_end_surah]; ?></td>
													<td><?php echo $rowWed[ulangan_lama_end_halaman]; ?></td>
												</tr>
												
												<tr class="table-secondary">
													<td></td>
													<td>Remark</td>
													<td colspan="3"><?php echo $rowWed[remark]; ?></td>
													<td></td>
													<td></td>
													<td></td>
												</tr>
												
												
												<tr class="table-warning">
													<td><?php echo $thuDateStringFormat . " (Thu)"; ?></td>
													<td>Talaqqi</td>
													<td><?php echo $rowThu[talaqi_start_juz]; ?></td>
													<td><?php echo $rowThu[talaqi_start_surah]; ?></td>
													<td><?php echo $rowThu[talaqi_start_halaman]; ?></td>
													<td><?php echo $rowThu[talaqi_end_juz]; ?></td>
													<td><?php echo $rowThu[talaqi_end_surah]; ?></td>
													<td><?php echo $rowThu[talaqi_end_halaman]; ?></td>
												</tr>
												
												<tr class="table-warning">
													<td></td>
													<td>New Hafazan</td>
													<td><?php echo $rowThu[hafazan_start_juz]; ?></td>
													<td><?php echo $rowThu[hafazan_start_surah]; ?></td>
													<td><?php echo $rowThu[hafazan_start_halaman]; ?></td>
													<td><?php echo $rowThu[hafazan_end_juz]; ?></td>
													<td><?php echo $rowThu[hafazan_end_surah]; ?></td>
													<td><?php echo $rowThu[hafazan_end_halaman]; ?></td>
												</tr>
												
												<tr class="table-warning">
													<td></td>
													<td>Repeat New Hafazan</td>
													<td><?php echo $rowThu[ulangan_baru_start_juz]; ?></td>
													<td><?php echo $rowThu[ulangan_baru_start_surah]; ?></td>
													<td><?php echo $rowThu[ulangan_baru_start_halaman]; ?></td>
													<td><?php echo $rowThu[ulangan_baru_end_juz]; ?></td>
													<td><?php echo $rowThu[ulangan_baru_end_surah]; ?></td>
													<td><?php echo $rowThu[ulangan_baru_end_halaman]; ?></td>
												</tr>
												
												<tr class="table-warning">
													<td></td>
													<td>Repeat Previous Hafazan</td>
													<td><?php echo $rowThu[ulangan_lama_start_juz]; ?></td>
													<td><?php echo $rowThu[ulangan_lama_start_surah]; ?></td>
													<td><?php echo $rowThu[ulangan_lama_start_halaman]; ?></td>
													<td><?php echo $rowThu[ulangan_lama_end_juz]; ?></td>
													<td><?php echo $rowThu[ulangan_lama_end_surah]; ?></td>
													<td><?php echo $rowThu[ulangan_lama_end_halaman]; ?></td>
												</tr>
												
												<tr class="table-warning">
													<td></td>
													<td>Remark</td>
													<td colspan="3"><?php echo $rowThu[remark]; ?></td>
													<td></td>
													<td></td>
													<td></td>
												</tr>
												
												
												<tr class="table-secondary">
													<td><?php echo $friDateStringFormat . " (Fri)"; ?></td>
													<td>Talaqqi</td>
													<td><?php echo $rowFri[talaqi_start_juz]; ?></td>
													<td><?php echo $rowFri[talaqi_start_surah]; ?></td>
													<td><?php echo $rowFri[talaqi_start_halaman]; ?></td>
													<td><?php echo $rowFri[talaqi_end_juz]; ?></td>
													<td><?php echo $rowFri[talaqi_end_surah]; ?></td>
													<td><?php echo $rowFri[talaqi_end_halaman]; ?></td>
												</tr>
												
												<tr class="table-secondary">
													<td></td>
													<td>New Hafazan</td>
													<td><?php echo $rowFri[hafazan_start_juz]; ?></td>
													<td><?php echo $rowFri[hafazan_start_surah]; ?></td>
													<td><?php echo $rowFri[hafazan_start_halaman]; ?></td>
													<td><?php echo $rowFri[hafazan_end_juz]; ?></td>
													<td><?php echo $rowFri[hafazan_end_surah]; ?></td>
													<td><?php echo $rowFri[hafazan_end_halaman]; ?></td>
												</tr>
												
												<tr class="table-secondary">
													<td></td>
													<td>Repeat New Hafazan</td>
													<td><?php echo $rowFri[ulangan_baru_start_juz]; ?></td>
													<td><?php echo $rowFri[ulangan_baru_start_surah]; ?></td>
													<td><?php echo $rowFri[ulangan_baru_start_halaman]; ?></td>
													<td><?php echo $rowFri[ulangan_baru_end_juz]; ?></td>
													<td><?php echo $rowFri[ulangan_baru_end_surah]; ?></td>
													<td><?php echo $rowFri[ulangan_baru_end_halaman]; ?></td>
												</tr>
												
												<tr class="table-secondary">
													<td></td>
													<td>Repeat Previous Hafazan</td>
													<td><?php echo $rowFri[ulangan_lama_start_juz]; ?></td>
													<td><?php echo $rowFri[ulangan_lama_start_surah]; ?></td>
													<td><?php echo $rowFri[ulangan_lama_start_halaman]; ?></td>
													<td><?php echo $rowFri[ulangan_lama_end_juz]; ?></td>
													<td><?php echo $rowFri[ulangan_lama_end_surah]; ?></td>
													<td><?php echo $rowFri[ulangan_lama_end_halaman]; ?></td>
												</tr>
												
												<tr class="table-secondary">
													<td></td>
													<td>Remark</td>
													<td colspan="3"><?php echo $rowFri[remark]; ?></td>
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
                  </form>
                </div>
              </div>
			  </div>
            </div>
          </div>
        
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
		
        <!-- partial -->
      
      <!-- main-panel ends -->
    
    <!-- page-body-wrapper ends -->
  
  <!-- container-scroller -->
  <!-- plugins:js -->
  <!-- SCRIPT -->
   <?php include "layout/script.php";?>
</body>

</html>
<?php
}
?>