
	<?php
	
	
	
	
	
	
		$role = $_POST['signup_option'];
		$uname= $_POST['uname'];
	    $pword= $_POST['pword'];
		$eadd= $_POST['eadd'];
		
		if($role=='patient'){
				echo"
				<html>
				<head>
					<title>Sign Up - Doctor</title>
					<link rel='stylesheet' type='text/css' href='css/signup_doctor_css.css'/>
					<link rel='stylesheet' type='text/css' href='css/login_page.css' />
					
					
				</head>
				<body>
				
				  <div class='front-bg'>
					<img class='front-image' src='img/white.jpg'/>
				</div>
				
					<div class='canvas'>
					<div class='signup'>
						<!--Sign Up Form-->
						
						<div id='form-content'>
						<h1>
						<li > Doctor Sign Up Form</li>
						</h1>
					
						<form action='process_signup_patient.php' method='post'>
								
								<fieldset class='textbox'>		
				<div class='username'>
					<div class='fieldname'>Username</div>
					<div class='holding'>
						<div class='sidetip'>Don't worry, you can change it later.</div>
							<input type='text' name='username' value='$uname' required='required'>
					</div>
				</div>
				
				<div class='password'>
					<div class='fieldname'>Password</div>
					<div class='holding'>
						<div class='sidetip'>6 characters or more! Be tricky.</div>
							<input type='password' name='password' value='$pword' required='required'/>
					</div>
				</div>
				<div class='email'>
					<div class='fieldname'>Email Address</div>
					<div class='holding'>
						<div class='sidetip'>What’s your email address?</div>
						<input type='text' name='eadd' value='$eadd' required='required' /> 
					</div>
				</div>
				<div class='name'>
					<div class='fieldname'>Name</div>
					<div class='holding'>
                      					
					<div class='sidetip'>Enter your First name.</div>
							<input class='mname' type='text' name='fName' placeholder='First name' required='required'>
				    <div class='sidetip-lname'>Enter your first name.</div>
							<input class='mname' type='text' name='lName' placeholder='Last name' required='required'>
				    <div class='sidetip-mname'>Enter your middle name.</div>
							<input class='mname' type='text' name='mName' placeholder='Middle name'> 
					</div>
				</div>
				<div name='sickness'>
					<div class='fieldname'>Sickness</div>
					<div class='holding'>
						<div class='sidetip'>What made you sick?</div>
							<input type='text' name='sickness' value=''>
					</div>
				</div>
				<div name='age'>
					<div class='fieldname'>Age</div>
					<div class='holding'>
						<div class='sidetip'>How old are you?</div>
							<input type='text' name='age' value='' />
					</div>
				</div>
				<div class='birthdate'>
					<div class='fieldname'>Birthdate</div>
						<div class='holding'>
							<div class='sidetip'>What is your birthdate?</div>
								<input type='date' name='bdate' required='required' />
						</div>
				</div>
				<div class='gender'>
					<div class='fieldname'>Gender</div>
						<div class='holding'>
							<div class='sidetip'>Are you a he or a she?</div>
							<select name='gender'>
								<option value='male'>Male</option>
								<option value='female'>Female</option>
							</select>
						</div>
				</div>
				<div class='height'>
					<div class='fieldname'>Height</div>
					<div class='holding'>
						<div class='sidetip'>How tall are you? (In cm.)</div>
						<input type='text' name='height' value='' required='required' />
					</div>
				</div>
				<div class='weight'>
					<div class='fieldname'>Weight</div>
					<div class='holding'>
						<div class='sidetip'>How heavy are you? (In kg.)</div>
						<input type='text' name='weight' value='' required='required'> 
					</div>
				</div>
				<div class='weight'>
					<div class='fieldname'>Status</div>
					<div class='holding'>
						<div class='sidetip'>What is your civil status?</div>
						<select name='status'>
							<option value='single'>Single</option>
							<option value='married'>Married</option>
							<option value='widowed'>Widowed</option>
						</select>
					</div>
				</div>
				<div class='address'>
					<div class='fieldname'>Address</div>
					<div class='holding'>
						<div class='sidetip'>Where do you live?</div>
						<input type='text' name='address' value='' required='required'/>
					</div>
				</div>
				
				
				<div class='contact'>
					<div class='fieldname'>Contact Information</div>
					<div class='holding'>
						<div class='sidetip'>What is your contact number?</div>
						<input type='text' name='contactNum' value='' required='required' />
					</div>
				</div>
				<input id='submit_btn'type='submit' name='submit' value='Create my account.'/> </td>
			</fieldset>
							</form>
						
						
					    </div>
				
				<!--Footer-->
				<div id='footer'></div>
				</div>
				</div>
				</body>
				<html>";
		}
		
		if($role=='doctor'){
			echo "
					<html>
			<head>
			<title>Healthcare System</title>
			<link rel='stylesheet' type='text/css' href='signup_doctor_css.css'>
		     <link rel='stylesheet' type='text/css' href='css/login_page.css' />
	
	        
	
			</head>
	
			<body>
			    
					
			
				<div class='canvas' style='background:url(img/white.jpg);width:100%;height:100% '>
					<div class='signup'>
						<div id = 'userInfo'>
							<h1>
								Sign up Patient
							</h1>
							<form action='process_signup_patient.php' method='post'>
								
								<fieldset class='textbox'>		
				<div class='username'>
					<div class='fieldname'>Username</div>
					<div class='holding'>
						<div class='sidetip'>Don't worry, you can change it later.</div>
							<input type='text' name='username' value='$uname' required='required'>
					</div>
				</div>
				
				<div class='password'>
					<div class='fieldname'>Password</div>
					<div class='holding'>
						<div class='sidetip'>6 characters or more! Be tricky.</div>
							<input type='password' name='password' value='$pword' required='required'/>
					</div>
				</div>
				<div class='email'>
					<div class='fieldname'>Email Address</div>
					<div class='holding'>
						<div class='sidetip'>What’s your email address?</div>
						<input type='text' name='eadd' value='$eadd' required='required' /> 
					</div>
				</div>
				<div class='name'>
					<div class='fieldname'>Name</div>
					<div class='holding'>
						<div class='sidetip'>Enter your last name.</div>
							<input class='lname' type='text' name='lName' value='Last name' required='required'>
						<div class='sidetip-lname'>Enter your first name.</div>
							<input class='fname' type='text' name='fName' value='First name' required='required'> 
						<div class='sidetip-mname'>Enter your middle name.</div>
							<input class='mname' type='text' name='mName' value='Middle name' required='required'> 
						
					</div>
				</div>
				<div name='sickness'>
					<div class='fieldname'>Sickness</div>
					<div class='holding'>
						<div class='sidetip'>What made you sick?</div>
							<input type='text' name='sickness' value=''>
					</div>
				</div>
				<div name='age'>
					<div class='fieldname'>Age</div>
					<div class='holding'>
						<div class='sidetip'>How old are you?</div>
							<input type='text' name='age' value='' />
					</div>
				</div>
				<div class='birthdate'>
					<div class='fieldname'>Birthdate</div>
						<div class='holding'>
							<div class='sidetip'>What is your birthdate?</div>
								<input type='date' name='bdate' required='required' />
						</div>
				</div>
				<div class='gender'>
					<div class='fieldname'>Gender</div>
						<div class='holding'>
							<div class='sidetip'>Are you a he or a she?</div>
							<select name='gender'>
								<option value='male'>Male</option>
								<option value='female'>Female</option>
							</select>
						</div>
				</div>
				<div class='height'>
					<div class='fieldname'>Height</div>
					<div class='holding'>
						<div class='sidetip'>How tall are you? (In cm.)</div>
						<input type='text' name='height' value='' required='required' />
					</div>
				</div>
				<div class='weight'>
					<div class='fieldname'>Weight</div>
					<div class='holding'>
						<div class='sidetip'>How heavy are you? (In kg.)</div>
						<input type='text' name='weight' value='' required='required'> 
					</div>
				</div>
				<div class='weight'>
					<div class='fieldname'>Status</div>
					<div class='holding'>
						<div class='sidetip'>What is your civil status?</div>
						<select name='status'>
							<option value='single'>Single</option>
							<option value='married'>Married</option>
							<option value='widowed'>Widowed</option>
						</select>
					</div>
				</div>
				<div class='address'>
					<div class='fieldname'>Address</div>
					<div class='holding'>
						<div class='sidetip'>Where do you live?</div>
						<input type='text' name='address' value='' required='required'/>
					</div>
				</div>
				
				
				<div class='contact'>
					<div class='fieldname'>Contact Information</div>
					<div class='holding'>
						<div class='sidetip'>What is your contact number?</div>
						<input type='text' name='contactNum' value='' required='required' />
					</div>
				</div>
				<input id='submit_btn'type='submit' name='submit' value='Create my account.'/> </td>
			</fieldset>
							</form>
						</div>
					</div>
				</div>
		</body>


</html>
		
		
			
			";
		}
	?>