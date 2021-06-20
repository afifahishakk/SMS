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
			
				date_default_timezone_set("Asia/Kuala_Lumpur");
				$today = date("Y-m-d");
					
				
				
					if(isset($_POST['myselect']))
					{
						
						$payment_id = $_POST[payment_id];
						$myselect = $_POST[myselect];
						$setPayment = mysql_query("UPDATE payment SET payment_status = '$myselect' WHERE payment_id = '$payment_id'");
						
						//if($myselect == "")
						
						if($setPayment == true)
						{
							echo "<div class='alert alert-success alert-dismissible'>
										<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
										<strong>Thank you!</strong> Payment status for ID $payment_id was updated.
								 </div>";
						}
					}

				$act = $_GET['act'];
				$payment_id =  $_GET['payment_id'];
				$payment_date =  $_GET['payment_date'];
				
				
				

				
			?>
          <div class="row">
            
            
           <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Manage Registration Fees</h4>
                  <div class="table-responsive">
                    <table id="datatable" class="table dataTable no-footer" role="grid">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Date</th>
                          <th>Student</th>
						  <th>Option</th>
						  <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
					  <?php
					  
					  
						$sql = mysql_query("SELECT * FROM payment pay, parent p
															WHERE pay.parent = p.username
															AND pay.p_type_id = 1");
						while($row = mysql_fetch_array($sql))
						{
							
							//child
							$sqlStd = mysql_query("SELECT * FROM enrollment WHERE ic = '$row[student_ic]'");
							$rowStd = mysql_fetch_array($sqlStd);
							
							//get payment
							$sqlPay = mysql_query("SELECT * FROM payment_type WHERE p_type_id = '$row[p_type_id]'");
							$rowPay = mysql_fetch_array($sqlPay);
							
							
							//payment option
							if($row[payment_option] == "Online Banking")
							{
								$payment_option = "<a href=\"javascript:void(0);\" onclick=\"PopupCenterDual('proof/$row[proof]','NIGRAPHIC','550','550');\">
														<span class='badge badge-primary'><i = class='mdi mdi-magnify'></i> $row[payment_option]</span>
													</a>";
							}
							else
							{
								$payment_option = "<span class='badge badge-success'>$row[payment_option]</span>";
							}
							
							

							echo "<tr>
									<td><span class='badge badge-success'>$row[payment_id]</span></td>
									<td>$row[payment_date]</td>
									<td>$rowStd[name]</td>
									<td>$payment_option</td>
									<td>";
									
										//cek payment status
										if($row[payment_status] == "Approved")
										{
											echo "<span class='badge badge-success'>$row[payment_status]</span>";
										}
										else if($row[payment_status] == "Declined") 
										{
											echo "<span class='badge badge-danger'>$row[payment_status]</span>";
										}
										else
										{
											echo  "<form method='post'>
																	<input type='hidden' name='payment_id' value='$row[payment_id]'>
																		<select name='myselect' class='form-control' onchange='javascript: submit()'>";
																		$getStatus = mysql_query("SELECT * FROM payment_status");
																		while($rowStatus = mysql_fetch_array($getStatus))
																		{
																			if($rowStatus[status] == $row[payment_status])
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