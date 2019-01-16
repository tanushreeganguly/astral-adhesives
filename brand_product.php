<?php
require_once("config/config.php");

$POST= $objTypes->validateUserInput($_POST);
$brand_id=$POST['brand_id'];
$category_id=$POST['category_id'];
$product_html="<div class='prod_blurb_con'>";
$sql_product=$objTypes->fetchAll("select a.id,a.title,a.short_description,a.category_id,a.brand_id,b.thumbnail,a.application_id,b.image from tbl_products_details as a left join tbl_products_images as b on a.id=b.product_id where a.brand_id='".$brand_id."' and a.category_id='".$category_id."' and a.is_active=1 and is_delete=1 order by a.title asc");
    if(count($sql_product)>0){
			  foreach($sql_product as $product){
$datacategory = $objTypes->fetchRow('select title,id from tbl_categories where id='.$product['application_id'] );
$datachemistry = $objTypes->fetchRow('select title,id from tbl_categories where id='.$product['category_id'] );
$databrand = $objTypes->fetchRow('select * from tbl_brands where id='.$product['brand_id'] );

				$product_html.="<div class='product_blurb'><a href='".base_url."v/".$objTypes->prepare_url(stripslashes($datacategory['title']))."/".$objTypes->prepare_url(stripslashes($datachemistry['title']))."/".$objTypes->prepare_url(stripslashes($databrand['title']))."/".$objTypes->prepare_url(stripslashes($product['title']))."-".$product['id']."'>
									<h3><span>".stripslashes($product['title'])."</span></h3>
									<div class='product_list'>
										 <div class='img_hld'> <img src='".base_url."uploads/product_images/".$product['thumbnail']."' alt='".$product['thumbnail']."'></div>
										 <p>". substr(strip_tags(stripslashes($product['short_description'])),0,100)."...</p>
									</div>
									 <div class='explore_product'><img src='".base_url."assets/images/icon-plus.png' alt=''></div>
								</a></div>";

			  }

			}
$product_html.="</div>";
echo $product_html;
?>