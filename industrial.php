<?php 
include_once('config/config.php'); 
$page=$objTypes->fetchRow('select * from tbl_pages where id=9');
?>
<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
  <title><?=strip_tags(stripslashes($page['meta_title']))?></title>
  <meta name="description" content="<?=strip_tags(stripslashes($page['meta_description']))?>" />
  <meta name="keywords" content="<?=strip_tags(stripslashes($page['meta_keywords']))?>" />
  <link href="<?=base_url?>assets/images/favicon.ico" rel="shortcut icon" type="" />
  <link href="<?=base_url?>assets/css/main.css" rel="stylesheet" type="text/css">
  <link href="<?=base_url?>assets/css/owl.carousel.min.css" rel="stylesheet" type="text/css">
  <?php include_once('include/googlecode.php'); ?>
  <!--link href="<?=base_url?>assets/css/direction-reveal.css" rel="stylesheet" type="text/css"-->
</head>

<body class="home">
<?php include_once('include/othercode.php'); ?>
  <div id="wrapper">
   <?php include_once('include/header.php'); ?> 
   
    <section id="breadcrumbs">
      <div class="container">
        <a href="<?=base_url?>">Home</a> Industrial Adhesives
      </div>
    </section>
    <section id="about_us">
      <div class="container">
        <div class="sect_title">
          <h2><span>industrial adhesives</span></h2>
        </div>

        <div class="about_con industrisDet clearfix">
          <div class="abt_why">
            <div class="abtSect_title">
              <span>Industrial Specialty Products</span>
              <div class="subTL">Function meets innovation.</div>
              <div class="shadow"></div>
            </div>

            <div class="banner_why">
              <img imgLoad src="<?=base_url?>uploads/contentpages_images/<?php echo stripslashes($page['banner']);?>" alt="About Astral Adhesives">
              <ul>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
              </ul>
            </div>

            <div><?php echo str_replace("assets",base_url."assets",stripslashes($page['description']));?></div>
              </div>
        </div>

      </div>
    </section>
    <!--
    <section id="top_brands">
      <div class="container">
        <div class="sect_title">
          <h2>Our Businesses</h2>
        </div>

        <ul>
            <?php
            # home page brand
            $order      = 'sortorder asc limit 0,8';
            $where        = array(":is_delete" => '1' , ":is_active" => '1');
            $homebrandArr   = $objTypes->select("tbl_brands", "*", "is_delete = :is_delete and is_active = :is_active ", $where, $order);
            if(isset($homebrandArr) && sizeof($homebrandArr) > 0){
              foreach ($homebrandArr as $brand_value){
            ?>
            <li class="direction-reveal direction-reveal--3-grid-flexbox direction-reveal--demo-swing">
              <div class="direction-reveal__card">
                <div class="front_face">
                  <img src="<?=base_url?>uploads/brand_images/<?php echo $brand_value['thumbnail'];?>">
                  <div class="overlay"></div>
                  <div class="brand_name"><?php echo stripslashes($brand_value['title']);?></div>
                </div>
                <div class="direction-reveal__overlay direction-reveal__anim--in">
                  <img src="<?=base_url?>uploads/brand_images/<?php echo $brand_value['thumbnail1'];?>">
                  <a href="<?=base_url?>b/<?=$objTypes->prepare_url(stripslashes($brand_value['title']));?>-<?=$brand_value['id']?>" class="commanBtn">Know More</a>
                </div>
              </div>
            </li>
          <?php }
            }
          ?>

        </ul>

        <a href="<?=base_url?>brands" class="commanBtn">View all brands</a>

      </div>
    </section>-->

    <?php include_once('include/footer.php'); ?>

  </div>

  <!--JS Files-->
  <script type="text/javascript" src="<?=base_url?>assets/js/jquery-1.12.1.min.js"></script>
  <script type="text/javascript" src="<?=base_url?>js/footer.js"></script>
  <script type="text/javascript" src="<?=base_url?>assets/js/jquery.easing.1.3.js"></script>
  <script type="text/javascript" src="<?=base_url?>assets/js/modernizr-custom.js"></script>
  <script type="text/javascript" src="<?=base_url?>assets/js/waypoints.js"></script>
  <script type="text/javascript" src="<?=base_url?>assets/js/TweenMax.min.js"></script>
  <script type="text/javascript" src="<?=base_url?>assets/js/jquery.slimmenu.min.js"></script>
  <script type="text/javascript" src="<?=base_url?>assets/js/owl.carousel-beta.js"></script>
  <script type="text/javascript" src="<?=base_url?>assets/js/ScrollMagic.js"></script>
  <script type="text/javascript" src="<?=base_url?>assets/js/animation.gsap.js"></script>
  <script type="text/javascript" src="<?=base_url?>assets/js/debug.addIndicators.js"></script> 
  <script type="text/javascript" src="<?=base_url?>assets/js/common.js"></script>
  <script type="text/javascript" src="<?=base_url?>assets/js/industrial.js"></script>
  <!--script type="text/javascript" src="<?=base_url?>assets/js/bundle.js"></script-->
  <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
  <![endif]-->
</body>

</html>