
<html>
	<head>
		<title>HCS >> Admin Panel</title>
		<link rel="stylesheet" type="text/css" href="css/dboardCSS.css">
	</head>
	<body>

		<div id = "menu_container">
		<div id="menu_wrapper">
			
			
			<ul class = "main_menu_right">
				
				<!--li> <a id="notification" class="top_menu_right" href = "notifications.php"> Notifications </a> </li-->
				<li> <a id="logout" class="top_menu_right" href = "logout.php"> Log Out </a> </li>
			</ul>
		</div>
	
	</div>
		
		<div class="banner-container">
			<div class="headbanner"></div>
		</div>
			
		
		<div id = "main_wrapper">
		
		<div class="content_wrapper">
			<div class="content_main">
				<div class="clearance"></div>	
			<?php
				$i=0;
				$j=0;
				$action;
				
				$conn = pg_connect('host=localhost dbname=healthcare user=postgres password=user');
				
				$query1 = "select doctor_username, doctor_email, doctor_lname, doctor_fname, doctor_mname, doctor_licenseno, doctor_rstatus from doctor where doctor_rstatus='pending';"; 
				$result1 = pg_query($query1);
				
				$query2 = "select patient_username, patient_eadd, patient_lname, patient_fname, patient_mname, patient_rstatus from patient where patient_rstatus='pending';"; 
				$result2 = pg_query($query2);
				
				if (!$result1 || !$result2) { 
						echo "Problem with query " . $query1 . "<br/>"; 
						echo "Problem with query " . $query2 . "<br/>"; 
						echo pg_last_error(); 
						exit(); 
				}
				
				echo"<form action='process_regrequest.php' method='post'>";
				//echo "<center>";
				echo "<h1>REGISTRATION REQUESTS OF DOCTORS</h1>";
				echo "<table class='table_doctors' >";
				echo "<tr><td><b>Username</b></td><td><b>Email Add</b></td><td><b>Lastname</b></td><td><b>First Name</b></td><td><b>Middle Name</b></td><td><b>License No.</b></td><td span='2'><b>Action</b></td></tr>";
				while($myrow1 = pg_fetch_assoc($result1)){
					echo "<tr class='table_doctors_row'>";
					echo "<td>".htmlspecialchars($myrow1['doctor_username'])."</td>";
					echo "<td>".htmlspecialchars($myrow1['doctor_email'])."</td>";
					echo "<td>".htmlspecialchars($myrow1['doctor_lname'])."</td>";
					echo "<td>".htmlspecialchars($myrow1['doctor_fname'])."</td>";
					echo "<td>".htmlspecialchars($myrow1['doctor_mname'])."</td>";
					echo "<td>".htmlspecialchars($myrow1['doctor_licenseno'])."</td>";
					echo "<td><a href='process_regrequest.php?id={$myrow1['doctor_username']}&action=accept'><img src='check.jpg' alt='accept'></a>";
					echo "<a href='process_regrequest.php?id={$myrow1['doctor_username']}&action=delete'>&nbsp;&nbsp;&nbsp;<img src='cross.jpg' alt='delete'></a></td>";
				}
				echo"</table>";
				echo "<h1>REGISTRATION REQUESTS OF PATIENTS</h1>";
				echo "<table class='table_patients'>";
				echo "<tr class='table_patients_row'><td><b>Username</b></td><td><b>Email Add</b></td><td><b>Lastname</b></td><td><b>First Name</b></td><td><b>Middle Name</b></td><td span='2'><b>Action</b></td></tr>";
				while($myrow2 = pg_fetch_assoc($result2)){
					echo "<tr>";
					echo "<td>".htmlspecialchars($myrow2['patient_username'])."</td>";
					echo "<td>".htmlspecialchars($myrow2['patient_eadd'])."</td>";
					echo "<td>".htmlspecialchars($myrow2['patient_lname'])."</td>";
					echo "<td>".htmlspecialchars($myrow2['patient_fname'])."</td>";
					echo "<td>".htmlspecialchars($myrow2['patient_mname'])."</td>";
					echo "<td><a href='process_regrequest.php?id2={$myrow2['patient_username']}&action2=accept'><img src='check.jpg' alt='accept'></a>";
					echo "<a href='process_regrequest.php?id2={$myrow2['patient_username']}&action2=delete'>&nbsp;&nbsp;&nbsp;<img src='cross.jpg' alt='delete'></a></td>";
				}
				//echo"</center>";
				echo"</form>";
				
				pg_close($conn);
			?>
				</div>
			</div>
		</body>
</html>