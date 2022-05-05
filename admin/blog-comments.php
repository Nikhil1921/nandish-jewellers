<?php include("layout/header.php");

extract($_REQUEST);

if(isset($act) && $act === 'delete')
{
  $qry = "SELECT id FROM `comments` WHERE id = '$pid'";
  $run = $connect->query($qry);
  $data = $run->fetch_assoc();
  if(!$data){
      echo '<script>
              alert("Comment not found.");
              window.open("blog-comments.php", "_self");
          </script>';
  }else{
    $qry = "UPDATE `comments` SET `is_deleted` = '1' WHERE id = '$pid'";
    $msg = $connect->query($qry) === true ? 'Data '. (isset($pid) ? "updated" : "inserted") .' successfully'
              : 'Data not '. (isset($pid) ? "updated" : "inserted") .' successfully';

    echo '<script>alert("'.$msg.'"); window.open("blog-comments.php", "_self");</script>';
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
      <a class="navbar-brand" href="">Blog Comments List</a>
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
          <h4 class="card-title">Blog Comments List</h4>
        </div>
        <div class="card-body">
          <div class="toolbar">
          </div>
          <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th>Sr. No</th>
                <th>Title</th>
                <th>Name</th>
                <th>Comment</th>
                <th class="disabled-sorting text-right">Publish</th>
              </tr>
            </thead>
            <tbody>
          	<?php 
                $sql = "SELECT b.title, c.comment, c.name, c.publish, c.id FROM comments c
                INNER JOIN blog b ON b.id = c.b_id
                WHERE c.is_deleted = 0";
                $result = $connect->query($sql); 
                $i = 1;
                while($data = $result->fetch_assoc())
                {
            ?>
            <tr>
              <td><?= $i++;?></td>
              <td><?= $data['title']; ?></td>
              <td><?= $data['name']; ?></td>
              <td><?= $data['comment']; ?></td>
              <td>
                <a href="publish-comment.php?cid=<?= $data['id']; ?>" class="btn btn-<?= $data['publish'] == 0 ? 'danger' : 'success' ?> btn-link btn-icon"><i class="fa fa-thumbs-<?= $data['publish'] == 0 ? 'down' : 'up' ?>"></i></a>
                <a href="blog-comments.php?pid=<?= $data['id']; ?>&act=delete" class="btn btn-danger btn-link btn-icon"><i class="fa fa-trash"></i></a>
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