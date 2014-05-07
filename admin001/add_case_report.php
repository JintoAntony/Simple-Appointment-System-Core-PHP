<?php session_start();
	$username=$_SESSION["username"];
	//$conn = pg_connect('host=localhost dbname=healthcare user=postgres password=user'); 
	$conn=mysql_connect("localhost","root","root")or die("can not connect");
	    mysql_select_db("healthcare",$conn) or die("can not select database");
	    $input = $_GET['id'];
		if(isset($input)){	
		$resultCheck = mysql_query("select * from patient where patient_username = '".$input."';",$conn);
	}
	$tuple = mysql_fetch_array($resultCheck);
	$patient_id=$tuple['patient_id'];	
	$patient_name=$tuple['patient_fname'].' '.$tuple['patient_mname'].' '.$tuple['patient_lname'];
	$_SESSION["p_id"]=$patient_id;
	


echo 
"<html>
    <head>
	
	<title>Healthcare System</title>
		<link rel='stylesheet' type='text/css' href='css/dboardCSS.css'>
		<link rel='stylesheet' type='text/css' href='css/style.css'>
		<link rel='stylesheet' type='text/css' href='css/signup_doctor_css.css'>
		
	
    </head>	
         <body>
		    <div id = 'menu_container'>
		    <div id='menu_wrapper'>
			<ul class ='main_menu_left'>
					<li> <a class='top_menu' href = 'dboardDoctor.php'> Dashboard </a> </li>
					<li> <a class='top_menu' href = 'doctor_profile.php'> &nbsp;&nbsp;&nbsp;&nbsp;Profile&nbsp;&nbsp;&nbsp;&nbsp; </a> </li>
					<li> <a class='top_menu' href = 'appointments_doctor.php'> Appointment </a> </li>
					<li> <a class='top_menu' href = 'viewpatients.php'> &nbsp;&nbsp;Patients&nbsp;&nbsp;</a> </li>
					<li> <a class='top_menu' href = 'current_appointments.php'> &nbsp;&nbsp;Present Appointments&nbsp;&nbsp;</a> </li>
			</ul>
			
			<ul class = 'main_menu_right'>
			
			<li> <a id='notification' class='top_menu_right' href = 'notifications.php'> Notifications </a> </li>
				<li> <a id='logout' class='top_menu_right' href = 'logout.php'> Log Out </a> </li>
			</ul>
		    </div>
	
	        </div>
			
			
			
			  <div class='canvas'>
					<div class='signup'>
					
						
						<div id='form-content'>
						<h1>
						Case Report
						</h1>
						<form action='process_casereport.php' method='post' enctype='multipart/form-data'>
						<fieldset class='textbox'>
							
								<div class='username'>
									<div class='fieldname'>Patient ID</div>
									<div class='holding'>
										<input type='text' name='userid' id='userid'  value='$patient_id' required='required'/>
									    </div>
								</div>
								
								<div class='password'>
									<div class='fieldname'>Patient Name</div>
									<div class='holding'>
										<input type='text' name='pname' id='pname' value='$patient_name' required='required'/>
									</div>
								</div>
								
								<div class='password'>
									<div class='fieldname'>Doctor Name</div>
									<div class='holding'>
										<input type='text' name='dname' id='dname' value='$username' required='required'/>
									</div>
								</div>
								
								<div class='password'>
									<div class='fieldname'>Sickness</div>
									<div class='holding'>
										<input type='text' name='sickness' id='sickness' placeholder='Sickness' required='required'/>
									</div>
								</div>
								
								
								<div class='birthdate'>
									<div class='fieldname'>Date</div>
									<div class='holding'>
									   <input type='date' name='bdate' id='bdate' required='required' />
									</div>
								</div>
								
								
								<div class='contact'>
									<div class='fieldname'>Case Report</div>
									<div class='holding'>
										<textarea name='report' id='report' cols='45' rows='7' required></textarea>
									</div>
								</div>
								
								<div class='holding'>									
									<input type='submit' name='submit' id='submit' value='Submit' class='vpb_general_button'>
									
									</div>
					
			            </form>		
					
	
             	</body>
        </html>";					



 ?>

		
				





			