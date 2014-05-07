<html>
	<head>
		<title>Health Care System</title>
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
						</select>
						<input class="search_bar "type='text' name='searchinput' />
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
	$password=$_SESSION["password"];
	$old=md5($_POST["old-pass"]);
	$new=md5($_POST["new-pass"]);

	//$conn = pg_connect('host=localhost dbname=healthcare user=postgres password=user');
		
		
		$conn=mysql_connect("localhost","root","root")or die("can not connect");
	    mysql_select_db("healthcare",$conn) or die("can not select database");
		
		if ($old!=$password){
			print '<script type="text/javascript">';
						echo "You have entered an incorrect password.";
		}
		else{
			$query = "update doctor set doctor_password='$new' where doctor_username='$username';"; 
			$result = mysql_query($query,$conn); 
					if (!$result) { 
						echo "Problem with query " . $query . "<br/>"; 
						//echo pg_last_error(); 
						exit(); 
					} 
					else{
						$_SESSION["password"]=$new;
						echo "Password successfully edited.";
					}
		}

	mysql_close($conn);
?>
</div>
</div>
</div>
</body>
</html>