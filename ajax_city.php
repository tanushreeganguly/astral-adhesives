<?php include_once('config/config.php'); 

if(!empty($_POST['state']) && ! empty($_POST)){
	// Your Wordpress Functions here...
	$results = $objTypes->fetchAll( "SELECT city FROM tbl_cities WHERE state='".$_POST['state']."' ORDER BY city ASC");
	$city_div= '<option value="">Select City</option>';
	foreach($results as $value){
	
	$city_div.='<option value="'.$value['city'].'">'.ucwords(strtolower($value['city'])).'</option>';
 } 
echo $city_div;

} 
?>
