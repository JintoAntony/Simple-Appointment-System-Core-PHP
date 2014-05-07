<?php
	function view_weekday() {
		$username = $_SESSION['username'];
		$conn = pg_connect('host=localhost dbname=healthcare user=postgres password=user');
		$sched_query = pg_query("SELECT doctor_sched_wday FROM doctor WHERE doctor_username='$username'");
		$sched_str = pg_result($sched_query, 0);
		$sched_array = explode(",", $sched_str);
		
		$count = count($sched_array);
		for($i=0; $i<($count-1); $i++) {
			if(($i == 0) && ($count != 1)) {
				echo 'From ' . $sched_array[$i];
			}
			if(($i == $count-2) && ($count != 1)) {
				echo ' to ' . $sched_array[$i];
			}
		}
		
		if($count != 1) {
			echo '<form action="remove_workschedule.php" method="post">
					<input type="hidden" name="sched_type" value="Weekday"/>
					<button type="submit" onclick="return confirm(\'Reset work schedule?\');">Reset</button>
				</form>';
		}
		else {
			echo '(No available schedule)<br/><br/>';
		}
		
		pg_close($conn);
	}
	
	function view_saturday() {
		$username = $_SESSION['username'];
		$conn = pg_connect('host=localhost dbname=healthcare user=postgres password=user');
		$sched_query = pg_query("SELECT doctor_sched_sat FROM doctor WHERE doctor_username='$username'");
		$sched_str = pg_result($sched_query, 0);
		$sched_array = explode(",", $sched_str);
		
		$count = count($sched_array);
		for($i=0; $i<($count-1); $i++) {
			if(($i == 0) && ($count != 1)) {
				echo 'From ' . $sched_array[$i];
			}
			if(($i == $count-2) && ($count != 1)) {
				echo ' to ' . $sched_array[$i];
			}
		}
		
		if($count != 1) {
			echo '<form action="remove_workschedule.php" method="post">
					<input type="hidden" name="sched_type" value="Saturday"/>
					<button type="submit" onclick="return confirm(\'Reset work schedule?\');">Reset</button>
				</form>';
		}
		else {
			echo '(No available schedule)<br/><br/>';
		}		
	}
	
	function view_sunday() {
		$username = $_SESSION['username'];
		$conn = pg_connect('host=localhost dbname=healthcare user=postgres password=user');
		$sched_query = pg_query("SELECT doctor_sched_sun FROM doctor WHERE doctor_username='$username'");
		$sched_str = pg_result($sched_query, 0);
		$sched_array = explode(",", $sched_str);
		
		$count = count($sched_array);
		for($i=0; $i<($count-1); $i++) {
			if(($i == 0) && ($count != 1)) {
				echo 'From ' . $sched_array[$i];
			}
			if(($i == $count-2) && ($count != 1)) {
				echo ' to ' . $sched_array[$i];
			}
		}
		
		if($count != 1) {
			echo '<form action="remove_workschedule.php" method="post">
					<input type="hidden" name="sched_type" value="Sunday"/>
					<button type="submit" onclick="return confirm(\'Reset work schedule?\');">Reset</button>
				</form>';
		}
		else {
			echo '(No available schedule)<br/><br/>';
		}		
	}
?>