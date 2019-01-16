<!-- Content Wrapper. Contains page content -->
<?php
require_once("left.php");

#==== Object Initialisations
$POST		= $objTypes->validateUserInput($_POST);
$id 		= isset($POST['id']) ? intval($POST['id']) : intval($_REQUEST['id']) ;
$mode 		= ($id<>'0') ? 'Edit' : 'Add';
$params     = array(":id" => $id);
$params_img    = array(":category_id" => $id);
$TypeArray	= $objTypes->fetchRow("SELECT * FROM tbl_categories WHERE id = :id", $params);


$TypeArray_images	= $objTypes->fetchAll("SELECT * FROM tbl_categories_images WHERE category_id = :category_id", $params_img);

?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> <?=$mode?> Category <small></small> </h1>
    <ol class="breadcrumb">
      <li><a href="list_categories.php"><i class="fa  fa-navicon"></i> Categories List</a></li>
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
          <form role="form" method="post" action="act_categories.php" onsubmit="return validateForm();" enctype="multipart/form-data">
          <input type="hidden" name="id" id="id" value="<?=$TypeArray['id']?>"  />
           <input type="hidden" name="pgNo" id="pgNo" value="<?=$_REQUEST['pgNo']?>"  />
            <div class="box-body">
			<div class="form-group">
                <label for="exampleInputEmail1">Title<?=MANDATORY?></label>
                <input type="text" class="form-control " id="title" name="title" value="<?=stripslashes($TypeArray['title'])?>" placeholder="Title" style="width:40%;">
              </div>
			<div class="form-group">
                  <label for="exampleInputEmail1">Application</label>
                  <select class="form-control" name="category_type" id="category_type" style="width: 40%">
                      <option value="">Select Application</option>
					  <?php
                      $CatArray1	= $objTypes->fetchAll("SELECT title, id FROM tbl_categories WHERE parent_category_id='0' AND is_delete='1' AND is_active='1'", $params);
						if(sizeof($CatArray1) > 0){
							foreach($CatArray1 as $cat_v1){
								if($cat_v1['id'] == $TypeArray['parent_category_id']){
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
			 <!--  <div class="form-group" id="parcat">
                <label for="exampleInputEmail1">Parent Category</label>
				<?php //if($id!=""){?>
                <select class="form-control" name="parent_category_id" id="parent_category_id" style="width: 40%">
                    <option value="">Select Parent Category</option>
                    <?php
                    //$params['parent_category_id'] = 0;
					
						$CatArray	= $objTypes->fetchAll("SELECT title, id FROM tbl_categories WHERE id != :id AND is_delete='1' AND is_active='1'", $params);
						if(sizeof($CatArray) > 0){
							foreach($CatArray as $cat_v){
								if($cat_v['id'] == $TypeArray['parent_category_id'] && $TypeArray['parent_category_id']!=$TypeArray['category_type']){
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
              </div>-->
              
              
              
             
              <div class="form-group">
                <label for="exampleInputEmail1">Short Description</label>
                <textarea class="form-control" placeholder="Short Description..." name="short_description" id="short_description" rows="3" style="width:40%;"><?=stripslashes($TypeArray['short_description'])?></textarea>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Description</label>
                <textarea class="form-control" id="editor1" name="description"  rows="10" cols="80" placeholder="Description..." ><?=stripslashes($TypeArray['description'])?></textarea>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Image For Category</label>
                <input type="file" class="form-control " id="image" name="image" value="" placeholder="Category Image" style="width:40%;" onchange="return Checkfile()">
                <div class="alert alert-danger alert-dismissible" style="width:40%;margin-top:10px;">[Note:- Extension : JPG, JPEG, BMP, GIF, PNG <br />MAX File Upload Size : 3MB]</div>
                <?php if($TypeArray['image']){ ?>
                <a href="#" id='existing_image'><img src="../uploads/category_images/<?=stripslashes($TypeArray['image'])?>"  onerror="this.style.display='none'" height="80" width="100" onclick='window.open("../uploads/category_images/<?=stripslashes($TypeArray['image'])?>","","width=600,height=600,scrollbars=Yes,resizable=yes")' /></a>
				<?php } ?>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Image For icon</label>
                <input type="file" class="form-control " id="icon" name="icon" value="" placeholder="Category Icon" style="width:40%;" onchange="return Checkfile3()">
                <div class="alert alert-danger alert-dismissible" style="width:40%;margin-top:10px;">[Note:- Extension : JPG, JPEG, BMP, GIF, PNG <br />MAX File Upload Size : 3MB]</div>
                <?php if($TypeArray['icon']){ ?>
                <a href="#" id='existing_icon'><img src="../uploads/category_images/icon/<?=stripslashes($TypeArray['icon'])?>"  onerror="this.style.display='none'" height="14" width="14" onclick='window.open("../uploads/category_images/icon/<?=stripslashes($TypeArray['icon'])?>","","width=14,height=14,scrollbars=Yes,resizable=yes")' /></a>
				<?php } ?>
              </div>

			  <!--<div class="form-group">
                <label for="exampleInputEmail1">Image For Multiple Categories</label>
                <input type="file" class="form-control " id="mul_image" name="mul_image[]" value="" placeholder="Category Multiple Image" style="width:40%;"  multiple="multiple">
                <div class="alert alert-danger alert-dismissible" style="width:40%;margin-top:10px;">[Note:- Extension : JPG, JPEG, BMP, GIF, PNG <br />MAX File Upload Size : 3MB]</div>
                <?php if($TypeArray_images){
				foreach($TypeArray_images as $mu_image)
				{ ?>
				<a href="#"><img src="../uploads/category_images/<?=stripslashes($mu_image['image'])?>"  onerror="this.style.display='none'" height="80" width="100" onclick='window.open("../uploads/category_images/<?=stripslashes($mu_image['image'])?>","","width=600,height=600,scrollbars=Yes,resizable=yes")' /></a>

				<?php } } ?>
              </div>
              
              
               <div class="form-group">
                <label for="exampleInputEmail1">External Url</label>
                <input type="url" class="form-control " id="externalurl" name="externalurl" value="<?=$TypeArray['externalurl']?>" placeholder="External Url" style="width:40%;">
              </div>
              
              
              
              <div class="form-group">
                  <label for="exampleInputEmail1">Category Catalogue</label>
                  <input type="file" class="form-control " id="catalogue" name="catalogue" value="" placeholder="Cqtegory Catalogue" style="width:40%;" onchange="return Checkpdf(catalogue)" multiple="multiple">
                  <div class="alert alert-danger alert-dismissible" style="width:40%;margin-top:10px;">[Note:- Extension : PDF, pdf <br />MAX File Upload Size : 3MB<br /></div>
                  <?php
                 
                  if($TypeArray['catalogue']){
                      ?>
                      <div >
                         
                          <a href="../uploads/category_pdf/<?php echo $TypeArray['catalogue'] ?>" target="_blank">View Catalogue</a>
                      </div>
                      <?php
                 	 }
                  ?>
              </div>
              
              

			<div class="form-group">
                <label for="exampleInputEmail1">Youtube</label>
                <input type="text" class="form-control " id="youtube" name="youtube" value="<?=stripslashes($TypeArray['youtube'])?>" placeholder="Youtube" style="width:40%;">
              </div>-->
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
              <a href="list_categories.php?&pgNo=<?php echo intval(base64_decode($_REQUEST['pgNo'])); ?>" class="btn btn-danger" >Back</a>
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
		
		if(cat=="Application")
		{
			$("#parcat").css('display','none');
		}else{
			$("#parcat").css('display','block');
			$("#parent_category_id").css('display','none');
			$.ajax({
				  method: "POST",
				  url: "fetch_parent.php",
				  data: { category_type: cat },
				  success: function(result){
					 
						$("#result_data").html(result);
					}});
				
			  
		}
		
				
	});
	
});

function isUrlValid(youtube){

			var message;

			var myRegExp =/^(?:(?:https?|ftp):\/\/)(?:\S+(?::\S*)?@)?(?:(?!10(?:\.\d{1,3}){3})(?!127(?:\.\d{1,3}){3})(?!169\.254(?:\.\d{1,3}){2})(?!192\.168(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]+-?)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]+-?)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})))(?::\d{2,5})?(?:\/[^\s]*)?$/i;

			var urlToValidate = youtube;

			

			if (!myRegExp.test(urlToValidate))
			{

				return false;

			}

		 

}



function validateForm(){
	
	if($("input#title").val()==""){
		$(".errorDiv").show().fadeOut(4000);
		$('#errormessage').text("Category Title is Mandatory");
		$("input#title").focus();
		return false;
	}
	if($("#short_description").val()==""){
		$(".errorDiv").show().fadeOut(4000);
		$('#errormessage').text("Category description is Mandatory");
		$("#short_description").focus();
		return false;
	}
	var image_name = '<?php echo  $TypeArray['image'] ?>';
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
function Checkfile3(){
	var fup = document.getElementById('icon');
	var fileName = fup.value;
	var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
	if(ext == "jpg" || ext == "JPG"  || ext == "gif" || ext == "GIF" || ext == "png" || ext == "PNG" || ext == "jpeg" || ext == "JPEG"){
		//return true;
	}else{
		alert('Upload jpg, png, gif files only.');
		$(".errorDiv").show().fadeOut(4000);
		$('#errormessage').text("Upload jpg, png, gif files only.");
		$("input#icon").focus();
		$("input#icon").val("");
		return false;
	}
}


</script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1');
	
    //bootstrap WYSIHTML5 - text editor
    $(".textarea").wysihtml5();
  });
</script>
