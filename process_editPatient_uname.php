<html>
	<head>
		<title>Healthcare System</title>
		<link rel="stylesheet" type="text/css" href="CSS/dboardCSS.css">

	</head>
	
<body>
<div id = "menu_container">
		<div id="menu_wrapper">
			<ul class = "main_menu_left">
					<li> <a class="top_menu" href = "dboardPatient.php"> Dashboard </a> </li>
					<li> <a class="top_menu" href = "patient_profile.php"> &nbsp;&nbsp;&nbsp;&nbsp;Profile&nbsp;&nbsp;&nbsp;&nbsp; </a> </li>
					<li> <a class="top_menu" href = "appointments_patient.php"> Appointment </a> </li>
					
			</ul>
			
			<ul class = "main_menu_right">
				<li> 
					<form name='searchpatient' action='search_doctor.php' method='post'>
					
						Search by: 
						<select name="searchtype" id = "option">
							<option name="specialty">Sickness</option>
							<option name="name">Name</option>
							<option name="hospital">Hospital</option>
						</select>
						<input class="searchbar"type='text' name='searchinput' />
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
	
	//$conn = pg_connect('host=localhost dbname=healthcare user=postgres password=user'); 
	
	$conn=mysql_connect("localhost","root","root")or die("can not connect");
	mysql_select_db("healthcare",$conn) or die("can not select database");
	
	
	$username=$_SESSION["username"];
	$newuname=$_POST["newusername"];
	$olduname=$_POST["oldusername"];
	$i=0;
	
	$checkUname = "select patient_username from patient where patient_username='$newuname'";
		$resultCheck = mysql_query($checkUname,$conn);
		
	while($myrow = mysql_fetch_assoc($resultCheck)) {
			$i=$i+1;
	}
	
	if($newuname==$olduname) $i=0;
	
	if ($i>0){
		print '<script type="text/javascript">';
				echo "Username already exists!";
	}
	else{
		$query = "update patient set patient_username='$newuname' where patient_username='$olduname'"; 
		$result = mysql_query($query,$conn); 
				if (!$result) { 
					echo "Problem with query " . $query . "<br/>"; 
				//	echo pg_last_error(); 
					exit(); 
				} 
				else{
					$_SESSION["username"]=$newuname;
					echo "Username successfully edited." ;
				}
	}
	mysql_close($conn);
?>
</div>
</div>
</div>
</body>
</html>