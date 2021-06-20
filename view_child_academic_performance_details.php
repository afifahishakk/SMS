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
					
					$student_ic = $_GET[student_ic];
					$name = $_GET[name];
					
					/* exam 1 */
					$sql1 = mysql_query("SELECT * FROM academic WHERE student_ic = '$student_ic' AND a_type_id = 1");
					$row1 = mysql_fetch_array($sql1);
					
					/* exam 2 */
					$sql2 = mysql_query("SELECT * FROM academic WHERE student_ic = '$student_ic' AND a_type_id = 2");
					$row2 = mysql_fetch_array($sql2);
					
					/* exam 3 */
					$sql3 = mysql_query("SELECT * FROM academic WHERE student_ic = '$student_ic' AND a_type_id = 3");
					$row3 = mysql_fetch_array($sql3);
					
					/* exam 4 */
					$sql4 = mysql_query("SELECT * FROM academic WHERE student_ic = '$student_ic' AND a_type_id = 4");
					$row4 = mysql_fetch_array($sql4);
					
					

			?>
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">View Academic Performance</h4>

                  <form method="post" enctype="multipart/form-data">
                    <p class="card-description text-primary">
                      <i class='menu-icon mdi mdi-book-open-page-variant'></i> View Academic Performance Details
                    </p>
					
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
							<label></label>
							<p></p>
						</div>
                      </div>
					  <div class="col-md-2">
						<div class="form-group">
							<label></label>
							<p></p>
						</div>
                      </div>
					  <div class="col-md-2">
						<div class="form-group">
							<label><b>Year</b></label>
							<p><?php echo $row1[year]; ?></p>
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
												  <th>Exam Type</th>
												  <th>BM</th>
												  <th>BA</th>
												  <th>MM</th>
												  <th>SN</th>
												  <th>SEJ</th>
												  <th>PQS</th>
												  <th>PSI</th>
												</tr>
											  </thead>
											  
											  <tbody>
												<tr class="table-warning">
													<td>Penilaian Peperiksaan 1</td>
													<td><?php echo $row1[BM]; ?></td>
													<td><?php echo $row1[BA]; ?></td>
													<td><?php echo $row1[MM]; ?></td>
													<td><?php echo $row1[SN]; ?></td>
													<td><?php echo $row1[SEJ]; ?></td>
													<td><?php echo $row1[PQS]; ?></td>
													<td><?php echo $row1[PSI]; ?></td>
												</tr>
												
												<tr class="table-secondary">
													<td>Peperiksaan Pertengahan Tahun</td>
													<td><?php echo $row2[BM]; ?></td>
													<td><?php echo $row2[BA]; ?></td>
													<td><?php echo $row2[MM]; ?></td>
													<td><?php echo $row2[SN]; ?></td>
													<td><?php echo $row2[SEJ]; ?></td>
													<td><?php echo $row2[PQS]; ?></td>
													<td><?php echo $row2[PSI]; ?></td>
												</tr>
												
												<tr class="table-warning">
													<td>Peperiksaan Percubaan</td>
													<td><?php echo $row3[BM]; ?></td>
													<td><?php echo $row3[BA]; ?></td>
													<td><?php echo $row3[MM]; ?></td>
													<td><?php echo $row3[SN]; ?></td>
													<td><?php echo $row3[SEJ]; ?></td>
													<td><?php echo $row3[PQS]; ?></td>
													<td><?php echo $row3[PSI]; ?></td>
												</tr>
												
												
												<tr class="table-secondary">
													<td>Peperiksaan Akhir Tahun</td>
													<td><?php echo $row4[BM]; ?></td>
													<td><?php echo $row4[BA]; ?></td>
													<td><?php echo $row4[MM]; ?></td>
													<td><?php echo $row4[SN]; ?></td>
													<td><?php echo $row4[SEJ]; ?></td>
													<td><?php echo $row4[PQS]; ?></td>
													<td><?php echo $row4[PSI]; ?></td>
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