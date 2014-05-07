<html>
	<head>
		<title>Edit Patient's Profile</title>
	</head>
	<body>
		<?php
			session_start();
			
			$username=$_SESSION["username"];
			
			//$conn = pg_connect('host=localhost dbname=healthcare user=postgres password=user'); 
			
			$conn=mysql_connect("localhost","root","root")or die("can not connect");
	        mysql_select_db("healthcare",$conn) or die("can not select database");
			
			$query="select patient_fname, patient_mname, patient_lname, patient_sickness, patient_age, patient_birthdate, patient_gender, patient_height, patient_weight, patient_status, patient_address, patient_contactno from patient where patient_username='{$username}';";
			$result = mysql_query($query,$conn); 
			
			$rows = mysql_num_rows($result);
			
			for ($i=0; $i<$rows; $i++){
				$tuple = mysql_fetch_array($result);
				$fname=$tuple['patient_fname'];
				$mname=$tuple['patient_mname'];
				$lname=$tuple['patient_lname'];
				$sickness=$tuple['patient_sickness'];
				$age=$tuple['patient_age'];
				$birthdate=$tuple['patient_birthdate'];
				$gender=$tuple['patient_gender'];
				$height=$tuple['patient_height'];
				$weight=$tuple['patient_weight'];
				$status=$tuple['patient_status'];
				$address=$tuple['patient_address'];
				$contactno=$tuple['patient_contactno'];
			}
			echo
			"<form action='process_editPatientProfile.php' method='post'>
				<table>
				<tr>
					<td> Name: </td>
					<td> <input type='text' name='fName' value='$fname' required='required'> </td>
					<td> <input type='text' name='mName' value='$mname' required='required'> </td>
					<td> <input type='text' name='lName' value='$lname' required='required'> </td>
				</tr>
				<tr>
					<td> Sickness: </td>
					<td> <input type='text' name='sickness' value='$sickness'> </td>
				</tr>
				<tr>
					<td> Age: </td>
					<td> <input type='text' name='age' value='$age'> </td>
				</tr>
				<tr>
					<td> Birthdate: </td>
					<td><input type='date' name='bdate' value='$birthdate' required='required' /></td>
				</tr>
				<tr>
					<td> Gender: </td>
					<td>
						<select name='gender' value='$gender'>
							<option value='male'>Male</option>
							<option value='female'>Female</option>
						</select>
					</td>
				</tr>
				<tr>
					<td> Height: </td>
					<td> <input type='text' name='height' value='$height' required='required'> </td>
				</tr>
				<tr>
					<td> Weight: </td>
					<td> <input type='text' name='weight' value='$weight' required='required'> </td>
				</tr>
				<tr>
					<td> Status: </td>
					<td><select name='status' value='$status'>
							<option value='single'>Single</option>
							<option value='married'>Married</option>
							<option value='widowed'>Widowed</option>
						</select>
					</td>
				</tr>
				<tr>
					<td> Address: </td>
					<td> <input type='text' name='address' value='$address' required='required'> </td>
				</tr>
				<tr>
				
				<tr>
					<td> Contact Information: </td>
					<td> <input type='text' name='contactNum' value='$contactno' required='required'> </td>
				</tr>
				</table>
				<input type='submit' name='submit'/>
				</form>";
			mysql_close($conn);
		?>
	</body>
</html>