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
		
          <div class="row">
            
            
           <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Payment History</h4>
                  <div class="table-responsive">
                    <table id="datatable" class="table dataTable no-footer" role="grid">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Date</th>
                          <th>Child</th>
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
															AND p.username = '$_SESSION[UserID]'");
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
							else if ($row[payment_status] == "Paid")
							{
								$payment_status = "<span class='badge badge-success'>$row[payment_status]</span></a>";
							}
							else if ($row[payment_status] == "Partial Paid")
							{
								$payment_status = "<span class='badge badge-primary'>$row[payment_status]</span></a>";
							}
							else if ($row[payment_status] == "Declined")
							{
								$payment_status = "<span class='badge badge-danger'>$row[payment_status]</span></a>";
							}
							
							//get payment
							$sqlPay = mysql_query("SELECT * FROM payment_type WHERE p_type_id = '$row[p_type_id]'");
							$rowPay = mysql_fetch_array($sqlPay);
							
							//payment type
							if($rowPay[p_type_id] == 1)
							{
								$payType = "<span class='badge badge-primary'>$rowPay[p_type]</span></a>";
							}
							else if($rowPay[p_type_id] == 2)
							{
								$payType = "<span class='badge badge-success'>$rowPay[p_type]</span></a>";
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
									<td><span class='badge badge-success'>$row[payment_id]</span></td>
									<td>$dateStringFormat</td>
									<td>$rowStd[name]</td>
									<td>
										$payType<br />
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