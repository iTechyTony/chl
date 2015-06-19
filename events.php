<?php
	include 'core/init.php';
	include 'includes/overall/header.php';
?>

	<div class = "panel panel-primary">
	<div class = "panel-heading">
              <h3 class = "panel-title">Events</h3>
            </div>
            <div class = "panel-body">
                       
<?php
	/* draws a calendar */
	function draw_calendar ( $month , $year , $events = array () )
	{
		/* draw table */
		$calendar = '<div class="table-responsive"><table class="table table-bordered">';
		/* table headings */
		$headings = array ( 'Sunday' , 'Monday' , 'Tuesday' , 'Wednesday' , 'Thursday' , 'Friday' , 'Saturday' );
		$calendar .= '<tr><td>' . implode ( '</td><td>' , $headings ) . '</td></tr>';
		/* days and weeks vars now ... */
		$running_day = date ( 'w' , mktime ( 0 , 0 , 0 , $month , 1 , $year ) );
		$days_in_month = date ( 't' , mktime ( 0 , 0 , 0 , $month , 1 , $year ) );
		$days_in_this_week = 1;
		$day_counter = 0;
		$dates_array = array ();
		/* row for week one */
		$calendar .= '<tr >';
		/* print "blank" days until the first of the current week */
		for ( $x = 0 ; $x < $running_day ; $x ++ ):
			$calendar .= '<td ></td>';
			$days_in_this_week ++;
		endfor ;
		/* keep going with days.... */
		for ( $list_day = 1 ; $list_day <= $days_in_month ; $list_day ++ ):
			$calendar .= '<td>';
			/* add in the day number */
			$calendar .= '' . $list_day . '';
			$event_day = $year . '-' . $month . '-' . $list_day;
			if ( isset( $events[ $event_day ] ) )
			{
				foreach ( $events[ $event_day ] as $event )
				{
					switch ( $event[ 'type' ] )
					{
						case 'races':
							$calendar .= '<form method="get" action="event_details.php">
				<button type="submit" name="id" value="' . $event[ 'id' ] . '" class="btn btn-default btn-lg">
				 <span class="glyphicon glyphicon-road"></span>
         	    <span class="glyphicon-class"></span></button></form>';
							break;
						case 'timetrial':
							$calendar .= '
		<form method="get" action="event_details.php">
		<button type="submit" name="id" value="' . $event[ 'id' ] . '" class="btn btn-default btn-lg">
          <span class="glyphicon glyphicon-time"></span>
          <span class="glyphicon-class"></span></button>
          </form>';
							break;
						case 'sportive':
							$calendar .= '
				<form method="get" action="event_details.php">
		<button type="submit" name="id" value="' . $event[ 'id' ] . '" class="btn btn-default btn-lg">
			     <span class="glyphicon glyphicon-flag"></span>
          <span class="glyphicon-class"></span></button></form>';
							break;
						default:
							break;
					}
				}
			}
			else
			{
				$calendar .= str_repeat ( '<p><br></p>' , 2 );
			}
			$calendar .= '</td>';
			if ( $running_day == 6 ):
				$calendar .= '</tr>';
				if ( ( $day_counter + 1 ) != $days_in_month ):
					$calendar .= '<tr>';
				endif;
				$running_day = - 1;
				$days_in_this_week = 0;
			endif;
			$days_in_this_week ++;
			$running_day ++;
			$day_counter ++;
		endfor ;
		/* finish the rest of the days in the week */
		if ( $days_in_this_week < 8 ):
			for ( $x = 1 ; $x <= ( 8 - $days_in_this_week ) ; $x ++ ):
				$calendar .= '';
			endfor ;
		endif;
		/* final row */
		$calendar .= '';
		/* end the table */
		$calendar .= '</table></div>';
		/** DEBUG **/
		$calendar = str_replace ( '</td>' , '</td>' . "\n" , $calendar );
		$calendar = str_replace ( '</tr>' , '</tr>' . "\n" , $calendar );

		/* all done, return result */

		return $calendar;
	}

	function random_number ()
	{
		srand ( time () );

		return ( rand () % 7 );
	}

	/* date settings */
	$month = (int) ( $_GET[ 'month' ] ? $_GET[ 'month' ] : date ( 'm' ) );
	$year = (int) ( $_GET[ 'year' ] ? $_GET[ 'year' ] : date ( 'Y' ) );
	/* select month control */
	$select_month_control = '<select name="month" id="month" class="form-control input-sm">';
	for ( $x = 1 ; $x <= 12 ; $x ++ )
	{
		$select_month_control .= '<option value="' . $x . '"' . ( $x != $month ? '' : ' selected="selected"' ) . '>' . date ( 'F' , mktime ( 0 , 0 , 0 , $x , 1 , $year ) ) . '</option>';
	}
	$select_month_control .= '</select>';
	/* select year control */
	$year_range = 7;
	$select_year_control = '<select name="year" id="year" class="form-control input-sm">';
	for ( $x = ( $year - floor ( $year_range / 2 ) ) ; $x <= ( $year + floor ( $year_range / 2 ) ) ; $x ++ )
	{
		$select_year_control .= '<option value="' . $x . '"' . ( $x != $year ? '' : ' selected="selected"' ) . '>' . $x . '</option>';
	}
	$select_year_control .= '</select>';
	/* "next month" control */
	$next_month_link = '<li class="next" ><a href="?month=' . ( $month != 12 ? $month + 1 : 1 ) . '&amp;year=' . ( $month != 12 ? $year : $year + 1 ) . '" >Next Month &rarr;</a></li></ul>';
	/* "previous month" control */
	$previous_month_link = '<ul class="pager"><li class="previous"><a href="?month=' . ( $month != 1 ? $month - 1 : 12 ) . '&amp;year=' . ( $month != 1 ? $year : $year - 1 ) . '" >&larr; Previous Month</a></li>';
	/* bringing the controls together */
	$controls = '<form method="get" class="form-inline" role="form">' . $select_month_control . $select_year_control . '&nbsp;<button type="submit" name="submit" class="btn btn-primary" >Go</button>' . $previous_month_link . '' . $next_month_link . ' </form>';
	/* get all events for the given month */
	$events = array ();
	$query = mysql_query ( "SELECT title, type, id, DATE_FORMAT(event_date,'%Y-%c-%e') AS event_date FROM events WHERE DATE_FORMAT(event_date,'%Y-%c-%e') LIKE '$year-$month%'" );
	while ( ( $row = mysql_fetch_assoc ( $query ) ) )
	{
		$events[ $row[ 'event_date' ] ][] = $row;
	}
	echo '<h1 >' . date ( 'F' , mktime ( 0 , 0 , 0 , $month , 1 , $year ) ) . ' ' . $year . '</h1>';
	echo '<div>' . $controls . '</div>';
	echo draw_calendar ( $month , $year , $events );
?>


	            <span class = "glyphicon glyphicon-time"></span>
          <span class = "glyphicon-class">Time Trials</span>
   <br>     

          <span class = "glyphicon glyphicon-flag"></span>
          <span class = "glyphicon-class">Sportive Events</span>
     <br>     

          <span class = "glyphicon glyphicon-road"></span>
          <span class = "glyphicon-class">Races</span>
           
        
        
   </div></div>

<?php include 'includes/overall/footer.php'; ?>