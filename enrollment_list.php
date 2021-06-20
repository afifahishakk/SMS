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
				$act=$_GET['act'];

				if ($act=='del')
				{
					$ic =  $_GET['ic'];
					
					$delStd = mysql_query("DELETE FROM enrollment WHERE ic = '$ic'");
					
					if($delStd == true)
					{
						echo "<div class='alert alert-danger alert-dismissible'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>Thank you!</strong> Student enrollment details successfully deleted.
							 </div>";
					}
						
				}
			?>
          <div class="row">
           
            
           <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
				<h4 class="card-title">List of Student Enrollment</h4>
                  
				  <div class="table-responsive">
                    <table id="datatable" class="table dataTable no-footer" role="grid">
                      <thead>
                        <tr>
                          <th>Student</th>
						  <th>IC</th>
                          <th>DOB</th>
						  <th>Gender</th>
						  <th>Status</th>
						  <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php
					  
						$sql = mysql_query("SELECT * FROM enrollment");
						while($row = mysql_fetch_array($sql))
						{
							//nationality
							$sqlNationality = mysql_query("SELECT * FROM nationality WHERE nationality_id = '$row[nationality_id]'");
							$rowNationality = mysql_fetch_array($sqlNationality);
							
							// gender
							$sqlGender = mysql_query("SELECT * FROM gender WHERE gender_id = '$row[gender_id]'");
							$rowGender = mysql_fetch_array($sqlGender);
							
							

							echo "<tr>	
									<td class='py-1'><img src='photo/$row[photo]'/> <a href='student_enrollment_details.php?ic=$row[ic]'>$row[name]</a></td>
									<td>
										<a href='#modal' data-toggle='modal' data-target='#details$row[ic]' title='view ic'>
											$row[ic]
										</a>
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
									<td>
															<a href='update_student.php?ic=$row[ic]'
															data-toggle='tooltip' data-placement='left' title='Update'>
																<i class='icon-pencil text-primary'></i>
															</a>
															<a href='enrollment_list.php?act=del&ic=$row[ic]'
															data-toggle='tooltip' data-placement='left' title='Remove'
															onclick=\"return confirm('Are you sure you want to delete this student?');\">
																<i class='icon-trash4 text-danger'></i>
															</a>
									</td>
									</tr>";
						
							/* popup modal untuk melihat ic anak/student */
							include "modal_view_child_ic.php";
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