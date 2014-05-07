
	<?php
		$role = $_POST['signup_option'];
		$uname= $_POST['uname'];
	    $pword= $_POST['pword'];
		$eadd= $_POST['eadd'];
		
		if($role=='doctor'){
				echo"
				<html>
				<head>
					<title>Sign Up - Doctor</title>
					<link rel='stylesheet' type='text/css' href='css/signup_doctor_css.css'/>
					<link rel='stylesheet' type='text/css' href='css/login_page.css' />
					
					<script type='text/javascript'>
						
						
						function sched_checker() {
						var counter = 0;
						var wday_from = document.getElementById('from_wday').value;
						var wday_to = document.getElementById('to_wday').value;
						document.getElementById('wday_label').innerHTML = '';
						if(wday_from == '') {
							if(wday_to != '') {
								document.getElementById('wday_label').innerHTML = '*Please fill this up properly';
								counter += 1;
							}
						}
						if(wday_to == '') {
							if(wday_from != '') {
								document.getElementById('wday_label').innerHTML = '*Please fill this up properly';
								counter += 1;
							}
						}
						
						var x = parseInt(wday_from);
						var y = parseInt(wday_to);
						if(x > y) {
							document.getElementById('wday_label').innerHTML = '*Please fill this up properly';
							counter += 1;
						}
												
						var sat_from = document.getElementById('from_sat').value;
						var sat_to = document.getElementById('to_sat').value;
						document.getElementById('sat_label').innerHTML = '';
						if(sat_from == '') {
							if(sat_to != '') {
								document.getElementById('sat_label').innerHTML = '*Please fill this up properly';
								counter += 1;
							}
						}
						if(sat_to == '') {
							if(sat_from != '') {
								document.getElementById('sat_label').innerHTML = '*Please fill this up properly';
								counter += 1;
							}
						}
						
						var x = parseInt(sat_from);
						var y = parseInt(sat_to);
						if(x > y) {
							document.getElementById('sat_label').innerHTML = '*Please fill this up properly';
							counter += 1;
						}
						
						var sun_from = document.getElementById('from_sun').value;
						var sun_to = document.getElementById('to_sun').value;
						document.getElementById('sun_label').innerHTML = '';
						if(sun_from == '') {
							if(sun_to != '') {
								document.getElementById('sun_label').innerHTML = '*Please fill this up properly';
								counter += 1;
							}
						}
						if(sun_to == '') {
							if(sun_from != '') {
								document.getElementById('sun_label').innerHTML = '*Please fill this up properly';
								counter += 1;
							}
						}
						
						var x = parseInt(sun_from);
						var y = parseInt(sun_to);
						if(x > y) {
							document.getElementById('sun_label').innerHTML = '*Please fill this up properly';
							counter += 1;
						}
						
						if(counter > 0) {
							return false;
						}
					}
						
						
						
					</script>
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
						<form action='process_signup_doctor.php' method='post'>
						<fieldset class='textbox'>
							
								<div class='username'>
									<div class='fieldname'>Username</div>
									<div class='holding'>
										<div class='sidetip'>Don't worry, you can change it later.</div>
										<input type='text' name='uname' value='$uname' required='required'/>
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
									<div class='fieldname'>E-mail Address</div>
									<div class='holding'>
										<div class='sidetip'>What’s your email address?</div>
										<input type='text' name='eadd' value='$eadd' required='required'/>
									</div>
								</div>
								<div class='name'>
									<div class='fieldname'>Name</div>
									<div class='holding'>
										<div class='sidetip'>Enter your last name.</div>
											<input class='fname' type='text' name='fname' placeholder='First Name' required='required'/>
										<div class='sidetip-lname'>Enter your first name.</div>
											<input class='mname'type='text' name='lname' placeholder='Last Name' required='required'/>
										<div class='sidetip-mname'>Enter your middle name.</div>
											<input class='mname' type='text' name='mname' placeholder='Middle Name'/>
									</div>
								</div>
								<div name='specializaton'>
									<div class='fieldname'>Specialization</div>
									<div class='holding'>
										<div class='sidetip'>Enter your specialization.</div>
										<input type='text' name='specialization' required='required' placeholder='Specialization'>
									</div>
								</div>
								<div class='hospital'>
									<div class='fieldname'>Hospital</div>
									<div class='holding'>
										<div class='sidetip'>Enter your designated hospital.</div>
										<input type='text' name='hospital' required='required' placeholder='Hospital'/>
									</div>
								</div>
								<div class='birthdate'>
									<div class='fieldname'>Birthdate</div>
									<div class='holding'>
										<div class='sidetip'>Enter your date of birth.</div>
										<input type='date' name='bdate' required='required' />
									</div>
								</div>
								<div class='contact'>
									<div class='fieldname'>Contact Information</div>
									<div class='holding'>
										<div class='sidetip'>What's your contact number?</div>
										<input type='text' name='cinfo' required='required'/>
									</div>
								</div>
								<div class='license'>
									<div class='fieldname'>License No</div>
									<div class='holding'>
										<div class='sidetip'>Enter your license number.</div>
										<input type='text' name='licenseno' required='required'/>
									</div>
								</div>";
						
						/*****Lhea's changes start here!*****/
					echo "<tr>
						<th>Work Schedule:</th>
						<td>
							Weekday<br/>
							From <select name='sched_from_wday' id='from_wday'>";
								$from_sched_array = array();
								array_push($from_sched_array, ' ');
								for($time_index=0;$time_index<24;$time_index++) {
									$time_str = $time_index . ":00";
									array_push($from_sched_array, $time_str);
								}

								for($i=0;$i<$time_index;$i++){
									echo '<option>' . $from_sched_array[$i] . '</option>';
								}
							echo "</select> To <select name='sched_to_wday' id='to_wday'>";
								$to_sched_array = array();
								array_push($to_sched_array, ' ');
								for($time_index=0;$time_index<24;$time_index++) {
									$time_str = $time_index . ":00";
									array_push($to_sched_array, $time_str);
								}

								for($i=0;$i<$time_index;$i++){
									echo '<option>' . $to_sched_array[$i] . '</option>';
								}
							echo "</select><p id='wday_label' style='color: #f00;'></p><br/>";
							
							echo "Saturday<br/>
							From <select name='sched_from_sat' id='from_sat'>";
								$from_sched_array = array();
								array_push($from_sched_array, ' ');
								for($time_index=0;$time_index<24;$time_index++) {
									$time_str = $time_index . ":00";
									array_push($from_sched_array, $time_str);
								}

								for($i=0;$i<$time_index;$i++){
									echo '<option>' . $from_sched_array[$i] . '</option>';
								}
							echo "</select> To <select name='sched_to_sat' id='to_sat'>";
								$to_sched_array = array();
								array_push($to_sched_array, ' ');
								for($time_index=0;$time_index<24;$time_index++) {
									$time_str = $time_index . ":00";
									array_push($to_sched_array, $time_str);
								}

								for($i=0;$i<$time_index;$i++){
									echo '<option>' . $to_sched_array[$i] . '</option>';
								}
							echo "</select><p id='sat_label' style='color: #f00;'></p><br/>";

							echo "Sunday<br/>
							From <select name='sched_from_sun' id='from_sun'>";
								$from_sched_array = array();
								array_push($from_sched_array, ' ');
								for($time_index=0;$time_index<24;$time_index++) {
									$time_str = $time_index . ":00";
									array_push($from_sched_array, $time_str);
								}

								for($i=0;$i<$time_index;$i++){
									echo '<option>' . $from_sched_array[$i] . '</option>';
								}
							echo "</select> To <select name='sched_to_sun' id='to_sun'>";
								$to_sched_array = array();
								array_push($to_sched_array, ' ');
								for($time_index=0;$time_index<24;$time_index++) {
									$time_str = $time_index . ":00";
									array_push($to_sched_array, $time_str);
								}

								for($i=0;$i<$time_index;$i++){
									echo '<option>' . $to_sched_array[$i] . '</option>';
								}
							echo "</select><p id='sun_label' style='color: #f00;'></p><br/>";
						echo "</td>
					</tr>";
					/*****Lhea's changes end here!*****/
					echo "</fieldset>
						<input id='submit_btn' type='submit' onclick='return sched_checker()'/>
						
						
					</form>
					</div>
				
				<!--Footer-->
				<div id='footer'></div>
				</div>
				</div>
				</body>
				<html>";
		}
		
		if($role=='patient'){
			echo"
					<html>
			<head>
			<title>Healthcare System</title>
			<link rel='stylesheet' type='text/css' href='signup_doctor_css.css'>
		     <link rel='stylesheet' type='text/css' href='css/login_page.css' />
	
			</head>
	
			<body>
			    <div class='front-bg'>
					<img class='front-image' src='img/white.jpg'/>
				</div>
				<div class='canvas'>
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