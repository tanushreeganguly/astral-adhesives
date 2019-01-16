<?php include_once('config/config.php');
 
if(!class_exists('FormToken'))
{
  if(!require_once('include/form_token.php')){
    die('Class FormToken Not Exists.');
  }else{
    $token = new FormToken();
  }
} 
if(!class_exists('PHPMailer')){
  if( !require_once( 'include/PHPMailer/PHPMailerAutoload.php' )){
    die('PHPMailer Class Does not Exists!');
  }else{    
    $mail   = new PHPMailer();
  }
}
$POST   = $objTypes->validateUserInput($_REQUEST);
function noHTML($input, $encoding = 'UTF-8') {
   return htmlentities($input, ENT_QUOTES | ENT_HTML5, $encoding);
}
function smssendotp($ref_no,$mobile)
{
		$ch = curl_init();  // initiate curl
		$url = "https://www.smsjust.com/sms/user/urlsms.php?"; // where you want to post data - final
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POST, true);  // tell curl you want to post something
		curl_setopt($ch, CURLOPT_POSTFIELDS, "username=astralpoly&pass=aptl@2017&senderid=ASTRAL&dest_mobileno=$mobile&message=Thank you for contacting us, your application reference number is $ref_no&response=Y"); 
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch); 
		if($result)
		{
			return 1; 
		}else{
			return 0; 
		}
		curl_close($ch);
}


if(isset($POST['data']) && $POST['data']=='1')
{
  $error    = "";
  $flag   = true;
  $name    = noHTML(addslashes(strip_tags(trim($POST['name']))));
  $email   = noHTML(addslashes(strip_tags(trim($POST['email']))));
  $decodeemail= html_entity_decode($email, ENT_QUOTES | ENT_HTML5, 'UTF-8');
  $mobile  = noHTML(addslashes(strip_tags(trim($POST['mobile']))));
  $resume_title  = noHTML(addslashes(strip_tags(trim($POST['resume_title']))));

  if($token->validateKey() == false){
    $error = "There is some problem, please try again.";    
    $flag  = false;
  }

if(strlen($error)<=0){
  if($name==""){
    $error  = "Please enter name";
    $flag = false;
    $ser_nclass = "name";
  }elseif(!preg_match('/^[a-zA-Z ]+$/',$name)){
    $error  = "Please enter valid name";
    $flag = false;
    $ser_nclass = "name";
  }elseif(strlen($name_ser) > '75'){
    $error  = "Please enter valid name";
    $flag = false;
    $ser_nclass = "name";
  }
}
if(strlen($error)<=0){
  if($email=="" ){
    $error  = "Please enter email id";
    $flag = false;
    $ser_eclass = "email";
  }else if($email!=''){ 
      if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,8})$/",$decodeemail)){
      $error  = "Please enter valid email id";
      $flag = false;
      $ser_eclass = "email";
    }
  }
}
if(strlen($error)<=0){
  if($mobile=="" ){
    $error  = "Please enter mobile number";
    $flag = false;
    $ser_pclass = "phone";
  }

    if($mobile!='') 
    { 
        if(strlen($mobile)!='10')
        { 
          $error="Please Enter 10 Digit Mobile.";
          $flag=false;
          
        }
        if(!preg_match("/^[0-9]{10}+$/",$mobile)) 
        {
          $error="Plesae enter valid mobile number and max 10 digit";
          $flag=false;
        }
    }
  }
