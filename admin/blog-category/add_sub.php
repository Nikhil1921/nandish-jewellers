<?php
  $show = 'Sub Category';
  include("../layout/header.php");
  extract($_REQUEST);
  
  if(isset($cid)){
    $qry = "SELECT * FROM `blog_sub_category` WHERE id = '$cid'";
    $run = $connect->query($qry);
    $data = $run->fetch_assoc();
  }

  if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST')
  { 
    if(isset($cid) && isset($data))
      $qry = "UPDATE `blog_sub_category` SET `sc_name` = '$name', `c_id` = '$c_id', `seo_title` = '$seo_title', `seo_description` = '$seo_description', `seo_keywords` = '$seo_keywords', `seo_detail` = '' WHERE id = '$cid'";
    else
      $qry = "INSERT INTO `blog_sub_category` (`sc_name`, `c_id`, `seo_title`, `seo_description`, `seo_keywords`, `seo_detail`) VALUES ('$name', '$c_id', '$seo_title', '$seo_description', '$seo_keywords', '')";
    
    $run = $connect->query($qry);

  if($run === true)
  { ?>
        <script>
          alert('Data <?= isset($cid) ? "updated" : "inserted" ?> successfully');
          window.open("<?= $_SERVER['REQUEST_URI'] ?>", '_self');
        </script>
<?php } } ?>
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
        <a class="navbar-brand" href="javascript:;"><?= $show ?> Form</a>
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
              <h4 class="card-title">Add <?= $show ?></h4>
            </div>
            <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <label>Category</label>
                <select class="form-control" name="c_id" id="c_id" data-style="btn btn-primary btn-round" title="Select Category" required>
                  <option value="">Select Category</option>
                  <?php
                  $sql = "SELECT * FROM blog_category";
                  $run1 = $connect->query($sql);
                  while ($cat = $run1->fetch_assoc()) { ?>
                  <option <?= isset($data['c_id']) && $data['c_id'] === $cat['id'] ? 'selected' : '' ?> value="<?= $cat['id']; ?>"><?= $cat['c_name']; ?></option>
                  <?php } ?>
                </select>
              </div>
            	<div class="col-md-6">
      					<div class="form-group has-label">
      					<label>Sub Category Name</label>
      					<input class="form-control" value="<?= isset($data['sc_name']) ? $data['sc_name'] : '' ?>" maxlength="100" name="name" type="text" required="true" placeholder="Enter Sub Category Name" />
      					</div>
      				</div>
              <h4 class="card-title col-12">Add SEO keywords</h4>
              <div class="col-md-6">
      					<div class="form-group has-label">
      					<label>Keyword title</label>
      					<input class="form-control" value="<?= isset($data['seo_title']) ? $data['seo_title'] : '' ?>" name="seo_title" type="text" placeholder="Enter Keyword title" />
      					</div>
      				</div>
              <div class="col-md-6">
      					<div class="form-group has-label">
      					<label>Keyword description</label>
      					<input class="form-control" value="<?= isset($data['seo_description']) ? $data['seo_description'] : '' ?>" name="seo_description" type="text" placeholder="Enter Keyword description" />
      					</div>
      				</div>
              <div class="col-md-6">
      					<div class="form-group has-label">
      					<label>Keywords</label>
                <input type="text" class="tagsinput" value="<?= isset($data['seo_keywords']) ? $data['seo_keywords'] : '' ?>" data-role="tagsinput" data-color="primary" name="seo_keywords" placeholder="Enter Keywords" />
      					</div>
      				</div>
      				<div class="col-md-12">
		            <div class="card-footer text-right">
		              <button type="submit" name="submit" class="btn btn-primary">Submit</button>
		              <a href="<?= $base_url ?>blog-category/sub_list.php" class="btn btn-danger">Go to List</a>
		            </div>
	        	</div>
	        </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
<?php include("../layout/footer.php"); ?>