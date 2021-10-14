<?php
    include("layout/header.php");

    if(isset($_POST['submit']))
   	{ 
		  $cat = $_POST['cat'];
      $subcat = $_POST['subcat'];
      $name = $_POST['name'];
      $sele = $_POST['sele'];
      $image = explode('.', $_FILES['image']['name']);
      $img = time().'.'.end($image);
      $tempimage = $_FILES['image']['tmp_name'];
      
      move_uploaded_file($tempimage, "image/category/$img");
      $seo_title = $_POST['seo_title'];
      $seo_description = $_POST['seo_description'];
      $seo_keywords = $_POST['seo_keywords'];
      $qry = "INSERT INTO `innercategory`(`i_cat_id`, `i_sub_id`, `i_name`, `i_image`, `i_show`, `seo_title`, `seo_description`, `seo_keywords`) VALUES ('$cat','$subcat','$name','$img','$sele', '$seo_title', '$seo_description', '$seo_keywords')";
    	$run = $connect->query($qry);
      
		if($run == true) { ?>
       		<script>
       			alert('data inserted successfully');
       			window.open('add_innercategory.php','_self');
      		</script>
<?php
     	}else{ ?>
          <script>
            alert('not insert Data');
            window.open('add_innercategory.php','_self');
          </script>
<?php  } } ?>
<div class="main-panel">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
    <div class="container-fluid">
      <div class="navbar-wrapper">
        <div class="navbar-minimize">
          <button id="minimizeSidebar" class="btn btn-icon btn-round">
            <i class="nc-icon nc-minimal-right text-center visible-on-sidebar-mini"></i>
            <i class="nc-icon nc-minimal-left text-center visible-on-sidebar-regular"></i>
          </button>
        </div>
        <div class="navbar-toggle">
          <button type="button" class="navbar-toggler">
            <span class="navbar-toggler-bar bar1"></span>
            <span class="navbar-toggler-bar bar2"></span>
            <span class="navbar-toggler-bar bar3"></span>
          </button>
        </div>
        <a class="navbar-brand" href="javascript:;">Sub Category Form</a>
      </div>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-bar navbar-kebab"></span>
        <span class="navbar-toggler-bar navbar-kebab"></span>
        <span class="navbar-toggler-bar navbar-kebab"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navigation">
      <ul class="navbar-nav">
        <li class="nav-item btn-rotate dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="nc-icon nc-bell-55"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="profile.php">Profile</a>
            <a class="dropdown-item" href="logout.php">Logout</a>
          </div>
        </li>
      </ul>
    </div>
    </div>
  </nav>
  <!-- End Navbar -->
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <form method="POST" enctype="multipart/form-data">
          <div class="card ">
            <div class="card-header ">
              <h4 class="card-title">Add Sub Category</h4>
            </div>
            <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <label>Category</label>
                <select class="form-control" name="cat" id="cat" data-style="btn btn-primary btn-round" title="Select Category" required>
                  <option>Select Category</option>
                  <?php 
                    $sql = "SELECT * FROM category";
                    $run1 = $connect->query($sql);
                    while ($data = $run1->fetch_assoc()) 
                    {  
                  ?>
                    <option value="<?php echo $data['c_id']; ?>"><?php echo 
                    $data['c_name']; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="col-md-6">
                <label>Sub Category</label>
                <select class="form-control" name="subcat" data-style="btn btn-primary btn-round" title="Select Sub Category" id="subcat" required>
                </select>
              </div>
            	<div class="col-md-6">
      					<div class="form-group has-label">
      					<label>Inner Category Name</label>
      					<input class="form-control" name="name" type="text" required="true" placeholder="Enter Inner Category Name" />
      					</div>
      				</div>
              <div class="col-md-6">
                <div class="form-group has-label">
                  <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                    <div>
                      <span class="btn btn-rose btn-round btn-file">
                        <span class="fileinput-new">Select image</span>
                        <span class="fileinput-exists">Change</span>
                        <input type="file" name="image" class="form-control" accept="image/x-png,image/jpeg"/>
                      </span>
                      <a href="javascript:;" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <label>Select To Best Category</label>
                <div class="form-check">
                  <label class="form-check-label">
                    <input class="form-check-input" type="checkbox" name="sele" value="Best">
                    <span class="form-check-sign"></span>
                    Best Category
                  </label>
                </div>
              </div>
              <h4 class="card-title col-12">Add SEO keywords</h4>
              <div class="col-md-6">
      					<div class="form-group has-label">
      					<label>Keyword title</label>
      					<input class="form-control" name="seo_title" type="text" placeholder="Enter Keyword title" />
      					</div>
      				</div>
              <div class="col-md-6">
      					<div class="form-group has-label">
      					<label>Keyword description</label>
      					<input class="form-control" name="seo_description" type="text" placeholder="Enter Keyword description" />
      					</div>
      				</div>
              <div class="col-md-6">
      					<div class="form-group has-label">
      					<label>Keywords</label>
                <input type="text" class="tagsinput" data-role="tagsinput" data-color="primary" name="seo_keywords" placeholder="Enter Keywords" />
      					</div>
      				</div>
      				<div class="col-md-12">
		            <div class="card-footer text-right">
		              <button type="submit" name="submit" class="btn btn-primary">Submit</button>
		            </div>
	        	</div>
	        </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php
    include("layout/footer.php");
?>