
					  <div class="modal fade" id="details<?php echo $row['announcement_id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
							  <div class="modal-dialog">
								<div class="modal-content">
								  <div class="modal-header">
									<h5 class="modal-title text-primary"><i class="mdi mdi-cookie"></i> Announcement Details</h5>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								  </div>
								  <form method="post" enctype="multipart/form-data">
									  <div class="modal-body">
												<div class="row">
												  <div class="col-md-6">
													<div class="form-group">
														<label><i class="mdi mdi-bookmark-check"></i> Title</label><br />
														<?php echo $row[title]; ?>
													</div>
												  </div>
												  <div class="col-md-6">
													<div class="form-group">
														<label><i class="mdi mdi-calendar-text"></i> Date</label><br />
														<?php echo $dateStringFormat; ?>
													</div>
												  </div>
												</div>
												
												<div class="row">
												  <div class="col-md-12">
													<div class="form-group">
														<label><i class="mdi mdi-information"></i> Description</label><br />
														<?php echo $row[description]; ?>
													</div>
												  </div>
												</div>
												
											
									  </div>
								  </form>
								</div>
							  </div>
					  </div>