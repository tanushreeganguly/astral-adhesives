<?php 
include_once('config/config.php');
$POST		= $objTypes->validateUserInput($_REQUEST);
$catgoryid  = intval($POST['id']);
if($catgoryid > 0){
    $sql        = "SELECT id, title,parent_category_id, thumbnail, meta_description, meta_keywords, meta_title, description, short_description,parent_category_id FROM tbl_categories WHERE id = :id";
    $bind       = array(':id' => $catgoryid);
    $data       = $objTypes->fetchRow($sql, $bind);
	
	$data_chemistry=$objTypes->fetchAll("SELECT b.title,b.id as chemistry_title,b.description,b.parent_category_id,c.id,c.title as brand_title from tbl_categories as a inner join tbl_categories as b on b.parent_category_id=a.id left join tbl_brands as c on c.parent_category_id=b.id  where a.id=".$data['id']." and is_active=1 and is_delete=1 order by b.title asc");
echo "select title from tbl_brands where parent_category_id=".$data_chemistry[0][chemistry_title]." and is_active=1 and is_delete=1";
exit;
  $brandlisting=$objTypes->fetchAll("select title from tbl_brands where parent_category_id=".$data_chemistry[0][chemistry_title]." and is_active=1 and is_delete=1 and id!=".$data_chemistry[0]['id']);
	}
 ?>
<!doctype html>
<html>

  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
  <title>Astral Adhesives</title>
  <!--link href="<?=base_url?>assets/images/favicon.ico" rel="shortcut icon" type="" /-->
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
          <a href="<?=base_url?>">Home</a> <a href="javascript:void(0);">Product</a> <?php echo stripslashes($data['title'])?>
        </div>
      </section>

      <section id="product">
        <div class="container">

          <div class="sect_title">
            <h2><span><?php echo stripslashes($data['title'])?></span></h2>
          </div>

          <div class="bannerHolder">
            <div class="product_banner">
              <div class="prod_lt">
                
                <div class="lt_det">
                  <h2><?php echo stripslashes($data['title']);?></h2>
                  <p><?php echo stripslashes(strip_tags($data['description']));?> </p>
                </div>
              </div>
              <div class="prod_rt">
                <img src="<?=base_url?>uploads/category_images/<?php echo $data['thumbnail'];?>" alt="">
              </div>
            </div>
          </div>
         <?php
			$sql_chemistry=$objTypes->fetchAll("select id,title from tbl_categories where `parent_category_id`=$catgoryid and is_active=1 and is_delete=1 order by title asc");
         ?>		 

          <div class="prod_tab_hld">
            <div class="category_holder">
              <ul>
			  <?php
			  if(count($sql_chemistry)>0){
			  foreach($sql_chemistry as $chemistry){
				  if($chemistry['id']==$data_chemistry[0]['chemistry_title']){
			  ?>
                <li><a href="javascript:void(0);" class="activeCategory"><?php echo stripslashes($chemistry['title']);?></a></li>
				  <?php }else{?>
                <li><a href="<?=base_url?>c/<?=$objTypes->prepare_url(stripslashes($data['title']))?>/<?=$objTypes->prepare_url(stripslashes($chemistry['title']))?>-<?=$chemistry['id']?>"><?php echo stripslashes($chemistry['title']);?></a></li>
			  <?php
				  }
				} 
			  }
			  ?>
              </ul>
            </div>

            <div class="sub_category_hld">
              <ul>
                <li><span>Brand Name :</span></li>
                <li><a href="javascript:void(0);" class="activeProduct"><?php echo stripslashes($data_chemistry[0]['brand_title']);?></a></li>
                 <?php
                    foreach($brandlisting as $brand)
                    {
                 ?> 
                <li><a href=""><?php echo stripslashes($brand['title']);?></a></li>
              <?php }?>
              </ul>
            </div>

          </div>

          <div class="prod_blurb_con">
		  <?php
			$sql_product=$objTypes->fetchAll("select a.title,a.id,a.short_description,b.thumbnail,b.image from tbl_products_details as a left join tbl_products_images as b on a.id=b.product_id where a.brand_id='".$data_chemistry[0]['id']."' and a.is_active=1 and is_delete=1 order by a.title asc");
		    if(count($sql_product)>0){
			  foreach($sql_product as $product){
		  ?>
		  
		  
            <div class="product_blurb">
			<a href="<?=base_url?>v/<?=$objTypes->prepare_url(stripslashes($data['title']))?>/<?=$objTypes->prepare_url(stripslashes($data_chemistry[0]['title']))?>/<?=$objTypes->prepare_url(stripslashes($product['title']))?>-<?php echo $product['id'];?>">
              <h3><span><?php echo stripslashes($product['title']);?></span></h3>
              <div class="product_list">
                <div class="img_hld">
                    <img src="<?=base_url?>uploads/product_images/<?php echo $product['thumbnail'];?>" alt="<?php echo $product['thumbnail'];?>" >
                </div>
                <p><?php echo substr(strip_tags(stripslashes($product['short_description'])),0,200);?> </p>
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
	  <script type="text/javascript" src="<?=base_url?>assets/js/jquery.ui.datepicker.js"></script>
    
    <!--[if lt IE 9]>
        <script src="js/html5shiv.min.js"></script>
    <![endif]-->
  </body>
</html>