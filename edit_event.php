<?php
	include 'core/init.php';
	protect_page ();
	admin_protect ();
	include 'includes/overall/header.php';
	$id = $_GET[ id ];
	$query = mysql_query ( "SELECT * FROM events WHERE id='$id'" );
	$row = mysql_fetch_assoc ( $query );
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
?>

<?php
	if ( empty( $_POST ) === false && empty( $errors ) === true )
	{
		$given = $_POST[ 'date' ];
		$date = date_create ( $_POST[ 'date' ] );
		$new_date = date_format ( $date , 'Y-m-d' );
		$update_data = array ( 'title' => $_POST[ 'title' ] , 'event_date' => $new_date , 'type' => $_POST[ 'type' ] , 'details' => $_POST[ 'details' ] , 'distance' => $_POST[ 'distance' ] , 'description' => $_POST[ 'description' ] );
		update_data ( $id , $update_data , events );
		header ( 'Location: amendEvents.php?menu=update ' );
		exit();
	}
	else if ( empty( $errors ) === false )
	{
		echo '<div class="alert alert-danger">' . output_errors ( $errors ) . '</div>';
	}
?>

	<div class = "panel panel-primary">
	<div class = "panel-heading">
              <h3 class = "panel-title">Update <?php echo $row[ 'title' ]; ?> Event</h3>
            </div>
            <div class = "panel-body">
	
	<form action = "" method = "post" class = "form-horizontal" role = "form">
		<div class = "row">
			<div class = "col-xs-9">
<div class = "form-group">
    <label for = "title" class = "col-sm-3 control-label">Event Title*</label>
    <div class = "col-sm-7">
      <input type = "text" name = "title" class = "form-control" id = "title" value = "<?php echo $row[ 'title' ]; ?>">
    </div>
  </div>


  <div class = "form-group">
    <label for = "datepicker" class = "col-sm-3 control-label">Date*</label>
    <div class = "col-sm-7">
      <input type = "text" name = "date" class = "form-control" id = "datepicker" value = "<?php echo $row[ 'event_date' ]; ?>">
    </div>
    </div>

  <div class = "form-group">
    <label for = "type" class = "col-sm-3 control-label">Type*</label>
    <div class = "col-sm-7">
     
        <select class = "form-control" name = "type" id = "type">
          <option value = "<?php echo $row[ 'type' ]; ?>"><?php echo $row[ 'type' ]; ?>*</option>
          <option value = "timetrial">Time Trials</option>
          <option value = "sportive"> Sportive</option>
          <option value = "races">Races</option>
        </select>

    </div>
    </div>


  <div class = "form-group">
    <label for = "details" class = "col-sm-3 control-label">Details*</label>
    <div class = "col-sm-7">
      <input type = "text" name = "details" class = "form-control" id = "details" value = "<?php echo $row[ 'details' ]; ?>">
    </div>
  </div>			

  <div class = "form-group">
    <label for = "distance" class = "col-sm-3 control-label">Distance*</label>
    <div class = "col-sm-7">
      <input type = "text" name = "distance" class = "form-control" id = "distance" value = "<?php echo $row[ 'distance' ]; ?>">
    </div>
  </div>		


 <div class = "form-group">
    <label for = "description" class = "col-sm-3 control-label">Description*</label>
    <div class = "col-sm-7">
      <textarea name = "description" class = "form-control" id = "description" rows = "4"><?php echo $row[ 'description' ]; ?></textarea>
    </div>
  </div>		
  

  <div class = "form-group">
    <div class = "col-sm-offset-3 col-sm-10">
      <button type = "submit" class = "btn btn-success">Update</button>
    </div>
  </div>
   </div>
    </div>
	</form>         

</div></div>
<?php include 'includes/overall/footer.php'; ?>