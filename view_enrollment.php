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
				
				if(isset($_POST['myselect2']))
				{
						
						$ic = $_POST[ic];
						$myselect2 = $_POST[myselect2];
						$setStatus = mysql_query("UPDATE enrollment SET status = '$myselect2' WHERE ic = '$ic'");
						
						if($setStatus == true)
						{
							echo "<div class='alert alert-success alert-dismissible'>
										<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
										<strong>Thank you!</strong> Student enrollment status successfully updated.
								 </div>";
						}
				}
				
				
				$class_id = $_GET['class_id'];
				$sql = mysql_query("SELECT * FROM classes WHERE class_id = '$class_id'");
				$row = mysql_fetch_array($sql);

				

				
			?>
          <div class="row">
            
            
           <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
				<h4 class="card-title"><?php echo "Student Enrollment Approval for Class $row[class_name] Session $row[class_session]"; ?></h4>
                  <p class="card-description text-danger">
                      ** Click on Student name to view full details.
                    </p>
				  <div class="table-responsive">
                    <table id="datatable" class="table dataTable no-footer" role="grid">
                      <thead>
                        <tr>
                          <th>Student</th>
						  <th>IC</th>
                          <th>DOB</th>
                          <th>Race</th>
						  <th>Gender</th>
						  <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php
					  
						$sql = mysql_query("SELECT * FROM enrollment WHERE class_id = '$class_id'");
						while($row = mysql_fetch_array($sql))
						{
							//race
							$sqlRace = mysql_query("SELECT * FROM race WHERE race_id = '$row[race_id]'");
							$rowRace = mysql_fetch_array($sqlRace);
							
							// gender
							$sqlGender = mysql_query("SELECT * FROM gender WHERE gender_id = '$row[gender_id]'");
							$rowGender = mysql_fetch_array($sqlGender);
							
							// class
							$sqlClass = mysql_query("SELECT * FROM classes WHERE class_id = '$row[class_id]'");
							$rowClass = mysql_fetch_array($sqlClass);
							
							

							echo "<tr>	
									<td class='py-1'><img src='photo/$row[photo]'/> <a href='enrollment_details.php?ic=$row[ic]'>$row[name]</a></td>
									<td>
										<a href='ic/$row[ic_copy]' target='_blank' data-toggle='tooltip' data-placement='right' title='view ic'><span class='badge badge-primary'>$row[ic]</span></a>
									</td>
									<td>$row[dob]</td>
									<td>$rowRace[race]</td>
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
											echo  "<form method='post'>
																	<input type='hidden' name='ic' value='$row[ic]'>
																		<select name='myselect2' class='form-control' style='width:120px' onchange='javascript: submit()'>";
																		$getStatus = mysql_query("SELECT * FROM registration_status");
																		while($rowStatus = mysql_fetch_array($getStatus))
																		{
																			if($rowStatus[status] == $row[status])
																				echo "<option selected>$rowStatus[status]</option>";
																			else
																				echo "<option>$rowStatus[status]</option>";
																		}
																	echo"</select>
																	</form>";
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