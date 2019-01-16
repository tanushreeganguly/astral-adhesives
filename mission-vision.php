<?php
include_once('config/config.php'); 
$page=$objTypes->fetchRow('select * from tbl_pages where id=6');
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
  </head>

  <body>
    
   <?php include_once('include/othercode.php'); ?>
    <div id="wrapper">
     <?php include_once('include/header.php'); ?>
	 
      <section id="breadcrumbs">
        <div class="container">
          <a href="<?=base_url?>">Home</a> Mission &amp; Vision
        </div>

      </section>
       <section id="about_us">
        <div class="container">
          <div><?php echo str_replace('assets',base_url.'assets',stripslashes($page['description']));?></div>
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
    <script type="text/javascript" src="<?=base_url?>assets/js/about-us.js"></script>
    <!--[if lt IE 9]>
        <script src="<?=base_url?>js/html5shiv.min.js"></script>
    <![endif]-->
  </body>
</html>