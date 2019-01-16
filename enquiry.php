<?php
include_once('config/config.php');
if(!class_exists('FormToken'))
{
	if(!require_once('include/form_token.php')){
		die('Class FormToken Not Exists.');
	}else{
		$token = new FormToken();
	}
}
function noHTML($input, $encoding = 'UTF-8') {
   return htmlentities($input, ENT_QUOTES | ENT_HTML5, $encoding);
}
$POST	= $objTypes->validateUserInput($_REQUEST);

function smssendotp($number)
{
		
		$ch = curl_init();  // initiate curl

		$url = "http://www.smsjust.com/sms/user/urlsms.php?"; // where you want to post data - final
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POST, true);  // tell curl you want to post something
		curl_setopt($ch, CURLOPT_POSTFIELDS, "username=astralpoly&pass=aptl@2017&senderid=ASTRAL&dest_mobileno=$number&message=Thank you for your details! We will get in touch with you shortly&response=Y"); 
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch); 
		if($result)
		{
			
			return 1; 
		}else{
			
			return 0; 
		}
		curl_close($ch);
}


if(isset($POST['data']) && $POST['data']=='1')
{
	$name 	 = noHTML(addslashes(strip_tags(trim($POST['name']))));
	$email	 = noHTML(addslashes(strip_tags(trim($POST['email']))));
	$decodeemail= html_entity_decode($email, ENT_QUOTES | ENT_HTML5, 'UTF-8');
	$mobile  = noHTML(addslashes(strip_tags(trim($POST['mobile']))));
	$type_enquiry = noHTML(addslashes(strip_tags(trim($POST['type_enquiry']))));
	$country = noHTML(addslashes(strip_tags(trim($POST['country']))));
	if($country=="India"){
	$state 	 = noHTML(addslashes(strip_tags(trim($POST['state']))));
	}else{
	$state 	 = noHTML(addslashes(strip_tags(trim($POST['state_input']))));	
	}
	$location= noHTML(addslashes(strip_tags(trim($POST['location']))));
	$message = noHTML(addslashes(strip_tags(trim($POST['message']))));
	$decodemessage= html_entity_decode($message, ENT_QUOTES | ENT_HTML5, 'UTF-8');
	$error	 = "";
	$flag	 	 = true;


	if($token->validateKey() == false){
		$error = "There is some problem, please try again.";		
		$flag  = false;
	}
	if(strlen($error)<=0){
		if($name==""){
			$error 	= "Please enter your name";
			$flag	= false;
		}elseif(!preg_match('/^[a-zA-Z ]+$/',$name)){
			$error 	= "Please enter valid name";
			$flag	= false;
		}elseif(strlen($name_ser) > '75'){
			$error 	= "Please enter valid name";
			$flag	= false;
		}
	}
	if(strlen($error)<=0){
		if($mobile=="" ){
			$error 	= "Please enter a valid mobile number";
			$flag	= false;
		}else if(strlen($mobile)!='10'){ 
			$error="Please Enter 10 Digit Mobile number.";
			$flag=false;		
		}else if(!preg_match("/^[0-9]{10}+$/",$mobile)){
			$error="Plesae enter valid Mobile number and maximum 10 digits";
			$flag=false;
		}	
	}
	if(strlen($error)<=0){	
	
		if($email=="" ){
			$error 	= "Please enter a valid email id";
			$flag	= false;
		}else if($email!=''){ 
				if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,8})$/",$decodeemail)){
				$error 	= "Please enter valid email id";
				$flag	= false;
				$ser_eclass = "email";
			}
		}
	}
	if(strlen($error)<=0){
		if($type_enquiry=="" ){
			$error 	= "Please specify the type of enquiry";
			$flag	= false;
		}
	}
	if(strlen($error)<=0){
		if($state=="" ){
			$error 	= "Please enter state name";
			$flag	= false;
		}
		if($state!="" ){
			if(!preg_match('/^[a-z A-Z]+$/',$state)){
				$error 	= "Please enter a valid state";
				$flag	= false;
			}
		}
	}
	if(strlen($error)<=0){
		if($location=="" ){
			$error 	= "Please enter your location";
			$flag	= false;
		}
		if($location!="" ){
			if(!preg_match('/^[a-zA-Z0-9 ]+$/',$location)){
				$error 	= "Please enter a valid location";
				$flag	= false;


			}
		}
	}
	if(strlen($error)<=0){
		
		if($message!=""){
			if(!preg_match('/^[a-z.A-Z0-9-!, ]+$/',$decodemessage)){
				$error 	= "Please enter a valid message";
				$flag	= false;
			}
			
		} 
	}
		
	if($flag==true && strlen($error)<=0){
		
		$insert_arr = array(
							'name'		=> $name,
							'email'		=> $decodeemail,
							'mobile' 	=> $mobile,
							'enquiry_type'	=> $type_enquiry,
							'country'	=> $country,
							'state'	=> $state,
							'location'	=> $location,
							'message'	=> $decodemessage,
							'ip'		=> $_SERVER['REMOTE_ADDR'],
							'agent'     => addslashes($_SERVER['HTTP_USER_AGENT'])
							);					
							
		$insert_enquiry = $objTypes->insert("tbl_enquiry", $insert_arr);
		$ins = $objTypes->lastInsertId();

		if($insert_enquiry)
		{

			$sendotp = smssendotp($mobile);
			
			

			$error= 'Thank you for your details! We will get in touch with you shortly.';
			
			
			 
			
			/* if(isset($insert_id) && $insert_id > 0){
								
				require ('include/PHPMailer/PHPMailerAutoload.php');									
				//Gemini Mail			
				$hrmail = new PHPMailer;
				$hrmail->isHTML(true);
				$hrmail->IsSMTP();
				$hrmail->Mailer 	= "smtp";
				$hrmail->Host       = ""; 
				$hrmail->SMTPDebug  = 0; 
				$hrmail->SMTPAuth   = true; 
				$hrmail->Port       = 25;
				$hrmail->SMTPSecure = 'TLS';
				$hrmail->Username   = "info@bhratbenz.com";
				$hrmail->Password   = "info123!@#";							
				$hrmail->setFrom('info@bhratbenz.com', 'Bharat BharatBenz');
				$hrmail->addReplyTo(strtolower($decodeemail), $name); 	
			
				$hrmail->addAddress('info@bhratbenz.com', 'Bharat BharatBenz');				
				//$hrmail->addBCC('farheen.parkar@bcwebwise.com', 'Farheen');
				//$hrmail->addBCC('mitul.jagushte@bcwebwise.com', 'Mitul Jagushte');					
	
				$hrmail->Subject  = 'Feedback received from '.ucwords($name).' - '.date("jS F Y");
				$html_content     = "<p><b>Contact information - To serve you better.</b></p>";						
				$html_content	 .= "<p>Name :- ".ucwords($name)."  ,</p>";
				$html_content	 .= "<p>Email :- ".strtolower($email)."  ,</p>";
				$html_content	 .= "<p>Mobile :- ".$mobile."  ,</p>";
				$html_content	 .= "<p>Location :- ".stripslashes($location)."  ,</p>";
				$html_content	 .= "<p>Message :- ".stripslashes($decodemessage)."  .</p>";
			
				$hrmail->Body  	  = $html_content;
				//$hrmail->addAttachment($file_location, $file_name);
				if(!$hrmail->send()){
					//$error	= "Error in sending message.";						
					$message_serve	= "Thank you for your details! We will get in touch with you shortly.";
				}
				
				// Response Mail
				$mail 	= new PHPMailer;				
				$mail->isHTML(true);								
				$mail->IsSMTP();
				$mail->Mailer 	  = "smtp";
				$mail->Host       = "bhratbenz.com"; 
				$mail->SMTPDebug  = 0; 
				$mail->SMTPAuth   = true; 
				$mail->Port       = 25;
				$mail->SMTPSecure = 'TLS';
				$mail->Username   = "info@bhratbenz.com"; 
				$mail->Password   = "info123!@#";		
				$mail->setFrom('info@bhratbenz.com', 'Bharat BharatBenz');		
				$mail->addReplyTo('info@bhratbenz.com', 'Bharat BharatBenz'); 					
				$mail->isHTML(true);

				$mail->addAddress(strtolower($decodeemail), $name);								
				//$mail->addBCC('farheen.parkar@bcwebwise.com', 'Farheen');
				
				$mail->Subject  = "Thank you";
				$mail->Body     = "Thank you for your details! We will get in touch with you shortly.";
				
				if(!$mail->send()){					
					$message_serve	= "Thank you for your details! We will get in touch with you shortly.";
				}else{
					$message_serve = 'Thank you for your details! We will get in touch with you shortly.';
				}				
			}*/
			$error="Thank you for your details! We will get in touch with you shortly.";	
			$name=$email=$mobile=$type_enquiry=$country=$state=$location=$message=$decodemessage='';
		}
	}
}
?>
<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
  <title>Astral Adhesives</title>
  <meta name="description" content="" />
  <meta name="keywords" content="" />
  <link href="<?=base_url?>assets/images/favicon.ico" rel="shortcut icon" type="" >
  <link href="<?=base_url?>assets/css/main.css" rel="stylesheet" type="text/css">
  
  <?php include_once('include/googlecode.php'); ?>
