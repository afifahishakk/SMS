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
<script src="Chart.js/Chart.bundle.js"></script>
<style type="text/css">
	@media print
	{
		body {
			visibility: hidden;
		}
		button, a {
			display: none !important;
		}
		.noprint {
			display: none !important;
		}
		.visible {
			visibility: visible;
			position: absolute;
			top: 50px;
			left: 10px;
		}
	}
	</style>
	
<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <?php include "layout/tophp";?>
	
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_sidebar.html -->
       <?php include "layout/menu.php";?>
	   
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            
            
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Annual Report</h4>

                  <form method="post" enctype="multipart/form-data">
                    <p class="card-description text-primary">
                      <i class='menu-icon mdi mdi-chart-bar'></i> Generate Annual Fees Paid
                    </p>
					
                    <div class="row">
					  <div class="col-md-6">
						<div class="form-group">
							<label>Year</label>
							<select class='form-control' style='width: 100%;' name='year' required>
								<option value=''>- choose year -</option>
								<option value='2019'>2019</option>
								<option value='2020'>2020</option>
								<option value='2021'>2021</option>
								<option value='2022'>2022</option>
								<option value='2023'>2023</option>
								<option value='2024'>2024</option>
								<option value='2025'>2025</option>
							</select>
						</div>
                      </div>
                    </div>
                    
                   
                    
                    
                    <br />
                    <button type="reset" class="btn btn-outline-dark"><i class="mdi mdi-refresh"></i> Reset</button>
					<button type="submit" name="generate" class="btn btn-primary mr-2"><i class="mdi mdi-check"></i> Generate</button>
                  </form>
				  
				  <?php
						if(isset($_POST['generate']))
						{
							$year = $_POST['year'];
							
							
							$sqlM1 = mysql_query("SELECT *, SUM(paid_amount) AS total_paid FROM payment
																			WHERE MONTH(payment_date) = '1'
																			AND YEAR(payment_date) = '$year'");
							$rowM1 = mysql_fetch_array($sqlM1);
							
							$sqlM2 = mysql_query("SELECT *, SUM(paid_amount) AS total_paid FROM payment
																			WHERE MONTH(payment_date) = '2'
																			AND YEAR(payment_date) = '$year'");
							$rowM2 = mysql_fetch_array($sqlM2);
							
							$sqlM3 = mysql_query("SELECT *, SUM(paid_amount) AS total_paid FROM payment
																			WHERE MONTH(payment_date) = '3'
																			AND YEAR(payment_date) = '$year'");
							$rowM3 = mysql_fetch_array($sqlM3);
							
							
							$sqlM4 = mysql_query("SELECT *, SUM(paid_amount) AS total_paid FROM payment
																			WHERE MONTH(payment_date) = '4'
																			AND YEAR(payment_date) = '$year'");
							$rowM4 = mysql_fetch_array($sqlM4);
							
							$sqlM5 = mysql_query("SELECT *, SUM(paid_amount) AS total_paid FROM payment
																			WHERE MONTH(payment_date) = '5'
																			AND YEAR(payment_date) = '$year'");
							$rowM5 = mysql_fetch_array($sqlM5);
							
							
							$sqlM6 = mysql_query("SELECT *, SUM(paid_amount) AS total_paid FROM payment
																			WHERE MONTH(payment_date) = '6'
																			AND YEAR(payment_date) = '$year'");
							$rowM6 = mysql_fetch_array($sqlM6);
							
							
							$sqlM7 = mysql_query("SELECT *, SUM(paid_amount) AS total_paid FROM payment
																			WHERE MONTH(payment_date) = '7'
																			AND YEAR(payment_date) = '$year'");
							$rowM7 = mysql_fetch_array($sqlM7);
							
							
							$sqlM8 = mysql_query("SELECT *, SUM(paid_amount) AS total_paid FROM payment
																			WHERE MONTH(payment_date) = '8'
																			AND YEAR(payment_date) = '$year'");
							$rowM8 = mysql_fetch_array($sqlM8);
							
							
							$sqlM9 = mysql_query("SELECT *, SUM(paid_amount) AS total_paid FROM payment
																			WHERE MONTH(payment_date) = '9'
																			AND YEAR(payment_date) = '$year'");
							$rowM9 = mysql_fetch_array($sqlM9);
							
							
							$sqlM10 = mysql_query("SELECT *, SUM(paid_amount) AS total_paid FROM payment
																			WHERE MONTH(payment_date) = '10'
																			AND YEAR(payment_date) = '$year'");
							$rowM10 = mysql_fetch_array($sqlM10);
							
							
							$sqlM11 = mysql_query("SELECT *, SUM(paid_amount) AS total_paid FROM payment
																			WHERE MONTH(payment_date) = '11'
																			AND YEAR(payment_date) = '$year'");
							$rowM11 = mysql_fetch_array($sqlM11);
							
							$sqlM12 = mysql_query("SELECT *, SUM(paid_amount) AS total_paid FROM payment
																			WHERE MONTH(payment_date) = '12'
																			AND YEAR(payment_date) = '$year'");
							$rowM12 = mysql_fetch_array($sqlM12);
							
							$totalPaid = $rowM1[total_paid] + 
											$rowM2[total_paid] + 
											$rowM3[total_paid] + 
											$rowM4[total_paid] + 
											$rowM5[total_paid] + 
											$rowM6[total_paid] + 
											$rowM7[total_paid] + 
											$rowM8[total_paid] + 
											$rowM9[total_paid] + 
											$rowM10[total_paid] + 
											$rowM11[total_paid] + 
											$rowM12[total_paid];
							
							echo "<hr/>
									<div class='visible'>
										<div class='container'>
											<canvas class='col-md-6 grid-margin stretch-card' id='myChart'></canvas>
										</div>
										
										<b>Total Paid Fees for year $year are RM$totalPaid</b>
									</div>";
								
							echo "<div class='container-fluid w-100'>
									  <button type='submit' name='submit' class='btn btn-primary float-left mt-4'  onclick='window.print()'>
										<i class='mdi mdi-printer mr-1'></i>Print
										</button>
									</div>";
						}
				?>
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
   <script>
						var ctx = document.getElementById("myChart");
						var myBarChart = new Chart(ctx, {
							type: 'bar',
							data: {
								labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
								datasets: [{
										label: 'Total Paid Fees for <?php echo $year; ?> RM',
										data: [<?php echo $rowM1[total_paid] . "," .
															$rowM2[total_paid] . "," .
															$rowM3[total_paid] . "," .
															$rowM4[total_paid] . "," .
															$rowM5[total_paid] . "," .
															$rowM6[total_paid] . "," .
															$rowM7[total_paid] . "," .
															$rowM8[total_paid] . "," .
															$rowM9[total_paid] . "," .
															$rowM10[total_paid] . "," .
															$rowM11[total_paid] . "," .
															$rowM12[total_paid]; ?>],
										backgroundColor: [
											'rgba(255,99,132,1)',
											'rgba(54, 162, 235, 1)',
											'rgba(255, 206, 86, 1)',
											'rgba(75, 192, 192, 1)',
											'rgba(153, 102, 255, 1)',
											'rgba(255, 159, 64, 1)',
											'rgba(255, 99, 132, 1)',
											'rgba(54, 162, 235, 1)',
											'rgba(255, 206, 86, 1)',
											'rgba(75, 192, 192, 1)',
											'rgba(153, 102, 255, 1)',
											'rgba(255, 159, 64, 1)'
										],
										borderColor: [
											'rgba(255,99,132,1)',
											'rgba(54, 162, 235, 1)',
											'rgba(255, 206, 86, 1)',
											'rgba(75, 192, 192, 1)',
											'rgba(153, 102, 255, 1)',
											'rgba(255, 159, 64, 1)',
											'rgba(255, 99, 132, 1)',
											'rgba(54, 162, 235, 1)',
											'rgba(255, 206, 86, 1)',
											'rgba(75, 192, 192, 1)',
											'rgba(153, 102, 255, 1)',
											'rgba(255, 159, 64, 1)'
										],
										borderWidth: 1
									}]
							},
							options: {
								scales: {
									yAxes: [{
											ticks: {
												beginAtZero: true
											}
										}]
								}
							}
						});
					</script>
</body>

</html>
<?php
}
?>