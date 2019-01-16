<?php include_once('config/config.php');
$POST		= $objTypes->validateUserInput($_REQUEST);
$productid  = intval($POST['id']);
$data       = $objTypes->fetchRow('select * from tbl_products_details where id='.$productid);
$dataimg       = $objTypes->fetchRow('select * from tbl_products_images where product_id='.$productid);
$datacategory = $objTypes->fetchRow('select title,id from tbl_categories where id='.$data['application_id'] );

$datachemistry = $objTypes->fetchRow('select title,id from tbl_categories where id='.$data['category_id'] );
$databrand = $objTypes->fetchRow('select * from tbl_brands where id='.$data['brand_id'] );
$product_list=$objTypes->fetchAll('select a.id,a.title,b.thumbnail from tbl_products_details as a left join tbl_products_images as b on b.product_id=a.id where a.category_id='.$datachemistry['id']." and a.is_active=1 and is_delete=1");
$total_count=count($product_list);


if($datacategory['id']==42) 
{ 
	$title_application = 'paper-pvc-adhesive-tape';
} 
else if($datacategory['id']==41) 
{ 
	$title_application = 'tile-adhesive'; 
	

}  
else if($datacategory['id']==36) { $title_application = 'plumbing-pvc-cpvc-pipe-glue'; }  
else if($datacategory['id']==33) { $title_application = 'anaerobic-adhesive'; }  
else if($datacategory['id']==28) { $title_application = 'furniture-wood-care-glue'; } 
else { $title_application = $objTypes->prepare_url(stripslashes($datacategory['title'])); }
					

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
  <style> 
  #product .packing li p  { max-width:240px;}
  </style>
   <?php include_once('include/googlecode.php'); ?>
  </head>

  <body>
     <?php include_once('include/othercode.php'); ?>
    <div id="wrapper">

     <?php include_once('include/header.php'); ?>
	 
      
      <section id="breadcrumbs">
        <div class="container">
          <a href="<?=base_url?>">Home</a> <a href="javascript:void(0);">Product</a> <a href="<?=base_url?>p/<?=$title_application?>-<?php echo $datacategory['id'];?>"><?php echo stripslashes(ucfirst(strtolower($datacategory['title'])));?></a> <a href="<?=base_url?>c/<?=$objTypes->prepare_url(stripslashes($datacategory['title']))?>/<?=$objTypes->prepare_url(stripslashes($datachemistry['title']))?>-<?php echo $datachemistry['id'];?>"><?php echo stripslashes(ucfirst(strtolower($datachemistry['title'])));?></a> 
		  <?php echo stripslashes(ucfirst(strtolower($data['title'])));?>
        </div>
      </section>

      <section id="product">
        <div class="container">
         <!-- <a href="<?=base_url?>p/<?=$objTypes->prepare_url(stripslashes($datacategory['title']))?>-<?php echo $datacategory['id'];?>" class="backBtn">Back</a>-->
          <a href="<?=base_url?>c/<?=$objTypes->prepare_url(stripslashes($datacategory['title']))?>/<?=$objTypes->prepare_url(stripslashes($datachemistry['title']))?>-<?php echo $datachemistry['id'];?>" class="backBtn">Back</a>
          <div class="sect_title">
            <h2><span><?php echo stripslashes($databrand['title']);?></span></h2>
          </div>

          <div class="productInner">
            <div class="product_graystrip">
              <div class="res_specs_tl"><a href="javascript:;">Sections <img src="<?=base_url?>assets/images/arrow-selection.png" alt=""></a></div>
              <div class="specs_list">
                <?php if($data['application']!="" || $data['advantage']!=""){?>
                <span scrollTo="#overview">Overview</span>
                <?php }?>
                <?php if($data['how_to_use']!="" || $data['restriction_usage']!=""){?>
                <span scrollTo="#usage">Usage</span>
                <?php }?>
                <?php if($data['stroage']!="" || $data['dosage']!="" || $data['shelf_life']!="" || $data['hazards']!="" || $data['packing']!=""){?>
                <span scrollTo="#specifications">Product Specifications</span>
                <?php }?>
                <?php  if($data['handling_precaution']!=""){?>
                <span scrollTo="#precautions">Handling Precautions</span> 
                <?php }?> 
              </div>   
            </div>

            <div class="resi_quick resi_left_space clearfix">
              <div class="resi_shot"><img src="<?=base_url?>uploads/product_images/<?php echo $dataimg['thumbnail'];?>" alt=""></div>
              <div class="resi_det">
                <div class="curr_tl"><?php echo stripslashes($data['title']);?></div>
                <p> <?php echo stripslashes($data['short_description']);?></p>
              </div>
            </div>

            <div class="pd_det_con">

            <div id="overview">
                <?php
                    if($data['application']!=""){
                      ?>
                  <div class="pd_det_blurb resi_left_space">
                    <div class="pd_icon"><img src="<?=base_url?>assets/images/products/icon-application.jpg" alt="Application"></div>

                    <div class="pd_description">
                      <div class="pd_title">Applications</div>
                    <?php echo stripslashes($data['application']);?>
                    </div>
                  </div>
                <?php }?>

                <?php
                if($data['advantage']!=""){
                  ?>
                <div class="pd_det_blurb resi_left_space">
                  <div class="pd_icon"><img src="<?=base_url?>assets/images/products/advantage.png" alt="Application"></div>

                  <div class="pd_description">
                    <div class="pd_title">Advantages</div>
                   <?php echo stripslashes($data['advantage']);?>
                  </div>
                </div>
              <?php }?>
            </div>
               <?php if($data['how_to_use']!="" || $data['restriction_usage']!=""){?>
              <div id="usage">
               
                <div class="pd_det_blurb resi_left_space">

                    <div class="pd_icon"><img src="<?=base_url?>assets/images/products/icon-how-to-use.jpg" alt="How to use"></div>
    
                    <div class="pd_description">
                      <?php
                      if($data['how_to_use']!=""){
                    ?>
                      <div class="pd_title">How to use</div>
                    <?php echo stripslashes($data['how_to_use']);?>
                  <?php }?>
                     
                    
                    </div>

                  </div>
               

               <?php
                      if($data['restriction_usage']!=""){
                    ?>
                <div class="pd_det_blurb resi_left_space">

                    <div class="pd_icon"><img src="<?=base_url?>assets/images/products/icon-how-not-to-use.gif" alt="Usage Restriction"></div>
    
                    <div class="pd_description">
                       
                      
                    
                    
                    <div class="pd_title">Restriction of usage</div>
                    <?php echo stripslashes($data['restriction_usage']);?>
                  
                    </div>

                  </div>
               <?php }?>

              </div>
              
              
              
              
              
               <?php }?>

              <div  id="specifications">
                  <?php
                    if($data['stroage']!=''){
                  ?>
                    <div class="pd_det_blurb resi_left_space">
                      <div class="pd_icon"><img src="<?=base_url?>assets/images/products/icon-storage.jpg" alt="Storage"></div>
      
                      <div class="pd_description">
                        <div class="pd_title">Storage</div>
                        <?php echo stripslashes($data['stroage']);?>
                      </div>
                    </div>
                  <?php }?>
                    <?php if($data['dosage']!=''){?>
                    <div class="pd_det_blurb resi_left_space">
                      <div class="pd_icon"><img src="<?=base_url?>assets/images/products/dosage.png" alt="Shelf Life"></div>
      
                      <div class="pd_description">
                        <div class="pd_title">Dosage</div>
                        <?php echo stripslashes($data['dosage']);?>
                      </div>
                    </div>
                  <?php }?>
                    <?php if($data['shelf_life']!=''){?>
                    <div class="pd_det_blurb resi_left_space">
                      <div class="pd_icon"><img src="<?=base_url?>assets/images/products/icon-shelf-life.jpg" alt="Shelf Life"></div>
      
                      <div class="pd_description">
                        <div class="pd_title">Shelf Life</div>
                        <?php echo stripslashes($data['shelf_life']);?>
                      </div>
                    </div>
                    <?php }?>
                    <?php if($data['hazards']!=''){?>
                    <div class="pd_det_blurb resi_left_space">
                      <div class="pd_icon"><img src="<?=base_url?>assets/images/products/hazardous-decomposition.png" alt="Shelf Life"></div>
      
                      <div class="pd_description">
                        <div class="pd_title">Hazardous</div>
                        <?php echo stripslashes($data['hazards']);?>
                      </div>
                    </div>
                  <?php }?>

                   <div class="pd_det_con packing">
              <div class="pd_title">Packing</div>
             <!--<p> <?php echo stripslashes($data['packing']);?></p>-->
           
              
                <?php 
                      if($data['packing']!=""){
                  ?>
                <?php echo str_replace("assets",base_url."assets",stripslashes($data['packing']));?>
                
              <?php }?>
             

            </div>


              </div>

            </div>

           
            <?php if($data['handling_precaution']!=""){?>
            <div id="precautions" class="pd_det_con">
                <div class="pd_det_blurb resi_left_space">
                  <div class="pd_icon"><img src="<?=base_url?>assets/images/products/icon-precaution.jpg" alt="Application"></div>
  
                  <div class="pd_description">
                    <div class="pd_title">Handling precautions</div>
                    <?php echo stripslashes($data['handling_precaution']);?>
                  </div>
                </div>
            </div>
            <?php
             }
               /* if($data['envelope']!=""){
            ?>
            <div class="pdf_download">
              <a href="<?=base_url?>uploads/products_pdf/<?php echo $data['envelope'];?>"download><img src="<?=base_url?>assets/images/products/pdf-arrow.png" alt="" class="pdf_arrow"></a>
            </div>
          <?php }*/
          if(count($product_list)>1){
          ?>
            <div class="similar_products">
                <div class="sect_title">
                  <h2><span>Similar Products</span></h2>
                </div>
             
                   <div class="sm_prod_slider">
               
				                 
        				<?php 
                
                foreach($product_list as $list_pro){
        					if($list_pro['id']!=$productid) {
        					
        					?>
                         <span class="slide">  <a href="<?=base_url?>v/<?=$objTypes->prepare_url(stripslashes($datacategory['title']))?>/<?=$objTypes->prepare_url(stripslashes($datachemistry['title']))?>/<?=$objTypes->prepare_url(stripslashes($databrand['title']))?>/<?=$objTypes->prepare_url(stripslashes($list_pro['title']))?>-<?php echo $list_pro['id'];?>"><div class="sm_blurb">
                            <h3><?php echo stripslashes($list_pro['title']);?></h3>
                            <img src="<?=base_url?>uploads/product_images/<?php echo $list_pro['thumbnail'];?>" alt="">
                            <div class="commanBtn">Know More</div>
                          </div></a></span>
        					<?php 
        						} 
        					}?>
                 
				                
                </div>
              
            </div>
          <?php }?>

          </div>

        </div>
      </section>
      
      <?php include_once('include/footer.php'); ?>

    </div>

    <!--JS Files-->
    <script type="text/javascript" src="<?=base_url?>js/jquery-1.12.1.min.js"></script>
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
	
    
    <!--[if lt IE 9]>
        <script src="<?=base_url?>js/html5shiv.min.js"></script>
    <![endif]-->
  </body>
</html>