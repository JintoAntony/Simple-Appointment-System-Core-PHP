<?php
	include('notification.php');
	session_start();
	if ($_SESSION['login']==0)
		header('Location: index.php');
	else if($_SESSION['login']==1)
		header('Location: dBoardPatient.php');
?>

<html>
<head>
	<title>Healthcare System</title>
	<link rel="stylesheet" type="text/css" href="css/dboardCSS.css" />
		
	
</head>

<body>
	<!--div id = "profilePic">
		<img src = "sample.png" height = "200" width = "200"/>
	</div-->
	
	<!--div id = "topControls">
		<ul class = "main_menu_right">
			<form name='searchpatient' action='search_doctor.php' method='post'>
				<li> 
					Search by: 
					<select name="searchtype" id = "option">
						<option name="sickness">Sickness</option>
						<option name="name">Name</option>
						<option name="location">Location</option>
						<option name="age">Age</option>
					</select>
					<input type='text' name='searchinput' />
				</li>
			</form>
			<li> <a href = "notifications.php"> Notifications </a> </li>
			<li> <a href = "logout.php"> Log Out </a> </li>
		</ul>
	
	</div-->
	
	
	
	<div id = "menu_container">
		<div id="menu_wrapper">
			<ul class = "main_menu_left">
					<li> <a class="top_menu" href = "dboardDoctor.php"> Dashboard </a> </li>
					<li> <a class="top_menu" href = "doctor_profile.php"> &nbsp;&nbsp;&nbsp;&nbsp;Profile&nbsp;&nbsp;&nbsp;&nbsp; </a> </li>
					<li> <a class="top_menu" href = "appointments_doctor.php"> Appointment </a> </li>
					<li> <a class="top_menu" href = "viewpatients.php"> &nbsp;&nbsp;Patients&nbsp;&nbsp;</a> </li>
					
					<li> <a class="top_menu" href = "dboardDoctor.php"> &nbsp;&nbsp;Settings&nbsp;&nbsp;</a> </li>
			</ul>
			
			<ul class = "main_menu_right">
				<form name='searchpatient' action='search_doctor.php' method='post'>
					<li> 
						Search by: 
						<select name="searchtype" id = "option">
							<option name="sickness">Sickness</option>
							<option name="name">Name</option>
							<option name="location">Location</option>
							<option name="age">Age</option>
						</select>
						<input type='text' name='searchinput' />
					</li>
				</form>
				<li> <a id="notification" class="top_menu_right" href = "notifications.php"> Notifications </a> </li>
				<li> <a id="logout" class="top_menu_right" href = "logout.php"> Log Out </a> </li>
			</ul>
		</div>
	
	</div>
	
	<div class="banner-container">
		<div class="headbanner"></div>
	</div>
	
	
	
	<div class="main_wrapper">
		<div class="content_wrapper">
			<div class="content_main">
			<?php
				echo "Welcome ".$_SESSION["name"]  ;
				display_notification($_SESSION["username"]);
			?>
			</div>
		</div>
	</div>
	
	
	
	
	
</body>

</html>