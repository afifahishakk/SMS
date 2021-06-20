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
	    <?php include "layout/top_public.php";?>
      <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
        <!-- partial:partials/_navbar.html -->
        <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
          <div class="row w-100">
            <div class="col-lg-4 mx-auto">
              <div class="auto-form-wrapper">
		            <h1 class="display-1 text-bold-200 text-center">S M S</h1>
		            <p class="text-muted text-center">Student Management System<br />Pusat Tahfiz Sains Darul Ilmi</p>
		            <hr />
		            <?php
		              if (isset($_POST['login']))
		              {
  		  		        $UserID = $_POST['UserID'];
  		  		        $password = $_POST['password'];
                
  		  		        $login = mysql_query("SELECT * FROM login WHERE UserID = '$UserID' AND Password = '$password' AND Status = 'Active'");
  		  		        $success = mysql_num_rows($login);
  		  		        $row = mysql_fetch_array($login);
                
  		  		        if ($success > 0){
  		  			        session_start();		
                    
  		  			        $_SESSION[UserID] = $row[UserID];
  		  			        $_SESSION[Password] = $row[Password];				
  		  			        $_SESSION[UserLvl] = $row[UserLvl];	
                    
  		  			        echo "<script>window.location = 'dashboard.php';</script>";
  		  		        }
  		  		        else
  		  			        echo "<div class='alert alert-danger alert-dismissible'>
  		  				    	        <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
  		  				    		      <strong>Sorry!</strong> Authentication failed.
  		  				    	      </div>";
  		  	        }
  		          ?>

                <form method="post">
                  <div class="form-group">
                    <label class="label">Username</label>
                    <div class="input-group">
                      <input type="text" class="form-control" name="UserID" placeholder="Username" required />
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-account-outline"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="label">Password</label>
                    <div class="input-group">
                      <input type="password" id="password" class="form-control" name="password" placeholder="*********" required />
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <a onclick="showHidePass()" data-toggle="tooltip" data-placement="left" title="Show/Hide"><i class="mdi mdi-textbox-password text-primary"></i></a>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <button type="submit" name="login" class="btn btn-primary submit-btn btn-block">Login</button>
                  </div>
                </form>
              </div>
              <br />
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->

	    <!-- partial:partials/_footer.html -->
		  <?php include "layout/footer.php";?>

    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <!-- SCRIPT -->
    <?php include "layout/script.php";?>
    <script>
      function showHidePass() {
	      var x = document.getElementById("password");
	      if (x.type === "password") {
	    	  x.type = "text";
	      } 
        else {
	    	  x.type = "password";
	      }
	    }
	  </script>
  </body>
</html>
<?php } ?>