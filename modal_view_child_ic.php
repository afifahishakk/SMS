
					  <div class="modal fade" id="details<?php echo $row['ic'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							  <div class="modal-dialog">
								<div class="modal-content">
								  <div class="modal-header">
									<h5 class="modal-title text-success"><i class="mdi mdi-account-card-details" style="font-size: 14px;"></i> IC Copy <?php echo $row[name]; ?></h5>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								  </div>
								  <form method="post" enctype="multipart/form-data">
									  <div class="modal-body">
												
												<div class="row">
												  <div class="col-md-12">
													<div class="form-group">
														<?php echo "<img src='ic/$row[ic_copy]' class='img-fluid'>"; ?>
													</div>
												  </div>
												</div>
												
											
											
									  </div>
								  </form>
								</div>
							  </div>
					  </div>