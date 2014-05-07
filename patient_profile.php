<?php
	include('notification.php');
	session_start();
	if ($_SESSION['login']==0)
		header('Location: index.php');
	else if($_SESSION['login']==2)
		header('Location: dBoardDoctor.php');
?>

<html>
<head>
	<title>My Profile</title>
	<link rel="stylesheet" type="text/css" href="CSS/dboardCSS.css">
		
	
	
</head>

<script type="text/javascript">
		function editProfileP(){
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
				document.getElementById("edit_boxP").innerHTML=xmlhttp.responseText;
				}
			  }
			xmlhttp.open("GET","edit_patientProfile.php",true);
			xmlhttp.send();
			}
			
			function editUsernameP(){
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
				document.getElementById("edit_boxP").innerHTML=xmlhttp.responseText;
				}
			  }
			xmlhttp.open("GET","edit_patient_uname.php",true);
			xmlhttp.send();
			}
			
			function editPasswordP(){
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
				document.getElementById("edit_boxP").innerHTML=xmlhttp.responseText;
				}
			  }
			xmlhttp.open("GET","edit_patient_pword.php",true);
			xmlhttp.send();
			}
		</script>

<body>
	<div id = "menu_container">
			<div id="menu_wrapper">
				<ul class = "main_menu_left">
					<li><a class="top_menu" href = "dboardPatient.php">Dashboard</a></li>
					<li><a class="top_menu" href = "patient_profile.php">Profile</a></li>
					<li><a class="top_menu" href = "appointments_patient.php">Appointment</a></li>
					<!--li><a class="top_menu" href = "#">Settings</a></li-->
				</ul>
				
				<ul class = "main_menu_right">
					
						<li> 
							<form name='searchdoctor' action='search_patient.php' method='post'>
							Search by: 
							<select name="searchtype" id = "option">
								<option name="specialty">Specialty</option>
								<option name="name">Name</option>
								<option name="hospital">Hospital</option>
							</select>
							<input class='search_bar' type='text' name='searchinput'> </a>
							</form>
						</li>
					
					<!--li> <a id="notification" class="top_menu_right" href = "dboardPatient.php"> Notifications </a> </li-->
					<li> <a id="logout" class="top_menu_right" href = "logout.php"> Log Out </a> </li>
				</ul>
			</div>
		</div>
	
		<div class="content_wrapper">
			<div class="content_main">
		<?php
		
		//connecting to database
		//$conn = pg_connect('host=localhost dbname=healthcare user=postgres password=user');
		
		$conn=mysql_connect("localhost","root","root")or die("can not connect");
	    mysql_select_db("healthcare",$conn) or die("can not select database");
		
		$username=$_SESSION["username"];
		$resultCheck = mysql_query("select * from patient where patient_username = '".$username."';",$conn);

		$rows = mysql_num_rows($resultCheck);
		
		for($j=0; $j<$rows; $j++){
			$tuple = mysql_fetch_array($resultCheck);		 
			echo 'NAME: ', $tuple['patient_lname'],', ', $tuple['patient_fname'] ,' ', $tuple['patient_mname'], '<br />';	
			echo 'SICKNESS: ', $tuple['patient_sickness'], '<br />';	
			echo 'GENDER: ', $tuple['patient_gender'], '<br />';	
			echo 'ADDRESS: ', $tuple['patient_address'], '<br />';	
			echo 'AGE: ', $tuple['patient_age'], '<br />';	
			echo 'HEIGHT: ', $tuple['patient_height'], '<br />';	
			echo 'WEIGHT: ', $tuple['patient_weight'], '<br />';	
			echo 'BIRTHDATE: ', $tuple['patient_birthdate'], '<br />';	
			echo 'EMAIL ADDRESS:', $tuple['patient_eadd'], '<br />';	
			echo 'CONTACT NUMBER:', $tuple['patient_contactno'], '<br />';	
		}
		?>
		<br/>
		
		<form>
				<input type = "button" onclick="editProfileP()" value = "Edit Profile"/>
					
				<input type = "button" onclick="editUsernameP()" value = "Edit Username"/>
					
				<input type = "button" onclick="editPasswordP()" value = "Edit Password"/>
		</form>
		
		</div>
		
		<br/>
			<div id = "edit_boxP">
			
			</div>
		<br/>
		
	</div>
	
<body/>

</html>