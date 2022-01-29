<?php
    include("layout/header.php");

    $id = $_REQUEST['bid'];

    $sql = "SELECT * FROM blog Where id = $id";
    $result = $connect->query($sql);
    $data = $result->fetch_assoc();
    $image = $data['image'];

  if (isset($_POST['submit'])) 
  {
    $title = $_POST['title'];
    $detail = $_POST['detail'];

    if (!empty($_FILES['image']['name'])) 
    {
        unlink('image/blog/'.$image);
        $image = explode('.', $_FILES['image']['name']);
        $img = time().'.'.end($image);
        $tempimage = $_FILES['image']['tmp_name'];
        move_uploaded_file($tempimage, "image/blog/$img");
    }

    $qr = "UPDATE `blog` set `title`='$title',`detail`='$detail',`image`='$img' where id = '$id'";
    $run = $connect->query($qr)or die("not insert Data");
    if ($run == true) 
    {
?>
       <script>
       alert('Data Updated Successfully');
       window.open('blog_list.php','_self');
      </script>
<?php }else{ ?>
      <script>
       alert('data Not Update successfully');
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
        <a class="navbar-brand" href="javascript:;">Blog Foram</a>
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
              <h4 class="card-title">Blog Edit</h4>
            </div>
            <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <label>Title</label>
                <input class="form-control" name="title" value="<?= $data['title']; ?>" type="text" required="true" placeholder="Enter Title" />
              </div>
            	<div class="col-md-6">
                <div class="form-group has-label">
                  <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                    <div>
                      <span class="btn btn-rose btn-round btn-file">
                        <span class="fileinput-new">Select Blog image</span>
                        <span class="fileinput-exists">Change</span>
                        <input type="file" value="<?= $data['image']; ?>" name="image" class="form-control" />
                      </span>
                      <a href="javascript:;" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group has-label">
                  <label>Blog Detail</label>
                  <textarea class="form-control ckeditor" name="detail"><?= $data['detail']; ?></textarea>
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