<?php
require_once(dirname(__FILE__) . '/wp-config.php');
//$wp->init();
//$wp->parse_request();
//$wp->query_posts();
//$wp->register_globals();
//$wp->send_headers();
// Your Wordpress Functions here...
//$results = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}options WHERE option_id = 1", OBJECT );

if(!empty($_POST['submit']) && $_POST['submit']=='SUBMIT' && ! empty( $_POST))
{
	
	$name 		= strip_tags(trim($_POST['name']));
	$email 		= strip_tags(trim($_POST['email']));
	$mobile		= strip_tags(trim($_POST['mobile']));
	//$country 	= strip_tags(trim($_POST['country']));
	//$state 		= strip_tags(trim($_POST['state']));
	//$city 		= strip_tags(trim($_POST['city']));
	//$enquireFor = strip_tags(trim($_POST['enquireFor']));
	//$ourBrands	= strip_tags(trim($_POST['ourBrands']));	
	$description= addslashes(strip_tags(trim($_POST['description'])));
	
	$ip     	= $_SERVER['REMOTE_ADDR'];
	$agent  	= addslashes($_SERVER['HTTP_USER_AGENT']);
	$flag   	= true;
	$error 		= "";
	
	// Common Validation Settings
	if($name=="Full Name*"){$name="";}
	if($email=="Email ID*"){$email="";}
	if($mobile=="Mobile Number*"){$mobile="";}
	//if($city=="City*"){$city="";}
	if($description=="Message*"){$description="";}
	
	
	// Name Validation.
	if (strlen($name)<1 && strlen($error)<1) {
		$error	= "Please enter full name.";
		$flag	= false;
	}else if(!preg_match('/^[a-z\s]{1,35}$/i',$name) && strlen($error)<1){
		$error 	= "Please enter valid name.";
		$flag	= false;
	}
	
	//Email Validation.
	if (strlen($email)<1 && strlen($error)<1) {
		$error	= "Please enter your email address.";
		$flag	= false;
	}else if(!filter_var($email,FILTER_VALIDATE_EMAIL) && strlen($error)<1){
		$error	= "Please enter valid email address.";
		$flag	= false;
	}
	
	//Phone Number Validation.
	if (strlen($mobile)<1 && strlen($error)<1) {
		$error	= "Please enter mobile number.";
		$flag	= false;
	}else if(!preg_match('/^[0-9]{8,12}+$/',$mobile) && strlen($error)<1){
		$error	= "Please enter valid mobile number.";
		$flag	= false;
	}
	
	// Enquire Now Validation.
	/*if (strlen($enquireFor)<1 && strlen($error)<1) {
		$error	= "Please select enquiry type.";
		$flag	= false;
	}else if(in_array($enquireFor, array('Admissions','Franchise')) == FALSE && strlen($error)<1){
			$error="Plesae select valid  enquiry type."; $flag=false;	
	}*/
	
	// Our Brands Validation.
	/*if (strlen($ourBrands)<1 && strlen($error)<1) {
		$error	= "Please select school.";
		$flag	= false;
	}else if(in_array($ourBrands, array('Billabong','Kangaroo Kids')) == FALSE && strlen($error)<1){
		$error="Plesae select valid  school."; $flag=false;	
	}*/
	
	//Country Validation.
	/*if (strlen($country)<1 && strlen($error)<1) {
		$error	= "Please select your country.";
		$flag	= false;
	}else if(!preg_match('/^[a-z\s]{1,150}$/i',$country) && strlen($error)<1){
		$error 	= "Please enter valid country name";
		$flag	= false;
	}
	
	if($country == 'India'){
		//State Validation.
		if (strlen($state)<1 && strlen($error)<1) {
			$error	= "Please select your state.";
			$flag	= false;
		}else if(!preg_match('/^[a-z \s]{1,150}$/i',$state) && strlen($error)<1){
			$error 	= "Please enter valid state name";
			$flag	= false;
		}
		//City Validation
		if (strlen($city)<1 && strlen($error)<1) {
			$error	= "Please select your city.";
			$flag	= false;
		}else if(!preg_match('/^[a-z \s]{1,150}$/i',$city) && strlen($error)<1){
			$error 	= "Please enter valid city name";
			$flag	= false;
		}
	}else{
		//City Validation
		if (strlen($state)>1 && strlen($error)<1) {
			$error	= "Please select valid country.";
			$flag	= false;
		}
		
		if (strlen($city)<1 && strlen($error)<1) {
			$error	= "Please enter your city.";
			$flag	= false;
		}else if(!preg_match('/^[a-z\s]{1,150}$/i',$city) && strlen($error)<1){
			$error 	= "Please enter valid city name";
			$flag	= false;
		}
	}*/
	
	//Description Validation.
	if (strlen($description)<1 && strlen($error)<1) {
		$error	= "Please enter your message.";
		$flag	= false;
	}
	
	// For VCalid User.
	if($flag==true && strlen($error)<1){
		$table 	= "{$wpdb->prefix}enquire_now";		
		$data 	= array(
					  //'enquireFor'	=> $enquireFor,
					  //'ourBrands'	=> $ourBrands,
					  'name'		=> $name,
					  'email'		=> strtolower($email),
					  'mobile'		=> $mobile,
					 //'country'		=> $country,
					 //'state'		=> $state,
					 //'city'		=> $city,
					  'description'	=> $description,
					  'ip'			=> $ip,
					  'agent'		=> $agent
					 );
		$format	= array('%s', '%s', '%s', '%s', '%s', '%s');
		$wpdb->insert($table, $data, $format);
		$insert_id = $wpdb->insert_id;
		if($insert_id>0){
			
		//$to = 'santhosh.nair@bcwebwise.com';
		$to = "pune.nigdi@kangarookids.co.in";
		$from='noreply@kangarookids.in';
		$subject = "Query/Feedback";
		$headers = 'MIME-Version: 1.0'."\r";
		$headers .= 'Content-type: text/html;charset=iso-8859-1'."\r";
		$headers .= 'From: '.$from. "\r\n";
		$headers .= 'Reply-To: noreply@kangarookids.in'."\r";
		$headers .= 'Cc:noreply@kangarookids.in'."\r";
		//$headers .= 'Bcc: santhosh.nair@bcwebwise.com'."\r";
    
		$message ="<html>                 
					<head></head>                                                                                                
						<body>
						<center><h3><u> <strong> Info</strong> </u></h3></center><br/> 
						  <table align='center' border='1' cellpadding='5' cellspacing='0' width='80%'>
							<tbody>
							  <tr>
									<td  class='text' width='30%' valign='top'><strong>Full Name</strong> </td>
									<td  class='text' width='50%'valign='top'>$name</td>
							   </tr> 
							   <tr>
								   <td class='text' width='30%'valign='top'><strong>Email</strong></td>
									<td class='text' width='50%'valign='top'>$email</td>
							   </tr> 
							   <tr>
									<td class='text'width='30%' valign='top'><strong>Phone</strong> </td>
									<td class='text' width='50%' valign='top'>$mobile</td>
							   </tr>
								
								<tr>
									<td class='text'width='30%' valign='top'><strong>Query</strong> </td>
									<td class='text' width='50%' valign='top'>$description </td>
								</tr>
							 </tbody>
						   </table>
					</body>
			</html>";

      		mail($to, $subject, $message, $headers);
			
	   		//if email sent 
			echo "<div align='center' style='color: orange; margin-top:100px; font-size: 25px;'>Thank you for sending your feedback.<br />";
			echo "We will get back to you <br />";
			echo "<span class='bodytext_grey'>you will be redirected in 5 seconds</span>";
			//echo "<a href='http://kkel.com/' style='color:#0E3E88;font-size:20px'>HOME</a></div>";
			
			//Send email to user
			$subject_second = "Thank you for contacting Kangaroo Kids International Preschool";
			$to_second = $email;
			$headers_second  = 'MIME-Version: 1.0' . "\r\n";
			$headers_second .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers_second .= 'From: '.$from. "\r\n";
			
			$msg_second ="<html>                 
							<body>
								<b>Dear $name </b><br /><br />
								Thank you for contacting <span style='color:blue'>Kangaroo Kids Education Ltd.</span><br /><br /><br />
								We will contact you shortly. Please note down our address and phone numbers. <br /><br /><br />
								<span style='color:blue'>Kangaroo Kids Education Ltd.</span><br />
								301 Mamta House,<br />
								231 S V Road,<br />
								Bandra (W),<br />
								Mumbai - 400 050.<br /><br />
								Tel.: (+91 22) 6658 3000
								
							</body>
						 </html>";
						 
						 
			$msg_second ="<html>                 
							<body>
								<b>Dear $name </b><br /><br />
								We have received you details and will connect with you shortly.<br /><br />
								Please click on the map pins on the link below to get the relevant address and walk in to our school directly.<br /><br />
								
								<a href='http://www.kangarookids.in/contact-us.html' target='_blank'>http://www.kangarookids.in/contact-us.html</a> <br /><br />
								Thanks and Regards,<br /><br />
								Kangaroo Kids International Preschool.<br /><br />
							
								
							</body>
						 </html>";			 
			
			mail($to_second, $subject_second, $msg_second, $headers_second);
			
			
			//CRM START HERE.
			$postData = array(
							'name'=>$name,
							'type'=>'Admissions',
							'contactnumber'=>$mobile,
							'email'=>$email,
							'message' =>$description,
							'admission_type' =>'KK',					
							'lead_source' => 'kangarookids.in',
							'primary_address_city' => 'Pune',
							'primary_address_state' => 'Maharashtra',	
							'centre' => 'Kangaroo Kids International Preschool - Nigdi',	
							'primary_address_country' => 'India',			
							);

			$postData = json_encode($postData);
			//print_r($postData);
  
			//$url = 'http://161.202.21.7/kkel/dev/index.php?entryPoint=crmapi';
			$url = 'https://kkel.simplecrmondemand.com/index.php?entryPoint=crmapi';
			
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch,CURLOPT_HTTPHEADER, array(
													'AuthorizedApplication:kK3L$32!','RequestedMethod:Create','RequestedModule:Lead',
							   						'Content-Type: application/json',
						   							'Content-Length: ' . strlen($postData))
			 );
			$result = curl_exec($ch);
			curl_close($ch);

			echo '1~Thank you for contacting us !'; exit();
	
		}else{
			echo '0~Something went wrong.Please try again.'; exit();
		}
	}else{
		print '0~'.$error; exit();
	}
	
	
}

?>