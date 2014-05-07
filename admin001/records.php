
<html>
<head>
	<title>Healthcare System</title>
	<link rel="stylesheet" type="text/css" href="css/dboardCSS.css" />
		
	
</head>

	<body>
	<div id = "menu_container">
		<div id="menu_wrapper">
			<ul class = "main_menu_left">
					<li> <a class="top_menu" href = "dboardDoctor.php"> Dashboard </a> </li>
					<li> <a class="top_menu" href = "doctor_profile.php"> &nbsp;&nbsp;&nbsp;&nbsp;Profile&nbsp;&nbsp;&nbsp;&nbsp; </a> </li>
					<li> <a class="top_menu" href = "appointments_doctor.php"> Appointment </a> </li>
					<li> <a class="top_menu" href = "viewpatients.php"> &nbsp;&nbsp;Patients&nbsp;&nbsp;</a> </li>
					
					<!--li> <a class="top_menu" href = "dboardDoctor.php"> &nbsp;&nbsp;Settings&nbsp;&nbsp;</a> </li-->
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
						<input class='search_bar' type='text' name='searchinput' />
					</form>
				</li>
				
				<!--li> <a id="notification" class="top_menu_right" href = "notifications.php"> Notifications </a> </li-->
				<li> <a id="logout" class="top_menu_right" href = "logout.php"> Log Out </a> </li>
			</ul>
		</div>
	
	</div>
	
	<div class="clearance"></div>
	
<div class="main_wrapper">
		<div class="content_wrapper">
<?php

	$input=$_POST['search'];
	//connecting to database
	//$conn = pg_connect('host=localhost dbname=healthcare user=postgres password=user');

	$conn=mysql_connect("localhost","root","root")or die("can not connect");
	mysql_select_db("healthcare",$conn) or die("can not select database");
	
	if(isset($input))
	{	
		$resultCheck = mysql_query("select * from patient where patient_id = '".$input."'  or patient_fname = '".$input."'  ;",$conn);
	}
	
	$rows = mysql_num_rows($resultCheck);
	
	echo '
		<h2 style="color:blue;"><u>Patient Details</u></h2>	
		 '; 
	
	for($j=0; $j<$rows; $j++){
		$tuple = mysql_fetch_array($resultCheck);
		echo 'PATIENT ID: ',$tuple['patient_id'] , '<br />';		
		echo 'NAME: ',$tuple['patient_fname'] ,' ', $tuple['patient_mname'],' ',$tuple['patient_lname'], '<br />';	
		echo 'SICKNESS: ', $tuple['patient_sickness'], '<br />';	
		echo 'GENDER: ', $tuple['patient_gender'], '<br />';	
		echo 'ADDRESS: ', $tuple['patient_address'], '<br />';	
		echo 'AGE: ', $tuple['patient_age'], '<br />';	
		echo 'HEIGHT: ', $tuple['patient_height'], '<br />';	
		echo 'WEIGHT: ', $tuple['patient_weight'], '<br />';	
		echo 'BIRTHDATE: ', $tuple['patient_birthdate'], '<br />';	
		echo 'EMAIL ADDRESS:', $tuple['patient_eadd'], '<br />';	
		echo 'CONTACT NUMBER:', $tuple['patient_contactno'], '<br /><br/>';	
	}

			
		echo '
		<h4 style="color:brown;"><u>Add or Display Case Report here.</u></h4>	
		 '; 
           echo '<a href = "add_case_report.php?id='.$tuple['patient_username'].'">','1.) Add Case Report',  '</a> <br />';
		   echo '<a href = "all_casereport.php?id='.$tuple['patient_id'].'">','2.) Show Case Report',  '</a> <br />';
		    

?>		   
		   
</div>
</div>

</body>

</html>