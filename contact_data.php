<?php

$file_handle = fopen("contact-us.php","r");
 while ( !feof ( $file_handle ) ) 
 { 
$line = fgets( $file_handle );
echo $content=strip_tags($line);
$data=explode("Office",$content);
echo $data[1];
 /*if( preg_match( '/^\d+/',$line ) ) 
 {
	 # if it starts with some amount of digits
	 $tmp = explode( "\t",$line ); $rank = trim( $tmp[0] ); 
	 $url = trim( $tmp[1] ); if( $url != 'Hidden profile' ) {
		 # Hidden profile appears sometimes just ignore then
		 echo $	} } */
		 } fclose( $file_handle );


?>