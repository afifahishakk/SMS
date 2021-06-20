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
	
    <!-- partial -->
    
      <!-- partial:../../partials/_sidebar.html -->
	   
      <!-- partial -->
      <div class="main-panel" style="width:100%">
        <div class="content-wrapper">
          <div class="row">
            
            <?php
			
				/* get parent id and name to generate childs data */
				$parent_id = $_GET['username'];
				$parent_name = $_GET['name'];
				
			?>
           <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
				<h4 class="card-title">List of <?php echo $parent_name; ?>'s Children</h4>
                  
				  <div class="table-responsive">
                    <table id="datatable" class="table dataTable no-footer" role="grid">
                      <thead>
                        <tr>
                          <th>Child</th>
						  <th>IC</th>
                          <th>DOB</th>
						  <th>Gender</th>
                          <th>Nationality</th>
						  <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php
					  
						$sql = mysql_query("SELECT * FROM enrollment WHERE parent = '$parent_id'");
						while($row = mysql_fetch_array($sql))
						{
							//nationality
							$sqlNationality = mysql_query("SELECT * FROM nationality WHERE nationality_id = '$row[nationality_id]'");
							$rowNationality = mysql_fetch_array($sqlNationality);
							
							// gender
							$sqlGender = mysql_query("SELECT * FROM gender WHERE gender_id = '$row[gender_id]'");
							$rowGender = mysql_fetch_array($sqlGender);
							
							

							echo "<tr>	
									<td class='py-1'><img src='photo/$row[photo]'/> $row[name]</td>
									<td>
										<a href='#modal' data-toggle='modal' data-target='#details$row[ic]' title='view ic'>
											$row[ic]
										</a>
									</td>
									<td>$row[dob]</td>
									<td>$rowGender[gender]</td>
									<td>$rowNationality[nationality]</td>
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
		
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    
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