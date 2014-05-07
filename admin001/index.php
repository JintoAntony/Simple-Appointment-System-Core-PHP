<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/login_page.css" />
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript">
	function validateForm(){
		var x=document.forms["myForm"]["eadd"].value;
		var atpos=x.indexOf("@");
		var dotpos=x.lastIndexOf(".");
		if ( (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length){
		  alert("Not a valid e-mail address.");
		  return false;
		}
	}		
</script>
<title>Online Appointment System</title>
</head>

<body>
	<div class="topbar">
    	<div class="global-nav">
        	<div>
				<ul class="nav">
				<li style="font-family:arial;color:White;font-size:20px;">Online Appointment Booking System</li>
                  <li class="home" data-global-action="t1home">
                      <a class="nav-logo-link" href="/" data-nav="front">
					  
                        <i class="bird-topbar-blue"></i>
						
                      </a>
                  </li>
                </ul>
				
			</div>
        </div>
    </div>
    <div id="page-outer">
    	<div id="page-container" style="border: 1px">
			<div class="front-container" id="front-container">
				<div class="front-bg">
					<img class="front-image" src="img/background.jpg" />
				</div>
				
				<div class="front-card">
					<!--div class="front-welcome">
						<div class="front-welcome-text">
							<h1>Welcome to HCS</h1>
							<p>Connect to Doctors and Patiens around your region.</p>
						</div>
					</div-->
				
					<div class="front-signin">
                    	
						<form action="login.php" class="signin" method="post" >
							<div class="username">
								<input type="text" id="signin-username" class="text-input" name="input_uname" title="Username or email" placeholder="Username"/>
								<!--label for="signin-username" class="placeholder">Username</label-->
							</div>
							
							<table class="password-signin">
                            	
								<tbody>
									<tr>
										<td class="primary">
											<div class="password">
												<input type="password" id="signin-password" class="table-input" name="input_pword" title="Password" placeholder="password">
												<!--label for="signin-password" class="placeholder">Password</label-->									
											</div>
										</td>
										
										<td class="secondary">
											<button type="submit" class="signin-btn-primary">Sign in</button>
										</td>
									</tr>
								</tbody>
							</table>
							
						</form>
					</div>
					 <div class="front-signup">
						<h2>
							<strong>No account yet?</strong>
							Sign Up Please
						<form action="signup2.php" class="signup" method="post" name="myForm" onsubmit="return validateForm()">
						<!--	<select name="signup_option">
								<option value="doctor">Doctor</option>
								<option value="patient">Patient</option>
							</select>   -->
						</h2>
						
						
							<div class="placeholding-input">
								<input type="text" id="signup-user-name" class="text-input" name="uname" placeholder="Username">
								<!--label for="signup-user-name" class="placeholder">Username</label-->
							</div>
							<div class="placeholding-input">
								<input type="text" id="signup-user-email" class="text-input" name="eadd" placeholder="Email">
								<!--label for="signup-user-email" class="placeholder">Email</label-->
							</div>
							<div class="placeholding-input">
								<input type="password" id="signup-user-password" class="text-input" name="pword" placeholder="password">
								<!--label for="signup-user-password" class="placeholder">Password</label-->
							</div>
							<input type="hidden" name="signup_option" value="doctor">
							<button type="submit" class="btn signup-btn">Sign up for HCS</button>
						</form>
						
					 </div>
						
					</div>
					<div class="footer">
						<ul>
							<li style="font-family:arial;color:white;font-size:12px;"> Copyright-2013@Spiderguts.com</li>
						</ul>
					</div>
					
					
					
				</div>
			</div>	
        </div>
    </div>

</body>

	<?php
	session_start();
	//if ($_SESSION['login']==0){

		$username = $_POST['input_uname'];
		$password = md5($_POST['input_pword']);
		$a=0;
		$b=0;
		$c=0;
		$d=0;
		
		//$conn = pg_connect('host=localhost dbname=healthcare user=postgres password=user');
		
		$conn=mysql_connect("localhost","root","root")or die("can not connect");
	    mysql_select_db("healthcare",$conn) or die("can not select database");
		
		$resultCheck1=mysql_query("select patient_username from patient where patient_username='$username' and patient_password!='$password' ",$conn);
		$resultCheck2=mysql_query("select patient_username from patient where patient_username='$username' and patient_password='$password' and patient_rstatus='approved'",$conn);
		$resultCheck3=mysql_query("select doctor_username from doctor where doctor_username='$username' and doctor_password!='$password'",$conn);
		$resultCheck4=mysql_query("select doctor_username from doctor where doctor_username='$username' and doctor_password='$password' and doctor_rstatus='approved'",$conn);
		
		while($myrow = mysql_fetch_assoc($resultCheck1)) {	//doctor username
			$a=$a+1;
		}
		while($myrow = mysql_fetch_assoc($resultCheck2)) {	//doctor username and password
			$b=$b+1;
		}
		while($myrow = mysql_fetch_assoc($resultCheck3)) {	//doctor username
			$c=$c+1;
		}
		while($myrow = mysql_fetch_assoc($resultCheck4)) {	//doctor username and password
			$d=$d+1;
		}
		
		if($username== 'admin' && $password== md5('123') ){
			$_SESSION["login"] = 1;
			$_SESSION["username"] = $username;
			$_SESSION["password"] = $password;
			header("Location: manage_regrequest.php");
			exit;
		}else{
			if (($a==0 && $b==0) && ($c==0 && $d==0)){
				/*print '<script type="text/javascript">';
				print 'alert("Username does not exist.")';
				print '</script>';
			*/}else if($a!=0 || $c!=0){
				print '<script type="text/javascript">';
				print 'alert("Password did not match. Please try again.")';
				print '</script>'; 
			}else if($b!=0){
				$result = mysql_query("select patient_rstatus from patient where patient_username='$username'",$conn);
				$status = mysql_fetch_row($result);
				if($status[0] == "approved"){
					$_SESSION["login"] = 1;
					$result = mysql_query("select patient_fname from patient where patient_username='$username'",$conn);
					$name = mysql_fetch_row($result);
					$_SESSION["name"] = $name[0];
					$_SESSION["username"] = $username;
					$_SESSION["password"] = $password;
					header("Location: dboardPatient.php");
					exit;
				}
				else{
					echo "Account still pending";
				}
			}else if($d!=0){
				$result = mysql_query("select doctor_rstatus from doctor where doctor_username='$username'",$conn);
				$status = mysql_fetch_row($result);
				if($status[0] == "approved"){
					$_SESSION["login"] = 2;
					$result = mysql_query("select doctor_fname from doctor where doctor_username='$username'",$conn);
					$name = mysql_fetch_row($result);
					$_SESSION["name"] = $name[0];
					$_SESSION["username"] = $username;
					$_SESSION["password"] = $password;
					header("Location: dboardDoctor.php");
					exit;
				}
				else{
					echo "Account still pending";
				}
			}
		}
		mysql_close($conn);
	/*}
	else{
		header('Location: dBoardDoctor.php');
	}*/

?>


</html>

