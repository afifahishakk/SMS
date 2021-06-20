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
			<?php
					
					if (isset($_POST['submit']))
					{
							// function utk	generate unique id
							$queryx_ = "SELECT * FROM announcement ORDER BY announcement_id DESC LIMIT 1";
							$queryx  = mysql_query($queryx_)or die(mysql_error());
							$fetchx  = mysql_fetch_array($queryx);

							if($fetchx[0]==NULL)
								$announcement_id = "ANCMT00001";
							else
							{
								$patterns 	  = array("/[123456789].*/",);
								$replacements = '';
								$x= preg_replace($patterns, $replacements, $fetchx[0]);
								$x_= explode($x, $fetchx[0]);
								$nolast		= implode("",$x_);

								$newlast	= $nolast + 1;
								$length		= strlen($x);
								$initlength = strlen($nolast);
								$newlength  = strlen($newlast);
								$last		= substr($fetchx[0], -1);
								$zero		= substr($fetchx[0], 0, $length);
								
								if($newlength > $initlength)
									$zero = substr($zero, 0, -1);

								$announcement_id  = $zero.$newlast;
							}
							
						
						$title = $_POST['title'];
						$description = $_POST['description'];
						$announcement_date = $_POST['announcement_date'];
						
						
						$file_location 	= $_FILES['image']['tmp_name'];
						$file_type		= $_FILES['image']['type'];
						$file_name		= $_FILES['image']['name'];
						
						move_uploaded_file($file_location,"announcement/$file_name");
						
						$sql = mysql_query("INSERT INTO announcement (announcement_id, title, description, announcement_date, image)
																VALUES ('$announcement_id', '$title', '$description', '$announcement_date', '$file_name')");
															
						
														
						if($sql == true)
						{
							$title = "";
							$description = "";
							$announcement_date = "";
						
							echo "<div class='alert alert-success alert-dismissible'>
														<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
														<strong>Thank you!</strong> New announcement successfully added.
									</div>";
						}
						else
							echo "<div class='alert alert-danger alert-dismissible'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>Sorry!</strong> error.
								</div>";
					}

			?>
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Add New Announcement</h4>

                  <form method="post" enctype="multipart/form-data">
                    <p class="card-description text-primary">
                      <i class="mdi mdi-cookie"></i> Add Announcement Details
                    </p>
					
					<hr />
					
					<div class="row">
					
                      <div class="col-md-4">
						<div class="form-group">
							<label>Title</label>
							<input type="text" class="form-control" name="title" value="<?php echo $title; ?>" placeholder="Announcement Title" required />
						</div>
                      </div>
					  
                      <div class="col-md-4">
						<div class="form-group">
							<label>Date</label>
							<input type="date" class="form-control" name="announcement_date" placeholder="Announcement Date" required />
						</div>
                      </div>
					  
					  <div class="col-md-4">
						<div class="form-group">
							<label>Photo</label>
							<input type="file" class="form-control" name="image" placeholder="Photo" required />
						</div>
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="col-md-12">
						<div class="form-group">
							<label>Description</label>
							<textarea class="form-control" name="description" rows="7" placeholder="Write some announcement description here..." required><?php echo $description; ?></textarea>
						</div>
                      </div>
                    </div>
                   
                    
                    
                    <br />
                    <button type="reset" class="btn btn-outline-dark"><i class="mdi mdi-refresh"></i> Reset</button>
					<button type="submit" name="submit" class="btn btn-primary mr-2"><i class="mdi mdi-check"></i> Submit</button>
                  </form>
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
</body>

</html>
<?php
}
?>