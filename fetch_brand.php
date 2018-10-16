<?php 
include_once('config/config.php');
$POST   = $objTypes->validateUserInput($_REQUEST);


if(isset($POST["limit"], $POST["start"]))
{


$sqlbrandlist=$objTypes->fetchAll("select a.title,a.thumbnail1,a.id,a.description from tbl_products_details as b left join  tbl_brands as a on b.brand_id=a.id where a.is_active=1 and a.is_delete=1 group by a.id order by a.sortorder asc limit ".$POST["start"].",".$POST["limit"]);
$data_show='';
   if(count($sqlbrandlist)>0)
   {
              foreach($sqlbrandlist as $brandlist)
              {
              	$data_show.='<div class="product_blurb">
              <a href="'.base_url.'b/'.$objTypes->prepare_url(stripslashes($brandlist['title'])).'-'.$brandlist['id'].'">
              <h3><span>'.stripslashes($brandlist['title']).'</span></h3>
              <div class="product_list">
                <div class="img_hld">
                    <img src="'.base_url.'uploads/brand_images/'.$brandlist['thumbnail1'].'" alt="">
                </div>
               
              </div>
              <div class="explore_product">
                <img src="'.base_url.'assets/images/icon-plus.png" alt="">
              </div>
            </a>
            </div>';
              }
          

    }
echo $data_show;
 }