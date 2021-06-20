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
					$username =  $_GET['username'];
					
					$deleteLogin = mysql_query("DELETE FROM login WHERE UserID = '$username'");
					$delTeacher = mysql_query("DELETE FROM teacher WHERE username = '$username'");
					
					if(($deleteLogin == true) && ($delTeacher == true))
					{
						echo "<div class='alert alert-danger alert-dismissible'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>Thank you!</strong> Teacher details successfully deleted.
																  </div>";
					}
						
				}
				else if ($act=='activate')
				{
					$username =  $_GET['username'];
					
					$sql = mysql_query("UPDATE login SET Status = 'Active'WHERE UserID = '$username'");
					
					if($sql == true)
					{
						echo "<div class='alert alert-success alert-dismissible'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>Thank you!</strong> Teacher account successfully activated.
																  </div>";
					}
						
				}
				else if ($act=='deactivate')
				{
					$username =  $_GET['username'];
					
					$sql = mysql_query("UPDATE login SET Status = 'Inactive'WHERE UserID = '$username'");
					
					if($sql == true)
					{
						echo "<div class='alert alert-danger alert-dismissible'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>Thank you!</strong> Teacher account successfully deactivated.
																  </div>";
					}
						
				}
				
				
				else if ($act=='reset')
				{
					$username =  $_GET['username'];
					$name =  $_GET['name'];
					
					$sql = mysql_query("UPDATE login SET Password = '$username' WHERE UserID = '$username'");
					
					if($sql == true)
					{
						echo "<div class='alert alert-success alert-dismissible'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>Thank you!</strong> Teacher password $name successfully reset. (New password = $username).
							</div>";
					}
						
				}

				
			?>
          <div class="row">
            
            
           <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">List of Teacher</h4>
                  <div class="table-responsive">
                    <table id="datatable" class="table dataTable no-footer" role="grid">
                      <thead>
                        <tr>
                          <th>Teacher</th>
                          <th>Name</th>
                          <th>IC No.</th>
                          <th>Type</th>
						  <th>Acc.<br />Status</th>
						  <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php
					  
						$sql = mysql_query("SELECT * FROM login l, teacher s, gender g
															WHERE l.UserID = s.username
															AND s.gender_id = g.gender_id
															AND l.UserLvl = 2");
						while($row = mysql_fetch_array($sql))
						{
							if($row[Status] == "Active")
							{
								$displayStatus = "<a href='manage_teacher.php?act=deactivate&username=$row[username]'
													data-toggle='tooltip' data-placement='right' title='Deactivate'
													onclick=\"return confirm('Are you sure?');\">
														<button class='btn btn-primary btn-xs'>
															$row[Status]
														</button>
													</a>";
							}
							else if($row[Status] == "Inactive")
							{
								$displayStatus = "<a href='manage_teacher.php?act=activate&username=$row[username]'
													data-toggle='tooltip' data-placement='right' title='Activate'>
														<button class='btn btn-danger btn-xs'>
															$row[Status]
														</button>
													</a>";
							}
							
							
												
							echo "<tr>
									<td class='py-1'><img src='photo/$row[photo]' data-toggle='tooltip' data-placement='right' title data-original-title='$row[username]'/></td>
									<td>$row[name]</td>
									<td>
										<a href='#modal' data-toggle='modal' data-target='#details$row[ic_no]' title='view ic'>
											$row[ic_no]
										</a>
									</td>
									<td>$row[type]</td>
									<td>$displayStatus</td>
									<td>
									
															<a href='manage_teacher.php?act=reset&username=$row[username]&name=$row[name]'
															data-toggle='tooltip' data-placement='left' title='Reset Password'
															onclick=\"return confirm('Are you sure want to reset this teacher password?');\">
																<i class='ti ti-settings text-warning' style='font-size: 20px;'></i>
															</a>
															<a href='update_teacher.php?username=$row[username]'
															data-toggle='tooltip' data-placement='right' title='Update'>
																<i class='icon-pencil text-success'></i>
															</a>
															<a href='manage_teacher.php?act=del&username=$row[username]'
															data-toggle='tooltip' data-placement='right' title='Remove'
															onclick=\"return confirm('Are you sure?');\">
																<i class='icon-trash4 text-danger'></i>
															</a>
									</td>
									</tr>";
						
							
								
									/* popup modal untuk melihat ic teacher */
									include "modal_view_teacher_ic.php";
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