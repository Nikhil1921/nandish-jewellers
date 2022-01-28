<?php
    include("layout/header.php");

    $id = $_REQUEST['scid'];

    $sql = "SELECT * FROM subcategory Where sc_id = $id";
    $result = $connect->query($sql);
    $data = $result->fetch_assoc();

  if(isset($_POST['submit']))
  { 
    $cat = $_POST['cat'];
    $name = $_POST['name'];
    $seo_title = $_POST['seo_title'];
    $seo_description = $_POST['seo_description'];
    $seo_keywords = $_POST['seo_keywords'];
    $detail = $_POST['detail'];
    
    $qry = "UPDATE subcategory SET sc_c_id = '$cat', sc_name = '$name', seo_title = '$seo_title', seo_description = '$seo_description', seo_keywords = '$seo_keywords' , seo_detail = '$detail'WHERE sc_id = '$id'";      
    if($connect->query($qry) === TRUE)
    {            
?>
      <script>
        alert('data Update successfully');
        window.open('subcategory_list.php','_self');
      </script>
<?php }else{ ?>
      <script>
        alert('data Not Update successfully');      
      </script>
<?php 
     }
  }
?>
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
        <a class="navbar-brand" href="javascript:;">Sub Category Foram</a>
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
              <h4 class="card-title">Sub Category Edit</h4>
            </div>
            <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <label>Category</label>
                <select class="selectpicker form-control" name="cat" data-style="btn btn-primary btn-round" title="Select Category" required>
                  <?php 
                    $sql1 = "SELECT * FROM category";
                    $run1 = $connect->query($sql1);
                    while ($data1 = $run1->fetch_assoc()) 
                    {  
                  ?>
                    <option value="<?php echo $data1['c_id']; ?>" <?php if($data['sc_c_id'] == $data1['c_id']) { echo "SELECTED"; } ?>><?php echo 
                    $data1['c_name']; ?></option>
                  <?php } ?>
                </select>
              </div>
            	<div class="col-md-6">
      					<div class="form-group has-label">
      					<label>Sub Category Name</label>
      					<input class="form-control" value="<?= $data['sc_name']; ?>" name="name" type="text" required="true" placeholder="Enter Sub Category Name" />
      					</div>
      				</div>
              <h4 class="card-title col-12">Add SEO keywords</h4>
              <div class="col-md-6">
      					<div class="form-group has-label">
      					<label>Keyword title</label>
      					<input class="form-control" name="seo_title" type="text" value="<?= $data['seo_title'] ?>" placeholder="Enter Keyword title" />
      					</div>
      				</div>
              <div class="col-md-6">
      					<div class="form-group has-label">
                  <label>Keyword description</label>
                  <input class="form-control" name="seo_description" type="text" value="<?= $data['seo_description'] ?>" placeholder="Enter Keyword description" />
      					</div>
      				</div>
              <div class="col-md-6">
      					<div class="form-group has-label">
                  <label>Keywords</label>
                  <input type="text" class="tagsinput" data-role="tagsinput" data-color="primary" name="seo_keywords" value="<?= $data['seo_keywords'] ?>" placeholder="Enter Keywords" />
      					</div>
      				</div>
              <div class="col-md-6">
                <div class="form-group has-label">
                  <label>Detail</label>
                  <textarea class="form-control ckeditor" name="detail"><?= $data['seo_detail'] ?></textarea>
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