<?php 
include_once('config/config.php');

$sqlbrandlist=$objTypes->fetchAll("select a.title,a.thumbnail1,a.id,a.description from tbl_products_details as b left join  tbl_brands as a on b.brand_id=a.id where a.is_active=1 and a.is_delete=1 group by a.id order by a.sortorder asc");

?>
<!doctype html>
<html>

  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
  <title>Astral Adhesives</title>
  <meta name="description" content="" />
  <meta name="keywords" content="" />
  <link href="<?=base_url?>assets/images/favicon.ico" rel="shortcut icon" type="" />
  <link href="<?=base_url?>assets/css/main.css" rel="stylesheet" type="text/css">
  <link href="<?=base_url?>assets/css/owl.carousel.min.css" rel="stylesheet" type="text/css">
   <?php include_once('include/googlecode.php'); ?>
  </head>

  <body>
    <?php include_once('include/othercode.php'); ?>
    <div id="wrapper">
       <?php include_once('include/header.php'); ?>
      <section id="breadcrumbs">
        <div class="container">
          <a href="<?=base_url?>">Home</a> Brands
        </div>
      </section>

      <section id="product">
        <div class="container">

          <div class="sect_title">
            <h2><span>Our Brands</span></h2>
          </div>

          <div class="prod_blurb_con">
            <?php
            if(count($sqlbrandlist)>0){
              foreach($sqlbrandlist as $brandlist){
           
            ?>
            <div class="product_blurb">
              <a href="<?=base_url?>b/<?=$objTypes->prepare_url(stripslashes($brandlist['title']))?>-<?php echo $brandlist['id'];?>">
              <h3><span><?php echo stripslashes($brandlist['title']);?></span></h3>
              <div class="product_list">
                <div class="img_hld">
                    <img src="<?=base_url?>uploads/brand_images/<?php echo $brandlist['thumbnail1'];?>" alt="">
                </div>
               
              </div>
              <div class="explore_product">
                <img src="<?=base_url?>assets/images/icon-plus.png" alt="">
              </div>
            </a>
            </div>
            <?php
              }
            }
            ?>
           </div>
        </div>
      </section>
      <?php include_once('include/footer.php'); ?>

    </div>

    <!--JS Files-->
    <script type="text/javascript" src="<?=base_url?>assets/js/jquery-1.12.1.min.js"></script>
    <script type="text/javascript" src="<?=base_url?>js/footer.js"></script>
    <script type="text/javascript" src="<?=base_url?>assets/js/jquery.easing.1.3.js"></script>
    <script type="text/javascript" src="<?=base_url?>assets/js/modernizr-custom.js"></script>
    <script type="text/javascript" src="<?=base_url?>assets/js/TweenMax.min.js"></script>
    <script type="text/javascript" src="<?=base_url?>assets/js/jquery.slimmenu.min.js"></script>
    <script type="text/javascript" src="<?=base_url?>assets/js/owl.carousel-beta.js"></script>
    <script type="text/javascript" src="<?=base_url?>assets/js/ScrollMagic.js"></script>
    <script type="text/javascript" src="<?=base_url?>assets/js/animation.gsap.js"></script>
    <script type="text/javascript" src="<?=base_url?>assets/js/debug.addIndicators.js"></script> 
    <script type="text/javascript" src="<?=base_url?>assets/js/common.js"></script>
    <script type="text/javascript" src="<?=base_url?>assets/js/product.js"></script>
    <script type="text/javascript" src="<?=base_url?><?=base_url?>assets/js/jquery.ui.datepicker.js"></script>
    <!--[if lt IE 9]>
        <script src="js/html5shiv.min.js"></script>
    <![endif]-->
  </body>
</html>