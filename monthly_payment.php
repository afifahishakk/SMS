<?php
include "conn/conn.php";
error_reporting(0);
session_start();
if (empty($_SESSION[UserID]) AND empty($_SESSION[Password]))
{
  header("location:index.php");
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
			
				$act = $_GET['act'];

				if ($act=='display')
				{
					$payment_status =  $_GET['payment_status'];
					$payment_id =  $_GET['payment_id'];
					
					echo "<div class='alert alert-success alert-dismissible'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>Thank you!</strong> Payment ID $payment_id was successfully update to $payment_status.
							</div>";
					
						
				}

				
			?>
          <div class="row">
            
            
           <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Manage Monthly Fees</h4>
                  <div class="table-responsive">
                    <table id="datatable" class="table dataTable no-footer" role="grid">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Date</th>
                          <th>Student</th>
                          <th>Pay./ Details</th>
						  <th>Month/Year</th>
						  <th>Option</th>
						  <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php
					  
						
						$sql = mysql_query("SELECT * FROM payment pay, parent p
															WHERE pay.parent = p.username
															AND pay.p_type_id = 2");
						while($row = mysql_fetch_array($sql))
						{
							
							//child
							$sqlStd = mysql_query("SELECT * FROM enrollment WHERE ic = '$row[student_ic]'");
							$rowStd = mysql_fetch_array($sqlStd);
							
							
							$dateString = str_replace('-', '/', $row[payment_date]);
							$dateStringFormat = date('d/m/Y', strtotime($dateString));
							
							
							//payment option
							if($row[payment_option] == "Online Banking")
							{
								$payment_option = "<a href='#modal' data-toggle='modal' data-target='#details$row[payment_id]' title='view payment proof'>
														<span class='badge badge-primary'>$row[payment_option]</span>
													</a>";
							}
							else
							{
								$payment_option = "<span class='badge badge-success'>$row[payment_option]</span>";
							}
							
							//payment status
							if($row[payment_status] == "Pending")
							{
								$payment_status = "<span class='badge badge-warning'>$row[payment_status]</span></a>";
							}
							else if ($row[payment_status] == "Declined")
							{
								$payment_status = "<span class='badge badge-danger'>$row[payment_status]</span></a>";
							}
							else if ($row[payment_status] == "Partial Paid")
							{
								$payment_status = "<span class='badge badge-primary'>$row[payment_status]</span></a>";
							}
							else if ($row[payment_status] == "Paid")
							{
								$payment_status = "<span class='badge badge-success'>$row[payment_status]</span></a>";
							}
							
							//payment month
							if($row[month] == 0)
							{
								$month = "-";
								$year = "";
							}
							else if($row[month] != 0)
							{
								$month = $row[month];
								$year = "/" . $row[year];
							}
							
							


							echo "<tr>
									<td>
										<a href='#modal' data-toggle='modal' data-target='#detailsPayment$row[payment_id]'>
											<span class='badge badge-success'>$row[payment_id]</span>
										</a>
									</td>
									<td>$dateStringFormat</td>
									<td>$rowStd[name]</td>
									<td>
										<span class='badge badge-info'>Amount: $row[amount]</span><br />
										<span class='badge badge-warning'>Paid: $row[paid_amount]</span><br />
										<span class='badge badge-danger'>Balance: $row[balance]</span>
									</td>
									<td>$month$year</td>
									<td>$payment_option</td>
									<td>$payment_status</td>
									</tr>";
						
							/* popup modal untuk melihat payment proof */
							include "modal_view_proof.php";
							
							/* popup modal untuk payment approval */
							include "modal_monthly_payment_approval_dashboard.php";
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