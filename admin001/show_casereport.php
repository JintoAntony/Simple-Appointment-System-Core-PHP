<?php
	include('time_checker.php');
	session_start();
	if ($_SESSION['login']==0) header('Location: index.php');
?>

<html>
	<head>
		<title>Healthcare System</title>
		<link rel="stylesheet" type="text/css" href="CSS/dboardCSS.css">

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
				</form> -->
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
			//connecting to database
			//	$conn = pg_connect('host=localhost dbname=healthcare user=postgres password=user');						
			$input = $_GET["id"];    
            $input2=$_GET["date"];
			
				$conn=mysql_connect("localhost","root","root")or die("can not connect");
	            mysql_select_db("healthcare",$conn) or die("can not select database");
				
				if(isset($input)){	
		$resultCheck = mysql_query("select * from records where patient_id = '".$input."' and dates='".$input2."';",$conn);
	}	
	$rows = mysql_num_rows($resultCheck);
	if($rows)
	{	
	for($j=0; $j<$rows; $j++){
		$tuple = mysql_fetch_array($resultCheck);		
		echo 'PATIENT ID: ',$tuple['patient_id'] , '<br />';		
		echo 'NAME: ',$tuple['patientname'] , '<br />';	
		echo 'SICKNESS: ', $tuple['sickness'], '<br />';	
		echo 'Date: ', $tuple['dates'], '<br />';	
		echo 'Doctor Name: ', $tuple['doctorname'], '<br />';
        echo 'Case Report: ', $tuple['casereport'], '<br />'; 		
		}
		echo '<a href = "add_images.php?id='.$tuple['patient_id'].'&&date='.$input2.'">',' Add images in Case Report',  '</a> <br />';
		
/* Display Images from the folder */

$images = "uploaded_files/".$tuple['patient_id'].'_'.$tuple['dates']."/"; # Location of small versions 

if(is_dir($images))     
{
$big    = "big/"; # Location of big versions (assumed to be a subdir of above) 
$cols   = 2; # Number of columns to display 
if ($handle = opendir($images))
 { while (false !== ($file = readdir($handle)))
   {       if ($file != "." && $file != ".." && $file != rtrim($big,"/"))
	   {   $files[] = $file; 
		   } } 
closedir($handle); } 
$colCtr = 0; 
echo '<h3 style="color:green";>Images releated with this patient ID</h3> ';
echo '<table width="25%" cellspacing="3" ><tr>'; 
foreach($files as $file) 
{  if($colCtr %$cols == 0) 
   echo '<tr><td ></td></tr><tr>'; 
   echo '<td align="center"><a href="'.$images.$file.'"><img src="'.$images.$file.'" style="width:50px"/></a></td>'; 
   $colCtr++; 
} 
echo '</table>' . "\r\n";
}




/*--------------------------------*/			
	}
	else
	{
	echo "No case report found.";
	}	
				
			?>
		</div>
	</div>
</body>
</html>