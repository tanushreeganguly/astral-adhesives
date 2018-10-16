<?php include_once('config/config.php'); ?>
<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
  <title>Astral Adhesives</title>
  <!--link href="<?=base_url?>assets/images/favicon.ico" rel="shortcut icon" type="" /-->
  <link href="<?=base_url?>assets/css/main.css" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="//platform.linkedin.com/in.js">
    api_key: 81w5xifcml7xwt
    authorize: true
   // onLoad: onLinkedInLoad
    scope: r_basicprofile r_emailaddress
    </script>
   <script type="text/javascript">
   var job_code;
		function onLinkedInAuth() { console.log('jj');
			IN.API.Profile("me")
			.fields("firstName", "lastName", "industry", "location:(name)", "picture-url", "headline", "summary", "num-connections", "public-profile-url", "distance", "positions", "email-address", "educations", "date-of-birth")
			.result(displayProfiles);
			/*IN.UI.Share().params({
			url: "http://www.example.com"
			}).place()*/
		}
		function displayProfiles(profiles) {			
			console.log(profiles);
			member = profiles.values[0];
			var email = member.emailAddress; 
			var name  = member.firstName;
			$.ajax({
				type: 'POST',
				url: 'ajax_apply_for_career.php',
				data:  'email='+email+'&name='+name+'&job_code='+job_code,  
				success:function(response){ 
					$('#loading').hide();
				  if(response=='success'){
					  alert('Successfully applied for Job..!');
				  }else{
					  alert(response);
				  }
				}
			});
		}
		jQuery(document).ready(function(){
			jQuery(document).on("click",".linkdinlog",function() {
			//jQuery(".linkdinlog").click(function(){
				$('#loading').show();
				job_code = $(this).attr('id'); 
				IN.UI.Authorize().place();
				IN.Event.on(IN, "auth", onLinkedInAuth);
			});
		});
		</script>
</head>

