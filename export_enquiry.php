<?php
require_once(dirname(__FILE__) . '/wp-config.php');


	// Your Wordpress Functions here...
	$results = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}enquire_now  ORDER BY ID DESC  ", ARRAY_A );


		$line='<table border="1">
				  <thead>
					   <tr>
						  <th>Name</th>
						  <th>Phone</th>
						  <th>Email</th>						 
						  <th>Message</th>					
						  <th>Date</th>
						</tr>
				  </thead>   
			  <tbody>';
		foreach($results as $val)
		{
			$line .='<tr>		
						<td>'.stripslashes($val['name']).'</td>
						<td>'.stripslashes($val['mobile']).'</td>
						<td>'.stripslashes($val['email']).'</td>						
						<td>'.stripslashes($val['description']).'</td>
						<td>'.stripslashes($val['insert_date']).'</td>					
					</tr>';	
		}
		
		$line .='</tbody></table>';
		$data = trim($line);
		$currentdate = date("Y-m-d H:i:s"); 
		//print $data; exit();

		if ($data == "") {
			
			$data = "\n no matching records found\n";
		}
		// Create table header showing to download a xls (excel) file
		header("Content-type: application/vnd.ms-excel; name='excel'");
		header("Content-Disposition: attachment; filename=Enquiry-".$currentdate.".xls");
		header("Pragma: no-cache");
		header("Expires: 0");
		
		// output data
		echo $data;

?>