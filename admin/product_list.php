<?php
require dirname(__DIR__) . '/vendor/autoload.php';
include_once("layout/connect.php");
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'excel-upload'){
  if(!empty($_FILES["excel"]["name"])){
    $headers = [
      'p_name', 'p_gram', 'p_size', 'p_g_wei', 'p_l_wei', 'p_l_char', 'p_make_gram', 'p_code', 'p_shipping', 'p_other', 'p_qty_avail'
    ];
    set_time_limit(0);
    $path = $_FILES["excel"]["tmp_name"];
    $object = \PhpOffice\PhpSpreadsheet\IOFactory::load($path);
    foreach($object->getWorksheetIterator() as $worksheet)
    {
        $highestRow = $worksheet->getHighestRow();
        $highestColumn = $worksheet->getHighestColumn();
        for($row=1; $row <= $highestRow; $row++)
        {
          $id = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
          $sql = "SELECT p_id FROM product WHERE p_id = '$id'";
          
          if ($connect->query($sql)->num_rows > 0) {
            $sql = "UPDATE product SET ";
            foreach ($headers as $k => $v) {
              $k++;
              $sql .= "$v = '".$worksheet->getCellByColumnAndRow(++$k, $row)->getValue()."'";
              $sql .= $k != (count($headers) + 1) ? ', ' : ' ';
            }
            $sql .= "WHERE p_id = '".$id."'";
            $connect->query($sql);
          }
        }
    }
  }
  die("Data updated.");
}

if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'excel-download'){
  

  try {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $headers = [
      'p_id', 'p_name', 'p_gram', 'p_size', 'p_g_wei', 'p_l_wei', 'p_l_char', 'p_make_gram', 'p_code', 'p_shipping', 'p_other', 'p_qty_avail'
    ];

    for ($i = 0, $l = sizeof($headers); $i < $l; $i++) {
        $sheet->setCellValueByColumnAndRow($i + 1, 1, $headers[$i]);
    }
    
    $sql = "SELECT `p_id`, `p_name`, `p_gram`, `p_size`, `p_g_wei`, `p_l_wei`, `p_l_char`, `p_make_gram`, `p_code`, `p_shipping`, `p_other`, `p_qty_avail` FROM product";
    $result = $connect->query($sql); 
    $i = 1;
    
    while($data = $result->fetch_assoc())
    {
      $j = 0;
      foreach ($headers as $v) { // column $j
          $sheet->setCellValueByColumnAndRow($j + 1, ($i + 1), $data[$v]);
          $j++;
      }
      $i++;
    }
    
    $writer = new Xlsx($spreadsheet);
    $writer->save('products.xlsx');
    $filename = 'products.xlsx';
    $content = file_get_contents($filename);
  } catch(Exception $e) {
    exit($e->getMessage());
  }

  header("Content-Disposition: attachment; filename=".$filename);

  unlink($filename);
  exit($content);
}

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'sort') {
  
  
  foreach ($_POST['sort'] as $v) {
    $sql = "UPDATE product SET p_sort = '".$v['position']."' WHERE p_id = '".$v['id']."'";
    $connect->query($sql);
  }
  
  die(json_encode(['message' => "Sort successfull."]));
}

include("layout/header.php") ?>
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
            <div class="row">
              <div class="col-3">
                <h4 class="card-title">Jewellery List</h4>
              </div>
              <div class="col-3">
                <a href="?action=excel-download" class="btn btn-success">Download</a>
              </div>
              <div class="col-3">
                <form method="post" enctype="multipart/form-data">
                  <input type="hidden" name="action" value="excel-upload" />
                  <input type="file" name="excel" id="excel-upload" style="display:none;" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" />
                  <label for="excel-upload" class="btn btn-primary">Upload</label>
                </form>
              </div>
            </div>
          </div>
          <div class="card-body table-responsive">
            <div class="toolbar">
              <div class="row">
                <select name="cat" class="form-control col-2 ml-4" id="cat">
                  <option value="">Select Category</option>
                  <?php 
                    $sql = "SELECT c_id, c_name FROM category";
                    $result = $connect->query($sql);
                    while($v = $result->fetch_assoc()) echo "<option value='".$v['c_id']."'>".$v['c_name']."</option>";
                  ?>
                </select>
                <select class="form-control col-2 ml-4" name="subcat" id="subcat"></select>
                <select class="form-control col-2 ml-4" name="innercat" id="innercat"></select>
                <select class="form-control col-2 ml-4" name="subinnercat" id="subinnercat"></select>
                <select class="form-control col-2 ml-4" name="prod_type" id="prod_type">
                  <option value="">Select Type</option>
                  <option value="All">All</option>
                  <option value="New">New</option>
                  <option value="Best">Best</option>
                </select>
              </div>
            </div>
            <br>
            <?php 
            /* $sql = "SELECT p_id, p_cat, p_subcat, p_innercat, si_id, si_cat_id, si_subcat_id, si_innercat_id FROM product p JOIN sub_innercategory si ON p.p_innercat = si.si_innercat_id";
            $result = $connect->query($sql);
            while($v = $result->fetch_assoc()) {
              $v = (object) $v;
              $sql = "UPDATE 'product' SET p_subinner = '$v->si_id' WHERE p_id = '$v->p_id'";
              $connect->query($sql);
            } */
            ?>
            <table id="products_list" class="table table-striped table-bordered" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Category Name</th>
                  <th>Sub Category Name</th>
                  <th>Inner Name</th>
                  <th>Sub Inner Name</th>
                  <th>Jewellery Name</th>
                  <th>S.K.U. Code</th>
                  <th>Jewellery Gram</th>
                  <th class="disabled-sorting text-right">Actions</th>
                </tr>
              </thead>
              <tbody>
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include("layout/footer.php") ?>