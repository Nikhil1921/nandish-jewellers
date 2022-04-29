<?php include("layout/header.php");
    extract($_REQUEST);
    $path = 'image/blog/';

    if(isset($bid)){
      $qry = "SELECT * FROM `blog` WHERE id = '$bid'";
      $run = $connect->query($qry);
      $data = $run->fetch_assoc();
    }

    if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST')
    { 
      if (!empty($_FILES['image']['name']))
      {
        require "layout/thumbimage.php";

        $tempimage = $_FILES['image']['tmp_name'];
        $image = "IMG-".time().".".pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        move_uploaded_file($tempimage, $path.$image);
        $objThumbImage = new ThumbImage($path.$image);
        $objThumbImage->createThumb($path."thumb_$image", 350);
      }else
        $image = $img;
      
      $c_id = $c_id ? $c_id : 0;
      $sc_id = $sc_id ? $sc_id : 0;
      $ic_id = $ic_id ? $ic_id : 0;
      $si_id = $si_id ? $si_id : 0;
      
      if(isset($bid) && isset($data))
        $qry = "UPDATE `blog` SET `title`='$title',`detail`='$detail',`c_id`='$c_id',`sc_id`='$sc_id',`ic_id`='$ic_id',`si_id`='$si_id',`image`='$image',`seo_title`='$seo_title',`seo_description`='$seo_description',`seo_keywords`='$seo_keywords',`seo_detail`='$seo_detail' WHERE id = '$bid'";
      else
        $qry = "INSERT INTO `blog` (`title`, `detail`, `c_id`, `sc_id`, `ic_id`, `si_id`, `image`, `seo_title`, `seo_description`, `seo_keywords`, `seo_detail`) VALUES ('$title', '$detail', '$c_id', '$sc_id', '$ic_id', '$si_id', '$image', '$seo_title', '$seo_description', '$seo_keywords', '$seo_detail')";
      
      $check = $connect->query($qry);

      if(isset($bid) && $check === true && $image != $img){
        if(is_file($path.$img)) unlink($path.$img);
        if(is_file($path."thumb_$img")) unlink($path."thumb_$img");
      }

      $msg = $check === true ? 'Data '. (isset($bid) ? "updated" : "inserted") .' successfully'
                : 'Data not '. (isset($bid) ? "updated" : "inserted") .' successfully';
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
        <a class="navbar-brand" href="javascript:;">Blog Form</a>
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
          <input type="hidden" name="img" value="<?= isset($data['image']) ? $data['image'] : '' ?>" />
          <div class="card ">
            <div class="card-header ">
              <h4 class="card-title">Add Blog</h4>
            </div>
            <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <label>Category</label>
                <select class="form-control category-check" data-title="Sub category" data-url="<?= $base_url ?>get-subcats" name="c_id" id="c_id" data-dependent="sc_id" data-value="<?= isset($data['sc_id']) ? $data['sc_id'] : '' ?>" required>
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
                <label>Sub Category</label>
                <select class="form-control category-check" name="sc_id" id="sc_id" data-title="Inner category" data-url="<?= $base_url ?>get-inner" data-dependent="ic_id" data-value="<?= isset($data['ic_id']) ? $data['ic_id'] : '' ?>"></select>
              </div>
              <div class="col-md-6">
                <label>Inner Category</label>
                <select class="form-control category-check" name="ic_id" id="ic_id" data-title="Sub inner category" data-url="<?= $base_url ?>get-subinner" data-dependent="si_id" data-value="<?= isset($data['si_id']) ? $data['si_id'] : '' ?>"></select>
              </div>
            	<div class="col-md-6">
      					<div class="form-group has-label">
      					<label>Sub Inner Category</label>
      					<select class="form-control" name="si_id" id="si_id"></select>
      					</div>
      				</div>
      				<div class="col-md-6">
                <label>Title</label>
                <input class="form-control" value="<?= isset($data['title']) ? $data['title'] : '' ?>" name="title" type="text" required="true" placeholder="Enter Title" />
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
                  <?= isset($data['title']) ? '<img src="'.$path.$data['image'].'" alt="" height="50" width="100" />' : '' ?>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group has-label">
                  <label>Blog Detail</label>
                  <textarea class="form-control ckeditor" name="detail"><?= isset($data['detail']) ? $data['detail'] : '' ?></textarea>
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
                <div class="form-group has-label">
                  <label>Detail</label>
                  <textarea class="form-control ckeditor" name="seo_detail"><?= isset($data['seo_detail']) ? $data['seo_detail'] : '' ?></textarea>
                </div>
              </div>
      				<div class="col-md-12">
		            <div class="card-footer text-right">
		              <button type="submit" class="btn btn-primary">Submit</button>
		              <a href="<?= $base_url ?>blog_list.php" class="btn btn-danger">Go to List</a>
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