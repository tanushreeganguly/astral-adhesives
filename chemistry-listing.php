<?php include_once('config/config.php');
$POST		= $objTypes->validateUserInput($_REQUEST);
$catgoryid  = intval($POST['id']);
if($catgoryid > 0){
   
    $data = $objTypes->fetchRow(" SELECT a.id,a.title,b.meta_title,b.meta_description,b.meta_keywords,a.description,a.thumbnail,b.title as chemistry,b.id as chemistry_title,b.parent_category_id,c.id as brand_id,c.title as brand_title from tbl_categories as a inner join tbl_categories as b on b.parent_category_id=a.id left join tbl_products_details as d on b.id=d.category_id left join tbl_brands as c on c.id=d.brand_id where b.id=".$catgoryid." order by b.title asc");

	/* $data_chemistry=$objTypes->fetchAll("SELECT `title`,`thumb_logo_image`,`id`,`description`,`thumb_listing_image`,`parent_category_id` FROM `tbl_brands` WHERE `parent_category_id`=$catgoryid");*/

   /* $brandlisting=$objTypes->fetchAll("select title,id from tbl_brands where parent_category_id=".$catgoryid." and is_active=1 and is_delete=1 and id!=".$data_chemistry[0]['id']);*/
     $brandlisting=$objTypes->fetchAll("select a.title,a.id, a.`thumb_logo_image`,a.`description`,a.`thumb_listing_image` from tbl_brands as a right join tbl_products_details as b on b.brand_id=a.id where b.category_id=".$catgoryid." and a.is_active=1 and a.is_delete=1 group by a.id");

	}
 ?>
