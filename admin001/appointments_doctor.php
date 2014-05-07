<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">

<?php
	include('time_checker.php');
	session_start();
	if ($_SESSION['login']==0) header('Location: login_page.php');
?>

<html>
	<head>
		<title>Healthcare System</title>
		<link rel="stylesheet" type="text/css" href="css/dboardCSS.css">
	</head>
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
			<!--	<form name='searchpatient' action='search_doctor.php' method='post'>
					<li> 
						Search by: 
						<select name="searchtype" id = "option">
							<option name="sickness">Sickness</option>
							<option name="name">Name</option>
							<option name="location">Location</option>
						</select>
						<input type='text' name='searchinput' />
					</li>
				</form>  -->
				<li> <a id="notification" class="top_menu_right" href = "notifications.php"> Notifications </a> </li>
				<li> <a id="logout" class="top_menu_right" href = "logout.php"> Log Out </a> </li>
			</ul>
		</div>
	
	</div>
		
		
		<div class="clearance"></div>	
		<div id = "main_wrapper">
		
		<div class="content_wrapper">
			<div class="content_main">
			<?php
				//$conn = pg_connect('host=localhost dbname=healthcare user=postgres password=user');
				
				$conn=mysql_connect("localhost","root","root")or die("can not connect");
	            mysql_select_db("healthcare",$conn) or die("can not select database");
				
				$username = $_SESSION['username'];	
				
				//echo $username;
				
				$query = "SELECT app_doctorname, app_number, app_patientname, app_date, app_time, app_hospital, app_status FROM appointment WHERE app_doctorusername='$username' ";//ORDER BY app_number";

				$result = mysql_query($query,$conn);
				
				
				
				echo '<div class = "present_appointments">';
					echo "<b>Present Appointments</b>";
					echo '<table><tr>
							<tr>
								<th>App #</th>
								<th>Patient</th>
								<th>Date</th>
								<th>Time</th>
								<th>Hospital</th>
								<th>Status</th>
								<th>Manage</th>
							</tr>';

					$x = 1;
					
					while ($row = mysql_fetch_row($result))
					{	
					//echo "jinto";
					//echo $row['app_status'];
					
					if($row[6] == "Pending" || $row[6] == "Approved")
						{	echo '<tr>';							
							$count = count($row);
							for ($datacounter=0; $datacounter<$count; $datacounter++) 
							{
								$c_row = current($row);
								if($datacounter > 0)
								{
									echo '<td>' . $c_row . '</td>';
								}
								if($datacounter == 1) 
								{
									$tableID = $c_row;
								}
								if($datacounter == 6)
								{
									/*Checks if the request has been approved or still pending*/
									if($c_row == 'Pending')
									{
										$buttontoggler = 'P';
									}
									else 
									{
										$buttontoggler = 'A';
									}
								}
								next($row);
							}
								
							/*Buttons*/
							if($buttontoggler == 'P')
							{
								echo '<td><form action="approve_apprequest.php" method="post">
											<input type="hidden" name="approveid" value="' . $tableID . '">
											<input type="submit" value="Approve" onclick="return confirm(\'Approve appointment?\');"/>
										</form>
										<form action="cancel_apprequest.php" method="post">
											<input type="hidden" name="cancelid" value="' . $tableID . '">
											<input type="submit" value="Reject" onclick="return confirm(\'Reject appointment?\');"/>
										</form>
									</td></tr>';
							}
							else {
								echo '<td>
										<form action="cancel_apprequest.php" method="post">';
								/*Get time difference in minutes*/
								$timestamp_query = mysql_query("SELECT app_date, app_time FROM appointment WHERE app_number='$tableID'",$conn);
								$timestamp_array = mysql_fetch_array($timestamp_query);
								$time_difference = check_time($timestamp_array[0], $timestamp_array[1]);
								
								/*If the time_difference is more than 24 hours*/
								if($time_difference <= 1440) {
									echo '<button type="button" onclick="alert(\'Cannot cancel appointment!\');">Cancel</button>';
								}
								else {
									echo '<input type="hidden" name="cancelid" value="' . $tableID . '">
										<button type="submit" onclick="return confirm(\'Cancel appointment?\');">Cancel</button>';
								}
								
								echo '</form></td></tr>';
							}
						
						}
					}
					
					echo '</table>';
				echo '</div>';
				
				echo '<br/>';
				
				$query = "SELECT app_doctorname, app_number, app_patientname, app_date, app_time, app_hospital, app_status FROM appointment WHERE app_doctorusername='$username' ORDER BY app_number";
				$result = mysql_query($query,$conn);
			  
//-----------OLD APPOINTMETS................

			  echo '<div class = "old_appointments">';
					echo "<b>Old Appointments</b>";
					echo '<table><tr>
							<tr>
								<th>App #</th>
								<th>Patient</th>
								<th>Date</th>
								<th>Time</th>
								<th>Hospital</th>
								<th>Status</th>
							</tr>';

					$x = 1;
					while ($row = mysql_fetch_row($result)) {
						if($row[6] == "Old"){
							echo '<tr>';
							
							$count = count($row);
							for ($datacounter=0; $datacounter<$count; $datacounter++) {
								$c_row = current($row);
								if($datacounter > 0) {
									echo '<td>' . $c_row . '</td>';
								}
								if($datacounter == 1) {
									$tableID = $c_row;
								}
								if($datacounter == 6) {
									/*Checks if the request has been approved or still pending*/
									if($c_row == 'Pending') {
										$buttontoggler = 'P';
									}
									else {
										$buttontoggler = 'A';
									}
								}
								next($row);
							}
						}
					}
					
					echo '</table>';
				echo '</div>';
				
				mysql_close($conn);
			?>
		</div>
	</body>
</html>