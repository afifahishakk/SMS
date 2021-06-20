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
					$r_fee_id =  $_GET['r_fee_id'];
					
					$delete = mysql_query("DELETE FROM registration_fee WHERE r_fee_id = '$r_fee_id'");
					
					
					if($delete == true)
					{
						echo "<div class='alert alert-danger alert-dismissible'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>Thank you!</strong> Registration Fee details successfully deleted.
							</div>";
					}
						
				}

				
			?>
          <div class="row">
            
            
           <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">List of Registration Fee</h4>
                  <div class="table-responsive">
                    <table id="datatable" class="table dataTable no-footer" role="grid">
                      <thead>
                        <tr>
						  <th>No.</th>
                          <th>Category</th>
                          <th>Type</th>
                          <th>Fee (RM)</th>
						  <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php
					  
						$bil = 1;
						$sql = mysql_query("SELECT * FROM registration_fee");
						while($row = mysql_fetch_array($sql))
						{
							//get category name
							$sqlC = mysql_query("SELECT * FROM fee_category WHERE fee_category_id = '$row[fee_category_id]' ORDER BY fee_category_id ASC");
							$rowC = mysql_fetch_array($sqlC);
							
							if($rowC[fee_category_id] == 1)
								$category = "<span class='badge badge-primary'>$rowC[fee_category]</span>";
							else if($rowC[fee_category_id] == 2)
								$category = "<span class='badge badge-info'>$rowC[fee_category]</span>";
							else if($rowC[fee_category_id] == 3)
								$category = "<span class='badge badge-success'>$rowC[fee_category]</span>";
							
							echo "<tr>
									<td>$bil</td>
									<td>$category</td>
									<td>$row[fee_type]</td>
									<td>$row[fee]</td>
									<td>
															<a href='update_registration_fee.php?r_fee_id=$row[r_fee_id]'
															data-toggle='tooltip' data-placement='left' title='Update'>
																<i class='icon-pencil text-primary'></i>
															</a>
															<a href='manage_reg_fee.php?act=del&r_fee_id=$row[r_fee_id]'
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