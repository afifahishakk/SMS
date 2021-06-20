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
							
						$announcement_id  = $_POST['announcement_id'];
						$title = $_POST['title'];
						$description = $_POST['description'];
						$announcement_date = $_POST['announcement_date'];
						
						
						$file_location 	= $_FILES['image']['tmp_name'];
						$file_type		= $_FILES['image']['type'];
						$file_name		= $_FILES['image']['name'];
						
						if (empty($file_location))
						{
							$sql = mysql_query("UPDATE announcement SET title = '$title',
																			description = '$description',
																			announcement_date = '$announcement_date'
																			WHERE announcement_id = '$announcement_id'");
						}
						else
						{
							move_uploaded_file($file_location,"announcement/$file_name");
							
							$sql = mysql_query("UPDATE announcement SET title = '$title',
																			description = '$description',
																			announcement_date = '$announcement_date',
																			image = '$file_name'
																			WHERE announcement_id = '$announcement_id'");
						}
						
						
						
						if($sql == true)
						{
							echo "<div class='alert alert-success alert-dismissible'>
														<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
														<strong>Thank you!</strong> Announcement details successfully updated.
									</div>";
						}
						else
							echo "<div class='alert alert-danger alert-dismissible'>
									<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
									<strong>Sorry!</strong> error.
								</div>";
					}
					
					$announcement_id = $_GET['announcement_id'];
					$sql = mysql_query("SELECT * FROM announcement WHERE announcement_id = '$announcement_id'");
					$row = mysql_fetch_array($sql);

			?>
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Update Announcement</h4>

                  <form method="post" enctype="multipart/form-data">
				  <input type="hidden" name="announcement_id" value="<?php echo $row[announcement_id]; ?>">
                    <p class="card-description text-primary">
                      <i class="mdi mdi-cookie"></i> Update Announcement Details
                    </p>
					
					<hr />
					
					<div class="row">
					
                      <div class="col-md-4">
						<div class="form-group">
							<label>Title</label>
							<input type="text" class="form-control" name="title" value="<?php echo $row[title]; ?>" placeholder="Announcement Title" required />
						</div>
                      </div>
                      <div class="col-md-4">
						<div class="form-group">
							<label> Date</label>
							<input type="date" class="form-control" name="announcement_date" value="<?php echo $row[announcement_date]; ?>" placeholder="Announcement Date" required />
						</div>
                      </div>
					  
					  <div class="col-md-4">
						<div class="form-group">
							<label>Other Photo <span class="badge badge-warning">(if any)</span></label>
							<input type="file" class="form-control" name="image" placeholder="Photo" />
						</div>
                      </div>
                    </div>
					
                    <div class="row">
                      
					 
                    </div>
                    
                    <div class="row">
                      <div class="col-md-12">
						<div class="form-group">
							<label>Description</label>
							<textarea class="form-control" name="description" rows="7" placeholder="Write some announcement description here..." required><?php echo $row[description]; ?></textarea>
						</div>
                      </div>
                    </div>
                   
                    
                    
                    <br />
                    <a href="manage_announcement.php" class="btn btn-outline-dark">
						<i class="mdi mdi-keyboard-backspace"></i> Back
					</a>
					<button type="submit" name="submit" class="btn btn-primary mr-2"><i class="mdi mdi-check"></i> Update</button>
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