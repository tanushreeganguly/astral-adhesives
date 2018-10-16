<?php 
include_once('config/config.php');
$POST   = $objTypes->validateUserInput($_REQUEST);
/*$sql_product=$objTypes->fetchAll('select a.title,a.id from tbl_categories as a left join tbl_products_details as b on a.id=b.application_id where b.is_active=1 and b.is_delete=1 group by a.id');*/
$sql_newsletter=$objTypes->fetchAll('select title,envelope,type_download from tbl_newsletter where is_active=1 and is_delete=1 and envelope!=""');
?>
<!doctype html>
<html>

  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
   <title>Download Pdf, Products Details - Astral Adhesives</title>
  <meta name="description" content="Find the product details of Astral Adhesives right here. Download the PDF to know more." />
  <meta name="keywords" content="Download Pdf, Products Details" />
  <link href="<?=base_url?>assets/images/favicon.ico" rel="shortcut icon" type="" />
  <link href="<?=base_url?>assets/css/magnific-popup.css" rel="stylesheet" type="text/css">
  <link href="<?=base_url?>assets/css/main.css" rel="stylesheet" type="text/css">
   <?php include_once('include/googlecode.php'); ?>
  </head>

  <body>
     <?php include_once('include/othercode.php'); ?>
    <div id="wrapper">
      <?php include_once('include/header.php'); ?>
     
      <section id="breadcrumbs">
        <div class="container">
          <a href="<?=base_url?>">Home</a> Download
        </div>
      </section>

      <section id="gallery">
        <div class="container">
          <div class="sect_title">
            <h2><span>Download</span></h2>
          </div>

          <div class="productInner minHT">

            <div class="product_graystrip">
              <div class="res_specs_tl"><a href="javascript:;">Sections <img src="<?=base_url?>assets/images/arrow-selection.png" alt=""></a></div>
              <div class="specs_list">
                <span attr="brochoure" class="activeTab">Product Brochures</span>
                <span attr="newsletter">Newsletters</span>   
              </div>   
            </div>

           <div id="dwn_brochoure" class="dwn_hld">
            <?php  if(count($sql_newsletter)>0){
                    foreach($sql_newsletter as $newsletter){
                      if($newsletter['type_download']=="Brochures"){
              ?>
             <div class="dwn_cat"><a href="<?=base_url?>uploads/newsletter_pdf/<?php echo $newsletter['envelope'];?>" download><?php echo stripslashes($newsletter['title']);?></a></div>
             <?php  }
                 
                 } 
            }?>
             
           </div>

           <div id="dwn_newsletter" class="dwn_hld">
              <?php  if(count($sql_newsletter)>0){
                    foreach($sql_newsletter as $newsletter){
                       if($newsletter['type_download']=="Newsletter"){
              ?>
              <div class="dwn_cat"><a href="<?=base_url?>uploads/newsletter_pdf/<?php echo $newsletter['envelope'];?>" download><?php echo stripslashes($newsletter['title']);?></a></div>
             <?php } }}?>
            </div>

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
    <script type="text/javascript" src="<?=base_url?>assets/js/jquery.magnific-popup.js"></script> 
    <script type="text/javascript" src="<?=base_url?>assets/js/common.js"></script>
    <script type="text/javascript" src="<?=base_url?>assets/js/download.js"></script>
    <script type="text/javascript">
      $(".titlelink").on('click',function(){

        $(this).addClass('openLinks');

      });

    </script>
    <!--[if lt IE 9]>
        <script src="js/html5shiv.min.js"></script>
    <![endif]-->
  </body>
</html>