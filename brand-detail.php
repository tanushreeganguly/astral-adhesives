<?php 
include_once('config/config.php');
$POST   = $objTypes->validateUserInput($_REQUEST);
$brandid  = intval($POST['id']);

$brandlist=$objTypes->fetchRow("select title,description,meta_keywords,meta_title,meta_description,thumb_listing_image,thumb_logo_image from tbl_brands where id=".$brandid);

$varientlist=$objTypes->fetchAll("select a.title,a.id,a.short_description,b.thumbnail from tbl_products_details as a left join tbl_products_images as b on a.id=b.product_id where a.brand_id=$brandid and a.is_delete=1 and a.is_active=1 order by a.title asc");

$product=$objTypes->fetchRow("select a.title as category_title,b.title as subcategory_title,c.title as brand_title,c.id from tbl_categories as a inner join tbl_categories as b on b.parent_category_id=a.id left join tbl_products_details as d on b.id=d.category_id left join tbl_brands as c on c.id=d.brand_id where c.id=".$brandid);

?>
<!doctype html>
<html>

  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
  <title><?=strip_tags(stripslashes($brand['meta_title']))?></title>
  <meta name="description" content="<?=strip_tags(stripslashes($brand['meta_description']))?>" />
  <meta name="keywords" content="<?=strip_tags(stripslashes($brand['meta_keywords']))?>" />
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
          <a href=""<?=base_url?>">Home</a><a href="<?=base_url?>brands">Brands</a> <?php echo stripslashes($brandlist['title']);?>
        </div>
      </section>

      <section id="product">
        <div class="container">

          <div class="sect_title">
            <h2><span> <?php echo stripslashes($brandlist['title']);?></span></h2>
          </div>

         <!-- <div class="bannerHolder">
            <div class="product_banner">
              <div class="prod_lt">
                <div class="lt_icon"><img src="<?=base_url?>uploads/brand_images/logo/<?php echo $brandlist['thumb_logo_image'];?>" alt=""></div>
                <div class="lt_det">
                  <h2><?php echo stripslashes($brandlist['title']);?></h2>
                  <p><?php echo strip_tags(stripslashes($brandlist['description']));?></p>
                </div>
              </div>
              <div class="prod_rt">
                <img src="<?=base_url?>uploads/brand_images/listing_image/<?php echo $brandlist['thumb_listing_image'];?>" alt="">
              </div>
            </div>
          </div>-->

          <div class="prod_blurb_con">

            <?php
              foreach($varientlist as $productlist){
            ?>
            <div class="product_blurb">
              <a href="<?=base_url?>v/<?=$objTypes->prepare_url(stripslashes($product['category_title']))?>/<?=$objTypes->prepare_url(stripslashes($product['subcategory_title']))?>/<?=$objTypes->prepare_url(stripslashes($product['brand_title']))?>/<?=$objTypes->prepare_url(stripslashes($productlist['title']))?>-<?php echo $productlist['id'];?>">
              <h3><span><?php echo strtoupper(stripslashes($productlist['title']));?></span></h3>
              <div class="product_list">
                <div class="img_hld">
                    <img src="<?=base_url?>uploads/product_images/<?php echo $productlist['thumbnail'];?>" alt="">
                </div>
                <p><?php echo substr(strip_tags(stripslashes($productlist['short_description'])),0,100);?>..</p>
              </div>
              <div class="explore_product">
                <img src="<?=base_url?>assets/images/icon-plus.png" alt="">
              </div>
            </a>
            </div>
          <?php }?>
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
    <script type="text/javascript" src="<?=base_url?>assets/js/jquery.ui.datepicker.js"></script>
    
    <!--[if lt IE 9]>
        <script src="js/html5shiv.min.js"></script>
    <![endif]-->
  </body>
</html>