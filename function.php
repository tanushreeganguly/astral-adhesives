<?php



# Get the value from POST or GET Methods.

#########################################################################################################

function get_param($ParamName)

{

  global $_POST;

  global $_GET;



  $ParamValue = "";

  if(isset($_POST[$ParamName]))

    $ParamValue = $_POST[$ParamName];

  else if(isset($_GET[$ParamName]))

    $ParamValue = $_GET[$ParamName];



  return $ParamValue;

}



// Function checking the decimal number

#########################################################################################################

function CheckTelePhoneNumber($txtValue)

{

	$VALID_CHARS_NUM    = "0123456789 -";

	for ($z=0;$z<strlen($txtValue);$z++)

	{

		for ($i=0;$i<strlen($VALID_CHARS_NUM)+1;$i++)

    {

			if ($i==strlen($VALID_CHARS_NUM))

				return(FALSE);

			if ($VALID_CHARS_NUM[$i]==$txtValue[$z])

				break;

			else

				continue;

		}

	}

	return(TRUE);

}



function validateUsernameWithSpace($txtValue)

{

	$VALID_CHARS_NUM    = " _abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

	for ($z=0;$z<strlen($txtValue);$z++)

	{

		for ($i=0;$i<strlen($VALID_CHARS_NUM)+1;$i++)

    {

			if ($i==strlen($VALID_CHARS_NUM))

				return(FALSE);

			if ($VALID_CHARS_NUM[$i]==$txtValue[$z])

				break;

			else

				continue;

		}

	}

	return(TRUE);

}

# Following function validates for email address.

#########################################################################################################

function validateEmail($email)

{

	return ereg("^([_a-zA-Z0-9]+([\\._a-zA-Z0-9-]+)*)@([_a-zA-Z0-9-]{2,}(\\.[_a-zA-Z0-9-]{2,})*\\.[a-zA-Z]{2,3})$", $email);

}




function valid_email($email)
{
	return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) ? FALSE : TRUE;
}

function alpha($address)
{
	return ( ! preg_match("/^([a-z0-9 . , -\/])+$/i", $address)) ? FALSE : TRUE;
	//return (!preg_match("/^[a-zA-Z0-9\s \/,_.&?@!-]{1,120}+$/",$address)) ? FALSE : TRUE;
}


function html_specialchars($text)

{

   $pattern=array(">", "<", "\"", "\&", "$", "»","'", "¯" );

   $replacement=array("&gt;", "&lt;", "&quot;", "&amp;", "&#36;", "&raquo;", "&apos;" ,"&macr;");

   $text = str_replace($pattern, $replacement, $text);

   return $text;

}





function cleanup($str)

{ 

	$str = str_replace("\\","",$str);

 	return $str;

}



function unhtmlentities ($string)

{	

	$search = array ("'<script[^>]*?>.*?</script>'si","'<[\/\!]*?[^<>]*?>'si","'([\r\n])[\s]+'","'&(quot|#34);'i","'&(amp|#38);'i","'&(lt|#60);'i","'&(gt|#62);'i","'&(nbsp|#160);'i","'&(iexcl|#161);'i","'&(cent|#162);'i","'&(pound|#163);'i","'&(copy|#169);'i","'&#(\d+);'e");

	$replace = array ("","","\\1","\"","&","<",">"," ",chr(161),chr(162),chr(163),chr(169),"chr(\\1)");

	$text = preg_replace ($search, $replace, $string);

	return $text;	

}



		function Custom_editor_function($data)
	{
		$htmal_tags		='<div><p><a><b><ul><li><img>';
		$Custom_data 	= strip_tags($data, $htmal_tags);
		$str 			= trim(addslashes(strip_tags(htmlspecialchars_decode($data), $htmal_tags))); 
		return $str;
	}




#=====================make url=============================#

function make_url($url_type, $id, $pre_fix)

{

	//$site_url = "http://techphp/heromotocorptest/";

	$returnValue = "";

	$pre_fix = strtolower(trim($pre_fix));

	

	if($url_type == "about-us")

	{

		$url_type = "2";

	}

	if($url_type == "view-annual-report-archives")

	{

		$url_type = "2";

	}

	

	if(strlen(trim($url_type)) > 0 && strlen(trim($id)) > 0 && strlen(trim($pre_fix)) > 0)

	{

			$site_url= "http://203.109.120.54/heromotocorptest/";

			$pre_fix = str_replace(" & ","-and-", $pre_fix);

			$pre_fix = str_replace("&","-and-", $pre_fix);

			$pre_fix = str_replace(" ","-", $pre_fix);

			$pre_fix = str_replace("","-at-", $pre_fix);

			$pre_fix = str_replace("","", $pre_fix);

			$pre_fix = str_replace("'","", $pre_fix);

			$pre_fix = str_replace("%","", $pre_fix);

			$pre_fix = str_replace(")","", $pre_fix);

			$pre_fix = str_replace("(","", $pre_fix);

			$pre_fix = str_replace("","", $pre_fix);

			$pre_fix = ereg_replace("[ ~!@#$%^&*()_+=|{}:\"'\<,\>.?\/]", '', $pre_fix);

			$pre_fix = ereg_replace("[?]", '', $pre_fix);

			

			$returnValue =$site_url.urlencode($pre_fix)."_".$url_type."_".$id.".html";

		

	}

	return $returnValue;

}















?>
