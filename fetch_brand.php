<?php
require_once("../config/config.php");
require_once("verify_logins.php");


$category_id=$_REQUEST['category_id'];
if($category_id!=''){
$TypeArray	= $objTypes->fetchAll("SELECT * FROM tbl_brands WHERE parent_category_id='".$category_id."' and is_active=1 and is_delete=1");
$data='<select class="form-control" name="brand_id" id="brand_id2" style="width: 40%">
                    <option value="">Select Brand</option>';

foreach($TypeArray as $parent)
				{
					
					//echo $parent['title'];
					$data .="<option value='".$parent['id']."'>".stripslashes($parent['title'])."</option>";		
				}
$data .='</select>';
				echo $data;
}
?>