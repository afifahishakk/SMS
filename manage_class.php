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
					$class_id =  $_GET['class_id'];
					
					$delete = mysql_query("DELETE FROM classes WHERE class_id = '$class_id'");
					
					
					if($delete == true)
					{
						echo "<div class='alert alert-danger alert-dismissible'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>Thank you!</strong> Class details successfully deleted.
																  </div>";
					}
						
				}

				
			?>
          <div class="row">
            
            
           <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">List of Classes</h4>
                  <div class="table-responsive">
                    <table id="datatable" class="table dataTable no-footer" role="grid">
                      <thead>
                        <tr>
                          <th>Class Name</th>
						  <th>Session</th>
						  <th>Availability</th>
						  <th>Max Student</th>
						  <th>Status</th>
						  <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php
					  
						$sql = mysql_query("SELECT * FROM classes ORDER BY class_id ASC");
						while($row = mysql_fetch_array($sql))
						{
							if($row[status] == "Open")
							{
								$displayStatus = "<span class='badge badge-primary'>$row[status]</span>";
							}
							else if($row[status] == "Close")
							{
								$displayStatus = "<span class='badge badge-danger'>$row[status]</span>";
							}
							
							echo "<tr>
									<td>$row[class_name]</td>
									<td>$row[class_session]</td>
									<td>$row[availability]</td>
									<td>$row[max_student]</td>
									<td>$displayStatus</td>
									<td>
															
															<a href='update_class.php?class_id=$row[class_id]'
															data-toggle='tooltip' data-placement='left' title='Update'>
																<i class='icon-pencil text-success'></i>
															</a>
															<a href='manage_class.php?act=del&class_id=$row[class_id]'
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