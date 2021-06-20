
					  <div class="modal fade" id="detailsPayment<?php echo $row[payment_id];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							  <div class="modal-dialog">
								<div class="modal-content">
								  <div class="modal-header">
									<h5 class="modal-title font-weight-bold text-primary"><i class="mdi mdi-google-wallet"></i> Payment Details</h5>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								  </div>
								  <form method="post" action="remarkRegPayment.php" enctype="multipart/form-data">
								  <input type="hidden" class="form-control" name="payment_id" value="<?php echo $row[payment_id]; ?>"  readonly />
								  <input type="hidden" name="amount" value="<?php echo $row[amount]; ?>">
								  <input type="hidden" name="existing_paid_amount" value="<?php echo $row[paid_amount]; ?>">
								  <input type="hidden" name="url" value="dashboard">
								  
									  <div class="modal-body">
								
												<div class="row">
												  <div class="col-md-6">
													<div class="form-group">
														<label class="font-weight-bold"><span class="mdi mdi-bookmark-check"></span> Payment ID</label>
														<p><?php echo $row[payment_id]; ?></p>
													</div>
												  </div>
												  <div class="col-md-6">
													<div class="form-group">
														<label class="font-weight-bold"><span class="mdi mdi-bookmark-check"></span> Payment Date</label>
														<p><?php echo $dateStringFormat; ?></p>
													</div>
												  </div>
												  
												</div>
												
												
												<div class="row">
												  <div class="col-md-6">
													<div class="form-group">
														<label class="font-weight-bold"><span class="mdi mdi-bookmark-check"></span> Student Name</label>
														<p><?php echo $rowStd[name]; ?></p>
													</div>
												  </div>
												  <div class="col-md-6">
													<div class="form-group">
														<label class="font-weight-bold"><span class="mdi mdi-bookmark-check"></span> Payment Option</label>
														<p><?php
														
																//payment option
																if($row[payment_option] == "Online Banking")
																{
																	echo "<a href='#modal' data-toggle='modal' data-target='#detailsProof$row[payment_id]' title='view payment proof'>
																							<span class='badge badge-primary'>$row[payment_option]</span>
																						</a>";
																
																}
																else
																{
																	echo "<span class='badge badge-success'>$row[payment_option]</span>";
																}
															?>
														</p>
													</div>
												  </div>
												</div>
												
												
												<div class="row">
												  <div class="col-md-3">
													<div class="form-group">
														<label class="font-weight-bold"><span class="mdi mdi-bookmark-check"></span> Amount</label>
														<p>RM<?php echo $row[amount]; ?></p>
													</div>
												  </div>
												  <div class="col-md-3">
													<div class="form-group">
														<label class="font-weight-bold"><span class="mdi mdi-bookmark-check"></span> Paid</label>
														<p>RM<?php echo $row[paid_amount]; ?></p>
													</div>
												  </div>
												  <div class="col-md-3">
													<div class="form-group">
														<label class="font-weight-bold"><span class="mdi mdi-bookmark-check"></span> Balance</label>
														<p>RM<?php echo $row[balance]; ?></p>
													</div>
												  </div>
												  
												</div>
												
												<?php
													if($_SESSION[UserLvl] == 1)
													{
														if($row[payment_status] == "Pending")
														{
															$payment_status = "
																					<select name='payment_status' class='form-control' required>
																						<option value='' selected>Pending</option>
																						<option value='Declined'>Declined</option>
																						<option value='Partial Paid'>Partial Paid</option>
																						<option value='Paid'>Paid</option>
																					</select>";
														}
														else if($row[payment_status] == "Declined")
														{
															$payment_status = "<span class='badge badge-danger'>$row[payment_status]</span>";
														}
														else if($row[payment_status] == "Partial Paid")
														{
															$payment_status = "
																					<select name='payment_status' class='form-control' required>
																						<option value='' selected>Partial Paid</option>
																						<option value='Paid'>Paid</option>
																					</select>";
														}
														else if($row[payment_status] == "Paid")
														{
															$payment_status = "<span class='badge badge-success'>$row[payment_status]</span>";
														}
													}
													else
													{
														if($row[payment_status] == "Pending")
														{
															$payment_status = "<span class='badge badge-warning'>$row[payment_status]</span>";
														}
														else if($row[payment_status] == "Declined")
														{
															$payment_status = "<span class='badge badge-danger'>$row[payment_status]</span>";
														}
														else if($row[payment_status] == "Partial Paid")
														{
															$payment_status = "<span class='badge badge-primary'>$row[payment_status]</span>";
														}
														else if($row[payment_status] == "Paid")
														{
															$payment_status = "<span class='badge badge-success'>$row[payment_status]</span>";
														}
													}
													
												  ?>
												
												<div class="row">
												  <div class="col-md-6">
													<div class="form-group">
														<label class="font-weight-bold"><span class="mdi mdi-bookmark-check"></span> Amount to be paid <span class="text-warning">(if any)</span></label>
														<?php
														if(($row[payment_status] == "Declined") || ($row[payment_status] == "Paid"))
														{
															echo "<br />- - - ";
														}
														else
														{
															echo "<input type='number' step='0.01' name='paid_amount' class='form-control' placeholder='Amount want to be paid...' />";
														}
														?>
														
													</div>
												  </div>
												  <div class="col-md-6">
													<div class="form-group">
														<label class="font-weight-bold"><span class="mdi mdi-bookmark-check"></span> Status</label>
														<p><?php echo $payment_status; ?></p>
													</div>
												  </div>
												  
												</div>
												
											  
									  </div>
									  <?php
										//display function for admin
										if($_SESSION[UserLvl] == 1)
										{
											//for payment that still pending and partial paid. display button.
											if(($row[payment_status] == "Pending") || ($row[payment_status] == "Partial Paid"))
											{
												echo "<div class='modal-footer'>
														<button data-dismiss='modal' type='button' class='btn btn-outline-dark'><span class='mdi mdi-close'></span> Close</button>
														<button type='submit' name='submit' class='btn btn-primary mr-2'><span class='mdi mdi-check'></span> Submit</button>
													</div>";
											}
											
										}
									  ?>
								  </form>
								</div>
							  </div>
					  </div>
					  
					  
					  
					  
					  <div class="modal fade" id="detailsProof<?php echo $row['payment_id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							  <div class="modal-dialog">
								<div class="modal-content">
								  <div class="modal-header">
									<h5 class="modal-title text-success"><i class="mdi mdi-google-wallet" style="font-size: 14px;"></i> Payment Proof for ID <?php echo $row[payment_id]; ?></h5>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								  </div>
								  <form method="post" enctype="multipart/form-data">
									  <div class="modal-body">
												
												<div class="row">
												  <div class="col-md-12">
													<div class="form-group">
														<?php echo "<embed src='proof/$row[proof]' class='img-fluid' />"; ?>
													</div>
												  </div>
												</div>
												
											
											
									  </div>
								  </form>
								</div>
							  </div>
					  </div>
					  
					  
					  
					  
					  