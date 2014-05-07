<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<html>
	<head>
		<title>Sign Up - Doctor</title>
		<link rel="stylesheet" type="text/css" href="signup_doctor_css.css"/>
	</head>
	<body>
		<div id="wrapper">
			<!--Sign Up Form-->
			<div id="form-content">
				<?php
				
				$uname= $_POST['uname'];
				$pword= $_POST['pword'];
				$eadd= $_POST['eadd'];
				
				echo"<form action='process_signup_doctor.php' method='post'>
				<table>
					<tr>
						<th>Username</th>
						<td><input type='text' name='uname' value='$uname' required='required'/></td>
					</tr>
					<tr>
						<th>Password</th>
						<td><input type='password' name='password' value='$pword' required='required'/></td>
					</tr>
					<tr>
						<th>E-mail Address</th>
						<td><input type='text' name='eadd' value='$eadd' required='required'/></td>
					</tr>
					<tr>
						<th>Name</th>
						<td><input type='text' name='lname' value='Last Name' required='required'/>
						<input type='text' name='fname' value='First Name' required='required'/>
						<input type='text' name='mname' value='Middle Name' required='required'/></td>
					</tr>
					<tr>
						<th>Specialization</th>
						<td><input type='text' name='specialization' required='required'></td>
					</tr>
					<tr>
						<th>Hospital</th>
						<td><input type='text' name='hospital' required='required'/></td>
					</tr>
					<tr>
						<th>Birthdate</th>
						<td><input type='date' name='bdate' required='required' /></td>
					</tr>
					<tr>
						<th>Contact Information</th>
						<td><input type='text' name='cinfo' required='required'/></td>
					</tr>
				</table>
					<input id='submit_btn' type='submit'/>
				</form>"
				?>
			</div>
			
			<!--Footer-->
			<div id="footer"></div>
		</div>
	</body>
<html>