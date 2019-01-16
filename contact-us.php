<?php
include_once('config/config.php');
//require_once('include/form_token.php');


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
if(isset($POST['data']) && $POST['data']=='1')
{
	
	$name 	 = noHTML(addslashes(strip_tags(trim($POST['name']))));
	$email	 = noHTML(addslashes(strip_tags(trim($POST['email']))));
	$decodeemail= html_entity_decode($email, ENT_QUOTES | ENT_HTML5, 'UTF-8');
	$mobile  = noHTML(addslashes(strip_tags(trim($POST['mobile']))));
	
	$contacttype = noHTML(addslashes(strip_tags($POST['contacttype'])));
	
	$message = noHTML(addslashes(strip_tags(trim($POST['description']))));
	$decodemessage= html_entity_decode($message, ENT_QUOTES | ENT_HTML5, 'UTF-8');
	$error		= "";
	$flag		= true;
	//$token = new FormToken();
	if($token->validateKey() == false){
		$error = "There is some problem, please try again.";		
		$flag  = false;
	}
	if(strlen($error)<=0){
	
	if($contacttype!=""){
		if(!preg_match('/^[a-zA-Z ]+$/',$contacttype)){
			$error 	= "Please enter valid contacttype";
			$flag	= false;
			$ser_mclass = "message";
			}
		}
	} 

	if(strlen($error)<=0){
	if($name==""){
		$error 	= "Please enter name";
		$flag	= false;
		$ser_nclass = "name";
	}elseif(!preg_match('/^[a-zA-Z ]+$/',$name)){
		$error 	= "Please enter valid name";
		$flag	= false;
		$ser_nclass = "name";
	}elseif(strlen($name_ser) > '75'){
		$error 	= "Please enter valid name";
		$flag	= false;
		$ser_nclass = "name";
	}
}
if(strlen($error)<=0){
	if($email=="" ){
		$error 	= "Please enter email id";
		$flag	= false;
		$ser_eclass = "email";
	}else if($email!=''){ 
			if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,8})$/",$decodeemail)){
			$error 	= "Please enter valid email id";
			$flag	= false;
			$ser_eclass = "email";
		}
	}
}
if(strlen($error)<=0){
	if($mobile=="" ){
		$error 	= "Please enter mobile number";
		$flag	= false;
		$ser_pclass = "phone";
	}
	 if($mobile!='') 
    { 
        if(strlen($mobile)!='10')
        { 
          $error="Please Enter 10 Digit Mobile.";
          $flag=false;
          
        }
        if(!preg_match("/^[0-9]{10}+$/",$mobile)) 
        {
          $error="Plesae enter valid mobile number and max 10 digit";
          $flag=false;
        }
    }
}
if(strlen($error)<=0){
	
	if($message!=""){
		if(!preg_match('/^[a-zA-Z0-9-!., ]+$/',$decodemessage)){
			$error 	= "Please enter valid message";
			$flag	= false;
			$ser_mclass = "message";
		}
		if(strlen($decodemessage) > '200'){
			$error 	= "Please enter valid message";
			$flag	= false;
			$ser_mclass = "message";
		}
	}
}
	
	if($flag==true && strlen($error)<=0){
		
		$InsertArray = array(
							'name'		=> $name,
							'email'		=> $decodeemail,
							'mobile' 	=> $mobile,
							'message'	=> $decodemessage,
							'contacttype'=> $contacttype,
							'ip'		=> $_SERVER['REMOTE_ADDR'],
							'agent'     => addslashes($_SERVER['HTTP_USER_AGENT'])
							);
							
		$insert_serve = $objTypes->insert("tbl_contact", $InsertArray);
		if($insert_serve)
		{
			
			$insert_serve_id = $objTypes->lastInsertId();			
			if(isset($insert_serve_id) && $insert_serve_id > 0){
								
				require ('include/PHPMailer/PHPMailerAutoload.php');									
							
				$hrmail = new PHPMailer;
				$hrmail->isHTML(true);
				$hrmail->IsSMTP();
				$hrmail->Mailer 	= "smtp";
				$hrmail->Host       = "mail.astraladhesives.com"; 
				$hrmail->SMTPDebug  = 0; 
				$hrmail->SMTPAuth   = true; 
				$hrmail->Port       = 587;
				$hrmail->SMTPSecure = 'TLS';
				$hrmail->Username   = "marketing@astraladhesives.com";
				$hrmail->Password   = "Adhesives123";							
				$hrmail->setFrom('marketing@astraladhesives.com', 'Astral Adhesives');
				$hrmail->addReplyTo(strtolower($decodeemail), $name); 	
			
				$hrmail->addAddress('marketing@astraladhesives.com', 'Astral Adhesives');				
				$hrmail->addBCC('tanushree.ganguly@bcwebwise.com', 'tanushree');
				//$hrmail->addBCC('mitul.jagushte@bcwebwise.com', 'Mitul Jagushte');					
	
				$hrmail->Subject  = 'Enquiry received from '.ucwords($name).' - '.date("jS F Y");
				$html_content     = "<p><b>Contact information - To serve you better.</b></p>";						
				$html_content	 .= "<p>Name :- ".ucwords($name)."  ,</p>";
				$html_content	 .= "<p>Email :- ".strtolower($decodeemail)."  ,</p>";
				
				$html_content	 .= "<p>Mobile :- ".$mobile."  ,</p>";
				
				$html_content	 .= "<p>Message :- ".stripslashes($decodemessage)."  .</p>";
			
				$hrmail->Body  	  = $html_content;
				//$hrmail->addAttachment($file_location, $file_name);
				if(!$hrmail->send()){
					//$error	= "Error in sending message.";						
					$message_serve	= "Thankyou";
				}
				
				// Response Mail
				$mail 	= new PHPMailer;				
				$mail->isHTML(true);								
				$mail->IsSMTP();
				$mail->Mailer 	  = "smtp";
				$mail->Host       = "mail.astraladhesives.com"; 
				$mail->SMTPDebug  = 0; 
				$mail->SMTPAuth   = true; 
				$mail->Port       = 587;
				$mail->SMTPSecure = 'TLS';
				$mail->Username   = "marketing@astraladhesives.com"; 
				$mail->Password   = "Adhesives123";		
				$mail->setFrom('marketing@astraladhesives.com', 'Astral Adhesives');		
				$mail->addReplyTo('marketing@astraladhesives.com', 'Astral Adhesives'); 					
				$mail->isHTML(true);
				//$mail->addAddress("tanushree.ganguly@bcwebwise.com", $name);	
				$mail->addAddress(strtolower($decodeemail), $name);								
				$mail->addBCC('tanushree.ganguly@bcwebwise.com', $name);
				
				$mail->Subject  = "Thank you";
				$mail->Body     = '<html>
                                    <head>
                                    <title>Careers</title>
                                    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
                                    </head>
                                    <body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
                                     
                                    <table width="700"   border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#1673BF" style="border:1px solid #000;" >
                                    <tr>
                                        <td height="122" colspan="2" align="left" valign="top">
                                          <a href="https://test.astraladhesives.com"><img src="https://test.astraladhesives.com/assets/images/logo.gif" alt="Astral Adhesives" width="323" height="73" border="0"></a></td>
                                      </tr>
                                      <tr>
                                        <td height="384" colspan="2" align="center"><img src="https://test.astraladhesives.com/assets/images/thankyou.png" width="262" height="262" alt="Careers at Astral Adhesives"></td>
                                      </tr>
                                      <tr>
                                        <td height="184" colspan="2" valign="top"  style="font-family:Arial, Helvetica, sans-serif; font-size:16px; line-height:150%; color:#ffffff; padding-left:99px; padding-right:99px; text-align:center;">Thank you for reaching out to us. We will get in touch with you to address  your queries and / or concern, soon!</td>
                                      </tr>
                                      <tr>
                                        <td width="79">
                                          <img src="https://test.astraladhesives.com/assets/images/corner.gif" width="79" height="74" alt=""></td>
                                        <td width="621" bgcolor="#FFFFFF">
                                        <table id="Table_01" border="0" cellpadding="0" cellspacing="0" style="width: 612px; ">
                                      <tr>
                                        <td width="216" rowspan="2"><a href="http://www.astraladhesives.com/"  style="font-size:22px; font-family:`Times New Roman`, Times, serif;  font-weight:bold; color:#1D69B7; text-decoration:none;" >
                                        www.astraladhesives.com</a></td>
                                      <td width="1" rowspan="2">
                                          <img src="https://test.astraladhesives.com/assets/images/fff_02.gif" width="1" height="52" alt=""></td>
                                      <td width="203" align="center"></td>
                                      <td width="1" rowspan="2">
                                          <img src="https://test.astraladhesives.com/assets/images/fff_04.gif" width="1" height="52" alt=""></td>
                                      <td width="52" rowspan="2">
                                          <a href="https://www.facebook.com/AstralAdhesives/"><img src="https://test.astraladhesives.com/assets/images/fb.gif" alt="facebook" width="45" height="52" border="0"></a></td>
                                      <td width="45" rowspan="2">
                                          <a href="https://twitter.com/astraladhesives"><img src="https://test.astraladhesives.com/assets/images/twitter.gif" alt="twitter" width="45" height="52" border="0"></a></td>
                                      <td width="43" rowspan="2">
                                          <a href="https://www.youtube.com/channel/UC-7wKHr0O_armoSAddVgHIw"><img src="https://test.astraladhesives.com/assets/images/youtube.gif" alt="youtube" width="45" height="52" border="0"></a></td>
                                      <td width="41" rowspan="2">
                                          <a href="https://www.instagram.com/astral_adhesives/"><img src="https://test.astraladhesives.com/assets/images/insta.gif" alt="instagram" width="45" height="52" border="0"></a></td>
                                      </tr>
                                      <tr>
                                        <td width="203" align="center"><a href="tel:7311103331" style="font-size:21px; font-family:`Times New Roman`, Times, serif; color:#1D69B7; font-weight:bold; text-decoration:none;" > <img src="https://test.astraladhesives.com/assets/images/tel.gif" alt="" width="33" height="28" border="0" align="absmiddle"> 7311103331</a></td>  </tr>
                                    </table></td>
                                      </tr>
                                    </table>
                                     
                                    </body>
                                    </html>';
				if(!$mail->send()){					
					$error	= "Thank you";
				}else{
					$error = 'Thank you';
				}				
			}
			$error="Thank you!";	
			$name=$email=$message=$contacttype=$mobile=$decodemessage='';
			}
			
		}
	}
	$page=$objTypes->fetchRow('select * from tbl_pages where id=4');

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
          <a href="<?=base_url?>">Home</a> Contact Us
        </div>
      </section>
      <section>
      	<div class="container">
	          <div class="sect_title inner_title">
	            <h2><span>Contact Us</span></h2>
	          </div>
			<?php echo str_replace("assets",base_url."assets",stripslashes($page['description']));?>
		</div>

		
        <div class="container" id="form_contact">
			<div class="contact_forn_con">
				  <h3>Reach out to us for any query</h3>
				  <div class="errMsg"><?php echo $error;?></div>  
			<form id="enguiry" method="post"action="#form_contact" >
				 <div><input type="hidden" name="data" value="1"></div>
				 <?php echo $token->outputKey(); ?>	
				  <div class="fileldsCon">
				    <div class="fieldHolder"> 
						<select name="contacttype" id="contacttype" class="formSelectBox">
						  <option value="">Select Type</option>
						  <option value="Individual" <?php if($contacttype=="Individual") echo "selected";?>>Individual</option>
						  <option value="Organization" <?php if($contacttype=="Organization") echo "selected";?>>Organization</option>
						</select>
					</div>
					<div class="fieldHolder"><span id="namebox">
						<input type="text" class="formTextBox" name="name" placeholder="Full Name*" onFocus="if (this.value == 'Full Name*') {this.value = '';}" onBlur="if (this.value == '') {this.value = 'Full Name*';}" value="<?php echo $name;?>" id="name"><span></span></span>
					</div>
					<div class="fieldHolder">
						<input type="text" class="formTextBox" name="email" placeholder="Email ID*" onFocus="if (this.value == 'Email ID*') {this.value = '';}" onBlur="if (this.value == '') {this.value = 'Email ID*';}" value="<?php echo $email;?>" id="email">
					</div>
				
					
					<div class="fieldHolder"><span id="mobilebox">
						<input type="text" class="formTextBox" name="mobile" placeholder="Mobile*" onFocus="if (this.value == 'Mobile*') {this.value = '';}" onBlur="if (this.value == '') {this.value = 'Mobile*';}" value="<?php echo $mobile;?>" id="mobile" maxlength="10" onKeyPress="return validateNumbersOnly(event)"><span></span></span>
					</div>
					
					
					<div class="fieldHolder"><span id="messagebox">
						<textarea cols="30" rows="4" class="textArea" placeholder="Message" onFocus="if (this.value == 'Message') {this.value = '';}" onBlur="if (this.value == '') {this.value = 'Message';}" name="description" id="description"><?php echo $decodemessage;?></textarea><span></span></span>
					</div>
				  </div>
				  <div class="btnHolder">
						 <input type="button" class="commanBtn" value="Submit" name="submit" id="contactNow">
					  <!--<a href="javascript:;" class="commanBtn">Know More</a>-->
				  </div>
				</form>
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
    <script type="text/javascript" src="<?=base_url?>assets/js/contact.js"></script>
	
	<script type="text/javascript">
	$(document).ready(function(){
		$('input,textarea').on('keyup',function()
	      {
	      	  $('input,select,textarea').removeClass('errorRed');
	      	  $('.errMsg').text('');
	      	  $('.fieldHolder span span').text(''); 
	          $('input,select,textarea').removeClass('errorblue');
	          $(this).addClass('errorblue');


	       });
	      
	      $('select').on('change',function()
	      {
	      	  $('input,select,textarea').removeClass('errorRed');
	      	  $('.errMsg').text('');
	      	  $('.fieldHolder span span').text(''); 
	          $('input,select').removeClass('errorblue');
	          $(this).addClass('errorblue');

	       });
		 $('#name').keyup(function()
          {
              charactersonly(this);
              $("#name").addClass('errorblue');
              $("#name").focus();
              $("#namebox span").text('Only characters');

          });
         $('#mobile').keyup(function()
          {
              numericsonly(this);
              $("#mobile").addClass('errorblue');
              $("#mobile").focus();
              $("#mobilebox span").text('Only numbers');

          });
         $('#description').keyup(function()
          {
              specificsonly(this);
              $("#description").addClass('errorblue');
              $("#description").focus();
              $("#messagebox span").text('Only specific specialcharacters(.,!)');

          });
          
	})	
	$("#contactNow").on('click',function(){
	$('input,select,textarea').removeClass('errorblue');
	var name 		= $("#name").val().trim();
	var regEx = new RegExp("/[0-9]/");
	
	
	var mobile		= $("#mobile").val().trim();
	
	var contactype	= $("#contacttype").val().trim();
	var email		= $("#email").val().trim();
	var message		= $("#description").val().trim();
	var checkemail  = validateEmailAddress(email);
	$("input").removeClass('errorRed');
	if(name=="" || name=="Full Name*"){
		
		$(".errMsg").text("Please enter full name.");
		$("#name").addClass('errorRed');
		$("#name").focus();
		isOk = false;
		return false;
	}else if(!validateFirstnameLastname(document.getElementById('name'),"Please enter valid name.")) {
		$("#name").addClass('errorRed')
		isOk = false;
	  	return false;
	}else{
		$("#name").removeClass('errorRed');
	}	
//Email Valiudation
	if(email=='' || email=='Email ID*'){
		$(".errMsg").text('Please enter your email address.');
		$("#email").addClass('errorRed')
		$("#email").focus();
		isOk = false;
		return  false;
	}else if(!checkemail && email!=''){
     	$(".errMsg").text('Please enter valid email address.');
		$("#email").addClass('errorRed')
      	$("#email").focus();
		isOk = false;
      	return false;
	}else{
		$("#email").removeClass('errorRed');
	}
	//mobile validation
	if(mobile=="" || mobile=="Mobile*"){
		$(".errMsg").text("Please enter your mobile.");
		$("#mobile").addClass('errorRed');
		$("#mobile").focus();
		isOk = false;
		return false;
	}else{
		
		$("#mobile").removeClass('errorRed');
		
	}
	
	 if (mobile.length != 10) {
        $(".errMsg").text("Please enter valid mobile no.");
		$("#mobile").addClass('errorRed');
		$("#mobile").focus();
		isOk = false;
        return false;
    }
	if(!$.isNumeric(mobile))

		{
			$(".errMsg").text("Please enter valid mobile no.");
			$("#mobile").addClass('errorRed');
			$("#mobile").focus();
			isOk = false;
			return false;
		
		}
	
	
	$("#contactNow").removeAttr('type');
	$("#contactNow").attr('type','submit');
	
	
		
});
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
			jQuery(".errMsg").text(msg);
			obj.focus();
			obj.select();
			return false;
		}
	}

	return true;
}

function validateNumbersOnly(e){
	var unicode = e.charCode ? e.charCode : e.keyCode;
	if ((unicode == 8) || (unicode == 9) || (unicode > 47 && unicode < 58)||(unicode == 43)){
		return true;
	}else{
		//alert("This field accepts only Numbers");
		return false;
	}
}
	</script>
	
    <!--[if lt IE 9]>
        <script src="js/html5shiv.min.js"></script>
    <![endif]-->
  </body>
</html>