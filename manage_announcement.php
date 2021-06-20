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
					$announcement_id =  $_GET['announcement_id'];
					
					$delete = mysql_query("DELETE FROM announcement WHERE announcement_id = '$announcement_id'");
					
					
					if($delete == true)
					{
						echo "<div class='alert alert-danger alert-dismissible'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>Thank you!</strong> Announcement details successfully deleted.
																  </div>";
					}
						
				}

				
			?>
          <div class="row">
            
            
           <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">List of Announcement</h4>
                  <div class="table-responsive">
                    <table id="datatable" class="table dataTable no-footer" role="grid">
                      <thead>
                        <tr>
                          <th>Photo</th>
						  <th>ID</th>
                          <th>Date</th>
                          <th>Title</th>
						  <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php
					  
						$sql = mysql_query("SELECT * FROM announcement ORDER BY announcement_id ASC");
						while($row = mysql_fetch_array($sql))
						{
							echo "<tr>
									<td class='py-1'><img src='announcement/$row[image]' /></td>
									<td><label class='badge badge-primary'>$row[announcement_id]</label></td>
									<td>$row[announcement_date]</td>
									<td>$row[title]</td>
									<td>
															<a href='update_announcement.php?announcement_id=$row[announcement_id]'
															data-toggle='tooltip' data-placement='left' title='Update'>
																<i class='icon-pencil text-primary'></i>
															</a>
															<a href='manage_announcement.php?act=del&announcement_id=$row[announcement_id]'
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