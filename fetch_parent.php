<?php
require_once("../config/config.php");
require_once("verify_logins.php");


$category_type=$_REQUEST['category_type'];
if($category_type!=''){
$TypeArray	= $objTypes->fetchAll("SELECT * FROM tbl_categories WHERE parent_category_id='".$category_type."' and is_active=1 and is_delete=1");
$data='<select class="form-control" name="parent_category_id" id="parent_category_id2" style="width: 40%">
                    <option value="">Select Parent Category</option>';

foreach($TypeArray as $parent)
				{
					
					//echo $parent['title'];
					$data .="<option value='".$parent['id']."'>".stripslashes($parent['title'])."</option>";		
				}
$data .='</select>';
echo $data;
}	
?>