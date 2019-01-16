<!-- Content Wrapper. Contains page content -->
<?php 
require_once("left.php");

#==== Object Initialisations
$POST		= $objTypes->validateUserInput($_POST);
$id 		= isset($POST['id']) ? intval($POST['id']) : intval($_REQUEST['id']) ;
$mode 		= ($id<>'0') ? 'Edit' : 'Add';
$params     = array(":id" => $id);
$params_img    = array(":category_id" => $id);
if($id!=0){
$TypeArray	= $objTypes->fetchRow("SELECT id, title, image1,thumb_logo_image,logo_image,listing_image,thumb_listing_image,thumbnail1, description, image, parent_category_id, thumbnail, added_by, updated_by, updated_date FROM tbl_brands  WHERE id = :id", $params);
$TypeArray1	= $objTypes->fetchRow("SELECT id,parent_category_id,title FROM tbl_categories WHERE id =".$TypeArray['parent_category_id']);
}
//$TypeArray	= $objTypes->fetchRow("SELECT a.*,b.title as categoryname,b.parent_category_id as application_id FROM `tbl_brands` as a left join `tbl_categories` as b on b.`id`=a.`parent_category_id` where a.id=14
//echo ">>>";  print_r($TypeArray); exit;
?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> <?=$mode?> Brand <small></small> </h1>
    <ol class="breadcrumb">
      <li><a href="list_brand.php"><i class="fa  fa-navicon"></i> Brand List</a></li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <!--Table Start-->
    <div class="row">
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary" >
          <div class="box-header">
            <h3 class="box-title"></h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <p>
        	<div class="callout callout-danger errorDiv" <?php $objSystemMsg->createStyle($sysmsg);?> >
        		<span id="errormessage"><?php echo $objSystemMsg->displayError($sysmsg); ?></span>
        	</div>
          </p>
          <form role="form" method="post" action="act_brand.php" onsubmit="return validateForm();" enctype="multipart/form-data">
          <input type="hidden" name="id" id="id" value="<?=$TypeArray['id']?>"  />
           <input type="hidden" name="pgNo" id="pgNo" value="<?=$_REQUEST['pgNo']?>"  />
            <div class="box-body">
				  <div class="form-group">
					  <label for="exampleInputEmail1">Title<?=MANDATORY?></label>
					  <input type="text" class="form-control " id="title1" name="title1" value="<?=stripslashes($TypeArray['title'])?>" placeholder="Title" style="width:40%;">
				  </div>
				  <!--
				  <div class="form-group">
                  <label for="exampleInputEmail1">Application<?=MANDATORY?></label>
                  <select class="form-control" name="category_type" id="category_type" style="width: 40%">
                      <option value="">Select Application</option>
					  <?php
                      $CatArray1	= $objTypes->fetchAll("SELECT title, id FROM tbl_categories WHERE parent_category_id='0' AND is_delete='1' AND is_active='1'", $params);
						if(sizeof($CatArray1) > 0){
							foreach($CatArray1 as $cat_v1){
								if($cat_v1['id'] == $TypeArray1['parent_category_id']){
									$selected1 = 'selected';
								}
								else{
									$selected1 = '';
								}
								?>
								<option value="<?php echo $cat_v1['id'] ?>" <?=$selected1?>><?php echo stripslashes($cat_v1['title']); ?></option>
								<?php
							}
						}
						?>
				  </select>
              </div>
			   <div class="form-group" id="parcat">
                <label for="exampleInputEmail1">Category</label>
				<?php //if($id!=""){?>
                <select class="form-control" name="parent_category_id" id="parent_category_id" style="width: 40%">
                    <option value="">Select Parent Category</option>
                    <?php
                    //$params['parent_category_id'] = 0;
						$params1=array(":parent_category_id"=>$TypeArray1['parent_category_id'], ":category_type"=>"chemistry","is_active"=>1,"is_delete"=>1);
						$CatArray	= $objTypes->fetchAll("SELECT title, id FROM tbl_categories WHERE parent_category_id = :parent_category_id AND category_type=:category_type AND is_active=:is_active AND is_delete=:is_delete",$params1);
						if(sizeof($CatArray) > 0){
							foreach($CatArray as $cat_v){
								if($cat_v['id'] == $TypeArray['parent_category_id']){
									$selected = 'selected';
								}
								else{
									$selected = '';
								}
								?>
								<option value="<?php echo $cat_v['id'] ?>" <?=$selected?>><?php echo stripslashes($cat_v['title']); ?></option>
								<?php
							}
						}
					
					
                    ?>
                </select>
				<?php //}?>
				<div id="result_data"></div>
              </div>
              
              -->
				 
				  <div class="form-group">
						<label for="exampleInputEmail1">Image</label>
						<input type="file" class="form-control " id="image" name="image" value="" placeholder="Brand Image" style="width:40%;" onchange="return Checkfile()">
						<div class="alert alert-danger alert-dismissible" style="width:40%;margin-top:10px;">[Note:- File Size : 285 x 285  , MAX File Upload Size : 3MB]</div>
						<?php if($TypeArray['image']){ ?>
						<a href="#" id='existing_image'><img src="../uploads/brand_images/<?=stripslashes($TypeArray['image'])?>"  onerror="this.style.display='none'" width="100" onclick='window.open("../uploads/brand_images/<?=stripslashes($TypeArray['image'])?>","","width=600,height=600,scrollbars=Yes,resizable=yes")' /></a>
						<?php } ?>
						 <input type="hidden" name="store_image" value="<?php echo $TypeArray['image']; ?>">
				  </div>
				  <div class="form-group">
						<label for="exampleInputEmail1">Mouseover Image</label>
						<input type="file" class="form-control " id="image1" name="image1" value="" placeholder="Brand Image" style="width:40%;" onchange="return Checkfile1()">
						<div class="alert alert-danger alert-dismissible" style="width:40%;margin-top:10px;">[Note:- File Size : 285 x 285  , MAX File Upload Size : 3MB]</div>
						<?php if($TypeArray['image1']){ ?>
						<a href="#" id='existing_image1'><img src="../uploads/brand_images/<?=stripslashes($TypeArray['image1'])?>"  onerror="this.style.display='none'" width="100" onclick='window.open("../uploads/brand_images/<?=stripslashes($TypeArray['image1'])?>","","width=600,height=600,scrollbars=Yes,resizable=yes")' /></a>
						<?php } ?>
						 <input type="hidden" name="store_image1" value="<?php echo $TypeArray['image1']; ?>">
				  </div>
				  
				  <div class="form-group">
						<label for="exampleInputEmail1">Logo Image</label>
						<input type="file" class="form-control " id="logoimage" name="logoimage" value="" placeholder="Brand Logo Image" style="width:40%;" onchange="return Checkfile2()">
						<div class="alert alert-danger alert-dismissible" style="width:40%;margin-top:10px;">[Note:- File Size : 122 x 119  , MAX File Upload Size : 3MB]</div>
						<?php if($TypeArray['logo_image']){ ?>
						<a href="#" id='existing_image2'><img src="../uploads/brand_images/logo/<?=stripslashes($TypeArray['logo_image'])?>"  onerror="this.style.display='none'" width="100" onclick='window.open("../uploads/brand_images/logo/<?=stripslashes($TypeArray['logo_image'])?>","","width=600,height=600,scrollbars=Yes,resizable=yes")' /></a>
						<?php } ?>
						 <input type="hidden" name="logo_image" value="<?php echo $TypeArray['thumb_logo_image']; ?>">
				  </div>
				  <div class="form-group">
						<label for="exampleInputEmail1">Listing Page Image</label>
						<input type="file" class="form-control " id="listingimage" name="listingimage" value="" placeholder="Brand Listing Image" style="width:40%;" onchange="return Checkfile3()">
						<div class="alert alert-danger alert-dismissible" style="width:40%;margin-top:10px;">[Note:- File Size : 361 x 220  , MAX File Upload Size : 3MB]</div>
						<?php if($TypeArray['listing_image']){ ?>
						<a href="#" id='existing_image3'><img src="../uploads/brand_images/listing_image/<?=stripslashes($TypeArray['thumb_listing_image'])?>"  onerror="this.style.display='none'" width="100" onclick='window.open("../uploads/brand_images/<?=stripslashes($TypeArray['image'])?>","","width=600,height=600,scrollbars=Yes,resizable=yes")' /></a>
						<?php } ?>
						 <input type="hidden" name="listing_image" value="<?php echo $TypeArray['listing_image']; ?>">
				  </div>
				  <div class="form-group">
                <label for="exampleInputEmail1">Description</label>
                <textarea class="form-control" id="editor1" name="description"  rows="10" cols="80" placeholder="Description..." ><?=stripslashes($TypeArray['description'])?></textarea>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Meta Title</label>
                <input type="text" class="form-control " id="meta_title" name="meta_title" value="<?=stripslashes($TypeArray['meta_title'])?>" placeholder="Meta Title" style="width:40%;">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Meta Keywords</label>
                <input type="text" class="form-control " id="meta_keywords" name="meta_keywords" value="<?=stripslashes($TypeArray['meta_keywords'])?>" placeholder="Meta Keywords" style="width:40%;">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Meta Description</label>
                <textarea class="form-control" rows="3" name="meta_description" id="meta_description" placeholder="Meta Description ..." style="width:40%;"><?=stripslashes($TypeArray['meta_description'])?></textarea>
              </div>
              
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-primary" value="SAVE" name="SAVE" id="SAVE">Submit</button>
              <a href="list_brand.php" class="btn btn-danger" >Back</a>
            </div>
          </form>
        </div>
        <!-- /.box -->
      </div>
    </div>
    <!--Table End-->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php require_once("footer.php"); ?>
