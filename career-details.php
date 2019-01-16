<?php
include_once('config/config.php'); 
$page=$objTypes->fetchRow('select * from tbl_pages where id=7');
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
          <a href="<?=base_url?>">Home</a> Careers
        </div>
      </section>
     
        <section id="about_us">
        <div class="container">
          <div><?php echo str_replace('assets',base_url.'assets',stripslashes($page['description']));?></div>
          <a href="<?=base_url?>career" class="commanBtn">Current Job Openings</a>
        </div>
      </section>

      <section id="work_with_us">
        <div class="container">
          <div class="sect_title">
            <h2><span>Work With Us</span></h2>
          </div>
          <div class="ww_blurbCon">
            <ul>
              <li>
                <div class="icon_hld">
                  <img src="<?=base_url?>assets/images/icon-ww-01.jpg" alt="">
                </div>
                <div class="ww_tl">Market Leader</div>
                <p>Providing Excellence by adhering to world class quality standards</p>
              </li>
              <li>
                <div class="icon_hld">
                  <img src="<?=base_url?>assets/images/icon-ww-02.jpg" alt="">
                </div>
                <div class="ww_tl">Best Technology</div>
                <p>Driving innovation by employing best-in-globe technology</p>
              </li>
              <li>
                <div class="icon_hld">
                  <img src="<?=base_url?>assets/images/icon-ww-03.jpg" alt="">
                </div>
                <div class="ww_tl">Career Growth</div>
                <p>Equal opportunity to everyone and transparent work culture driven</p>
              </li>
            </ul>
          </div>
        </div>
      </section>

      <section id="subsidiaries">
        <div class="container">
          <div class="sect_title">
            <h2>Group Companies</h2>
          </div>
          <ul>
            <li>
              <a href="http://rexpoly.co.in/" target="_blank">
                <img src="assets/images/rex.png" alt="REX">
              </a>
            </li>
            <li>
              <a href="https://www.astralpipes.com/" target="_blank">
                <img src="assets/images/sub-astralpipes-ind.png" alt="Astral Pipes India">
              </a>
            </li>
            <li>
              <a href="https://astralcpvc.co.ke/" target="_blank">
                <img src="assets/images/sub-astralpipes-kenya.png" alt="Astralpipes Kenya">
              </a>
            </li>
            <li>
              <a href="http://bond-it.co.uk/" target="_blank">
                <img src="assets/images/sub-bond-it.png" alt="Bond Tt">
              </a>
            </li>
          </ul>
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