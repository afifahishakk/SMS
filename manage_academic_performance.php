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
.mdi{
	font-size:20px;
}
</style>

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
		<?php
			
				$code=$_GET['code'];
				$act=$_GET['act'];

				if ($act=='del')
				{
					$a_id =  $_GET['a_id'];
					
					$delete = mysql_query("DELETE FROM academic WHERE a_id = '$a_id'");
					
					
					if($delete == true)
					{
						echo "<div class='alert alert-danger alert-dismissible'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>Thank you!</strong> Academic Performance details successfully deleted.
							</div>";
					}
						
				}

				
			?>
          <div class="row">
            
            
           <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Manage Academic Performance</h4>
                  <div class="table-responsive">
                    <table id="datatable" class="table dataTable no-footer" role="grid">
                      <thead>
                        <tr>
						  <th>Student</th>
						  <th>Exam</th>
						  <th>Year</th>
						  <th>BM</th>
						  <th>BA</th>
						  <th>MM</th>
						  <th>SN</th>
						  <th>SEJ</th>
						  <th>PQS</th>
						  <th>PSI</th>
						  <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php
					  
						$sql = mysql_query("SELECT * FROM academic a, enrollment s
															WHERE a.student_ic = s.ic
															ORDER BY a.student_ic ASC");
						while($row = mysql_fetch_array($sql))
						{
							//get exam name
							$sqlExam = mysql_query("SELECT * FROM academic_type WHERE a_type_id = '$row[a_type_id]'");
							$rowExam = mysql_fetch_array($sqlExam);
						
							if($rowExam[a_type_id] == 1)
								$examType = "<span class='badge badge-success'>$rowExam[a_type]</span>";
							else if($rowExam[a_type_id] == 2)
								$examType = "<span class='badge badge-primary'>$rowExam[a_type]</span>";
							else if($rowExam[a_type_id] == 3)
								$examType = "<span class='badge badge-warning'>$rowExam[a_type]</span>";
							else if($rowExam[a_type_id] == 4)
								$examType = "<span class='badge badge-info'>$rowExam[a_type]</span>";
									
							echo "<tr>
									<td class='py-1'><img src='photo/$row[photo]'/> $row[name]</td>
									<td>$examType</td>
									<td>$row[year]</td>
									<td>$row[BM]</td>
									<td>$row[BA]</td>
									<td>$row[MM]</td>
									<td>$row[SN]</td>
									<td>$row[SEJ]</td>
									<td>$row[PQS]</td>
									<td>$row[PSI]</td>
									<td>
															<a href='update_academic_performance.php?a_id=$row[a_id]'
															data-toggle='tooltip' data-placement='left' title='Update'>
																<i class='icon icon-pencil text-success'></i>
															</a>
															<a href='manage_academic_performance.php?act=del&a_id=$row[a_id]'
															data-toggle='tooltip' data-placement='left' title='Remove'
															onclick=\"return confirm('Are you sure you want to delete this academic performance?');\">
																<i class='icon icon-trash4 text-danger'></i>
															</a>
															
															
									</td>
									</tr>";
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