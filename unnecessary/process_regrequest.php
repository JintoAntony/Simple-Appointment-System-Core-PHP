<?php
	
	$conn = pg_connect('host=localhost dbname=healthcare user=postgres password=user');
		
	
	if( (isset($_GET['id'])) && (isset($_GET['action'])) ){
		if($_GET['action'] == "accept"){
			$query1="update doctor set (doctor_rstatus)=('approved') where doctor_username='{$_GET['id']}';";
			$result1 = pg_query($query1);
		}
		if($_GET['action'] == "delete"){
			$query2="delete from doctor where doctor_username='{$_GET['id']}';";
			$result2 = pg_query($query2);
		}
	}
		
	if( (isset($_GET['id2'])) && (isset($_GET['action2'])) ){
		if($_GET['action2'] == "accept"){
			$query3="update patient set (patient_rstatus)=('approved') where patient_username='{$_GET['id2']}';";
			$result3 = pg_query($query3);
		}
		if($_GET['action2'] == "delete"){
			$query4="delete from patient where patient_username='{$_GET['id2']}';";
			$result4 = pg_query($query4);
		}
	}
	pg_close($conn);
	header('Location: manage_regrequest.php');
?>