</head>

<body>
	<?php include_once('include/othercode.php'); ?>
  <div id="wrapper">

	<?php include_once('include/header.php'); ?>
    <section id="breadcrumbs">
      <div class="container">
        <a href="<?=base_url?>">Home</a> Enquiry Form
      </div>
    </section>

    <section id="siteInner">
      <div class="container">
        <div class="sect_title inner_title">
          <h2>
            <span>Enquiry Form</span>
          </h2>
        </div>

		<form action="<?php echo base_url;?>enquiry#enquiry" method="post" name="enquiry" id="enquiry">				
				
        <div class="careerCon">

          <div class="cr_block">
          	<div class="errMsg error_display"><?php echo $error;?></div>
            <div class="searchForm enqForm">
					
				<input type="hidden" name="data" value="1">	
				<?php echo $token->outputKey(); ?>	
              <ul class="enquiry">

	                <li>
	                  <span>Name*</span>
	                  <span id="namebox">
	                    <input type="text" class="textBox" id="name" name="name" value="<?php echo $name; ?>"><span></span>
	                  </span>
	                </li>
	                <li>
	                  <span>Email ID*</span>
	                  <span>
	                    <input type="text" class="textBox" name="email" id="email" value="<?php echo $email; ?>">
	                  </span>
	                </li>

	                <li>
	                  <span>Mobile No*</span>
	                  <span id="mobilebox">
	                    <input type="text" class="textBox" id="mobile" name="mobile" maxlength="10" value="<?php echo $mobile; ?>"><span></span>
	                  </span>
	                </li>

	                <li>
	                  <span>Country*</span>
	                  <span>
	                    <select name="country" id="country" class="selectBox">
											<option value="India" <?php if($country=='India') echo 'selected';?>>India</option>
						 				    <option value="Us" <?php if($country=='Us') echo 'selected';?>>Us</option>
	                    </select>
	                  </span>
	                </li>

	                <li>
	                  <span>State*</span>
	                  
										<span id="state_inputbox">
										<select id="state_select" name="state" class="selectBox">
											<option value="">State</option>
											<?php
											$params     = array(":is_active" => '1');
											$state_arr	= $objTypes->fetchAll("SELECT state_name,state_id  FROM tbl_state_master WHERE is_active = :is_active", $params);
											if(sizeof($state_arr) > 0){
												foreach($state_arr as $state_v){  													
													?>
												<option value="<?php echo $state_v['state_name'];?>" <?php echo ($state==$state_v['state_name']) ? 'selected': ''?>><?php echo ucfirst(strtolower($state_v['state_name']));?></option>
											<?php } }  ?>
										</select>


						<p >				
	                    <input type="text" class="textBox" id="state_input" name="state_input" value="<?php echo $state;?>" ><span></span>	
	                 	</p>
						</span>
						 
					  
	                </li>

	                <li>
	                  <span>Location*</span>
	                  <span id="locationbox">
	                  	<input type="text" placeholder="Location" name="location" id="location" value="<?php echo $location; ?>" class="textBox" ><span></span>
	                  </span>
	                </li>
	                <li>
	                  <span>Inquiring For* </span>
	                  <span>
	                    <select name="type_enquiry" id="type_enquiry" class="selectBox">
							<option value="">Select Enquiry type</option>
							<option value="dealership" <?php echo ($type_enquiry=='dealership') ? 'selected': ''?>>Dealership</option>
	                    </select>
	                  </span>
	                </li>
	                <li>
	                  <span>Comment*</span>
	                  <span id="messagebox">
	                    <textarea name="message" id="message" cols="30" rows="5" class="textArea"><?php echo $decodemessage; ?></textarea><span></span>
	                  </span>
	                </li>
              </ul>
              <div class="btnHld">
				<a href="javascript:void(0);" class="commanBtn">Submit</a>
              </div>
              
            </div>
          </div>
          
        </div>
		</form>
      </div>
    </section>

  <?php include_once('include/footer.php'); ?>

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
  <script type="text/javascript" src="<?=base_url?>js/footer.js"></script>
  <script type="text/javascript" src="<?=base_url?>assets/js/jquery.easing.1.3.js"></script>
  <script type="text/javascript" src="<?=base_url?>assets/js/modernizr-custom.js"></script>
  <script type="text/javascript" src="<?=base_url?>assets/js/TweenMax.min.js"></script>
  <script type="text/javascript" src="<?=base_url?>assets/js/jquery.slimmenu.min.js"></script>
  <script type="text/javascript" src="<?=base_url?>assets/js/common.js"></script>

  <!--[if lt IE 9]>
        <script src="<?=base_url?>js/html5shiv.min.js"></script>
    <![endif]-->
