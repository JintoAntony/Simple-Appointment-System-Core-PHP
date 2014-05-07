<?php	
	session_start();
	if ($_SESSION['login']==0) header('Location: login_page.php');
	header('Location: edit_schedule.php');

	$username = $_SESSION['username'];
	$sched_type = $_POST['sched_type'];
	
	$conn = pg_connect('host=localhost dbname=healthcare user=postgres password=user');	
		
	if($sched_type == "Saturday") {
		$query = "UPDATE doctor SET doctor_sched_sat='' WHERE doctor_username='$username'";
	}
	else if($sched_type == "Sunday") {
		$query = "UPDATE doctor SET doctor_sched_sun='' WHERE doctor_username='$username'";
	}
	else {
		$query = "UPDATE doctor SET doctor_sched_wday='' WHERE doctor_username='$username'";
	}
		
	$result = pg_query($query);
	
	pg_close($conn);
?>