<html>
	<head>
		<title>Editing Success</title>
		<link rel="stylesheet" type="text/css" href="CSS/dboardCSS.css">
	</head>

	<body>
<div id = "menu_container">
		<div id="menu_wrapper">
			<ul class = "main_menu_left">
					<li> <a class="top_menu" href = "dboardDoctor.php"> Dashboard </a> </li>
					<li> <a class="top_menu" href = "doctor_profile.php"> &nbsp;&nbsp;&nbsp;&nbsp;Profile&nbsp;&nbsp;&nbsp;&nbsp; </a> </li>
					<li> <a class="top_menu" href = "appointments_doctor.php"> Appointment </a> </li>
					<li> <a class="top_menu" href = "viewpatients.php"> &nbsp;&nbsp;Patients&nbsp;&nbsp;</a> </li>
					
			</ul>
			
			<ul class = "main_menu_right">
				<li> 
					<form name='searchpatient' action='search_doctor.php' method='post'>
					
						Search by: 
						<select name="searchtype" id = "option">
							<option name="sickness">Sickness</option>
							<option name="name">Name</option>
							<option name="location">Location</option>
							<option name="age">Age</option>
						</select>
						<input type='text' name='searchinput' />
						</form>
					</li>
				
				<li> <a id="logout" class="top_menu_right" href = "logout.php"> Log Out </a> </li>
			</ul>
		</div>
	</div>
	<div class="clearance"></div>
<div id = "main_wrapper">
		<div class="content_wrapper">
			<div class="content_main">
<?php
	session_start();
	
	$username=$_SESSION["username"];
	
	$lastname = $_POST['lname'];
	$firstname = $_POST['fname'];
	$middlename = $_POST['mname'];
	$specialization = $_POST['specialization'];
	$hospital = $_POST['hospital'];
	$contact = $_POST['cinfo'];
	$licenseinfo = $_POST['licenseno'];
	
	//$conn = pg_connect('host=localhost dbname=healthcare user=postgres password=user'); 

	$conn=mysql_connect("localhost","root","root")or die("can not connect");
	    mysql_select_db("healthcare",$conn) or die("can not select database");
		
	/*$query = "update doctor set (doctor_lname, doctor_fname, doctor_mname, doctor_specialization, doctor_hospital, contactno, doctor_licenseno) = 
					('{$lastname}','{$firstname}','{$middlename}','{$specialization}','{$hospital}','{$contact}','{$licenseinfo}')
				where doctor_username='{$username}'";*/
				
    $query = "update doctor set doctor_lname='$lastname', doctor_fname='$firstname', doctor_mname='$middlename', doctor_specialization='$specialization', 
	                       doctor_hospital='$hospital', contactno='$contact',doctor_licenseno='$licenseinfo' where doctor_username='$username'";		
	
	$result = mysql_query($query,$conn); 
	if (!$result) { 
		echo "Problem with query " . $query . "<br/>"; 
	//	echo pg_last_error(); 
		exit(); 
	} 
	else{
		
						echo "Your profile information was successfully edited.";
	}
	
	mysql_close($conn);
?>
</div>
</div>
</div>
</body>
</html>