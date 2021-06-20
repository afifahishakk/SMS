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
										<h4 class="card-title text-left">Hello dear visitor...</h4>
										<img class="card-img img-fluid" src="images/welcome_bg.jpg" alt="images" />
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
							<h4 class="card-title">Here are long short story of us...</h4>
							<ul class="bullet-line-list">
							  <li>
								<h6 class="text-dark">Introduction</h6>
								<p>
									Pusat Tahfiz Sains Darul Ilmi (PTSDI) merupakan sebuah intitusi pendidikan tahfiz di bawah
									kelolaan Yayasan Takmir Pendidikan Negeri Johor. Lokasi PTSDI terletak di Lot 1665, Jalan Gelang
									Chinchin, Mukim Jabi, Segamat dan jaraknya dari bandar Segamat sekitar 15 kilometer. PTSDI
									mula beroperasi sepenuhnya bermula 17 Januari 2014.
								</p>
								<p>
									Melalui permuafakatan antara Pewakaf Tuan Haji Harris bin Mat Jadi dan Pemegang
									Amanah Darul Ilmi serta Yayasan Takmir Pendidikan Negeri Johor, maka tertubuhlah Pusat Tahfiz
									Sains Darul Ilmi yang menyediakan pengajian tahfiz dan akademik bagi persediaan SPM. Pusat
									Tahfiz ini bakal melahirkan huffaz yang profesional serta mempunyai kefahaman dan
									penghayatan agama yang berteraskan Al-Quran dan As-Sunnah seterusnya disepadukan
									dengan ilmu-ilmu kehidupan semasa.
								</p>
							  </li>
							  <li>
								<h6 class="text-dark">Vision</h6>
								<p>
									“ Huffaz Profesional Yang Berhikmah Menuju Keradhaan Allah”
								</p>
							  </li>
							  <li>
								<h6 class="text-dark">Mission</h6>
								<p>
									<i class="mdi mdi-check"></i> Mendidik huffaz untuk menjiwai iman yang mantap dan berakhlak mulia<br />
									<i class="mdi mdi-check"></i> Mendidik huffaz yang membudayakan amal jama`ie<br />
									<i class="mdi mdi-check"></i> Mendidik huffaz faqih Ulum Islamiyyah<br />
									<i class="mdi mdi-check"></i> Mendidik pelajar berfungsi sebagau du’at dalam menegak daulah islamiyyah
								</p>
							  </li>
							  <li>
								<h6 class="text-dark">Objectives</h6>
								<p>
									<i class="mdi mdi-check"></i> Melahirkan pelajar qulbun salim dan berakhlak mulia yang qurratu a’yun dengan menjadikan Al-Quran sebagai penawar dan rahmat.<br />
									<i class="mdi mdi-check"></i> Melahirkan pelajar istiqamah menghidupkan ‘amal jama’ie dalam diri, keluarga, masyarakat dan Negara<br />
									<i class="mdi mdi-check"></i>  Melahirkan huffaz memahami ilmu qiraat iaitu berkaitan kelimah-kalimah Al-Quran<br />
									<i class="mdi mdi-check"></i>  Melahirkan pelajar yang faqih Ulum Islamiyyah termasuk kitab turath dan Sains<br />
									<i class="mdi mdi-check"></i>  Melahirkan pelajar yang mampu menjadi du’at qudwah hasanah yang serba boleh dan profesional gerak kerjanya.
								</p>
							  </li>
							</ul>
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