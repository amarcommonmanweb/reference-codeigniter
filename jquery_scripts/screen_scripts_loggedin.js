var states_options = '';  //initialising the value that will store the satte options
		var num_of_school = 2;
		var num_of_siblings = 1;
		var num_of_uploads = 5;
		
			// Wait until the DOM has loaded before querying the document
			$(document).ready(function(){
				
				$('ul.tabs').each(function(){
					// For each set of tabs, we want to keep track of
					// which tab is active and it's associated content
					var $active, $content, $links = $(this).find('a');

					// Use the first link as the initial active tab
					$active = $links.first().addClass('active');
					$content = $($active.attr('href'));

					// Hide the remaining content
					$links.not(':first').each(function () {
						$($(this).attr('href')).hide();
					});

					// Bind the click event handler
					$(this).on('click', 'a', function(e){
						// Make the old tab inactive.
						$active.removeClass('active');
						$content.hide();

						// Update the variables with the new link and content
						$active = $(this);
						$content = $($(this).attr('href'));

						// Make the tab active.
						$active.addClass('active');
						$content.show();
						// Prevent the anchor's default click action
						e.preventDefault();
					});
				});
				
				
				$("#firstname,#middlename,#lastname,#fathers_name,#mothers_name,#res_address_line1,#res_address_line2,#permanent_address_line1,#permanent_address_line2").live("blur",function() {
					
					var return_val = validation1(this);
					error_notify(this, return_val);		
   				});
   				
   				$("#catagory,#gender,#nationality,#res_state,#res_city,#permanent_state,#permanent_city").live("blur",function() {
					var return_val = validation2(this);
					error_notify(this, return_val);		
   				});
   				
   				$('#select_school').live('change',function(){
   								
					populate_select_school('selec_school_list');
   				});
   				
   				$("#catagory,#gender,#nationality,#res_state,#res_city,#permanent_state,#permanent_city").live("change",function() {
					var return_val = validation2(this);
					error_notify(this, return_val);		
   				});
   				
   				$("#date_of_birth").live("change",function() {
					var return_val = validation7(this);
					error_notify(this, return_val);	
					
   				});
   				
   				$("#date_of_birth").live("blur",function() {
					var return_val = validation7(this);
					error_notify(this, return_val);	
					
   				});
   				//keeping both blur and change for the date .. coz thats the only wasy it has worked well
   				
   				
   				$("#res_pin_code,#permanent_pin_code").live("blur",function() {
					var return_val = validation4(this);
					error_notify(this, return_val);		
   				});
   				
   				$("#res_phone1,#res_phone2,#permanent_phone1,#permanent_phone2").live("blur",function() {
					var return_val = validation3(this);
					error_notify(this, return_val);		
   				});
   				
   				$('#res_email,#permanent_email').live("blur",function(){
   					var return_val = validation6(this);
					error_notify(this, return_val);		
   				});
   				//validated uptill the address
   				
   				//validation for the miscellaneous fields starts here
   				$('[id^="pre_edu_school_name"],[id^="sibl_name"],[id^="sibl_school"],[id^="sibl_class"]').live("blur",function(){
   					
   					var return_val = validation1(this);
					error_notify(this, return_val);	
   					
   					
   				});		
   				
   				$('[id^="pre_edu_state"],[id^="pre_edu_city"],[id^="pre_edu_from"],[id^="pre_edu_to"],[id^="sibl_gender"]').live("blur",function(){
   					
   					var return_val = validation2(this);
					error_notify(this, return_val);	
   					
   				
   				});	
   				
   				$('[id^="pre_edu_state"],[id^="pre_edu_city"],[id^="pre_edu_from"],[id^="pre_edu_to"],[id^="sibl_gender"]').live("change",function(){
   					
   					var return_val = validation2(this);
					error_notify(this, return_val);	
   					
   					
   				});	
   				
   				$('[id^="sibl_dob"],[id^="pre_edu_from"],[id^="pre_edu_to"]').live("change",function() {
					var return_val = validation7(this);
					error_notify(this, return_val);	
					
   				});
   				
   				$('[id^="sibl_dob"],[id^="pre_edu_from"],[id^="pre_edu_to"]').live("blur",function() {
					var return_val = validation7(this);
					error_notify(this, return_val);	
					
   				});
   				
   				$('#day_or_hostel').live('blur',function(){
   					var return_val = validation8(this);
					error_notify(this, return_val);	
   				});
   				
   				$('#addmn_test_marks').live('blur',function(){
   					var return_val = validation9(this);
					error_notify(this, return_val);	
   				});
   				
				//ajax call to get the presence school names
				get_states();  // the complete method of the ajax contains all the fills ofthe states
				
				get_catagory();  //the list of catagories or the second tab
				
				get_presence_cities(); //for the initial selection of schools from our range of operation
				
				
				get_docs();	
				
			});
			
		
			function get_presence_cities(){
					// setup some local variables
					var responsedata = '';
					var $form = $(this),
					// let's select and cache all the fields
					$inputs = $form.find("input, select, button, textarea"),
					// serialize the data in the form
					serializedData = 'id=presence_cities';

					// let's disable the inputs for the duration of the ajax request
					$inputs.attr("disabled", "disabled");

					// fire off the request to /confirmAndUpload.php
					$.ajax({
						url: "http://localhost/CodeIgniter/index.php/site/get_presence_cities",
						type: "post",
						data: serializedData,
						// callback handler that will be called on success
						success: function(response, textStatus, jqXHR){
						// log a message to the console
										
					    responsedata = response;
					    					    
						},
						// callback handler that will be called on error
						error: function(jqXHR, textStatus, errorThrown){
						// log the error to the console
						console.log("The following error occured: "+textStatus, errorThrown);
						},
						// callback handler that will be called on completion
						// which means, either on success or error
						complete: function(){
						// enable the inputs
						$inputs.removeAttr("disabled");
						//states_options = responsedata;						
						htmltail = responsedata+'</select>';
						
						maintag = '<select id="select_city" name="select_city" tabindex="1" onchange="get_schools(this.value,\'fill_school\')" style="width:250px;">';
						htmldata = maintag + htmltail;
						$('#presence_cities').html(htmldata);
					    						
						}
					});

				// prevent default posting of form
				event.preventDefault();
			}
		
			function get_docs(){
				
				serializedData = '';
				$.ajax({
						url: "http://localhost/CodeIgniter/index.php/gallery/get_docs",
						type: "post",
						data: serializedData,
						// callback handler that will be called on success
						success: function(response, textStatus, jqXHR){
						// log a message to the console
						
						htmltail = response+'</select>';					
					    maintag = '<select style="width:250px;" name="doc_name" id="doc_name">';
					    htmldata = maintag + htmltail;
						$('#doc_fill').html(htmldata);
					    
						},
						// callback handler that will be called on error
						error: function(jqXHR, textStatus, errorThrown){
						// log the error to the console
						alert(" fetching document list failed");
						console.log("The following error occured: "+textStatus, errorThrown);
						},
						// callback handler that will be called on completion
						// which means, either on success or error
						complete: function(){
						// enable the inputs
					
						}
					});

				// prevent default posting of form
				event.preventDefault();
				
			}
				
			 function get_states(){
					// setup some local variables
					var responsedata = '';
					var $form = $(this),
					// let's select and cache all the fields
					$inputs = $form.find("input, select, button, textarea"),
					// serialize the data in the form
					serializedData = 'id=res_state_fill';

					// let's disable the inputs for the duration of the ajax request
					$inputs.attr("disabled", "disabled");

					// fire off the request to /confirmAndUpload.php
					$.ajax({
						url: "http://localhost/CodeIgniter/index.php/site/get_states",
						type: "post",
						data: serializedData,
						// callback handler that will be called on success
						success: function(response, textStatus, jqXHR){
						// log a message to the console
											
					    responsedata = response;
					    					    
						},
						// callback handler that will be called on error
						error: function(jqXHR, textStatus, errorThrown){
						// log the error to the console
						console.log("The following error occured: "+textStatus, errorThrown);
						},
						// callback handler that will be called on completion
						// which means, either on success or error
						complete: function(){
						// enable the inputs
						$inputs.removeAttr("disabled");
						states_options = responsedata;						
						htmltail = responsedata+'</select>';
						
						maintag = '<select id="res_state" name="res_state" type="text" tabindex="7" style="width:190px;" onchange="get_cities(this.value, \'fill_cities1\',\'res_city\',\'190\')">';
						htmldata = maintag + htmltail;
						$('#res_state_fill').html(htmldata);
					    
						maintag = '<select id="permanent_state" name="permanent_state" type="text" tabindex="7" style="width:190px;" onchange="get_cities(this.value, \'fill_cities2\',\'permanent_city\',\'190\')">';
						htmldata = maintag + htmltail;
						$('#permanent_state_fill').html(htmldata);
				
						maintag = '<select id="pre_edu_state1" name="pre_edu_state[]" type="text" tabindex="7" style="width:180px;" onchange="get_cities(this.value, \'fill_cities3\',\'pre_edu_city1\',\'180\')">';
						htmldata = maintag + htmltail;
						$('#pre_edu_state1_fill').html(htmldata);
				
						maintag = '<select id="pre_edu_state2" name="pre_edu_state[]" type="text" tabindex="7" style="width:180px;" onchange="get_cities(this.value, \'fill_cities4\',\'pre_edu_city2\',\'180\')">';
						htmldata = maintag + htmltail;
						$('#pre_edu_state2_fill').html(htmldata);
						
						}
					});

				// prevent default posting of form
				event.preventDefault();
		
				
				}
				
				
				function get_catagory(){
					// setup some local variables
					var responsedata = '';
					var $form = $(this),
					// let's select and cache all the fields
					$inputs = $form.find("input, select, button, textarea"),
					// serialize the data in the form
					serializedData = '';

					// let's disable the inputs for the duration of the ajax request
					$inputs.attr("disabled", "disabled");

					// fire off the request to /confirmAndUpload.php
					$.ajax({
						url: "http://localhost/CodeIgniter/index.php/site/get_catagory",
						type: "post",
						data: serializedData,
						// callback handler that will be called on success
						success: function(response, textStatus, jqXHR){
						// log a message to the console
									
					    responsedata = response;
					    					    
						},
						// callback handler that will be called on error
						error: function(jqXHR, textStatus, errorThrown){
						// log the error to the console
						console.log("The following error occured: "+textStatus, errorThrown);
						},
						// callback handler that will be called on completion
						// which means, either on success or error
						complete: function(){
						// enable the inputs
						$inputs.removeAttr("disabled");
												
						htmltail = responsedata+'</select>';
						
						maintag = '<select id="catagory" name="catagory" tabindex="2" style="width:250px;" onchange="adjust_catagory(this.value)">';
						htmldata = maintag + htmltail;
						$('#catagory_fill').html(htmldata);
					    
						
						
						}
					});

				// prevent default posting of form
				event.preventDefault();
		
				}
				
			function adjust_catagory(val)
			{
				//The place where we adjustthe form based on the category selected
				
				
				var otherstring = '';
				
				if(val == 1){
					$('#catagory_prevedu').html('Previous Education Details');
					
					otherstring = '<td>';
					otherstring +=	'<label for="day_or_hostel">Day Scholar/ Hostelier</label><br />';
					otherstring +=	'<input name="day_or_hostel" id="day_or_hostel" type="radio" value="Day Scholor" checked="checked" tabindex="7"> Day Scholor</input>&nbsp; &nbsp;&nbsp; &nbsp;';
					otherstring +=	'<input name="day_or_hostel" id="day_or_hostel" type="radio" value="Hostelier" tabindex="7"> Hostelier</input>';
					otherstring +=	'</td>';
					otherstring +=	'<td>';
					otherstring +=	'<label for="addmn_test_marks">Admission Test Marks</label><br />';
					otherstring +=	'<input id="addmn_test_marks" name="addmn_test_marks" type="text" tabindex="7" style="width:190px;"/>';
					otherstring +=	'</td>';
					
					$('#catagory_other tr:last').html(otherstring);
				}
				else{
					
					$('#catagory_prevedu').html('Previous Experience Details');
					otherstring = 'No Options Available';
					$('#catagory_other tr:last').html(otherstring);
				}
				
				
				
			}
			
			function get_cities(state_name, fill_id, city_sel_id, width){
				
					if(state_name != 0)
					{
					var responsedata = '';
					var $form = $(this),
					// let's select and cache all the fields
					$inputs = $form.find("input, select, button, textarea"),
					// serialize the data in the form
					serializedData = 'state_name='+state_name+'&fill_id='+fill_id+'&city_sel_id='+city_sel_id+'&width='+width;

					// let's disable the inputs for the duration of the ajax request
					$inputs.attr("disabled", "disabled");

					// fire off the request to /confirmAndUpload.php
					$.ajax({
						url: "http://localhost/CodeIgniter/index.php/site/get_cities",
						type: "post",
						data: serializedData,
						// callback handler that will be called on success
						success: function(response, textStatus, jqXHR){
						// log a message to the console
									
					    responsedata = response;
					    					    
						},
						// callback handler that will be called on error
						error: function(jqXHR, textStatus, errorThrown){
						// log the error to the console
						console.log("The following error occured: "+textStatus, errorThrown);
						},
						// callback handler that will be called on completion
						// which means, either on success or error
						complete: function(){
						// enable the inputs
						$inputs.removeAttr("disabled");
								
						htmltail = responsedata+'</select>';
						
						var city_sel_name;
						if(city_sel_id.toLowerCase().indexOf("pre_edu_city") >= 0)
						{
							city_sel_name = 'pre_edu_city[]';  
							//this is been done to handle the array type name to the pre_edu_state thing 
						}
						else
						{
							city_sel_name = city_sel_id;
						}	
						maintag = '<select id="'+city_sel_id+'" name="'+city_sel_name+'" type="text" tabindex="7" style="width:'+width+'px;">';
						htmldata = maintag + htmltail;
						var fill_idd = '#'+fill_id;
					
						$(fill_idd).html(htmldata);
					    
						
						
						}
					});

				// prevent default posting of form
				event.preventDefault();
				}
			}
			
			function add_row_prev_school(tableID) {
			num_of_school++;
		
			var table = document.getElementById(tableID);
 			
            var rowCount = table.rows.length;  //gives the number of rows + 1 in the tableID
            var row = table.insertRow(rowCount);   //hence you use it to insert that number here
            var row_id = 'pre_edu_row_id'+num_of_school;
            
			row.id = row_id; //adding this row id only so that it can be deleted ... used below .. at X
			
			if((num_of_school % 2) == 0)
			{
				row.style.background = '#F9F9F9';	
			}
			
			var cell1 = row.insertCell(0);
			cell1.innerHTML = '<input id="pre_edu_school_name'+num_of_school+'" name="pre_edu_school_name[]" type="text" tabindex="7" style="width:230px;" maxlength="80"/>';
			
			
			var cell2 = row.insertCell(1);
			var maintag = '<select id="pre_edu_state'+num_of_school+'" name="pre_edu_state[]" type="text" tabindex="7" style="width:180px;" onchange="get_cities(this.value, \'fill_cities'+(num_of_school+2)+'\',\'pre_edu_city'+num_of_school+'\',\'180\')">';
			
			htmltail = states_options+'</select>';
			cell2.innerHTML = maintag+htmltail;
							
		
			var cell3 = row.insertCell(2);
			var city_string = '<div id="fill_cities'+(num_of_school+2)+'">';
			city_string += '<select id="pre_edu_city'+num_of_school+'" name="pre_edu_city[]" type="text" tabindex="7" style="width:180px;">';
			city_string += '<option value="0">Select City</option>';							
			city_string += '</select>';
			city_string += '</div>';
			cell3.innerHTML = city_string;
			
			var cell4 = row.insertCell(3);
			var from_string = '<input class="datefield" id="pre_edu_from'+num_of_school+'" name="pre_edu_from[]" type="text" tabindex="7" style="width:110px;"/>';
            //the year must be taken from date later
				
			cell4.innerHTML = from_string;
			
			var cell5 = row.insertCell(4);
			var to_string = '<input class="datefield" id="pre_edu_to'+num_of_school+'" name="pre_edu_to[]" type="text" tabindex="7" style="width:110px;"/>';
						
			cell5.innerHTML = to_string;
			
			var cell6 = row.insertCell(5);
		
			cell6.innerHTML = '<a href="javascript:del_table_row('+row_id+')"> <span style="color:#ff0000"><strong> X </strong></span></a>';
			
			//var id_name = "fill_states"+num_of_school;
			//getstates(id_name,num_of_school,'pre_edu_state');
			//returning false here so that the browser does not redirect to any href link
			return false;
		  }
			
		function add_sibling_row(tableID){
			num_of_siblings++;
			var table = document.getElementById(tableID);

            var rowCount = table.rows.length;
         
            var row = table.insertRow(rowCount);
			var row_id = 'sibl_row_id'+num_of_siblings;            
			row.id = row_id; //adding this row id only so that it can be deleted ... used below .. at X
			
			if((num_of_siblings % 2) == 0)
			{
				row.style.background = '#F9F9F9';	
			}
			
			var cell1 = row.insertCell(0);
			cell1.innerHTML = '<input id="sibl_name'+num_of_siblings+'" name="sibl_name[]" type="text" tabindex="7" style="width:210px;" maxlength="80"/>';
			
			var cell2 = row.insertCell(1);
			var sib_gend_str='<select id="sibl_gender'+num_of_siblings+'" name="sibl_gender[]" type="text" tabindex="7"  style="width:90px;">';
				sib_gend_str += '<option value="0">Select Gender</option>';
				sib_gend_str += '<option value="Male">Male</option>';
				sib_gend_str += '<option value="Female">Female</option>';
				sib_gend_str += '</select>';
				
				sib_gend_str += '<script>$(function() {$( "#sibl_dob'+num_of_siblings+'" ).datepicker();});</script>';
			cell2.innerHTML = sib_gend_str;
			
			var cell3 = row.insertCell(2);
			cell3.innerHTML = '<input class="datefield" id="sibl_dob'+num_of_siblings+'" name="sibl_dob[]" type="text" tabindex="7" style="width:120px;"/>';
			
			var cell4 = row.insertCell(3);
			cell4.innerHTML = '<input id="sibl_school'+num_of_siblings+'" name="sibl_school[]" type="text" tabindex="7" style="width:220px;" maxlength="80"/>';
			
			var cell5 = row.insertCell(4);
			cell5.innerHTML = '<input id="sibl_class'+num_of_siblings+'" name="sibl_class[]" type="text" tabindex="7" style="width:90px;" maxlength="30"/>';
				
			var cell6 = row.insertCell(5);
		
			cell6.innerHTML = '<a href="javascript:del_table_row('+row_id+')"> <span style="color:#ff0000"><strong> X </strong></span></a>';
				
			//returning false here so that the browser does not redirect to any href link
			return false;	
			
		}
		
		function populate_select_school(tableID){
			
			var table = document.getElementById(tableID);

            var rowCount = table.rows.length;
            var row = table.insertRow(rowCount);
        
            var school_id = $('#select_school').val();
            var row_id = 'school_'+school_id; 
            
            var no_repeat_flag = 0;
			$('#'+tableID+' tr').each(function(){
				
				if((rowCount != 0) && (row_id == $(this).attr('id')))
				{
					no_repeat_flag = 1;
				} 
			});  
                
            if((no_repeat_flag == 0)&&(school_id != 0))
			{           
			row.id = row_id;
					
			var school_name = $("#select_school option:selected").text();
			var school_city = $("#select_city option:selected").text();
			
			
			var cell1 = row.insertCell(0);
			cell1.innerHTML = school_name+', '+school_city;
			
			var cell2 = row.insertCell(1);
			cell2.innerHTML = '<a id="del_sch" href="javascript:del_table_row('+row_id+')">&nbsp;&nbsp;X&nbsp;&nbsp;</a>';
			}
		}	
		
		
		
		
		/*  --Not required anymore
		function add_upload_row(tableID){
			num_of_uploads++;
		  	var table = document.getElementById(tableID);
 
            var rowCount = table.rows.length;
            var row = table.insertRow(rowCount);
			var row_id = 'upload_row_id'+num_of_uploads;            
			row.id = row_id; //adding this row id only so that it can be deleted ... used below .. at X
			
			if((num_of_uploads % 2) == 0)
			{
				row.style.background = '#F9F9F9';	
			}
		  
			var cell1 = row.insertCell(0);
			cell1.innerHTML = '<input id="upload_name'+num_of_uploads+'" name="upload_name'+num_of_uploads+'" type="text" tabindex="7" style="width:250px;"/>';
			
			var cell2 = row.insertCell(1);
			cell2.innerHTML = '<input id="upload_comment'+num_of_uploads+'" name="upload_comment'+num_of_uploads+'" type="text" tabindex="7" style="width:260px;"/>';
			
			var cell3 = row.insertCell(2);
			cell3.innerHTML = '<input id="upload_file'+num_of_uploads+'" name="upload_file'+num_of_uploads+'" type="file" tabindex="7" style="width:220px;"/>';
			
			var cell4 = row.insertCell(3);
			alert('the row id is '+ row_id);
			cell4.innerHTML = '<a href="javascript:del_table_row('+row_id+')"> <span style="color:#ff0000"><strong> X </strong></span></a>';
				
		  //returning false here so that the browser does not redirect to any href link
			return false;
		}*/
		
			function del_table_row(del_id){
				alert('yes .. in del row'+del_id);
				 $(del_id).remove();
			}
			
						
			function get_schools(city_id,fill_id){
				
				// setup some local variables
					if(city_id != 0)
					{
					var responsedata = '';
					var $form = $(this),
					// let's select and cache all the fields
					$inputs = $form.find("input, select, button, textarea"),
					// serialize the data in the form
					serializedData = 'city_id='+city_id;

					// let's disable the inputs for the duration of the ajax request
					$inputs.attr("disabled", "disabled");

					// fire off the request to /confirmAndUpload.php
					$.ajax({
						url: "http://localhost/CodeIgniter/index.php/site/get_schools",
						type: "post",
						data: serializedData,
						// callback handler that will be called on success
						success: function(response, textStatus, jqXHR){
						// log a message to the console
										
					    responsedata = response;
					    					    
						},
						// callback handler that will be called on error
						error: function(jqXHR, textStatus, errorThrown){
						// log the error to the console
						console.log("The following error occured: "+textStatus, errorThrown);
						},
						// callback handler that will be called on completion
						// which means, either on success or error
						complete: function(){
						// enable the inputs
						$inputs.removeAttr("disabled");
									
						htmltail = responsedata+'</select>';
						
						maintag = '<select id="select_school" name="select_school" tabindex="2" style="width:250px;">';
						htmldata = maintag + htmltail;
						$('#'+fill_id).html(htmldata);
					    
						}
					});

				// prevent default posting of form
				event.preventDefault();
				}
			}
			
			
			function validate_cand_reg(){
				// this is where all the registration for the candidate happenes
				
				var err_counter = 0;
				var selected_schools = new Array();
			
				$('#content :text,select:not("#select_school")').each(function(){			
					$(this).blur();
						
				});
		
				$('.cb_val_error').each(function(){			
					err_counter++;			
				});
		
				if(err_counter > 0 )
				{
					alert('Hi, Please recheck the form, correct the errors and try again -- counter'+err_counter);
				}
				
				var numrows = $('#selec_school_list tr').length;
				if(numrows == 0)
				{
					
					err_counter++;
					alert('You must select atleast one school to apply to ');	
				}
				else
				{
					var temp_id;
					var splits;
					//collect all the schools into an id to pass it later on in post
					$('#selec_school_list tr').each(function(){
						
						alert("the row id is "+$(this).attr('id'));
						temp_id = $(this).attr('id');
						splits = temp_id.split("_");
						
						temp_id = splits[1];
						alert("after split "+temp_id);
							
						selected_schools.push(temp_id);
					});  				
					
				}
					
				
		
				if(err_counter == 0)
				{
					//call function to navigate to other form
					$("#register_response").fadeOut(300);
					serializedData = $('#content :text,select,radio').serialize();
					serializedData = serializedData+'&day_or_hostel='+$('input:radio[name="day_or_hostel"]:checked').val();
					serializedData = serializedData+'&selected_schools='+selected_schools;
					alert("here is where it comes for serialised data "+serializedData);
			
						//ajax post
						$.ajax({
							// could have used echo site_url('login/validate_login'); if this was php
						url: "http://localhost/CodeIgniter/index.php/site/save_candidate_data",
						type: "post",
						data: serializedData,
						// callback handler that will be called on success
						success: function(response, textStatus, jqXHR){
						//log a message to the console
						
						//document.getElementById("confirm_block").innerHTML = 'Invalid Security Code';
						var save_response = response;
						
						alert("response is "+response);
						$('#temp_test_area').html(save_response);
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
						$("#temp_test_area").html("The following error occured: "+textStatus, errorThrown);
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
   				
				
				
				
				//window.location = "http://localhost/CodeIgniter/index.php/gallery";
		
			}
			
			function error_notify(elem, return_val)
   			{
   				
				if(return_val == 1)
				{
					$(elem).removeClass('cb_val_error');
					$(elem).addClass('cb_val_success');
					var this_id = $(elem).attr('id');
				
					//var error_div = '#'+this_id+'_err';
					//$(error_div).fadeOut(500);		
				}
				if(return_val == 0)
				{
					$(elem).addClass('cb_val_error');
					$(elem).removeClass('cb_val_success');
					var this_id = $(elem).attr('id');
				
					//var error_div = '#'+this_id+'_err';
					//$(error_div).fadeIn(500);			
				}	   
   			}
			
			
			function save_candidate_data(){
				
				alert('this is where we save the candidates data');
				
			}
			
			
		$(function() {
       	 $('.datefield').live('click', function () {
       	 	
            $(this).datepicker('destroy').datepicker({
            changeMonth: true,
			changeYear: true,
			yearRange: "-30:+0",
			dateFormat: 'dd/mm/yy'}).focus();
    	 });
    	 
    	 
    
     
		});
		
		//end of ajax upload
		
		function del_table_row_doc(del_id){
			
			
			var doc_url = ''+$(del_id).find('.url_link').attr('href');
			serializedData = 'doc_url='+doc_url;
			
			$.ajax({
						url: "http://localhost/CodeIgniter/index.php/gallery/delete_doc",
						type: "post",
						data: serializedData,
						// callback handler that will be called on success
						success: function(response, textStatus, jqXHR){
						// log a message to the console
						
						if(response == "done")
						{				
					    	$(del_id).remove();
					    }	
					    else
					    {
					    	alert("An error occured while removing the file, please try again");
					    }				    
						},
						// callback handler that will be called on error
						error: function(jqXHR, textStatus, errorThrown){
						// log the error to the console
						alert('the file could not be removed, please try again');
						console.log("The following error occured: "+textStatus, errorThrown);
						},
						// callback handler that will be called on completion
						// which means, either on success or error
						complete: function(){
						// enable the inputs
						
					   
						}
					});

				// prevent default posting of form
				event.preventDefault();  
		}
		
    	 
   		function update_doc_db(){
		
			$.ajax({
						url: "http://localhost/CodeIgniter/index.php/gallery/update_doc_db",
						type: "post",
						data: serializedData,
						// callback handler that will be called on success
						success: function(response, textStatus, jqXHR){
						// log a message to the console
						
						if(response == "done")
						{				
					    	//procede to admission date allocation
					       window.location="http://localhost/CodeIgniter/index.php/site/admission_test_dates";						
					    }	
					    else
					    {
					    	$('#doc_err').html(response);
					    }				    
						},
						// callback handler that will be called on error
						error: function(jqXHR, textStatus, errorThrown){
						// log the error to the console
						alert('Error while uploading files, please try again');
						console.log("The following error occured: "+textStatus, errorThrown);
						},
						// callback handler that will be called on completion
						// which means, either on success or error
						complete: function(){
						// enable the inputs
						
					   
						}
					});

				// prevent default posting of form
				event.preventDefault();  
			
			
		}
   		
   		 $(function() {
        	$( document ).tooltip();
    	});
   		
   		
