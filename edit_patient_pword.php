<html>
	<head>
		<title>Edit Patient's Password</title>
		<script language = "javascript">
			function ConfirmCP()
			{
				if (confirm("Are you sure?")) {
					return true; 
				} else {
					return false;
				} 
			}
		</script>
	</head>
	<body>
		<?php
			session_start();
			
			//$password=$_SESSION["password"];
			
			echo"
				<form action='process_editPatient_pword.php' method='post' onsubmit='return ConfirmCP();'>
				<table>
				<tr>
					<td> Current Password: </td>
					<td> <input type='password' name='oldpassword' value='' required='required' > </td>
				</tr>
				<tr>
					<td> New Password: </td>
					<td> <input type='password' name='newpassword' value='' required='required'> </td>
				</tr>
				</table>
				<input type='submit' name='submit'/>
				</form>
			";
		?>
	</body>
</html>