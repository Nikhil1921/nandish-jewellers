<?php
  include_once("connect.php");
  session_start();
  $base_url = (isset($_SERVER["HTTPS"]) ? "https://" : "http://").$_SERVER["HTTP_HOST"];
  switch ($_SERVER['SERVER_NAME']) {
      case 'www.nandish.in':
      case 'nandish.in':
      case 'https://www.nandish.in':
      case 'https://nandish.in':
            $base_url .= '/admin/';
          break;
      
      default:
          $base_url .= '/nandish/admin/';
          break;
  }
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
  <link rel="apple-touch-icon" sizes="76x76" href="<?= $base_url ?>image/logo.png">
  <link rel="icon" type="image/png" href="<?= $base_url ?>image/logo.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title> Nandish </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!-- Extra details for Live View on GitHub Pages -->
  <!-- Canonical SEO -->
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="<?= $base_url ?>assets/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="<?= $base_url ?>assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="<?= $base_url ?>assets/css/paper-dashboard.min1036.css?v=2.1.1" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="<?= $base_url ?>assets/demo/demo.css" rel="stylesheet" />
  <!-- Extra details for Live View on GitHub Pages -->
  <script type="text/javascript" src="<?= $base_url ?>ckeditor/ckeditor.js"></script>
</head>

