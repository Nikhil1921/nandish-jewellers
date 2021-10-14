<?php
include("layout/header.php");
if(isset($_POST['submit']))
{
$cat = $_POST['cat'];
$subcat = $_POST['subcat'];
$innercat = $_POST['innercat'];
$name = $_POST['name'];
$price = $_POST['price'];
$detail = $_POST['detail'];
$subdetail = $_POST['subdetail'];
$invoice = null;
// $invoice = $_POST['invoice'];
$notes = $_POST['notes'];
$show = $_POST['show'];
$size_cat = $_POST['size_cat'];
$size = $_POST['size'];
$g_wei = $_POST['g_wei'];
$l_wei = $_POST['l_wei'];
$l_char = $_POST['l_char'];
$p_carat = $_POST['p_carat'];
$p_code = $_POST['p_code'];
$p_shipping = $_POST['p_shipping'];
$p_qty_avail = $_POST['p_qty_avail'];
$p_make_gram = $_POST['p_make_gram'];
$p_other = $_POST['p_other'];
$p_pre = (isset($_POST['p_pre'])) ? 1 : 0;
$countfiles = count($_FILES['image']['name']);
$imgs = [];
if ($_FILES['image']['name'][0]):
for($i=0; $i<$countfiles; $i++)
{
$image = explode('.', $_FILES['image']['name'][$i]);
$filename = time().$i.'.'.end($image);
$imgs[$i] = $filename;
move_uploaded_file($_FILES['image']['tmp_name'][$i], 'image/product/'.$filename);
}
endif;
$img = implode(",", $imgs);
$qry="INSERT INTO `product`( `p_cat`, `p_subcat`, `p_innercat`, `p_name`, `p_gram`, `p_image`, `p_detail`, `p_sub_detail`, `p_invoice`, `p_notes`, `p_show`, `p_size_type`, `p_size`, `p_g_wei`, `p_l_wei`, `p_l_char`, `p_carat`, `p_code`, `p_shipping`, `p_qty_avail`, `p_make_gram`, `p_other`, `p_pre`) VALUES ('$cat','$subcat','$innercat','$name','$price','$img','$detail','$subdetail','$invoice','$notes','$show','$size_cat','$size','$g_wei','$l_wei','$l_char','$p_carat','$p_code','$p_shipping','$p_qty_avail','$p_make_gram','$p_other','$p_pre')";
$run = $connect->query($qry)or die("not insert Data");
if($run == true)
{
?>
<script>
alert('data inserted successfully');
window.open('add_product.php','_self');
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
        <a class="navbar-brand" href="javascript:;">Jewellery Foram</a>
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
              <h4 class="card-title">Add Jewellery</h4>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <label>Category</label>
                  <select class="form-control" name="cat" id="cat" data-style="btn btn-primary btn-round" title="Select Category" required>
                    <option value="Disable">Select Category</option>
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
                  <label>Sub Category</label>
                  <select class="form-control" name="subcat" data-style="btn btn-primary btn-round" title="Select Sub Category" id="subcat" required>
                  </select>
                </div>
                <div class="col-md-6">
                  <label>Inner Category</label>
                  <select class="form-control" name="innercat" data-style="btn btn-primary btn-round" title="Select Sub Category" id="innercat" required>
                  </select>
                </div>
                <div class="col-md-6">
                  <div class="form-group has-label">
                    <label>Jewellery Name</label>
                    <input class="form-control" name="name" type="text" required="true" placeholder="Enter Jewellery Name" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group has-label">
                    <label>Jewellery Code</label>
                    <input class="form-control" name="p_code" type="text" required="true" placeholder="Enter Jewellery Code" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group has-label">
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                      <div class="fileinput-preview fileinput-exists thumbnail"></div>
                      <div>
                        <span class="btn btn-rose btn-round btn-file">
                          <span class="fileinput-new">Jewellery image</span>
                          <span class="fileinput-exists">Change</span>
                          <input type="file" name="image[]" class="form-control" accept="image/png, image/jpeg, image/jpg" multiple />
                        </span>
                        <a href="javascript:;" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <label>Size Type</label>
                  <select class="form-control" name="size_cat" data-style="btn btn-primary btn-round" title="Select Size Type">
                    <option value="Disable">Select Size Type</option>
                    <?php
                    $sql = "SELECT * FROM size";
                    $run1 = $connect->query($sql);
                    while ($data = $run1->fetch_assoc())
                    {
                    ?>
                    <option value="<?php echo $data['s_id']; ?>"><?php echo
                    $data['s_name']; ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="col-md-6">
                  <div class="form-group has-label">
                    <label>Size</label>
                    <input type="text" class="tagsinput" data-role="tagsinput" data-color="primary" name="size" id="size" placeholder="Size" />
                  </div>
                </div>
                <div class="col-md-6">
                  <label>Carates</label>
                  <select class="form-control" name="p_carat" data-style="btn btn-primary btn-round" title="Select Carates">
                    <option value="c_price">24 Carat</option>
                    <option value="c_price_22">22 Carat</option>
                    <option value="c_price_18">18 Carat</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <div class="form-group has-label">
                    <label>Shipping Charge</label>
                    <input class="form-control" name="p_shipping" type="text" required="true" placeholder="Enter Shipping Charge" />
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group has-label">
                    <label>Gross Weight</label>
                    <input class="form-control" name="g_wei" id="g_wei" type="text" required="true" placeholder="Enter Gross Weight" onkeyup="getGrossWeight()" />
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group has-label">
                    <label>Loss Weight</label>
                    <input class="form-control" name="l_wei" id="l_wei" type="text" required="true" placeholder="Enter Loss Weight" onkeyup="getGrossWeight()" />
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group has-label">
                    <label>Net Weight</label>
                    <input class="form-control" name="price" type="text" required="true" placeholder="Net Weight" id="price" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group has-label">
                    <label>Making Charge</label>
                    <input class="form-control" type="text" id="making" name="p_make_gram" placeholder="Enter Making Charge" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group has-label">
                    <label>Total Making Charge</label>
                    <input class="form-control" name="l_char" id="total_making" type="text" required="true" placeholder="Enter Total Making Charge" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group has-label">
                    <label>Jewellery Quantity</label>
                    <input class="form-control" name="p_qty_avail" type="text" required="true" placeholder="Enter Jewellery Quantity" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group has-label">
                    <label>Other Charge</label>
                    <input class="form-control" type="text" name="p_other" placeholder="Enter Other Charge" />
                  </div>
                </div>
                <div class="col-md-6">
                  <label>Option To show</label>
                  <div class="form-check-radio">
                    <label class="form-check-label">
                      <input class="form-check-input" type="radio" name="show" id="exampleRadios1" value="All" checked="">
                      No One Select
                      <span class="form-check-sign"></span>
                    </label>
                  </div>
                  <div class="form-check-radio">
                    <label class="form-check-label">
                      <input class="form-check-input" type="radio" name="show" id="exampleRadios2" value="Best">
                      Best jewellery
                      <span class="form-check-sign"></span>
                    </label>
                  </div>
                  <div class="form-check-radio">
                    <label class="form-check-label">
                      <input class="form-check-input" type="radio" name="show" id="exampleRadios3" value="New">
                      New arrival
                      <span class="form-check-sign"></span>
                    </label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group has-label">
                    <label>Preorder</label><br>
                    <input class="bootstrap-switch" type="checkbox" data-toggle="switch" data-on-label="<i class='nc-icon nc-check-2'></i>" data-off-label="<i class='nc-icon nc-simple-remove'></i>" data-on-color="success" data-off-color="success" name="p_pre" />
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group has-label">
                    <label>Jewellery Detail</label>
                    <textarea class="form-control ckeditor" name="detail"></textarea>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group has-label">
                    <label>Jewellery Table Detail</label>
                    <textarea class="form-control ckeditor" name="subdetail"></textarea>
                  </div>
                </div>
                <!-- <div class="col-md-6">
                  <div class="form-group has-label">
                    <label>Jewellery Invoice</label>
                    <textarea class="form-control ckeditor" name="invoice"></textarea>
                  </div>
                </div> -->
                <div class="col-md-6">
                  <div class="form-group has-label">
                    <label>Jewellery Notes</label>
                    <textarea class="form-control ckeditor" name="notes"></textarea>
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
  <script>
  function getGrossWeight()
  {
  let g_wei = Number(document.getElementById('g_wei').value);
  let l_wei = Number(document.getElementById('l_wei').value);
  document.getElementById('price').value = (g_wei - l_wei).toFixed(2);
  }
  
  document.querySelector('#making').addEventListener('keyup', function () {
  let make = (this.value) ? this.value : 1;
  let price = Number(document.getElementById('price').value);
  price = (price) ? price : 1;
  document.getElementById('total_making').value = (make * price).toFixed(2);
  });
  </script>
  <?php
  include("layout/footer.php");
  ?>