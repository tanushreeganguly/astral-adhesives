<!-- Content Wrapper. Contains page content -->
<?php
require_once("left.php");
#==== Object Initialisations
$POST		= $objTypes->validateUserInput($_POST);
$id 		= isset($POST['id']) ? intval($POST['id']) : intval($_REQUEST['id']) ;
$mode 		= ($id<>'0') ? 'Edit' : 'Add';
$params     = array(":id" => $id);
$TypeArray	= $objTypes->fetchRow("SELECT * FROM tbl_testimonial WHERE id = :id", $params);
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1> <?=$mode?> Testimonial  <small></small> </h1>
    <ol class="breadcrumb">
      <li><a href="list_testimonial.php"><i class="fa  fa-navicon"></i> Testimonial List</a></li>
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
          <form role="form" method="post" action="act_testimonial.php" onsubmit="return validateForm();" enctype="multipart/form-data">
          <input type="hidden" name="id" id="id" value="<?=$TypeArray['id']?>"  />
           <input type="hidden" name="pgNo" id="pgNo" value="<?=$_REQUEST['pgNo']?>"  />
            <div class="box-body">
			
			 <div class="form-group">
                <label for="exampleInputEmail1">Title<?=MANDATORY?></label>
               	<textarea class="form-control" placeholder="Testimonial..." name="title" id="title" rows="3" style="width:40%;"><?=stripslashes($TypeArray['title'])?></textarea>
              </div>
			  <div class="form-group">
                <label for="exampleInputEmail1">Type<?=MANDATORY?></label>
               	<select class="round" name="testimonialtype" id="testimonialtype">
					  <option value="">Select Type</option>
					  <option value="image">Image</option>
					  <option value="video">Video</option>
					</select>
					</div>
			 <div class="form-group" id="Imagelink">
                <label for="exampleInputEmail1">Image<?=MANDATORY?></label>
                <input type="file" class="form-control " id="image" name="image" value="" placeholder=" Testimonial Image" style="width:40%;" onchange="return Checkfile()">
                <div class="alert alert-danger alert-dismissible" style="width:40%;margin-top:10px;">[Note:- File Size : 440X295  , MAX File Upload Size : 3MB]</div>
                <?php if($TypeArray['image']){ ?>
                <a href="#" id='existing_image'><img src="../uploads/testimonial_images/<?=stripslashes($TypeArray['image'])?>"  onerror="this.style.display='none'" height="80" width="100" onclick='window.open("../uploads/testimonial_images/<?=stripslashes($TypeArray['image'])?>","","width=600,height=600,scrollbars=Yes,resizable=yes")' /></a>
				<?php } ?>
              </div>
			  <div class="form-group" id="youtubelink">
                <label for="exampleInputEmail1">Youtube Link<?=MANDATORY?></label>
               	<input type="text" class="form-control" placeholder="Youtube Link..." name="youtube" id="youtube" value="<?=stripslashes($TypeArray['youtube'])?>" style="width:40%;">
              </div>
			 <div class="form-group">
                <label for="exampleInputEmail1">Name<?=MANDATORY?></label>
               	<input type="text" class="form-control" placeholder="Name..." name="name" id="name" value="<?=stripslashes($TypeArray['name'])?>" style="width:40%;">
              </div>
             
              <div class="form-group">
                <label for="exampleInputEmail1">Designation<?=MANDATORY?></label>
				<input type="text" class="form-control" placeholder="Designation..." name="designation" id="designation" value="<?=stripslashes($TypeArray['designation'])?>" style="width:40%;">
              </div>
             
              <div class="form-group">
                 <label for="exampleInputEmail1">Company<?=MANDATORY?></label>
               	 <input type="text" class="form-control" placeholder="Company..." name="company" id="company" value="<?=stripslashes($TypeArray['company'])?>" style="width:40%;">
              </div>
			  <!-- <div class="form-group">
                <label for="exampleInputEmail1">PDF<?=MANDATORY?></label>
               	<input type="file" class="form-control" placeholder="PDF" name="catalogue" id="catalogue"  style="width:40%;" onchange="return Checkpdf(catalogue)" />
              </div>-->
             <?php if($TypeArray['catalogue']){ ?>
                <a href="../uploads/testimonial_pdf/<?=stripslashes($TypeArray['catalogue'])?>" id='existing_image'><?=stripslashes($TypeArray['catalogue'])?></a>
				<?php } ?>
              
             
              
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="submit" class="btn btn-primary" value="SAVE" name="SAVE" id="SAVE">Submit</button>
              <a href="list_testimonial.php" class="btn btn-danger" >Back</a>
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
	var id=$("#id").val();
	if(id==""){
	$("#Imagelink").hide();
	$("#youtubelink").hide();
	$('#testimonialtype').on('change',function(){	
	var type=$('#testimonialtype').val();
	
	
		if(type=="image"){
			$("#Imagelink").show();
			$("#youtubelink").hide();
		}
		else if(type=="video"){
			$("#youtubelink").show();
			$("#Imagelink").hide();
		}
	});
	}
});

