<?php
    include("layout/header.php");

    $id = $_REQUEST['cid'];

    $sql = "SELECT * FROM category Where c_id = $id";
    $result = $connect->query($sql);
    $data = $result->fetch_assoc();

  if(isset($_POST['submit']))
  { 
    $name = $_POST['name'];
    $price = $_POST['price'];
    $price_22 = $_POST['price_22'];
    $price_18 = $_POST['price_18'];

    $qry = "UPDATE category SET c_name = '$name', c_price = '$price', c_price_22 = '$price_22', c_price_18 = '$price_18' WHERE c_id = '$id'";      
    if($connect->query($qry) === TRUE)
    {
?>
      <script>
        alert('data Update successfully');
        window.open('category_list.php','_self');
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
        <a class="navbar-brand" href="javascript:;">Coupen Foram</a>
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
              <h4 class="card-title">Coupen Edit</h4>
            </div>
            <div class="card-body">
            <div class="row">
            	<div class="col-md-6">
      					<div class="form-group has-label">
      					<label>Category Name</label>
      					<input class="form-control" value="<?= $data['c_name']; ?>" name="name" type="text" required="true" placeholder="Enter Category Name" />
      					</div>
      				</div>
              <div class="col-md-6">
                <div class="form-group has-label">
                <label>Price 24 Carat</label>
                <input class="form-control" value="<?= $data['c_price']; ?>" name="price" type="text" required="true" placeholder="Enter Price 24 Carat" />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group has-label">
                <label>Price 22 Carat</label>
                <input class="form-control" value="<?= $data['c_price_22']; ?>" name="price_22" type="text" required="true" placeholder="Enter Price 22 Carat" />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group has-label">
                <label>Price 18 Carat</label>
                <input class="form-control" value="<?= $data['c_price_18']; ?>" name="price_18" type="text" required="true" placeholder="Enter Price 18 Carat" />
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