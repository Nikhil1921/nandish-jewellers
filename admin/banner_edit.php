<?php
    include("layout/header.php");

    $id = $_REQUEST['bid'];

    $sql = "SELECT * FROM banner Where b_id = $id";
    $result = $connect->query($sql);
    $data = $result->fetch_assoc();
    $image = $data['b_image'];

  if(isset($_POST['submit'])):
    if (!empty($_FILES['image']['name'])):
      $tempimage = $_FILES['image']['tmp_name'];                
      move_uploaded_file($tempimage, "image/banner/$image");
    endif;
    $b_cat_id= $_POST['b_cat_id'];
    $qry = "UPDATE banner SET b_image = '$image', b_cat_id = '$b_cat_id' WHERE b_id = '$id'";      
    if($connect->query($qry) === TRUE):           
?>
      <script>
        alert('data Update successfully');
        window.open('banner_list.php','_self');
      </script>
<?php else: ?>
      <script>
        alert('data Not Update successfully');      
      </script>
<?php 
     endif;
     endif;
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
        <a class="navbar-brand" href="javascript:;">Banner Foram</a>
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
              <h4 class="card-title">Banner Edit</h4>
            </div>
            <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                  <label>Category</label>
                  <select class="form-control" name="b_cat_id" id="b_cat_id" data-style="btn btn-primary btn-round" title="Select Category" required>
                    <option value="0" <?= ($data['b_cat_id'] == 0) ? 'selected' : '' ?>>Home screen</option>
                    <?php
                    $sql = "SELECT * FROM innercategory";
                    $run1 = $connect->query($sql);
                    while ($cat = $run1->fetch_assoc())
                    {
                    ?>
                    <option value="<?= $cat['i_id'] ?>" <?= ($cat['i_id'] == $data['b_cat_id']) ? 'selected' : '' ?>><?=
                    $cat['i_name']; ?></option>
                    <?php } ?>
                  </select>
                </div>
            	<div class="col-md-6">
                <div class="form-group has-label">
                  <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                    <div>
                      <span class="btn btn-rose btn-round btn-file">
                        <span class="fileinput-new">Select Banner image</span>
                        <span class="fileinput-exists">Change</span>
                        <input type="file" value="<?= $data['b_image']; ?>" name="image" class="form-control" />
                      </span>
                      <a href="javascript:;" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                    </div>
                  </div>
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