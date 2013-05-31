var error_msgs = new Array();

error_msgs['emailid'] = 'Enter a valid email id.  Eg: crossbow@xyzz.com, hellooo@yahoo.in';
error_msgs['phone'] = 'Eg. 09999999999, 08025424865';
error_msgs['username'] = 'valid characters - Alphabets, number, dot, underscore';
//there are here coz they have to be changed dynamically on is_user_exists
							
 $(document).ready(function() {
  
  //initial setting s on load
  $('#registerform').hide();
  $('.err_tip').hide();
  $("#signin_response").hide();
  $('#register_response').hide();
  
   $("#register_a").click(function() {
	$('#signinform').hide(500);
	$('#registerform').show(500);
   });
   
   $("#signin_a").click(function() {
	$('#registerform').hide(500);
	$('#signinform').show(500);
   });
      
  $('#emailid_err').attr('title', error_msgs['emailid']);
  $('#phone_err').attr('title', error_msgs['phone']);
  $('#username_err').attr('title', error_msgs['username']);  
   //end of initial settings
   

   
   //Start - validation on blur
   
   $("#firstname,#lastname,#password").blur(function() {
		var return_val = validation0(this);
		error_notify(this, return_val);		
   });
   
   $("#username").blur(function() {
		var return_val = validation0(this);
		if($('#username').attr('value') != '')
		{
		var ajax_parameter = 'username='+$('#username').attr('value');
		if((return_val == 1) && is_user_existing(ajax_parameter,this)){
			return_val = 0;
		}
		}
		error_notify(this, return_val);		
   });
    
   $("#repassword").blur(function() {
		var return_val = validation0(this);
		
		if($('#repassword').attr('value') != $('#password').attr('value'))
		{
			return_val = 0;
		}
		error_notify(this, return_val);		
   });
   
   $("#emailid").blur(function() {
		var return_val = validation6(this);
		var ajax_parameter = 'emailid='+$('#emailid').attr('value');
		if($('#emailid').attr('value') != '')
		{
		if((return_val == 1) && is_user_existing(ajax_parameter,this)){
			return_val = 0;
		}
		}
		error_notify(this, return_val);		
   });
   
   $("#phone").blur(function() {
		var return_val = validation3(this);
		var ajax_parameter = 'phone='+$('#phone').attr('value');
		if($('#phone').attr('value') != '')
		{
		if((return_val == 1) && is_user_existing(ajax_parameter,this)){
			return_val = 0;
		}
		}
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
   
   //End - validation on blur
      
   //Start -  on clock register button
   $("#register").click(function() {
		var err_counter = 0;
		
		$('#registerform :text').each(function(){			
			$(this).blur();			
		});
		
		$('.error').each(function(){			
			err_counter++;			
		});
				
		alert("the errors are "+err_counter);
		
		if(err_counter == 0)
		{
			//call function to navigate to other form
			$("#register_response").fadeOut(300);
		serializedData = $('#registerform :input').serialize();
		alert("here is where it comes for serialised data"+serializedData);
			
						//ajax post
						$.ajax({
							// could have used echo site_url('login/validate_login'); if this was php
						url: "http://localhost/CodeIgniter/index.php/login/validate_register",
						type: "post",
						data: serializedData,
						// callback handler that will be called on success
						success: function(response, textStatus, jqXHR){
						//log a message to the console
						
						//document.getElementById("confirm_block").innerHTML = 'Invalid Security Code';
						var login_response = response;
						alert("the response is .aaaa.."+login_response);
						if(response == 'true')
						{
							//navigate to your page
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
						alert("a terrible error has occured"+jqXHR+" and "+textStatus+" naddd"+errorThrown);
						$("#register_response").html("The following error occured: "+textStatus, errorThrown);
						},
						// callback handler that will be called on completion
						// which means, either on success or error
						complete: function(){
							
							alert('task completed');
						// enable the inputs
						//$inputs.removeAttr("disabled");
						}
					});
					
				// prevent default posting of form
				event.preventDefault();
		}
		
   });
   
     function show_registration_confirm()
     {
						serializedData = '';	
						//ajax post
						$.ajax({
						url: "http://localhost/CodeIgniter/index.php/login/registration_success",
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
						$("#login_content").html("The following error occured: "+jqXHR+' '+textStatus, errorThrown);
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
   
   function is_user_existing(ajax_data,elem){
   	serializedData = ajax_data;
   		
   	
   				$.ajax({
						url: "http://localhost/CodeIgniter/index.php/login/is_user_existing",
						type: "post",
						data: serializedData,
						
						
						// callback handler that will be called on success
						success: function(response, textStatus, jqXHR){
						//log a message to the console
						
						alert("in user exists .. and the response is .vv. --"+response+'--');
						$(elem).attr('id');
						var this_id = $(elem).attr('id');
						var error_div = '#'+this_id+'_err';
							
						if(response == 'true')
						{
							alert('in treu .. message = '+response);
							$(error_div).attr('title', error_msgs[elem]);	
							error_notify(elem, 1);
							
						}
						else
						{
							alert('in not treu .. message = '+response);
							$(error_div).attr('title', response);
							error_notify(elem, 0);
							
						}
								
						//console.log("Hooray, it worked!");
						},
						// callback handler that will be called on error
						error: function(jqXHR, textStatus, errorThrown){
						// log the error to the console
						$("#login_content").html("The following error occured: "+jqXHR+" and "+textStatus+" andd "+ errorThrown);
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
   	
   		return 0;
   }
   
   //End - on click register button
   
   
    $("#Sign_in").click(function() {
   	
		$("#signin_response").fadeOut(300);
		serializedData = $('#signinform :text').serialize();
		alert("serialised data while log in is "+serializedData);
		serializedData = serializedData+'&action=signin';	
		
						//ajax post
						$.ajax({
						url: "http://localhost/CodeIgniter/index.php/login/validate_credentials",
						type: "post",
						data: serializedData,
						// callback handler that will be called on success
						success: function(response, textStatus, jqXHR){
						//log a message to the console
						
						
						if(response == 'true')
						{
							window.location.href = "http://localhost/CodeIgniter/index.php/site/members_area";						
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
   
         
 });