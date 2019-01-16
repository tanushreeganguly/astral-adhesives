<?php
#=== Includes

require_once("../config/config.php");
require_once("verify_logins.php");


#==== Validations For Security
$POST		= $objTypes->validateUserInput($_POST);
$id 		= isset($POST['id']) ? intval($POST['id']) : intval($_REQUEST['id']) ;
$ip			= $_SERVER['REMOTE_ADDR'];
$agent		= addslashes($_SERVER['HTTP_USER_AGENT']);


#==== ADD - UPDATE - INSERT
if($POST['SAVE']=="SAVE"){
	
	$pgNo 	= intval(base64_decode($_REQUEST['pgNo']));
	//$parent_category=$POST['parent_category_id'];
	$params = array(
	    'title'	=> $POST['title1'],
		'description'	=> ($_POST['description']),
		'meta_description'  => $POST['meta_description'],
        'meta_keywords'     => $POST['meta_keywords'],
        'meta_title'        => $POST['meta_title'],
		'ip'                => $ip,
        'agent'             => $agent,
		//'parent_category_id'=> $parent_category,
        'added_by'          => $_SESSION['SessAdminName']
	);

	if($id > 0){
		$update_params = array(
	        'updated_date'		=> date("Y-m-d H:i:s"),
	        'updated_by'   		=> $_SESSION['SessAdminName'],
		);
		$params = array_merge($params, $update_params);
		$where = array(
			':id'          => $id
		);
		$update 	= $objTypes->update("tbl_brands", $params, "id = :id", $where);
		if($update){
			$insert_id	= $id;
		}
	}
	else{
		$insert = $objTypes->insert("tbl_brands", $params);
		if($insert){
			$insert_id = $objTypes->lastInsertId();
		}
	}

	if($insert_id > 0)
	{
		
				if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != ""){
					$validatefiles 	= array("jpg", "bmp", "jpeg", "gif","JPG", "BMP", "JPEG","png","PNG", "GIF");
					$filetype 		= array('image/gif', 'image/jpeg', 'image/JPEG', 'image/GIF', 'image/bmp', 'image/png','image/PNG', 'image/BMP');
					$ext 	  		= pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
		            $ext 	  		= strtolower($ext);
					$filename 		= basename($_FILES['image']['name'], $ext);
		            $filename 		= time().'.'.$ext;

					if($_FILES['image']['size'] > 3097152){
						header("location:add_brand.php?sysmsg=16&id=".$insert_id);
		                exit();
		            }

		            if(in_array($ext, $validatefiles) == false){
		                header("location:add_brand.php?sysmsg=11&id=".$insert_id);
		                exit();
		            }

					if(in_array(strtolower($_FILES['image']['type']), $filetype) == false ){
		                header("location:add_brand.php?sysmsg=11&id=".$insert_id);
		                exit();
		            }

					$where      = array(':id' => $insert_id);
					$imagename	= $objTypes->fetchRow("SELECT image, thumbnail FROM tbl_brands WHERE id = :id", $where);
					unlink("../uploads/brand_images/".str_replace('main_', '', $imagename['image']));		
					unlink("../uploads/brand_images/".$imagename['image']);
					unlink("../uploads/brand_images/".$imagename['thumbnail']);

					if(move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/brand_images/".$filename)){
						$path 		= "../uploads/brand_images/".$filename;
						$main_image = "../uploads/brand_images/main_".$filename;
						$main_width	= "285";
						$main_height= "285";

						$magicianObj = new imageLib($path);
						$magicianObj->resizeImage($main_width, $main_height, $option = 2);
						$magicianObj->saveImage($main_image, 100);

						$thumb_image = "../uploads/brand_images/thumb_".$filename;
						$thumb_width = "285";
						$thumb_height= "285";

						$magicianObj2 = new imageLib($path);
						$magicianObj2->resizeImage($thumb_width, $thumb_height, $option = 2);
						$magicianObj2->saveImage($thumb_image, 100);

						$img_params = array('image' => 'main_'.$filename, 'thumbnail' => 'thumb_'.$filename);
						$update     = $objTypes->update("tbl_brands", $img_params, "id = :id", $where);
					}
					
				}
				
				
				/*---------------------------------------------------------------------*/
				
				
				
				if(isset($_FILES['image1']['name']) && $_FILES['image1']['name'] != ""){
					$validatefiles 	= array("jpg", "bmp", "jpeg", "gif","JPG", "BMP","png","PNG", "JPEG", "GIF");
					$filetype 		= array('image/gif', 'image/jpeg', 'image/JPEG', 'image/GIF', 'image/bmp', 'image/png','image/PNG', 'image/BMP');
					$ext 	  		= pathinfo($_FILES['image1']['name'], PATHINFO_EXTENSION);
		            $ext 	  		= strtolower($ext);
					$filename1		= basename($_FILES['image1']['name'], $ext);
		            $filename1 		= time().'.'.$ext;

					if($_FILES['image1']['size'] > 3097152){
						header("location:add_brand.php?sysmsg=16&id=".$insert_id);
		                exit();
		            }

		            if(in_array($ext, $validatefiles) == false){
		                header("location:add_brand.php?sysmsg=11&id=".$insert_id);
		                exit();
		            }

					if(in_array(strtolower($_FILES['image1']['type']), $filetype) == false ){
		                header("location:add_brand.php?sysmsg=11&id=".$insert_id);
		                exit();
		            }

					$where      = array(':id' => $insert_id);
					$imagename1	= $objTypes->fetchRow("SELECT image1, thumbnail1 FROM tbl_brands WHERE id = :id", $where);
					unlink("../uploads/brand_images/".str_replace('main_mouseover_', '', $imagename1['image1']));		
					unlink("../uploads/brand_images/".$imagename['image1']);
					unlink("../uploads/brand_images/".$imagename['thumbnail1']);

					if(move_uploaded_file($_FILES['image1']['tmp_name'], "../uploads/brand_images/".$filename1)){
						$path 		= "../uploads/brand_images/".$filename1;
						$main_image = "../uploads/brand_images/main_mouseover_".$filename1;
						$main_width	= "285";
						$main_height= "285";

						$magicianObj = new imageLib($path);
						$magicianObj->resizeImage($main_width, $main_height, $option = 2);
						$magicianObj->saveImage($main_image, 100);

						$thumb_image = "../uploads/brand_images/thumb_mouseover_".$filename1;
						$thumb_width = "285";
						$thumb_height= "285";

						$magicianObj2 = new imageLib($path);
						$magicianObj2->resizeImage($thumb_width, $thumb_height, $option = 2);
						$magicianObj2->saveImage($thumb_image, 100);

						$img_params = array('image1' => 'main_mouseover_'.$filename1, 'thumbnail1' => 'thumb_mouseover_'.$filename1);
						$update     = $objTypes->update("tbl_brands", $img_params, "id = :id", $where);
					}
					header("location:list_brand.php?sysmsg=1000&id=".$insert_id);
					exit();
				}
				/*-----------------------------------------------------------------*/
				
				if(isset($_FILES['logoimage']['name']) && $_FILES['logoimage']['name'] != ""){
					$validatefiles 	= array("jpg", "bmp", "jpeg", "gif","JPG", "BMP", "JPEG","png","PNG", "GIF");
					$filetype 		= array('image/gif', 'image/jpeg', 'image/JPEG', 'image/GIF', 'image/bmp', 'image/png','image/PNG', 'image/BMP');
					$ext 	  		= pathinfo($_FILES['logoimage']['name'], PATHINFO_EXTENSION);
		            $ext 	  		= strtolower($ext);
					$filename2		= basename($_FILES['logoimage']['name'], $ext);
		            $filename2 		= time().'.'.$ext;

					if($_FILES['logoimage']['size'] > 3097152){
						header("location:add_brand.php?sysmsg=16&id=".$insert_id);
		                exit();
		            }

		            if(in_array($ext, $validatefiles) == false){
		                header("location:add_brand.php?sysmsg=11&id=".$insert_id);
		                exit();
		            }

					if(in_array(strtolower($_FILES['logoimage']['type']), $filetype) == false ){
		                header("location:add_brand.php?sysmsg=11&id=".$insert_id);
		                exit();
		            }

					$where      = array(':id' => $insert_id);
					$imagename2	= $objTypes->fetchRow("SELECT logo_image FROM tbl_brands WHERE id = :id", $where);
					unlink("../uploads/brand_images/logo/".str_replace('main_', '', $imagename2['logo_image']));		
					unlink("../uploads/brand_images/logo/".$imagename2['logo_image']);
					unlink("../uploads/brand_images/logo/".$imagename2['thumb_logo_image']);

					if(move_uploaded_file($_FILES['logoimage']['tmp_name'], "../uploads/brand_images/logo/".$filename2)){
						$path2 		= "../uploads/brand_images/logo/".$filename2;
						$main_image2 = "../uploads/brand_images/logo/main_".$filename2;
						//$main_width2	= "285";
						//$main_height2= "285";

						$magicianObj = new imageLib($path2);
						//$magicianObj->resizeImage($main_width2, $main_height2);
						$magicianObj->saveImage($main_image2, 100);

						$thumb_image2 = "../uploads/brand_images/logo/thumb_".$filename2;
						$thumb_width2 = "122";
						$thumb_height2= "119";

						$magicianObj2 = new imageLib($path2);
						$magicianObj2->resizeImage($thumb_width2, $thumb_height2, $option = 2);
						$magicianObj2->saveImage($thumb_image2, 100);

						$img_params2 = array('logo_image' => 'main_'.$filename2, 'thumb_logo_image' => 'thumb_'.$filename2);
						$update     = $objTypes->update("tbl_brands", $img_params2, "id = :id", $where);
					}
					header("location:list_brand.php?sysmsg=1000&id=".$insert_id);
					exit();
				}
				
				if(isset($_FILES['listingimage']['name']) && $_FILES['listingimage']['name'] != ""){
					$validatefiles 	= array("jpg", "bmp", "jpeg", "gif","JPG", "BMP", "JPEG","png","PNG", "GIF");
					$filetype 		= array('image/gif', 'image/jpeg', 'image/JPEG', 'image/GIF', 'image/bmp', 'image/png','image/PNG', 'image/BMP');
					$ext 	  		= pathinfo($_FILES['listingimage']['name'], PATHINFO_EXTENSION);
		            $ext 	  		= strtolower($ext);
					$filename3		= basename($_FILES['listingimage']['name'], $ext);
		            $filename3 		= time().'.'.$ext;

					if($_FILES['listingimage']['size'] > 3097152){
						header("location:add_brand.php?sysmsg=16&id=".$insert_id);
		                exit();
		            }

		            if(in_array($ext, $validatefiles) == false){
		                header("location:add_brand.php?sysmsg=11&id=".$insert_id);
		                exit();
		            }

					if(in_array(strtolower($_FILES['listingimage']['type']), $filetype) == false ){
		                header("location:add_brand.php?sysmsg=11&id=".$insert_id);
		                exit();
		            }

					$where      = array(':id' => $insert_id);
					$imagename3	= $objTypes->fetchRow("SELECT listing_image FROM tbl_brands WHERE id = :id", $where);
					unlink("../uploads/brand_images/listing_image/".str_replace('main_', '', $imagename3['listing_image']));		
					unlink("../uploads/brand_images/listing_image/".$imagename3['listing_image']);
					unlink("../uploads/brand_images/listing_image/".$imagename3['thumb_listing_image']);

					if(move_uploaded_file($_FILES['listingimage']['tmp_name'], "../uploads/brand_images/listing_image/".$filename3)){
						$path3 		= "../uploads/brand_images/listing_image/".$filename3;
						$main_image3 = "../uploads/brand_images/listing_image/main_".$filename3;
						//$main_width2	= "285";
						//$main_height2= "285";

						$magicianObj = new imageLib($path3);
						//$magicianObj->resizeImage($main_width2, $main_height2);
						$magicianObj->saveImage($main_image3, 100);

						$thumb_image3 = "../uploads/brand_images/listing_image/thumb_".$filename3;
						$thumb_width3 = "361";
						$thumb_height3= "220";

						$magicianObj2 = new imageLib($path3);
						$magicianObj2->resizeImage($thumb_width3, $thumb_height3, $option = 2);
						$magicianObj2->saveImage($thumb_image3, 100);

						$img_params3 = array('listing_image' => 'main_'.$filename3, 'thumb_listing_image' => 'thumb_'.$filename3);
						$update     = $objTypes->update("tbl_brands", $img_params3, "id = :id", $where);
					}
					header("location:list_brand.php?sysmsg=1000&id=".$insert_id);
					exit();
				}
				
				if($POST['store_image']=="" || $POST['store_image1']==""){
						
					header("location:list_brand.php?sysmsg=3&pgNo=".$pgNo);
					
					exit();
				}else{
					if($filename1!="" || $filename!=""){
						header("location:list_brand.php?sysmsg=1000&pgNo=".$pgNo);
					}else{
					header("location:list_brand.php?sysmsg=1001&pgNo=".$pgNo);
					}
				}
				
		
		
	}
}

