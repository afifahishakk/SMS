<?php
include "conn/conn.php";
error_reporting(0);
session_start();
if (!empty($_SESSION[UserID]) AND !empty($_SESSION[Password]))
{
  header('location:dashboard.php');
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
      <!-- partial:partials/_navbar.html -->
      <?php include "layout/top_public.php";?>
	  
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->

        <!-- partial -->
        <div class="main-panel" style="width:100%;">
          <div class="content-wrapper">
           
            <div class="row">
              <div class="col-md-12">
                
                <div class="tab-content tab-transparent-content">
                  <div class="tab-pane fade show active" id="business-1" role="tabpanel" aria-labelledby="business-tab">
                    
                    
                    <div class="row">
					  
                      <div class="col-sm-4 grid-margin stretch-card">
                        <div class="card">
                          
                          <div class="card-body bg-white pt-4">
                            <div class="row pt-4">
                              <div class="col-sm-12">
                                <div class="text-center">
									<div class="text-center">
										<h4 class="card-title text-left">We love to hear you...</h4>
										<img class="card-img img-fluid" src="images/location.jpg" alt="location" />
										<h4><i class="la la-map-marker font-medium-4"></i> We are located at<br />1665, Jalan Gelang Chinchin,<br />Kampung Sepinang,<br />85000 Segamat, Johor<br /></h4>
										<p class="timeline-date">
										
											<span class="text-success"><i class="la la-whatsapp font-medium-4"></i> 6018888888</span><br />
											<span class="text-danger"><i class="la la-envelope font-medium-4"></i> admin@ptsdi.my</span><br />
											<span class="text-info"><i class="la la-calendar-check-o font-medium-4"></i> Sunday - Thursday</span><br />
											<span class="text-warning"><i class="la la-clock-o font-medium-4"></i> 10AM - 6PM</span>
											
										</p>
									</div>
                                </div>
								
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

					  
                      <div class="col-sm-8  grid-margin stretch-card">
                        <div class="card">
                          <div class="card-body">
                            <div class="d-xl-flex justify-content-between mb-2">
                              <h4 class="card-title">Using maps is the easy way to reach us...</h4>
                            </div>
                            <iframe class="card-img-top" src="https://maps.google.com/maps?q=PUSAT+TAHFIZ+SAINS+DARUL+ILMI&t=&z=13&ie=UTF8&iwloc=&output=embed" width="1300" height="480" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                          </div>
                        </div>
                      </div>
					  
					  
					  
                    </div>
                  </div>
                </div>
              </div>
            </div>
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
	<?php include "layout/script.php";?>
    <!-- plugins:js -->
    
  </body>
</html>
<?php
}
?>