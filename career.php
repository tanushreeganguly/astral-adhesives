<?php include_once('config/config.php'); 
$POST   = $objTypes->validateUserInput($_REQUEST);
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
  <title>Astral Adhesives</title>
  <link href="<?=base_url?>assets/images/favicon.ico" rel="shortcut icon" type="" />
  <link href="<?=base_url?>assets/css/main.css" rel="stylesheet" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   <script type="text/javascript" src="https://platform.linkedin.com/in.js">
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
      $("html, body").animate({ scrollTop: 250 }, "slow");
      $('#loading').show();
		}
		function displayProfiles(profiles) {
			member = profiles.values[0];
			var email = member.emailAddress; 
			var name  = member.firstName+" "+member.lastName;
      var location  = member.location.name;
      var total_job=member.positions.values.length;
      var area_detail=location.split(',');
      $.ajax({
        type: 'POST',
        url: 'ajax_apply_for_career.php',
        beforeSend: function(){
              $('#loading').show();
         },
        data:  'email='+email+'&name='+name+'&job_id='+job_code+'&city='+area_detail[0]+'&country='+area_detail[1],  
        success:function(response){ 
         //alert(response);
          $('#loading').hide();
          if(response!=0){
               for(var j=0;j<total_job;j++){
                  var company_name  = member.positions.values[j].company.name;
                  var designation  = member.positions.values[j].title;
                  var type  = member.positions.values[j].company.type;
                 //alert(company_name+","+designation+","+type);
                 $.ajax({
                  type: 'POST',
                  url: 'ajax_apply_for_job.php',
                  data:  'user_id='+response+'&company_name='+company_name+'&designation='+designation+'&job_id='+job_code+'&type='+type,  
                  success:function(response){ 
                    $('#loading').hide();
                   /* if(response=='success'){
                      alert('Successfully applied for Job..!');
                    }*/
                  }
                });
                }
               $('.error_data').html('Successfully applied for Job..!');
               window.location.href='career?msg=1'; 
          }else{
            $('.error_data').html('Already applied');
          }
        }
      });
			// alert(designation+","+area_detail[0]+","+area_detail[1]+","+company_name);
		}
		jQuery(document).ready(function(){
			jQuery(document).on("click",".linkdinlog",function() {
				job_code = $(this).attr('id'); 
				IN.UI.Authorize().place();
				IN.Event.on(IN, "auth", onLinkedInAuth);
			});
		});
		</script>
		<?php include_once('include/googlecode.php'); ?>
