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
				<h4 class="card-title">List of Registered Parent</h4>
                  <div class="table-responsive">
                    <table id="datatable" class="table dataTable no-footer" role="grid">
                      <thead>
                        <tr>
                          <th>Photo</th>
						  <th>ID</th>
						  <th>Name</th>
                          <th>Phone</th>
                          <th>Email</th>
						  <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php
					  
						$sql = mysql_query("SELECT * FROM login l, parent s
															WHERE l.UserID = s.username
															AND l.UserLvl = 4");
						while($row = mysql_fetch_array($sql))
						{
							if($row[Status] == "Active")
							{
								$displayStatus = "
														<span class='badge badge-primary'>
															$row[Status]
														</span>";
							}
							else if($row[Status] == "Inactive")
							{
								$displayStatus = "<span class='badge badge-danger'>
														$row[Status]
													</span>";
							}

							echo "<tr>	
									<td class='py-1'><img src='photo/$row[photo]' data-toggle='tooltip' data-placement='right' title data-original-title='$row[username]'/></td>
									<td>$row[username]</td>
									<td>$row[name]</td>
									<td>$row[phone_no]</td>
									<td>$row[email]</td>
									<td>$displayStatus</td>
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