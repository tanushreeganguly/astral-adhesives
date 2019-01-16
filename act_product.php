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

    $pgNo 	= intval(base64_decode($_REQUEST['pgNo']));
	$params = array(
		'title'	            => $POST['title'],
		'application_id'	=> $POST['category_type'],
		'category_id'		=> $POST['parent_category_id'],
		'brand_id'		    => $POST['brand_id'],
        'short_description'	=>($_POST['short_description']),
		'packing'	        =>($_POST['packing']),
		'technical_details'	=>($_POST['technical_details']),
		'application'	    =>($_POST['application']),
		'how_to_use'	    =>($_POST['how_to_use']),
		'shelf_life'	    =>($_POST['shelf_life']),
		'dosage'	        =>($_POST['dosage']),
		'restriction_usage'	=>($_POST['restriction_usage']),
		'stroage'	        =>($_POST['stroage']),
		'hazards'	        =>($_POST['hazards']),
		'advantage'	        =>($_POST['advantage']),
		'handling_precaution'=>($_POST['handling_precaution']),
		'meta_description'  => $POST['meta_description'],
        'meta_keywords'     => $POST['meta_keywords'],
        'meta_title'        => $POST['meta_title'],
        'ip'                => $ip,
        'agent'             => $agent,
        'added_by'          => $_SESSION['SessAdminName']
	);
	
	

    if($id > 0){
		$update_params = array(
	        'updated_date'		=> date("Y-m-d H:i:s"),
	        'updated_by'   		=> $_SESSION['SessAdminName'],
		);
		$params = array_merge($params, $update_params);
		$where  = array(
			':id'          => $id
		);
		$update 	= $objTypes->update("tbl_products_details", $params, "id = :id", $where);

		if($update){
			$insert_id	= $id;
		}
	}
	else{
		$insert = $objTypes->insert("tbl_products_details", $params);
		if($insert){
			$insert_id = $objTypes->lastInsertId();
		}
	}
	
		//print_r($_FILES); exit;
	# ------- Catalogu PDF
		

	# ------- Envelope PDF
	
	if($insert_id > 0){
		if(isset($_FILES['envelope']['name']) && $_FILES['envelope']['name'] != ""){
		$ext 			= pathinfo($_FILES['envelope']['name'], PATHINFO_EXTENSION);
		$ext			= strtolower($ext);
		$validatefiles 	= array("pdf", "PDF");
		$filetype 		= array('application/pdf');

		if(in_array($ext, $validatefiles) == false){
			header("location:add_product.php?sysmsg=11&id=".$id."&pgNo=".$pgNo);
			exit();		
		}

		if(in_array(strtolower($_FILES['envelope']['type']), $filetype) == false ){
			header("location:add_product.php?sysmsg=11&id=".$id."&pgNo=".$pgNo);
			exit();	
		}
		
		if(isset($_FILES['envelope']['name'])){				
			$ext 	  = pathinfo($_FILES['envelope']['name'], PATHINFO_EXTENSION);
			$filename = basename($_FILES['envelope']['name'], $ext);			
			$filename = 'envelope_'.time().'.'.$ext;
			$movefile = move_uploaded_file($_FILES['envelope']['tmp_name'], "../uploads/products_pdf/".$filename);
		}
			
			//$UpdatePdfArray = array('catalogue' => $filename);
			$update_params = array(
	        'envelope'		=> $filename
			);
			//$objTypes->update($UpdatePdfArray,"id = '".$id."'");
			$params = array_merge($params, $update_params);
				$where  = array(
					':id'          => $id
			);
			$update 	= $objTypes->update("tbl_products_details", $params, "id = :id", $where);
		}
	
	}	
	
	
	
    if($insert_id > 0){
        $validatefiles 	= array("jpg", "bmp", "jpeg", "gif","JPG", "BMP", "JPEG", "GIF", "png", "PNG");
		$filetype 		= array('image/gif', 'image/jpeg', 'image/JPEG', 'image/GIF', 'image/bmp', 'image/BMP','image/png','image/PNG');
        if(count($_FILES['images']['name']) > 0){
            for($i = 0; $i <= count($_FILES['images']['name']); $i++){
                if($_FILES['images']['name'][$i] != ""){
                    $ext     = pathinfo($_FILES['images']['name'][$i], PATHINFO_EXTENSION);
        			$ext     = strtolower($ext);
                    $filename= basename($_FILES['images']['name'][$i], $ext);
    			    $filename= time().'_'.$i.'.'.$ext;

                    if($_FILES['images']['size'][$i] > 3097152){
        				header("location:add_product.php?sysmsg=17&id=".$insert_id);
                        exit();
                    }

                    if(in_array($ext, $validatefiles) == false){
                        header("location:add_product.php?sysmsg=11&id=".$insert_id);
                        exit();
                    }

                    if(in_array(strtolower($_FILES['images']['type'][$i]), $filetype) == false ){
                        die('ssss1');
                        header("location:add_product.php?sysmsg=11&id=".$insert_id);
                        exit();
                    }

                    if(move_uploaded_file($_FILES['images']['tmp_name'][$i], "../uploads/product_images/".$filename)){
                        $path 		= "../uploads/product_images/".$filename;
    				    $main_image = "../uploads/product_images/main_".$filename;
    				    $main_width	= "545";
    				    $main_height= "365";
                        $magicianObj = new imageLib($path);
    				    $magicianObj->resizeImage($main_width, $main_height);
    				    $magicianObj->saveImage($main_image, 100);

                        $thumb_image = "../uploads/product_images/thumb_".$filename;
    				    $thumb_width = "300";
    				    $thumb_height= "210";

    				    $magicianObj2 = new imageLib($path);
    				    $magicianObj2->resizeImage($thumb_width, $thumb_height);
    				    $magicianObj2->saveImage($thumb_image, 100);

                        $imagesdata[] = array($insert_id, "main_$filename", "thumb_$filename");

                    }
                }
            }

            $columns = array('product_id', 'image', 'thumbnail');
            $objTypes->bulkInsert('tbl_products_images', $columns, $imagesdata);
        }
        header("location:list_product.php?sysmsg=1000&id=".$insert_id);
        exit();
    }
	

}

