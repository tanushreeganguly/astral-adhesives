<?php
include("includes/function.php");


require_once('htmlpurifier/HTMLPurifier.auto.php');    
$purifier 	= new HTMLPurifier();

function noHTML($input, $encoding = 'UTF-8') {
   return htmlentities($input, ENT_QUOTES | ENT_HTML5, $encoding);
}


//print_r($_POST);
 if(!empty($_POST)){
	$name     = noHTML(strip_tags(addslashes(trim($_POST['name']))));
	$address  = noHTML(strip_tags(addslashes(trim($_POST['address']))));
	$country  = noHTML(strip_tags(addslashes(trim($_POST['country'])))); 
	$state    = noHTML(strip_tags(addslashes(trim($_POST['state']))));	
	$city     = noHTML(strip_tags(addslashes(trim($_POST['city']))));
	$zip      = noHTML(strip_tags(addslashes(trim($_POST['zip']))));
	$mobile   = noHTML(strip_tags(addslashes(trim($_POST['mobile']))));
	$message  = noHTML(strip_tags(addslashes(trim($_POST['message']))));
	$enquiry_for  = noHTML(strip_tags(addslashes(trim($_POST['enquiry_for']))));
	$email    = noHTML(strip_tags(addslashes(trim($_POST['email']))));
	$dob      = noHTML(strip_tags(addslashes(trim($_POST['dob']))));
	$ip       =$_SERVER['REMOTE_ADDR'];
	$error		 	= '';
	$flag		 	= true;
	
	if(strlen($error)<=0) 
		{
			if($name =='') 
			{		
				$error.="Please enter name"; 
				$flag=false;
			}
			if($name!='') 
			{ 
				if(!preg_match("/^[a-zA-Z ]{1,50}+$/",$name)) 
				{
					$error.="Please enter valid name"; 
					$flag =false;
				}
			}
			
			if($txtAddress=='') 
			{		
				$error.="Please enter address"; 
				$flag=false;
			}
			if($txtAddress!='') 
			{ 	
				//if(!preg_match("/^[a-zA-Z0-9,&().\/\- ]{1,50}+$/",$decodetxtAddress)) 
				if(!preg_match("/^[a-zA-Z0-9\,\(\)\&\.\/\- ]{1,250}+$/",$decodetxtAddress))
				{
					$error.="Please enter valid address, allowed specialcharacters (,()&./-) with max 250 characters";
					$flag=false;
				}
			}
			
			if($country=='') 
			{		
				$error.="Please enter country"; 
				$flag=false;
			}
			
			if($state=='') 
			{		
				$error.="Please enter state"; 
				$flag=false;
			}
			if($city=='') 
			{		
				$error.="Please enter city"; 
				$flag=false;
			}
			if($zip=='') 
			{		
				$error.="Please enter zip"; 
				$flag=false;
			}
			
			if($zip!='') 
			{ 
				if(!preg_match("/^[0-9]{4,8}+$/",$zip)) 
				{
					$error="Plesae enter valid pin minimum 4 digits maximum 8 digits numeric";
					$flag=false;
				}
			}
			if($mobile=='') 
			{		
				$error.="Please enter mobile"; 
				$flag=false;
			}
			if($mobile!='') 
			{ 
				if(strlen($mobile)!='10')
				{ 
					$error.="Please Enter 10 Digit Mobile.";
					$flag=false;
					
				}
				if(!preg_match("/^[0-9]{10}+$/",$mobile)) 
				{
					$error.="Plesae enter valid mobile number with max 10 digit";
					$flag=false;
				}
			}
			if($email=='') 
			{		
				$error.="Please enter mobile"; 
				$flag=false;
			}
		}
		
	
	
 }
?>