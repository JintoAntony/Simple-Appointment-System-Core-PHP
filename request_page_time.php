<?php
session_start();
	if ($_SESSION['login']==0) header('Location: login_page.php');	
//$conn = pg_connect('host=localhost dbname=healthcare user=postgres password=user');
				$conn=mysql_connect("localhost","root","root")or die("can not connect");
	            mysql_select_db("healthcare",$conn) or die("can not select database");
				
				/*Display doctor's name and specialization*/						
				$doctor_user = $_GET['doctor_user'];				
				//echo $doctor_user;				
				$doctor_query = mysql_query("SELECT doctor_lname, doctor_fname, doctor_mname, doctor_specialization FROM doctor WHERE doctor_username='$doctor_user'",$conn);
				$doctor_result = mysql_fetch_array($doctor_query);
			    //echo '<p>' . $doctor_result[0] . ', ' . $doctor_result[1] . ' ' . $doctor_result[2] .'<br/>(' . $doctor_result[3] . ')</p>';					
				/*Display selected date and its equivalent day of the week*/
				$app_date = $_GET['app_date'];		
								
				$app_dweek = date('l', strtotime($app_date));
		//		echo '<p>' . $app_date . ' (' . $app_dweek . ')</p>';					
				if($app_dweek == "Saturday") {
					$sched_query = mysql_query("SELECT doctor_sched_sat FROM doctor WHERE doctor_username='$doctor_user'",$conn);
				}
				else if($app_dweek == "Sunday") {
					$sched_query = mysql_query("SELECT doctor_sched_sun FROM doctor WHERE doctor_username='$doctor_user'",$conn);
				}
				else {
					$sched_query = mysql_query("SELECT doctor_sched_wday FROM doctor WHERE doctor_username='$doctor_user'",$conn);
				}
				$sched_str = mysql_result($sched_query, 0);
				$sched_array = explode(",", $sched_str);
				/*---------------------------------------------------------------- */
				//Disply array
				/*for($i=0; $i<count($sched_array)-1; $i++) 
				{	echo $sched_array[$i]."\r\n";	
				}
				echo "---------";*/
				$a=array();				
				$i=0;
				/* Query to select Appointment Details */
				$app_query = mysql_query("SELECT app_doctorusername,app_date,app_time FROM appointment WHERE app_doctorusername='$doctor_user' and app_date='$app_date' ",$conn);
				while($app_result = mysql_fetch_array($app_query))
					{
                        //echo $app_result['app_time'];
						$a[$i]=$app_result['app_time'];
						//	echo $a[$i]."\r\n";
						$i++;
					} 	    
					for($i=0;$i<count($sched_array);$i++)
                    {
	                   for($j=0;$j<count($a);$j++)
		                  {					  
						  if($sched_array[$i]==$a[$j])
							       {
				                      //echo $b[$j];
					                  array_splice($sched_array,$i,1);
					                  //var_dump($b);
				                   }
		                  }
                    }		          				
		//		for($j=0;$j<count($sched_array);$j++)
        //      {echo $sched_array[$j]."\r\n";}		
