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
if(($POST['SAVE']=="SAVE")){
	if($POST['category_type']!=""){
			$parent_category=$POST['category_type'];
			$category_type='Chemistry';
	}else{
			$parent_category=0;
			$category_type='Application';
			
	}
	$pgNo 	= intval(base64_decode($_REQUEST['pgNo']));
	$params = array(
		'title'	            => $POST['title'],
        'description'		=> addslashes($_POST['description']),
		'category_type'		=> $category_type,
        'short_description'	=> $POST['short_description'],
        'meta_description'  => $POST['meta_description'],
        'meta_keywords'     => $POST['meta_keywords'],
        'meta_title'        => $POST['meta_title'],
		'ip'                => $ip,
        'agent'             => $agent,
		'is_delete'			=>  1,
        'added_by'          => $_SESSION['SessAdminName'],
		'parent_category_id'=> $parent_category,
		'is_parent'			=> $POST['is_parent']
		
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
		$update 	= $objTypes->update("tbl_categories", $params, "id = :id", $where);

		if($update){
			$insert_id	= $id;
		}
	}
	else{
		$insert = $objTypes->insert("tbl_categories", $params);
		if($insert){
			$insert_id = $objTypes->lastInsertId();
		}
	}
	
	
	/*if($insert_id > 0){
		if(isset($_FILES['catalogue']['name']) && $_FILES['catalogue']['name'] != ""){
			//echo "1st"; exit;
			//print_r($_FILES); exit;
		
		$ext 			= pathinfo($_FILES['catalogue']['name'], PATHINFO_EXTENSION);
		$ext			= strtolower($ext);
		$validatefiles 	= array("pdf", "PDF");
		$filetype 		= array('application/pdf');

		if(in_array($ext, $validatefiles) == false){
			header("location:add_categories.php?sysmsg=11&id=".$id."&pgNo=".$pgNo);
			exit();		
		}

		if($_FILES['catalogue']['type']!= 'application/pdf'){
			header("location:add_categories.php?sysmsg=11&id=".$id."&pgNo=".$pgNo);
			exit();	
		}
		
		
		if(isset($_FILES['catalogue']['name'])){	
			//echo ">>>>"; exit;	
			$ext 	  = pathinfo($_FILES['catalogue']['name'], PATHINFO_EXTENSION);
			$filename = basename($_FILES['catalogue']['name'], $ext);			
			$filename = 'catalogue_'.time().'.'.$ext;
			$movefile = move_uploaded_file($_FILES['catalogue']['tmp_name'], "../uploads/category_pdf/".$filename);
			//echo $movefile; exit;
		}
			//$UpdatePdfArray = array('catalogue' => $filename);
			$update_params = array(
	        'catalogue'		=> $filename
			);
			//$objTypes->update($UpdatePdfArray,"id = '".$id."'");
			$params = array_merge($params, $update_params);
				$where  = array(
					':id'          => $id
			);
			$update 	= $objTypes->update("tbl_categories", $params, "id = :id", $where);
			
		}
	
	}	*/

		
		

	if($insert_id > 0){
		$validatefiles 	= array("jpg", "bmp", "jpeg", "gif","JPG", "BMP", "JPEG", "GIF","png","PNG");
		$filetype 		= array('image/gif', 'image/jpeg','image/JPG','image/jpg', 'image/JPEG', 'image/GIF', 'image/bmp', 'image/BMP','image/png','image/PNG');

		
		if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != ""){
			$ext 	  		= pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $ext 	  		= strtolower($ext);
			$filename 		= basename($_FILES['image']['name'], $ext);
            $filename 		= time().'.'.$ext;

			if($_FILES['image']['size'] > 3097152){
				header("location:add_categories.php?sysmsg=16&id=".$insert_id);
                exit();
            }

            if(in_array($ext, $validatefiles) == false){
                header("location:add_categories.php?sysmsg=11&id=".$insert_id);
                exit();
            }

			if(in_array(strtolower($_FILES['image']['type']), $filetype) == false ){
                header("location:add_categories.php?sysmsg=11&id=".$insert_id);
                exit();
            }

			$where      = array(':id' => $insert_id);
			$imagename	= $objTypes->fetchRow("SELECT image, thumbnail FROM tbl_categories WHERE id = :id", $where);
			unlink("../uploads/category_images/".str_replace('main_', '', $imagename['image']));
			unlink("../uploads/category_images/".$imagename['image']);
			unlink("../uploads/category_images/".$imagename['thumbnail']);

			if(move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/category_images/".$filename)){
				$path 		= "../uploads/category_images/".$filename;
				$main_image = "../uploads/category_images/main_".$filename;
				$main_width	= "85";
				$main_height= "95";

				$magicianObj = new imageLib($path);
				$magicianObj->resizeImage($main_width, $main_height, $option = 2);
				$magicianObj->saveImage($main_image, 100);

				$thumb_image = "../uploads/category_images/thumb_".$filename;
				$thumb_width = "374";
				$thumb_height= "251";

				$magicianObj2 = new imageLib($path);
				$magicianObj2->resizeImage($thumb_width, $thumb_height, $option = 2);
				$magicianObj2->saveImage($thumb_image, 100);

				$img_params = array('image' => 'main_'.$filename, 'thumbnail' => 'thumb_'.$filename);
				$update     = $objTypes->update("tbl_categories", $img_params, "id = :id", $where);
			}
			else{
				header("location:add_categories.php?sysmsg=1003&id=".$insert_id);
				exit();
			}
		}


		if(isset($_FILES['icon']['name']) && $_FILES['icon']['name'] != ""){
			$ext 	  		= pathinfo($_FILES['icon']['name'], PATHINFO_EXTENSION);
            $ext 	  		= strtolower($ext);
			$filename1 		= basename($_FILES['icon']['name'], $ext);
            $filename1 		= time().'.'.$ext;

			if($_FILES['icon']['size'] > 3097152){
				header("location:add_categories.php?sysmsg=16&id=".$insert_id);
                exit();
            }

            if(in_array($ext, $validatefiles) == false){
                header("location:add_categories.php?sysmsg=11&id=".$insert_id);
                exit();
            }

			if(in_array(strtolower($_FILES['icon']['type']), $filetype) == false ){
                header("location:add_categories.php?sysmsg=11&id=".$insert_id);
                exit();
            }

			$where      = array(':id' => $insert_id);
			$imagename	= $objTypes->fetchRow("SELECT icon FROM tbl_categories WHERE id = :id", $where);
			unlink("../uploads/category_images/icon/".str_replace('main_', '', $imagename['icon']));
			unlink("../uploads/category_images/icon/".$imagename['icon']);
			

			if(move_uploaded_file($_FILES['icon']['tmp_name'], "../uploads/category_images/icon/".$filename1)){
				$path 		= "../uploads/category_images/icon/".$filename1;
				$main_image1 = "../uploads/category_images/icon/main_".$filename1;
				$main_width1	= "14";
				$main_height1= "14";

				$magicianObj = new imageLib($path);
				$magicianObj->resizeImage($main_width1, $main_height1);
				$magicianObj->saveImage($main_image1, 100);

				
				$img_params1 = array('icon' => 'main_'.$filename1);
				$update     = $objTypes->update("tbl_categories", $img_params1, "id = :id", $where);
			}
			else{
				header("location:add_categories.php?sysmsg=1003&id=".$insert_id);
				exit();
			}
		}
		
		/*if($_FILES['mul_image']['error'][0]==0)
		{
	
			$counter = 0;

			$where      = array(':category_id' => $id);
			$imagename	= $objTypes->fetchAll("SELECT uploaded_image, image,thumb_image FROM tbl_categories_images WHERE category_id = :category_id", $where);

			foreach($imagename as $new_img)
			{
			unlink("../uploads/category_images/".$new_img['image']);
			unlink("../uploads/category_images/".$new_img['uploaded_image']);
			unlink("../uploads/category_images/".$new_img['thumb_image']);
			}

			$delete = $objTypes->delete('tbl_categories_images', 'category_id = :category_id', $where);


			foreach($_FILES["mul_image"]["tmp_name"] as $key=>$tmp_name){

			$temp = $_FILES["mul_image"]["tmp_name"][$key];
			$name = $_FILES["mul_image"]["name"][$key];

			$ext 	  		= pathinfo($name, PATHINFO_EXTENSION);
            $ext 	  		= strtolower($ext);
			$filename 		= basename($name, $ext);
            $filename 		= time().'.'.$ext;


			if($_FILES['mul_image']['size'] > 3097152){
				//header("location:add_categories.php?sysmsg=16&id=".$insert_id);
				//exit();
			}

			if(in_array($ext, $validatefiles) == false){
				 header("location:add_categories.php?sysmsg=11&id=".$insert_id);
				exit();
			}

			if(in_array(strtolower($_FILES['mul_image']['type']), $filetype) == false ){
				// header("location:add_categories.php?sysmsg=11&id=".$insert_id);
				//exit();
			}

			
			$counter++;
			$UploadOk = true;


			if(move_uploaded_file($temp, "../uploads/category_images/".$name)){
				$path 		= "../uploads/category_images/".$name;
				$main_image = "../uploads/category_images/main_".$name;
				$main_width	= "545";
				$main_height= "367";

				$magicianObj = new imageLib($path);
				$magicianObj->resizeImage($main_width, $main_height);
				$magicianObj->saveImage($main_image, 100);


				$thumb_image = "../uploads/category_images/thumb_".$name;
				$thumb_width = "374";
				$thumb_height= "251";

				$magicianObj2 = new imageLib($path);
				$magicianObj2->resizeImage($thumb_width, $thumb_height);
				$magicianObj2->saveImage($thumb_image, 100);


				$img_params = array('uploaded_image'=>$name,'image' => 'main_'.$name, 'thumb_image' =>'thumb_'.$name,  'category_id' => $insert_id,'category_type' =>$POST['category_type']);
				$insert = $objTypes->insert("tbl_categories_images", $img_params);
			}
			else{
				//header("location:add_categories.php?sysmsg=1003&id=".$insert_id);
				//exit();
			}


			}

			if($counter>0){
				if(count($errors)>0)
				{

					foreach($errors as $error)
					{
						header("location:add_categories.php?sysmsg=1003&id=".$insert_id);
					    exit();
					}

				}

				
			}
			else{
				header("location:add_categories.php?sysmsg=1003&id=".$insert_id);
				exit();
			}


		}*/






	}

	header("location:list_categories.php?sysmsg=1000&pgNo=".$pgNo);
	exit();
}

