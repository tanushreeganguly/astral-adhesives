<?php include_once('config/config.php'); 

if(!class_exists('FormToken'))
{
	if(!require_once('include/form_token.php')){
		die('Class FormToken Not Exists.');
	}else{
		$token = new FormToken();
	}
}
$POST	= $objTypes->validateUserInput($_REQUEST);
if(isset($POST['data']) && $POST['data']=='1')
{
	$name 	 = addslashes(strip_tags($POST['name']));
	$email	 = addslashes(strip_tags($POST['email']));
	$mobile  = addslashes(strip_tags($POST['mobile']));
	$phone   = addslashes(strip_tags($POST['phone']));
	$address = addslashes(strip_tags($POST['address']));
	$contacttype = addslashes(strip_tags($POST['contacttype']));
	$product = addslashes(strip_tags($POST['product']));
	$zip 	 = addslashes(strip_tags($POST['zip']));
	$country = addslashes(strip_tags($POST['country']));
	$state 	 = addslashes(strip_tags($POST['state']));
	$city 	 = addslashes(strip_tags($POST['city']));
	$message = addslashes(strip_tags($POST['description']));
	
	$error		= "";
	$flag		= true;
	
	if($token->validateKey() == false){
		$error = "There is some problem, please try again.";		
		$flag  = false;
	}
	
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
	if($email=="" ){
		$error 	= "Please enter email id";
		$flag	= false;
		$ser_eclass = "email";
	}elseif(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,8})$/",$email)){
		$error 	= "Please enter valid email id";
		$flag	= false;
		$ser_eclass = "email";
	}
	if($mobile=="" ){
		$error 	= "Please enter mobile number";
		$flag	= false;
		$ser_pclass = "phone";
	}
	if($address!=""){
		if(!preg_match('/^[a-zA-Z0-9-!,. ]+$/',$address)){
			$error 	= "Please enter valid address";
			$flag	= false;
			$ser_lclass = "location";
		}
	}
	if($country!=""){
		if(!preg_match('/^[a-zA-Z ]+$/',$country)){
			$error 	= "Please enter valid country";
			$flag	= false;
			$ser_nclass = "name";
		}
		if(strlen($country) > '75'){
			$error 	= "Please enter valid country";
			$flag	= false;
			$ser_nclass = "name";
		}
	}
	if($state!=""){
		if(!preg_match('/^[a-zA-Z ]+$/',$state)){
			$error 	= "Please enter valid state";
			$flag	= false;
			$ser_nclass = "name";
		}
		if(strlen($state) > '75'){
			$error 	= "Please enter valid state";
			$flag	= false;
			$ser_nclass = "name";
		}
	}
	if($city!=""){
		if(!preg_match('/^[a-zA-Z ]+$/',$city)){
			$error 	= "Please enter valid city";
			$flag	= false;
			$ser_nclass = "name";
		}
		if(strlen($city) > '75'){
			$error 	= "Please enter valid city";
			$flag	= false;
			$ser_nclass = "name";
		}
	}
	if($message!=""){
		if(!preg_match('/^[a-zA-Z0-9-!., ]+$/',$message)){
			$error 	= "Please enter valid message";
			$flag	= false;
			$ser_mclass = "message";
		}
		if(strlen($message) > '200'){
			$error 	= "Please enter valid message";
			$flag	= false;
			$ser_mclass = "message";
		}
	}
	
	if($flag==true && strlen($error)<=0){
		$InsertArray = array(
							'name'		=> $name,
							'email'		=> $email,
							'phone' 	=> $phone,
							'mobile' 	=> $mobile,
							'address'	=> $address,
							'zip'	    => $zip,
							'message'	=> $message,
							'country'	=> $country,
							'state' 	=> $state,
							'product' 	=> $product,
							'contacttype'=> $contacttype,
							'city'	    => $city,
							'ip'		=> $_SERVER['REMOTE_ADDR'],
							'agent'     => addslashes($_SERVER['HTTP_USER_AGENT'])
							);
							
		$insert_serve = $objTypes->insert("tbl_contact", $InsertArray);
		if($insert_serve)
		{
			$insert_serve_id = $objTypes->lastInsertId();			
			if(isset($insert_serve_id) && $insert_serve_id > 0){
								
				require ('include/PHPMailer/PHPMailerAutoload.php');									
				//Gemini Mail			
				$hrmail = new PHPMailer;
				$hrmail->isHTML(true);
				$hrmail->IsSMTP();
				$hrmail->Mailer 	= "smtp";
				$hrmail->Host       = "astraladhesive.com"; 
				$hrmail->SMTPDebug  = 0; 
				$hrmail->SMTPAuth   = true; 
				$hrmail->Port       = 25;
				$hrmail->SMTPSecure = 'TLS';
				$hrmail->Username   = "info@astraladhesive.com";
				$hrmail->Password   = "info123!@#";							
				$hrmail->setFrom('info@geminiindia.com', 'Astral Adhesives');
				$hrmail->addReplyTo(strtolower($email), $name); 	
			
				$hrmail->addAddress('info@geminiindia.com', 'Astral Adhesives');				
				//$hrmail->addBCC('santhosh.nair@bcwebwise.com', 'Santhosh');
				//$hrmail->addBCC('mitul.jagushte@bcwebwise.com', 'Mitul Jagushte');					
	
				$hrmail->Subject  = 'Enquiry received from '.ucwords($name_ser).' - '.date("jS F Y");
				$html_content     = "<p><b>Contact information - To serve you better.</b></p>";						
				$html_content	 .= "<p>Name :- ".ucwords($name)."  ,</p>";
				$html_content	 .= "<p>Email :- ".strtolower($email)."  ,</p>";
				$html_content	 .= "<p>Mobile :- ".$phone."  ,</p>";
				$html_content	 .= "<p>Mobile :- ".$mobile."  ,</p>";
				$html_content	 .= "<p>Location :- ".stripslashes($address)."  ,</p>";
				$html_content	 .= "<p>Message :- ".stripslashes($message)."  .</p>";
			
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
				$mail->Host       = "astraladhesive.com"; 
				$mail->SMTPDebug  = 0; 
				$mail->SMTPAuth   = true; 
				$mail->Port       = 25;
				$mail->SMTPSecure = 'TLS';
				$mail->Username   = "info@astraladhesive.com"; 
				$mail->Password   = "info123!@#";		
				$mail->setFrom('info@geminiindia.com', 'Gemini Power Hydraulics');		
				$mail->addReplyTo('info@geminiindia.com', 'Gemini Power Hydraulics'); 					
				$mail->isHTML(true);

				$mail->addAddress(strtolower($email_ser), $name_ser);								
				//$mail->addBCC('santhosh.nair@bcwebwise.com', 'Santhosh');
				
				$mail->Subject  = "Thank you";
				$mail->Body     = "We appreciate your interest in our services. Our team will get in touch with you shortly.";
				
				if(!$mail->send()){					
					$message_serve	= "Thankyou";
				}else{
					$message_serve = 'Thankyou';
				}				
			}
				
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
  <!--link href="assets/images/favicon.ico" rel="shortcut icon" type="" /-->
  <link href="assets/css/main.css" rel="stylesheet" type="text/css">
  <link href="assets/css/owl.carousel.min.css" rel="stylesheet" type="text/css">
  <link href="assets/css/direction-reveal.css" rel="stylesheet" type="text/css">
  <script type="text/javascript" src="<?=base_url?>js/jquery-1.12.1.min.js"></script>
  <script type="text/javascript">
  
  $(document).ready(function(){
	  $("#stateInput").hide();
	  $("#cityInput").hide();
  	$("#country").on('change',function(){
				
			var country_name=$("#country").val();
			if(country_name=="India"){
				  $("#stateInput").hide();
				  $("#cityInput").hide();
				  
				  $("#state").show();
				$.ajax({
					type: 'POST',
					url: 'statedetail.php',
					data: {'country_name' : country_name},		
					success:function(response){	
							 $("#city").show();
	  						 $("#state").html(response);
							 $("#state").on('change',function(){
								var state=$("#state").val();
								
								$("#city").html('<option value="">Select City*</option>');	
								
									
									$.ajax({
										type: 'POST',
										url: 'ajax_city.php',
										data: {'state' : state},		
										success:function(response){	
																				
											jQuery(".city").html(response);
										}
									});
								
							});
						}
				});
				
				
	}else{
		
		$("#state").hide();
		$("#stateInput").show();
		$("#city").hide();
		$("#cityInput").show();
		
	}
			
		});
  });
  </script>
  </head>

  <body>

    <div id="wrapper">

     <?php include_once('include/header.php'); ?>
  <section id="enquirysection" style="position:relative;align:right;">
        <div>
		<div>Contact Us</div>
		<div class="errMsg"></div>  
		<form id="enguiry"  method="post" >
			<div><input type="hidden" name="data" value="1"></div>
			<table cellspacing="0" width="500">
				<tr>
				<td>
					<select class="round" name="contacttype" id="contacttype">
					  <option value="">Select Type</option>
					  <option value="Individual" >Individual</option>
					  <option value="Organization" >Organization</option>
					</select>
				</td></tr>
				<tr><td><input type="text" name="name" placeholder="Full Name" onFocus="if (this.value == 'Full Name*') {this.value = '';}" onBlur="if (this.value == '') {this.value = 'Full Name*';}" value="Full Name*" id="name"></td></tr>
				<tr><td><textarea rows="2" cols="40" class="textareasec" placeholder="Address" onFocus="if (this.value == 'Address') {this.value = '';}" onBlur="if (this.value == '') {this.value = 'Address';}" name="address" id="address"></textarea>
				</td></tr>
				<tr>
				<td>
					<select class="round" name="country" id="country">
					  <option value="">Select Country</option>
					  <option value="India" <?php if($country=='India') echo 'selected';?>>India</option>
					  <option value="Us" <?php if($country=='Us') echo 'selected';?>>Us</option>
					</select>
				</td></tr>
				<tr>
				<td>
					<select class="round" name="state" id="state">
						<option value="">Select State</option>
					</select>
					 <input type="text" class="user stateInput" placeholder="State" required onFocus="if (this.value == 'State') {this.value = '';}" onBlur="if (this.value == '') {this.value = 'State';}" name="stateInput" id="stateInput" value="State">

				</td>

				</tr>
				<tr>
				<td>
					<select class="round city" name="city" id="city">
						<option value="">Select City</option>
					</select>
					 <input type="text" class="user cityInput" placeholder="City" required onFocus="if (this.value == 'City') {this.value = '';}" onBlur="if (this.value == '') {this.value = 'City';}" name="cityInput" id="cityInput" value="City">

				</td>
				</tr>
				<tr><td><input type="text" name="product" placeholder="Product" onFocus="if (this.value == 'Product') {this.value = '';}" onBlur="if (this.value == '') {this.value = 'Product';}" value="" id="product"></td></tr>
				
				<tr><td><input type="text" name="zip" placeholder="Zip" onFocus="if (this.value == 'Zip') {this.value = '';}" onBlur="if (this.value == '') {this.value = 'Zip';}" value="Zip" id="zip" maxlength="8" onKeyPress="return validateNumbersOnly(event)"></td></tr>
				<tr><td><input type="text" name="phone" placeholder="Phone" onFocus="if (this.value == 'Phone') {this.value = '';}" onBlur="if (this.value == '') {this.value = 'Phone';}" value="" id="phone" maxlength="12" onKeyPress="return validateNumbersOnly(event)"></td></tr>
				
				<tr><td><input type="text" name="mobile" placeholder="Mobile*" onFocus="if (this.value == 'Mobile*') {this.value = '';}" onBlur="if (this.value == '') {this.value = 'Mobile*';}" value="Mobile*" id="mobile" maxlength="10" onKeyPress="return validateNumbersOnly(event)"></td></tr>
				<tr><td><input type="text" name="email" placeholder="Email ID*" onFocus="if (this.value == 'Email ID*') {this.value = '';}" onBlur="if (this.value == '') {this.value = 'Email ID*';}" value="Email ID*" id="email"></td></tr>
			  
				
				<tr><td><textarea rows="2" cols="40" class="textareasec" placeholder="Message" onFocus="if (this.value == 'Message') {this.value = '';}" onBlur="if (this.value == '') {this.value = 'Message';}" name="description" id="description"></textarea>
				</td></tr>
				
				<tr><td></td></tr>
				<tr><td> <input type="button" value="SUBMIT" name="submit" id="enquireNow"></td></tr>
			</table>
			</form>
		</div>
		</section>
      
      <?php include_once('include/footer.php'); ?>

    </div>

    <!--JS Files-->
    <script type="text/javascript" src="assets/js/jquery-1.12.1.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.easing.1.3.js"></script>
    <script type="text/javascript" src="assets/js/modernizr-custom.js"></script>
    <script type="text/javascript" src="assets/js/TweenMax.min.js"></script>
    <script type="text/javascript" src="assets/js/jquery.slimmenu.min.js"></script>
    <script type="text/javascript" src="assets/js/owl.carousel-beta.js"></script>
    <script type="text/javascript" src="assets/js/ScrollMagic.js"></script>
    <script type="text/javascript" src="assets/js/animation.gsap.js"></script>
    <script type="text/javascript" src="assets/js/debug.addIndicators.js"></script> 
    <script type="text/javascript" src="assets/js/common.js"></script>
    <script type="text/javascript" src="assets/js/about-us.js"></script>
	<script type="text/javascript">
	$("#enquireNow").on('click',function(){
	
	var name 		= $("#name").val().trim();
	var regEx = new RegExp("/[0-9]/");
	
	var address     = $("#address").val().trim();
	var country		= $("#country").val().trim();
	if(country=='India'){
		var state 	= jQuery("#state").val().trim();
		var city 	= jQuery("#city").val().trim();		
	}else if(country!='India' && country.length>1){
		var state 	= jQuery("#stateInput").val().trim();;
		var city 	= jQuery("#cityInput").val().trim();
	}
	
	var zip			= $("#zip").val().trim();
	var mobile		= $("#mobile").val().trim();
	var phone		= $("#phone").val().trim();
	var product		= $("#product").val().trim();
	var contactype	= $("#contacttype").val().trim();
	var email		= $("#email").val().trim();
	var message		= $("#description").val().trim();
	var checkemail  = validateEmailAddress(email);
	
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

	if(mobile=="" || mobile=="Mobile*"){
		$(".errMsg").text("Please enter your mobile.");
		$("#mobile").addClass('errorRed');
		$("#mobile").focus();
		isOk = false;
		return false;
	}else{
		
		$("#mobile").removeClass('errorRed');
		
	}
	
	 if ($("#mobile").val().length != 10) {
       $(".errMsg").text("Please enter valid mobile no.");
		$("#mobile").addClass('errorRed');
		$("#mobile").focus();
		isOk = false;
        return false;
    }
	if(phone!=""){
		if ($("#phone").val().length<6) {
		   $(".errMsg").text("Please enter valid phone no.");
			$("#phone").addClass('errorRed');
			$("#phone").focus();
			isOk = false;
			return false;
		}
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
	
	$("#enquireNow").removeAttr('type');
	$("#enquireNow").attr('type','submit');
	
	
		/*$.ajax({
					type: 'POST',
					url: 'sendcontact.php',
					data: {'name' : name,'email':email,'address':address,'zip':zip,'mobile':mobile,'product':product,
					'message':message,'country':country,'state':state,'city':city,'contactype':contactype},		
					success:function(response){	
						
							if(response==1)	
							{
								$('#enquirysection').hide();
								$('#message_section').show();
							}
							
						}
				});*/
	
});
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