<!doctype html>
<html>

  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
   <title><?=strip_tags(stripslashes($data['meta_title']))?></title>
  <meta name="description" content="<?=strip_tags(stripslashes($data['meta_description']))?>" />
  <meta name="keywords" content="<?=strip_tags(stripslashes($data['meta_keywords']))?>" />
  <link href="<?=base_url?>assets/images/favicon.ico" rel="shortcut icon" type="" />
  <link href="<?=base_url?>assets/css/main.css" rel="stylesheet" type="text/css">
  <link href="<?=base_url?>assets/css/owl.carousel.min.css" rel="stylesheet" type="text/css">
  </head>

  <body>

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
            <div class="product_banner product_listing">
              <div class="prod_lt">
                
                <div class="lt_det">
                  <h2><?php echo stripslashes($data['title']);?></h2>
                  <p><?php echo stripslashes($data['description']);?> </p>
                </div>
              </div>
              <div class="prod_rt">
                <img src="<?=base_url?>uploads/category_images/<?php echo $data['thumbnail'];?>" alt="">
              </div>
            </div>
          </div>
         <?php
        
			$sql_chemistry=$objTypes->fetchAll("select id,title from tbl_categories where `parent_category_id`=".$data['parent_category_id']." and is_active=1 and is_delete=1 order by title asc");
         ?>		 

          <div class="prod_tab_hld">
            <div class="category_holder"><h3 class="showonmobile"> Category: </h3>
            <div class="select_category"><span id="cat">Select Category </span><img src="<?=base_url?>assets/images/footer-arrow.png" alt=""></div>
              <ul class="owl-theme">
			  <?php
        $sql_select=$objTypes->fetchRow("select id,title from tbl_categories where id=$catgoryid");?>
            <li><a href="javascript:void(0);" class="activeCategory"><?php echo stripslashes($sql_select['title']);?></a></li>
        <?php
			  if(count($sql_chemistry)>0){
			  foreach($sql_chemistry as $chemistry){
                

				 /* if($chemistry['id']==$catgoryid){
			  ?>
                <li><a href="javascript:void(0);" class="activeCategory"><?php echo stripslashes($chemistry['title']);?></a></li>
				  <?php }*///else{?>
               
                <?php if($chemistry['id']!=$catgoryid){?>
                <li><a href="<?=base_url?>c/<?=$objTypes->prepare_url(stripslashes($data['title']))?>/<?=$objTypes->prepare_url(stripslashes($chemistry['title']))?>-<?=$chemistry['id']?>"><?php echo stripslashes($chemistry['title']);?></a></li>
			  <?php

				   }
				 } 
			  }
			  ?>
              </ul>
            </div>

            <div class="sub_category_hld">
            <h3  class="showonmobile"> Brands: </h3>
            <div class="select_brand"><span id="branddata">Select Brand</span> <img src="<?=base_url?>assets/images/footer-arrow.png" alt=""></div>
              <ul>
                <li><span>Brand Name :</span></li>
               <!-- <li><a href="javascript:void(0);" class="default_data activeProduct" data="<?php echo $data_chemistry[0]['id'];?>" id="<?php echo $data_chemistry[0]['id'];?>" ><?php echo stripslashes($data_chemistry[0]['title']);?></a></li>-->
                <?php
                $i=1;
                    foreach($brandlisting as $brand)
                    {
                      if($i==1){?>
                        <li><a href="javascript:void(0);" class="brand_val activeProduct" data="<?php echo $brand['id'];?>" id="<?php echo $brand['id'];?>"><?php echo stripslashes($brand['title']);?></a></li>
                       <?php }else{
                 ?> 
                <li><a href="javascript:void(0);" class="brand_val" data="<?php echo $brand['id'];?>" id="<?php echo $brand['id'];?>"><?php echo stripslashes($brand['title']);?></a></li>
              <?php }$i++;}?>
              </ul>
            </div>

          </div>

          <div class="prod_blurb_con">
		  <?php
			 $sql_product=$objTypes->fetchAll("select a.id,a.title,a.short_description,b.thumbnail,b.image from tbl_products_details as a left join tbl_products_images as b on a.id=b.product_id where a.brand_id='".$brandlisting[0]['id']."' and category_id='".$catgoryid."' and a.is_active=1 and is_delete=1 order by a.title asc");
		    if(count($sql_product)>0){
			  foreach($sql_product as $product){
		  ?>
		  
		 
         <div class="product_blurb">
			    <a href="<?=base_url?>v/<?=$objTypes->prepare_url(stripslashes($data['title']))?>/<?=$objTypes->prepare_url(stripslashes($data['chemistry']))?>/<?=$objTypes->prepare_url(stripslashes($brandlisting[0]['title']))?>/<?=$objTypes->prepare_url(stripslashes($product['title']))?>-<?php echo $product['id'];?>">
              <h3><span><?php echo stripslashes($product['title']);?></span></h3>
              <div class="product_list">
                <div class="img_hld">
                    <img src="<?=base_url?>uploads/product_images/<?php echo $product['thumbnail'];?>" alt="<?php echo $product['thumbnail'];?>" >
                </div>
                <p><?php echo substr(strip_tags(stripslashes($product['short_description'])),0,100);?>...</p>
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

          <div id="data_varient"></div>

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
	
    <script type="text/javascript">
      
      $(document).ready(function(){
        $("html, body").animate({ scrollTop: 500 },1000);
        $('.owl-carousel').owlCarousel({
          margin:0,
          loop:false,
          autoWidth:true,
          items:4
        });        

       var catdata= $(".activeCategory").html();
       var branddata=$(".activeProduct").html();
       $("#branddata").html(branddata);
       $("#cat").html(catdata);
       });
     $(".brand_val,.default_data").on('click',function(){
       var getUrl = window.location;
//console.log(getUrl);
       var baseUrl = getUrl .protocol + "//" + getUrl.host;
//console.log(baseUrl);
       var brand_id= $(this).attr('data');
       var catgory_id="<?php echo $catgoryid;?>";
       //var brand_id=data_val.split('_');
      
        $.ajax({
              type: "POST",
              data:{'brand_id':brand_id,'category_id':catgory_id},
              url: baseUrl+'/brand_product.php',
              success:function(response){
                 console.log(response);
                 $(".sub_category_hld ul li a").removeClass("activeProduct");
                 $("#"+brand_id).addClass("activeProduct");
                $(".prod_blurb_con").hide();
                $("#data_varient").html(response);

              }
            });

       });

    </script>
    <!--[if lt IE 9]>
        <script src="js/html5shiv.min.js"></script>
    <![endif]-->
  </body>
</html>