<?php
include_once('config/config.php');
include("includes/function.php");


//print_r($_POST);
 if(!empty($_POST)){
	$name     = strip_tags(addslashes(trim($_POST['name'])));
	$address  = strip_tags(addslashes(trim($_POST['address'])));
	$country  = strip_tags(addslashes(trim($_POST['country']))); 
	$state    = strip_tags(addslashes(trim($_POST['state'])));	
	$city     = strip_tags(addslashes(trim($_POST['city'])));
	$zip      = strip_tags(addslashes(trim($_POST['zip'])));
	$phone      = strip_tags(addslashes(trim($_POST['phone'])));
	$mobile   = strip_tags(addslashes(trim($_POST['mobile'])));
	$message  = strip_tags(addslashes(trim($_POST['message'])));
	if($message=="message"){
		$message="";
	}
	
	$email    = strip_tags(addslashes(trim($_POST['email'])));
	$ip       =$_SERVER['REMOTE_ADDR'];
	$agent		= addslashes($_SERVER['HTTP_USER_AGENT']);
	$error		 	= '';
	$flag		 	= true;
	
	$params = array(
				'name'	=> $name,
				'address'	=> $address,
				'country'	=> $country,
				'state'	=> $state,
				'city'	=> $city,
				'email'	=> $email,
				'mobile'	=> $mobile,
				'phone'	=> $phone,
				'zip'	=> $zip,
				'inquiry_message'	=> $message,
				'ip'	=> $ip,
				'agent'	=> $agent
			 );
	
	$insert = $objTypes->insert("tbl_contact", $params);
		if($insert){
			 $insert_id = $objTypes->lastInsertId();
		}
			
		if($insert_id>0)
			{
			$from			 ='tanushree.ganguly@bcwebwise.com';
			$to_recipients	='tanushree.ganguly@bcwebwise.com';		
			$subject 		 ='Enquiry now - Astral Adhesive';
	
			$message = '<table width="600" border="0" cellspacing="2" cellpadding="2" style="font-family:Tahoma, Arial,Verdana, serif; font-size:12px;">					
						<tr>
						<td><table width="95%" border="0" align="center" cellspacing="2" cellpadding="2">      
						<tr><td>&nbsp;</td></tr>
						<tr><td><strong><u>Corporate Sales :-</u></strong></td></tr>
						<tr><td>&nbsp;</td></tr><tr><td><b>Name : </b>'.$name.'</td></tr>
						<tr><td>&nbsp;</td></tr>
						
						<tr><td>&nbsp;</td></tr>						  
						<tr><td>&nbsp;</td></tr>					
						</table></td>
						</tr>
						<tr>
						<td height="30" bgcolor="#CCCCCC"><table width="562" border="0" align="center" cellpadding="0" cellspacing="0">
						  <tr>
							<td style="color:#FFFFFF; font-size:10px; font-family:Tahoma, Arial, Verdana;">Copyright Hero MotoCorp Ltd '.date("Y").'. All Rights Reserved.</td>
							</tr>
						</table></td>
						</tr>
					</table>';
				
				
				if(!class_exists('PHPMailer')){
					if(!require_once('include/PHPMailer/PHPMailerAutoload.php')){
						die('PHPMailer Class Does not Exists!');
					}
					else{
						$mail = new PHPMailer;
					}
				}
				
				$mail->isSMTP();
				$mail->SMTPDebug = 0;
				$mail->Host = 'smtp-relay.gmail.com';
				$mail->SMTPAuth = false;
				$mail->SMTPSecure = 'tls';
				$mail->Port = 587;
				$mail->setFrom($from, 'Astral Adhesive');
				$mail->addReplyTo($to_recipients, 'Astral Adhesive');
				$mail->addBCC('tanushree.ganguly@bcwebwise.com', '');
				$mail->From = $from;
				$mail->FromName = 'Astral Adhesive';
				$mail->isHTML(true);
				$mail->Subject = $subject;
				$mail->Body    = $message;
				/*if($mail->send()){
				echo "Successfull";
				}*/
				echo $msg=1;
			}
 }
?>