<body>

  <div id="wrapper">

    <header>
      <div class="headerCon">
        <div class="headerCon">
          <div class="hd_top">
            <a href="javascript:;">
              <img src="<?=base_url?>assets/images/icon-phone.png" alt="Phone Number" align="absmiddle"> +91 7311103331</a>
            <span>
              <a href="javascript:;">
                <img src="<?=base_url?>assets/images/icon-fb.png" alt="Facebook">
              </a>
              <a href="javascript:;">
                <img src="<?=base_url?>assets/images/icon-tw.png" alt="Facebook">
              </a>
              <a href="javascript:;">
                <img src="<?=base_url?>assets/images/icon-yt.png" alt="Facebook">
              </a>
              <a href="javascript:;">
                <img src="<?=base_url?>assets/images/icon-insta.png" alt="Facebook">
              </a>
            </span>
          </div>
          <div class="hd_bottom">

            <div class="logo">
              <a href="index.html">
                <picture>
                  <source media="(max-width: 480px)" srcset="<?=base_url?>assets/images/logo-desktop.png">
                  <source media="(max-width: 1023px)" srcset="<?=base_url?>assets/images/logo-desktop.png">
                  <img src="<?=base_url?>assets/images/logo-desktop.png" alt="Astral Adhesives">
                </picture>
              </a>
            </div>

            <nav>
              <ul class="slimmenu">
                <li>
                  <a href="javascript:;">About us</a>
                </li>
                <li>
                  <a href="javascript:;">Products </a>
                  <ul>
                    <li>
                      <a href="javascript:;">Water Proofing</a>
                    </li>
                    <li>
                      <a href="javascript:;">TILE ADHESIVES, GROUTS and REPAIR MORTARS </a>
                    </li>
                    <li>
                      <a href="javascript:;">CONSTRUCTION CHEMICALS </a>
                    </li>
                    <li>
                      <a href="javascript:;">Marble &amp; Granite Care </a>
                    </li>
                    <li>
                      <a href="javascript:;">GAP FILLING, GLAZING &amp; EXPANSION JOINTS </a>
                    </li>
                    <li>
                      <a href="javascript:;">Furniture or Woodcare</a>
                    </li>
                    <li>
                      <a href="javascript:;">Maintenance</a>
                    </li>
                    <li>
                      <a href="javascript:;">Fabric</a>
                    </li>
                    <li>
                      <a href="javascript:;">Glass Bonding</a>
                    </li>
                    <li>
                      <a href="javascript:;">Tapes</a>
                    </li>
                    <li>
                      <a href="javascript:;">Plumbing industry</a>
                    </li>
                    <li>
                      <a href="javascript:;">AUTOMOBILE</a>
                    </li>
                    <li>
                      <a href="javascript:;">Accessories</a>
                    </li>
                    <li>
                      <a href="javascript:;">Brush making industry</a>
                    </li>
                    <li>
                      <a href="javascript:;">Electrical insulation Industry</a>
                    </li>
                    <li>
                      <a href="javascript:;">Industrial Adhesive</a>
                    </li>
                  </ul>
                </li>
                <li>
                  <a href="javascript:;">Industrial</a>
                </li>
                <li>
                  <a href="javascript:;">Infocenter</a>
                </li>
                <li>
                  <a href="javascript:;">Career</a>
                </li>
                <li>
                  <a href="javascript:;">FAQ</a>
                </li>
                <li>
                  <a href="javascript:;">Contact us</a>
                </li>
              </ul>
              <div class="search">
                <img src="<?=base_url?>assets/images/icon-search.png" alt="Search">
              </div>
            </nav>

          </div>
        </div>
      </div>
    </header>
	
	
    <div class="gutter"></div>
    <section id="breadcrumbs">
      <div class="container">
        <a href="index.html">Home</a> Career
      </div>
    </section>
 <!--script type="in/Login"></script-->
    <section id="siteInner">
      <div class="container">
        <div class="sect_title inner_title">
          <h2>
            <span>Careers</span>
          </h2>
        </div>

        <div class="careerCon">
          <p>Didn't the job you were looking for?
            <a href="javascript:;">SubmitResume</a>
          </p>
          <div class="cr_block">
            <h3>Job Search</h3>
            <div class="searchForm">
              <ul>

                <li>
                  <span>Location</span>
                  <span>
                  <?php 
                    $loc_sql    = "select distinct(location) from tbl_careers where is_delete = 1 and is_active = 1 order by id DESC";
                    $loc_arr    = $objTypes->fetchAll($loc_sql);
                    if(isset($loc_arr) && sizeof($loc_arr) > 0 ) { 
                    ?>                    
                    <select name="location" id="location" class="selectBox">
                        <option value="">All </option>
                    <?php foreach($loc_arr as $loc_v) { ?>
                           <option value="<?php echo strtolower($loc_v['location']); ?>"><?php echo $loc_v['location']; ?></option>
                      <?php } ?>
                    </select>
                    <?php } ?>
                  </span>
                </li>
                <li>
                  <span>Job Title</span>
                  <span>
                  <?php 
                    $job_title_sql    = "select * from tbl_careers where is_delete = 1 and is_active = 1 order by id DESC";
                    $job_title_arr    = $objTypes->fetchAll($job_title_sql);
                    if(isset($job_title_arr) && sizeof($job_title_arr) > 0 ) { 
                    ?>     
                    <select name="job_title" id="job_title" class="selectBox">
                          <option value="">All </option>
							<?php foreach($job_title_arr as $job_title_v) { ?>
							<option value="<?php echo strtolower($job_title_v['title']); ?>"><?php echo $job_title_v['title']; ?></option>
							<?php } ?>
                    </select>
                       <?php } ?>
                  </span>
                </li>

                <li>
                  <span>Department</span>
                  <span>
                     <?php 
                    $depart_sql    = "select distinct(department) from tbl_careers where is_delete = 1 and is_active = 1 order by id DESC";
                    $depart_arr    = $objTypes->fetchAll($depart_sql);
                    if(isset($depart_arr) && sizeof($depart_arr) > 0 ) { 
                    ?>     
                    <select name="department" id="department" class="selectBox">
                          <option value="">All </option>
							<?php foreach($depart_arr as $depart_v) { ?>
							<option value="<?php echo strtolower($depart_v['department']); ?>"><?php echo $depart_v['department']; ?></option>
							<?php } ?>
                    </select>
                       <?php } ?>
                  </span>
                </li>

                <li>
                  <span>Experience</span>
                  <span>
                    <select name="experience" id="experience" class="selectBox">
                      <?php for($i=0;$i<31;$i++) { ?>
							<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
					  <?php } ?>
                    </select>
                  </span>
                </li>

                <li></li>
              </ul>
            </div>
          </div>
		  <div  id="loading" style="display:none;" >
			<img src="http://182.76.98.113/astral-adhesives/assets/images/loading.jpg">
		  </div>
		  
	  <div id="current_opening_ajax"> <!--custom div-->
		  <?php $result	= $objTypes->fetchAll("SELECT * FROM tbl_careers WHERE is_delete = 1 and is_active = 1");
			$html = ''; 
			if(sizeof($result) > 0){ ?>
	<div class="cr_block opening">
            <h3>Current Opening</h3>
          </div>

          <div class="opening_table_con">

            <div class="opening_details">
              <ul>
                <li class="th">
                  <span>Job Code</span>
                  <span>Job Title</span>
                  <span>Function</span>
                  <span>Education</span>
                  <span>Job Code</span>
                  <span>Date</span>
                  <span></span>
                </li>
              </ul>
            </div>
            <?php foreach($result as $res){ ?>
            <div class="opening_details" id="opening_details">   
	  <ul>
	    <li>
	      <span><?=$res['job_code']?></span>
	      <span><?=$res['title']?>
	        <div class="loc"><?=$res['location']?></div>
	      </span>
	      <span><?=$res['department']?></span>
	      <span><?=$res['education']?></span>
	      <span><?=$res['experience']?>years</span>
	      <span><?=date('d/m/Y',strtotime($res['from_date']));?>
	        <br> TO
	        <br><?=date('d/m/Y',strtotime($res['to_date']));?></span>
	      <span>
	        <a href="javascript:;" class="commanBtn">Apply Now</a>
	      </span>
	    </li>
	  </ul>
	  <div class="api_links">
	    <a href="javascript:;">Read More</a>
	    <a href="javascript:void(0)" class="linkdinlog" id="<?php echo $res['job_code']; ?>">Apply With</a>		
		 <!--script type="in/Login"></script-->
	  </div>
	 <?php } ?>
	  </div>
          </div>

<?php } ?>
			</div><!--custom div-->
        </div>

      </div>
    </section>




    <section id="footerHolder">
      <div class="newsletter">
        <ul>
          <li>Newsletter</li>
          <li>
            <input type="text" name="" value="Enter your email id" class="textBox">
            <input type="button" name="" value="Sign Up" class="signUp_btn">
          </li>
        </ul>
      </div>

      <div class="footer">
        <div class="container">
          <div class="footer_blurb">
            <ul>
              <li>
                <a href="javascript:;">Products</a>
              </li>
              <li>
                <a href="javascript:;">About Us</a>
              </li>
              <li>
                <a href="javascript:;">Industrial Adhesives</a>
              </li>
              <li>
                <a href="javascript:;">Media</a>
              </li>
              <li>
                <a href="javascript:;">Career</a>
              </li>
              <li>
                <a href="javascript:;">Download</a>
              </li>
            </ul>
          </div>

          <div class="footer_blurb">
            <div class="blurb_title">Contact Us</div>
            <p>15/78, C- Civil Lines,</p>
            <p>Kanpur</p>
            <p>Uttar Pradesh</p>
            <p>208001</p>
            <p>India</p>
            <p>Phone: +91-512-3916700, 2331646, 2332986</p>
            <p>Fax: +91-512-2331803</p>
            <p>email:
              <a href="mailto:chemicals@resinova.com">chemicals@resinova.com</a>
            </p>
            <p>website:
              <a href="www.resinova.com" target="_blank">www.resinova.com</a>
            </p>
          </div>

          <div class="footer_blurb">
            <div class="map">
              <!--img src="<?=base_url?>assets/images/map.jpg" alt="map"-->
              <iframe id="gmap_canvas" src="https://maps.google.com/maps?q=Indonesian Island sail&t=&z=9&ie=UTF8&iwloc=&output=embed" frameborder="0"
                scrolling="no" marginheight="0" marginwidth="0"></iframe>

            </div>
          </div>

        </div>
      </div>

      <div class="footer_bottom">
        <div class="container">
          <div class="creadit">
            <a href="javascript:;">© 2018 Astraladhesive.com </a>
          </div>
          <div class="created_by">
            <a href="https://bcwebwise.com" target="_blank">
              <img src="<?=base_url?>assets/images/bcww-fish.png" alt="https://bcwebwise.com">
            </a>
          </div>
        </div>
        <div class="footerClose open">
          <img src="<?=base_url?>assets/images/footer-close.jpg" alt="Close Circle">
          <div class="ft_close">Open</div>
          <div class="arrow">
            <img src="<?=base_url?>assets/images/footer-arrow.png" alt="Footer Arrow">
          </div>
        </div>
      </div>

    </section>

    <section id="search_con">
      <div class="container">
        <input type="text" name="" placeholder="Search" class="search_txtBox">
        <div class="closeSearch">X</div>
      </div>
    </section>

    <div class="enq_button">
      <a href="javascript:;">
        <img src="<?=base_url?>assets/images/icon-chat.png" alt="">
        <span>Intrested?
          <br /> Enquire Now</span>
      </a>
    </div>

  </div>

  <!--JS Files-->
  <script type="text/javascript" src="<?=base_url?>assets/js/jquery-1.12.1.min.js"></script>
  <script type="text/javascript" src="<?=base_url?>assets/js/jquery.easing.1.3.js"></script>
  <script type="text/javascript" src="<?=base_url?>assets/js/modernizr-custom.js"></script>
  <script type="text/javascript" src="<?=base_url?>assets/js/TweenMax.min.js"></script>
  <script type="text/javascript" src="<?=base_url?>assets/js/jquery.slimmenu.min.js"></script>
  <script type="text/javascript" src="<?=base_url?>assets/js/common.js"></script>
  <!--[if lt IE 9]>
        <script src="js/html5shiv.min.js"></script>
    <![endif]-->
