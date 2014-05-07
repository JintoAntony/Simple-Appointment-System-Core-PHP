<?php

	session_start();
	
	$username=$_SESSION["username"];
	
	//$conn = pg_connect('host=localhost dbname=healthcare user=postgres password=user'); 
	
	$conn=mysql_connect("localhost","root","root")or die("can not connect");
	    mysql_select_db("healthcare",$conn) or die("can not select database");
	
	$query="select doctor_lname, doctor_fname, doctor_mname, doctor_specialization, doctor_hospital, contactno, doctor_licenseno from doctor where doctor_username='{$username}';";
	$result = mysql_query($query,$conn); 

	$rows = mysql_num_rows($result);
	
/*	$lastname = $_POST['lname'];
	$firstname = $_POST['fname'];
	$middlename = $_POST['mname'];
	$specialization = $_POST['specialization'];
	$hospital = $_POST['hospital'];
	$contact = $_POST['contact'];
	$licenseinfo = $_POST['licenseinfo']; */
	
	for ($i=0; $i<$rows; $i++){
				$tuple = mysql_fetch_array($result);
				
				$lastname = $tuple['doctor_lname'];
				$firstname = $tuple['doctor_fname'];
				$middlename = $tuple['doctor_mname'];
				$specialization = $tuple['doctor_specialization'];
				$hospital = $tuple['doctor_hospital'];
				$contact = $tuple['contactno'];
				$licenseinfo = $tuple['doctor_licenseno'];
				
			/*	
				$tuple=pg_fetch_array($result);
				$fname=$tuple['patient_fname'];
				$mname=$tuple['patient_mname'];
				$lname=$tuple['patient_lname'];
				$sickness=$tuple['patient_sickness'];
				$age=$tuple['patient_age'];
				$birthdate=$tuple['patient_birthdate'];
				$gender=$tuple['patient_gender'];
				$height=$tuple['patient_height'];
				$weight=$tuple['patient_weight'];
				$status=$tuple['patient_status'];
				$address=$tuple['patient_address'];
				$contactno=$tuple['patient_contactno']; */
			}

	echo"
		<html>
		<head>
			<title>Edit Profile</title>
			<link rel='stylesheet' type='text/css' href='css/dboardCSS.css'/>
		</head>
		<body>
			<div class='canvas'>
				<div class='signup'>
					<!--Sign Up Form-->
					
					<div id='form-content'>
					<h1>
						Edit My Profile
					</h1>
					<form action='editprofile_process_doc.php' method='post'>
					<fieldset class='textbox'>
						
							<div class='name'>
								<div class='fieldname1'>Name</div>
								
								<div class='holding'>
									<div class='sidetip'>Enter your last name.</div>
										<input class='lname' type='text' name='lname' value='$lastname' required='required'/>
									<div class='sidetip'>Enter your first name.</div>
										<input class='fname'type='text' name='fname' value='$firstname' required='required'/>
									<div class='sidetip'>Enter your middle name.</div>
										<input class='mname' type='text' name='mname' value='$middlename' required='required'/>
								</div>
							</div>
							<div name='specializaton'>
								<div class='fieldname'>Specialization</div>
								<div class='holding'>
									<div class='sidetip'>Enter your specialization.</div>
									<input type='text' value='$specialization' name='specialization' required='required'>
								</div>
							</div>
							<div class='hospital'>
								<div class='fieldname'>Hospital</div>
								<div class='holding'>
									<div class='sidetip'>Enter your designated hospital.</div>
									<input type='text' value='$hospital' name='hospital' required='required'/>
								</div>
							</div>
							<div class='contact'>
								<div class='fieldname'>Contact Information</div>
								<div class='holding'>
									<div class='sidetip'>What's your contact number?</div>
									<input type='text' value='$contact' name='cinfo' required='required'/>
								</div>
							</div>
							<div class='license'>
								<div class='fieldname'>License No</div>
								<div class='holding'>
									<div class='sidetip'>Enter your license number.</div>
									<input type='text' value='$licenseinfo' name='licenseno' required='required'/>
								</div>
							</div>
						
					</fieldset>
						<input id='submit_btn' type='submit' value='Edit my profile.' />
					</form>
					</div>
				
					<!--Footer-->
					<div id='footer'></div>
					
				</div>
			</div>
		</body>
		<html>";
		
		mysql_close($conn);
?>
				
				