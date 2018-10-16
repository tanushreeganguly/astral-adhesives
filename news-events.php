<?php
include_once('config/config.php');
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
  <?php include_once('include/googlecode.php'); ?>
  </head>

  <body>
    <?php include_once('include/othercode.php'); ?>
    <div id="wrapper">
	  <?php include_once('include/header.php'); ?>
      <section id="breadcrumbs">
        <div class="container">
          <a href="<?=base_url?>">Home</a> Upcoming Events
        </div>
      </section>

      <section>
        <div class="container">
          <div class="sect_title inner_title">
            <h2><span>Upcoming Events</span></h2>
          </div>
          <?php
		  $order			= 'release_date ASC';
		  $where      	= array(":is_delete" => '1' , ":is_active" => '1');
		$pressadhesiveArr 	= $objTypes->select("tbl_event", "*", "is_delete = :is_delete and is_active = :is_active ", $where,$order);
		
		if(isset($pressadhesiveArr) && sizeof($pressadhesiveArr) > 0){
			foreach($pressadhesiveArr as $adhesive_value){
		  ?>
          <div class="pr_holder">
            <div class="date"><?php echo date('j F Y',strtotime($adhesive_value['release_date']));?></div>
            <?php if($adhesive_value['thumbnail']!=''){?>
            <div class="pr_lt"><img src="<?=base_url?>uploads/event_images/<?php echo stripslashes($adhesive_value['thumbnail']);?>" alt=""></div>
            <div class="pr_rt"><?php }?>
			<h3><?php echo stripslashes($adhesive_value['title']);?></h3>
			<p><?php echo stripslashes($adhesive_value['short_description']);?></p>
              <?php if($adhesive_value['thumbnail']!=''){?></div><?php }?>
            <?php if($adhesive_value['link']!=''){?> 
              <a href="<?php echo stripslashes($adhesive_value['link']);?>" class="commanBtn" target="_blank">Read More</a>
            <?php }?>
          </div>

         <?php } }?>

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
	
    
    <!--[if lt IE 9]>
        <script src="<?=base_url?>js/html5shiv.min.js"></script>
    <![endif]-->
  </body>
</html>