<?php
  include("connect.php");
    session_start();
    
    if(empty($_SESSION['uid']))
    {    
        echo '<script>location.href="login.php";</script>';         
    }
    else
    {
        $id = $_SESSION['uid'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="<?= base_url() ?>image/logo.png">
  <link rel="icon" type="image/png" href="<?= base_url() ?>image/logo.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title> Nandish </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!-- Extra details for Live View on GitHub Pages -->
  <!-- Canonical SEO -->
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="assets/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/css/paper-dashboard.min1036.css?v=2.1.1" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="assets/demo/demo.css" rel="stylesheet" />
  <!-- Extra details for Live View on GitHub Pages -->
  <script type="text/javascript" src="ckeditor/ckeditor.js"></script>
</head>

<body class="">
  <!-- Extra details for Live View on GitHub Pages -->
  <div class="wrapper ">
    <div class="sidebar" data-color="default" data-active-color="danger">
      <div class="logo">
        <a href="" class="simple-text logo-mini">
          <div class="logo-image-small">
            <img src="assets/img/logo-small.png">
          </div>
          <!-- <p>CT</p> -->
        </a>
        <a href="" class="simple-text logo-normal">
          Nandish
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="active">
            <a href="index.php">
              <i class="nc-icon nc-bank"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="">
            <a href="users.php">
              <i class="nc-icon nc-book-bookmark"></i>
              <p>Users</p>
            </a>
          </li>
          <li>
            <a data-toggle="collapse" href="#pages">
              <i class="nc-icon nc-book-bookmark"></i>
              <p>
                Pages<b class="caret"></b>
              </p>
            </a>
            <div class="collapse " id="pages">
              <ul class="nav">
                <li>
                  <a href="privacy.php">
                    <span class="sidebar-mini-icon">PP</span>
                    <span class="sidebar-normal">Privacy Policy </span>
                  </a>
                </li>
                <li>
                  <a href="term.php">
                    <span class="sidebar-mini-icon">TC</span>
                    <span class="sidebar-normal"> Terms & Conditions </span>
                  </a>
                </li>
                <li>
                  <a href="refund.php">
                    <span class="sidebar-mini-icon">RP</span>
                    <span class="sidebar-normal"> Refund Policy </span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li>
            <a data-toggle="collapse" href="#banner">
              <i class="nc-icon nc-book-bookmark"></i>
              <p>
                Banner<b class="caret"></b>
              </p>
            </a>
            <div class="collapse " id="banner">
              <ul class="nav">
                <li>
                  <a href="add_banner.php">
                    <span class="sidebar-mini-icon">AB</span>
                    <span class="sidebar-normal">Add Banner </span>
                  </a>
                </li>
                <li>
                  <a href="banner_list.php">
                    <span class="sidebar-mini-icon">BL</span>
                    <span class="sidebar-normal"> Banner List </span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li>
            <a data-toggle="collapse" href="#category">
              <i class="nc-icon nc-book-bookmark"></i>
              <p>
                Category<b class="caret"></b>
              </p>
            </a>
            <div class="collapse " id="category">
              <ul class="nav">
                <li>
                  <a href="add_category.php">
                    <span class="sidebar-mini-icon">AC</span>
                    <span class="sidebar-normal">Add Category </span>
                  </a>
                </li>
                <li>
                  <a href="category_list.php">
                    <span class="sidebar-mini-icon">CL</span>
                    <span class="sidebar-normal"> Category List </span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li>
            <a data-toggle="collapse" href="#subcategory">
              <i class="nc-icon nc-book-bookmark"></i>
              <p>
                Sub Category<b class="caret"></b>
              </p>
            </a>
            <div class="collapse " id="subcategory">
              <ul class="nav">
                <li>
                  <a href="add_subcategory.php">
                    <span class="sidebar-mini-icon">AS</span>
                    <span class="sidebar-normal">Add Sub Category </span>
                  </a>
                </li>
                <li>
                  <a href="subcategory_list.php">
                    <span class="sidebar-mini-icon">SL</span>
                    <span class="sidebar-normal"> Sub Category List </span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li>
            <a data-toggle="collapse" href="#inner">
              <i class="nc-icon nc-book-bookmark"></i>
              <p>
                Inner Category<b class="caret"></b>
              </p>
            </a>
            <div class="collapse " id="inner">
              <ul class="nav">
                <li>
                  <a href="add_innercategory.php">
                    <span class="sidebar-mini-icon">AI</span>
                    <span class="sidebar-normal">Add Inner Category </span>
                  </a>
                </li>
                <li>
                  <a href="innercategory_list.php">
                    <span class="sidebar-mini-icon">IL</span>
                    <span class="sidebar-normal"> Inner Category List </span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li>
            <a data-toggle="collapse" href="#sub_inner">
              <i class="nc-icon nc-book-bookmark"></i>
              <p>
                Sub Inner Category<b class="caret"></b>
              </p>
            </a>
            <div class="collapse " id="sub_inner">
              <ul class="nav">
                <li>
                  <a href="add_sub_innercategory.php">
                    <span class="sidebar-mini-icon">AI</span>
                    <span class="sidebar-normal">Add Sub Inner Category </span>
                  </a>
                </li>
                <li>
                  <a href="subinnercategory_list.php">
                    <span class="sidebar-mini-icon">IL</span>
                    <span class="sidebar-normal"> Sub Inner Category List </span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li>
            <a data-toggle="collapse" href="#size">
              <i class="nc-icon nc-book-bookmark"></i>
              <p>
                Size<b class="caret"></b>
              </p>
            </a>
            <div class="collapse " id="size">
              <ul class="nav">
                <li>
                  <a href="add_size.php">
                    <span class="sidebar-mini-icon">AS</span>
                    <span class="sidebar-normal">Add Size </span>
                  </a>
                </li>
                <li>
                  <a href="size_list.php">
                    <span class="sidebar-mini-icon">SL</span>
                    <span class="sidebar-normal"> Size List </span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li>
            <a data-toggle="collapse" href="#code">
              <i class="nc-icon nc-book-bookmark"></i>
              <p>
                Coupon Code<b class="caret"></b>
              </p>
            </a>
            <div class="collapse " id="code">
              <ul class="nav">
                <li>
                  <a href="add_coupen.php">
                    <span class="sidebar-mini-icon">ACC</span>
                    <span class="sidebar-normal">Add Coupon Code </span>
                  </a>
                </li>
                <li>
                  <a href="coupen_list.php">
                    <span class="sidebar-mini-icon">CCL</span>
                    <span class="sidebar-normal"> Coupon Code List </span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li>
            <a data-toggle="collapse" href="#product">
              <i class="nc-icon nc-book-bookmark"></i>
              <p>
                Jewellery<b class="caret"></b>
              </p>
            </a>
            <div class="collapse " id="product">
              <ul class="nav">
                <li>
                  <a href="add_product.php">
                    <span class="sidebar-mini-icon">AJ</span>
                    <span class="sidebar-normal">Add Jewellery </span>
                  </a>
                </li>
                <li>
                  <a href="product_list.php">
                    <span class="sidebar-mini-icon">JL</span>
                    <span class="sidebar-normal"> Jewellery List </span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li>
            <a data-toggle="collapse" href="#blog">
              <i class="nc-icon nc-book-bookmark"></i>
              <p>
                Blog<b class="caret"></b>
              </p>
            </a>
            <div class="collapse " id="blog">
              <ul class="nav">
                <li>
                  <a href="add_blog.php">
                    <span class="sidebar-mini-icon">AB</span>
                    <span class="sidebar-normal">Add Blog </span>
                  </a>
                </li>
                <li>
                  <a href="blog_list.php">
                    <span class="sidebar-mini-icon">BL</span>
                    <span class="sidebar-normal"> Blog List </span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li>
            <a data-toggle="collapse" href="#testimonial">
              <i class="nc-icon nc-book-bookmark"></i>
              <p>
                Owner Messsage<b class="caret"></b>
              </p>
            </a>
            <div class="collapse " id="testimonial">
              <ul class="nav">
                <li>
                  <a href="add_testimonial.php">
                    <span class="sidebar-mini-icon">AT</span>
                    <span class="sidebar-normal">Add Owner Messsage </span>
                  </a>
                </li>
                <li>
                  <a href="testimonial_list.php">
                    <span class="sidebar-mini-icon">TL</span>
                    <span class="sidebar-normal"> Owner Messsage List </span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li>
            <a data-toggle="collapse" href="#return">
              <i class="nc-icon nc-book-bookmark"></i>
              <p>
                Return Order<b class="caret"></b>
              </p>
            </a>
            <div class="collapse " id="return">
              <ul class="nav">
                <li>
                  <a href="order_list.php">
                    <span class="sidebar-mini-icon">RO</span>
                    <span class="sidebar-normal">Return Order List</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li>
            <a data-toggle="collapse" href="#complete">
              <i class="nc-icon nc-book-bookmark"></i>
              <p>
                complete Order<b class="caret"></b>
              </p>
            </a>
            <div class="collapse " id="complete">
              <ul class="nav">
                <li>
                  <a href="complete_order_list.php">
                    <span class="sidebar-mini-icon">CL</span>
                    <span class="sidebar-normal"> complete Order List </span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        </ul>
      </div>
    </div>