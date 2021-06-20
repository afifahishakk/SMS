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
    <?php include "layout/top.php";?>
	
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
                  <h4 class="card-title">Monthly Report</h4>

                  <form method="post" enctype="multipart/form-data">
                    <p class="card-description text-primary">
                      <i class='menu-icon mdi mdi-chart-bar'></i> Generate Monthly Fees Paid
                    </p>
					
					<hr />
					
                    <div class="row">
                      <div class="col-md-6">
						<div class="form-group">
							<label>Month</label>
							<select class='form-control' style='width: 100%;' name='month' required>
												<option value=''>- choose month -</option>
												<option value='01'>January</option>
												<option value='02'>February</option>
												<option value='03'>March</option>
												<option value='04'>April</option>
												<option value='05'>May</option>
												<option value='06'>June</option>
												<option value='07'>July</option>
												<option value='08'>August</option>
												<option value='09'>September</option>
												<option value='10'>October</option>
												<option value='11'>November</option>
												<option value='12'>December</option>
							</select>
						</div>
                      </div>
					  <div class="col-md-6">
						<div class="form-group">
							<label>Year</label>
							<select class='form-control' style='width: 100%;' name='year' required>
								<option value=''>- choose year -</option>
								<option value='2019'>2019</option>
								<option value='2020'>2020</option>
								<option value='2021'>2021</option>
								<option value='2022'>2022</option>
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
							$month = $_POST['month'];
							$year = $_POST['year'];
							
							$total1 = 0;
							
							/* PAPAR NAMA BULAN */
							if($month == 1)
								$month_name = "Jan";
							else if($month == 2)
								$month_name = "Feb";
							else if($month == 3)
								$month_name = "Mac";
							else if($month == 4)
								$month_name = "Apr";
							else if($month == 5)
								$month_name = "May";
							else if($month == 6)
								$month_name = "June";
							else if($month == 7)
								$month_name = "July";
							else if($month == 8)
								$month_name = "Aug";
							else if($month == 9)
								$month_name = "Sept";
							else if($month == 10)
								$month_name = "Oct";
							else if($month == 11)
								$month_name = "Nov";
							else if($month == 12)
								$month_name = "Dec";
							
							
							$sql = mysql_query("SELECT *, SUM(paid_amount) AS total_paid FROM payment");
																			
							$row = mysql_fetch_array($sql);
							
							echo "<hr/>
									<div class='visible'>
										<div class='container'>
											<canvas class='col-md-6 grid-margin stretch-card' id='myChart'></canvas>
										</div>
										
										<b>Total Paid Fees for $month_name $year are RM$row[total_paid]</b>
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
								labels: ['Total Paid Fees'],
								datasets: [{
										label: 'Total Paid Fees for <?php echo $month_name . " " . $year; ?> RM',
										data: [<?php echo $row[total_paid]; ?>],
										backgroundColor: [
											'rgba(54, 162, 235, 1)'
										],
										borderColor: [
											'rgba(54, 162, 235, 1)'
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