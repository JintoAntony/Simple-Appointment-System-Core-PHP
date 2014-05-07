<?php
	/*include('notification.php');
	session_start();
	if ($_SESSION['login']==0)
		header('Location: index.php');
	else if($_SESSION['login']==2)
		header('Location: dBoardDoctor.php');*/
?>

<html>
	<head>
		<title>Healthcare System</title>
		<link rel="stylesheet" type="text/css" href="CSS/dboardCSS.css">
		
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		
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
		
		<div class="banner-container">
			<div class="headbanner"></div>
		</div>
		
		<div class="content_wrapper">
			<div class="content_main">
				<div class="welcome_header">
					<?php
					//	echo "Welcome " .$_SESSION["name"] ;
					?>
					
					</div>
				<!--	<div class="clearance"></div>
					<div class="notifications">
						<?php
						//	display_notification($_SESSION["username"]);
						?>
					</div> -->
					<div class="container">
					 
								<div id="wrapper">
                        
						         <div id="login" class="animate form">
						
						            <?php   
									  
									    $conn=mysql_connect("localhost","root","root")or die("can not connect");
	                                     mysql_select_db("healthcare",$conn) or die("can not select database");
									
										 $doctor_query = mysql_query("SELECT * FROM doctor",$conn);
				                        while ($doctor_result = mysql_fetch_array($doctor_query))
										 
										 { 
				                           
										    $image=$doctor_result['doctor_fname'] . ' ' . $doctor_result['doctor_lname'];
											
											$a="doctor_img/" . $image.'.'."jpg";
											
										    
											if ($exist=file_exists($a))
		                                              {
			                                             // file already exists error
														// echo $a;
		                                                // echo "File here";
		                                              
										           
										        echo '<div class="image"> <img src="'.$a.'" style="width:100%;height:100%;"></div>';
										        
										   
										   
										        echo '<div class="details"> '.$doctor_result['doctor_fname'] . ' ' . $doctor_result['doctor_lname']."<br/>";
				
                                                echo  $doctor_result['doctor_specialization'] . ' <br/></div>' ;
												
												echo '<a href="request_patient.php"> Request Appointment </a>';
                                         
										 }
										 }
                                          
						                  
									  ?> 
                                 </div> 
                             
                               	</div>						 
                              
						     </div>
                
		  
            
			      
                     
					</div>
					
	        </div>
		
		</div>
	
	</body>

</html>