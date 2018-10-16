<?php 

include_once('config/config.php'); 

if($_POST['country_name']=='India'){
	// Your Wordpress Functions here...
	
	$results = $objTypes->fetchAll("SELECT state FROM tbl_cities GROUP BY state ORDER BY state ASC");
	 $state_div= '<option value="">Select State</option>';
	foreach($results as $value){
		
	
	 $state_div.='<option value="'.$value['state'].'">'.ucwords(strtolower($value['state'])).'</option>';
 }


echo $state_div;

}
?>