/*-------------------------------------------------------------------*/  
                $doctor_query = mysql_query("SELECT doctor_lname, doctor_fname, doctor_specialization,doctor_hospital
				FROM doctor WHERE doctor_username='$doctor_user'",$conn);
				$doctor_result = mysql_fetch_array($doctor_query);
				echo "<br/><br/><br/>";				
				echo "Doctor Details";				
				echo '<p>' .'Name:'. $doctor_result[1] . ' ' . $doctor_result[0] . ' <br/>' ;				
                echo 'Specialisation:'. $doctor_result[2] . ' <br/>' ;
                echo 'Hospital:'. $doctor_result[3] . ' <br/>' ;				
/*----------------------------------------------------------------------*/			
				/*If the doctor doesn't have a work schedule for the specified date, disable appointment scheduling*/
				if(count($sched_array) == 1) {
					echo '<p>Scheduling an appointment for this day is currently unavailable. Please pick another date.</p>';
				}
				/*Else, display time picker*/
				
				mysql_close($conn);	
	
?>

<html>
<head>
		<title>Healthcare System</title>
		<link rel="stylesheet" type="text/css" href="CSS/dboardCSS.css">
</head>
<body>
<!--div id = "profilePic">
			<img src = "sample.png" height = "200" width = "200"/>
		</div-->
		
<div id = "menu_container">
			<div id="menu_wrapper">
				<ul class = "main_menu_left">
					<li><a class="top_menu" href = "dboardPatient.php">Dashboard</a></li>
					<li><a class="top_menu" href = "patient_profile.php">Profile</a></li>
					<li><a class="top_menu" href = "appointments_patient.php">Appointment</a></li>
					<!--li><a class="top_menu" href = "#">Settings</a></li-->
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
					
					<!--li> <a id="notification" class="top_menu_right" href = "dboardPatient.php"> Notifications </a> </li-->
					<li> <a id="logout" class="top_menu_right" href = "logout.php"> Log Out </a> </li>
				</ul>
			</div>
		</div>




<form action="send_apprequest.php" method="post">


<table width="100%" cellpadding="5" cellspacing="0" color="#ccc" style="font-family:Lucida Sans Unicode, Lucida Grande, sans-serif; font-size:14px;" border="1">
       <tr>
         <td style="text-align:center; width=25% bgcolor=#F7F7F7" >Morning</td>
         <td style="text-align:center; width=25% bgcolor=#F7F7F7"><p>Afternoon</p></td>
         <td style="text-align:center; width=25% bgcolor=#F7F7F7"><p>Evening</p></td>
         <td style="text-align:center; width=25% bgcolor=#F7F7F7" ><p>Night</p></td>
       </tr>
	   
<tr>
<!----------------------------------------------->
<td>	   
<table width="100%" cellpadding="5" cellspacing="0" style="font-family:Lucida Sans Unicode, Lucida Grande, sans-serif; font-size:14px;" >	   
  <tr> 
	<tr>

<?php
$set=0;	
$time1="8:00AM";
for($i=0;$i<count($sched_array);$i++)
{    if($time1 == $sched_array[$i])
	 {echo'  <td style="color:green; text-align:left;width=50%"> <input type="radio" name="app_time" id="app_time" value="8:00AM"  > 8.00AM </td>';
	 $set=$set+1;}
}
if($set==0)
{echo'<td style="color:red; text-align:left;width=50% "> <input type="radio" name="app_time" id="app_time"  disabled ><strike> 8.00AM </td>';}
?>

<?php
$set=0;	
$time1="8:30AM";
for($i=0;$i<count($sched_array);$i++)
{    if($time1 == $sched_array[$i])
	 {echo'  <td style="color:green; text-align:left;width=50%"> <input type="radio" name="app_time" id="app_time"  value="8:30AM"> 8.30AM </td>';
	 $set=$set+1;}
}
if($set==0)
{echo'<td style="color:red; text-align:left;width=50%"> <input type="radio" name="app_time" id="app_time" disabled ><strike> 8.30AM </td>';}
?>	  
  </tr>
<tr> 
<?php
$set=0;	
$time1="9:00AM";
for($i=0;$i<count($sched_array);$i++)
{    if($time1 == $sched_array[$i])
	 {echo'  <td style="color:green; text-align:left;width=50%"> <input type="radio" name="app_time" id="app_time" value="9:00AM"> 9.00AM </td>';
	 $set=$set+1;}
}
if($set==0)
{echo'<td style="color:red; text-align:left;width=50%"> <input type="radio" name="app_time" id="app_time" disabled ><strike> 9.00AM </td>';}
?>  
<?php
$set=0;	
$time1="9:30AM";
for($i=0;$i<count($sched_array);$i++)
{    if($time1 == $sched_array[$i])
	 {echo'  <td style="color:green; text-align:left;width=50%"> <input type="radio" name="app_time" id="app_time" value="9:30AM"> 9.30AM </td>';
	 $set=$set+1;}
}
if($set==0)
{echo'<td style="color:red; text-align:left;width=50%"> <input type="radio" name="app_time" id="app_time" disabled ><strike> 9.30AM </td>';}
?>	 
</tr>
<tr> 
<?php
$set=0;	
$time1="10:00AM";
for($i=0;$i<count($sched_array);$i++)
{    if($time1 == $sched_array[$i])
	 {echo'  <td style="color:green; text-align:left;width=50%"> <input type="radio" name="app_time" id="app_time" value="10:00AM"> 10.00AM </td>';
	 $set=$set+1;}
}
if($set==0)
{echo'<td style="color:red; text-align:left;width=50%"> <input type="radio" name="app_time" id="app_time" disabled ><strike> 10.00AM </td>';}
?>		  
<?php
$set=0;	
$time1="10:30AM";
for($i=0;$i<count($sched_array);$i++)
{    if($time1 == $sched_array[$i])
	 {echo'  <td style="color:green; text-align:left;width=50%"> <input type="radio" name="app_time" id="app_time" value="10:30AM"> 10.30AM </td>';
	 $set=$set+1;}
}
if($set==0)
{echo'<td style="color:red; text-align:left;width=50%"> <input type="radio" name="app_time" id="app_time" disabled ><strike> 10.30AM </td>';}
?>		  
	  
</tr>

<tr> 
	  
<?php
$set=0;	
$time1="11:00AM";
for($i=0;$i<count($sched_array);$i++)
{    if($time1 == $sched_array[$i])
	 {echo'  <td style="color:green; text-align:left;width=50%"> <input type="radio" name="app_time" id="app_time" value="11:00AM"> 11.00AM </td>';
	 $set=$set+1;}
}
if($set==0)
{echo'<td style="color:red; text-align:left;width=50%"> <input type="radio" name="app_time" id="app_time" disabled ><strike> 11.00AM </td>';}
?>		  
	  
<?php
$set=0;	
$time1="11:30AM";
for($i=0;$i<count($sched_array);$i++)
{    if($time1 == $sched_array[$i])
	 {echo'  <td style="color:green; text-align:left;width=50%"> <input type="radio" name="app_time" id="app_time" value="11:30AM"> 11.30AM </td>';
	 $set=$set+1;}
}
if($set==0)
{echo'<td style="color:red; text-align:left;width=50%"> <input type="radio" name="app_time" id="app_time" disabled ><strike> 11.30AM </td>';}
?>	
	  
</tr>
  
</tr>
  
</table>
</td>
<!----------------------------------------------->
<td>	   
<table width="100%" cellpadding="5" cellspacing="0" style="font-family:Lucida Sans Unicode, Lucida Grande, sans-serif; font-size:14px;">	   
  <tr> 
	<tr>
	   
	   <?php
         $set=0;	
         $time1="12:00PM";
         for($i=0;$i<count($sched_array);$i++)
           {    if($time1 == $sched_array[$i])
	        {    echo'  <td style="color:green; text-align:left;width=50%"> <input type="radio" name="app_time" id="app_time" value="12:00PM"> 12.00PM </td>';
	            $set=$set+1;}
            }
         if($set==0)
         {echo'<td style="color:red; text-align:left;width=50%"> <input type="radio" name="app_time" id="app_time" disabled ><strike> 12.00PM </td>';}
       ?>	
	   
	  
	   <?php
         $set=0;	
         $time1="12:30PM";
         for($i=0;$i<count($sched_array);$i++)
           {    if($time1 == $sched_array[$i])
	        {    echo'  <td style="color:green; text-align:left;width=50%"> <input type="radio" name="app_time" id="app_time" value="12:30PM"> 12.30PM </td>';
	            $set=$set+1;}
            }
         if($set==0)
         {echo'<td style="color:red; text-align:left;width=50%"> <input type="radio" name="app_time" id="app_time" disabled ><strike> 12.30PM </td>';}
       ?>	
	  
	</tr>
	
	<tr> 
	   
	   <?php
         $set=0;	
         $time1="1:00PM";
         for($i=0;$i<count($sched_array);$i++)
           {    if($time1 == $sched_array[$i])
	        {    echo'  <td style="color:green; text-align:left;width=50%"> <input type="radio" name="app_time" id="app_time" value="1:00PM"> 1.00PM </td>';
	            $set=$set+1;}
            }
         if($set==0)
         {echo'<td style="color:red; text-align:left;width=50%"> <input type="radio" name="app_time" id="app_time" disabled ><strike> 1.00PM </td>';}
       ?>	
	   
	   <?php
         $set=0;	
         $time1="1:30PM";
         for($i=0;$i<count($sched_array);$i++)
           {    if($time1 == $sched_array[$i])
	        {    echo'  <td style="color:green; text-align:left;width=50%"> <input type="radio" name="app_time" id="app_time" value="1:30PM"> 1.30PM </td>';
	            $set=$set+1;}
            }
         if($set==0)
         {echo'<td style="color:red; text-align:left;width=50%"> <input type="radio" name="app_time" id="app_time" disabled ><strike> 1.30PM </td>';}
       ?>	
	   
	</tr>
	
	<tr> 
	   
	   <?php
         $set=0;	
         $time1="2:00PM";
         for($i=0;$i<count($sched_array);$i++)
           {    if($time1 == $sched_array[$i])
	        {    echo'  <td style="color:green; text-align:left;width=50%"> <input type="radio" name="app_time" id="app_time" value="2:00PM"> 2.00PM </td>';
	            $set=$set+1;}
            }
         if($set==0)
         {echo'<td style="color:red; text-align:left;width=50%"> <input type="radio" name="app_time" id="app_time" disabled ><strike> 2.00PM </td>';}
       ?>	
	   
	   <?php
         $set=0;	
         $time1="2:30PM";
         for($i=0;$i<count($sched_array);$i++)
           {    if($time1 == $sched_array[$i])
	        {    echo'  <td style="color:green; text-align:left;width=50%"> <input type="radio" name="app_time" id="app_time" value="2:30PM"> 2.30PM </td>';
	            $set=$set+1;}
            }
         if($set==0)
         {echo'<td style="color:red; text-align:left;width=50%"> <input type="radio" name="app_time" id="app_time" disabled ><strike> 2.30PM </td>';}
       ?>	
	   
	</tr>
	
	<tr> 
	   
	   <?php
         $set=0;	
         $time1="3:00PM";
         for($i=0;$i<count($sched_array);$i++)
           {    if($time1 == $sched_array[$i])
	        {    echo'  <td style="color:green; text-align:left;width=50%"> <input type="radio" name="app_time" id="app_time" value="3:00PM"> 3.00PM </td>';
	            $set=$set+1;}
            }
         if($set==0)
         {echo'<td style="color:red; text-align:left;width=50%"> <input type="radio" name="app_time" id="app_time" disabled ><strike> 3.00PM </td>';}
       ?>	
	   
	   <?php
         $set=0;	
         $time1="3:30PM";
         for($i=0;$i<count($sched_array);$i++)
           {    if($time1 == $sched_array[$i])
	        {    echo'  <td style="color:green; text-align:left;width=50%"> <input type="radio" name="app_time" id="app_time" value="3:30PM"> 3.30PM </td>';
	            $set=$set+1;}
            }
         if($set==0)
         {echo'<td style="color:red; text-align:left;width=50%"> <input type="radio" name="app_time" id="app_time" disabled ><strike> 3.30PM </td>';}
       ?>	
	   
	</tr>
  </tr>
</table>
</td>

<!----------------------------------------------->

<td>	   
<table width="100%" cellpadding="5" cellspacing="0" style="font-family:Lucida Sans Unicode, Lucida Grande, sans-serif; font-size:14px;">	   
  
  <tr> 
	
	<tr>
	  
	  <?php
         $set=0;	
         $time1="4:00PM";
         for($i=0;$i<count($sched_array);$i++)
           {    if($time1 == $sched_array[$i])
	        {    echo'  <td style="color:green; text-align:left;width=50%"> <input type="radio" name="app_time" id="app_time" value="4:00PM"> 4.00PM </td>';
	            $set=$set+1;}
            }
         if($set==0)
         {echo'<td style="color:red; text-align:left;width=50%"> <input type="radio" name="app_time" id="app_time" disabled ><strike> 4.00PM </td>';}
       ?>	
	  
	   <?php
         $set=0;	
         $time1="4:30PM";
         for($i=0;$i<count($sched_array);$i++)
           {    if($time1 == $sched_array[$i])
	        {    echo'  <td style="color:green; text-align:left;width=50%"> <input type="radio" name="app_time" id="app_time" value="4:30PM"> 4.30PM </td>';
	            $set=$set+1;}
            }
         if($set==0)
         {echo'<td style="color:red; text-align:left;width=50%"> <input type="radio" name="app_time" id="app_time" disabled ><strike> 4.30PM </td>';}
       ?>	
	  
	</tr>
	
	<tr> 
	  
	  <?php
         $set=0;	
         $time1="5:00PM";
         for($i=0;$i<count($sched_array);$i++)
           {    if($time1 == $sched_array[$i])
	        {    echo'  <td style="color:green; text-align:left;width=50%"> <input type="radio" name="app_time" id="app_time" value="5:00PM"> 5.00PM </td>';
	            $set=$set+1;}
            }
         if($set==0)
         {echo'<td style="color:red; text-align:left;width=50%"> <input type="radio" name="app_time" id="app_time" disabled ><strike> 5.00PM </td>';}
       ?>	
	  
	  <?php
         $set=0;	
         $time1="5:30PM";
         for($i=0;$i<count($sched_array);$i++)
           {    if($time1 == $sched_array[$i])
	        {    echo'  <td style="color:green; text-align:left;width=50%"> <input type="radio" name="app_time" id="app_time" value="5:30PM"> 5.30PM </td>';
	            $set=$set+1;}
            }
         if($set==0)
         {echo'<td style="color:red; text-align:left;width=50%"> <input type="radio" name="app_time" id="app_time" disabled ><strike> 5.30PM </td>';}
       ?>	
	
	</tr>
	
	<tr> 
	  
	  <?php
         $set=0;	
         $time1="6:00PM";
         for($i=0;$i<count($sched_array);$i++)
           {    if($time1 == $sched_array[$i])
	        {    echo'  <td style="color:green; text-align:left;width=50%"> <input type="radio" name="app_time" id="app_time" value="6:00PM"> 6.00PM </td>';
	            $set=$set+1;}
            }
         if($set==0)
         {echo'<td style="color:red; text-align:left;width=50%"> <input type="radio" name="app_time" id="app_time" disabled ><strike> 6.00PM </td>';}
       ?>	
	  
	   <?php
         $set=0;	
         $time1="6:30PM";
         for($i=0;$i<count($sched_array);$i++)
           {    if($time1 == $sched_array[$i])
	        {    echo'  <td style="color:green; text-align:left;width=50%"> <input type="radio" name="app_time" id="app_time" value="6:30PM"> 6.30PM </td>';
	            $set=$set+1;}
            }
         if($set==0)
         {echo'<td style="color:red; text-align:left;width=50%"> <input type="radio" name="app_time" id="app_time" disabled ><strike> 6.30PM </td>';}
       ?>	
	
	</tr>
	
	<tr>
      
	  <?php
         $set=0;	
         $time1="7:00PM";
         for($i=0;$i<count($sched_array);$i++)
           {    if($time1 == $sched_array[$i])
	        {    echo'  <td style="color:green; text-align:left;width=50%"> <input type="radio" name="app_time" id="app_time" value="7:00PM"> 7.00PM </td>';
	            $set=$set+1;}
            }
         if($set==0)
         {echo'<td style="color:red; text-align:left;width=50%"> <input type="radio" name="app_time" id="app_time" disabled ><strike> 7.00PM </td>';}
       ?>	
	  
	  <?php
         $set=0;	
         $time1="7:30PM";
         for($i=0;$i<count($sched_array);$i++)
           {    if($time1 == $sched_array[$i])
	        {    echo'  <td style="color:green; text-align:left;width=50%"> <input type="radio" name="app_time" id="app_time" value="7:30PM"> 7.30PM </td>';
	            $set=$set+1;}
            }
         if($set==0)
         {echo'<td style="color:red; text-align:left;width=50%"> <input type="radio" name="app_time" id="app_time" disabled ><strike> 7.30PM </td>';}
       ?>	
	
	</tr>
  </tr>
</table>
</td>

<!----------------------------------------------->

<td>	   
<table width="100%" cellpadding="5" cellspacing="0" style="font-family:Lucida Sans Unicode, Lucida Grande, sans-serif; font-size:14px;">	   
  
  <tr> 
	<tr>
	   
	   <?php
         $set=0;	
         $time1="8:00PM";
         for($i=0;$i<count($sched_array);$i++)
           {    if($time1 == $sched_array[$i])
	        {    echo'  <td style="color:green; text-align:left;width=50%"> <input type="radio" name="app_time" id="app_time" value="8:00PM"> 8.00PM </td>';
	            $set=$set+1;}
            }
         if($set==0)
         {echo'<td style="color:red; text-align:left;width=50%"> <input type="radio" name="app_time" id="app_time" disabled ><strike> 8.00PM </td>';}
       ?>	
	   
	   <?php
         $set=0;	
         $time1="8:30PM";
         for($i=0;$i<count($sched_array);$i++)
           {    if($time1 == $sched_array[$i])
	        {    echo'  <td style="color:green; text-align:left;width=50%"> <input type="radio" name="app_time" id="app_time" value="8:30PM"> 8.30PM </td>';
	            $set=$set+1;}
            }
         if($set==0)
         {echo'<td style="color:red; text-align:left;width=50%"> <input type="radio" name="app_time" id="app_time" disabled ><strike> 8.30PM </td>';}
       ?>	
	
	</tr>
	<tr> 
	   
	   <?php
         $set=0;	
         $time1="9:00PM";
         for($i=0;$i<count($sched_array);$i++)
           {    if($time1 == $sched_array[$i])
	        {    echo'  <td style="color:green; text-align:left;width=50%"> <input type="radio" name="app_time" id="app_time" value="9:00PM"> 9.00PM </td>';
	            $set=$set+1;}
            }
         if($set==0)
         {echo'<td style="color:red; text-align:left;width=50%"> <input type="radio" name="app_time" id="app_time" disabled ><strike> 9.00PM </td>';}
       ?>	
	   
	   <?php
         $set=0;	
         $time1="9:30PM";
         for($i=0;$i<count($sched_array);$i++)
           {    if($time1 == $sched_array[$i])
	        {    echo'  <td style="color:green; text-align:left;width=50%"> <input type="radio" name="app_time" id="app_time" value="9:30PM"> 9.30PM </td>';
	            $set=$set+1;}
            }
         if($set==0)
         {echo'<td style="color:red; text-align:left;width=50%"> <input type="radio" name="app_time" id="app_time" disabled ><strike><strike> 9.30PM </td>';}
       ?>	  
	  			
	
	</tr>
  </tr>
</table>
</td>
<!----------------------------------------------->
</tr>  
</table>
<?php

echo '
<input type="hidden" name="app_date" value="' . $app_date . '"/>
<input type="hidden" name="doctor_user" value="' . $doctor_user . '"/>
<input type="submit" value="Request" onclick="return confirm(\'Send appointment to doctor?\');"/>
</form>
';       
?>

<form action="request_patient.php" method="post">
<input type="submit" value="Cancel"/>
</form>
</body>
</html>