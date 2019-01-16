   <header>
        <div class="headerCon">
          <div class="headerCon">
            <div class="hd_top">
              <a href="javascript:;"><img src="<?=base_url?>assets/images/icon-phone.png" onmouseover="this.src='<?=base_url?>assets/images/icon-phone-hover.png'"
       onmouseout="this.src='<?=base_url?>assets/images/icon-phone.png'" alt="Phone Number" align="absmiddle"> +91 7311103331</a>
              <a href="javascript:;"><img src="<?=base_url?>assets/images/icon-fb.png" onmouseover="this.src='<?=base_url?>assets/images/icon-fb-hover.png'"
       onmouseout="this.src='<?=base_url?>assets/images/icon-fb.png'" alt="Facebook"></a>
              <a href="javascript:;"><img src="<?=base_url?>assets/images/icon-tw.png" onmouseover="this.src='<?=base_url?>assets/images/icon-tw-hover.png'"
       onmouseout="this.src='<?=base_url?>assets/images/icon-tw.png'" alt="Tweeter"></a>
              <a href="javascript:;"><img src="<?=base_url?>assets/images/icon-yt.png" onmouseover="this.src='<?=base_url?>assets/images/icon-yt-hover.png'"
       onmouseout="this.src='<?=base_url?>assets/images/icon-yt.png'" alt="Youtube"></a>
              <a href="javascript:;"><img src="<?=base_url?>assets/images/icon-insta.png" onmouseover="this.src='<?=base_url?>assets/images/icon-insta-hover.png'"
       onmouseout="this.src='<?=base_url?>assets/images/icon-insta.png'" alt="Instagram"></a>
            </div>
            <div class="hd_bottom">

              <div class="logo">
                <a href="<?=base_url?>"><picture>
                  <source media="(max-width: 480px)" srcset="<?=base_url?>assets/images/logo-desktop.png">
                  <source media="(max-width: 1023px)" srcset="<?=base_url?>assets/images/logo-desktop.png">
                  <img src="<?=base_url?>assets/images/logo-desktop.png" alt="Astral Adhesives">
                </picture></a>
              </div>

              <nav>
                <ul class="slimmenu">
                  <li><a href="javascript:void(0);">About us</a>
                      <ul>
                        <li><a href="<?=base_url?>about-us">About Astral Adhesives</a></li>
                        <li><a href="<?=base_url?>vision-mission">Vision &amp; Mission</a></li>
                        <li><a href="<?=base_url?>milestones">Milestone</a></li>
                        <li><a href="<?=base_url?>RnD">R &amp; D Facilities</a></li>
                      </ul>
                  </li>
                  <li><a href="javascript:void(0);">Products </a>
				  <?php
					//home page application
					$order1= 'sortorder ASC';
					$sql = "SELECT title,id FROM tbl_categories WHERE parent_category_id = :parent_category_id AND is_delete = :is_delete AND is_active = :is_active order by sortorder ASC";
					$bind= array(':parent_category_id' => 0, ':is_delete' => '1', ':is_active' => '1');
					$ProData   = $objTypes->fetchAll($sql, $bind, $order1);
					
					
				?>
                    <ul>
					<?php
					if(isset($ProData) && sizeof($ProData) > 0){
					foreach($ProData as $indCat){
					?>
                      <li><a href="<?=base_url?>p/<?=$objTypes->prepare_url(stripslashes($indCat['title']))?>-<?=$indCat['id']?>"><?php echo stripslashes($indCat['title']);?></a></li>
                      
					  <?php
						}
					}
					  ?>
                    </ul>
					
                  </li>
                  <li><a href="<?=base_url?>industrial">Industrial</a></li>
        				  <li><a href="javascript:;">Infocenter</a>
          					<ul>
                           <li><a href="<?=base_url?>press-release">Press Release</a></li>
          					       <li><a href="<?=base_url?>news-events">News & Events</a></li>
                           <li><a href="<?=base_url?>gallery">Gallery</a></li>
                           <li><a href="<?=base_url?>download">Download</a></li>
          					</ul>
        				  </li>
                 
                  <li><a href="<?=base_url?>career-details">Career</a></li>
                  
                  <li><a href="<?=base_url?>contact-us">Contact us</a></li>
                </ul>
                <div class="search"><img src="<?=base_url?>assets/images/icon-search.png" onmouseover="this.src='<?=base_url?>assets/images/icon-search-hover.png'"
       onmouseout="this.src='<?=base_url?>assets/images/icon-search.png'" alt="Search"></div>

              </nav>

            </div>
          </div>
        </div>
      </header>
	  <div class="gutter" style="padding-top: 113px;"></div>