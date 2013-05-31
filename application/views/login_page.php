<!-- include the custome jquery that u have written here -->
<script type="text/javascript" src="http://localhost/CodeIgniter/jquery_scripts/screen_scripts.js"></script>
<script type="text/javascript" src="http://localhost/CodeIgniter/javascripts/field_validations.js"></script>

</head>

<body>
	
<div id="wrap">

	<!--header -->

	<div id="header" style="height:200px;">				

		<h1 id="logo-text"><a href="index.html" title="">Crossbow</a></h1>		

		<p id="slogan">&nbsp; &nbsp; &nbsp; - Login </p>						

	<!--header ends-->					

	</div>



<!-- wrap starts here -->
 
	<div style="clear: both;">&nbsp;</div>

		<div id="content_login">		
						
			<div id="login_content">						
							
				<div id="signinform" class="entry" style="margin-left:40px;">			
					
					<div style="float:right;margin-right:30px;">
				
						Don't have an account?&nbsp; <a id ="register_a" href="javascript:void(0)"><strong>Register here.</strong></a>
				
					</div>
					<h3>Sign in.</h3>

					<p>	

					<label for="login_username">Username</label><br />

					<input class="inputbox" id="login_username" name="login_username" type="text" tabindex="2" style="width:250px;" maxlength="30"/>
					&nbsp;<img class="err_tip" style="float:right;margin-right:150px;" width="20" height="20" id="login_username_err" src="../images/tip_bulb.png" alt="Tip"/>

					</p>

					<p>

					<label for="login_password">Password</label><br />

					<input class="inputbox" id="login_password" name="login_password" type="text" tabindex="7" style="width:250px;" maxlength="30"/>
					&nbsp;<img class="err_tip" style="float:right;margin-right:150px;" width="20" height="20" id="login_password_err" src="../images/tip_bulb.png" alt="Tip"/>

					</p>
				
					<p>
					<button class="button" name="sign_in" id="Sign_in" tabindex="7">Sign in</button>
					<div class="error_block" id="signin_response" style="float:right;margin-right:50px;"> </div>
					</p>
					
					<p>
					<a id="cant_signin" href="javascript:void(0)">Can't Sign in?</a>
					</p>

				</div>	
				
				<!-- registration form starts-->
				
				<div id="registerform" class="entry" style="margin-left:40px;">			
					
					<div style="float:right;margin-right:30px;">
				
						<a id="signin_a" href="javascript:void(0)"><strong>Sign in.</strong></a>
				
					</div>
					<h3>Registration.</h3>

					<p>	

					<label for="name">First Name</label><br />

					<input class="inputbox" id="firstname" name="firstname" value="" type="text" tabindex="1" style="width:250px;" maxlength="50"/>
					&nbsp;<img class="err_tip" style="cursor:help;float:right;margin-right:150px;" title="Name must contain Alphabets only" width="20" height="20" id="firstname_err" src="../images/tip_bulb.png" alt="Tip"/>
					
					</p>	
					
					<p>	

					<label for="name">Last Name</label><br />

					<input class="inputbox" id="lastname" name="lastname" value="" type="text" tabindex="1" style="width:250px;" maxlength="50"/>
					&nbsp;<img class="err_tip" style="cursor:help;float:right;margin-right:150px;" title="Name must contain Alphabets only" width="20" height="20" id="lastname_err" src="../images/tip_bulb.png" alt="Tip"/>
					
					</p>			

					<p>

					<label for="emailid">Email id</label><br />
					
					<input class="inputbox" id="emailid" name="emailid" value="" type="text" tabindex="2" style="width:250px;"maxlength="50"/>
					&nbsp;<img class="err_tip" style="cursor:help;float:right;margin-right:150px;" width="20" height="20" id="emailid_err" src="../images/tip_bulb.png" alt="Tip"/>
					
					</p>	
						
					<p>
					
					<label for="phone">Phone number</label><br />

					<input class="inputbox" id="phone" name="phone" value="" type="text" tabindex="3" style="width:250px;" maxlength="11"/>
					&nbsp;<img class="err_tip" style="cursor:help;float:right;margin-right:150px;" width="20" height="20" id="phone_err" src="../images/tip_bulb.png" alt="Tip"/>

					</p>
					
					<p>	

					<label for="username">Username</label><br />

					<input class="inputbox" id="username" name="username" value="" type="text" tabindex="4" style="width:250px;" maxlength="30"/>
					&nbsp;<img class="err_tip" style="cursor:help;float:right;margin-right:150px;" width="20" height="20" id="username_err" src="../images/tip_bulb.png" alt="Tip"/>

					</p>			

					<p>

					<label for="password">Password</label><br />

					<input class="inputbox" id="password" name="password" value="" type="password" tabindex="5" style="width:250px;" maxlength="30"/>
					&nbsp;<img class="err_tip" title="valid characters - Alphabets, number, dot, underscore" style="cursor:help;float:right;margin-right:150px;" width="20" height="20" id="password_err" src="../images/tip_bulb.png" alt="Tip"/>

					</p>
					
					<p>

					<label for="repassword">Re enter password</label><br />

					<input class="inputbox" id="repassword" name="repassword" value="" type="password" tabindex="6" style="width:250px;" maxlength="30"/>
					&nbsp;<img class="err_tip" title="valid characters - Alphabets, number, dot, underscore, also should match the first password" style="cursor:help;float:right;margin-right:150px;" width="20" height="20" id="repassword_err" src="../images/tip_bulb.png" alt="Tip"/>

					</p>
				
					<p>
				
					<button class="button" id="register" name="register" value="Register" tabindex="7">Register</button>
					<div class="error_block" id="register_response" style="float:right;margin-right:50px;"> </div>
					
					</p>
				
				</div>
								
			</div>
				
		</div>			

	<!-- content end -->	
		