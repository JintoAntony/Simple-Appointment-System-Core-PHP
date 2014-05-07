<?php
	session_start();
	if ($_SESSION['login']==0) header('Location: login_page.php');
?>
<html>
	<head>
		<title>Edit Password</title>
		<link rel='stylesheet' type='text/css' href='css/edit_password_doc.css'/>
		<script type='text/javascript'>
			function sched_checker() {
				if(confirm('Send schedule?')){
					var counter = 0;
					var wday_from = document.getElementById('from_wday').value;
					var wday_to = document.getElementById('to_wday').value;
					document.getElementById('wday_label').innerHTML = '';
					if(wday_from == '') {
						if(wday_to != '') {
							document.getElementById('wday_label').innerHTML = '*Please fill this up properly';
							counter += 1;
						}
					}
					if(wday_to == '') {
						if(wday_from != '') {
							document.getElementById('wday_label').innerHTML = '*Please fill this up properly';
							counter += 1;
						}
					}
					
					var x = parseInt(wday_from);
					var y = parseInt(wday_to);
					if(x > y) {
						document.getElementById('wday_label').innerHTML = '*Please fill this up properly';
						counter += 1;
					}

					var sat_from = document.getElementById('from_sat').value;
					var sat_to = document.getElementById('to_sat').value;
					document.getElementById('sat_label').innerHTML = '';
					if(sat_from == '') {
						if(sat_to != '') {
							document.getElementById('sat_label').innerHTML = '*Please fill this up properly';
							counter += 1;
						}
					}
					if(sat_to == '') {
						if(sat_from != '') {
							document.getElementById('sat_label').innerHTML = '*Please fill this up properly';
							counter += 1;
						}
					}
					
					var x = parseInt(sat_from);
					var y = parseInt(sat_to);
					if(x > y) {
						document.getElementById('sat_label').innerHTML = '*Please fill this up properly';
						counter += 1;
					}

					var sun_from = document.getElementById('from_sun').value;
					var sun_to = document.getElementById('to_sun').value;
					document.getElementById('sun_label').innerHTML = '';
					if(sun_from == '') {
						if(sun_to != '') {
							document.getElementById('sun_label').innerHTML = '*Please fill this up properly';
							counter += 1;
						}
					}
					if(sun_to == '') {
						if(sun_from != '') {
							document.getElementById('sun_label').innerHTML = '*Please fill this up properly';
							counter += 1;
						}
					}
					
					var x = parseInt(sun_from);
					var y = parseInt(sun_to);
					if(x > y) {
						document.getElementById('sun_label').innerHTML = '*Please fill this up properly';
						counter += 1;
					}
					
					if(counter > 0) {
						return false;
					}
				}
				else {
					return false;
				}
			}
		</script>
	</head>
	<body>
		<div class='canvas'>
			<div class='signup'>
				<!--Sign Up Form-->
					<div id='form-content'>
						<h1>Edit Work Schedule</h1>
						
			<?php
				/*****Lhea's changes start here!*****/
					echo "<form action='add_schedule.php' method='post'>
							Weekday<br/>
							From <select name='sched_from_wday' id='from_wday'>";
								$from_sched_array = array();
								array_push($from_sched_array, ' ');
								for($time_index=0;$time_index<24;$time_index++) {
									$time_str = $time_index . ":00";
									array_push($from_sched_array, $time_str);
								}

								for($i=0;$i<$time_index;$i++){
									echo '<option>' . $from_sched_array[$i] . '</option>';
								}
							echo "</select> To <select name='sched_to_wday' id='to_wday'>";
								$to_sched_array = array();
								array_push($to_sched_array, ' ');
								for($time_index=0;$time_index<24;$time_index++) {
									$time_str = $time_index . ":00";
									array_push($to_sched_array, $time_str);
								}

								for($i=0;$i<$time_index;$i++){
									echo '<option>' . $to_sched_array[$i] . '</option>';
								}
							echo "</select><p id='wday_label' style='color: #f00;'></p><br/>";
							
							echo "Saturday<br/>
							From <select name='sched_from_sat' id='from_sat'>";
								$from_sched_array = array();
								array_push($from_sched_array, ' ');
								for($time_index=0;$time_index<24;$time_index++) {
									$time_str = $time_index . ":00";
									array_push($from_sched_array, $time_str);
								}

								for($i=0;$i<$time_index;$i++){
									echo '<option>' . $from_sched_array[$i] . '</option>';
								}
							echo "</select> To <select name='sched_to_sat' id='to_sat'>";
								$to_sched_array = array();
								array_push($to_sched_array, ' ');
								for($time_index=0;$time_index<24;$time_index++) {
									$time_str = $time_index . ":00";
									array_push($to_sched_array, $time_str);
								}

								for($i=0;$i<$time_index;$i++){
									echo '<option>' . $to_sched_array[$i] . '</option>';
								}
							echo "</select><p id='sat_label' style='color: #f00;'></p><br/>";

							echo "Sunday<br/>
							From <select name='sched_from_sun' id='from_sun'>";
								$from_sched_array = array();
								array_push($from_sched_array, ' ');
								for($time_index=0;$time_index<24;$time_index++) {
									$time_str = $time_index . ":00";
									array_push($from_sched_array, $time_str);
								}

								for($i=0;$i<$time_index;$i++){
									echo '<option>' . $from_sched_array[$i] . '</option>';
								}
							echo "</select> To <select name='sched_to_sun' id='to_sun'>";
								$to_sched_array = array();
								array_push($to_sched_array, ' ');
								for($time_index=0;$time_index<24;$time_index++) {
									$time_str = $time_index . ":00";
									array_push($to_sched_array, $time_str);
								}

								for($i=0;$i<$time_index;$i++){
									echo '<option>' . $to_sched_array[$i] . '</option>';
								}
							echo "</select><p id='sun_label' style='color: #f00;'></p><br/>";
						echo "
						<input id='submit_btn' type='submit' onclick='return sched_checker()'/>
					</form>";
					/*****Lhea's changes end here!*****/
			?>
			<a href="doctor_profile.php">< Back</a>
		</div>
	</body>
</html>