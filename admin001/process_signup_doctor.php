<html>
	<head>
		<title>Health Care System</title>
		<link rel="stylesheet" type="text/css" href="CSS/dboardCSS.css">
	</head>

	<body>
<div id = "menu_container">
		<div id="menu_wrapper">
			<!--<ul class = "main_menu_left">
					<li> <a class="top_menu" href = "dboardDoctor.php"> Dashboard </a> </li>
					<li> <a class="top_menu" href = "doctor_profile.php"> &nbsp;&nbsp;&nbsp;&nbsp;Profile&nbsp;&nbsp;&nbsp;&nbsp; </a> </li>
					<li> <a class="top_menu" href = "appointments_doctor.php"> Appointment </a> </li>
					<li> <a class="top_menu" href = "viewpatients.php"> &nbsp;&nbsp;Patients&nbsp;&nbsp;</a> </li>
					
			</ul>
			-->
			<ul class = "main_menu_right">
				<!--<li> 
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
					</li>-->
				
				<li> <a id="logout" class="top_menu_right" href = "logout.php"> Return to Home </a> </li>
			</ul>
		</div>
	</div>
	<div class="clearance"></div>
<div id = "main_wrapper">
		<div class="content_wrapper">
			<div class="content_main">
<?php
	$doctor_username = $_POST['uname'];
	$rPassword = md5($_POST['password']);
	$rEadd = $_POST['eadd'];
	$rLname = $_POST['lname'];
	$rFname = $_POST['fname'];
	$rMname	= $_POST['mname'];
	$rSpecial = $_POST['specialization'];
	$rHospital = $_POST['hospital'];
	$rBdate = $_POST['bdate'];
	$rCinfo = $_POST['cinfo'];
	$rLicense = $_POST['licenseno'];
	$doctor_rstatus='approved';
	$a=0;
	$b=0;
	$ctr=0;
	
	//$doctor_username = str_ireplace(' ', '_', strtolower($rUname));
	/*$doctor_password = str_ireplace(' ', '_', strtolower($rPassword));
	$doctor_eadd = str_ireplace(' ', '_', strtolower($rEadd));
	$doctor_lname =$rLname; //str_ireplace(' ', '_', strtolower($rLname));
	$doctor_fname =$rFname; //str_ireplace(' ', '_', strtolower($rFname));
	$doctor_mname =$rMname; // str_ireplace(' ', '_', strtolower($rMname));
	$doctor_specialization = str_ireplace(' ', '_', strtolower($rSpecial));
	$doctor_hospital = str_ireplace(' ', '_', strtolower($rHospital));
	$doctor_bdate = str_ireplace(' ', '_', strtolower($rBdate));
	$doctor_cinfo = str_ireplace(' ', '_', strtolower($rCinfo));
	$licenseno = str_ireplace(' ', '_', strtolower($rLicense));*/
	
	
	
	$doctor_password = $rPassword;
	$doctor_eadd = $rEadd;
	$doctor_lname =$rLname; //str_ireplace(' ', '_', strtolower($rLname));
	$doctor_fname =$rFname; //str_ireplace(' ', '_', strtolower($rFname));
	$doctor_mname =$rMname; // str_ireplace(' ', '_', strtolower($rMname));
	$doctor_specialization = $rSpecial;
	$doctor_hospital =$rHospital;
	$doctor_bdate = $rBdate;
	$doctor_cinfo = $rCinfo;
	$licenseno = $rLicense;
	
	
	//$conn = pg_connect('host=localhost dbname=healthcare user=postgres password=user');
	
	$conn=mysql_connect("localhost","root","root")or die("can not connect");
	mysql_select_db("healthcare",$conn) or die("can not select database");
	
	$queryCount="select doctor_username from doctor;";
	$resultCount=mysql_query($queryCount,$conn);
	
	$queryCheck1 = "select doctor_username from doctor where doctor_username='{$doctor_username}';";
	$resultCheck1 = mysql_query($queryCheck1,$conn);
	
	$queryCheck2 = "select patient_username from patient where patient_username='{$doctor_username}';";
	$resultCheck2 = mysql_query($queryCheck2,$conn);
	
	while($myrow1 = mysql_fetch_assoc($resultCheck1)) {
			$a=$a+1;
	}
	while($myrow2 = mysql_fetch_assoc($resultCheck2)) {
			$a=$a+1;
	}
	
	/*****Lhea's changes start here!*****/
	/*Weekday*/
	$sched_from_wday = $_POST['sched_from_wday'];
	$sched_to_wday = $_POST['sched_to_wday'];
	$time_array_wday = array();
	$time_array_wday[0] = '';
	if($sched_from_wday != '' && $sched_to_wday != '') {
		$sched_diff = abs($sched_to_wday - $sched_from_wday);
		for($i=0; $i<=$sched_diff; $i++) {
			$sched_str = ($sched_from_wday + $i) . ':00,';
			$time_array_wday[0] = $time_array_wday[0] . $sched_str;
		}
	}
	/*Saturday*/
	$sched_str = '';
	$sched_from_sat = $_POST['sched_from_sat'];
	$sched_to_sat = $_POST['sched_to_sat'];
	$time_array_sat = array();
	$time_array_sat[0] = '';
	if($sched_from_sat != '' && $sched_to_sat != '') {
		$sched_diff = abs($sched_to_sat - $sched_from_sat);
		for($i=0; $i<=$sched_diff; $i++) {
			$sched_str = ($sched_from_sat + $i) . ':00,';
			$time_array_sat[0] = $time_array_sat[0] . $sched_str;
		}
	}
	/*Sunday*/
	$sched_str = '';
	$sched_from_sun = $_POST['sched_from_sun'];
	$sched_to_sun = $_POST['sched_to_sun'];
	$time_array_sun = array();
	$time_array_sun[0] = '';
	$sched_diff = abs($sched_to_sun - $sched_from_sun);
	$sched_diff = abs($sched_to_sun - $sched_from_sun);
	if($sched_from_sun != '' && $sched_to_sun != '') {
		for($i=0; $i<=$sched_diff; $i++) {
			$sched_str = ($sched_from_sun + $i) . ':00,';
			$time_array_sun[0] = $time_array_sun[0] . $sched_str;
		}
	}
	/*****Lhea's changes end here!*****/
	
	if ($a==0){
		$query = "insert into doctor (doctor_username, doctor_password, doctor_email, doctor_lname, doctor_fname, doctor_mname, doctor_specialization, doctor_hospital, contactno, doctor_licenseno, doctor_rstatus, doctor_sched_wday, doctor_sched_sat, doctor_sched_sun) values
			('{$doctor_username}','{$doctor_password}','{$doctor_eadd}','{$doctor_lname}','{$doctor_fname}','{$doctor_mname}','{$doctor_specialization}','{$doctor_hospital}','{$doctor_cinfo}','{$licenseno}','{$doctor_rstatus}','{$time_array_wday[0]}','{$time_array_sat[0]}','{$time_array_sun[0]}');";
			 
		$result = mysql_query($query,$conn); 
				if (!$result) { 
					echo "Problem with Insertion,try again " . $query . "<br/>"; 
//					echo pg_last_error(); 
					exit(); 
				} 
				else{
					echo "Doctor successfully added.<br/>";
				 
				}
			
	}
	else {

			echo "Username already exists.";
		
	}
	mysql_close($conn);	
	
?></div>
</div>
</div>

</body>
</html>