<?php include("layout/header.php") ?>
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
      <a class="navbar-brand" href="">Jewellery List</a>
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
          <h4 class="card-title">Jewellery List</h4>
        </div>
        <div class="card-body">
          <div class="toolbar">
          </div>
          <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>No</th>
                <th>Jewellwey</th>
                <th>Quentity</th>
                <th>Price</th>
                <th>Shipping</th>
              </tr>
            </thead>
            <tbody>
          	<?php
              $je_id = $_GET['je_id'];
				      $sql = "SELECT * FROM orders where o_id = '$je_id'";
      				$result = $connect->query($sql);
              $data = $result->fetch_assoc();
              $pro = json_decode($data['o_details']);
      				
      				foreach ($pro as $k => $v):
                $sql_pr = "SELECT * FROM product where p_id = '$v->prod_id'";
                $result_pr = $connect->query($sql_pr);
                $data_pr = $result_pr->fetch_assoc();
      			?>
            <tr>
              <td><?= ++$k ?></td>
              <td><?= $data_pr['p_name'] ?></td>
              <td><?= $v->qty ?></td>
              <td><?= $v->total ?></td>
              <td><?= $v->shipping ?></td>
            </tr>
            <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>
    </div> 
  </div>
</div>
<?php include("layout/footer.php") ?>