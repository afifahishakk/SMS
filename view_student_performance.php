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
            
            
           <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Student Performance for Hafazan</h4>
                  <div class="table-responsive">
                    <table id="datatable" class="table dataTable no-footer" role="grid">
                      <thead>
                        <tr>
						  <th>Student</th>
						  <th>Week</th>
                          <th>Month</th>
						  <th>Year</th>
						  <th>View</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php
					 
						$sql = mysql_query("SELECT * FROM enrollment
															WHERE purpose = 'Both'
															OR purpose = 'Tahfiz'
															AND Status = 'Approved'");
						while($row = mysql_fetch_array($sql))
						{
							//get child performance
							$sqlPer = mysql_query("SELECT * FROM hafazan WHERE student_ic = '$row[ic]'
																			GROUP BY week ASC,
																			month ASC,
																			year ASC");
							while($rowPer = mysql_fetch_array($sqlPer))
							{
								echo "<tr>
									<td class='py-1'><img src='photo/$row[photo]'/> $row[name]</td>
									<td>$rowPer[week]</td>
									<td>$rowPer[month]</td>
									<td>$rowPer[year]</td>
									<td>
															<a href='view_hafazan_performance_details.php?student_ic=$row[ic]&name=$row[name]'
															data-toggle='tooltip' data-placement='left' title='View'>
																<i class='mdi mdi-comment-text-outline text-primary'></i>
															</a>
															
															
									</td>
									</tr>";
							}
							
							
									
							
						}
					  ?>
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            
          
          </div>
		  
		  <div class="row">
            
            
           <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">View Student Academic Performance</h4>
                  <div class="table-responsive">
                    <table id="datatable2" class="table dataTable no-footer" role="grid">
                      <thead>
                        <tr>
						  <th>Student</th>
						  <th>Year</th>
						  <th>View</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php
					  
						$sql = mysql_query("SELECT * FROM enrollment
															WHERE purpose = 'Both'
															OR purpose = 'SPM'
															AND Status = 'Approved'");
						while($row = mysql_fetch_array($sql))
						{
							$sqlPer = mysql_query("SELECT * FROM academic
															WHERE student_ic = '$row[ic]'
															GROUP BY student_ic");
															
							while($rowPer = mysql_fetch_array($sqlPer))
							{
										
								echo "<tr>
										<td class='py-1'><img src='photo/$row[photo]'/> $row[name]</td>
										<td>$rowPer[year]</td>
										<td>
																<a href='view_academic_performance_details.php?student_ic=$row[ic]&name=$row[name]'
																data-toggle='tooltip' data-placement='left' title='View'>
																	<i class='mdi mdi-comment-text-outline text-primary'></i>
																</a>
																
																
										</td>
										</tr>";
							}
							
							
									
							
						}
					  
						
					  ?>
                        
                      </tbody>
                    </table>
                  </div>
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