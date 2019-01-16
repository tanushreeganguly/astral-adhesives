<!-- Content Wrapper. Contains page content -->
<?php
require_once("left.php");
#==== Object Initialisations
$POST		= $objTypes->validateUserInput($_POST);
$id 		= isset($POST['id']) ? intval($POST['id']) : intval($_REQUEST['id']) ;
$mode 		= ($id<>'0') ? 'Edit' : 'Add';
$params     = array(":id" => $id);
//$TypeArray	= $objTypes->fetchRow("SELECT id, externalurl, title, short_description,seo_description, description, catalogue, envelope, category_id, meta_title, meta_keywords, meta_description, youtube,is_demo_available FROM tbl_products_details WHERE id = :id", $params);
$params_img    = array(":category_id" => $id);

if($id!=0){
$TypeArray	= $objTypes->fetchRow("SELECT * FROM tbl_products_details WHERE id = :id", $params);
//$TypeArray1	= $objTypes->fetchRow("SELECT id,parent_category_id,title FROM tbl_categories WHERE id =".$TypeArray['parent_category_id']);
}
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> <?=$mode?> Product <small></small> </h1>
    <ol class="breadcrumb">
      <li><a href="list_product.php"><i class="fa  fa-navicon"></i> Product List</a></li>
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
          <form id="productForm" role="form" method="post" action="act_product.php" onsubmit="return validateForm();" enctype="multipart/form-data">
          <input type="hidden" name="id" id="id" value="<?=$TypeArray['id']?>"  />
           <input type="hidden" name="pgNo" id="pgNo" value="<?=$_REQUEST['pgNo']?>"  />
            <div class="box-body">
              <div class="form-group">
                <label for="exampleInputEmail1">Title<?=MANDATORY?></label>
                <input type="text" class="form-control " id="title" name="title" value="<?=stripslashes($TypeArray['title'])?>" placeholder="Title" style="width:40%;">
              </div>
			   <div class="form-group">
                  <label for="exampleInputEmail1">Application<?=MANDATORY?></label>
                  <select class="form-control" name="category_type" id="category_type" style="width: 40%">
                      <option value="">Select Application</option>
					  <?php
                      $CatArray1	= $objTypes->fetchAll("SELECT title, id FROM tbl_categories WHERE parent_category_id='0' AND is_delete='1' AND is_active='1'", $params);
						if(sizeof($CatArray1) > 0){
							foreach($CatArray1 as $cat_v1){
								if($cat_v1['id'] == $TypeArray['application_id']){
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
                <label for="exampleInputEmail1">Category<?=MANDATORY?></label>
				<?php //if($id!=""){?>
                <select class="form-control" name="parent_category_id" id="parent_category_id" style="width: 40%">
                    <option value="">Select Category</option>
                    <?php
                    //$params['parent_category_id'] = 0;
						$params1=array(":category_type"=>"chemistry","is_active"=>1,"is_delete"=>1);
						$CatArray	= $objTypes->fetchAll("SELECT title, id FROM tbl_categories WHERE category_type=:category_type AND is_active=:is_active AND is_delete=:is_delete",$params1);
						if(sizeof($CatArray) > 0){
							foreach($CatArray as $cat_v){
								if($cat_v['id'] == $TypeArray['category_id']){
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
              
              <div class="form-group" id="cat">
                <label for="exampleInputEmail1">Brand<?=MANDATORY?></label>
                <select class="form-control" name="brand_id" id="brand_id" style="width: 40%">
                    <option value="">Select Brand</option>
                    <?php
                    $params     = array(":is_active" => '1', ":is_delete" => '1');
                    $CatArray	= $objTypes->fetchAll("SELECT title, id FROM tbl_brands WHERE is_active = :is_active AND is_delete = :is_delete", $params);
                    if(sizeof($CatArray) > 0){
                        foreach($CatArray as $cat_v){
                            if($cat_v['id'] == $TypeArray['brand_id']){
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
				<div id="result_data1"></div>
              </div>
              
             
              
              <div class="form-group">
                  <label for="exampleInputEmail1">Product Images</label>
                  <input type="file" class="form-control " id="images" name="images[]" value="" placeholder="Product Images" style="width:40%;" onchange="return Checkfile1()" multiple="multiple">
                  <div class="alert alert-danger alert-dismissible" style="width:40%;margin-top:10px;">[Note:- Extension : JPG, JPEG, BMP, GIF, PNG <br />MAX File Upload Size : 3MB<br /></div>
                  <?php
                  $sql      = "SELECT id, image, thumbnail FROM tbl_products_images WHERE product_id = :product_id";
                  $bind     = array(":product_id" => $id);
                  $images   = $objTypes->fetchAll($sql, $bind);
                  foreach($images as $image){
                      ?>
                      <div class="img-wrap2">
                          <span class="close2">&times;</span>
                          <img src="../uploads/product_images/<?php echo $image['thumbnail'] ?>" data-id="<?php echo $image['id'] ?>">
                      </div>
                      <?php
                  }
                  ?>
              </div>
			     <div class="form-group">
                  <label for="exampleInputEmail1">Product Working Envelope</label>
                  <input type="file" class="form-control " id="envelope" name="envelope" value="" placeholder="Product Envelope" style="width:40%;" onchange="return Checkpdf(envelope)" multiple="multiple">
                  <div class="alert alert-danger alert-dismissible" style="width:40%;margin-top:10px;">[Note:- Extension : PDF, pdf <br />MAX File Upload Size : 3MB<br /></div>
                  <?php
                 
                  if($TypeArray['envelope']){
                      ?>
                      <div class="">
                         
                          <a href="../uploads/products_pdf/<?php echo $TypeArray['envelope'] ?>" target="_blank">View Envelope</a>
                      </div>
                      <?php
                 	 }
                  ?>
              </div>
                           
              <div class="form-group">
                <label for="exampleInputEmail1">Short Description</label>
                <textarea class="form-control" placeholder="Short Description..." name="short_description" id="editor1" rows="3" ><?=stripslashes($TypeArray['short_description'])?></textarea>
              </div>
               <div class="form-group">
                <label for="exampleInputEmail1">Packing</label>
                <textarea class="form-control" placeholder="Packing..." name="packing" id="editor2" rows="3" style="width:40%;"><?=stripslashes($TypeArray['packing'])?></textarea>
              </div>
              
              <div class="form-group">
                <label for="exampleInputEmail1">Applications</label>
                <textarea class="form-control" placeholder="Application..." name="application" id="editor3" rows="3" style="width:40%;"><?=stripslashes($TypeArray['application'])?></textarea>
              </div>
			        <div class="form-group">
                <label for="exampleInputEmail1">How to Use</label>
                <textarea class="form-control" placeholder="How to Use..." name="how_to_use" id="editor4" rows="3" style="width:40%;"><?=stripslashes($TypeArray['how_to_use'])?></textarea>
              </div>
			        <div class="form-group">
                <label for="exampleInputEmail1">Shelf Life</label>
                <textarea class="form-control" placeholder="Shelf Life..." name="shelf_life" id="editor5" rows="3" style="width:40%;"><?=stripslashes($TypeArray['shelf_life'])?></textarea>
              </div>
			        <div class="form-group">
                <label for="exampleInputEmail1">Restriction of Usage</label>
                <textarea class="form-control" placeholder="Restriction Of Usage..." name="restriction_usage" id="editor6" rows="3" style="width:40%;"><?=stripslashes($TypeArray['restriction_usage'])?></textarea>
              </div>
			        <div class="form-group">
                <label for="exampleInputEmail1">Hazardous</label>
                <textarea class="form-control" placeholder="Hazardous..." name="hazards" id="editor7" rows="3" style="width:40%;"><?=stripslashes($TypeArray['hazards'])?></textarea>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Advantage</label>
                <textarea class="form-control" placeholder="Advantage..." name="advantage" id="editor11" rows="3" style="width:40%;"><?=stripslashes($TypeArray['advantage'])?></textarea>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Dosage</label>
                <textarea class="form-control" placeholder="Dosage..." name="dosage" id="editor12" rows="3" style="width:40%;"><?=stripslashes($TypeArray['dosage'])?></textarea>
              </div>
			        <div class="form-group">
                <label for="exampleInputEmail1">Handling Precautions</label>
                <textarea class="form-control" placeholder="Handling Precautions" name="handling_precaution" id="editor8" rows="3" style="width:40%;"><?=stripslashes($TypeArray['handling_precaution'])?></textarea>
              </div>
			        <div class="form-group">
                <label for="exampleInputEmail1">Technical Details</label>
                <textarea class="form-control" placeholder="Technical Details" name="technical_details" id="editor9" rows="3" style="width:40%;"><?=stripslashes($TypeArray['technical_details'])?></textarea>
              </div>
			        <div class="form-group">
                <label for="exampleInputEmail1">Storage</label>
                <textarea class="form-control" placeholder="Storage" name="stroage" id="editor10" rows="3" style="width:40%;"><?=stripslashes($TypeArray['stroage'])?></textarea>
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
              <a href="list_product.php?&pgNo=<?php echo intval(base64_decode($_REQUEST['pgNo'])); ?>" class="btn btn-danger" >Back</a>
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
<script>
jQuery(function(){
    jQuery('.img-wrap2 .close2').click(function() {
        var id = $(this).closest('.img-wrap2').find('img').data('id');
        if(confirm('Are you sure you want to delete selected images?')) {
           	window.location.href = '<?=base_url?>act_product.php?id='+id+'&param=rimg&prodid=<?php echo $id ?>&pgNo=<?=$_REQUEST['pgNo']?>';
           $(this).closest("#productForm").append('<input type="hidden" name="param" value="rimg" /><input type="hidden" name="id" value="'+id+'" /><input type="hidden" name="prodid" value="<?php echo $id ?>" /><input type="hidden" name="pgNo" value="<?=$_REQUEST['pgNo']?>" />');
           $(this).closest("#productForm").submit();
        }
        else{
            return false;
        }
    });
})
</script>
<script type="text/javascript" language="javascript">
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
		$("#cat").hide();
		
	}
	$("#category_type").on('change',function(){
		cat=$(this).val();
		
		
			$("#parcat").css('display','block');
			$("#parent_category_id").css('display','none');
			$("#cat").css('display','none');
			$.ajax({
				  method: "POST",
				  url: "fetch_parent.php",
				  data: { category_type: cat },
				  success: function(result){
					 if(result==''){
						 $("#parcat").css('display','none');
					 }
						$("#result_data").html(result);
						$("#parent_category_id2").on('change',function(){
							
							category_id=$(this).val();
							
							
								$("#cat").css('display','block');
								//$("#brand_id").css('display','none');
								
							/*	$.ajax({
									  method: "POST",
									  url: "fetch_brand.php",
									  data: { category_id:category_id},
									  success: function(result1){
										 
											$("#result_data1").html(result1);
										}});*/
							
						});
					}});
				
						
	});

	
	
});

function validateForm(){
	if($("input#title").val()==""){
		$(".errorDiv").show().fadeOut(4000);
		$('#errormessage').text("Product Title is Mandatory");
		$("input#title").focus();
		return false;
	}
	if($("#category_type").val()==""){
		$(".errorDiv").show().fadeOut(4000);
		$('#errormessage').text("Product application is Mandatory");
		$("#category_type").focus();
		return false;
	}
	if($("#parent_category_id2").val()==""){
		$(".errorDiv").show().fadeOut(4000);
		$('#errormessage').text("Product category is Mandatory");
		$("#parent_category_id2").focus();
		return false;
	}
	if($("#brand_id2").val()==""){
		$(".errorDiv").show().fadeOut(4000);
		$('#errormessage').text("Product brand is Mandatory");
		$("#brand_id2").focus();
		return false;
	}
	return true;
}

function Checkfile1(){
	var fup = document.getElementById('images');
	var fileName = fup.value;
	var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
	if(ext == "jpg" || ext == "JPG"  || ext == "gif" || ext == "GIF" || ext == "png" || ext == "PNG" || ext == "jpeg" || ext == "JPEG"){
		//return true;
	}else{
		alert('Upload jpg, png, gif files only.');
		$(".errorDiv").show().fadeOut(4000);
		$('#errormessage').text("Upload jpg, png, gif files only.");
		$("input#images").focus();
		$("input#images").val("");
		return false;
	}
}

function Checkpdf(pdf_id){
	var fup = pdf_id
	var fileName = fup.value;
	var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
	if(ext == "pdf" || ext == "PDF" ){
		//return true;
	}else{
		alert('Upload pdf files only.');
		$(".errorDiv").show().fadeOut(4000);
		$('#errormessage').text("Upload pdf files only.");
		$("input#images").focus();
		$("input#images").val("");
		return false;
	}
}


</script>
<script>
  $(function () {
     //config.allowedContent = 'span';
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
  CKEDITOR.replace('editor1');
	CKEDITOR.replace('editor2');
	CKEDITOR.replace('editor3');
	CKEDITOR.replace('editor4');
	CKEDITOR.replace('editor5');
	CKEDITOR.replace('editor6');
	CKEDITOR.replace('editor7');
	CKEDITOR.replace('editor8');
	CKEDITOR.replace('editor9');
	CKEDITOR.replace('editor10');
  CKEDITOR.replace('editor11');
  CKEDITOR.replace('editor12');
    //bootstrap WYSIHTML5 - text editor
    $(".textarea").wysihtml5();
  });
</script>

<style>
.img-wrap2 {
    position: relative;
    display: inline-block;
    border: 1px red solid;
    font-size: 0;
}
.img-wrap2 .close2 {
    position: absolute;
    top: 2px;
    right: 2px;
    z-index: 100;
    background-color: #FFF;
    padding: 5px 2px 2px;
    color: #000;
    font-weight: bold;
    cursor: pointer;
    opacity: .2;
    text-align: center;
    font-size: 22px;
    line-height: 10px;
    border-radius: 50%;
}
.img-wrap2:hover .close2 {
    opacity: 1;
}
</style>
