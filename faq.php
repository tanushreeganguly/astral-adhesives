<?php
include_once('config/config.php');

?>
<!doctype html>
<html>

  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
  <title>Frequently Asked Questions - Astral Adhesives</title>
  <meta name="description" content="Get all your queries about Astral Adhesives answered right here in the frequently asked questions section!" />
  <meta name="keywords" content="Frequently Asked Questions" />
  <link href="<?=base_url?>assets/images/favicon.ico" rel="shortcut icon" type="" />
  <link href="<?=base_url?>assets/css/main.css" rel="stylesheet" type="text/css">
  <?php include_once('include/googlecode.php'); ?>
  </head>

  <body>
    <?php include_once('include/othercode.php'); ?>
    <div id="wrapper">
        <?php include_once('include/header.php'); ?>
      <section id="breadcrumbs">
        <div class="container">
          <a href="<?=base_url?>">Home</a> FAQs
        </div>
      </section>

      <section id="siteInner">
        <div class="container">
          <div class="sect_title inner_title">
            <h2><span>FAQs</span></h2>
          </div>

          <div class="faqCon">
		  <?php
			  $order			= 'id DESC';
			  $where      	= array(":is_delete" => '1' , ":is_active" => '1');
			  $faqadhesiveArr 	= $objTypes->select("tbl_faq", "*", "is_delete = :is_delete and is_active = :is_active ", $where,$order);
			
			if(isset($faqadhesiveArr) && sizeof($faqadhesiveArr) > 0){
			foreach($faqadhesiveArr as $adhesive_value){
		  ?>
            <div class="mypets"><?php echo stripslashes($adhesive_value['title']);?></div>
            <div class="thepet"><?php echo stripslashes(strip_tags($adhesive_value['description']));?></div>
			<?php }}?>
            
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
    <script type="text/javascript" src="<?=base_url?>assets/js/common.js"></script>
    <script type="text/javascript" src="<?=base_url?>assets/js/ddaccordion.js"></script>

    <script type="text/javascript">
      //Initialize first demo:
      ddaccordion.init({
        headerclass: "mypets", //Shared CSS class name of headers group
        contentclass: "thepet", //Shared CSS class name of contents group
        collapseprev: true, //Collapse previous content (so only one open at any time)? true/false
        defaultexpanded: [0], //index of content(s) open by default [index1, index2, etc]
        animatedefault: false, //Should contents open by default be animated into view?
        persiststate: false, //persist state of opened contents within browser session?
        toggleclass: ["", "openpet"], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
        togglehtml: ["none", "", ""], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
        animatespeed: "fast" //speed of animation: "fast", "normal", or "slow"
      })
    </script>
    <!--[if lt IE 9]>
        <script src="js/html5shiv.min.js"></script>
    <![endif]-->
  </body>
</html>