#==== STATUS UPDATION
if(($_REQUEST['status']<>"") && ($_REQUEST['id'] <> "")){
	$statusVal  = intval($_REQUEST['status']);
	$status		= ($statusVal=='0') ? '1' : '0';
	$id			= intval($_REQUEST['id']);
	$pgNo 		= intval(base64_decode($_REQUEST['pgNo']));
    $params     = array("is_active" => $status);
	$where 		= array(":id" => $id);

	$update     = $objTypes->update("tbl_brands", $params, "id = :id", $where);
	if($update){
		header("location:list_brand.php?sysmsg=1001&pgNo=".$pgNo);
		exit();
	}
    else{
		header("location:list_brand.php?sysmsg=4&pgNo=".$pgNo);
		exit();
	}
}

#==== DELETE


#==== ACTIVE ALL
if(($POST['action']=="activeall") && ($_POST['DelCheckBox'] <> "")){
	$DelCheckBox	= $_POST['DelCheckBox'];
	$Result			= count($DelCheckBox);
	$pgNo 			= intval($_REQUEST['pgNo']);

	if($Result == "0"){
		header("location:list_brand.php?sysmsg=8&pgNo=$pgNo");
		exit();
	}
	$Delete	= implode(',', $DelCheckBox);
	$update = $objTypes->inquery("UPDATE tbl_brands SET is_active = '1' WHERE id IN ($Delete)");

	if($update > 0){
		header("location:list_brand.php?sysmsg=1012&pgNo=$pgNo");
		exit();
	}
    else{
		header("location:list_brand.php?sysmsg=13&pgNo=$pgNo");
		exit();
	}
}

#==== DEACTIVE ALL
if(($POST['action']=="deactiveall") && ($_POST['DelCheckBox'] <> "")){
	$DelCheckBox	= $_POST['DelCheckBox'];
	$Result			= count($DelCheckBox);
	$pgNo 			= intval($_REQUEST['pgNo']);

	if($Result == "0"){
		header("location:list_brand.php?sysmsg=9&pgNo=$pgNo");
		exit();
	}
    $Delete = implode(',',$DelCheckBox);
	$update = $objTypes->inquery("UPDATE tbl_brands SET is_active = '0' WHERE id IN ($Delete)");

	if($update > 0){
		header("location:list_brand.php?sysmsg=1013&pgNo=$pgNo");
		exit();
	}
    else{
		header("location:list_brand.php?sysmsg=14&pgNo=$pgNo");
		exit();
	}
}

#==== DELETE  ALL
