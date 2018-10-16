<?php 
include_once('config/config.php'); 
$page=$objTypes->fetchRow('select * from tbl_pages where id=8');
$data=$objTypes->fetchall('select year,content from tbl_milestone where is_active=1 and is_delete=1 order by year desc');
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
  <?php include_once('include/googlecode.php'); ?>
</head>

<body>
  <?php include_once('include/othercode.php'); ?>
  <div id="wrapper">
    <?php include_once('include/header.php'); ?>
    <section id="breadcrumbs">
      <div class="container">
        <a href="<?=base_url?>">Home</a> Milestones
      </div>
    </section>

    <section id="siteInner">
      <div class="container">
        <div class="sect_title inner_title">
          <h2>
            <span>Milestones</span>
          </h2>
        </div>

        <div class="ms_description"><?php echo str_replace("assets",base_url."assets",stripslashes($page['description']));?>
        </div>

        <div class="ms_strip_con clearfix">
          <?php 
          $i=1;
          foreach($data as $milestone){
              
            ?>
          <div class="msparent">
            <?php if($i%2!=0){?>
            <div class="stripIndicator_01 path_ind"></div>
          <?php }else{?>
            <div class="stripIndicator_02 path_ind"></div>
          <?php }?>
            <div class="ms-container">
                <span class="ms-year">
                    <span class="year"><?php echo $milestone['year'];?></span>
                  </span>
              <span class="ms-detail"><?php echo stripslashes(strip_tags($milestone['content']));?></span>
              
            </div>
          </div>
        <?php  $i++;}?>
          

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
  <script type="text/javascript" src="<?=base_url?>assets/js/kute.min.js"></script>
  <script type="text/javascript" src="<?=base_url?>assets/js/kute-svg.min.js"></script>
  <script type="text/javascript" src="<?=base_url?>assets/js/common.js"></script>
  <script type="text/javascript" src="<?=base_url?>assets/js/milestones.js"></script>
  <!--[if lt IE 9]>
        <script src="<?=base_url?>js/html5shiv.min.js"></script>
    <![endif]-->
</body>

</html>