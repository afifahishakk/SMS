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
		<?php
			
				$code=$_GET['code'];
				$act=$_GET['act'];

				if ($act=='del')
				{
					$p_id =  $_GET['p_id'];
					
					$delete = mysql_query("DELETE FROM performance WHERE p_id = '$p_id'");
					
					
					if($delete == true)
					{
						echo "<div class='alert alert-danger alert-dismissible'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>Thank you!</strong> Performance details successfully deleted.
																  </div>";
					}
						
				}

				
			?>
          <div class="row">
            
            
           <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">List of Performance</h4>
                  <div class="table-responsive">
                    <table id="datatable" class="table dataTable no-footer" role="grid">
                      <thead>
                        <tr>
						  <th>Student</th>
						  <th>Class</th>
                          <th>Hafazan</th>
						  <th>exam</th>
						  <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php
					  
						$sql = mysql_query("SELECT * FROM performance p, enrollment s
															WHERE p.student_ic = s.ic
															ORDER BY p.student_ic ASC");
						while($row = mysql_fetch_array($sql))
						{
							//class
							$sqlClass = mysql_query("SELECT * FROM classes WHERE class_id = '$row[class_id]'");
							$rowClass = mysql_fetch_array($sqlClass);
									
							echo "<tr>
									<td class='py-1'><img src='photo/$row[photo]'/> $row[name]</td>
									<td>$rowClass[class_name]</td>
									<td>$row[hafazan]</td>
									<td>$row[exam]</td>
									<td>
															<a href='update_performance.php?p_id=$row[p_id]'
															data-toggle='tooltip' data-placement='left' title='Update'>
																<i class='icon-pencil text-success'></i>
															</a>
															<a href='manage_performance.php?act=del&p_id=$row[p_id]'
															data-toggle='tooltip' data-placement='left' title='Remove'
															onclick=\"return confirm('Are you sure?');\">
																<i class='icon-trash4 text-danger'></i>
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