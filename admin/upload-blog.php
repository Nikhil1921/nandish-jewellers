<?php
include("layout/header.php");
$id = $_REQUEST['bid'];
$sql = "SELECT id FROM blog Where id = '$id'";
$blog = $connect->query($sql);
$path = 'image/blog/';

if(!$blog->fetch_assoc())
    echo '<script>alert("Blog not found."); window.open("blog_list.php", "_self");</script>';

$sql = "SELECT id, p_image FROM blog_imgs Where b_id = '$id'";
$imgs = $connect->query($sql);

if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST')
{
    extract($_POST);
    
    if (!empty($_FILES['image']['name']))
    {
        require "layout/thumbimage.php";

        $tempimage = $_FILES['image']['tmp_name'];
        $image = "IMG-".time().".".pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        move_uploaded_file($tempimage, $path.$image);
        $objThumbImage = new ThumbImage($path.$image);
        $objThumbImage->createThumb($path."thumb_$image", 350);

        $sql = "INSERT INTO `blog_imgs` (`p_image`, `b_id`) VALUES ('$image','$id')";
        $check = $connect->query($sql);
        $msg = $check === true ? 'Data inserted successfully'
                : 'Data not inserted successfully';
    }else if(isset($iid)){
        $sql = "DELETE FROM `blog_imgs` WHERE `id` = '$iid'";
        $check = $connect->query($sql);
        if($check === true){
            if(is_file($path.$image)) unlink($path.$image);
            if(is_file($path."thumb_$image")) unlink($path."thumb_$image");
        }
        $msg = $check === true ? 'Data removed successfully'
                : 'Data not removed successfully';
    }else
        $msg = "Select image to upload.";

    echo '<script>alert("'.$msg.'"); window.open("'.$_SERVER['REQUEST_URI'].'", "_self");</script>';
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
        <a class="navbar-brand" href="javascript:;">Blogs Form</a>
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
        <div class="card ">
          <div class="card-header ">
            <h4 class="card-title">Upload images</h4>
          </div>
          <div class="card-body">
            <?php if($imgs->num_rows> 0): ?>
                <?php while($data = $imgs->fetch_assoc()): ?>
                <form method="POST">
                  <input type="hidden" name="iid" value="<?= $data['id'] ?>" />
                  <div class="row">
                    <input type="hidden" name="image" value="<?= $data['p_image'] ?>" />
                    <div class="col-6">
                      <img src="<?= $path.$data['p_image'] ?>" alt="" height="100" width="100%">
                    </div>
                    <div class="col-6">
                      <button type="submit" class="btn btn-danger">Remove Image</button>
                    </div>
                  </div>
                </form>
                <?php endwhile ?>
                <?php endif ?>
                <form method="POST" enctype="multipart/form-data">
                    <div class="row">
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
                        <div class="col-6">
                            <button type="submit" class="btn btn-success">Add Image</button>
                            <a href="<?= $base_url ?>blog_list.php" class="btn btn-danger">Go to List</a>
                        </div>
                    </div>
                </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include("layout/footer.php"); ?>