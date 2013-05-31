<!-- include the custome jquery that u have written here -->
<script type="text/javascript" src="http://localhost/CodeIgniter/jquery_scripts/screen_scripts_loggedin.js"></script>
<script type="text/javascript" src="http://localhost/CodeIgniter/javascripts/field_validations.js"></script>

 <link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
    <script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>

		<style>
			.tabs li {
				list-style:none;
				display:inline;
			}

			.tabs a {
				padding:5px 10px;
				display:inline-block;
				background:#ccc;
				color:#fff;
				text-decoration:none;
				border-bottom: none;
			}

			.tabs a.active {
				background:#666;
				color:#000;
			}
		</style>
	
</head>

<body>
<form id="admissiondata_form">
<!-- wrap starts here -->

<div id="wrap">

	<!--header -->

	<div id="header">							

		<h1 id="logo-text"><a href="index.html" title="">Crossbow</a></h1>		

		<p id="slogan">&nbsp; &nbsp; &nbsp; - Admissions </p>		

	

	<!--header ends-->					

	</div>	
	
		<ul class='tabs' style="float:right;margin-right:50px;">
					<li><a href="#tab0">&nbsp;&nbsp;&nbsp; Main &nbsp;&nbsp;&nbsp;</a></li>
					<li><a href="#tab1">Select School</a></li>
					<li><a href="#tab2">Personal Information</a></li>
					<li><a href="#tab3">Address Details</a></li>
					<li><a href="#tab4">Miscellaneous Details</a></li>
					
		</ul>
		
		
		<div id="content-outer" class="clear"><div id="content-wrap">	<!-- this is the form to be filled. -->

		<div id="content">				
				
				<div style="clear: both;">&nbsp;</div>
				<div id="tab0">
					<div id="temp_test_area"></div>
				</div>	
				
				<div id="tab1">
					<center style="background: url(../images/dotted-lines.gif) repeat-x left bottom;">
					<div style="float:left;margin-left: 250px;">
					<p>
					<script>load_school_cities('select_city');</script>    
					<label for="select_city">Select City</label><br />  <!-- the city id and name must match the db/ or you can change it later to be automated from db itself -->
					<div id="presence_cities">
					<select id="select_city" name="select_city" tabindex="1" onchange="get_schools(this.value,'fill_school')" style="width:250px;">
           			<option value="0">Select City</option>
					<option value="1">Bangalore</option>
					<option value="2">Chennai</option>
          			<option value="3">Hyderabad</option>
					<option value="4">Pune</option>

					</select>
					</div>
					</p>
					<p>
					
					<label for="select_school">Select School</label><br />
					<div id="fill_school">
					<select id="select_school" name="select_school" tabindex="2" style="width:250px;">
						<option value="0">Select School</option>
					</select>
					</div>
					</p>	
					
					<p>
						<label for="catagory">Apply As</label><br />
					<div id="catagory_fill">
						<select id="catagory" name="catagory" tabindex="2" style="width:250px;" onchange="adjust_catagory(this.value)">
						<option value="0">Select Catagory</option>
					</select>
					</div>
					</p>
					<br/>
					</div>
					<div id="selected_schools_list">
						<strong>Schools you selected</strong><hr style="color:#ddddd;"/>
						<table id="selec_school_list" width="100%">
							
						</table>
						
						
						<div style="clear: both;"></div>
					</div>
					</center>	
					<div style="clear: both;">&nbsp;</div>
					<div style="float:right;margin-right:20px;" class="stdlinks"><p><a class="more-link" href="javascript:populate_select_school('selec_school_list')">&nbsp; Nexttt &nbsp;</a></p></div>
				</div>
				
				<div id="tab2">
					<div style="background: url(../images/dotted-lines.gif) repeat-x left bottom;">
					<table style="width:100%;">	
					<tr>
					<th colspan="3">Personal Information</th>
					</tr>
					<tr>
					<td> 
							<label for="firstname">First Name</label><br />
							<input id="firstname" name="firstname" type="text" tabindex="1"  style="width:250px;" maxlength="50"/>
					</td>  
					<td> 
							<label for="middlename">Middle Name</label><br />
							<input id="middlename" name="middlename" type="text" tabindex="2"  style="width:250px;" maxlength="50"/>
					</td>
					<td>
							<label for="lastname">Last Name</label><br />
							<input id="lastname" name="lastname" type="text" tabindex="3"  style="width:250px;" maxlength="50"/>
					</td>
					</tr>
	
					<tr>
					<td>
							<label for="gender">Gender</label><br />
							<select id="gender" name="gender" type="text" tabindex="3"  style="width:250px;">
							<option value="0">Select Gender</option>
							<option value="Male">Male</option>
							<option value="Female">Female</option>
							</select>
					</td>
					<td>
							<label for="date_of_birth">Date of Birth</label><br />
							<input id="date_of_birth" class="datefield" name="date_of_birth" type="text" tabindex="3"  style="width:250px;" maxlength="10"/>
					</td>
					<td>
							<label for="nationality">Nationality</label><br />
							<select id="nationality" name="nationality" type="text" tabindex="3"  style="width:250px;">
							<option value="0">Select Nationality</option>
							<option value="1">Indian</option>
							<option value="2">Others</option>
							</select>
					</td>	
					</tr>
					<tr>
					<td>
							<label for="fathers_name">Father's Name</label><br />
							<input id="fathers_name" name="fathers_name" type="text" tabindex="3"  style="width:250px;" maxlength="70"/>
					</td>
					<td>
							<label for="mothers_name">Mother's Name</label><br />
							<input id="mothers_name" name="mothers_name" type="text" tabindex="3"  style="width:250px;" maxlength="70"/>
					</td>
					</tr>
					</table >
					</div>
					<div style="float:right;margin-right:20px;" class="stdlinks"><p><a class="more-link" href="javascript:captchavalidate()">&nbsp; Next &nbsp;</a></p></div>
					
				</div>
				<div id="tab3">
					<div style="background: url(../images/dotted-lines.gif) repeat-x left bottom;">
					<table style="width:100%;">
					<tr>
					<th colspan="4">
					Residential Address
					</th>
					</tr>
					<tr>
					<td>
							<label for="res_address_line1">Address Line 1</label><br />
							<input id="res_address_line1" name="res_address_line1" type="text" tabindex="7" style="width:190px;"  maxlength="80"/>
					</td>
					<td>
							<label for="res_address_line2">Address Line 2</label><br />
							<input id="res_address_line2" name="res_address_line2" type="text" tabindex="7" style="width:190px;" maxlength="80"/>
					</td>
					<td>
							
							<label for="res_state">State</label><br />
							<div id="res_state_fill">
							<select id="res_state" name="res_state" type="text" tabindex="7" style="width:190px;" onchange="get_cities(this.value, 'fill_cities1','res_city','190')">
							
							<option value=0>Select State</option>	
							
							</select>
							</div>
					</td>
					<td>			
							
							<label for="res_city">City</label><br />
							<div id="fill_cities1">
							<select id="res_city" name="res_city" type="text" tabindex="7" style="width:190px;">
							<option value="0">Select City</option>							
							</select>
							</div>
					</td>
					</tr>
					<tr>
					<td>
						<label for="res_pin_code">Pin Code</label><br />
						<input id="res_pin_code" name="res_pin_code" type="text" tabindex="7" style="width:190px;" maxlength="10"/>
					</td>
					<td>
						<label for="res_phone1">Phone 1</label><br />
						<input id="res_phone1" name="res_phone1" type="text" tabindex="7" style="width:190px;" maxlength="15"/>
					</td>
					<td>
						<label for="res_phone2">Phone 2</label><br />
						<input id="res_phone2" name="res_phone2" type="text" tabindex="7" style="width:190px;" maxlength="15"/>
					</td>
					<td>
						<label for="res_email">Email</label><br />
						<input id="res_email" name="res_email" type="text" tabindex="7" style="width:190px;" maxlength="70"/>
					</td>
					</tr>
					</table>
					
					<div style="clear: both;">&nbsp;</div>
					
					<table style="width:100%;">
					<tr>
					<th colspan="4">
					Permanent Address
					</th>
					</tr>
					<tr>
					<td>
						<label for="permanent_address_line1">Address Line 1</label><br />
						<input id="permanent_address_line1" name="permanent_address_line1" type="text" tabindex="7" style="width:190px;" maxlength="80"/>
					</td>
					<td>
						<label for="permanent_address_line2">Address Line 2</label><br />
						<input id="permanent_address_line2" name="permanent_address_line2" type="text" tabindex="7" style="width:190px;" maxlength="80"/>
					</td>
					<td>
					
						<label for="permanent_state">State</label><br />
						<div id="permanent_state_fill">
						<select id="permanent_state" name="permanent_state" type="text" tabindex="7" style="width:190px;" onchange="get_cities(this.value, 'fill_cities2','permanent_city','190')">
						<option value="0">Select State</option>	
							
						</select>
						</div>
					</td>
					<td>
						
						<label for="permanent_city">City</label><br />
						<div id="fill_cities2">
						<select id="permanent_city" name="permanent_city" type="text" tabindex="7" style="width:190px;">
								<option value="0">Select City</option>							
						</select>
						</div>
						
					</td>
					</tr>
					<tr>
					<td>
						<label for="permanent_pin_code">Pin Code</label><br />
						<input id="permanent_pin_code" name="permanent_pin_code" type="text" tabindex="7" style="width:190px;" maxlength="10"/>
					</td>
					<td>
						<label for="permanent_phone1">Phone 1</label><br />
						<input id="permanent_phone1" name="permanent_phone1" type="text" tabindex="7" style="width:190px;" maxlength="12"/>
					</td>
					<td>
						<label for="permanent_phone2">Phone 2</label><br />
						<input id="permanent_phone2" name="permanent_phone2" type="text" tabindex="7" style="width:190px;" maxlength="12"/>
					</td>
					<td>
						<label for="permanent_email">Email</label><br />
						<input id="permanent_email" name="permanent_email" type="text" tabindex="7" style="width:190px;" maxlength="80"/>
					</td>
					</tr>
					</table>
					</div>
					<div style="float:right;margin-right:20px;" class="stdlinks"><p><a class="more-link" href="javascript:captchavalidate()">&nbsp; Next &nbsp;</a></p></div>
				</div>
				
				<div id="tab4">
					<div style="background: url(../images/dotted-lines.gif) repeat-x left bottom;">
					<table id = "add_prev_school_row" style="width:100%;">
					<tr>
					<th colspan="5">
					<div style="float:left;" id="catagory_prevedu">Previous Education Details</div><div style="margin-right:20px;float:right;"><a id="add_prev_school" href="javascript:add_row_prev_school('add_prev_school_row')"><strong>Add more schools</strong></a></div>
					</th>
								</tr>
					<tr>
					<td>
						<label for="pre_edu_school_name1">School Name</label><br />
									<input id="pre_edu_school_name1" name="pre_edu_school_name[]" type="text" tabindex="7" style="width:230px;" maxlength="80"/>
					</td>
					<td>
						<label for="pre_edu_state1">State</label><br />
						<div id="pre_edu_state1_fill">
						<select id="pre_edu_state1" name="pre_edu_state[]" type="text" tabindex="7" style="width:180px;" onchange="get_cities(this.value, 'fill_cities3','pre_edu_city1','180')">
							<option value=0>Select State</option>	
										
						</select>						
						</div>			
					</td>					
					<td>
						<label for="pre_edu_city1">City</label><br />
						<div id="fill_cities3">
						<select id="pre_edu_city1" name="pre_edu_city[]" type="text" tabindex="7" style="width:180px;">
								<option value="0">Select City</option>							
						</select>
						</div>
									
					</td>
					<td>
					<label for="pre_edu_from1">From</label><br />
					<input class="datefield" id="pre_edu_from1" name="pre_edu_from[]" type="text" tabindex="7" style="width:110px;"/>
					
						
					</td>
					<td>
					<label for="pre_edu_to1">To</label><br />
					<input class="datefield" id="pre_edu_to1" name="pre_edu_to[]" type="text" tabindex="7" style="width:110px;"/>
					
					</td>
					
					</tr>
					<tr style="background: #F9F9F9;">
					<td>			
						<input id="pre_edu_school_name2" name="pre_edu_school_name[]" type="text" tabindex="7" style="width:230px;" maxlength="80"/>
					</td>
					<td>
						<div id="pre_edu_state2_fill">
						<select id="pre_edu_state2" name="pre_edu_state[]" type="text" tabindex="7" style="width:180px;" onchange="get_cities(this.value, 'fill_cities4','pre_edu_city2','180')">
							<option value=0>Select State</option>	
												
						</select>						
						</div>
					</td>
					<td>
						<div id="fill_cities4">
						<select id="pre_edu_city2" name="pre_edu_city[]" type="text" tabindex="7" style="width:180px;">
								<option value="0">Select City</option>							
						</select>
						</div>
						
					</td>
					<td>
					<input class="datefield" id="pre_edu_from2" name="pre_edu_from[]" type="text" tabindex="7" style="width:110px;"/>	
					
					</td>
					<td>
					<input class="datefield" id="pre_edu_to2" name="pre_edu_to[]" type="text" tabindex="7" style="width:110px;"/>	
											
					</td>
					
					</tr>
								
					
					</table>
				
								<div style="clear: both;">&nbsp;</div>
					
					<table id = "siblings_info" style="width:100%;">
					<tr>
								<th colspan="5">
					Siblings Information<div style="margin-right:20px;float:right;"><a id="add_siblings" href="javascript:add_sibling_row('siblings_info')"><strong>Add more siblings<strong></a></div>
					</th>
					</tr>
					<tr>
					<td>
						<label for="sibl_name1">Full Name</label><br />
						<input id="sibl_name1" name="sibl_name[]" type="text" tabindex="7" style="width:210px;" maxlength="80"/>
								</td>
					<td>
						<label for="sibl_gender1">Gender</label><br />
						<select id="sibl_gender1" name="sibl_gender[]" type="text" tabindex="7"  style="width:90px;">
							<option value="0">Select Gender</option>
							<option value="Male">Male</option>
							<option value="Female">Female</option>
						</select>						
					</td>
					<td>
						<label for="sibl_dob1">Date of Birth</label><br />
						<input class="datefield" id="sibl_dob1" name="sibl_dob[]" type="text" tabindex="7" style="width:120px;"/>
					</td>
					<td>
						<label for="sibl_school1">School</label><br />
						<input id="sibl_school1" name="sibl_school[]" type="text" tabindex="7" style="width:220px;" maxlength="80"/>
								</td>
					<td>
						<label for="sibl_class1">Class</label><br />
						<input id="sibl_class1" title="sibling class onetoo" name="sibl_class[]" type="text" tabindex="7" style="width:90px;" maxlength="30"/>
								</td>
					</tr>
					
					</table>
								
					<div style="clear: both;">&nbsp;</div>
					
					<table  id="catagory_other" style="width:100%;">
								<tr>
					<th colspan="5">
					Others
					</th>
								</tr>
					<tr>
					
					<td>
						<label for="day_or_hostel">Day Scholar/ Hostelier</label><br />
						<input name="day_or_hostel" type="radio" checked="checked" value="Day"> Day Scholor</input>&nbsp; &nbsp;&nbsp; &nbsp;
						<input name="day_or_hostel" type="radio" value="Hostel"> Hostelier</input>
									
					</td>
					<td>
						<label for="addmn_test_marks">Admission Test Marks</label><br />
									<input id="addmn_test_marks" name="addmn_test_marks" type="text" tabindex="7" style="width:190px;" maxlength="10"/>
					</td>
					
					</tr>		
					</table>
					</div>
					
				<div style="float:right;margin-right:20px;" class="stdlinks"><p><a class="more-link" href="javascript:validate_cand_reg()">&nbsp; Save & Proceed to Document Upload &nbsp;</a></p></div>
				</div>
				

				
						
		</div>	
	<!-- content end -->	

	</div></div>
	
	
