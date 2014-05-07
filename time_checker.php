<?php
	function check_time($given_date, $given_time) {
		date_default_timezone_set('Asia/Hong_Kong');
		
		$curr_date = date('Y-m-d');
		$curr_time = date('H:i:s');
		
		/*Time difference in seconds*/
		$dif_date = abs(strtotime($curr_date) - strtotime($given_date));
		$dif_time = abs(strtotime($curr_time) - strtotime($given_time));
		$total_dif = $dif_date + $dif_time;
		
		/*Time difference in minutes*/
		$total_difmin = (int)$total_dif / 60;
		
		return $total_difmin;
	}
?>