#==== STATUS UPDATION
if(($_REQUEST['status']<>"") && ($_REQUEST['id'] <> "")){
	$statusVal  = intval($_REQUEST['status']);
	$status		= ($statusVal=='0') ? '1' : '0';
	$id			= intval($_REQUEST['id']);
	$pgNo 		= intval(base64_decode($_REQUEST['pgNo']));
	$title  = $_REQUEST['title'];
	$cat_type = $_REQUEST['cat_type'];
    $params     = array("is_active" => $status);
	$where 		= array(":id" => $id);

	$update     = $objTypes->update("tbl_categories", $params, "id = :id", $where);
	if($update){
		header("location:list_categories.php?sysmsg=1001&pgNo=$pgNo&title=$title&cat_type=$cat_type");
		exit();
	}
    else{
		header("location:list_categories.php?sysmsg=4&pgNo=$pgNo&title=$title&cat_type=$cat_type");
		exit();
	}
}

#==== DELETE
if(($_REQUEST['action']=="delete") && ($_REQUEST['id'] <> ""))
{
	$id		= intval($_REQUEST['id']);
	$pgNo 	= intval(base64_decode($_REQUEST['pgNo']));
	$title  = $_REQUEST['title'];
	$cat_type = $_REQUEST['cat_type'];
	$params	= array("is_delete" => '0');
	$where  = array(":id" => $id);
	$delete = $objTypes->update("tbl_categories", $params, "id = :id", $where);
	if($delete){
		header("location:list_categories.php?sysmsg=1002&pgNo=$pgNo&title=$title&cat_type=$cat_type");
		exit();
	}else{
		header("location:list_categories.php?sysmsg=4&pgNo=$pgNo&title=$title&cat_type=$cat_type");
		exit();
	}
}

