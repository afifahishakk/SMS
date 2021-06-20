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
				<h4 class="card-title">Your children enrollment status</h4>
                  
				  <div class="table-responsive">
                    <table id="datatable" class="table dataTable no-footer" role="grid">
                      <thead>
                        <tr>
                          <th>Child</th>
						  <th>IC</th>
                          <th>DOB</th>
						  <th>Gender</th>
                        
						  <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php
					  
						$sql = mysql_query("SELECT * FROM enrollment WHERE parent = '$_SESSION[UserID]'");
						while($row = mysql_fetch_array($sql))
						{
							
							// gender
							$sqlGender = mysql_query("SELECT * FROM gender WHERE gender_id = '$row[gender_id]'");
							$rowGender = mysql_fetch_array($sqlGender);
							
							

							echo "<tr>	
									<td class='py-1'><img src='photo/$row[photo]'/> <a href='enrollment_details.php?ic=$row[ic]'>$row[name]</a></td>
									<td>
										<a href='ic/$row[ic_copy]' target='_blank' data-toggle='tooltip' data-placement='right' title='view ic'><span class='badge badge-primary'>$row[ic]</span></a>
									</td>
									<td>$row[dob]</td>
									<td>$rowGender[gender]</td>
									<td>";
									
										//cek status
										if($row[status] == "Approved")
										{
											echo "<span class='badge badge-success'>$row[status]</span>";
										}
										else if($row[status] == "Rejected") 
										{
											echo "<span class='badge badge-danger'>$row[status]</span>";
										}
										else
										{
											echo "<span class='badge badge-warning'>$row[status]</span>";
										}
									
									echo"</td>
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