if(strlen($error)<=0){
   if($resume_title!='') 
      {   
        if(!preg_match("/^[a-zA-Z 0-9]+$/",$resume_title)) 
        {
          $error="Please enter title";
          $flag=false;
        }
      }
    }
    if(strlen($error)<=0){

      if(isset($_FILES['resume']['name']) && $_FILES['resume']['name'] != ""){
        $filesize= $_FILES['resume']['size'];
        $ext      = pathinfo($_FILES['resume']['name'], PATHINFO_EXTENSION);
        $ext      = strtolower($ext);
        $validatefiles  = array("pdf", "PDF","doc","Doc","docx","DOCX");
       // $filetype     = array('application/pdf');
        if(in_array($ext, $validatefiles) == false){
          $error  = "File type is not supported. Allowed only pdf and doc"; 
          $flag=false;
        }
       
      }

    }   

    if($flag==true && strlen($error)<=0){

       $insertarray = array(
                'name'    => $name,
                'email'   => $decodeemail,
                'mobile'  => $mobile

                );
      
            $result_car = $objTypes->fetchAll("SELECT * FROM tbl_career_apply WHERE email = '".$decodeemail."' and job_id=0 and is_delete = 1 and is_active = 1");
       


            if(count($result_car)==0){

            $insert_serve = $objTypes->insert("tbl_career_apply", $insertarray);
            $userid = $objTypes->lastInsertId();
            
			      $ref_no = 'AA000-'.$userid;
            $params = array(
                              'ref_no'    => 'AA000-'.$userid
                             );
                          //$objTypes->update($UpdatePdfArray,"id = '".$id."'");
                          
                            $where  = array(
                              ':id'          => $userid
                          );
                          $update = $objTypes->update("tbl_career_apply", $params, "id = :id", $where);
						  # ===== sending sms
						$sendotp = smssendotp($ref_no, $mobile); 
           }
		   else{
             $where  = array(
                              ':id'          => $result_car[0]['id']
                          );
             $insert_serve = $objTypes->update("tbl_career_apply", $insertarray, "id = :id", $where);
             $userid = $result_car[0]['id'];
           }
		   
		   
           
            if($userid!='')
            {
             
             if(isset($_FILES['resume']['name']) && $_FILES['resume']['name'] != ""){
                        $ext1      = pathinfo($_FILES['resume']['name'], PATHINFO_EXTENSION);
                        $ext      = strtolower($ext1);
                        $validatefiles  = array("pdf","doc","docx");
                        $filetype     = array('application/pdf','application/doc','application/docx');

                        if(!in_array($ext,$validatefiles)){
                          $error  = "File type is not supported. Allowed only pdf and doc"; 
                        }
                         /* echo strtolower($_FILES['resume']['type']);
                          exit;
                        if(in_array(strtolower($_FILES['resume']['type']), $filetype) == false ){
                          $error  = "File type is not supported"; 
                        }*/
                       // echo $error;
                        
                        if($error==''){       
                          $ext    = pathinfo($_FILES['resume']['name'], PATHINFO_EXTENSION);
                          $filename = basename($_FILES['resume']['name'], $ext);      
                          $filename = 'resume_'.time().'.'.$ext;
                          $movefile = move_uploaded_file($_FILES['resume']['tmp_name'], "uploads/resume/".$filename);
                        
                          $result1 = $objTypes->fetchAll("SELECT * FROM tbl_job_user WHERE user_id = '".$userid."' and job_id=0");
                        
                          //$UpdatePdfArray = array('catalogue' => $filename);
                          $params = array(
                              'resume'    => $filename,
                              'resume_title'=> $resume_title,
                              'user_id'   => $userid
                             );
                         
                          //$objTypes->update($UpdatePdfArray,"id = '".$id."'");
                           
                          if(count($result1)<1){
                            $inser_data = $objTypes->insert("tbl_job_user", $params);
                          }else{
                             $where  = array(
                              ':id'          => $result1[0]['id']
                             );
                            $inser_data = $objTypes->update("tbl_job_user", $params, "id = :id", $where);
                          }

                            $mail->IsSMTP();
                            $mail->Mailer     = "smtp";
                            $mail->Host       = "mail.astraladhesives.com"; 
                            $mail->SMTPDebug  = 0; 
                            $mail->SMTPAuth   = true; 
                            $mail->Port       = 587;
                            $mail->SMTPSecure = 'TLS';
                            $mail->Username   = "marketing@astraladhesives.com";
                            $mail->Password   = "Adhesives123";
                            $mail->addReplyTo('marketing@astraladhesives.com', 'Astral Adhesives'); 
                            $mail->setFrom('marketing@astraladhesives.com', 'Astral Adhesives');
                            
                           // $mail->addBCC('tanushree.ganguly@bcwebwise.com', 'Tanushree'); 
                            $mail->addAddress($decodeemail);
                            $mail->isHTML(true);  
                            
                            $mail->Subject  = 'Career';     
                            $mail->Body     = '<html>
                                    <head>
                                    <title>Careers</title>
                                    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
                                    </head>
                                    <body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
                                     
                                    <table width="700"   border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#1673BF" style="border:1px solid #000;" >
                                    <tr>
                                        <td height="122" colspan="2" align="left" valign="top">
                                          <a href="https://test.astraladhesives.com"><img src="https://test.astraladhesives.com/assets/images/logo.gif" alt="Astral Adhesives" width="323" height="73" border="0"></a></td>
                                      </tr>
                                      <tr>
                                        <td height="384" colspan="2" align="center"><img src="https://test.astraladhesives.com/assets/images/careers.gif" width="262" height="262" alt="Careers at Astral Adhesives"></td>
                                      </tr>
                                      <tr>
                                        <td height="184" colspan="2" valign="top"  style="font-family:Arial, Helvetica, sans-serif; font-size:16px; line-height:150%; color:#ffffff; padding-left:99px; padding-right:99px; text-align:center;"> 
                                        Thank you for showing your interest in our organisation. If selected, you will be contacted by the concerned team with details of the  interview, at the earliest. You can also reach out to us to get an 
                                        update on the status of your application through  <span style="display:inline-block">your reference id AA000-'.$userid.' .</span></td>
                                      </tr>
                                      <tr>
                                        <td width="79">
                                          <img src="https://test.astraladhesives.com/assets/images/corner.gif" width="79" height="74" alt=""></td>
                                        <td width="621" bgcolor="#FFFFFF">
                                        <table id="Table_01" border="0" cellpadding="0" cellspacing="0" style="width: 612px; ">
                                      <tr>
                                        <td width="216" rowspan="2"><a href="http://www.astraladhesives.com/"  style="font-size:22px; font-family:`Times New Roman`, Times, serif;  font-weight:bold; color:#1D69B7; text-decoration:none;" >
                                        www.astraladhesives.com</a></td>
                                      <td width="1" rowspan="2">
                                          <img src="https://test.astraladhesives.com/assets/images/fff_02.gif" width="1" height="52" alt=""></td>
                                      <td width="203" align="center"></td>
                                      <td width="1" rowspan="2">
                                          <img src="https://test.astraladhesives.com/assets/images/fff_04.gif" width="1" height="52" alt=""></td>
                                      <td width="52" rowspan="2">
                                          <a href="https://www.facebook.com/AstralAdhesives/"><img src="https://test.astraladhesives.com/assets/images/fb.gif" alt="facebook" width="45" height="52" border="0"></a></td>
                                      <td width="45" rowspan="2">
                                          <a href="https://twitter.com/astraladhesives"><img src="https://test.astraladhesives.com/assets/images/twitter.gif" alt="twitter" width="45" height="52" border="0"></a></td>
                                      <td width="43" rowspan="2">
                                          <a href="https://www.youtube.com/channel/UC-7wKHr0O_armoSAddVgHIw"><img src="https://test.astraladhesives.com/assets/images/youtube.gif" alt="youtube" width="45" height="52" border="0"></a></td>
                                      <td width="41" rowspan="2">
                                          <a href="https://www.instagram.com/astral_adhesives/"><img src="https://test.astraladhesives.com/assets/images/insta.gif" alt="instagram" width="45" height="52" border="0"></a></td>
                                      </tr>
                                      <tr>
                                        <td width="203" align="center"><a href="tel:7311103331" style="font-size:21px; font-family:`Times New Roman`, Times, serif; color:#1D69B7; font-weight:bold; text-decoration:none;" > <img src="https://test.astraladhesives.com/assets/images/tel.gif" alt="" width="33" height="28" border="0" align="absmiddle"> 7311103331</a></td>  </tr>
                                    </table></td>
                                      </tr>
                                    </table>
                                     
                                    </body>
                                    </html>';
                            
                            if(!$mail->send()){
                               $error="Error in sending message.";
                               
                              
                            }//else {   
                                
                              //@header("location:".base_url."addresume"); 
                           // } 
                              $name=$email=$mobile=$resume_title=$decodeemail="";
                              $error="Resume Added successfully"; 
                            
                          }
                  }
		 $name=$email=$mobile=$resume_title=$decodeemail="";
                $error="Resume Added successfully"; 
                 
          }
       

      }

}

 ?>
