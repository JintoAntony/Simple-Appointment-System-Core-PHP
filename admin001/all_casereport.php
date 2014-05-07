<?php
	include('time_checker.php');
	session_start();
	if ($_SESSION['login']==0) header('Location: index.php');
?>

<html>
	<head>
		<title>Healthcare System</title>
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
					<li> <a class="top_menu" href = "current_appointments.php"> &nbsp;&nbsp;Present Appointments&nbsp;&nbsp;</a> </li>
			</ul>
			
			<ul class = "main_menu_right">
			<!--	<form name='searchpatient' action='search_doctor.php' method='post'>
					<li> 
						Search by: 
						<select name="searchtype" id = "option">
							<option name="sickness">Sickness</option>
							<option name="name">Name</option>
							<option name="location">Location</option>
						</select>
						<input type='text' name='searchinput' />
					</li>
				</form> -->
				<li> <a id="notification" class="top_menu_right" href = "notifications.php"> Notifications </a> </li>
				<li> <a id="logout" class="top_menu_right" href = "logout.php"> Log Out </a> </li>
			</ul>
		</div>
	
	</div>
	<div class="clearance"></div>	
	<div id = "main_wrapper">
		<div class="content_wrapper">
			<div class="content_main">
			
<?php
			//connecting to database
			//	$conn = pg_connect('host=localhost dbname=healthcare user=postgres password=user');						
			$input = $_GET["id"];                
				$conn=mysql_connect("localhost","root","root")or die("can not connect");
	            mysql_select_db("healthcare",$conn) or die("can not select database");
				
				if(isset($input)){	
		$resultCheck = mysql_query("select * from records where patient_id = '".$input."';",$conn);
	}	
	$rows = mysql_num_rows($resultCheck);
	if($rows)
	{	
	for($j=0; $j<$rows; $j++){
		$tuple = mysql_fetch_array($resultCheck);
		echo 'Case Report No.',$j+1,'<br />';
		echo 'Patient ID: ',$tuple['patient_id'] , '<br />';		
		echo 'Name of Patient: ',$tuple['patientname'] , '<br />';		
		echo 'Date of Visit: ', $tuple['dates'], '<br />';	
		echo '<a href = "show_casereport.php?id='.$tuple['patient_id'].'&&date='.$tuple['dates'].'">','Show Case Report',  '</a> <br />';
		echo '-------------------------------' , '<br />';
		}			
	}
	else
	{
	echo "No case report found.";
	}	
				
			?>
		</div>
	</div>
</body>
</html>