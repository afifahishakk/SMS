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
					$m_fee_id =  $_GET['m_fee_id'];
					$year =  $_GET['year'];
					
					$delete = mysql_query("DELETE FROM monthly_fee WHERE m_fee_id = '$m_fee_id'");
					
					
					if($delete == true)
					{
						echo "<div class='alert alert-danger alert-dismissible'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>Thank you!</strong> Monthly Fee details for year successfully deleted.
							</div>";
					}
						
				}

				
			?>
          <div class="row">
            
            
           <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">List of Montlhy Fee</h4>
                  <div class="table-responsive">
                    <table id="datatable" class="table dataTable no-footer" role="grid">
                      <thead>
                        <tr>
						  <th>No.</th>
                          <th>Year</th>
                          <th>Fee (RM)</th>
						  <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php
					  
						$bil = 1;
						$sql = mysql_query("SELECT * FROM monthly_fee");
						while($row = mysql_fetch_array($sql))
						{
							echo "<tr>
									<td>$bil</td>
									<td>$row[year]</td>
									<td>$row[fee]</td>
									<td>
															<a href='update_monthly_fee.php?m_fee_id=$row[m_fee_id]'
															data-toggle='tooltip' data-placement='left' title='Update'>
																<i class='icon-pencil text-primary'></i>
															</a>
															<a href='manage_monthly_fee.php?act=del&m_fee_id=$row[m_fee_id]&year=$row[year]'
															data-toggle='tooltip' data-placement='left' title='Remove'
															onclick=\"return confirm('Are you sure you want to delete this registration fee?');\">
																<i class='icon-trash4 text-danger'></i>
															</a>
									</td>
									</tr>";
									
							$bil++;
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