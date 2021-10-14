<?php
include("layout/header.php");
$id = $_REQUEST['pid'];
$sql = "SELECT p_image FROM product Where p_id = $id";
$result = $connect->query($sql);
$data = $result->fetch_assoc();

if (!$data || empty($data['p_image']))
  echo "<script>alert('No images available to remove.');window.open('product_list.php', '_self');</script>";

$images = explode(",", $data['p_image']);
if(count($_POST))
{
  $img = $_POST['image'];

  if (($k = array_search($img, $images)) !== false) unset($images[$k]);

  $imgs = implode(',', $images);
  $qry = "UPDATE product SET p_image = '$imgs' WHERE p_id = '$id'";
  if($connect->query($qry) === TRUE)
  {
    unlink('image/product/'.$img);
  ?>
  <script>
    alert('data Update successfully');
    <?= "window.open('product_image.php?pid=".$id."', '_self');" ?>
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
        <a class="navbar-brand" href="javascript:;">Product Foram</a>
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
            <h4 class="card-title">Jewellery Edit</h4>
          </div>
          <div class="card-body">
            <?php foreach ($images as $img): ?>
            <form method="POST">
              <input type="hidden" name="pid" value="<?= $id ?>" />
              <div class="row">
                <input type="hidden" name="image" value="<?= $img ?>" />
                <div class="col-6">
                  <img src="image/product/<?= $img ?>" alt="" height="100" width="100%">
                </div>
                <div class="col-6">
                  <button type="submit" class="btn btn-danger">Remove Image</button>
                </div>
              </div>
            </form>
            <?php endforeach ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include("layout/footer.php"); ?>