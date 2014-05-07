<?php
	session_start();
	if ($_SESSION['login']==0) header('Location: login_page.php');
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
		<div class="clearance"></div>
		<div class="content_wrapper">
			<div class="content_main">
			<?php
				
				//$conn = pg_connect('host=localhost dbname=healthcare user=postgres password=user');
				
				$conn=mysql_connect("localhost","root","root")or die("can not connect");
	            mysql_select_db("healthcare",$conn) or die("can not select database");
				
				$query = 'SELECT doctor_username, doctor_lname, doctor_fname, doctor_mname, doctor_specialization FROM doctor ORDER BY doctor_lname';

				$result = mysql_query($query,$conn);
				echo '<form action="request_page_date.php" method="post">
						<table class="table_doctors">
						<tr>
						    <th>Doctor</th>  
							<th>Name</th>
							<th>Specialization</th>
							<th>Request</th>
						</tr>';
					
				while ($row = mysql_fetch_array($result)) {
				
	
                /* Testing*/

                $doctor_names=$row['doctor_fname'].' '.$row['doctor_lname'];
				

                $a="doctor_img/" .$doctor_names.'.'."jpg"; 

				$doctor_user = $row['doctor_username'];
				
			//	echo $doctor_user;
				
				$doctor_special = $row['doctor_specialization'];
                /*       */				


	
					/*$count = count($row);
					$doctor_name = "";
					$doctor_special = "";
					for ($datacounter=0; $datacounter<$count; $datacounter++) {
						$c_row = current($row);
						if($datacounter==0) {
							/*Doctor's username*/
						//	$doctor_user = $row['doctor_username'];
					/*	}
						else {
							if ($datacounter == $count-1) {
								/*Doctor's specialization*/
								//$doctor_special = $row['doctor_specialization'];
						//	}
							//else {
								/*Doctor's name*/
						/*		$doctor_name = $c_row .' '.$doctor_name;
								if ($datacounter == 1) {
									$doctor_name = $doctor_name . "";
								}
							//	$doctor_name = $doctor_name . " ";
							}
						}
						next($row);
					}
					*/
					echo '<tr>
					
					        <td style="width: 85px;height:85px"><img src="'.$a.'" style="width:100%;height:100%;"></td>
							<td style="width: 250px">' . $doctor_names . '</td>
							<td style="width: 250px">' . $doctor_special . '</td>
							<td style="width: 250px"><center><input style="width: 100px" type="submit" name="doctor_user" value="'. $doctor_user .'"/></center></td>
						</tr>';
				}
				echo '</table></form>';
					
				mysql_close($conn);
			?>
			<form action="appointments_patient.php" method="post">
			<input type="submit" value="Cancel" />
		
			</form>
			
			
			
			
	<!--		<a href="appointments_patient.php">Cancel</a>  -->
			</div>
			</div>
		</div>
	</body>
</html>