<?php
    include("layout/header.php");
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
      <a class="navbar-brand" href="">Sub Inner Category List</a>
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
          <h4 class="card-title">Sub Inner Category List</h4>
        </div>
        <div class="card-body">
          <div class="toolbar">
          </div>
          <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Sub Inner Category Name</th>
                <th>Inner Category Name</th>
                <th>Sub Category Name</th>
                <th>Category Name</th>
                <th class="disabled-sorting text-right">Actions</th>
              </tr>
            </thead>
            <tbody>
          	<?php
                /* $sql = "SELECT * FROM innercategory";
                $result = $connect->query($sql)->fetch_all(MYSQLI_ASSOC);
                $sql = "INSERT INTO `sub_innercategory`(`si_cat_id`, `si_subcat_id`, `si_innercat_id`, `si_name`, `seo_title`, `seo_description`, `seo_keywords`) VALUES ";
                foreach ($result as $v) {
                  $v = (object) $v;
                  $sql .= "('$v->i_cat_id', '$v->i_sub_id', '$v->i_id', 'New', '$v->seo_title', '$v->seo_description', '$v->seo_keywords'), ";
                }
                re($sql); */
                $sql = "SELECT * FROM sub_innercategory si
                join category c on si.si_cat_id = c.c_id
                join subcategory sc on si.si_subcat_id = sc.sc_id
                join innercategory ic on si.si_innercat_id = ic.i_id";
                $result = $connect->query($sql); 
                $i = 1;
                while($data = $result->fetch_assoc())
                {
            ?>
            <tr>
              <td><?= $i++;?></td>
              <td><?= $data['si_name']; ?></td>
              <td><?= $data['i_name']; ?></td>
              <td><?= $data['sc_name']; ?></td>
              <td><?= $data['c_name']; ?></td>
              <td class="text-right">
                  <a href="sub_innercategory_edit.php?si_id=<?= $data['si_id']; ?>" class="btn btn-warning btn-link btn-icon"><i class="fa fa-edit"></i></a>
                  <a href="sub_innercategory_delete.php?si_id=<?= $data['si_id']; ?>" class="btn btn-danger btn-link btn-icon"><i class="fa fa-times"></i></a>
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
<?php
    include("layout/footer.php");
?>