#==== Image Removal
if(($_REQUEST['param']<>"") && ($_REQUEST['id'] <> "")){
    $id		 = intval($_REQUEST['id']);
    $prodid  = intval($_REQUEST['prodid']);
    $where 	 = array(":id" => $id);
    $pgNo 	 = intval(base64_decode($_REQUEST['pgNo']));

    $sql     = "SELECT image, thumbnail FROM tbl_products_images WHERE id = :id";
    $image   = $objTypes->fetchRow($sql, $where);
    unlink("../uploads/product_images/".str_replace('main_', '', $image['image']));
	unlink("../uploads/product_images/".$image['image']);
	unlink("../uploads/product_images/".$image['thumbnail']);

    $delete  = $objTypes->delete("tbl_products_images", "id = :id", $where);
    if($delete){
        header("location:add_product.php?sysmsg=1018&id=".$prodid."&pgNo=".$pgNo);
		exit();
    }
}

#==== STATUS UPDATION
if(($_REQUEST['status']<>"") && ($_REQUEST['id'] <> "")){
	$statusVal  = intval($_REQUEST['status']);
	$status		= ($statusVal=='0') ? '1' : '0';
	$id			= intval($_REQUEST['id']);
	$pgNo 		= intval(base64_decode($_REQUEST['pgNo']));
	$title  = $_REQUEST['title'];
    $params     = array("is_active" => $status);
	$where 		= array(":id" => $id);

	$update     = $objTypes->update("tbl_products_details", $params, "id = :id", $where);
	if($update){
		header("location:list_product.php?sysmsg=1001&title=$title&pgNo=".$pgNo);
		exit();
	}
    else{
		header("location:list_product.php?sysmsg=4&title=$title&pgNo=".$pgNo);
		exit();
	}
}

#==== DELETE
if(($_REQUEST['action']=="delete") && ($_REQUEST['id'] <> ""))
{
	$id		= intval($_REQUEST['id']);
	$pgNo 	= intval(base64_decode($_REQUEST['pgNo']));
	$title  = $_REQUEST['title'];
	$params	= array("is_delete" => '0');
	$where  = array(":id" => $id);
	$delete = $objTypes->update("tbl_products_details", $params, "id = :id", $where);
	if($delete){
		header("location:list_product.php?sysmsg=1002&pgNo=$pgNo");
		exit();
	}else{
		header("location:list_product.php?sysmsg=4&pgNo=$pgNo");
		exit();
	}
}

#==== ACTIVE ALL
if(($POST['action']=="activeall") && ($_POST['DelCheckBox'] <> "")){
	$DelCheckBox	= $_POST['DelCheckBox'];
	$Result			= count($DelCheckBox);
	$pgNo 			= intval($_REQUEST['pgNo']);
	$title  = $_REQUEST['title'];

	if($Result == "0"){
		header("location:list_product.php?sysmsg=8&pgNo=$pgNo");
		exit();
	}
	$Delete	= implode(',', $DelCheckBox);
	$update = $objTypes->inquery("UPDATE tbl_products_details SET is_active = '1' WHERE id IN ($Delete)");

	if($update > 0){
		header("location:list_product.php?sysmsg=1012&pgNo=$pgNo&title=$title");
		exit();
	}
    else{
		header("location:list_product.php?sysmsg=13&pgNo=$pgNo&title=$title");
		exit();
	}
}

#==== DEACTIVE ALL
if(($POST['action']=="deactiveall") && ($_POST['DelCheckBox'] <> "")){
	$DelCheckBox	= $_POST['DelCheckBox'];
	$Result			= count($DelCheckBox);
	$pgNo 			= intval($_REQUEST['pgNo']);
	$title  = $_REQUEST['title'];

	if($Result == "0"){
		header("location:list_product.php?sysmsg=9&pgNo=$pgNo&title=$title");
		exit();
	}
    $Delete = implode(',',$DelCheckBox);
	$update = $objTypes->inquery("UPDATE tbl_products_details SET is_active = '0' WHERE id IN ($Delete)");

	if($update > 0){
		header("location:list_product.php?sysmsg=1013&pgNo=$pgNo&title=$title");
		exit();
	}
    else{
		header("location:list_product.php?sysmsg=14&pgNo=$pgNo&title=$title");
		exit();
	}
}

#==== DELETE  ALL
if(($POST['action']=="deleteall") && ($_POST['DelCheckBox'] <> "")){
	$DelCheckBox	= $_POST['DelCheckBox'];
	$Result			= count($DelCheckBox);
	$title  = $_REQUEST['title'];

	if($Result == "0"){
		header("location:list_product.php?sysmsg=10");
		exit();
	}
	$Delete = implode(',',$DelCheckBox);
	$update = $objTypes->inquery("UPDATE tbl_products_details SET is_delete = '0' WHERE id IN ($Delete)");

	if($update > 0){
		header("location:list_product.php?sysmsg=1014&title=$title");
		exit();
	}
    else{
		header("location:list_product.php?sysmsg=4&title=$title");
		exit();
	}
}