<body class="">
  <!-- Extra details for Live View on GitHub Pages -->
  <div class="wrapper ">
    <div class="sidebar" data-color="default" data-active-color="danger">
      <div class="logo">
        <a href="<?= $base_url ?>" class="simple-text logo-mini">
          <div class="logo-image-small">
            <img src="assets/img/logo-small.png">
          </div>
          <!-- <p>CT</p> -->
        </a>
        <a href="<?= $base_url ?>" class="simple-text logo-normal">
          Nandish
        </a>
      </div>
      <?php $name = str_replace('.php', '', basename($_SERVER['PHP_SELF'])); ?>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="<?= in_array($name, ['index']) ? 'active' : '' ?>">
            <a href="<?= $base_url ?>index.php">
              <i class="nc-icon nc-bank"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="<?= in_array($name, ['users']) ? 'active' : '' ?>">
            <a href="<?= $base_url ?>users.php">
              <i class="nc-icon nc-book-bookmark"></i>
              <p>Users</p>
            </a>
          </li>
          <li class="<?= in_array($name, ['reviews', 'reply-review']) ? 'active' : '' ?>">
            <a href="<?= $base_url ?>reviews.php">
              <i class="nc-icon nc-book-bookmark"></i>
              <p>Jewellery Reviews</p>
            </a>
          </li>
          <li class="<?= in_array($name, ['blog-comments']) ? 'active' : '' ?>">
            <a href="<?= $base_url ?>blog-comments.php">
              <i class="nc-icon nc-book-bookmark"></i>
              <p>Blog Comments</p>
            </a>
          </li>
          <li class="<?= in_array($name, ['privacy', 'term', 'refund']) ? 'active' : '' ?>">
            <a data-toggle="collapse" href="#pages" <?= in_array($name, ['privacy', 'term', 'refund']) ? 'aria-expanded="true"' : '' ?>>
              <i class="nc-icon nc-book-bookmark"></i>
              <p>
                Pages<b class="caret"></b>
              </p>
            </a>
            <div class="collapse <?= in_array($name, ['privacy', 'term', 'refund']) ? 'show' : '' ?>" id="pages">
              <ul class="nav">
                <li class="<?= in_array($name, ['privacy']) ? 'active' : '' ?>">
                  <a href="<?= $base_url ?>privacy.php">
                    <span class="sidebar-mini-icon">PP</span>
                    <span class="sidebar-normal">Privacy Policy </span>
                  </a>
                </li>
                <li class="<?= in_array($name, ['term']) ? 'active' : '' ?>">
                  <a href="<?= $base_url ?>term.php">
                    <span class="sidebar-mini-icon">TC</span>
                    <span class="sidebar-normal"> Terms & Conditions </span>
                  </a>
                </li>
                <li class="<?= in_array($name, ['refund']) ? 'active' : '' ?>">
                  <a href="<?= $base_url ?>refund.php">
                    <span class="sidebar-mini-icon">RP</span>
                    <span class="sidebar-normal"> Refund Policy </span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="<?= in_array($name, ['add_banner', 'banner_list']) ? 'active' : '' ?>">
            <a data-toggle="collapse" href="#banner" <?= in_array($name, ['add_banner', 'banner_list']) ? 'aria-expanded="true"' : '' ?>>
              <i class="nc-icon nc-book-bookmark"></i>
              <p>
                Banner<b class="caret"></b>
              </p>
            </a>
            <div class="collapse <?= in_array($name, ['add_banner', 'banner_list']) ? 'show' : '' ?>" id="banner">
              <ul class="nav">
                <li class="<?= in_array($name, ['add_banner']) ? 'active' : '' ?>">
                  <a href="<?= $base_url ?>add_banner.php">
                    <span class="sidebar-mini-icon">AB</span>
                    <span class="sidebar-normal">Add Banner </span>
                  </a>
                </li>
                <li class="<?= in_array($name, ['banner_list']) ? 'active' : '' ?>">
                  <a href="<?= $base_url ?>banner_list.php">
                    <span class="sidebar-mini-icon">BL</span>
                    <span class="sidebar-normal"> Banner List </span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="<?= in_array($name, ['add_category', 'category_list']) ? 'active' : '' ?>">
            <a data-toggle="collapse" href="#category" <?= in_array($name, ['add_category', 'category_list']) ? 'aria-expanded="true"' : '' ?>>
              <i class="nc-icon nc-book-bookmark"></i>
              <p>
                Category<b class="caret"></b>
              </p>
            </a>
            <div class="collapse <?= in_array($name, ['add_category', 'category_list']) ? 'show' : '' ?>" id="category">
              <ul class="nav">
                <li class="<?= in_array($name, ['add_category']) ? 'active' : '' ?>">
                  <a href="<?= $base_url ?>add_category.php">
                    <span class="sidebar-mini-icon">AC</span>
                    <span class="sidebar-normal">Add Category </span>
                  </a>
                </li>
                <li class="<?= in_array($name, ['category_list']) ? 'active' : '' ?>">
                  <a href="<?= $base_url ?>category_list.php">
                    <span class="sidebar-mini-icon">CL</span>
                    <span class="sidebar-normal"> Category List </span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="<?= in_array($name, ['add_subcategory', 'subcategory_list']) ? 'active' : '' ?>">
            <a data-toggle="collapse" href="#subcategory" <?= in_array($name, ['add_subcategory', 'subcategory_list']) ? 'aria-expanded="true"' : '' ?>>
              <i class="nc-icon nc-book-bookmark"></i>
              <p>
                Sub Category<b class="caret"></b>
              </p>
            </a>
            <div class="collapse <?= in_array($name, ['add_subcategory', 'subcategory_list']) ? 'show' : '' ?>" id="subcategory">
              <ul class="nav">
                <li class="<?= in_array($name, ['add_subcategory']) ? 'active' : '' ?>">
                  <a href="<?= $base_url ?>add_subcategory.php">
                    <span class="sidebar-mini-icon">AS</span>
                    <span class="sidebar-normal">Add Sub Category </span>
                  </a>
                </li>
                <li class="<?= in_array($name, ['subcategory_list']) ? 'active' : '' ?>">
                  <a href="<?= $base_url ?>subcategory_list.php">
                    <span class="sidebar-mini-icon">SL</span>
                    <span class="sidebar-normal"> Sub Category List </span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="<?= in_array($name, ['add_innercategory','innercategory_list']) ? 'active' : '' ?>">
            <a data-toggle="collapse" href="#inner" <?= in_array($name, ['add_innercategory','innercategory_list']) ? 'aria-expanded="true"' : '' ?>>
              <i class="nc-icon nc-book-bookmark"></i>
              <p>
                Inner Category<b class="caret"></b>
              </p>
            </a>
            <div class="collapse <?= in_array($name, ['add_innercategory','innercategory_list']) ? 'show' : '' ?>" id="inner">
              <ul class="nav">
                <li class="<?= in_array($name, ['add_innercategory']) ? 'active' : '' ?>">
                  <a href="<?= $base_url ?>add_innercategory.php">
                    <span class="sidebar-mini-icon">AI</span>
                    <span class="sidebar-normal">Add Inner Category </span>
                  </a>
                </li>
                <li class="<?= in_array($name, ['innercategory_list']) ? 'active' : '' ?>">
                  <a href="<?= $base_url ?>innercategory_list.php">
                    <span class="sidebar-mini-icon">IL</span>
                    <span class="sidebar-normal"> Inner Category List </span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="<?= in_array($name, ['add_sub_innercategory', 'subinnercategory_list']) ? 'active' : '' ?>">
            <a data-toggle="collapse" href="#sub_inner" <?= in_array($name, ['add_sub_innercategory', 'subinnercategory_list']) ? 'aria-expanded="true"' : '' ?>>
              <i class="nc-icon nc-book-bookmark"></i>
              <p>
                Sub Inner Category<b class="caret"></b>
              </p>
            </a>
            <div class="collapse <?= in_array($name, ['add_sub_innercategory', 'subinnercategory_list']) ? 'show' : '' ?>" id="sub_inner">
              <ul class="nav">
                <li class="<?= in_array($name, ['add_sub_innercategory']) ? 'active' : '' ?>">
                  <a href="<?= $base_url ?>add_sub_innercategory.php">
                    <span class="sidebar-mini-icon">AI</span>
                    <span class="sidebar-normal">Add Sub Inner Category </span>
                  </a>
                </li>
                <li class="<?= in_array($name, ['subinnercategory_list']) ? 'active' : '' ?>">
                  <a href="<?= $base_url ?>subinnercategory_list.php">
                    <span class="sidebar-mini-icon">IL</span>
                    <span class="sidebar-normal"> Sub Inner Category List </span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="<?= in_array($name, ['add_size', 'size_list']) ? 'active' : '' ?>">
            <a data-toggle="collapse" href="#size" <?= in_array($name, ['add_size', 'size_list']) ? 'aria-expanded="true"' : '' ?>>
              <i class="nc-icon nc-book-bookmark"></i>
              <p>
                Size<b class="caret"></b>
              </p>
            </a>
            <div class="collapse <?= in_array($name, ['add_size', 'size_list']) ? 'show' : '' ?>" id="size">
              <ul class="nav">
                <li class="<?= in_array($name, ['add_size']) ? 'active' : '' ?>">
                  <a href="<?= $base_url ?>add_size.php">
                    <span class="sidebar-mini-icon">AS</span>
                    <span class="sidebar-normal">Add Size </span>
                  </a>
                </li>
                <li class="<?= in_array($name, ['size_list']) ? 'active' : '' ?>">
                  <a href="<?= $base_url ?>size_list.php">
                    <span class="sidebar-mini-icon">SL</span>
                    <span class="sidebar-normal"> Size List </span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="<?= in_array($name, ['add_coupen', 'coupen_list']) ? 'active' : '' ?>">
            <a data-toggle="collapse" href="#code" <?= in_array($name, ['add_coupen', 'coupen_list']) ? 'aria-expanded="true"' : '' ?>>
              <i class="nc-icon nc-book-bookmark"></i>
              <p>
                Coupon Code<b class="caret"></b>
              </p>
            </a>
            <div class="collapse <?= in_array($name, ['add_coupen', 'coupen_list']) ? 'show' : '' ?>" id="code">
              <ul class="nav">
                <li class="<?= in_array($name, ['add_coupen']) ? 'active' : '' ?>">
                  <a href="<?= $base_url ?>add_coupen.php">
                    <span class="sidebar-mini-icon">ACC</span>
                    <span class="sidebar-normal">Add Coupon Code </span>
                  </a>
                </li>
                <li class="<?= in_array($name, ['coupen_list']) ? 'active' : '' ?>">
                  <a href="<?= $base_url ?>coupen_list.php">
                    <span class="sidebar-mini-icon">CCL</span>
                    <span class="sidebar-normal"> Coupon Code List </span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="<?= in_array($name, ['add_product', 'product_list']) ? 'active' : '' ?>">
            <a data-toggle="collapse" href="#product" <?= in_array($name, ['add_product', 'product_list']) ? 'aria-expanded="true"' : '' ?>>
              <i class="nc-icon nc-book-bookmark"></i>
              <p>
                Jewellery<b class="caret"></b>
              </p>
            </a>
            <div class="collapse <?= in_array($name, ['add_product', 'product_list']) ? 'show' : '' ?>" id="product">
              <ul class="nav">
                <li class="<?= in_array($name, ['add_product']) ? 'active' : '' ?>">
                  <a href="<?= $base_url ?>add_product.php">
                    <span class="sidebar-mini-icon">AJ</span>
                    <span class="sidebar-normal">Add Jewellery </span>
                  </a>
                </li>
                <li class="<?= in_array($name, ['product_list']) ? 'active' : '' ?>">
                  <a href="<?= $base_url ?>product_list.php">
                    <span class="sidebar-mini-icon">JL</span>
                    <span class="sidebar-normal"> Jewellery List </span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="<?= in_array($name, ['add_blog', 'blog_list', 'cat_list', 'add_cat', 'sub_list', 'add_sub', 'inner_list', 'add_inner', 'sub_inner_list', 'add_sub_inner', 'upload-blog']) ? 'active' : '' ?>">
            <a data-toggle="collapse" href="#blog" <?= in_array($name, ['add_blog', 'blog_list', 'cat_list', 'add_cat', 'sub_list', 'add_sub', 'inner_list', 'add_inner', 'sub_inner_list', 'add_sub_inner', 'upload-blog']) ? 'aria-expanded="true"' : '' ?>>
              <i class="nc-icon nc-book-bookmark"></i>
              <p>
                Blog<b class="caret"></b>
              </p>
            </a>
            <div class="collapse <?= in_array($name, ['add_blog', 'blog_list', 'cat_list', 'add_cat', 'sub_list', 'add_sub', 'inner_list', 'add_inner', 'sub_inner_list', 'add_sub_inner', 'upload-blog']) ? 'show' : '' ?>" id="blog">
              <ul class="nav">
                <li class="<?= in_array($name, ['add_blog']) ? 'active' : '' ?>">
                  <a href="<?= $base_url ?>add_blog.php">
                    <span class="sidebar-mini-icon">AB</span>
                    <span class="sidebar-normal">Add Blog </span>
                  </a>
                </li>
                <li class="<?= in_array($name, ['blog_list', 'upload-blog']) ? 'active' : '' ?>">
                  <a href="<?= $base_url ?>blog_list.php">
                    <span class="sidebar-mini-icon">BL</span>
                    <span class="sidebar-normal"> Blog List </span>
                  </a>
                </li>
                <li class="<?= in_array($name, ['cat_list', 'add_cat']) ? 'active' : '' ?>">
                  <a href="<?= $base_url ?>blog-category/cat_list.php">
                    <span class="sidebar-mini-icon">CL</span>
                    <span class="sidebar-normal"> Category List </span>
                  </a>
                </li>
                <li class="<?= in_array($name, ['sub_list', 'add_sub']) ? 'active' : '' ?>">
                  <a href="<?= $base_url ?>blog-category/sub_list.php">
                    <span class="sidebar-mini-icon">SCL</span>
                    <span class="sidebar-normal"> Sub Category List </span>
                  </a>
                </li>
                <li class="<?= in_array($name, ['inner_list', 'add_inner']) ? 'active' : '' ?>">
                  <a href="<?= $base_url ?>blog-category/inner_list.php">
                    <span class="sidebar-mini-icon">ICL</span>
                    <span class="sidebar-normal"> Inner Category List </span>
                  </a>
                </li>
                <li class="<?= in_array($name, ['sub_inner_list', 'add_sub_inner']) ? 'active' : '' ?>">
                  <a href="<?= $base_url ?>blog-category/sub_inner_list.php">
                    <span class="sidebar-mini-icon">SIL</span>
                    <span class="sidebar-normal"> Sub Inner Category List </span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="<?= in_array($name, ['add_testimonial', 'testimonial_list']) ? 'active' : '' ?>">
            <a data-toggle="collapse" href="#testimonial" <?= in_array($name, ['add_testimonial', 'testimonial_list']) ? 'aria-expanded="true"' : '' ?>>
              <i class="nc-icon nc-book-bookmark"></i>
              <p>
                Owner Messsage<b class="caret"></b>
              </p>
            </a>
            <div class="collapse <?= in_array($name, ['add_testimonial', 'testimonial_list']) ? 'show' : '' ?>" id="testimonial">
              <ul class="nav">
                <li class="<?= in_array($name, ['add_testimonial']) ? 'active' : '' ?>">
                  <a href="<?= $base_url ?>add_testimonial.php">
                    <span class="sidebar-mini-icon">AT</span>
                    <span class="sidebar-normal">Add Owner Messsage </span>
                  </a>
                </li>
                <li class="<?= in_array($name, ['testimonial_list']) ? 'active' : '' ?>">
                  <a href="<?= $base_url ?>testimonial_list.php">
                    <span class="sidebar-mini-icon">TL</span>
                    <span class="sidebar-normal"> Owner Messsage List </span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="<?= in_array($name, ['order_list']) ? 'active' : '' ?>">
            <a data-toggle="collapse" href="#return" <?= in_array($name, ['order_list']) ? 'aria-expanded="true"' : '' ?>>
              <i class="nc-icon nc-book-bookmark"></i>
              <p>
                Return Order<b class="caret"></b>
              </p>
            </a>
            <div class="collapse <?= in_array($name, ['order_list']) ? 'show' : '' ?>" id="return">
              <ul class="nav">
                <li class="<?= in_array($name, ['order_list']) ? 'active' : '' ?>">
                  <a href="<?= $base_url ?>order_list.php">
                    <span class="sidebar-mini-icon">RO</span>
                    <span class="sidebar-normal">Return Order List</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li class="<?= in_array($name, ['complete_order_list']) ? 'active' : '' ?>">
            <a data-toggle="collapse" href="#complete" <?= in_array($name, ['complete_order_list']) ? 'aria-expanded="true"' : '' ?>>
              <i class="nc-icon nc-book-bookmark"></i>
              <p>
                complete Order<b class="caret"></b>
              </p>
            </a>
            <div class="collapse <?= in_array($name, ['complete_order_list']) ? 'show' : '' ?>" id="complete">
              <ul class="nav">
                <li class="<?= in_array($name, ['complete_order_list']) ? 'active' : '' ?>">
                  <a href="<?= $base_url ?>complete_order_list.php">
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