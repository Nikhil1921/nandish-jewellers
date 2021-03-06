<?php include("../layout/header.php"); $show = 'Sub Inner Category';

extract($_REQUEST);

if(isset($act) && $act === 'delete')
{
  $qry = "SELECT id FROM `blog_sub_inner_category` WHERE id = '$pid'";
  $run = $connect->query($qry);
  $data = $run->fetch_assoc();
  
  if(!$data){
      echo '<script>
              alert("'.$show.' not found.");
              window.open("'.$_SERVER['PHP_SELF'].'", "_self");
          </script>';
  }else{
    $qry = "DELETE FROM `blog_sub_inner_category` WHERE id = '$pid'";
    $msg = $connect->query($qry) === true ? 'Data '. (isset($pid) ? "deleted" : "not deleted") .' successfully'
              : 'Data not '. (isset($pid) ? "deleted" : "not deleted") .' successfully';

    echo '<script>alert("'.$msg.'"); window.open("'.$_SERVER['PHP_SELF'].'", "_self");</script>';
  }
}
?>
<div class="main-panel">
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
      <a class="navbar-brand" href=""><?= $show ?> List</a>
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
          <div class="row">
            <div class="col-md-10">
              <h4 class="card-title"><?= $show ?> List</h4>
            </div>
            <div class="col-md-2">
              <a href="<?= $base_url ?>blog-category/add_sub_inner.php" class="btn btn-warning">Add new</a>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="toolbar">
          </div>
          <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>No</th>
                <th><?= $show ?> Name</th>
                <th>Inner Category</th>
                <th>Sub Category</th>
                <th>Category</th>
                <th class="disabled-sorting text-right">Actions</th>
              </tr>
            </thead>
            <tbody>
          	<?php 
				      $sql = "SELECT si.*, ic.ic_name, sc.sc_name, c.c_name FROM blog_sub_inner_category si
                      INNER JOIN blog_category c ON c.id = si.c_id
                      LEFT JOIN blog_sub_category sc ON sc.id = si.s_id
                      LEFT JOIN blog_inner_category ic ON ic.id = si.s_id";

      				$result = $connect->query($sql); 
      				$i = 1;
      				while($data = $result->fetch_assoc()) { 
            ?>
              <tr>
                <td><?= $i++;?></td>
                <td><?= $data['si_name']; ?></td>
                <td><?= $data['ic_name'] ? $data['ic_name'] : "NA"; ?></td>
                <td><?= $data['sc_name'] ? $data['sc_name'] : "NA"; ?></td>
                <td><?= $data['c_name']; ?></td>
                <td class="text-right">
                    <a href="<?= $base_url ?>blog-category/add_sub_inner.php?cid=<?= $data['id']; ?>" class="btn btn-warning btn-link btn-icon"><i class="fa fa-edit"></i></a>
                    <a href="<?= $base_url ?>blog-category/sub_inner_list.php?pid=<?= $data['id']; ?>&act=delete" class="btn btn-danger btn-link btn-icon"><i class="fa fa-trash"></i></a>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include("../layout/footer.php"); ?>