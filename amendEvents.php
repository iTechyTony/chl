<?php
	include 'core/init.php';
	protect_page ();
	admin_protect ();
	include 'includes/overall/header.php';
?>

	<div class = "panel panel-primary">
	<div class = "panel-heading">
              <h3 class = "panel-title">Events</h3>
            </div>
            <div class = "panel-body">
<?php
	if ( isset( $_GET[ 'success' ] ) === true && empty( $_GET[ 'success' ] ) === true )
	{
		echo '<div class="alert alert-success"><h2>You have successfully created an Event</h2> </div>';
	}
	else if ( ( isset( $_GET[ 'removeEvent' ] ) === true && empty( $_GET[ 'removeEvent' ] ) === false ) )
	{
		$unique_id = $_GET[ 'removeEvent' ];
		delete ( $unique_id , events );
		echo '<div class="alert alert-success"><h2>You have successfully Deleted an Event</h2> </div>';
	}
?>


	            <form role = "form" method = "get" action = "amendEvents.php">
  <button type = "submit" value = "create" name = "menu" class = "btn btn-primary">Add Event</button>
  <button type = "submit" value = "update" name = "menu" class = "btn btn-primary">Update Event</button>
  <button type = "submit" value = "delete" name = "menu" class = "btn btn-primary">Delete Event</button>
</form>


	            <?php
		            $id = $_GET[ 'menu' ];
		            switch ( $id )
		            {
			            case 'create':
				            echo '<br>';
				            if ( empty( $_POST ) === false )
				            {
					            $required_fields = array ( 'title' , 'date' , 'type' , 'details' , 'distance' , 'description' );
					            foreach ( $_POST as $key => $value )
					            {
						            if ( empty( $value ) && in_array ( $key , $required_fields ) === true )
						            {
							            $errors[] = 'Fields marked with an asterisk are required';
							            break 1;
						            }
					            }
					            if ( empty( $errors ) === true )
					            {
						            if ( is_numeric ( $_POST[ 'distance' ] ) === false )
						            {
							            $errors[] = 'Distance must be a number';
						            }
					            }
				            }
				            if ( empty( $_POST ) === false && empty( $errors ) === true )
				            {
					            $given = $_POST[ 'date' ];
					            $date = date_create ( $_POST[ 'date' ] );
					            $new_date = date_format ( $date , 'Y-m-d' );
					            $values = array ( 'title' => $_POST[ 'title' ] , 'event_date' => $new_date , 'type' => $_POST[ 'type' ] , 'details' => $_POST[ 'details' ] , 'distance' => $_POST[ 'distance' ] , 'description' => $_POST[ 'description' ] );
					            insert ( $values , events );
					            header ( 'Location: amendEvents.php?success' );
					            exit();
				            }
				            else if ( empty( $errors ) === false )
				            {
					            echo '<div class="alert alert-danger">' . output_errors ( $errors ) . '</div>';
				            }
				            echo '<form action="" method="post" class="form-horizontal" role="form">
		<div class="row">
			<div class="col-xs-9">
<div class="form-group">
    <label for="title" class="col-sm-3 control-label">Event Name*</label>
    <div class="col-sm-7">
      <input type="text" name="title" class="form-control" id="title" value="">
    </div>
  </div>


  <div class="form-group">
    <label for="date" class="col-sm-3 control-label">Date*</label>
    <div class="col-sm-7">
      <input type="text" name="date" class="form-control" id="datepicker" value="">
    </div>
    </div>

  <div class="form-group">
    <label for="type" class="col-sm-3 control-label">Type*</label>
    <div class="col-sm-7">
     
        <select class="form-control" name="type">
          <option value="">Please Choose Event Type</option>
          <option value="timetrial">Time Trials</option>
          <option value="sportive"> Sportive</option>
          <option value="races">Races</option>
        </select>

    </div>
    </div>


  <div class="form-group">
    <label for="details" class="col-sm-3 control-label">Details*</label>
    <div class="col-sm-7">
      <input type="text" name="details" class="form-control" id="details" >
    </div>
  </div>			

  <div class="form-group">
    <label for="distance" class="col-sm-3 control-label">Distance*</label>
    <div class="col-sm-7">
      <input type="text" name="distance" class="form-control" id="distance" >
    </div>
  </div>		


 <div class="form-group">
    <label for="description" class="col-sm-3 control-label">Description*</label>
    <div class="col-sm-7">
      <textarea name="description" class="form-control" id="description" rows="4"  ></textarea>
    </div>
  </div>		
  

  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-10">
      <button type="submit" class="btn btn-success">Add Event</button>
    </div>
  </div>
   </div>
    </div>
	</form> ';
				            break;
			            case 'delete':
				            echo '<br>';
				            echo '	<div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Event</th>
          <th>Date</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>';
				            $query = mysql_query ( "SELECT * FROM events order by event_date DESC" );
				            while ( ( $row = mysql_fetch_assoc ( $query ) ) )
				            {
					            $date = date_create ( $row[ 'event_date' ] );
					            echo ' <tr>';
					            echo ' <td>' . $row[ 'title' ] . '</td>';
					            echo ' <td>' . date_format ( $date , 'jS-F-Y' ) . '</td>';
					            echo '<td><a href="amendEvents.php?removeEvent=' . $row[ 'id' ] . '">Delete</a></td>';
					            echo ' </tr>';
				            }
				            echo '</tbody>
    </table>
  </div>';
				            break;
			            case 'update':
				            $query = mysql_query ( "SELECT * FROM events order by event_date DESC" );
				            echo '<br>';
				            echo '	<div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Event</th>
          <th>Date</th>
          <th>Type</th>
          <th>Distance</th>
          <th>Update</th>
        </tr>
      </thead>
      <tbody>';
				            while ( ( $row = mysql_fetch_assoc ( $query ) ) )
				            {
					            $date = date_create ( $row[ 'event_date' ] );
					            echo ' <tr>';
					            echo ' <td>' . $row[ 'title' ] . '</td>';
					            echo ' <td>' . date_format ( $date , 'jS-F-Y' ) . '</td>';
					            echo ' <td>' . $row[ 'type' ] . '</td>';
					            echo ' <td>' . $row[ 'distance' ] . '</td>';
					            echo '<td><a href="edit_event.php?id=' . $row[ 'id' ] . '">Update</a></td>';
					            echo ' </tr>';
				            }
				            echo ' </tbody>
    </table>
  </div>';
				            break;
			            default:
				            break;
		            }
	            ?>
 
 	

</div></div>
<?php include 'includes/overall/footer.php'; ?>