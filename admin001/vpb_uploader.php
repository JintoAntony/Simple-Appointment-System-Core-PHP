<?php 
session_start();
$conn=mysql_connect("localhost","root","root")or die("can not connect");
mysql_select_db("healthcare",$conn) or die("can not select database");
if(empty($_POST))
{exit;}	

$id=$_POST['userid'];
//echo $id;
$pname=$_POST['pname'];
//echo $pname;
$dname=$_POST['dname'];
//echo $dname;
$sickness=$_POST['sickness'];
//echo $sickness;
$bdate=$_POST['bdate'];	
//echo $bdate;
$report=$_POST['report'];
//echo $report;
$query = "insert into records (patient_id,dates,patientname,sickness,doctorname,casereport) values
			('{$id}','{$bdate}','{$pname}','{$sickness}','{$dname}','{$report}');";
			$result = mysql_query($query,$conn); 
$id=$_SESSION["p_id"];	
$date=$_SESSION["date"];
$dir='uploaded_files/'.$id.'_'.$date.'/';
//echo $dir;
if(isset($_POST) && $_SERVER['REQUEST_METHOD'] == "POST")
{
	$vpb_file_name = strip_tags($_FILES['upload_file']['name']); //File Name
	$vpb_file_id = strip_tags($_POST['upload_file_ids']); // File id is gotten from the file name
	$vpb_file_size = $_FILES['upload_file']['size']; // File Size
	//$vpb_uploaded_files_location = 'uploaded_files/.'$id'./'; //This is the directory where uploaded files are saved on your server
	//$vpb_final_location = $vpb_uploaded_files_location . $vpb_file_name; //Directory to save file plus the file to be saved*/	
   if(is_dir($dir))     
	{
	  //echo 'directory exists';	  
	  $vpb_final_location = $dir. $vpb_file_name;	     
		 if(move_uploaded_file(strip_tags($_FILES['upload_file']['tmp_name']), $vpb_final_location))
	               {
		                //Display the file id
		                echo $vpb_file_id;
	               }
	     else
	               {
		                //Display general system error
		                echo 'general_system_error';
	               }
	  
    }	  
	else    
     {	 
            //echo 'drectory not exist';
			
			$new=mkdir($dir);
			$vpb_final_location = $dir. $vpb_file_name;
			
			if(move_uploaded_file(strip_tags($_FILES['upload_file']['tmp_name']), $vpb_final_location))
	               {
		                //Display the file id
		                echo $vpb_file_id;
	               }
	        else
	               {
		                //Display general system error
		                echo 'general_system_error';
	               }
	 } 	
	/************************** Comment This Code and Un-comment The Code At The Bottom To Use Validation Feature***********************/
	
	//Without Validation and does not save filenames in the database
	/*if(move_uploaded_file(strip_tags($_FILES['upload_file']['tmp_name']), $vpb_final_location))
	{
		//Display the file id
		echo $vpb_file_id;
	}
	else
	{
		//Display general system error
		echo 'general_system_error';
	}
	*/
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/*
	//********************************Comment The Above Code And Un-comment This Below Code To Use Validation Feature********************************
	
	
	//With Validation and saves filenames in the database
	
	$vpb_file_extensions = pathinfo($vpb_file_name, PATHINFO_EXTENSION); // File Extension
	$vpb_allowed_file_extensions = array("jpg","jpeg","gif","png");  //Allowed file types
	
	$vpb_maximum_allowed_file_size = 1024*1024; // 1MB - You may change the maximum allowed upload file size here if you wish
	
	//Validation for File Type
	if (!in_array($vpb_file_extensions, $vpb_allowed_file_extensions)) 
	{
		//Display file type error error
		echo 'file_type_error&'.$vpb_file_name;
	}
	else 
	{
		//Validation for File Size
		if($vpb_file_size > $vpb_maximum_allowed_file_size)
		{
			//Display file size error error
			echo 'file_size_error&'.$vpb_file_name;
		}
		else
		{
			if(move_uploaded_file(strip_tags($_FILES['upload_file']['tmp_name']), $vpb_final_location))
			{
				// Include the database connection setting file
				include "config.php"; 
				
				// Check for existing file
				$check_existing_file = mysql_query("select * from `uploads` where `file_id` = '".mysql_real_escape_string($vpb_file_id)."'");
				if(mysql_num_rows($check_existing_file) < 1)
				{
					//Save this file because it does not already exist in the database table
					if(mysql_query("insert into `uploads` values('', '".mysql_real_escape_string($vpb_file_id)."', '".mysql_real_escape_string($vpb_file_name)."')"))
					{
						//Display the file id
						echo $vpb_file_id;
					}
					else
					{
						//Display general system error
						echo 'general_system_error';
					}
				}
				else 
				{
					// Do not save file because it al exist in the database
					
					//Display the file id
					echo $vpb_file_id;
				}
			}
			else
			{
				//Display general system error
				echo 'general_system_error';
			}
		}
	}
	*/
}
?>