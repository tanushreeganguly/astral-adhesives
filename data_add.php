<?php

require_once("config/config.php");
/*------------------------Product entry-----------------------------*/
$sql_trun="TRUNCATE TABLE tbl_search";
$statement = $objTypes->prepare($sql_trun);
 
//Execute the statement.
$statement->execute();

$sql_brand= $objTypes->fetchAll('select title,id,description from tbl_brands where is_active=1 and is_delete=1');
foreach($sql_brand as $brand){
	$url="b/".$objTypes->prepare_url(str_replace(" ","-",strtolower($brand['title'])))."-".$brand['id'];
$params=array(
				'url'=>$url,
				'title'=>$brand['title'],
				'content'=>strip_tags($brand['description']),
				'description'=>strip_tags($brand['description'])
				);
		$insert = $objTypes->insert("tbl_search", $params);
		if($insert){
			$insert_id = $objTypes->lastInsertId();
		}
	}
/*$sql="select title,id,category_type,short_description,description,parent_category_id from tbl_categories where is_active=1 and is_delete=1";
$data = $objTypes->fetchAll($sql);

	foreach($data as $val)
	{
		$var_parent="";
		$var="";
		if($val['category_type']=="Application")
		{
			$var="p";	
		}
		if($val['category_type']=="Chemistry")
		{
			$var="c";	
		}
		
		if($val['parent_category_id']!=0){
		$sql1="select title from tbl_categories where id=".$val['parent_category_id'];
		$data_parent = $objTypes->fetchRow($sql1);
		$var_parent=$objTypes->prepare_url(str_replace(" ","-",strtolower($data_parent['title'])))."/";
		}
		$url=$var."/".$var_parent.$objTypes->prepare_url(str_replace(" ","-",strtolower($val['title'])))."-".$val['id'];
		
		
		$params=array(
				'url'=>$url,
				'title'=>$val['title'],
				'content'=>strip_tags($val['short_description']),
				'description'=>strip_tags($val['description'])
				);
		$insert = $objTypes->insert("tbl_search", $params);
		if($insert){
			$insert_id = $objTypes->lastInsertId();
		}
	}*/
/*------------------------Product entry-----------------------------*/
/*-----------------------past event-------------------*/
$sql_event="select a.`title` as application,a.category_type,a.`id` as application_id,a.`short_description`,a.`description`,b.category_type,b.`title` as chemistry,b.`id` as chemistry_id,b.`description`,b.`short_description` from tbl_categories as a inner join tbl_categories as b on b.parent_category_id=a.id";

$data_event = $objTypes->fetchAll($sql_event);
foreach($data_event as $value_event)
{
	if($value_event['category_type']=='Application'){
		$var="p";
		$var_parent=$objTypes->prepare_url(str_replace(" ","-",strtolower($value_event['application'])))."-".$value_event['application_id'];
		$title=$value_event['application'];
	}else{
		$var="c";
		$var_parent=$objTypes->prepare_url(str_replace(" ","-",strtolower($value_event['application'])))."/".$objTypes->prepare_url(str_replace(" ","-",strtolower($value_event['chemistry'])))."-".$value_event['chemistry_id'];
		$title=$value_event['chemistry'];
	}


	$url=$var."/".$var_parent;

	$params=array(
				'url'=>$url,
				'content'=>strip_tags($value_event['description']),
				'title'=>$title
				);
		$insert = $objTypes->insert("tbl_search", $params);
		if($insert){
			$insert_id = $objTypes->lastInsertId();
		}
}

/*--------------------------------Add varients-----------------------------------*/
$sql_page="select a.title,a.id,a.short_description,CONCAT(a.packing,',',a.technical_details,',',a.application,',',a.how_to_use,',',a.shelf_life,',',a.restriction_usage,',',a.stroage,',',a.handling_precaution) as detail,
b.title as category_title,c.title as brand_title,d.title as chemistry from tbl_products_details as a left join tbl_categories as b on b.id=a.application_id left join tbl_categories as d on d.id=a.category_id left join tbl_brands as c on c.id=a.brand_id where a.is_active=1 and a.is_delete=1 order by a.title";
$data_page = $objTypes->fetchAll($sql_page);
foreach($data_page as $value_page)
{
	$url='v/'.$objTypes->prepare_url(str_replace(" ","-",strtolower($value_page['category_title'])))."/".$objTypes->prepare_url(str_replace(" ","-",strtolower($value_page['chemistry'])))."/".$objTypes->prepare_url(str_replace(" ","-",strtolower($value_page['brand_title'])))."/".$objTypes->prepare_url(str_replace(" ","-",strtolower($value_page['title'])))."-".$value_page['id'];
	$params=array(
				'url'=>$url,
				'content'=>strip_tags($value_page['short_description']).",".strip_tags($value_page['detail']),
				'title'=>$value_page['title']
				);
		$insert = $objTypes->insert("tbl_search", $params);
		if($insert){
			$insert_id = $objTypes->lastInsertId();
		}
	
	}

