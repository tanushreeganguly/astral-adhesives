 <?php 
$var_url=explode("/",$_SERVER["SCRIPT_NAME"]);
function curPageURL() {
   $pageURL = 'http';
   if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
   $pageURL .= "://";
   if ($_SERVER["SERVER_PORT"] != "80") {
    $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
   } else {
    $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
   }
   return $pageURL;
}

  ?>
 <section id="footerHolder">
	 
        <div class="newsletter">
          <ul>
            <li>Newsletter</li>
            <li>
				<form name="signup" id="signup" method="post">
					<input type="text" id="signup_email" name="signup_email" placeholder="Your email address" class="textBox" value="">
					<input type="submit" name="submit" value="Sign up" class="signUp_btn">
				</form>
				 <div class="nw_err_con">
				  <div class="callout callout-danger errorDiv" > <span id="errormessage"></span> </div>
				  <span id="thankyou"></span>
				 </div>
            </li>
          </ul>
		  
        </div>

         <div class="footer">
        <div class="container">
          <div class="footer_blurb">
            <div class="blurb_title">About Us</div>
            <ul>
              <li>
                <a href="<?=base_url?>about-us">About Astral Adhesives</a>
              </li>
              <li>
                <a href="<?=base_url?>mission-vision">Mission &amp; Vision</a>
              </li>
              <li>
                <a href="<?=base_url?>milestones">Milestones</a>
              </li>
              <li>
                <a href="<?=base_url?>RnD">R&amp;D Facilities</a>
              </li>
            </ul>
          </div>
           <?php
          //home page application
          $order1= 'sortorder ASC';
          $sql = "SELECT title,id FROM tbl_categories WHERE parent_category_id = :parent_category_id AND is_delete = :is_delete AND is_active = :is_active AND sortorder!=0  order by sortorder ASC";
          $bind= array(':parent_category_id' => 0, ':is_delete' => '1', ':is_active' => '1');
          $ProData   = $objTypes->fetchAll($sql, $bind, $order1);
          
          
        ?>
          <div class="footer_blurb">
            <div class="blurb_title">Products</div>
              <ul>
          <?php
          if(isset($ProData) && sizeof($ProData) > 0){
		  foreach($ProData as $indCat){
		  
		  			$title = $objTypes->prepare_url(stripslashes($indCat['title']));
					if($indCat['id']==42) { $title = 'paper-pvc-adhesive-tape'; }  
					if($indCat['id']==41) { $title = 'tile-adhesive'; }  
					if($indCat['id']==36) { $title = 'plumbing-pvc-cpvc-pipe-glue'; }  
					if($indCat['id']==33) { $title = 'anaerobic-adhesive'; }  
					if($indCat['id']==28) { $title = 'furniture-wood-care-glue'; } 
					
          ?>
                      <li><a href="<?=base_url?>p/<?=$title?>-<?=$indCat['id']?>"><?php echo stripslashes($indCat['title']);?></a></li>
                      
            <?php
            }
          }
            ?>
              
             </ul>
          </div>

          <div class="footer_blurb">
            <div class="blurb_title">Infocenter</div>
            <ul>
              <li>
                <a href="<?=base_url?>press-release">Press Release</a>
              </li>
              <li>
                <a href="<?=base_url?>news-events">Upcoming Events</a>
              </li>
              <li>
                <a href="<?=base_url?>gallery">Gallery</a>
              </li>
              <li>
                <a href="<?=base_url?>download">Download</a>
              </li>
            </ul>
          </div>

          <div class="footer_blurb">
            <div class="blurb_title">Others</div>
            <ul>
              <li>
                <a href="<?=base_url?>industrial-glue-adhesive">Industrial</a>
              </li>
             <!-- <li>
                <a href="<?=base_url?>faq">FAQ</a>
              </li>-->
              <li>
                <a href="<?=base_url?>career-details">Careers</a>
              </li>
              <li>
                <a href="<?=base_url?>contact-us">Contact Us</a>
              </li>
            </ul>
          </div>

          <div class="footer_blurb">
            <div class="blurb_title">Map &amp; Address</div>
            <p><b>Resinova Chemie Ltd.</b></p>
            <p>15/78, Civil Lines,</p>
            <p>Opp. Ragendra Swarup </p>
            <p>Auditorium, Kanpur - 208001,</p>
            <p>Uttar Pradesh, India.</p>
            <div class="map">
              <!--img src="assets/images/map.jpg" alt="map"-->
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d16988.688814032965!2d80.34306029012525!3d26.474035881886756!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x2b7f6207aa73719c!2sResinova+Chemie+Ltd.!5e0!3m2!1sen!2sin!4v1536233670518" width="200" height="150" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
          </div>

        </div>
      </div>

        <div class="footer_bottom">
          <div class="container">
            <div class="creadit">&copy; 2018 Astraladhesive.com</div>
            <div class="created_by">
              <a href="https://bcwebwise.com" target="_blank"><img src="<?=base_url?>assets/images/bcww-fish.png" alt="https://bcwebwise.com"></a>
            </div>
          </div>
          <div class="footerClose open">
            <img src="<?=base_url?>assets/images/footer-close.jpg" alt="Close Circle">
            <div class="ft_close">Open</div>
            <div class="arrow"><img src="<?=base_url?>assets/images/footer-arrow.png" alt="Footer Arrow"></div>
          </div>


        </div>
        <?php
          $pageurl=curPageURL();
    
          if($pageurl==base_url){
        ?>
        <div class="seoContent">
        <div class="container">
          <h2>Adhesive Manufacturers in India – Astral Adhesives </h2>
          <p>Astral Adhesives is an adhesive manufacturer in India. We manufacture a diverse range of adhesives, sealants, putties, cyanoacrylate adhesive as well as construction aids.</p>
          <p>If you are planning to build your own home or looking at insulating electrical wiring to avoid mishaps or having a problem with the continuous leakages from pipes or looking to seal the gaps formed between the tiles, then the different range of adhesives, sealants and putties provided should be the list of things you should have. </p>
          <p>When picking out the materials to build your home, you should also find the best products in the market. Your search for the best adhesive manufacturers ends with Astral Adhesives! </p>
          <p>The products offered by Astral Adhesives pioneer the efforts of their inventions using the different chemistries like epoxy, silicones, acrylics, and cyanoacrylates. The customers’ knowledge also helps shape the products that are made.</p>
          <p>While building a house, adhesives are required to attach drywall, tiles, molding, and fixtures to walls, ceilings and floors. Construction adhesives are also provided now in our long list of products. </p>
          <p>At the same times, sealants are also important. Sealant is a substance which is used to block the passage of fluids through the surface or joints or openings in materials. It is a kind of mechanical seal. </p>
          <p>Putties might not be of primary importance during the initial home building process. Putty is a material which has high plasticity, and its texture is similar to clay or dough, usually used in domestic construction. Ideally, it is used for repair as a sealant or filler. Putties are normally used to fill minor cracks, holes and sometimes as the chips in the wooden furniture. </p>
          <p>Epoxy adhesives is more important than cyanoacrylate adhesives so there should be a paraon epoxy adhesives. This is basically instant glues, power glues or superglues. This is used mostly for the minor construction work and while building a house. </p>
          <p>Astral Adhesives comes in many forms – it helps in filling gaps, in filling cracks and it is used when making the base foundation of a building. Besides the adhesives, we also have other products in the form of tapes, waterproofing construction chemicals, tile adhesives, grouts and repair mortars. With kind of the climate India has, a lot of thought needs to be put in while constructing a building. </p>
          <p>To know what other products Astral Adhesives has to offer, please go through our <a href="">products</a> section. </p>
          <p>Astral Adhesives contributes to the consistency of their products with good manufacturing practices and segregation of production practices. Astral Adhesives products are synonymous with quality and reliability. Along with the long list of products, we have large network of distributors across India to give you easy accessibility for this products as well.</p>
        </div>
      </div>
    <?php }?>
      </section>
      
      
	  <section id="search_con">
        <div class="container">
		<div class="error_log" style="color:red;"></div>
		<form name="search" id="searchdata" method="post" action="<?=base_url?>search">
          <input type="text" name="search_data" placeholder="Search" class="search_txtBox">
		  </form>
          <div class="closeSearch">X</div>
        </div>
      </section> 
      
      
      <div class="enq_button">
        <a href="<?=base_url?>enquiry"><img src="<?=base_url?>assets/images/icon-chat.png" alt="">
        <span>Interested? <br /> Enquire Now</span></a>
      </div>
     
	 
	  <script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "Organization",
  "url": " http://www.astraladhesive.com",
  "logo": "astral adhesive logo"

  },{
  "@context": "http://schema.org",
  "@type": "Organization",
  "url": " http://www.astraladhesives.com ",
  "contactPoint": [{
    "@type": "ContactPoint",
    "telephone": "+91-25155957",
    "contactType": "customer service",
   
    "areaServed": "iN"
</script>