</body>

</html>
<script type="text/javascript">
$(document).ready(function(){	  
	  
    $(document).on('change','#location',function(){		
	  var job_title = $("#job_title").val();
	  var location 	= $("#location").val(); 
	  var department = $("#department").val(); 
	  var experience = $("#experience").val(); 
	  
     // if(location){
        $.ajax({
          type: 'POST',
          url: 'ajax_current_opening.php',
          data:  'location='+location+'&job_title='+job_title+'&department='+department+'&experience'+experience,     
          success:function(response){
            console.log(response);
            if(response){
              $("#current_opening_ajax").html(response);             
            }           
          }
        });
      //}
    });
	$(document).on('change','#job_title',function(){  
	  var job_title = $("#job_title").val();
	  var location 	= $("#location").val(); 
	  var department = $("#department").val(); 
	  var experience = $("#experience").val(); 
      //if(job_title){
        $.ajax({
          type: 'POST',
          url: 'ajax_current_opening.php',
          data:  'location='+location+'&job_title='+job_title+'&department='+department+'&experience'+experience,   
          success:function(response){
            console.log(response);
            if(response){
              $("#current_opening_ajax").html(response);             
            }           
          }
        });
      //}
    });
	$(document).on('change','#department',function(){
      var job_title = $("#job_title").val();
	  var location 	= $("#location").val(); 
	  var department = $("#department").val(); 
	  var experience = $("#experience").val(); 
      //if(department){
        $.ajax({
          type: 'POST',
          url: 'ajax_current_opening.php',
          data:  'location='+location+'&job_title='+job_title+'&department='+department+'&experience'+experience,     
          success:function(response){
            console.log(response);
            if(response){
              $("#current_opening_ajax").html(response);             
            }           
          }
        });
      //}
    });
	$(document).on('change','#experience',function(){		
      var job_title = $("#job_title").val();
	  var location 	= $("#location").val(); 
	  var department = $("#department").val(); 
	  var experience = $("#experience").val(); 
	  console.log('location='+location+'&job_title='+job_title+'&department='+department+'&experience'+experience); 
      //if(experience){
        $.ajax({
          type: 'POST',
          url: 'ajax_current_opening.php',
          data:  'location='+location+'&job_title='+job_title+'&department='+department+'&experience'+experience,    
          success:function(response){
            if(response){
              $("#current_opening_ajax").html(response);             
            }           
          }
        });
      //}
    });
});
</script>