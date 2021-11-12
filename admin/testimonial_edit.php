<?php
    include("layout/header.php");

    $id = $_REQUEST['tid'];

    $sql = "SELECT * FROM testimonial Where t_id = $id";
    $result = $connect->query($sql);
    $data = $result->fetch_assoc();
    $image = $data['t_image'];

  if(isset($_POST['submit']))
  { 
    $name = $_POST['name'];
    $detail = $_POST['detail'];

    if (!empty($_FILES['image']['name']))
    {
      $tempimage = $_FILES['image']['tmp_name'];
      move_uploaded_file($tempimage, "image/testimonial/$image");
    }
    $qry = "UPDATE testimonial SET t_name = \"$name\", t_image = \"$image\" , t_detail = \"$detail\" WHERE t_id = '$id'";
    if($connect->query($qry) === TRUE)
    {
?>
      <script>
        alert('data Update successfully');
        window.open('testimonial_list.php','_self');
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
        <a class="navbar-brand" href="javascript:;">Owner Messsage Foram</a>
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
              <h4 class="card-title">Owner Messsage Edit</h4>
            </div>
            <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <label>Name</label>
                <input class="form-control" name="name" value="<?= $data['t_name'] ?>" type="text" required="true" placeholder="Enter Name" />
              </div>
              <div class="col-md-6">
                <div class="form-group has-label">
                  <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                    <div class="fileinput-preview fileinput-exists thumbnail"></div>
                    <div>
                      <span class="btn btn-rose btn-round btn-file">
                        <span class="fileinput-new">Select image</span>
                        <span class="fileinput-exists">Change</span>
                        <input type="file" name="image" value="<?= $data['t_image']; ?>" class="form-control" accept="image/x-png,image/jpeg"/>
                      </span>
                      <a href="javascript:;" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group has-label">
                <label>Testimonial Detail</label>
                <textarea class="form-control" name="detail"><?= $data['t_detail'] ?></textarea>
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