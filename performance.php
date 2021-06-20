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
                  <h4 class="card-title">Student Performance</h4>
                  <hr />
                  <div class="table-responsive">
                    <table id="datatable" class="table dataTable no-footer" role="grid">
                      <thead>
                        <tr>
						  <th>Child</th>
						  <th>Class</th>
                          <th>Subject</th>
						  <th>Grade</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php
					  
						$sql = mysql_query("SELECT * FROM performance pf, student s
															WHERE pf.student_ic = s.ic
															ORDER BY pf.student_ic ASC");
						while($row = mysql_fetch_array($sql))
						{
							//subj
							$sqlSubjct = mysql_query("SELECT * FROM subject WHERE subject_id = '$row[subject_id]'");
							$rowSubjct = mysql_fetch_array($sqlSubjct);
									
							echo "<tr>
									<td>$row[name]</td>
									<td>$row[class_name]</td>
									<td>$rowSubjct[subject]</td>
									<td>$row[grade]</td>
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