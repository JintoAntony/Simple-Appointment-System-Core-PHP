<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

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
	
	<script type="text/javascript">
		function editProfile(){
			var xmlhttp;
			if (window.XMLHttpRequest)
			  {// code for IE7+, Firefox, Chrome, Opera, Safari
			  xmlhttp=new XMLHttpRequest();
			  }
			else
			  {// code for IE6, IE5
			  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			  }
			xmlhttp.onreadystatechange=function()
			  {
			  if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
				document.getElementById("edit_box").innerHTML=xmlhttp.responseText;
				}
			  }
			xmlhttp.open("GET","edit_profile_doctor.php",true);
			xmlhttp.send();
			}
			
			function editUsername(){
			var xmlhttp;
			if (window.XMLHttpRequest)
			  {// code for IE7+, Firefox, Chrome, Opera, Safari
			  xmlhttp=new XMLHttpRequest();
			  }
			else
			  {// code for IE6, IE5
			  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			  }
			xmlhttp.onreadystatechange=function()
			  {
			  if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
				document.getElementById("edit_box").innerHTML=xmlhttp.responseText;
				}
			  }
			xmlhttp.open("GET","edit_username_doc.php",true);
			xmlhttp.send();
			}
			
			function editPassword(){
			var xmlhttp;
			if (window.XMLHttpRequest)
			  {// code for IE7+, Firefox, Chrome, Opera, Safari
			  xmlhttp=new XMLHttpRequest();
			  }
			else
			  {// code for IE6, IE5
			  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			  }
			xmlhttp.onreadystatechange=function()
			  {
			  if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
				document.getElementById("edit_box").innerHTML=xmlhttp.responseText;
				}
			  }
			xmlhttp.open("GET","edit_password_doc.php",true);
			xmlhttp.send();
			}
	
	</script>
	
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
				$username = $_SESSION["username"];

				//connecting to database
				//$conn = pg_connect('host=localhost dbname=healthcare user=postgres password=user');

				$conn=mysql_connect("localhost","root","root")or die("can not connect");
	            mysql_select_db("healthcare",$conn) or die("can not select database");
				
				$resultCheck = mysql_query("select * from doctor where doctor_username = '".$username."';",$conn);
					
				$rows = mysql_num_rows($resultCheck);
				
				for($j=0; $j<$rows; $j++){
					$tuple = mysql_fetch_array($resultCheck);		 
					echo 'NAME: ', $tuple['doctor_fname'],' ', $tuple['doctor_lname'] ,' ', '<br />';	
					echo 'SPECIALIZATION: ', $tuple['doctor_specialization'], '<br />';	
					echo 'HOSPITAL: ', $tuple['doctor_hospital'], '<br />';	
					/*Lhea's changes start here!*/
/*					
					echo 'WORK SCHEDULE:<table>';
					$counter = 0;
					for($i=0; $i<25 ;$i++) {
						echo '<tr>';
						
						for($j=0; $j<8; $j++) {
							echo '<td>';
							
							if($i == 0) {
								switch($j) {
									case 0:
										break;
									case 1:
										echo 'Monday';
										break;
									case 2:
										echo 'Tuesday';
										break;
									case 3:
										echo 'Wednesday';
										break;
									case 4:
										echo 'Thursday';
										break;
									case 5:
										echo 'Friday';
										break;
									case 6:
										echo 'Saturday';
										break;
									case 7:
										echo 'Sunday';
										break;
								}
							}
							else if($j == 0) {
								echo $counter . ':00';
								$counter += 1;
							}
							//Weekday
							else if ($j!=0 && $j<6) {
								$sched_query = mysql_query("SELECT doctor_sched_wday FROM doctor WHERE doctor_username='$username'",$conn);
								$sched_str = mysql_result($sched_query, 0);
								$sched_array = explode(",", $sched_str);
								$count = count($sched_array);
								for($k=0; $k<($count-1); $k++) {
									if($counter-1 == $sched_array[$k]) {
										echo '<p style="background-color:#0c0; color:#0c0;">.</p>';
									}
								}
							}
							//Saturday
							else if($j == 6) {
								$sched_query = mysql_query("SELECT doctor_sched_sat FROM doctor WHERE doctor_username='$username'",$conn);
								$sched_str = mysql_result($sched_query, 0);
								$sched_array = explode(",", $sched_str);
								$count = count($sched_array);
								for($k=0; $k<($count-1); $k++) {
									if($counter-1 == $sched_array[$k]) {
										echo '<p style="background-color:#0c0; color:#0c0;">.</p>';
									}
								}
							}
							//Sunday
							else if($j == 7) {
								$sched_query = mysql_query("SELECT doctor_sched_sun FROM doctor WHERE doctor_username='$username'",$conn);
								$sched_str = mysql_result($sched_query, 0);
								$sched_array = explode(",", $sched_str);
								$count = count($sched_array);
								for($k=0; $k<($count-1); $k++) {
									if($counter-1 == $sched_array[$k]) {
										echo '<p style="background-color:#0c0; color:#0c0;">.</p>';
									}
								}
							}
							
							echo '</td>';
						}
						
						echo '</tr>';
					}
					echo '</table><br/>';
					//Lhea's changes end here
					
					
					
					
					
					*/
					echo 'EMAIL ADDRESS:', $tuple['doctor_email'], '<br />';	
					echo 'CONTACT NUMBER:', $tuple['contactno'], '<br />';	
				}
			?>
			<!--<ul class = "edit_controls">
				<li><a href = "edit_profile_doctor.php">Edit Profile</a></li>
				<li><a href = "edit_username_doc.php">Edit Username</a></li>
				<li><a href = "edit_password_doc.php">Edit Password</a></li>
			</ul>-->
			<br/>
				
			<form>
				<input class = "button" type = "button" onclick="editProfile()" value = "Edit Profile"/>
					
				<input type = "button" onclick="editUsername()" value = "Edit Username"/>
					
				<input type = "button" onclick="editPassword()" value = "Edit Password"/>
			</form>
			<a href="edit_worksched_doc.php">Edit Work Schedule</a>
			
			
			</div>
			
			<br/>
			<div id = "edit_box">
			
			</div>
			<br/>
			
		</div>
		</div>
	</body>
</html>