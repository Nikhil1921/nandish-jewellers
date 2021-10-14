<?php
    include("layout/header.php");

    if(isset($_POST['submit']))
   	{ 
		  $cat = $_POST['cat'];
      $name = $_POST['name'];

    	$qry="INSERT INTO `subcategory`(`sc_c_id`, `sc_name`) VALUES ('$cat','$name')";
    	$run = $connect->query($qry)or die("not insert Data");

		if($run == true)
		{             
?>
       		<script>
       			alert('data inserted successfully');
       			window.open('add_subcategory.php','_self');
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
              <h4 class="card-title">Add Sub Category</h4>
            </div>
            <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <label>Category</label>
                <select class="selectpicker form-control" name="cat" data-style="btn btn-primary btn-round" title="Select Category" required>
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
      					<div class="form-group has-label">
      					<label>Category Name</label>
      					<input class="form-control" name="name" type="text" required="true" placeholder="Enter Category Name" />
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