#==== ACTIVE ALL
if(($POST['action']=="activeall") && ($_POST['DelCheckBox'] <> "")){
	$DelCheckBox	= $_POST['DelCheckBox'];
	$Result			= count($DelCheckBox);
	$pgNo 			= intval($_REQUEST['pgNo']);
	$title  = $_REQUEST['title'];
	$cat_type = $_REQUEST['cat_type'];

	if($Result == "0"){
		header("location:list_categories.php?sysmsg=8&pgNo=$pgNo&title=$title&cat_type=$cat_type");
		exit();
	}
	$Delete	= implode(',', $DelCheckBox);
	$update = $objTypes->inquery("UPDATE tbl_categories SET is_active = '1' WHERE id IN ($Delete)");

	if($update > 0){
		header("location:list_categories.php?sysmsg=1012&pgNo=$pgNo&title=$title&cat_type=$cat_type");
		exit();
	}
    else{
		header("location:list_categories.php?sysmsg=13&pgNo=$pgNo&title=$title&cat_type=$cat_type");
		exit();
	}
}

#==== DEACTIVE ALL
if(($POST['action']=="deactiveall") && ($_POST['DelCheckBox'] <> "")){
	$DelCheckBox	= $_POST['DelCheckBox'];
	$Result			= count($DelCheckBox);
	$pgNo 			= intval($_REQUEST['pgNo']);
	$title  = $_REQUEST['title'];
	$cat_type = $_REQUEST['cat_type'];

	if($Result == "0"){
		header("location:list_categories.php?sysmsg=9&pgNo=$pgNo&title=$title&cat_type=$cat_type");
		exit();
	}
    $Delete = implode(',',$DelCheckBox);
	$update = $objTypes->inquery("UPDATE tbl_categories SET is_active = '0' WHERE id IN ($Delete)");

	if($update > 0){
		header("location:list_categories.php?sysmsg=1013&pgNo=$pgNo&title=$title&cat_type=$cat_type");
		exit();
	}
    else{
		header("location:list_categories.php?sysmsg=14&pgNo=$pgNo&title=$title&cat_type=$cat_type");
		exit();
	}
}

#==== DELETE  ALL
if(($POST['action']=="deleteall") && ($_POST['DelCheckBox'] <> "")){
	$DelCheckBox	= $_POST['DelCheckBox'];
	$Result			= count($DelCheckBox);
	$title  = $_REQUEST['title'];
	$cat_type = $_REQUEST['cat_type'];

	if($Result == "0"){
		header("location:list_categories.php?sysmsg=10");
		exit();
	}
	$Delete = implode(',',$DelCheckBox);
	$update = $objTypes->inquery("UPDATE tbl_categories SET is_delete = '0' WHERE id IN ($Delete)");

	if($update > 0){
		header("location:list_categories.php?sysmsg=1014&title=$title&cat_type=$cat_type");
		exit();
	}
    else{
		header("location:list_categories.php?sysmsg=4&title=$title&cat_type=$cat_type");
		exit();
	}
}
