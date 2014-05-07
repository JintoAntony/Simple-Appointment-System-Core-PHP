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
		
		
		$resultCheck1=mysql_query("select patient_username from patient where patient_username='{$username}' and patient_password!='{$password}'",$conn);
		$resultCheck2=mysql_query("select patient_username from patient where patient_username='{$username}' and patient_password='{$password}'",$conn);
		$resultCheck3=mysql_query("select doctor_username from doctor where doctor_username='{$username}' and doctor_password!='{$password}'",$conn);
		$resultCheck4=mysql_query("select doctor_username from doctor where doctor_username='{$username}' and doctor_password='{$password}'",$conn);
		
		while($myrow = mysql_fetch_assoc($resultCheck1)) {	//patient username
			$a=$a+1;
		}
		while($myrow = mysql_fetch_assoc($resultCheck2)) {	//patient username and password
			$b=$b+1;
		}
		while($myrow = mysql_fetch_assoc($resultCheck3)) {	//doctor username
			$c=$c+1;
		}
		while($myrow = mysql_fetch_assoc($resultCheck4)) {	//doctor username and password
			$d=$d+1;
		}
		
		if (($a==0 && $b==0) && ($c==0 && $d==0)){
			echo "Username does not exist.";
		}else if($a!=0 || $c!=0){
			echo "Password did not match.";
		}else if($b!=0){
		
		
		
			$result = mysql_query("select patient_rstatus from patient where patient_username='{$username}'",$conn);
			$status = mysql_fetch_row($result);
			
			
			
			if($status[0] == "approved"){
				$_SESSION["login"] = 1;
				$result = mysql_query("select patient_fname from patient where patient_username='{$username}'",$conn);
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
			$result = mysql_query("select doctor_rstatus from doctor where doctor_username='{$username}'",$conn);
			$status = mysql_fetch_row($result);
			if($status[0] == "approved"){
				$_SESSION["login"] = 2;
				$result = mysql_query("select doctor_fname from doctor where doctor_username='{$username}'",$conn);
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
		mysql_close($conn);
	/*}
	else{
		header('Location: dBoardDoctor.php');
	}*/

?>