<html>
	<head>
		<link rel="stylesheet" type="text/css" href="CSS/dboardCSS.css">
		<script language = "javascript">
		
			function clicked(){
				var search = document.getElementById("searchinput");
				var opt = document.getElementById("option");

				if(!search.value){
					alert('You have not entered any text in the search box, please enter again');
					search.focus(); //RESEEEEEEEEARCH
				}else{
					form.submit();
				}
			}
		</script>
		<title> DOCTOR's DIRECTORY </title>
	</head>
	<body>
	<div id = "menu_container">
		<div id="menu_wrapper">
			<ul class = "main_menu_left">
					<li><a class="top_menu" href = "dboardPatient.php">Dashboard</a></li>
					<li><a class="top_menu" href = "patient_profile.php">Profile</a></li>
					<li><a class="top_menu" href = "appointments_patient.php">Appointment</a></li>
					
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
				
				<li> <a id="logout" class="top_menu_right" href = "logout.php"> Log Out </a> </li>
			</ul>
		</div>
	</div>
	<div class="clearance"></div>
	<div id = "main_wrapper">
		<div class="content_wrapper">
			<div class="content_main">
		<?php
			//inputs from the user
			$input = $_POST['searchinput'];
			$type = $_POST['searchtype'];

			//connecting to database
			$conn = pg_connect('host=localhost dbname=healthcare user=postgres password=user');
			
			//type names on the databse is all on lower case so we need to set all the inputs to lower case.
			$sInput = str_ireplace(' ', '_', strtolower($input));
			$sType = str_ireplace(' ', '_', strtolower($type));
			
			if($sType == 'specialty'){
				$field = 'doctor_specialization';
			}else if($sType == 'hospital'){
				$field = 'doctor_hospital';
			}else if($sType == 'name'){
				$field = 'name';
			}		
			
			for($i=0; $i<10; $i++){
				//searching for column name
				if($field == 'doctor_specialization'){
					$resultCheck = pg_query($conn, "select * from doctor where ".$field." like '".$sInput."%' ");
					break;
				}else if($field == 'name'){
					$resultCheck = pg_query($conn, "select * from doctor where doctor_lname like '".$sInput."%' or doctor_fname like '".$sInput."%' or doctor_mname like '".$sInput."%'");
					break;
				}else if($field == 'doctor_hospital'){
					$resultCheck = pg_query($conn, "select * from doctor where ".$field." like '".$sInput."%' ");
					break;
				}else{
					break;
				}
			}
			
			$rows = pg_num_rows($resultCheck);
			
			if($rows==0){
				echo "No ".$sInput." existing on ".$sType." list.";
				//echo $field;
			}else if($rows!=0){
				echo 'Found! <br />';
				for($j=0; $j<$rows; $j++){
					$tuple=pg_fetch_array($resultCheck);
					echo 'Name: ', $tuple['doctor_fname'],' ', $tuple['doctor_mname'] ,' ', $tuple['doctor_lname'], '<br />';
					echo 'Specialization: ', $tuple['doctor_specialization'], '<br />';
					echo 'Location/Hospital: ', $tuple['doctor_hospital'], '<br />';
					echo '<br />';
				}
			}
					
			pg_close($conn);
		?>
		</div>
		</div>
		</div>
	</body>
</html>