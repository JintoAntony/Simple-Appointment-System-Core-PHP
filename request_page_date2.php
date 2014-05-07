<?php
session_start();
if ($_SESSION['login']==0) header('Location: login_page.php');
include('calender_function2.php');
$month=date("n")+1;
if($month=="13")
{$month=1;
$year=date("Y")+1;}
else
{$year=date("Y");}		
?>

<html>
	<head>
		<title>Healthcare System</title>
		<link rel="stylesheet" type="text/css" href="CSS/dboardCSS.css">
	    <link rel="stylesheet" type="text/css" href="CSS/calender_css.css">
	</head>
	<body>
		<!--div id = "profilePic">
			<img src = "sample.png" height = "200" width = "200"/>
		</div-->
		
		
		
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
			
			   //	$conn = pg_connect('host=localhost dbname=healthcare user=postgres password=user');
			    $conn=mysql_connect("localhost","root","root")or die("can not connect");
	            mysql_select_db("healthcare",$conn) or die("can not select database");
				
				/*Display doctor's name and specialization*/
				$doctor_user = $_SESSION['docuser'];
								
				$doctor_query = mysql_query("SELECT doctor_lname, doctor_fname, doctor_specialization,doctor_hospital
				                                 FROM doctor WHERE doctor_username='$doctor_user'",$conn);
				$doctor_result = mysql_fetch_array($doctor_query);
				echo "<br/><br/><br/>";				
				echo "Doctor Details";
				echo '<p>' .'Name:'. $doctor_result[1] . ' ' . $doctor_result[0] . ' <br/>' ;				
                echo 'Specialisation:'. $doctor_result[2] . ' <br/>' ;
                echo 'Hospital:'. $doctor_result[3] . ' <br/>' ;	
				echo "Please select date for Appointment";	

   				/*Display date picker and 'Add Time' button*/
	//			echo '<form action="request_page_time.php" method="post">
	//					<input type="date" name="app_date" value="' . date('Y-m-d') . '" min="' . date('Y-m-d') . '"/>
	//					<input type="hidden" name="doctor_user" value="' . $doctor_user . '"/>
	//					
	//					<input type="submit" value="Next"/>
	//				</form>';
	
	
	echo '	<form action="request_page_date.php" method="post">
			<input type="hidden" name="doctor_user" id="doctor_user" value="'. $doctor_user .'"/>
			<input type="submit" value="<--Previous"/>
			</form>
		 ';	
	
	
	
	
	
									
				echo draw_calendar($month,$year);	
				
				mysql_close($conn);
				
		
			?>
			<form action="request_patient.php" method="post">
			<input type="submit" value="Back"/>
			</form>
			
			
		<!--	<a href="request_patient.php">Cancel</a> -->
			
			
			</div>
		</div>
	</body>
</html>