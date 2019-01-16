$(document).ready(function(){
	var getUrl = window.location;
	var baseUrl = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1];
		
	/*enquiry now button click*/
			$("#enquireNow").on('click',function(){
			
			var name 		= $("#name").val().trim();
			var regEx = new RegExp("/[0-9]/");
			
			var address     = $("#address").val().trim();
			var country		= $("#country").val().trim();
			if(country=='India'){
				var state 	= jQuery("#state").val().trim();
				var city 	= jQuery("#city").val().trim();		
			}else if(country!='India' && country.length>1){
				var state 	= jQuery("#stateInput").val().trim();;
				var city 	= jQuery("#cityInput").val().trim();
			}
			
			var zip			= $("#zip").val().trim();
			var mobile		= $("#mobile").val().trim();
			var email		= $("#email").val().trim();
			var dob		= $("#dateofbirth").val().trim();
			var enquiry_for		= $("#enquireFor").val().trim();
			var message		= $("#description").val().trim();
			var checkemail  = validateEmailAddress(email);
			
			if(name=="" || name=="Full Name*"){
				$(".errMsg").text("Please enter full name.");
				$("#name").addClass('errorRed');
				$("#name").focus();
				isOk = false;
				return false;
			}else if(!validateFirstnameLastname(document.getElementById('name'),"Please enter valid name.")) {
				$("#name").addClass('errorRed')
				isOk = false;
				return false;
			}else{
				$("#name").removeClass('errorRed');
			}	
			if(address=="" || address=="Address*"){
				$(".errMsg").text("Please enter your address.");
				$("#address").addClass('errorRed');
				$("#address").focus();
				isOk = false;
				return false;
			}else{
				$("#address").removeClass('errorRed');
				
			}
			if(country=="" || country=="Country*"){
				$(".errMsg").text("Please enter your country.");
				$("#country").addClass('errorRed');
				$("#country").focus();
				isOk = false;
				return false;
			}else{
				$("#country").removeClass('errorRed');
				
			}
			if(state=="" || state=="State*"){
				$(".errMsg").text("Please enter your state.");
				$("#state").addClass('errorRed');
				$("#state").focus();
				isOk = false;
				return false;
			}else{
				$("#state").removeClass('errorRed');
				
			}
			if(city=="" || city=="City*"){
				$(".errMsg").text("Please enter your city.");
				$("#city").addClass('errorRed');
				$("#city").focus();
				isOk = false;
				return false;
			}else{
				$("#city").removeClass('errorRed');
				
			}
			if(zip=="" || zip=="Zip*"){
				$(".errMsg").text("Please enter your zip.");
				$("#zip").addClass('errorRed');
				$("#zip").focus();
				isOk = false;
				return false;
			}else{
				$("#zip").removeClass('errorRed');
				
			}
			
				if ($("#zip").val().length < 4 ) {
				   $(".errMsg").text("Please enter valid zip.");
					$("#zip").addClass('errorRed');
					$("#zip").focus();
					isOk = false;
					return false;
				}
				
			
			if(mobile=="" || mobile=="Mobile*"){
				$(".errMsg").text("Please enter your mobile.");
				$("#mobile").addClass('errorRed');
				$("#mobile").focus();
				isOk = false;
				return false;
			}else{
				
				$("#mobile").removeClass('errorRed');
				
			}
			
			 if ($("#mobile").val().length != 10 && !$("#mobile").val().match(regEx)) {
			   $(".errMsg").text("Please enter valid mobile no.");
				$("#mobile").addClass('errorRed');
				$("#mobile").focus();
				isOk = false;
				return false;
			}

			//Email Valiudation
			if(email=='' || email=='Email ID*'){
				$(".errMsg").text('Please enter your email address.');
				$("#email").addClass('errorRed')
				$("#email").focus();
				isOk = false;
				return  false;
			}else if(!checkemail && email!=''){
				$(".errMsg").text('Please enter valid email address.');
				$("#email").addClass('errorRed')
				$("#email").focus();
				isOk = false;
				return false;
			}else{
				$("#email").removeClass('errorRed');
			}
			
			
				if(dob=="" || dob=="dd-mm-yy*"){
				$(".errMsg").text("Please enter date of birth.");
				$("#dateofbirth").addClass('errorRed');
				$("#dateofbirth").focus();
				isOk = false;
				return false;
			}else{
				
				$("#dateofbirth").removeClass('errorRed');
				
			}
			
			$.ajax({
							type: 'POST',
							url: baseUrl+'/senddata1.php',
							data: {'name' : name,'email':email,'address':address,'dob':dob,'zip':zip,'mobile':mobile,
							'inquiry_for':enquiry_for,'message':message,'country':country,'state':state,'city':city},		
							success:function(response){	
								
									if(response==1)	
									{
										
										$('#enquirysection').hide();
										$('#message_section').show();
									}
									
								}
						});
			
		});
	
				/*enquiry form*/  
		
		  $(".enq_button").on('click',function(){
			  $("#enquirysection").show();
		  });
			 
			$("#country").on('change',function(){
					
				var country_name=$("#country").val();
				if(country_name=="India"){
					  $("#stateInput").hide();
					  $("#cityInput").hide();
					  $("#state").show();
					$.ajax({
						type: 'POST',
						url: baseUrl+'/statedetail.php',
						data: {'country_name' : country_name},		
						success:function(response){	
								 $("#city").show();
								 $("#state").html(response);
								 $("#state").on('change',function(){
									var state=$("#state").val();
									$("#city").html('<option value="">Select City*</option>');	
										$.ajax({
											type: 'POST',
											url: baseUrl+'/ajax_city.php',
											data: {'state' : state},		
											success:function(response){	
												jQuery(".city").html(response);
											}
										});
								});
							}
					});
					
		}else{
			
			$("#state").hide();
			$("#stateInput").show();
			$("#city").hide();
			$("#cityInput").show();
			
		}
				
			});
			
			/*sign up newsletter*/
		  
		  $('.signUp_btn').on('click',function(){
			
				var email = $("input#signup_email").val();
					$('#errormessage').attr('style', 'color: rgb(255, 0, 0)');
					 
   

				if($("input#signup_email").val()==""){
					$(".errorDiv").show().fadeOut(4000);
					$('#errormessage').text("Please enter email id");
					
					  
					$("input#signup_email").focus();
					return false;
				}else if (!validateEmail(email))
					{
						$(".errorDiv").show().fadeOut(4000);
						$('#errormessage').text("Please enter valid email id");
						$("input#signup_email").focus();
						return false;
					}




				var signup_email 	= jQuery("#signup #signup_email").val();
				var form_data 		="signup_email="+signup_email;

				jQuery.ajax({
							type: "POST",
							data: form_data,
							url: baseUrl+'/newsletter_signup.php',
							success:function(response){
								$("#thankyou").attr('style', 'color: rgb(0,128,0)');
								document.getElementById('thankyou').innerHTML=response;
								$("#thankyou").show().fadeOut(5000);
								
							}

					});
				return false;

			});
			
			/*search box*/
			
		  $('.search_txtBox').keypress(function(event) {
			  var keycode = event.keyCode || event.which;
				if(keycode == '13') {
				var searchbox=$(".search_txtBox").val();
				if(searchbox==""){
					$(".error_log").html('Please enter search data');
					return false;
				}
			}else{
				$("#searchdata").submit();
			}
		 });
	  });
	var sysmsg = "<?=$sysmsg?>";
	if(sysmsg==0){
		$(".errorDiv").hide();
	}
	else{
		$(".errorDiv").show().fadeOut(4000);
	}
	function validateEmail(email) {

		var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		return re.test(email);
		}
 /*enquiry onload*/
	$(window).load(function(){
			  $("#enquirysection").hide();
			  $("#stateInput").hide();
			  $("#cityInput").hide();
			  $("#state").hide();
			  $("#city").hide();
			  $("#message_section").hide();
			
		});
	/*date calender*/
	$(function() {

		var today = new Date();
		$("#dateofbirth").datepicker({
			dateFormat:"dd-mm-yy",
			changeMonth: true,
			changeYear: true,
			endDate: "today",
			maxDate: today				
			
			});	
		});
		
		/*validate email address*/
		
		function validateEmailAddress(elementValue){
			var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;  
			var op = emailPattern.test(elementValue); 
			if(op==false){
				return false;
			}else{
			   return true;
			}
	    }
		/*validate name*/
		
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

		/*validate numbers only*/
		
		function validateNumbersOnly(e){
			var unicode = e.charCode ? e.charCode : e.keyCode;
			if ((unicode == 8) || (unicode == 9) || (unicode > 47 && unicode < 58)||(unicode == 43)){
				return true;
			}else{
				//alert("This field accepts only Numbers");
				return false;
			}
		}