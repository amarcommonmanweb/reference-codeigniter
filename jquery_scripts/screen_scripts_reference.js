var error_fields = new Array();
error_fields['login_username'] = 'Invalid Username';
error_fields['login_password'] = 'Incorrect Username or Password';
error_fields['name'] = 'Name must contain only Alphabets, numbers, \'.\' and \'_\'';
error_fields['emailid'] = 'Invalid Email';
error_fields['phone'] = 'Phone number must be atleast 10 digit';
error_fields['username'] = 'Username must contain only Alphabets, numbers, \'.\' and \'_\'';
error_fields['password'] = 'Password must contain only Alphabets, numbers, \'.\' and \'_\'';
error_fields['repassword'] = 'Please enter the same password as previous';

 $(document).ready(function() {
  $('#registerform').hide();
  $('.err_tip').hide();
  $("#signin_response").hide();
  
   $("#register_a").click(function() {
	$('#signinform').hide(500);
	$('#registerform').show(500);
   });
   
   $("#signin_a").click(function() {
	$('#registerform').hide(500);
	$('#signinform').show(500);
   });
   
   //username
   $("#name,#username,#password,#repassword").blur(function() {
		var return_val = validation0(this);
		error_notify(this, return_val);		
   });
   
   $("#emailid").blur(function() {
		var return_val = validation6(this);
		error_notify(this, return_val);		
   });
   
   $("#phone").blur(function() {
		var return_val = validation3(this);
		error_notify(this, return_val);
   });
   
   function error_notify(elem, return_val)
   {
		if(return_val == 1)
		{
			$(elem).removeClass('error');
			$(elem).addClass('success');
			var this_id = $(elem).attr('id');
			var error_div = '#'+this_id+'_err';
			$(error_div).fadeOut(500);		
		}
		if(return_val == 0)
		{
			$(elem).addClass('error');
			$(elem).removeClass('success');
			var this_id = $(elem).attr('id');
			var error_div = '#'+this_id+'_err';
			$(error_div).fadeIn(500);			
		}	   
   }
   
   function show_registration_confirm()
   {
						serializedData = '';	
						//ajax post
						$.ajax({
						url: "registration_confirm.php",
						type: "post",
						data: serializedData,
						// callback handler that will be called on success
						success: function(response, textStatus, jqXHR){
						//log a message to the console
						
						//document.getElementById("confirm_block").innerHTML = 'Invalid Security Code';
						
							$("#login_content").html(response);
												
						//console.log("Hooray, it worked!");
						},
						// callback handler that will be called on error
						error: function(jqXHR, textStatus, errorThrown){
						// log the error to the console
						$("#login_content").html("The following error occured: "+textStatus, errorThrown);
						},
						// callback handler that will be called on completion
						// which means, either on success or error
						complete: function(){
						// enable the inputs
						//$inputs.removeAttr("disabled");
						}
					});
					
				// prevent default posting of form
				event.preventDefault();
   }
   
   function logout_link_click()
   {
		$("#logout_click").click();
		//simulating a navigation by auto clicking a blank link.. :)
		// and that link is present int he footer
   }
   
   $("#Sign_in").click(function() {
   	
		$("#signin_response").fadeOut(300);
		serializedData = $('#signinform :text').serialize();
		serializedData = serializedData+'&action=signin';	
						//ajax post
						$.ajax({
						url: "validate_login",
						type: "post",
						data: serializedData,
						// callback handler that will be called on success
						success: function(response, textStatus, jqXHR){
						//log a message to the console
						
						//document.getElementById("confirm_block").innerHTML = 'Invalid Security Code';
						var login_response = response;
						if(response == 'teacher')
						{
							alert('in teacher');							
							window.location.href = "teacher_page.php";							
						}
						else if(response == 'student')
						{
							alert('in student');							
							window.location.href = "student_page.php";							
						}
						else
						{
							//display error in the block
							$("#signin_response").fadeIn(300);
							$("#signin_response").html(response);
						}
						
						//console.log("Hooray, it worked!");
						},
						// callback handler that will be called on error
						error: function(jqXHR, textStatus, errorThrown){
						// log the error to the console
						$("#signin_response").html("The following error occured: "+textStatus, errorThrown);
						},
						// callback handler that will be called on completion
						// which means, either on success or error
						complete: function(){
						// enable the inputs
						//$inputs.removeAttr("disabled");
						}
					});
					
				// prevent default posting of form
				event.preventDefault();
				
   });
   
   $("#reg_confirm_logout").live('click',function(){
		alert("in the logout call function");
			serializedData = ""
					$.ajax({
						url: "logout_module.php",
						type: "post",
						data: serializedData,
						// callback handler that will be called on success
						success: function(response, textStatus, jqXHR){
						//log a message to the console
												
						if(response == 'done')
						{
							//navigate to your page
							window.location.href = "index.php";
						}
												
						//console.log("Hooray, it worked!");
						},
						// callback handler that will be called on error
						error: function(jqXHR, textStatus, errorThrown){
						// log the error to the console
						$("#register_response").html("The following error occured: "+textStatus, errorThrown);
						},
						// callback handler that will be called on completion
						// which means, either on success or error
						complete: function(){
						// enable the inputs
						//$inputs.removeAttr("disabled");
						}
					});
					
				// prevent default posting of form
				event.preventDefault();
      
   });
   
   $("#register").click(function() {
		var err_counter = 0;
		
		$('#registerform :text').each(function(){			
			$(this).blur();			
		});
		
		$('.error').each(function(){			
			err_counter++;			
		});
		
		if(err_counter == 0)
		{
			//call function to navigate to other form
			$("#register_response").fadeOut(300);
		serializedData = $('#registerform :text').serialize();
		alert(serializedData);
		serializedData = serializedData;	
						//ajax post
						$.ajax({
						url: "validate_register.php",
						type: "post",
						data: serializedData,
						// callback handler that will be called on success
						success: function(response, textStatus, jqXHR){
						//log a message to the console
						
						//document.getElementById("confirm_block").innerHTML = 'Invalid Security Code';
						var login_response = response;
						if(response == 'true')
						{
							//navigate to your page
							alert('to be navigated');
							show_registration_confirm();
						}
						else
						{
							//display error in the block
							$("#register_response").fadeIn(300);
							$("#register_response").html(response);
						}
						
						//console.log("Hooray, it worked!");
						},
						// callback handler that will be called on error
						error: function(jqXHR, textStatus, errorThrown){
						// log the error to the console
						$("#register_response").html("The following error occured: "+textStatus, errorThrown);
						},
						// callback handler that will be called on completion
						// which means, either on success or error
						complete: function(){
						// enable the inputs
						//$inputs.removeAttr("disabled");
						}
					});
					
				// prevent default posting of form
				event.preventDefault();
		}
		
   });
   
 });