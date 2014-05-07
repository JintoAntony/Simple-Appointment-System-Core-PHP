<?php 

		
		function accept_appointment($user){
			$conn = pg_connect('host=localhost dbname=healthcare user=postgres password=user');
			
			$result1 = pg_query($conn, "update app_status from appointment");
			// get help from marj :((((
			
			/**
			
				user(patient) -> change app_status based on user for that div
			
			 *
			 */
			
		}
		
		function delete_appointment(){
			
		}
		
		

?>

<html>

<title></title>
<head></head>

<body>

<?php   
	$conn = pg_connect('host=localhost dbname=healthcare user=postgres password=password');
			
		$result1 =  pg_query($conn, "select app_patientname from appointment");
		$patient = pg_fetch_all_columns($result1);
		
		
		
		echo $patient[0];
		// accept_appointment();
		
		
		
?>

</body>

</html>