<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
  <title>Astral Adhesives</title>
  <link href="<?=base_url?>assets/images/favicon.ico" rel="shortcut icon" type="" />
  <link href="<?=base_url?>assets/css/main.css" rel="stylesheet" type="text/css">
  <?php include_once('include/googlecode.php'); ?>
</head>

<body>
  <?php include_once('include/othercode.php'); ?>
  <div id="wrapper">
    <?php include_once('include/header.php'); ?>
   
    <section id="breadcrumbs">
      <div class="container">
        <a href="<?=base_url?>">Home</a> Future job
      </div>
    </section>

    <section id="siteInner" class="careerForm">
      <div class="container">
        <a href="<?=base_url?>career" class="backBtn">Back</a>
        <div class="sect_title inner_title">
          <h2>
            <span>Careers</span>
          </h2>
        </div>

        <div class="careerCon">
      

          <div class="cr_form_con">
            <h3>Future jobs</h3>
               <div class="errMsg"><?php echo $error;?></div>

             <form name='career_form' method='post' enctype='multipart/form-data'>
              <input type="hidden" name="data" value="1">
              <?php echo $token->outputKey(); ?>  
            <ul class="loc_info">
              <li>
                <span><strong>Name*</strong></span>
                <span id="namebox">
                  <input type="text" name="name" id="name" class="textBox" value="<?php echo $name;?>"><span></span>
                </span>
              </li>
              <li>
                <span><strong>Mobile*</strong></span>
                <span id="mobilebox">
                  <input type="text" name="mobile" id="mobile" value="<?php echo $mobile;?>" class="textBox" maxlength="10"><span></span>
                </span>
              </li>
              <li>
                <span><strong>Email*</strong></span>
                <span>
                  <input type="text" name="email" id="email" value="<?php echo $email;?>" class="textBox">
                </span>
              </li>
             <li>
                <span><strong>Resume Title</strong></span>
                <span id="resume_titlebox">
                  <input type="text" class="textBox" name="resume_title" id="resume_title" value="<?php echo $resume_title;?>"><span></span>
                </span>
              </li>
              <li class="selectFiles addResLast">
                <div class="file-upload">
                  <div class="file-select">
                    <div class="file-select-button" id="fileName">Upload Your Resume*</div>
                    <div class="file-select-name" id="noFile"></div> 
                    <input type="file" name="resume" id="chooseFile" value=""><br>Max file size 3mb <br>Allowed only doc and pdf
                  </div>
                </div>

              </li>
              <li >
               
              </li>
            </ul>
            <div class="job_more">
              <button class="commanBtn" id="commanBtn">Submit</button>
            </div>
            
          </form>
          </div>


        </div>

      </div>
    </section>

   <?php include_once('include/footer.php'); ?>
  </div>

  <!--JS Files-->
  <script type="text/javascript" src="<?=base_url?>assets/js/jquery-1.12.1.min.js"></script>
  <script type="text/javascript" src="<?=base_url?>js/footer.js"></script>
  <script type="text/javascript" src="<?=base_url?>assets/js/jquery.easing.1.3.js"></script>
  <script type="text/javascript" src="<?=base_url?>assets/js/modernizr-custom.js"></script>
  <script type="text/javascript" src="<?=base_url?>assets/js/TweenMax.min.js"></script>
  <script type="text/javascript" src="<?=base_url?>assets/js/jquery.slimmenu.min.js"></script>
  <script type="text/javascript" src="<?=base_url?>assets/js/common.js"></script>
  <script type="text/javascript" src="<?=base_url?>assets/js/career.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){ 

          $('input').on('keyup',function()
          {
              $('input,select').removeClass('errorRed');
              $('.errMsg').text('');
              $('.loc_info li span span').text(''); 
              $('input,select').removeClass('errorblue');
              $(this).addClass('errorblue');

           });
          
           $('select').on('change',function()
          {
              $('input,select').removeClass('errorRed');
              $('.errMsg').text('');
              $('.loc_info li span span').text(''); 
              $('input,select').removeClass('errorblue');
              $(this).addClass('errorblue');

           });

          $('#name').keyup(function()
          {
              charactersonly(this);
              $("#name").addClass('errorblue');
              $("#name").focus();
              $("#namebox span").text('Only characters');

          });
          $('#mobile').keyup(function()
          {
              numericsonly(this);
              $("#mobile").addClass('errorblue');
              $("#mobile").focus();
              $("#mobilebox span").text('Only numbers');

          });
          $('#resume_title').keyup(function()
          {
              alphanumericsonly(this);
              $("#resume_title").addClass('errorblue');
              $("this").focus();
              $("#resume_titlebox span").text('Only alphanumerics');
          });

          
         $(".commanBtn").on('click',function(){
          $("html, body").animate({ scrollTop: 100 }, "slow");
          $('input,select').removeClass('errorblue');
          $(".errMsg").attr('style','color:red');

          
           var name=$("#name").val().trim();
           var email=$("#email").val().trim();
           var mobile=$("#mobile").val().trim();
           
           var file=$("#noFile").html();
            var regEx = new RegExp("/[0-9]/");
           var checkemail  = validateEmailAddress(email);
           $("input").removeClass('errorRed');

               if(name==""){
                  $(".errMsg").show();
                  $(".errMsg").text("Please enter your name");
                  $("#name").addClass('errorRed');
                  $("#name").focus();
                  isOk = false;
                  return false;
                }else if(!validateFirstnameLastname(document.getElementById('name'),"Please enter valid name.")) {
                  $("#name").addClass('errorRed');
                  isOk = false;
                  return false;
                }else{
                  $("#name").removeClass('errorRed');
                } 

                 if(mobile==""){
                  $(".errMsg").show();
                  $(".errMsg").text("Please enter your mobile number");
                  $("#mobile").addClass('errorRed');
                  $("#mobile").focus();
                  isOk = false;
                  return false;
                }else{

               
                    if(!$.isNumeric(mobile))
                      {
                      $(".errMsg").text("Please enter valid mobile number");
                      $("#mobile").addClass('errorRed');
                      $("#mobile").focus();
                      isOk = false;
                      return false;
                     } 
                     if(mobile.length != 10) {
                      $(".errMsg").show();
                      $(".errMsg").text("Please enter a valid mobile number");
                      $("#mobile").addClass('errorRed');
                      $("#mobile").focus();
                      isOk = false;
                      return false;
                    } 
                     $("#mobile").removeClass('errorRed'); 
                    
               }       
                



                if(email==''){
                    $(".errMsg").show();
                    $(".errMsg").text('Please enter your email address');
                    $("#email").addClass('errorRed')
                    $("#email").focus();
                    isOk = false;
                    return  false;
                  }else if(!checkemail && email!=''){
                    $(".errMsg").show();
                    $(".errMsg").text('Please enter a valid email id');
                    $("#email").addClass('errorRed');
                    $("#email").focus();
                    isOk = false;
                    return false;
                  }else{
                    $("#email").removeClass('errorRed');
                  }

                  if(file==''){
                    $(".errMsg").show();
                    $(".errMsg").text('Please enter your file');
                    $("#chooseFile").addClass('errorRed')
                    $("#chooseFile").focus();
                    isOk = false;
                    return  false;
                  }
                   var file = document.getElementById('chooseFile').files[0];

                  if(file && file.size < 3097152) { // 10 MB (this size is in bytes)
                    $('career_form').submit();
                      //Submit form        
                  } else {

                    $(".errMsg").show();
                    $(".errMsg").text('Maximum file size would be 3mb.');
                    $("#chooseFile").addClass('errorRed')
                    $("#name").focus();
                    isOk = false;
                    return  false;
                  }


                   

         });
  });

                function charactersonly(ob) 
                {
                    var invalidChars = /([^a-z ])/gi
                    if(invalidChars.test(ob.value)) 
                    {
                        ob.value = ob.value.replace(invalidChars,"");
                    }
                }
                function numericsonly(ob) 
                {
                    var invalidChars = /([^0-9])/gi
                    if(invalidChars.test(ob.value)) 
                    {
                        ob.value = ob.value.replace(invalidChars,"");
                    }
                }

                function alphanumericsonly(ob) 
                {
                    var invalidChars = /([^a-z 0-9])/gi
                    if(invalidChars.test(ob.value)) 
                    {
                        ob.value = ob.value.replace(invalidChars,"");
                    }
                }
                function validateEmailAddress(elementValue){
                  var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;  
                  var op = emailPattern.test(elementValue); 
                  if(op==false){
                    return false;
                  }else{
                     return true;
                  }
                }
                function validateFirstnameLastname(obj, msg){
                  var validStr = /^[a-zA-Z ]{1,}$/;

                  NameArr=obj.value.split("");
                  /*if(NameArr.length>2)
                  {
                    alert(msg+'111');
                    obj.focus();
                    obj.select();
                    return false;
                  }*/
                  for(i=0;i<NameArr.length+5;i++)
                  {
                    if (validStr.test(NameArr[i]) == false)
                    {
                      jQuery(".errMsg").text(msg);
                      obj.focus();
                      obj.select();
                      return false;
                    }
                  }
                  return true;
                }
  </script>
  <!--[if lt IE 9]>
        <script src="js/html5shiv.min.js"></script>
    <![endif]-->
</body>

</html>