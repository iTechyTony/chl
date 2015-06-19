<?php
	include 'core/init.php';
	protect_page ();
	if ( empty( $_POST ) === false )
	{
		$required_fields = array ( 'current_password' , 'password' , 'password_again' );
		foreach ( $_POST as $key => $value )
		{
			if ( empty( $value ) && in_array ( $key , $required_fields ) === true )
			{
				$errors[] = 'Fields marked with an asterisk are required';
				break 1;
			}
		}
		if ( md5 ( $_POST[ 'current_password' ] ) === $user_data[ 'password' ] )
		{
			if ( trim ( $_POST[ 'password' ] ) !== trim ( $_POST[ 'password_again' ] ) )
			{
				$errors[] = 'Your new passwords do not match';
			}
			else if ( strlen ( $_POST[ 'password' ] ) < 6 )
			{
				$errors[] = 'Your password must be at least 6 characters';
			}
		}
		else
		{
			$errors[] = 'Your current password is incorrect';
		}
	}
	include 'includes/overall/header.php';
?>
	<div class = "panel panel-primary">
	<div class = "panel-heading">
		<h3 class = "panel-title">Change Password</h3>
	</div>
	<div class = "panel-body">

<?php
	if ( isset( $_GET[ 'success' ] ) === true && empty( $_GET[ 'success' ] ) === true )
	{
		echo '<div class="alert alert-success"><h2>Your password has been changed.</h2></div></div></div>';
	}
	else
	{
		if ( isset( $_GET[ 'force' ] ) === true && empty( $_GET[ 'force' ] ) === true )
		{
			?>
			<p>You must change your password now that you've requested.</p>
			<?php
		}
		if ( empty( $_POST ) === false && empty( $errors ) === true )
		{
			change_password ( $session_user_id , $_POST[ 'password' ] );
			header ( 'Location: changepassword.php?success' );
		}
		else if ( empty( $errors ) === false )
		{
			echo '<div class="alert alert-danger">' . output_errors ( $errors ) . '</div>';
		}
		?>


		<form action = "changepassword.php" method = "post" class = "form-horizontal" role = "form">
		<div class = "row">
			<div class = "col-xs-9">
 <div class = "form-group">
    <label for = "current_password" class = "col-sm-5 control-label">Current Password*</label>
    <div class = "col-sm-5">
      <input type = "password" name = "current_password" class = "form-control" id = "current_password" placeholder = "Enter Current Password">
    </div>
  </div>

		
 <div class = "form-group">
    <label for = "password" class = "col-sm-5 control-label">New Password*</label>
    <div class = "col-sm-5">
      <input type = "password" name = "password" class = "form-control" id = "password" placeholder = "Enter New Password">
    </div>
  </div>


 <div class = "form-group">
    <label for = "password_again" class = "col-sm-5 control-label">Verify*</label>
    <div class = "col-sm-5">
      <input type = "password" name = "password_again" class = "form-control" id = "password_again" placeholder = "Verify New Password">
    </div>
  </div>

 
 

  <div class = "form-group">
    <div class = "col-sm-offset-5 col-sm-10">
      <button type = "submit" class = "btn btn-success">Change password</button>
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