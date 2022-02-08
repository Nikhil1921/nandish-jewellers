<?php
	include("layout/header.php");

  $sql = "SELECT * FROM login Where adm_id = '$id'";
  $result = $connect->query($sql);
  $data = $result->fetch_assoc();

    if(isset($_POST['submit']))
    {
      $name = $_POST['name'];
      $no = $_POST['no'];
      $email = $_POST['email'];
      $pass = $_POST['pass'];
      $qry = "UPDATE `login` SET adm_name = '$name', adm_mobile='$no', adm_email = '$email'" ;
      $qry .= $pass ? " adm_password='$pass'" : '';
      $qry .= " WHERE adm_id = '$id'";

    if($connect->query($qry) === TRUE)
    {
?>
      <script>
        alert('Profile Update successfully');
        window.open('profile.php','_self');
      </script>
<?php             
    }else{
?>
      <script>
        alert('Profile Not Update successfully');      
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
        <a class="navbar-brand" href="javascript:;">My Profile</a>
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
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h5 class="title">Edit Profile</h5>
          </div>
          <div class="card-body">
            <form method="POST">
              <div class="row">
                <div class="col-md-6 pr-1">
                  <div class="form-group">
                    <label>Username</label>
                    <input type="text" value="<?= $data['adm_name']; ?>" name="name" class="form-control" placeholder="Enter Your name">
                  </div>
                </div>
                <div class="col-md-6 pr-1">
                  <div class="form-group">
                    <label>Mobile No</label>
                    <input type="text" value="<?= $data['adm_mobile']; ?>" name="no" class="form-control" placeholder="Enter Your Mobile No">
                  </div>
                </div>
                <div class="col-md-6 pr-1">
                  <div class="form-group">
                    <label>Email</label>
                    <input type="text" value="<?= $data['adm_email']; ?>" name="email" class="form-control" placeholder="Enter Your Email">
                  </div>
                </div>
                <div class="col-md-6 pr-1">
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="pass" class="form-control" placeholder="Enter Your Password">
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-2">
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                  </div>
                  <div class="col-2">
                    <a href="index.php" class="btn btn-danger">Cancel</a>
                  </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php
    include("layout/footer.php");
?>