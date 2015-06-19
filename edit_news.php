<?php
	include 'core/init.php';
	protect_page ();
	admin_protect ();
	include 'includes/overall/header.php';
	$id = $_GET[ id ];
	$query = mysql_query ( "SELECT * FROM news WHERE id='$id'" );
	$row = mysql_fetch_assoc ( $query );
	if ( empty( $_POST ) === false )
	{
		$required_fields = array ( 'title' , 'date' , 'news' );
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
		}
	}
?>

<?php
	if ( empty( $_POST ) === false && empty( $errors ) === true )
	{
		$given = $_POST[ 'date' ];
		$date = date_create ( $_POST[ 'date' ] );
		$new_date = date_format ( $date , 'Y-m-d' );
		$update_data = array ( 'title' => $_POST[ 'title' ] , 'date' => $new_date , 'news' => $_POST[ 'news' ] );
		update_data ( $id , $update_data , news );
		header ( 'Location: amendNews.php?menu=update ' );
		exit();
	}
	else if ( empty( $errors ) === false )
	{
		echo '<div class="alert alert-danger">' . output_errors ( $errors ) . '</div>';
	}
?>

	<div class = "panel panel-primary">
	<div class = "panel-heading">
              <h3 class = "panel-title">Update <?php echo $row[ 'title' ]; ?></h3>
            </div>
            <div class = "panel-body">
	
	<form action = "" method = "post" class = "form-horizontal" role = "form">
		<div class = "row">
			<div class = "col-xs-9">
<div class = "form-group">
    <label for = "title" class = "col-sm-3 control-label">News Title*</label>
    <div class = "col-sm-7">
      <input type = "text" name = "title" class = "form-control" id = "title" value = "<?php echo $row[ 'title' ]; ?>">
    </div>
  </div>


  <div class = "form-group">
    <label for = "date" class = "col-sm-3 control-label">Date*</label>
    <div class = "col-sm-7">
      <input type = "text" name = "date" class = "form-control" id = "datepicker" value = "<?php echo $row[ 'date' ]; ?>">
    </div>
    </div>


 <div class = "form-group">
    <label for = "news" class = "col-sm-3 control-label">News*</label>
    <div class = "col-sm-7">
      <textarea name = "news" class = "form-control" id = "news" rows = "15"><?php echo $row[ 'news' ]; ?></textarea>
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