</head>
<body>
 <?php include_once('include/othercode.php'); ?>
  <div id="wrapper">
    <?php include_once('include/header.php'); ?>
    <section id="breadcrumbs">
      <div class="container">
        <a href="<?=base_url?>">Home</a>Careers
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
            <a href="<?=base_url?>addresume">Submit Resume</a>
            
          </p>
          <div class="cr_block">
            <h3>Job Search</h3>
            <div class="searchForm">
              <ul>
                <li>
                  <span>Location</span>
                  <span>
                  <?php 
                    $loc_sql    = "select distinct(location) from tbl_careers where is_delete = 1 and is_active = 1";
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
                    $job_title_sql    = "select title from tbl_careers where is_delete = 1 and is_active = 1 order by id DESC";
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
                    $depart_sql    = "select distinct(department) from tbl_careers where is_delete = 1 and is_active = 1";
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
				  <select class="selectBox" name="experience" id="experience">
                      <option value="">Select To Experience</option>
					            <?php for($i=1;$i<=20;$i++){ ?>
                      <option value="<?php echo $i;?>" ><?=$i?></option>
                      <?php } ?>
				  </select>
                    <?php 
                    /*$exp_sql    = "select distinct(from_experience) from tbl_careers where is_delete = 1 and is_active = 1 order by id DESC";
                    $exp_arr    = $objTypes->fetchAll($exp_sql);
                    if(isset($exp_arr) && sizeof($exp_arr) > 0 ) { 
                    ?>   
                    <select name="experience" id="experience" class="selectBox">
                        <option value="">All </option>
                      <?php foreach($exp_arr as $experience_v) { ?>
                      <option value="<?php echo strtolower($experience_v['from_experience']); ?>"><?php echo $experience_v['from_experience']; ?></option>
                    <?php }?>
                    </select>
                  <?php } */?>
                  </span>
                </li>
                <li></li>
              </ul>
            </div>
          </div>
		  <div  id="loading" style="display:none;" >
			<img src="<?=base_url?>assets/images/loading.gif">
		  </div>
	  <div id="current_opening_ajax"> <!--custom div-->
		  <?php
       $result	= $objTypes->fetchAll("SELECT job_code,id,location,title,department,education,from_experience,to_experience,from_date,to_date FROM tbl_careers WHERE is_delete = 1 and is_active = 1  order by job_code asc");
			$html = ''; 
			if(sizeof($result) > 0){ ?>
	<div class="cr_block opening">
            <h3>Current Opening</h3>
            
          </div>
          <div class="error_data">
        <?php if((isset($POST['msg']) && $POST['msg']==1) || (isset($_REQUEST['msg']) && $_REQUEST['msg']=='1') ){ ?>
                    Successfully applied for Job..!
                <?php } ?>
        </div>
          <div class="opening_table_con">
            <div class="opening_details">
              <ul>
                <li class="th">
                  <span>Job Code</span>
                  <span>Job Title</span>
                  <span>Function</span>
                  <span>Education</span>
                  <span>Experience</span>
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
	      <span><?=stripslashes($res['title'])?>
	        <div class="loc"><?=stripslashes($res['location'])?></div>
	      </span>
	      <span><?=stripslashes($res['department'])?></span>
	      <span><?=stripslashes($res['education'])?></span>
	      <span><?=$res['from_experience']?>-<?=$res['to_experience']?> years</span>
	      <span><?=date('d/m/Y',strtotime($res['from_date']));?>
	        <br> TO
	        <br><?=date('d/m/Y',strtotime($res['to_date']));?></span>
	      <span>
	        <a href="<?=base_url?>career-form-<?php echo $res['id'];?>" class="commanBtn">Apply Now</a>
	      </span>
	    </li>
	  </ul>
	  <div class="api_links">
	    <a href="<?=base_url?>jobdetails-<?php echo $res['id'];?>">Read More</a>
	    <a href="javascript:void(0)" class="linkdinlog" id="<?php echo $res['id']; ?>">Apply With</a>		
		 <!--script type="in/Login"></script-->
	  </div>
  </div>
	 <?php } ?>
          </div>
<?php } ?>
			</div><!--custom div-->
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
          data:  'location='+location+'&job_title='+job_title+'&department='+department+'&experience='+experience,     
          success:function(response){
            if(response){
				$("#current_opening_ajax").html(response);             
            }else{
				$("#current_opening_ajax").html('We could not find jobs matching your search criteria.');
			}           
          }
        });
      //}
    });
	$(document).on('change','#job_title',function(){  
	  var job_title  = $("#job_title").val();
	  var location 	 = $("#location").val(); 
	  var department = $("#department").val(); 
	  var experience = $("#experience").val(); 
      //if(job_title){
    $.ajax({
      type: 'POST',
      url: 'ajax_current_opening.php',
      data:  'location='+location+'&job_title='+job_title+'&department='+department+'&experience='+experience,   
      success:function(response){           
      if(response){
				$("#current_opening_ajax").html(response);             
        }else{
				$("#current_opening_ajax").html('We could not find jobs matching your search criteria.');
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
          data:  'location='+location+'&job_title='+job_title+'&department='+department+'&experience='+experience,     
          success:function(response){
            console.log(response);
            if(response){
				$("#current_opening_ajax").html(response);             
            }else{
				$("#current_opening_ajax").html('We could not find jobs matching your search criteria.');
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
	  console.log('location='+location+'&job_title='+job_title+'&department='+department+'&experience='+experience); 
      //if(experience){
        $.ajax({
          type: 'POST',
          url: 'ajax_current_opening.php',
          data:  'location='+location+'&job_title='+job_title+'&department='+department+'&experience='+experience,    
          success:function(response){
            if(response){
              $("#current_opening_ajax").html(response);             
            }else{
              $("#current_opening_ajax").html('We could not find jobs matching your search criteria.');
            }          
          }
        });
      //}
    });
});
</script>