<?php 
	session_start();
	$username=$_SESSION["username"];
	//$conn = pg_connect('host=localhost dbname=healthcare user=postgres password=user'); 
	$conn=mysql_connect("localhost","root","root")or die("can not connect");
	    mysql_select_db("healthcare",$conn) or die("can not select database");
	    $input = $_GET['id'];
		$input2= $_GET['date'];
		$_SESSION["p_id"]= $input;
		$_SESSION["date"]= $input2;		
/*		if(isset($input)){	
		$resultCheck = mysql_query("select * from patient where patient_username = '".$input."';",$conn);
	}
	$tuple = mysql_fetch_array($resultCheck);
	$patient_id=$tuple['patient_id'];	
	$patient_name=$tuple['patient_fname'].' '.$tuple['patient_mname'].' '.$tuple['patient_lname'];
	$_SESSION["p_id"]=$patient_id;
	echo $_SESSION["p_id"];	
	*/
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Add Case Report</title>
<link rel='stylesheet' type='text/css' href='css/signup_doctor_css.css'/>
<link rel='stylesheet' type='text/css' href='css/login_page.css' />
<link rel='stylesheet' type='text/css' href='css/dboardCSS.css'>
		<link rel='stylesheet' type='text/css' href='css/style.css'>
<!-- Required Header Files -->
<link type="text/css" href="css/vpb_uploader.css" rel="stylesheet" />
<script type="text/javascript" src="js/jquery_1.5.2.js"></script>
<script type="text/javascript" src="js/vpb_uploader.js"></script>
<script type="text/javascript">

$(document).ready(function()
{
	// Call the main function
	new vpb_multiple_file_uploader
	({
		vpb_form_id: "vasplus_form_id", // Form ID
		autoSubmit: false,
	vpb_server_url: "vpb_uploader.php" // PHP file for uploading the browsed files
	
		// To modify the design and display of the browsed file,
		// Open the file named js/vpb_uploader.js and search for the following: /* Display added files which are ready for upload */
		// You can modify the design and display of browsed files and also the CSS file as wish.
	});
});
</script>
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
				<li> <a id="notification" class="top_menu_right" href = "notifications.php"> Notifications </a> </li>
				<li> <a id="logout" class="top_menu_right" href = "logout.php"> Log Out </a> </li>
			</ul>
		</div>	
	</div>		   							   					   
							   <div class='contact'>
								<div class='fieldname'> Upload Photos </div>
<br clear="all" />
<!--<center><div style="font-family:Verdana, Geneva, sans-serif; font-size:24px;" align="center">Fancy Multiple File Upload using Ajax, Jquery and PHP</div></center>
-->
<!-- Browse and Submit Added Giles Area -->	
<center><div style="width:800px; margin-top:20px;" align="center">
<form name="vasplus_form_id" id="vasplus_form_id" action="javascript:void(0);" enctype="multipart/form-data">
<div style="width:300px;" align="center">
<div style="width:230px; float:left;" align="right">
<div class="vpb_browse_file_box"><input type="file" name="vasplus_multiple_files" id="vasplus_multiple_files" multiple="multiple" style="opacity:0;-moz-opacity:0;filter:alpha(opacity:0);z-index:9999;width:90px;padding:5px;cursor:default;" /></div>
</div>
<div style="width:70px; float:left;" align="left">
<input type="submit" value="Upload" class="vpb_general_button" />
</div><br clear="all">
</div>
</form>
</div></center>
<br clear="all" /><br clear="all" />
<!-- Uploaded Files Displayer Area -->	
<div id="vpb_added_files_box" class="vpb_file_upload_main_wrapper">
<div id="vpb_file_system_displayer_header"> 
<div id="vpb_header_file_names"><div style="width:365px; float:left;">File Names</div><div style="width:90px; float:left;">Status</div></div>
<div id="vpb_header_file_size">Size</div>
<div id="vpb_header_file_last_date_modified">Last Modified</div><br clear="all" />
</div>
<input type="hidden" id="added_class" value="vpb_blue">
<span id="vpb_removed_files"></span>
</div>
<p style="padding-bottom:5px;">&nbsp;</p>
</body>
</html>
