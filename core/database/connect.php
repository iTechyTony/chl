<?php
	$connect_error = 'Sorry, we\'re experiencing connection problems.';
	mysql_connect ( 'localhost' , 'itt_chl' , 'iNLnEQyF' ) or die( $connect_error );
	mysql_select_db ( 'itt_chl' ) or die( $connect_error );
	$connection = mysqli_connect ( 'localhost' , 'itt_chl' , 'iNLnEQyF' , 'itt_chl' ) or die( 'Failed to connect' );