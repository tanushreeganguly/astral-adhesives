   <header>
        <div class="headerCon">
            <div class="hd_top">
            <div class="search"><img src="<?=base_url?>assets/images/icon-search.png" onmouseover="this.src='<?=base_url?>assets/images/icon-search-hover.png'" onmouseout="this.src='<?=base_url?>assets/images/icon-search.png'" alt="Search"></div>
              <a href="tel:+91 7311103331">
                  <picture>
                    <source media="(max-width: 1157px)" srcset="<?=base_url?>assets/images/res-ph.png">
                    <img src="<?=base_url?>assets/images/icon-phone.png" onmouseover="this.src='<?=base_url?>assets/images/icon-phone-hover.png'"
       onmouseout="this.src='<?=base_url?>assets/images/icon-phone.png'" alt="Phone Number" align="absmiddle">
                  </picture>
                 +91 7311103331
       </a>

              <!--a href="https://www.facebook.com/AstralAdhesives/" target="_blank"><img src="<?=base_url?>assets/images/icon-fb.png" onmouseover="this.src='<?=base_url?>assets/images/icon-fb-hover.png'"
       onmouseout="this.src='<?=base_url?>assets/images/icon-fb.png'" alt="Facebook"></a>
              <a href="https://twitter.com/astraladhesives" target="_blank"><img src="<?=base_url?>assets/images/icon-tw.png" onmouseover="this.src='<?=base_url?>assets/images/icon-tw-hover.png'"
       onmouseout="this.src='<?=base_url?>assets/images/icon-tw.png'" alt="Tweeter"></a>
              <a href="https://www.youtube.com/channel/UC-7wKHr0O_armoSAddVgHIw" target="_blank"><img src="<?=base_url?>assets/images/icon-yt.png" onmouseover="this.src='<?=base_url?>assets/images/icon-yt-hover.png'"
       onmouseout="this.src='<?=base_url?>assets/images/icon-yt.png'" alt="Youtube"></a>
              <a href="https://www.instagram.com/astral_adhesives/" target="_blank"><img src="<?=base_url?>assets/images/icon-insta.png" onmouseover="this.src='<?=base_url?>assets/images/icon-insta-hover.png'"
       onmouseout="this.src='<?=base_url?>assets/images/icon-insta.png'" alt="Instagram"></a-->

              <a href="https://www.facebook.com/AstralAdhesives/" target="_blank" class="fb_icon"></a>
              <a href="https://twitter.com/astraladhesives" target="_blank" class="tw_icon"></a>
              <a href="https://www.youtube.com/channel/UC-7wKHr0O_armoSAddVgHIw" target="_blank" class="yt_icon"></a>
              <a href="https://www.instagram.com/astral_adhesives/" target="_blank" class="insta_icon"></a>

            </div>
            <div class="hd_bottom">
              <div class="res_top">
                <div class="logo">
                  <a href="<?=base_url?>"><picture>
                    <source media="(max-width: 480px)" srcset="<?=base_url?>assets/images/logo-desktop.png">
                    <source media="(max-width: 1023px)" srcset="<?=base_url?>assets/images/logo-desktop.png">
                    <img src="<?=base_url?>assets/images/logo-desktop.png" alt="Astral Adhesives">
                  </picture></a>
                </div>
                <div id="nav-icon1">
                  <span></span>
                  <span></span>
                  <span></span>
                </div>
               </div> 
              <nav>
                <div class="mobileMenuClose"><img src="<?=base_url?>assets/images/close-menu-mob.png" alt=""></div>
                <ul class="slimmenu">
                  <li><a href="javascript:void(0);">About us</a>
                      <ul>
                        <li><a href="<?=base_url?>about-us">About Astral Adhesives</a></li>
                        <li><a href="<?=base_url?>mission-vision">Mission &amp; Vision</a></li>
                        <li><a href="<?=base_url?>milestones">Milestones</a></li>
                        <li><a href="<?=base_url?>RnD">R &amp; D Facilities</a></li>
                      </ul>
                  </li>
                  <li class="product_subnav"><a href="javascript:void(0);">Products </a>
				  <?php
					//home page application
					$order1= 'sortorder ASC';
				  $sql = "SELECT title,id,thumbnail,icon FROM tbl_categories WHERE parent_category_id = :parent_category_id AND is_delete = :is_delete AND is_active = :is_active AND sortorder!=0  order by sortorder ASC";

					$bind= array(':parent_category_id' => 0, ':is_delete' => '1', ':is_active' => '1');
					$ProData   = $objTypes->fetchAll($sql, $bind, $order1);
					
					
				?>
                <ul class="prod_sub_menu">
                  <div class="sub_nav_con">
                      <div class="sub_nav_list">
					<?php
					if(isset($ProData) && sizeof($ProData) > 0){
					foreach($ProData as $indCat){
					
					$title = $objTypes->prepare_url(stripslashes($indCat['title']));
					if($indCat['id']==42) { $title = 'paper-pvc-adhesive-tape'; }  
					if($indCat['id']==41) { $title = 'tile-adhesive'; }  
					if($indCat['id']==36) { $title = 'plumbing-pvc-cpvc-pipe-glue'; }  
					if($indCat['id']==33) { $title = 'anaerobic-adhesive'; }  
					if($indCat['id']==28) { $title = 'furniture-wood-care-glue'; }  
          			
          if(strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'mobile') || strstr(strtolower($_SERVER['HTTP_USER_AGENT']), 'android')) {
					?>
                      <li ><a href="<?=base_url?>p/<?=$title?>-<?=$indCat['id']?>" style="background-image:url(<?=base_url?>uploads/category_images/icon/<?php echo $indCat['icon'];?>);  background-repeat:no-repeat;"><?php echo stripslashes($indCat['title']);?></a></li>
                      
					  <?php
              }else{
            ?>
                      <li ><a href="<?=base_url?>p/<?=$title?>-<?=$indCat['id']?>"><?php echo stripslashes($indCat['title']);?></a></li>
                      
            <?php

              }
						}
					}
					  ?>
                    </div>
                      <div class="sub_img_ref">
                        <?php
                        if(isset($ProData) && sizeof($ProData) > 0){
                          foreach($ProData as $indCat){
                            ?>
                        <img src="<?=base_url?>uploads/category_images/<?php echo $indCat['thumbnail'];?>" alt="<?php echo stripslashes($indCat['title']);?>">
                        <?php }}?>
                      </div>
                  </div>
                  
                </ul>
              </li>
                  <li><a href="<?=base_url?>industrial-glue-adhesive">Industrial</a></li>
        				  <li><a href="javascript:;">Infocenter</a>
          					<ul>
                           <li><a href="<?=base_url?>press-release">Press Release</a></li>
          					       <li><a href="<?=base_url?>news-events">Upcoming Events</a></li>
                           <li><a href="<?=base_url?>gallery">Gallery</a></li>
                           <li><a href="<?=base_url?>download">Download</a></li>
          					</ul>
        				  </li>
                 
                  <li><a href="<?=base_url?>career-details">Careers</a></li>
                  
                  <li><a href="<?=base_url?>contact-us">Contact us</a></li>
                </ul>
       

              </nav>
               <div class="menuOverlay"></div>
            </div>
          </div>
       
      </header>
	  <div class="gutter" style="padding-top: 113px;"></div>