function validateForm(){

	var title = $("#title").val();
	if(title.trim()==""){
		$(".errorDiv").show().fadeOut(4000);
		$('#errormessage').text("Title is Mandatory");
		$("#title").focus();
		return false;
	}
	var type=$('#testimonialtype').val();
	if(type==""){
			$(".errorDiv").show().fadeOut(4000);
			$('#errormessage').text("Type is Mandatory");
			$("#testimonialtype").focus();
			return false;
			}
	
	if(type=="image"){
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
	}
	if(type=="video"){
		
			
			var url = $("#youtube").val();
			if(url==""){
			$(".errorDiv").show().fadeOut(4000);
			$('#errormessage').text("Youtube link is Mandatory");
			$("#youtube").focus();
			return false;
			}
			
			if (ytVidId(url) == false) {
			   $(".errorDiv").show().fadeOut(4000);
				$('#errormessage').text("Youtube link is not valid");
				$("#youtube").focus();
				return false;
			}
		

	}	
	var name = $("#name").val();
	if(name.trim()==""){
		$(".errorDiv").show().fadeOut(4000);
		$('#errormessage').text("Name is Mandatory");
		$("#name").focus();
		return false;
	}
	
	var designation = $("#designation").val();
	if(designation.trim()==""){
		$(".errorDiv").show().fadeOut(4000);
		$('#errormessage').text("Designation is Mandatory");
		$("#designation").focus();
		return false;
	}
	var company = $("#company").val();
	if(company.trim()==""){
		$(".errorDiv").show().fadeOut(4000);
		$('#errormessage').text("Company is Mandatory");
		$("#company").focus();
		return false;
	}
	
	
	
/*	var pdf = '<?php echo  $TypeArray['catalogue'] ?>';
	if(pdf !='')
	{
		if($("#existing_pdf").html()=='')
		{
			
			if($("input#catalogue").val()==""){
			$(".errorDiv").show().fadeOut(4000);
			$('#errormessage').text("PDF is Mandatory");
			$("input#catalogue").focus();
			return false;
			}
		}
	}
	else{
			if($("input#catalogue").val()==""){
			$(".errorDiv").show().fadeOut(4000);
			$('#errormessage').text("PDF is Mandatory");
			$("input#catalogue").focus();
			return false;
			}
	}*/
	
	return true;
}
function ytVidId(url) {
    var p = /^(?:https?:\/\/)?(?:www\.)?youtube\.com\/watch\?(?=.*v=((\w|-){11}))(?:\S+)?$/;
    return (url.match(p)) ? RegExp.$1 : false;
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
	var fup = document.getElementById('thumbnail');
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
		$("input#catalogue").focus();
		$("input#catalogue").val("");
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
