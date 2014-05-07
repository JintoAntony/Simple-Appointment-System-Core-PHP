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
	
	//$conn = pg_connect('host=localhost dbname=healthcare user=postgres password=user'); 
	
	$conn=mysql_connect("localhost","root","root")or die("can not connect");
	mysql_select_db("healthcare",$conn) or die("can not select database");
	
	$username=$_SESSION["username"];
	$newuname=$_POST["newuname"];
	$olduname=$_POST["olduname"];
	$i=0;
	
	$checkUname = "select doctor_username from doctor where doctor_username='$newuname';";
		$resultCheck = mysql_query($checkUname,$conn);
		
	while($myrow = mysql_fetch_assoc($resultCheck)) {
			$i=$i+1;
	}
	
	if($newuname==$olduname) $i=0;
	
	if ($i>0){
		print '<script type="text/javascript">';
						echo "Username already exists.";

	}
	else{
		$query = "update doctor set doctor_username='$newuname' where doctor_username='$olduname';"; 
		$result = mysql_query($query,$conn); 
				if (!$result) { 
					echo "Problem with query " . $query . "<br/>"; 
					//echo mysql_last_error(); 
				//	exit(); 
				} 
				else{
					$_SESSION["username"]=$newuname;
					echo "Username successfully edited.";
					}

					
		$query1 = "update notification_system set receiver='$newuname' where receiver='$olduname';"; 
		$result1 = mysql_query($query1,$conn); 			
					
			if (!$result1) { 
					echo "Problem with query " . $query1 . "<br/>"; 
					//echo mysql_last_error(); 
					//exit();
					} 
					
					else{
					//$_SESSION["username"]=$newuname;
					echo "Reciever field successfully edited.";
					}
					
		$query2 = "update appointment set app_doctorusername='$newuname' where app_doctorusername='$olduname';"; 
		$result2 = mysql_query($query2,$conn); 			
					
			if (!$result2) { 
					echo "Problem with query " . $query2 . "<br/>"; 
					//echo mysql_last_error(); 
					//exit();
					} 
					
					else{
					//$_SESSION["username"]=$newuname;
					echo "Reciever field successfully edited.";
					}			
						
	}
	
	mysql_close($conn);
?>
</div>
</div>
</div>
</body>
</html>