/*-----------------------past event-------------------*/
/*-------------------------page------------------------------------*/


/*$sql_page="select a.id,a.title,a.short_description,a.category_id,a.application_id,a.brand_id,b.title as category_title,c.title as brand_title,b.category_type from ((tbl_products_details as a 
INNER JOIN tbl_brands as c ON c.id = a.brand_id) 
INNER JOIN tbl_categories as b ON b.id = a.category_id or b.id = a.application_id ) 
where a.is_active=1 and a.is_delete=1 and  group by category_title order by a.title";
$data_page = $objTypes->fetchAll($sql_page);
foreach($data_page as $value_page)
{
	
	
	if($value_page['id']==$id){
		$url=$url.str_replace(" ","-",strtolower($value_page['category_title']))."/".str_replace(" ","-",strtolower($value_page['brand_title']))."/".str_replace(" ","-",strtolower($value_page['title'])."-".$value_page['id']);
		$params=array(
				'url'=>$url,
				'content'=>strip_tags($value_page['short_description']),
				'title'=>$value_page['title']
				);
		$insert = $objTypes->insert("tbl_search", $params);
		if($insert){
			$insert_id = $objTypes->lastInsertId();
		}
	}else{
	$id=$value_page['id'];
	$url="v/".str_replace(" ","-",strtolower($value_page['category_title']))."/";
	}
	
	// $url=str_replace(" ","-",strtolower($value_page['title']));
	
}*/
/*----------------------------------------------------*/


  /*$content = file_get_contents('html/about-us.html'); 
  $content1=strip_tags($content);
  

		$url='about-us';
		$params=array(
				'url'=>$url,
				'content'=>$content1,
				'title'=>'About Us'
				);
		$insert = $objTypes->insert("tbl_search", $params);
		if($insert){
			$insert_id = $objTypes->lastInsertId();
		}*/
/*-----------------------------page------------------------------*/
 $sql_partner="select title,short_description,id,description from tbl_pages where is_active=1 and is_delete=1";
 $data_partner = $objTypes->fetchAll($sql_partner);
 foreach($data_partner as $value_partner)
 {
 	if($value_partner['title']=="R & D"){
 		$url="RnD";
 	}else{
	    $url=$objTypes->prepare_url(str_replace(array(" ","&"),"-",strtolower($value_partner['title'])));
	}
	 $params=array(
				 'url'=>$url,
				 'content'=>$value_partner['short_description'],
				 'description'=>$value_partner['description'],
				 'title'=>$value_partner['title']
				 );
		 $insert = $objTypes->insert("tbl_search", $params);
		 if($insert){
			 $insert_id = $objTypes->lastInsertId();
		 }
 }
/*------------------------------------------------------*/
/*------------------------------career-----------------------------*/
 $sql_career="select title,job_description from tbl_careers where is_active=1 and is_delete=1";
 $data_career = $objTypes->fetchAll($sql_career);
foreach($data_career as $value_career)
 {
	 $params=array(
				 'url'=>'career',
				 'content'=>$value_career['job_description'],
				 'title'=>$value_career['title']
				 );
		 $insert = $objTypes->insert("tbl_search", $params);
		 if($insert){
			 $insert_id = $objTypes->lastInsertId();
		 }
 }
/*--------------------------------------------------------------*/
/*---------------------------press release--------------------------*/
$sql_press="select title,short_description from tbl_pressrelease where is_active=1 and is_delete=1";
$data_press = $objTypes->fetchAll($sql_press);
foreach($data_press as $value_press)
{
	$params=array(
				'url'=>'press-release',
				'content'=>$value_press['short_description'],
				'title'=>$value_press['title']
				);
		$insert = $objTypes->insert("tbl_search", $params);
		if($insert){
			$insert_id = $objTypes->lastInsertId();
		}
}
/*--------------------------------------------------*/
/*---------------------------event --------------------------*/
$sql_event="select title,short_description from tbl_event where is_active=1 and is_delete=1";
$data_event = $objTypes->fetchAll($sql_event);
foreach($data_event as $value_event)
{
	$params=array(
				'url'=>'news-events',
				'content'=>$value_event['short_description'],
				'title'=>$value_event['title']
				);
		$insert = $objTypes->insert("tbl_search", $params);
		if($insert){
			$insert_id = $objTypes->lastInsertId();
		}
}
/*--------------------------------------------------*/
?>