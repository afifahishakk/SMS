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
	<style>
		.carousel-inner > .carousel-item {
		   height: 400px;
		}
		.carousel-caption {
		  top: 18rem;
		  z-index: 10;
		}
		#loadMore {
			padding-bottom: 30px;
			padding-top: 30px;
			text-align: center;
			width: 100%;
		}
		#loadMore a {
			display: inline-block;
			padding: 10px 30px;
			transition: all 0.25s ease-out;
			-webkit-font-smoothing: antialiased;
		}	
	</style>

	<body>
  		<div class="container-scroller">
  
    	<!-- partial:partials/_navbar.html -->
		<?php include "layout/top.php";?>
    
    	<!-- partial -->
    	<div class="container-fluid page-body-wrapper">
      	<!-- partial:partials/_sidebar.html -->
	  
	  		<?php include "layout/menu.php"; ?>
      
      		<!-- partial -->
      		<div class="main-panel">
        		<div class="content-wrapper">
					<?php
						if($_SESSION[UserLvl] == 1) 
						{
							//calculate total sales
							$sqlRevenue = mysql_query("SELECT *, SUM(paid_amount) AS total_paid FROM payment");
							$rowRevenue = mysql_fetch_array($sqlRevenue);

							//calculate total parent
							$sqlTC = mysql_query("SELECT * FROM parent p, login l WHERE p.username = l.UserID AND l.Status = 'Active'");
							$numRowTC = mysql_num_rows($sqlTC);

							//calculate total teacher
							$sqlTS = mysql_query("SELECT * FROM teacher s, login l WHERE s.username = l.UserID AND l.Status = 'Active'");
							$numRowTS = mysql_num_rows($sqlTS);

							//calculate total enrollment
							$sqlTB = mysql_query("SELECT * FROM enrollment WHERE Status = 'Approved'");
							$numRowTB = mysql_num_rows($sqlTB);

							date_default_timezone_set("Asia/Kuala_Lumpur");
							$today = date("Y-m-d");
							$month = date('m');
							$year = date('Y');


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

							$todayString = str_replace('-', '/', $today);
							$todayStringFormat = date('d/m/Y', strtotime($todayString));

							echo "<div class='row'>
									<div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card'>
									  <div class='card card-statistics'>
										<div class='card-body'>
										  <div class='clearfix'>
											<div class='float-left'>
											  <i class='mdi mdi-google-wallet text-success icon-lg'></i>
											</div>
											<div class='float-right'>
											  <p class='mb-0 text-right'>Paid Fees</p>
											  <div class='fluid-container'>
												<h3 class='font-weight-medium text-right mb-0'>RM$rowRevenue[total_paid]</h3>
											  </div>
											</div>
										  </div>
										  <p class='text-muted mt-3 mb-0'>
											<i class='mdi mdi-information mr-1' aria-hidden='true'></i> Total Paid Fees
										  </p>
										</div>
									  </div>
									</div>

									<div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card'>
									  <div class='card card-statistics'>
										<div class='card-body'>
										  <div class='clearfix'>
											<div class='float-left'>
											  <i class='mdi mdi-account-box text-primary icon-lg'></i>
											</div>
											<div class='float-right'>
											  <p class='mb-0 text-right'>Teacher</p>
											  <div class='fluid-container'>
												<h3 class='font-weight-medium text-right mb-0'>$numRowTS</h3>
											  </div>
											</div>
										  </div>
										  <p class='text-muted mt-3 mb-0'>
											<i class='mdi mdi-information mr-1' aria-hidden='true'></i> Total Active Teacher
										  </p>
										</div>
									  </div>
									</div>

									<div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card'>
									  <div class='card card-statistics'>
										<div class='card-body'>
										  <div class='clearfix'>
											<div class='float-left'>
											  <i class='mdi mdi-account-multiple text-danger icon-lg'></i>
											</div>
											<div class='float-right'>
											  <p class='mb-0 text-right'>Parent</p>
											  <div class='fluid-container'>
												<h3 class='font-weight-medium text-right mb-0'>$numRowTC</h3>
											  </div>
											</div>
										  </div>
										  <p class='text-muted mt-3 mb-0'>
											<i class='mdi mdi-information mr-1' aria-hidden='true'></i> Total Active Parent
										  </p>
										</div>
									  </div>
									</div>

									<div class='col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card'>
									  <div class='card card-statistics'>
										<div class='card-body'>
										  <div class='clearfix'>
											<div class='float-left'>
											  <i class='mdi mdi-kodi text-warning icon-lg'></i>
											</div>
											<div class='float-right'>
											  <p class='mb-0 text-right'>Enrollment</p>
											  <div class='fluid-container'>
												<h3 class='font-weight-medium text-right mb-0'>$numRowTB</h3>
											  </div>
											</div>
										  </div>
										  <p class='text-muted mt-3 mb-0'>
											<i class='mdi mdi-information mr-1' aria-hidden='true'></i> Approved Enrollment
										  </p>
										</div>
									  </div>
									</div>
								  </div>";
								  
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

								
				  
								echo "<div class='row'>
									<div class='col-lg-12 grid-margin'>
					  					<div class='card'>
											<div class='card-body'>
						  						<h4 class='card-title'>Registration Fees Payment</h4>
						 						<div class='table-responsive'>
													<table id='datatable' class='table dataTable no-footer' role='grid'>
							  							<thead>
															<tr>
															  <th>ID</th>
															  <th>Date</th>
															  <th>Student</th>
															  <th>Pay./ Details</th>
															  <th>Option</th>
															  <th>Status</th>
															</tr>
							  							</thead>
							  							<tbody>";
															$sql = mysql_query("SELECT * FROM payment pay, parent p
																								WHERE pay.parent = p.username
																								AND pay.p_type_id = 1");
															while($row = mysql_fetch_array($sql))
															{
																$url = "dashboard";
																
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
																		<td>$payment_option</td>
																		<td>$payment_status</td>
																		</tr>";
															
																/* popup modal untuk melihat payment proof */
																include "modal_view_proof.php";
																
																/* popup modal untuk payment approval */
																include "modal_reg_payment_approval_dashboard.php";
															}
							 							echo"</tbody>
													</table>
						  						</div>
											</div>
					  					</div>
									</div>
				  				</div>";
				  
		
				  
								echo "<div class='row'>
									<div class='col-lg-12 grid-margin'>
					  					<div class='card'>
											<div class='card-body'>
						  						<h4 class='card-title'>$month_name $year Monthly Fees Payment</h4>
						  						<div class='table-responsive'>
													<table id='datatable2' class='table dataTable no-footer' role='grid'>
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
							  							<tbody>";
															$sql = mysql_query("SELECT * FROM payment
																WHERE p_type_id = 2
																AND month = '$month'
																AND year = '$year'");
															
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
																															
							 							echo"</tbody>
													</table>
						  						</div>
											</div>
					  					</div>
									</div>
				  				</div>";
						}
		
		
						// dashboard teacher dan parent
						else	
						{		
							echo "
							<div class='row'>
								<div class='col-md-12 grid-margin stretch-card'>
									<div class='card'>
										<div id='myCarousel' class='carousel slide' data-ride='carousel'>
											<!-- Carousel indicators -->
											<ol class='carousel-indicators'>
												<li data-target='#myCarousel' data-slide-to='0' class='active'></li>
												<li data-target='#myCarousel' data-slide-to='1'></li>
												<li data-target='#myCarousel' data-slide-to='2'></li>
												<li data-target='#myCarousel' data-slide-to='3'></li>
											</ol>
											<!-- Wrapper for carousel items -->
											<div class='carousel-inner'>
												<div class='carousel-item active'>
													<img src='carousel/bg1001.jpg' alt='First Slide'>
												</div>
												<div class='carousel-item'>
													<img src='carousel/bg1002.jpg' alt='Second Slide'>
												</div>
												<div class='carousel-item'>
													<img src='carousel/bg1003.jpg' alt='Third Slide'>
												</div>
												<div class='carousel-item'>
													<img src='carousel/bg1004.jpg' alt='Forth Slide'>
												</div>
											</div>
											<!-- Carousel controls -->
											<a class='carousel-control-prev' href='#myCarousel' data-slide='prev'>
												<span class='carousel-control-prev-icon'></span>
											</a>
											<a class='carousel-control-next' href='#myCarousel' data-slide='next'>
												<span class='carousel-control-next-icon'></span>
											</a>
										</div>
									</div>
								</div>
							 </div>   					
							
							<div class='row'>";
								$counter = 0;
								$hideStyle = "";

								$sql = mysql_query("SELECT * FROM announcement ORDER BY announcement_id ASC");
								while($row = mysql_fetch_array($sql))
								{
									$desc = mb_substr($row[description], 0, 150);

									$dateString = str_replace('-', '/', $row[announcement_date]);
									$dateStringFormat = date('d/m/Y', strtotime($dateString));

									echo "<div class='col-md-3 grid-margin stretch-card blogBox moreBox' $hideStyle>
												<div class='card'>
													<img class='card-img-top' src='announcement/$row[image]' alt='card images'>
													<div class='card-body'>
														<h4 class='card-title'>$row[title]</h4>
														<p class='card-text'>$desc</p>
														<div class='d-flex align-items-center justify-content-between text-muted border-top py-3 mt-3'>
															<div class='wrapper d-flex align-items-center'>
																<i class='mdi mdi-calendar-check'></i> 
																<small class='ml-1'>
																	$dateStringFormat
																</small>
															</div>
															<p class='mb-0'>
																<a href='#' data-toggle='modal'
																	data-target='#details$row[announcement_id]'
																	class='btn btn-primary btn-md'>
																	More
																</a>
															</p>
														</div>
													</div>
												</div>
											</div>";

									$counter++;
									include "modal_announcement.php";

									if($counter > 2)
									$hideStyle = "style='display: none;'";
								}

								echo "<div id='loadMore' style=''>
										<a href='#' class='btn mb-1 btn-outline-primary btn-lg'><i class='mdi mdi-arrow-down'></i> Load Announcement</a>
										</div>";
										
							echo"</div>";
						}
					?>
        		</div>
        		<!-- content-wrapper ends -->
        		<!-- partial:partials/_footer.html -->
				<?php include "layout/footer.php";?>
        
        	<!-- partial -->
      		</div>
      	<!-- main-panel ends -->
    	</div>
    <!-- page-body-wrapper ends -->
  	</div>
  	<!-- container-scroller -->
  
   	<!-- SCRIPT -->
   	<?php include "layout/script.php";?>
    <script>
		$( document ).ready(function () {
	  		$(".moreBox").slice(0, 4).show();
			if ($(".blogBox:hidden").length != 0) {
		  		$("#loadMore").show();
			}   
			$("#loadMore").on('click', function (e) {
		  		e.preventDefault();
		  		$(".moreBox:hidden").slice(0, 4).slideDown();
		  	if ($(".moreBox:hidden").length == 0) {
				$("#loadMore").fadeOut('slow');
		  	}
			});
	  	});
	</script>
</body>
</html>
<?php } ?>