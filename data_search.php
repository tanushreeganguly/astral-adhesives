<?php include_once('config/config.php');
$POST   = $objTypes->validateUserInput($_REQUEST);
 ?>
<!doctype html>
<html>

  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
  <title>Astral Adhesives</title>
  <link href="<?=base_url?>assets/images/favicon.ico" rel="shortcut icon" type="" />
  <link href="<?=base_url?>assets/css/main.css" rel="stylesheet" type="text/css">
  <link href="<?=base_url?>assets/css/owl.carousel.min.css" rel="stylesheet" type="text/css">
  <link href="<?=base_url?>assets/css/direction-reveal.css" rel="stylesheet" type="text/css">
  </head>

  <body>

    <div id="wrapper">

     <?php include_once('include/header.php'); ?>
	  <section id="application">
        <div class="container searchData">
          <div class="sect_title">
            <h2><span>Search for '<?php echo stripslashes($POST['search_data']);?>'</span></h2>
            
          </div>
<?php
if($POST['search_data']!=""){
	$sql="select * from tbl_search where content like '%".$POST['search_data']."%' 
	or url like '%".$POST['search_data']."%' or title like '%".$POST['search_data']."%' or description like '%".$POST['search_data']."%'";
	$data = $objTypes->fetchAll($sql);

 if(count($data)>0){
		foreach($data as $value)
		{
		?>	
      <div class="search_data">
      <h3>
        <a href="<?=base_url.$value['url']?>" target="_blank"><?php echo stripslashes($value['title']);?></a>
      </h3> 
			<p><?php echo substr(stripslashes(strip_tags($value['content'])),0,100);?>...<a href="<?=base_url.$value['url']?>" target="_blank">Read More</a></p> </div> 
		<?php
		}
  }else{?>
    <div>No records found.</div>
  <?php
  }
}else{?>

    <div>No records found.</div>
  <?php
  }
  ?>
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
	<script type="text/javascript" src="<?=base_url?>assets/js/jquery.ui.datepicker.js"></script>
    <!--[if lt IE 9]>
        <script src="js/html5shiv.min.js"></script>
    <![endif]-->
  </body>
</html>