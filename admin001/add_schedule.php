<?php
	session_start();
	if ($_SESSION['login']==0) header('Location: login_page.php');
	header('Location: doctor_profile.php');

	$username = $_SESSION['username'];
	/*****Lhea's changes start here!*****/
	/*Weekday*/
	$sched_from_wday = $_POST['sched_from_wday'];
	$sched_to_wday = $_POST['sched_to_wday'];
	$time_array_wday = array();
	$time_array_wday[0] = '';
	if($sched_from_wday != '' && $sched_to_wday != '') {
		$sched_diff = abs($sched_to_wday - $sched_from_wday);
		for($i=0; $i<=$sched_diff; $i++) {
			$sched_str = ($sched_from_wday + $i) . ':00,';
			$time_array_wday[0] = $time_array_wday[0] . $sched_str;
		}
	}
	/*Saturday*/
	$sched_str = '';
	$sched_from_sat = $_POST['sched_from_sat'];
	$sched_to_sat = $_POST['sched_to_sat'];
	$time_array_sat = array();
	$time_array_sat[0] = '';
	if($sched_from_sat != '' && $sched_to_sat != '') {
		$sched_diff = abs($sched_to_sat - $sched_from_sat);
		for($i=0; $i<=$sched_diff; $i++) {
			$sched_str = ($sched_from_sat + $i) . ':00,';
			$time_array_sat[0] = $time_array_sat[0] . $sched_str;
		}
	}
	/*Sunday*/
	$sched_str = '';
	$sched_from_sun = $_POST['sched_from_sun'];
	$sched_to_sun = $_POST['sched_to_sun'];
	$time_array_sun = array();
	$time_array_sun[0] = '';
	$sched_diff = abs($sched_to_sun - $sched_from_sun);
	$sched_diff = abs($sched_to_sun - $sched_from_sun);
	if($sched_from_sun != '' && $sched_to_sun != '') {
		for($i=0; $i<=$sched_diff; $i++) {
			$sched_str = ($sched_from_sun + $i) . ':00,';
			$time_array_sun[0] = $time_array_sun[0] . $sched_str;
		}
	}
	/*****Lhea's changes end here!*****/
	
	$conn = pg_connect('host=localhost dbname=healthcare user=postgres password=user');	

	$query = "UPDATE doctor SET doctor_sched_wday='". $time_array_wday[0] . "' WHERE doctor_username='$username'";
	$result = pg_query($query);
	$query = "UPDATE doctor SET doctor_sched_sat='". $time_array_sat[0] . "' WHERE doctor_username='$username'";
	$result = pg_query($query);
	$query = "UPDATE doctor SET doctor_sched_sun='". $time_array_sun[0] . "' WHERE doctor_username='$username'";	
	$result = pg_query($query);
	
	pg_close($conn);
?>