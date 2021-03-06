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
      <a class="navbar-brand" href="">Blog List</a>
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
          <h4 class="card-title">Blog List</h4>
        </div>
        <div class="card-body">
          <div class="toolbar">
          </div>
          <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Sr. No</th>
                <th>Title</th>
                <th>Sub Inner Category</th>
                <th>Inner Category</th>
                <th>Sub Category</th>
                <th>Category</th>
                <th class="disabled-sorting text-right">Homepage</th>
                <th class="disabled-sorting text-right">Actions</th>
              </tr>
            </thead>
            <tbody>
          	<?php 
				      $sql = "SELECT b.*, c.c_name, sc.sc_name, ic.ic_name, si.si_name FROM blog b
                      INNER JOIN blog_category c ON c.id = b.c_id
                      LEFT JOIN blog_sub_category sc ON sc.id = b.sc_id
                      LEFT JOIN blog_inner_category ic ON ic.id = b.ic_id
                      LEFT JOIN blog_sub_inner_category si ON si.id = b.si_id";
      				$result = $connect->query($sql); 
      				$i = 1;
      				while($data = $result->fetch_assoc())
      				{
      			?>
            <tr>
              <td><?= $i++;?></td>
              <td><?= $data['title']; ?></td>
              <td><?= $data['si_name'] ? $data['si_name'] : "NA"; ?></td>
              <td><?= $data['ic_name'] ? $data['ic_name'] : "NA"; ?></td>
              <td><?= $data['sc_name'] ? $data['sc_name'] : "NA"; ?></td>
              <td><?= $data['c_name'] ? $data['c_name'] : "NA"; ?></td>
              <td><a href="home-blog.php?bid=<?= $data['id']; ?>" class="btn btn-<?= $data['for_homepage'] == 0 ? 'danger' : 'success' ?> btn-link btn-icon"><i class="fa fa-thumbs-<?= $data['for_homepage'] == 0 ? 'down' : 'up' ?>"></i></a></td>
              <td class="text-right">
                  <a href="add_blog.php?bid=<?= $data['id']; ?>" class="btn btn-warning btn-link btn-icon"><i class="fa fa-edit"></i></a>
                  <a href="upload-blog.php?bid=<?= $data['id']; ?>" class="btn btn-dark btn-link btn-icon"><i class="fa fa-image"></i></a>
                  <a href="blog_delete.php?bid=<?= $data['id']; ?>&image=<?= $data['image'] ?>" class="btn btn-danger btn-link btn-icon"><i class="fa fa-times"></i></a>
              </td>
            </tr>
            <?php } ?>
            </tbody>
          </table>
        </div><!-- end content-->
      </div><!--  end card  -->
    </div> <!-- end col-md-12 -->
  </div> <!-- end row -->
</div>
<?php
    include("layout/footer.php");
?>