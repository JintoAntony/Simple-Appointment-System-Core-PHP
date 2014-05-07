<?php
	//include('notification.php');
	session_start();
	if ($_SESSION['login']==0) header('Location: login_page.php');
	
	//$conn = pg_connect('host=localhost dbname=healthcare user=postgres password=user');	
	$conn=mysql_connect("localhost","root","root")or die("can not connect");
	mysql_select_db("healthcare",$conn) or die("can not select database");
	
	$doctor_id = $_POST['doctor_user'];
	//echo $doctor_id;
	//echo $_POST['app_time'];
	//echo $_POST['app_date'];
	$doctor_query = mysql_query("SELECT doctor_lname, doctor_fname, doctor_hospital FROM doctor WHERE doctor_username='$doctor_id'",$conn);
	$doctor_array = mysql_fetch_array($doctor_query);
	$doctor_name = $doctor_array[0] . ", " . $doctor_array[1];

	$max_appnumber = mysql_query("SELECT MAX(app_number) FROM appointment",$conn);
	$app_no = mysql_fetch_array($max_appnumber);
	$app_no[0] = $app_no[0] + 1;
	
	$username = $_SESSION['username'];
	$patient_query = mysql_query("SELECT patient_id,patient_lname, patient_fname, patient_mname FROM patient WHERE patient_username='$username'",$conn);
	$patient_array = mysql_fetch_array($patient_query);
	$patient_name = $patient_array[2] . " " . $patient_array[3] . " " . $patient_array[1];
	//echo $patient_name;
	//echo $patient_array[0];
	
	//-------------------------------Query Inserted-----------------------------------------------------------
    if(0)
    {}
	else
	{	
	$query = "INSERT INTO appointment (app_patient_id,app_number, app_patientname, app_doctorname, app_time, app_date, app_hospital, app_status, app_patientusername, app_doctorusername)
			VALUES ('{$patient_array[0]}','{$app_no[0]}', '{$patient_name}', '{$doctor_name}', '{$_POST['app_time']}', '{$_POST['app_date']}', '{$doctor_array[2]}', 'Approved', '{$username}', '{$doctor_id}')";
	$result = mysql_query($query,$conn);
    }
	mysql_close($conn);

	//send_notification($username, $doctor_id, 1);
	header('Location: appointments_patient.php');
?> 