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
				}else if(opt.value == "Age" && isNaN(search.value)){
					alert('Please input an integer.');
				}else{
					form.submit();
				}
			}
		</script>
		<title> PATIENT's DIRECTORY </title>
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
			//inputs from the user
			$input = $_POST['searchinput'];
			$type = $_POST['searchtype'];

			//connecting to database
			$conn = pg_connect('host=localhost dbname=healthcare user=postgres password=user');
			
			//type names on the database is all on lower case so we need to set all the inputs to lower case.
			$sInput = str_ireplace(' ', '_', strtolower($input));
			$sType = str_ireplace(' ', '_', strtolower($type));
			
			if($sType == 'sickness'){
				$field = 'patient_sickness';
			}else if($sType == 'location'){
				$field = 'patient_address';
			}else if($sType == 'name'){
				$field = 'name';
			}	
			
			for($i=0; $i<15; $i++){
				//searching for column name
				if($field=='patient_sickness'){
					$resultCheck = pg_query($conn, "select * from patient where ".$field." like '".$sInput."%'");
					break;
				}else if($field=='patient_address'){
					$resultCheck = pg_query($conn, "select * from patient where ".$field." like '".$sInput."%'");
					break;
				}else if($field=='name'){
					$resultCheck = pg_query($conn, "select * from patient where patient_lname like '".$sInput."%' or patient_fname like '".$sInput."%'  or patient_mname like '".$sInput."%' ");
					break;
				}else{
					break;
				}
			}
					
			$rows = pg_num_rows($resultCheck);
			
			if($rows==0){
				echo "No ".$sInput." existing on ".$sType." list.";
			}else if($rows!=0){
				echo 'Found! <br />';
				for($j=0; $j<$rows; $j++){
					$tuple=pg_fetch_array($resultCheck);
					echo 'Name: ', $tuple['patient_fname'],' ', $tuple['patient_mname'] ,' ', $tuple['patient_lname'], '<br />';
					echo 'Sickness: ', $tuple['patient_sickness'], '<br />';
					echo 'Age: ', $tuple['patient_age'], '<br />';
					echo 'Location/Address: ', $tuple['patient_address'], '<br />';
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