<div class='control-sidebar-bg'></div>
</div>
<!-- ./wrapper -->
<!-- REQUIRED JS SCRIPTS -->
<!-- jQuery 2.1.4 -->
<script src="<?=base_url?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="<?=base_url?>bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="<?=base_url?>dist/js/app.min.js" type="text/javascript"></script>
<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
</body>
</html>
<script type="text/javascript" language="javascript">

$('textarea').keypress(function(e) {
    var tval = $('textarea').val(),
        tlength = tval.length,
        set = 100,
        remain = parseInt(set - tlength);
    $('#cnt').text(remain);
    if (remain <= 0 && e.which !== 0 && e.charCode !== 0) {
        $('textarea').val((tval).substring(0, tlength - 1))
    }
})


var sysmsg = "<?=$sysmsg?>";
if(sysmsg==0){
	$(".errorDiv").hide();
}
else{
	$(".errorDiv").show().fadeOut(4000);
}
</script>
<script type="text/javascript" language="javascript">
$(document).ready(function(){
	var cat;
	var title=$("#title").val();
	var cat=$("#category_type").val();
	if(title==""){
		$("#parcat").hide();
	}
	$("#category_type").on('change',function(){
		cat=$(this).val();
		
		
			$("#parcat").css('display','block');
			$("#parent_category_id").css('display','none');
			$.ajax({
				  method: "POST",
				  url: "fetch_parent.php",
				  data: { category_type: cat },
				  success: function(result){
					 
						if(result==''){
						 $("#parcat").css('display','none');
						}
						$("#result_data").html(result);
					}});
		
				
	});
	
});
function validateForm(){
	
	if($("#title1").val()==""){
		$(".errorDiv").show().fadeOut(4000);
		$('#errormessage').text("Please enter title1");
		$("#title1").focus();
		return false;
	}
	/*if($("#category_type").val()==""){
		$(".errorDiv").show().fadeOut(4000);
		$('#errormessage').text("Please enter application");
		$("#category_type").focus();
		return false;
	}
	
	
	if($("#parent_category_id2").val()==""){
		$(".errorDiv").show().fadeOut(4000);
		$('#errormessage').text("Please enter category");
		$("#parent_category_id2").focus();
		return false;
	}*/
	
	/*var image_name = '<?php echo  $TypeArray['image'] ?>';
	if(image_name !='')
	{
		if($("#existing_image").html()=='')
		{
			
			if($("input#image").val()==""){
			$(".errorDiv").show().fadeOut(4000);
			$('#errormessage').text("Image is Mandatory");
			$("input#image").focus();
			return false;
			}
		}
	}
	else{
			if($("input#image").val()==""){
			$(".errorDiv").show().fadeOut(4000);
			$('#errormessage').text("Image is Mandatory");
			$("input#image").focus();
			return false;
			}
	}
	var image_name1 = '<?php echo  $TypeArray['image1'] ?>';
	if(image_name1 !='')
	{
		if($("#existing_image1").html()=='')
		{
			
			if($("input#image1").val()==""){
			$(".errorDiv").show().fadeOut(4000);
			$('#errormessage').text("Image is Mandatory");
			$("input#image1").focus();
			return false;
			}
		}
	}
	else{
			if($("input#image1").val()==""){
			$(".errorDiv").show().fadeOut(4000);
			$('#errormessage').text("Image is Mandatory");
			$("input#image1").focus();
			return false;
			}
	}
*/
	/*var logo_image = '<?php echo  $TypeArray['logo_image'] ?>';
	if(logo_image !='')
	{
		if($("#existing_image2").html()=='')
		{
			
			if($("input#logoimage").val()==""){
			$(".errorDiv").show().fadeOut(4000);
			$('#errormessage').text("Image is Mandatory");
			$("input#logoimage").focus();
			return false;
			}
		}
	}
	else{
			if($("input#logoimage").val()==""){
			$(".errorDiv").show().fadeOut(4000);
			$('#errormessage').text("Logo Image is Mandatory");
			$("input#logoimage").focus();
			return false;
			}
	}
	
	var listing_image = '<?php echo  $TypeArray['listing_image'] ?>';
	if(listing_image !='')
	{
		if($("#existing_image3").html()=='')
		{
			
			if($("input#listingimage").val()==""){
			$(".errorDiv").show().fadeOut(4000);
			$('#errormessage').text("Image is Mandatory");
			$("input#listingimage").focus();
			return false;
			}
		}
	}
	else{
			if($("input#listingimage").val()==""){
			$(".errorDiv").show().fadeOut(4000);
			$('#errormessage').text("Listing Image is Mandatory");
			$("input#listingimage").focus();
			return false;
			}
	}*/
	return true;
}

