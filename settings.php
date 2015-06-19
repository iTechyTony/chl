<?php
	include 'core/init.php';
	protect_page ();
	include 'includes/overall/header.php';
	if ( empty( $_POST ) === false )
	{
		$required_fields = array ( 'first_name' , 'email' );
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
			if ( filter_var ( $_POST[ 'email' ] , FILTER_VALIDATE_EMAIL ) === false )
			{
				$errors[] = 'A valid email address is required';
			}
			else if ( email_exists ( $_POST[ 'email' ] ) === true && $user_data[ 'email' ] !== $_POST[ 'email' ] )
			{
				$errors[] = 'Sorry, the email \'' . $_POST[ 'email' ] . '\' is already in use';
			}
		}
	}
?>
<div class = "panel panel-primary">
	<div class = "panel-heading">
<h3 class = "panel-title">Settings</h3>
</div>

	<div class = "panel-body">

<?php
	if ( isset( $_GET[ 'success' ] ) === true && empty( $_GET[ 'success' ] ) === true )
	{
		echo '<div class="alert alert-success"><h2>Your details have been updated!</h2></div></div></div>';
	} else
	{
	if ( empty( $_POST ) === false && empty( $errors ) === true )
	{
		$update_data = array ( 'first_name' => $_POST[ 'first_name' ] , 'last_name' => $_POST[ 'last_name' ] , 'email' => $_POST[ 'email' ] , 'allow_email' => ( $_POST[ 'allow_email' ] == 'on' ) ? 1 : 0 );
		update_user ( $session_user_id , $update_data );
		header ( 'Location: settings.php?success' );
		exit();
	}
	else if ( empty( $errors ) === false )
	{
		echo '<div class="alert alert-danger">' . output_errors ( $errors ) . '</div>';
	}
?>

		<form action = "settings.php" method = "post" class = "form-horizontal" role = "form">
		<div class = "row">
			<div class = "col-xs-9">

  <div class = "form-group">
    <label for = "first_name" class = "col-sm-2 control-label">First name*</label>
    <div class = "col-sm-10">
      <input type = "text" name = "first_name" class = "form-control" id = "first_name" placeholder = "Enter First Name" value = "<?php echo $user_data[ 'first_name' ]; ?>">
    </div>
  </div>

  <div class = "form-group">
    <label for = "last_name" class = "col-sm-2 control-label">Last name</label>
    <div class = "col-sm-10">
      <input type = "text" name = "last_name" class = "form-control" id = "last_name" placeholder = "Enter Last Name" value = "<?php echo $user_data[ 'last_name' ]; ?>">
    </div>
    </div>

  <div class = "form-group">
    <label for = "email" class = "col-sm-2 control-label">Email*</label>
    <div class = "col-sm-10">
      <input type = "text" name = "email" class = "form-control" id = "email" placeholder = "Enter Email" value = "<?php echo $user_data[ 'email' ]; ?>">
    </div>
  </div>			
 
 <div class = "form-group">
        <div class = "col-sm-offset-2 col-sm-10">
          <div class = "checkbox">
            <label>
              <input type = "checkbox" name = "allow_email" <?php if ( $user_data[ 'allow_email' ] == 1 )
              {
	              echo 'checked="checked"';
              } ?>> Would you like to receive email from us?
            </label>
          </div>
        </div>
      </div>
 
 <div class = "form-group">
    <div class = "col-sm-offset-2 col-sm-10">
      <button type = "submit" class = "btn btn-success">Update</button>
    </div>
  </div>
   </div>
    </div>
	</form>
</div></div>
<?php
	}
	include 'includes/overall/footer.php';
?>
