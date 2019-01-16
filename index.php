<?php
//echo "test"; exit();
include_once('config/config.php');

?>
<!doctype html>
<!--<html oncontextmenu="return false;">-->
<html>
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
  <title>Astral Adhesives</title>
  <meta name="description" content="" />
 <meta name="keywords" content="" />
 <link href="<?=base_url?>assets/images/favicon.ico" rel="shortcut icon" type="" />
  <link href="<?=base_url?>assets/css/main.css" rel="stylesheet" type="text/css">
  <link href="<?=base_url?>assets/css/owl.carousel.min.css" rel="stylesheet" type="text/css">
  <link href="<?=base_url?>assets/css/jquery-ui.css" rel="stylesheet" type="text/css">
  <?php include_once('include/googlecode.php'); ?>
  </head>
  <!--<body oncontextmenu="return false" onkeydown="return false;" onmousedown="return false;">-->
	<body>
    <?php include_once('include/othercode.php'); ?>
    <div id="wrapper">
	<?php include_once('include/header.php'); ?>
      <!--Slider Start-->
      <section id="slider_holder">
      <div class="bannerHld">
        <?php
        # home page banner
        $order			= 'id DESC';
        $where      	= array(":is_delete" => '1' , ":is_active" => '1');
        $homeBannerArr 	= $objTypes->select("tbl_homebanner", "*", "is_delete = :is_delete and is_active = :is_active ", $where, $order);
        if(isset($homeBannerArr) && sizeof($homeBannerArr) > 0){
          foreach ($homeBannerArr as $banner_value){
        ?>
            <div class="item">
              <picture>
              <source media="(max-width: 480px)" srcset="<?=base_url?>uploads/homebanner_images/small/<?php echo $banner_value['image2'];?>">
              <source media="(max-width: 1023px)" srcset="<?=base_url?>uploads/homebanner_images/medium/<?php echo $banner_value['image1'];?>">
              <img src="<?=base_url?>uploads/homebanner_images/large/<?php echo $banner_value['image'];?>" alt="<?php echo $banner_value['title1']?> <?php echo $banner_value['title2']?>">
              </picture>
              <?php if($banner_value['title1'] !='' || $banner_value['title2']!=' '){?>
              <div class="bannerDet">
                <?php if($banner_value['title1']!=''){?>
              <div class="text_slide">
                <div class="overlay"></div>
                <span><?php echo stripslashes($banner_value['title1']);?>,</span>
              </div>
            <?php }?>
              <?php if($banner_value['title2']!=''){?>
              <div class="text_slide">
                <div class="overlay"></div>
                <span><b><?php echo stripslashes($banner_value['title2']);?></b></span>
              </div>
            <?php }?>
              <?php if($banner_value['externalurl']!='') {?>
              	<a href="<?php echo $banner_value['externalurl'];?>" class="knowMoreBtn">Know More</a>
              <?php }?>
              </div>
            <?php }?>
            </div> 
        <?php
              }
            }
        ?>
      </div>
      <div class="mouse_icon">
        <img src="assets/images/mouse-icon.png" alt="">
      </div>
      </section>
      <!--Slider End-->
      <section id="application">
        <div class="container">
          <div class="sect_title">
            <h2><span>Application</span></h2>
            <div class="tl_bg">Application</div>
          </div>
        </div>
        <svg class="sampleSVG" xmlns="http://www.w3.org/2000/svg" version="1.1">
          <defs>
            <filter id="elasticSVG">
              <feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur" />
              <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 18 -7" result="goo" />
              <feBlend in="SourceGraphic" in2="goo" />
            </filter>
          </defs>
        </svg>
        <div class="tilesCon">
        <!--  Maintenance  -->
        <div class="tiles" id="maintenance">
            <div class="cube">
              <div class="tile_front_face">
                <div class="front_tile_det">
                  <div class="icon_con">
                    <img src="assets/images/tile-maintenance.png" alt="">
                  </div>
                  <div class="desc_con">Maintenance</div>
                </div>
              </div>
              <div class="tile_back_face tile_01_backface" data-background="url(assets/images/application-hover/bg-maintenance.jpg) no-repeat right top -1px">
                <div class="exploe_con">
                  <div class="mobile_pan">
                    <div class="mobIcon"><img src="assets/images/application-mob/tile-maintenance.png" alt=""></div>
                    <p>Adhesives for all maintenance
                    <br/> related needs </p>
                  </div>
                  <a href="<?=base_url?>p/anaerobic-adhesive-33" class="commanBtn">Explore more</a>
                </div>
              </div>
            </div>
        </div>
        <!--   F u r n i t u r e   W o o d c a r e   -->
        <div class="tiles" id="furnitureWoodcare">
          <div class="cube">
            <div class="tile_front_face">
              <div class="front_tile_det">
                <div class="icon_con">
                  <img src="assets/images/tile-furniture.png" alt="">
                </div>
                <div class="desc_con">Woodcare </div>
              </div>
            </div>
            <div class="tile_back_face tile_02_backface" data-background="url(assets/images/application-hover/bg-furniture-woodcare.jpg) no-repeat left top -1px"
              data-background-size="auto 100%">
              <div class="exploe_con">
                <div class="mobile_pan">
                  <div class="mobIcon"><img src="assets/images/application-mob/tile-furniture.png" alt=""></div>
                  <p>Keep wood pest-free</p>
                </div>
                <a href="<?=base_url?>p/furniture-wood-care-glue-28" class="commanBtn">Explore more</a>
              </div>
            </div>
          </div>
        </div>
        <!-- W a t e r P r o f i n g -->
        <div class="tiles" id="waterProfing">
            <div class="cube">
              <div class="tile_front_face">
                <div class="front_tile_det">
                  <div class="icon_con">
                    <img src="assets/images/tile-water-proofing.png" alt="" />
                  </div>
                  <div class="desc_con">Water Proofing</div>
                </div>
              </div>
              <div class="tile_back_face tile_01_backface" data-background="url(assets/images/application-hover/bg-water-profing.jpg) no-repeat center top -1px"
                data-background-size="contain">
                <div class="exploe_con">
                  <div class="mobile_pan">
                    <div class="mobIcon"><img src="assets/images/application-mob/tile-water-proofing.png" alt="" /></div>
                    <p>Protect homes from leakage, 
                    <br/>seepage, dampness and cracks</p>
                  </div>
                  <a href="<?=base_url?>p/water-proofing-26" class="commanBtn">Explore more</a>
                </div>
              </div>
            </div>
        </div>
        <!--M a r b l e   G r a n i t e  -->
        <div class="tiles" id="marbleGranite">
            <div class="cube">
              <div class="tile_front_face">
                <div class="front_tile_det">
                  <div class="icon_con">
                    <img src="assets/images/tile-marble.png" alt="">
                  </div>
                  <div class="desc_con">Stone Care</div>
                </div>
              </div>
              <div class="tile_back_face tile_02_backface" data-background="url(assets/images/application-hover/bg-marble-granite.jpg) no-repeat left top -1px"
                data-background-size="auto 100%">
                <div class="exploe_con">
                  <div class="mobile_pan">
                    <div class="mobIcon"><img src="assets/images/application-mob/tile-marble.png" alt=""></div>
                    <p>Keep marble and granite 
                  <br/>as good as new</p>
                  </div>
                  <a href="<?=base_url?>p/stone-care-27" class="commanBtn">Explore more</a>
                </div>
              </div>
            </div>
        </div>
        <!--  C o n s t r u c t i o n   C h e m i c a l s-->
        <div class="tiles" id=constructionChemicals>
            <div class="cube">
              <div class="tile_front_face">
                <div class="front_tile_det">
                  <div class="icon_con">
                    <img src="assets/images/tile-construction.png" alt="">
                  </div>
                  <div class="desc_con">Construction chemicals
                    <br /> &amp; Admixture</div>
                </div>
              </div>
              <div class="tile_back_face tile_01_backface" data-background="url(assets/images/application-hover/bg-construction-chemicals.jpg) no-repeat right top -1px"
                data-background-size="auto 100%">
                <div class="exploe_con">
                  <div class="mobile_pan">
                    <div class="mobIcon"><img src="assets/images/application-mob/tile-construction.png" alt=""></div>
                    <p>Add life to constructions</p>
                  </div>
                  <a href="<?=base_url?>p/construction-chemical-39" class="commanBtn">Explore more</a>
                </div>
              </div>
            </div>
          </div>
        <!-- T i l e M o r t a r -->
        <div class="tiles" id="tileMortar">
          <div class="cube">
            <div class="tile_front_face">
              <div class="front_tile_det">
                <div class="icon_con">
                  <img src="assets/images/tile-mortars.png" alt="">
                </div>
                <div class="desc_con">Tile Adhesives, Grouts
                  <br/>and Repair Mortars</div>
              </div>
            </div>
            <div class="tile_back_face tile_02_backface" data-background="url(assets/images/application-hover/bg-tile-mortar.jpg) no-repeat left top -1px"
              data-background-size="auto 100%">
              <div class="exploe_con">
                <div class="mobile_pan">
                  <div class="mobIcon"><img src="assets/images/application-mob/tile-mortars.png" alt=""></div>
                  <p>Fix tiles with products<br /> that match your need </p>
                </div>
                <a href="<?=base_url?>p/tile-adhesive-41" class="commanBtn">Explore more</a>
              </div>
            </div>
          </div>
        </div>
        <!--   G a p   G l a z i n g   -->
        <div class="tiles" id="gapGlazing">
            <div class="cube">
              <div class="tile_front_face">
                <div class="front_tile_det">
                  <div class="icon_con">
                    <img src="assets/images/tile-gap-filling.png" alt="">
                  </div>
                  <div class="desc_con">Gap Filling, Glazing
                    <br/> &amp; Expansion Joints</div>
                </div>
              </div>
              <div class="tile_back_face tile_01_backface" data-background="url(assets/images/application-hover/bg-gap-glazing.jpg) no-repeat right top -1px"
                data-background-size="auto 100%">
                <div class="exploe_con">
                  <div class="mobile_pan">
                    <div class="mobIcon"><img src="assets/images/application-mob/tile-gap-filling.png" alt=""></div>
                    <p>Don't let the flaws show </p>
                  </div>
                  <a href="<?=base_url?>p/gap-filling-glazing-expansion-40" class="commanBtn">Explore more</a>
                </div>
              </div>
            </div>
        </div>
        <!-- Tape App  -->
        <div class="tiles" id="tapeApp">
            <div class="cube">
              <div class="tile_front_face">
                <div class="front_tile_det">
                  <div class="icon_con">
                    <img src="assets/images/tile-tapes.png" alt="">
                  </div>
                  <div class="desc_con">Tapes</div>
                </div>
              </div>
              <div class="tile_back_face tile_01_backface" data-background="url(assets/images/application-hover/bg-tape-app.jpg) no-repeat left top -1px"
                data-background-size="auto 100%">
                <div class="exploe_con">
                  <div class="mobile_pan">
                    <div class="mobIcon"><img src="assets/images/application-mob/tile-tapes.png" alt=""></div>
                    <p>Some things need
                    <br/> more than glue </p>
                  </div>
                  <a href="<?=base_url?>p/paper-pvc-adhesive-tapes-42" class="commanBtn">Explore more</a>
                </div>
              </div>
            </div>
        </div>
        <!--   Plumbing App   -->
        <div class="tiles" id="plumbingApp">
            <div class="cube">
              <div class="tile_front_face">
                <div class="front_tile_det">
                  <div class="icon_con">
                    <img src="assets/images/tile-plumbing.png" alt="">
                  </div>
                  <div class="desc_con">Plumbing</div>
                </div>
              </div>
              <div class="tile_back_face tile_02_backface" data-background="url(assets/images/application-hover/bg-plumbing-app.jpg) no-repeat right top -1px"
                data-background-size="auto 100%">
                <div class="exploe_con">
                  <div class="mobile_pan">
                    <div class="mobIcon"><img src="assets/images/application-mob/tile-plumbing.png" alt=""></div>
                    <p>From cements to sealants </p>
                  </div>
                  <a href="<?=base_url?>p/plumbing-pvc-cpvc-pipe-glue-36" class="commanBtn">Explore more</a>
                </div>
              </div>
            </div>
        </div>
        <!--  Automobile App -->
        <div class="tiles" id="automobileApp">
            <div class="cube">
              <div class="tile_front_face">
                <div class="front_tile_det">
                  <div class="icon_con">
                    <img src="assets/images/tile-automobile.png" alt="">
                  </div>
                  <div class="desc_con">Automotive</div>
                </div>
              </div>
              <div class="tile_back_face tile_02_backface" data-background="url(assets/images/application-hover/bg-automobile-app.jpg) no-repeat left top -1px"
                data-background-size="auto 100%">
                <div class="exploe_con">
                  <div class="mobile_pan">
                    <div class="mobIcon"><img src="assets/images/application-mob/tile-automobile.png" alt=""></div>
                    <p>Polish, putty, sealant and more </p>
                  </div>
                  <a href="<?=base_url?>p/automobile-43" class="commanBtn">Explore more</a>
                </div>
              </div>
            </div>
        </div>
        <!--  Electrical insulation industry -->
        <div class="tiles" id="industry">
            <div class="cube">
              <div class="tile_front_face">
                <div class="front_tile_det">
                  <div class="icon_con">
                    <img src="assets/images/tile-industrial.png" alt="">
                  </div>
                  <div class="desc_con">Industrial Applications</div>
                </div>
              </div>
              <div class="tile_back_face tile_02_backface" data-background="url(assets/images/application-hover/bg-industry.jpg) no-repeat right top -1px">
                <div class="exploe_con">
                  <div class="mobile_pan">
                    <div class="mobIcon"><img src="assets/images/application-mob/tile-industrial.png" alt=""></div>
                    <p> Bonds, sealants, solvents 
                    <br />and more for industrial use</p>
                  </div>
                  <a href="<?=base_url?>p/industrial-application-45" class="commanBtn">Explore more</a>
                </div>
              </div>
            </div>
        </div>
        <!--   Accessories App -->
        <div class="tiles" id="accessoriesApp">
            <div class="cube">
              <div class="tile_front_face">
                <div class="front_tile_det">
                  <div class="icon_con">
                    <img src="assets/images/tile-accessories.png" alt="">
                  </div>
                  <div class="desc_con">Application Tools</div>
                </div>
              </div>
              <div class="tile_back_face tile_01_backface" data-background="url(assets/images/application-hover/bg-accessories-app.jpg) no-repeat left top -1px"
                data-background-size="auto 100%">
                <div class="exploe_con">
                  <div class="mobile_pan">
                    <div class="mobIcon"><img src="assets/images/application-mob/tile-accessories.png" alt=""></div>
                    <p>Fair weather friends </p>
                  </div>
                  <a href="<?=base_url?>p/application-tools-37" class="commanBtn">Explore more</a>
                </div>
              </div>
            </div>
        </div>
        </div>
        <!--div class="tiles_pagination">
          <div class="page_tab page_1 active_tiles"><span>1</span></div>
          <div class="page_tab page_2"><span>2</span></div>
        </div-->
      </section>
      <section id="home_about">
        <div class="container">
          <div class="sect_title">
            <h2>Welcome to <span>Astral Adhesives</span></h2>
            <div class="tl_bg">About us</div>
          </div>
          <p>Astral Adhesives manufactures  highly diversified range of adhesives used in varied applications. Our products range from customized Epoxy based adhesives which give excellent strength and bonding characteristics for speciality applications to commodity adhesives based on cyanoacrylates, elastomers, PVA etc. Started in 1987 as a Company manufacturing epoxy resins, adhesives were added to our product range in 1993. Based on excellent quality control and R&amp;D facilities, range of adhesives were developed taking various applications areas into consideration...</p>
          <a href="<?=base_url?>about-us" class="commanBtn">Know More</a>
          <ul class="nationCon">
            <li>
              <div class="plant_count">
                <img src="<?=base_url?>assets/images/flag-india.jpg" alt="India Flag">
                <div class="num_count"><span>2</span></div>
              </div>
              <div class="plant">Plants<br />in india</div>
            </li>
            <li>
              <div class="plant_count">
                <img src="<?=base_url?>assets/images/flag-uk.jpg" alt="UK Flag">
                <div class="num_count"><span>1</span></div>
              </div>
              <div class="plant">Plants<br />in UK</div>
            </li>
            <li>
              <div class="plant_count">
                <img src="<?=base_url?>assets/images/flag-us.jpg" alt="US Flag">
                <div class="num_count"><span>1</span></div>
              </div>
              <div class="plant">Plants<br />in US</div>
            </li>
          </ul>
        </div>
      </section>
      <section id="top_brands">
        <div class="container">
          <div class="sect_title">
            <h2>Our top <span>brands</span></h2>
            <div class="tl_bg">Top Brands</div>
          </div>
          <ul>
		  <?php
		# home page brand
		$order			= 'sortorder asc limit 0,8';
		$where      	= array(":is_delete" => '1' , ":is_active" => '1');
		$homebrandArr 	= $objTypes->select("tbl_brands", "*", "is_delete = :is_delete and is_active = :is_active ", $where, $order);
		if(isset($homebrandArr) && sizeof($homebrandArr) > 0){
			foreach ($homebrandArr as $brand_value){
		?>
            <li class="direction-reveal direction-reveal--3-grid-flexbox direction-reveal--demo-swing">
              <div class="direction-reveal__card">
                <div class="front_face">
                  <img src="<?=base_url?>uploads/brand_images/<?php echo $brand_value['thumbnail'];?>">
                  <div class="overlay"></div>
                  <div class="brand_name"><?php echo stripslashes($brand_value['title']);?></div>
                </div>
                <div class="direction-reveal__overlay direction-reveal__anim--in">
                  <img src="<?=base_url?>uploads/brand_images/<?php echo $brand_value['thumbnail1'];?>">
                  <a href="<?=base_url?>b/<?=$objTypes->prepare_url(stripslashes($brand_value['title']));?>-<?=$brand_value['id']?>" class="commanBtn">Know More</a>
                </div>
              </div>
            </li>
			<?php }
				}
			?>
          </ul>
          <a href="<?=base_url?>brands" class="commanBtn">View all brands</a>
        </div>
      </section>
       <section id="counterHolder">
        <div class="container">
          <ul>
            <li>
              <div class="unitIconCon">
                <div class="icon_pic"><img src="<?=base_url?>assets/images/counter-icon-01.gif" alt=""></div>
                <div class="counter_indicator"><img src="<?=base_url?>assets/images/counter-arrow.png" alt=""></div>
              </div>
              <div class="counter_det">
                <div class="count"><span class="counter">3</span></div>
                <p>Manufacturing Units</p>
              </div>
            </li>
            <li>
              <div class="unitIconCon">
                <div class="icon_pic"><img src="<?=base_url?>assets/images/counter-icon-02.gif" alt=""></div>
                <div class="counter_indicator"><img src="<?=base_url?>assets/images/counter-arrow.png" alt=""></div>
              </div>
              <div class="counter_det">
                <div class="count"><span class="counter">50</span></div>
                <p>Products</p>
              </div>
            </li>
            <li>
              <div class="unitIconCon">
                <div class="icon_pic"><img src="<?=base_url?>assets/images/counter-icon-04.gif" alt=""></div>
                 <div class="counter_indicator"><img src="<?=base_url?>assets/images/counter-arrow.png" alt=""></div>
              </div>
              <div class="counter_det">
                <div class="count"><span class="counter">600</span>+</div>
                <p>SKUs</p>
              </div>
            </li>
            <li>
              <div class="unitIconCon">
                <div class="icon_pic"><img src="<?=base_url?>assets/images/counter-icon-03.gif" alt=""></div>
                <div class="counter_indicator"><img src="<?=base_url?>assets/images/counter-arrow.png" alt=""></div>
              </div>
              <div class="counter_det">
                <div class="count"><span class="counter">25000</span>+</div>
                <p>Retailers</p>
              </div>
            </li>
          </ul>
        </div>
      </section>
      <section id="whats_new">
        <div class="container">
          <div class="sect_title">
            <h2>What's new at <span>Astral Adhesives</span></h2>
            <div class="tl_bg">What's new</div>
          </div>
          <div class="socialHolder">
            <div class="col-2">
              <div class="sect_title">
                <div class="tl_bg">New</div>
              </div>
              <?php
    # home page astral adhesives
              $order      	= 'id DESC limit 0,1';
              $where        = array(":is_delete" => '1' , ":is_active" => '1',":is_home"=>'1',":type"=>'video');
              $videoadhesive= $objTypes->select("tbl_adhesive", "*", "is_delete = :is_delete and is_active = :is_active and is_home = :is_home and type=:type", $where, $order);
              if(isset($videoadhesive) && sizeof($videoadhesive) > 0){
                 foreach ($videoadhesive as $adhesive_video){
              ?>
              <div class="videoHolder clearfix">
                <div class="videoCon">
             <iframe src="https://www.youtube-nocookie.com/embed/<?php echo $adhesive_video['youtube'];?>?rel=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                 
                </div>
                <div class="all_video">
                  <div class="vid_astral_logo"><img src="<?=base_url?>assets/images/videio-astral-logo.jpg" alt=""></div>
                  <a href="<?=base_url?>gallery/video">View all videos</a>
                </div>
              </div>
            <?php 
                 } 
               }
               ?>
              <div class="socialFieldHolder clearfix">
                <div class="social_lt">
                  <img src="<?=base_url?>assets/images/icon-fb-big.jpg" alt="">
                  <div class="fb_iframe_hld"><iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2FAstralAdhesives%2F&width=300&layout=button_count&action=like&size=large&show_faces=true&share=false&height=21&appId=177290702947432" width="300" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe></div>
                </div>
                <div class="social_rt">
                <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FAstralAdhesives%2F&tabs=timeline&width=375&height=420&small_header=true&adapt_container_width=true&hide_cover=true&show_facepile=true&appId=177290702947432" width="375" height="420" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
                </div>
              </div>
            </div>
			  <?php
		# home page astral adhesives
		$order			= 'id DESC limit 0,1';
		$where      	= array(":is_delete" => '1' , ":is_active" => '1',":is_home"=>'1',":type"=>'image');
		$homeadhesiveArr 	= $objTypes->select("tbl_adhesive", "*", "is_delete = :is_delete and is_active = :is_active and is_home = :is_home and type=:type", $where, $order);
		if(isset($homeadhesiveArr) && sizeof($homeadhesiveArr) > 0){
			foreach ($homeadhesiveArr as $adhesive_value){
		?>
            <div class="col-2">
              <div class="event_holder">
                <div class="event_head clearfix">
                  <div class="lt">
				          <img src="<?=base_url?>assets/images/event-home-banner.jpg" alt="">
				  </div>
                  <div class="rt">
                    <div class="event_title"><?php echo stripslashes($adhesive_value['title1']);?><span><?php echo stripslashes($adhesive_value['title2']);?></span></div>
                  </div>
                </div>
                <div class="latest_event">
                  <img src="<?=base_url?>uploads/astral_adhesive_image/large/<?php echo $adhesive_value['thumbnail1'];?>" alt="">
                  <a href="<?=base_url?>gallery" class="view_all"><span>View all Images</span></a>
                </div>
              </div>
            </div>
		<?php 
				}
		}
		?>
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
                <img src="assets/images/sub-bond-it.png" alt="Bond it">
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
    <script type="text/javascript" src="<?=base_url?>assets/js/waypoints.js"></script>
    <script type="text/javascript" src="<?=base_url?>assets/js/TweenMax.min.js"></script>
    <script type="text/javascript" src="<?=base_url?>assets/js/jquery.slimmenu.min.js"></script>
    <script type="text/javascript" src="<?=base_url?>assets/js/owl.carousel-beta.js"></script>
    <script type="text/javascript" src="<?=base_url?>assets/js/jquery.counterup.min.js"></script>
    <script type="text/javascript" src="<?=base_url?>assets/js/kute.min.js"></script>
    <script type="text/javascript" src="<?=base_url?>assets/js/kute-svg.min.js"></script>
    <script type="text/javascript" src="<?=base_url?>assets/js/common.js"></script>
    <script type="text/javascript" src="<?=base_url?>assets/js/home.js"></script>
    <!--[if lt IE 9]>
        <script src="<?=base_url?>js/html5shiv.min.js"></script>
    <![endif]-->
  </body>
</html>