function Checkfile(){
	var fup = document.getElementById('image');
	var fileName = fup.value;
	var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
	if(ext == "jpg" || ext == "JPG"  || ext == "gif" || ext == "GIF" || ext == "png" || ext == "PNG" || ext == "jpeg" || ext == "JPEG"){
		//return true;
	}else{
		alert('Upload jpg, png, gif files only.');
		$(".errorDiv").show().fadeOut(4000);
		$('#errormessage').text("Upload jpg, png, gif files only.");
		$("input#image").focus();
		$("input#image").val("");
		return false;
	}
}

function Checkfile1(){
	var image1 = document.getElementById('image1');
	var fileName = image1.value;
	var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
	if(ext == "jpg" || ext == "JPG"  || ext == "gif" || ext == "GIF" || ext == "png" || ext == "PNG" || ext == "jpeg" || ext == "JPEG"){
		//return true;
	}else{
		alert('Upload jpg, png, gif files only.');
		$(".errorDiv").show().fadeOut(4000);
		$('#errormessage').text("Upload jpg, png, gif files only.");
		$("input#image1").focus();
		$("input#image1").val("");
		return false;
	}
}
function Checkfile2(){
	var logoimage = document.getElementById('logoimage');
	var fileName = logoimage.value;
	var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
	if(ext == "jpg" || ext == "JPG"  || ext == "gif" || ext == "GIF" || ext == "png" || ext == "PNG" || ext == "jpeg" || ext == "JPEG"){
		//return true;
	}else{
		alert('Upload jpg, png, gif files only.');
		$(".errorDiv").show().fadeOut(4000);
		$('#errormessage').text("Upload jpg, png, gif files only.");
		$("input#logoimage").focus();
		$("input#logoimage").val("");
		return false;
	}
}
function Checkfile3(){
	var listingimage = document.getElementById('listingimage');
	var fileName = listingimage.value;
	var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
	if(ext == "jpg" || ext == "JPG"  || ext == "gif" || ext == "GIF" || ext == "png" || ext == "PNG" || ext == "jpeg" || ext == "JPEG"){
		//return true;
	}else{
		alert('Upload jpg, png, gif files only.');
		$(".errorDiv").show().fadeOut(4000);
		$('#errormessage').text("Upload jpg, png, gif files only.");
		$("input#listingimage").focus();
		$("input#listingimage").val("");
		return false;
	}
}

  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1');
	
    //bootstrap WYSIHTML5 - text editor
    $(".textarea").wysihtml5();
  });
</script>

