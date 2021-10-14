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
      <a class="navbar-brand" href="">Return Order List</a>
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
          <h4 class="card-title">Return Order List</h4>
        </div>
        <div class="card-body">
          <div class="toolbar">
          </div>
          <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>No</th>
                <th>User Name</th>
                <th>User Mobile</th>
                <th>User Email</th>
                <th>Total Price</th>
                <th>Address</th>
                <th class="disabled-sorting text-right">Jewellery Detail</th>
              </tr>
            </thead>
            <tbody>
            <?php 
              $sql = "SELECT * FROM orders o
                      join user u on u.u_id = o.o_u_id
                      where o_return = 1 AND o_status = 2";
              $result = $connect->query($sql); 
              $i = 1;
              while($data = $result->fetch_assoc())
              {
            ?>
            <tr>
              <td><?= $i++;?></td>
              <td><?= $data['u_f_name'].' '.$data['u_m_name'].' '.$data['u_l_name']; ?></td>
              <td><?= $data['u_mobile']; ?></td>
              <td><?= $data['u_email']; ?></td>
              <td><?= $data['o_total']; ?></td>
              <td><?= $data['o_address'].' ,'.$data['o_city'].' ,'.$data['o_state']; ?></td>
              <td class="text-right">
                  <a href="detail.php?je_id=<?= $data['o_id']; ?>" class="btn btn-warning btn-link btn-icon"><i class="fa fa-eye"></i></a>
                  <a href="return_accept.php?o_id=<?= $data['o_id']; ?>" class="btn btn-primary btn-round">Accept</a>
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