</body>

</html>
 <script type="text/javascript">
	$(document).ready(function(){	
	      $('input,textarea').on('keyup',function()
	      {
	      	  $('input,select,textarea').removeClass('errorRed');
	      	  $('.errMsg').text('');
	      	  $('.enquiry li span span').text(''); 
	          $('input,select').removeClass('errorblue');
	          $(this).addClass('errorblue');

	       });
	      
	      $('select').on('change',function()
	      {
	      	  $('input,select,textarea').removeClass('errorRed');
	      	  $('.errMsg').text('');
	      	  $('.enquiry li span span').text(''); 
	          $('input,select').removeClass('errorblue');
	          $(this).addClass('errorblue');

	       });
		$('#location').keyup(function()
          {
              alphanumericsonly(this);
              $("#location").addClass('errorblue');
              $("#location").focus();
              $("#locationbox span").text('Only alphanumerics');

          });

		$('#state_input').keyup(function()
          {
              charactersonly(this);
              $("#state_input").addClass('errorblue');
              $("#state_input").focus();
              $("#state_inputbox span").text('Only characters');

          });	
		$('#mobile').keyup(function()
          {
              numericsonly(this);
              $("#mobile").addClass('errorblue');
              $("#mobile").focus();
              $("#mobilebox span").text('Only numerics');

          });
          $('#name').keyup(function()
          {
              charactersonly(this);
              $("#name").addClass('errorblue');
              $("#name").focus();
              $("#namebox span").text('Only characters');

          });	
          $('#message').keyup(function()
          {
              specificsonly(this);
              $("#message").addClass('errorblue');
              $("#message").focus();
              $("#messagebox span").text('Only specific specialcharacters(.,!)');

          });
			$("#state_input").hide();
			$("#country").change(function(){
				var country = $("#country").val();
				if(country=='Us'){
					$("#state_select").hide();
					$("#state_input").show();
				}else{
					$("#state_select").show();
					$("#state_input").hide();
				}
			});

			
		/* $("#mobile").keypress(function (e) { 
			 //if the letter is not digit then display error and don't type anything
			 if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
				//display error message
				$(".error_display").show();
				$(".error_display").text("Please enter only digits");
				return false;
			}
		   });*/
		
		$(".commanBtn").on('click',function(){
			$('input,select').removeClass('errorblue');
			$("html, body").animate({ scrollTop: 200 }, "slow");
			var name 		= $("#name").val().trim();		
			var mobile		= $("#mobile").val().trim();
			var country		= $("#country").val().trim();
			var email		= $("#email").val().trim();
			var type_enquiry= $("#type_enquiry").val().trim();
			var state		= $("#state_select").val().trim();
			var state_input	= $("#state_input").val().trim();
			var location	= $("#location").val().trim();
			var message		= $("#message").val().trim();
			
			var regEx = new RegExp("/[0-9]/");
		
			var checkemail  = validateEmailAddress(email);
			$("input").removeClass('errorRed');
			if(name==""){
				$(".error_display").show();
				$(".error_display").text("Please enter your name");
				$("#name").addClass('errorRed');
				$("#name").focus();
				isOk = false;
				return false;
			}else if(!validateFirstnameLastname(document.getElementById('name'),"Please enter valid name.")) {
				$("#name").addClass('errorRed');
				isOk = false;
				return false;
			}else{
				$("#name").removeClass('errorRed');
			}	
			
		
			if(email==''){
				$(".error_display").show();
				$(".error_display").text('Please enter your email address');
				$("#email").addClass('errorRed')
				$("#email").focus();
				isOk = false;
				return  false;
			}else if(!checkemail && email!=''){
				$(".error_display").show();
				$(".error_display").text('Please enter a valid email id');
				$("#email").addClass('errorRed');
				$("#email").focus();
				isOk = false;
				return false;
			}else{
				$("#email").removeClass('errorRed');
			}
			
			if(mobile==""){
				$(".error_display").show();
				$(".error_display").text("Please enter your mobile");
				$("#mobile").addClass('errorRed');
				$("#mobile").focus();
				isOk = false;
				return false;
			}else{
					if(!$.isNumeric(mobile))

					{
						$(".errMsg").text("Please enter valid mobile no.");
						$("#mobile").addClass('errorRed');
						$("#mobile").focus();
						isOk = false;
						return false;
					
					}	
					 if(mobile.length != 10) {
						$(".error_display").show();
						$(".error_display").text("Please enter a valid mobile number");
						$("#mobile").addClass('errorRed');
						$("#mobile").focus();
						isOk = false;
						return false;
					}		
				$("#mobile").removeClass('errorRed');			
			}
			//alert(country);
			if(country=='Us'){
				if(state_input==""){
					$(".error_display").show();
					$(".error_display").text("Please enter state name");
					$("#state_input").addClass('errorRed');
					$("#state_input").focus();
					isOk = false;
					return false;

				}else{
					$("#state_input").removeClass('errorRed');
				}
			}if(country=='India'){
				if(state==""){
				$(".error_display").show();
				$(".error_display").text("Please enter state name");
				$("#state_select").addClass('errorRed');
				$("#state_select").focus();
				isOk = false;
				return false;
			 }	else{
			 	$("#state_select").removeClass('errorRed');	
			 }	
			}

			
			if(state=="" && state_input==""){
				$(".error_display").show();
				$(".error_display").text("Please enter state name");
				$("#state_select").addClass('errorRed');
				$("#state_select").focus();
				isOk = false;
				return false;
			}else{			
				$("#state_select").removeClass('errorRed');			
			}
			
			if(location==""){
				$(".error_display").show();
				$(".error_display").text("Please enter your location");
				$("#location").addClass('errorRed');
				$("#location").focus();
				isOk = false;
				return false;
			}else{			
				$("#location").removeClass('errorRed');			
			}
			
			
			if(type_enquiry==""){
				$(".error_display").show();
				$(".error_display").text("Please specify the type of enquiry");
				$("#type_enquiry").addClass('errorRed');
				$("#type_enquiry").focus();
				isOk = false;
				return false;
			}else{			
				$("#type_enquiry").removeClass('errorRed');			
			}
			if(message==""){
				$(".error_display").show();
				$(".error_display").text("Please enter your message");
				$("#message").addClass('errorRed');
				$("#message").focus();
				isOk = false;
				return false;
			}else{			
				$("#message").removeClass('errorRed');			
			}
			
				$("#enquiry").submit();
		});
		function alphanumericsonly(ob) 
        {
            var invalidChars = /([^a-z 0-9])/gi
            if(invalidChars.test(ob.value)) 
            {
                ob.value = ob.value.replace(invalidChars,"");
            }
        }
         function charactersonly(ob) 
        {
            var invalidChars = /([^a-z ])/gi
            if(invalidChars.test(ob.value)) 
            {
                ob.value = ob.value.replace(invalidChars,"");
            }
        }
        function numericsonly(ob) 
        {
            var invalidChars = /([^0-9])/gi
            if(invalidChars.test(ob.value)) 
            {
                ob.value = ob.value.replace(invalidChars,"");
            }
        }
        function specificsonly(ob) 
        {
            var invalidChars = /([^a-z 0-9,!.])/gi
            if(invalidChars.test(ob.value)) 
            {
                ob.value = ob.value.replace(invalidChars,"");
            }

        }

		function validateEmailAddress(elementValue){
			var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;  
			var op = emailPattern.test(elementValue); 
			if(op==false){
				return false;
			}else{
			   return true;
			}
		}
		function validateFirstnameLastname(obj, msg){
			var validStr = /^[a-zA-Z ]{1,}$/;

			NameArr=obj.value.split("");
			/*if(NameArr.length>2)
			{
				alert(msg+'111');
				obj.focus();
				obj.select();
				return false;
			}*/
			for(i=0;i<NameArr.length+5;i++)
			{
				if (validStr.test(NameArr[i]) == false)
				{
					jQuery(".error_display").text(msg);
					obj.focus();
					obj.select();
					return false;
				}
			}
			return true;
		}		
		
	});
	
	</script>