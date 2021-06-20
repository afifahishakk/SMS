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
					$h_id =  $_GET['h_id'];
					
					$delete = mysql_query("DELETE FROM hafazan WHERE h_id = '$h_id'");
					
					
					if($delete == true)
					{
						echo "<div class='alert alert-danger alert-dismissible'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>Thank you!</strong> Hafazan Performance details successfully deleted.
							</div>";
					}
						
				}

				
			?>
          <div class="row">
            
            
           <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Manage Hafazan Performance</h4>
                  <div class="table-responsive">
                    <table id="datatable" class="table dataTable no-footer" role="grid">
                      <thead>
                        <tr>
						  <th>Student</th>
						  <th>Day</th>
						  <th>Week</th>
                          <th>Month</th>
						  <th>Year</th>
						  <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php
					  
						$sql = mysql_query("SELECT * FROM hafazan h, enrollment s
															WHERE h.student_ic = s.ic
															ORDER BY h.student_ic ASC,
															day_position ASC,
															week ASC,
															year ASC");
						while($row = mysql_fetch_array($sql))
						{
									
							echo "<tr>
									<td class='py-1'><img src='photo/$row[photo]'/> $row[name]</td>
									<td>$row[day]</td>
									<td>$row[week]</td>
									<td>$row[month]</td>
									<td>$row[year]</td>
									<td>
															<a href='update_hafazan_performance.php?h_id=$row[h_id]'
															data-toggle='tooltip' data-placement='left' title='Update'>
																<i class='icon icon-pencil text-success'></i>
															</a>
															<a href='manage_hafazan_performance.php?act=del&h_id=$row[h_id]'
															data-toggle='tooltip' data-placement='left' title='Remove'
															onclick=\"return confirm('Are you sure you want to delete this hafazan performance?');\">
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