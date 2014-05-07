<?php 

/* draws a calendar */
function draw_calendar($month,$year){
    /* draw table */
	$calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';
	
	
	/* Display month*/
	
	

	/* table headings */
	$headings = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
	$calendar.= '<tr class="calendar-row"><td class="calendar-day-days">'.implode('</td><td class="calendar-day-days">',$headings).'</td></tr>';

	/* days and weeks vars now ... */
	$running_day = date('w',mktime(0,0,0,$month,1,$year));
	$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
	$days_in_this_week = 1;
	$day_counter = 0;
	$dates_array = array();
	
	$today=Date('d');
	//echo $today;

	/* row for week one */
	$calendar.= '<tr class="calendar-row">';

	/* print "blank" days until the first of the current week */
	for($x = 0; $x < $running_day; $x++):
		$calendar.= '<td class="calendar-day-np"> </td>';
		$days_in_this_week++;
	endfor;
	
	
	/* Block days */
	
	

	/* keep going with days.... */
	for($list_day = 1; $list_day <= $days_in_month; $list_day++):
	   // $calendar.= '';

	if($list_day<$today)
	{
	$calendar.= ' <td class="calendar-day"  > <a  style="color:red; font-weight:bold; text-align:center; text-decoration:none; font-size:20px;"><ul><strike>'.$list_day.'</strike></ul></a>';
		 /** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
		$calendar.= str_repeat('<p> </p>',2);
		$calendar.= '</td>';
		if($running_day == 6):
			$calendar.= '</tr>';
			if(($day_counter+1) != $days_in_month):
				$calendar.= '<tr class="calendar-row">';
			endif;
			$running_day = -1;
			$days_in_this_week = 0;
		  endif;
		  $days_in_this_week++; $running_day++; $day_counter++;

	}	
	else
	{	$calendar.= ' <td class="calendar-day" >
<!--	<input type="radio" selected="" id="day" name="day" >  -->
	<a href="request_page_time.php?app_date='.$year.'-'.$month.'-'.$list_day.'&&doctor_user='.$_SESSION['docuser'].'" style="color:green; font-weight:bold; text-align:center; text-decoration:none; font-size:20px;"><ul>'.$list_day.'</ul></a>
	';

	


		/** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
		$calendar.= str_repeat('<p> </p>',2);
			
		  $calendar.= '</td>';
		  
		  if($running_day == 6):
			$calendar.= '</tr>';
			if(($day_counter+1) != $days_in_month):
				$calendar.= '<tr class="calendar-row">';
			endif;
			$running_day = -1;
			$days_in_this_week = 0;
		  endif;
		  $days_in_this_week++; $running_day++; $day_counter++;
	}	
	endfor;


	/* finish the rest of the days in the week */
	if($days_in_this_week < 8):
		for($x = 1; $x <= (8 - $days_in_this_week); $x++):
			$calendar.= '<td class="calendar-day-np"> </td>';
		endfor;
	endif;

	/* final row */
	$calendar.= '</tr>';

	/* end the table */
	$calendar.= '</table>';
	
	/* all done, return result */
	return $calendar;
}

?>