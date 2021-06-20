<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
		<?php
			// menu admin
		  	if($_SESSION[UserLvl] == 1)
		  	{
			  	$sql = mysql_query("SELECT * FROM admin WHERE username = '$_SESSION[UserID]'");
			  	$row = mysql_fetch_array($sql);
			  
			  	echo "<li class='nav-item nav-profile'>
						<div class='nav-link'>
					  		<div class='user-wrapper'>
								<div class='profile-image'>
						  			<img src='photo/$row[photo]' alt='profile image'>
								</div>
								<div class='text-wrapper'>
						  			<p class='profile-name'>$row[name]</p>
						  			<div>
										<small class='designation text-muted'>Admin</small>
										<span class='status-indicator online'></span>
						  			</div>
								</div>
					  		</div>
						</div>
				  </li>";
				  
			  	echo "<li class='nav-item'>
						<a class='nav-link' href='dashboard.php'>
					  	<i class='menu-icon mdi mdi-heart'></i>
					  	<span class='menu-title'>Dashboard</span>
						</a>
				  	</li>
				  
				<li class='nav-item'>
					<a class='nav-link' data-toggle='collapse' href='#ui-teacher' aria-expanded='false' aria-controls='ui-basic'>
					  	<i class='menu-icon mdi mdi-account-box'></i>
					  	<span class='menu-title'>Teacher</span>
					  	<i class='menu-arrow'></i>
					</a>
					<div class='collapse' id='ui-teacher'>
					  	<ul class='nav flex-column sub-menu'>
							<li class='nav-item'>
						 		<a class='nav-link' href='register_teacher.php'>Register Teacher</a>
							</li>
							<li class='nav-item'>
						  		<a class='nav-link' href='manage_teacher.php'>Manage Teacher</a>
							</li>
					  	</ul>
					</div>
				</li>
				  
				<li class='nav-item'>
					<a class='nav-link' data-toggle='collapse' href='#ui-parent' aria-expanded='false' aria-controls='ui-basic'>
						<i class='menu-icon mdi mdi-account-multiple'></i>
					  	<span class='menu-title'>Parent</span>
					  	<i class='menu-arrow'></i>
					</a>
					<div class='collapse' id='ui-parent'>
					  	<ul class='nav flex-column sub-menu'>
							<li class='nav-item'>
						  		<a class='nav-link' href='register_parent.php'>Register Parent</a>
							</li>
							<li class='nav-item'>
						  		<a class='nav-link' href='manage_parent.php'>Manage Parent</a>
							</li>
					  	</ul>
					</div>
				</li>
				    
				<li class='nav-item'>
					<a class='nav-link' data-toggle='collapse' href='#ui-enrollment' aria-expanded='false' aria-controls='ui-basic'>
						<i class='menu-icon mdi mdi-kodi'></i>
					  	<span class='menu-title'>Student</span>
					  	<i class='menu-arrow'></i>
					</a>
					<div class='collapse' id='ui-enrollment'>
					  	<ul class='nav flex-column sub-menu'>
							<li class='nav-item'>
						  		<a class='nav-link' href='student_enrollment_form.php'>Register Student</a>
							</li>
							<li class='nav-item'>
						  		<a class='nav-link' href='enrollment_list.php'>Manage Student</a>
							</li>
							<li class='nav-item'>
								<a class='nav-link' href='view_student_performance.php'>Performance Student</a>						
							</li>
					  	</ul>
					</div>
				</li>

				<li class='nav-item'>
					<a class='nav-link' data-toggle='collapse' href='#ui-announcement' aria-expanded='false' aria-controls='ui-basic'>
						<i class='menu-icon mdi mdi-cookie'></i>
						<span class='menu-title'>Announcement</span>
						<i class='menu-arrow'></i>
					</a>
					<div class='collapse' id='ui-announcement'>
						<ul class='nav flex-column sub-menu'>
							<li class='nav-item'>
							  <a class='nav-link' href='add_announcement.php'>Add Announcement</a>
							</li>
							<li class='nav-item'>
							  <a class='nav-link' href='manage_announcement.php'>Manage Announcement</a>
							</li>
						</ul>
					</div>
				</li>
				
				<li class='nav-item'>
					<a class='nav-link' data-toggle='collapse' href='#ui-fees' aria-expanded='false' aria-controls='ui-basic'>
					  	<i class='menu-icon mdi mdi-clipboard-check'></i>
					  	<span class='menu-title'>Fee</span>
					  	<i class='menu-arrow'></i>
					</a>
					<div class='collapse' id='ui-fees'>
					  	<ul class='nav flex-column sub-menu'>
							<li class='nav-item'>
						  		<a class='nav-link' href='record_registration_fee.php'>Add Registration Fee</a>
							</li>
							<li class='nav-item'>
						  		<a class='nav-link' href='record_monthly_fee.php'>Add Monthly Fee</a>
							</li>
							<li class='nav-item'>
						  		<a class='nav-link' href='manage_reg_fee.php'>Manage Registration Fee</a>
							</li>							
							<li class='nav-item'>
						  		<a class='nav-link' href='manage_monthly_fee.php'>Manage Monthly Fee</a>
							</li>
					  	</ul>
					</div>
				</li>
				  
				<li class='nav-item'>
					<a class='nav-link' data-toggle='collapse' href='#ui-payment' aria-expanded='false' aria-controls='ui-basic'>
					  	<i class='menu-icon mdi mdi-google-wallet'></i>
					  	<span class='menu-title'>Payment</span>
					  	<i class='menu-arrow'></i>
					</a>
					<div class='collapse' id='ui-payment'>
					  	<ul class='nav flex-column sub-menu'>
							<li class='nav-item'>
								<a class='nav-link' href='pay_student_registration_fees.php'>Pay Registration Fee</a>
							</li>
							<li class='nav-item'>
								<a class='nav-link' href='pay_student_monthly_fees.php'>Pay Monthly Fee</a>
							</li>
							<li class='nav-item'>
						  		<a class='nav-link' href='registration_payment.php'>Update Registration Status</a>
							</li>
							<li class='nav-item'>
						  		<a class='nav-link' href='monthly_payment.php'>Update Monthly Status</a>
							</li>
					  	</ul>
					</div>
				</li>
				  

				  
				<li class='nav-item'>
					<a class='nav-link' data-toggle='collapse' href='#ui-report' aria-expanded='false' aria-controls='ui-basic'>
						<i class='menu-icon mdi mdi-chart-bar'></i>
					 	<span class='menu-title'>Report</span>
					  	<i class='menu-arrow'></i>
					</a>
					<div class='collapse' id='ui-report'>
					  	<ul class='nav flex-column sub-menu'>
							<li class='nav-item'>
						  		<a class='nav-link' href='monthly_report.php'>Monthly Report</a>
							</li>
							<li class='nav-item'>
						  		<a class='nav-link' href='annual_report.php'>Annual Report</a>
							</li>
					  	</ul>
					</div>
				</li>"
				;
		  	}
		  
		  	// menu teacher
		 	else if($_SESSION[UserLvl] == 2)
		  	{
			   	$sql = mysql_query("SELECT * FROM teacher WHERE username = '$_SESSION[UserID]'");
			   	$row = mysql_fetch_array($sql);
				
				//cek teacher type
				if($row[type] == "Tahfiz")
				{
					//display link add hafazan performance
					$link_add_performance = "add_hafazan_performance.php";
					$link_manage_performance = "manage_hafazan_performance.php";
					$link_view_performance = "view_hafazan_performance.php";
					
				}
				else if($row[type] == "Academic")
				{
					//display link add Academic performance
					$link_add_performance = "add_academic_performance.php";
					$link_manage_performance = "manage_academic_performance.php";
					$link_view_performance = "view_academic_performance.php";
					
				}
			  
			   	echo "<li class='nav-item nav-profile'>
						<div class='nav-link'>
					  		<div class='user-wrapper'>
								<div class='profile-image'>
						  			<img src='photo/$row[photo]' alt='profile image'>
								</div>
								<div class='text-wrapper'>
						  			<p class='profile-name'>$row[name]</p>
						  			<div>
										<small class='designation text-muted'>Teacher</small>
										<span class='status-indicator online'></span>
						  			</div>
								</div>
					  		</div>
						</div>
				  	</li>";
				  
			  	echo "<li class='nav-item'>
						<a class='nav-link' href='dashboard.php'>
						  <i class='menu-icon mdi mdi-heart'></i>
						  <span class='menu-title'>Dashboard</span>
						</a>
					</li>
					  
				   	<li class='nav-item'>
						<a class='nav-link' data-toggle='collapse' href='#ui-performance' aria-expanded='false' aria-controls='ui-basic'>
					  		<i class='menu-icon mdi mdi-book-open-page-variant'></i>
					  		<span class='menu-title'>Performance</span>
					  		<i class='menu-arrow'></i>
						</a>

						<div class='collapse' id='ui-performance'>
						  	<ul class='nav flex-column sub-menu'>
								<li class='nav-item'>
								  <a class='nav-link' href='$link_add_performance'>Add Performance</a>
								</li>
								<li class='nav-item'>
								  <a class='nav-link' href='$link_manage_performance'>Manage Performance</a>
								</li>
								<li class='nav-item'>
								  <a class='nav-link' href='$link_view_performance'>View Performance</a>
								</li>
						  	</ul>
						</div>
				  	</li>
				";
		  	}
		
		  	// menu parent
		  	else if($_SESSION[UserLvl] == 4)
		  	{
			  	$sql = mysql_query("SELECT * FROM parent WHERE username = '$_SESSION[UserID]'");
			  	$row = mysql_fetch_array($sql);
			   
			  	echo "<li class='nav-item nav-profile'>
						<div class='nav-link'>
					  		<div class='user-wrapper'>
								<div class='profile-image'>
						  			<img src='photo/$row[photo]' alt='profile image'>
								</div>
								<div class='text-wrapper'>
						  			<p class='profile-name'>$row[name]</p>
						  			<div>
										<small class='designation text-muted'>Parent</small>
										<span class='status-indicator online'></span>
									</div>
								</div>
					  		</div>
						</div>
				  	</li>";
				  
			  	echo "<li class='nav-item'>
						<a class='nav-link' href='dashboard.php'>
					  		<i class='menu-icon mdi mdi-heart'></i>
					  		<span class='menu-title'>Dashboard</span>
						</a>
				  	</li>
				  
				  	<li class='nav-item'>
						<a class='nav-link' data-toggle='collapse' href='#ui-enrollment' aria-expanded='false' aria-controls='ui-basic'>
					  		<i class='menu-icon mdi mdi-kodi'></i>
					  		<span class='menu-title'>Enrollment</span>
					  		<i class='menu-arrow'></i>
						</a>
						<div class='collapse' id='ui-enrollment'>
					  		<ul class='nav flex-column sub-menu'>
								<li class='nav-item'>
						  			<a class='nav-link' href='child_enrollment_form.php'>Enrollment Form</a>
								</li>
								<li class='nav-item'>
						  			<a class='nav-link' href='enrollment_status.php'>Enrollment Status</a>
								</li>
					  		</ul>
						</div>
				  	</li>
				  
				  	<li class='nav-item'>
						<a class='nav-link' data-toggle='collapse' href='#ui-fees' aria-expanded='false' aria-controls='ui-basic'>
					  		<i class='menu-icon mdi mdi-google-wallet'></i>
					  		<span class='menu-title'>Payment</span>
					  		<i class='menu-arrow'></i>
						</a>
						<div class='collapse' id='ui-fees'>
						  	<ul class='nav flex-column sub-menu'>
								<li class='nav-item'>
							  		<a class='nav-link' href='pay_registration_fees.php'>Registration Fees</a>
								</li>
								<li class='nav-item'>
							 		<a class='nav-link' href='pay_monthly_fees.php'>Monthly Fees</a>
								</li>
								<li class='nav-item'>
							  		<a class='nav-link' href='payment_history.php'>Payment History</a>
								</li>
						  	</ul>
						</div>
				  	</li>
				 
				  	<li class='nav-item'>
						<a class='nav-link' href='view_performance.php'>
					  		<i class='menu-icon mdi mdi-book-open-page-variant'></i>
					  		<span class='menu-title'>Performance</span>
						</a>
				  	</li>
				";
		  	}
		?>
 
    </ul>
</nav>