<?php
	include 'core/init.php';
	logged_in_redirect ();
	include 'includes/overall/header.php';
	if ( empty( $_POST ) === false )
	{
		$required_fields = array ( 'username' , 'password' , 'password_again' , 'first_name' , 'email' );
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
			if ( user_exists ( $_POST[ 'username' ] ) === true )
			{
				$errors[] = 'Sorry, the username \'' . $_POST[ 'username' ] . '\' is already taken';
			}
			if ( preg_match ( "/\\s/" , $_POST[ 'username' ] ) == true )
			{
				$errors[] = 'Your username must not contain any spaces.';
			}
			if ( strlen ( $_POST[ 'password' ] ) < 6 )
			{
				$errors[] = 'Your password must be at least 6 characters';
			}
			if ( $_POST[ 'password' ] !== $_POST[ 'password_again' ] )
			{
				$errors[] = 'Your passwords do not match';
			}
			if ( filter_var ( $_POST[ 'email' ] , FILTER_VALIDATE_EMAIL ) === false )
			{
				$errors[] = 'A valid email address is required';
			}
			if ( email_exists ( $_POST[ 'email' ] ) === true )
			{
				$errors[] = 'Sorry, the email \'' . $_POST[ 'email' ] . '\' is already in use';
			}
		}
	}
?>

	<div class = "panel panel-primary">
	<div class = "panel-heading">
		<h3 class = "panel-title">Sign Up</h3>
	</div>
	<div class = "panel-body">

<?php
	if ( isset( $_GET[ 'success' ] ) === true && empty( $_GET[ 'success' ] ) === true )
	{
		echo '<div class="alert alert-success"><h2>You\'ve been registered successfully! Please check your email to activate your account.</h2> </div></div></div>';
	}
	else
	{
		if ( empty( $_POST ) === false && empty( $errors ) === true )
		{
			$register_data = array ( 'username' => $_POST[ 'username' ] , 'password' => $_POST[ 'password' ] , 'first_name' => $_POST[ 'first_name' ] , 'last_name' => $_POST[ 'last_name' ] , 'email' => $_POST[ 'email' ] , 'email_code' => md5 ( $_POST[ 'username' ] + microtime () ) );
			register_user ( $register_data );
			header ( 'Location: register.php?success' );
			exit();
		}
		else if ( empty( $errors ) === false )
		{
			echo '<div class="alert alert-danger">' . output_errors ( $errors ) . '</div>';
		}
		?>


		<form action = "register.php" method = "post" class = "form-horizontal" role = "form">
		<div class = "row">
			<div class = "col-xs-9">
		<div class = "form-group">
    <label for = "Username" class = "col-sm-3 control-label">Username*</label>
    <div class = "col-sm-7">
      <input type = "text" name = "username" class = "form-control" id = "Username" placeholder = "Choose Username" value = "<?php if ( isset( $_POST[ 'username' ] ) )
      {
	      echo $_POST[ 'username' ];
      } ?>">
    </div>
  </div>

		
 <div class = "form-group">
    <label for = "Password" class = "col-sm-3 control-label">Password*</label>
    <div class = "col-sm-7">
      <input type = "password" name = "password" class = "form-control" id = "Password" placeholder = "Create Password" value = "<?php if ( isset( $_POST[ 'password' ] ) )
      {
	      echo $_POST[ 'password' ];
      } ?>">
    </div>
  </div>


 <div class = "form-group">
    <label for = "Password1" class = "col-sm-3 control-label">Verify*</label>
    <div class = "col-sm-7">
      <input type = "password" name = "password_again" class = "form-control" id = "Password1" placeholder = "Confirm Password" value = "<?php if ( isset( $_POST[ 'password_again' ] ) )
      {
	      echo $_POST[ 'password_again' ];
      } ?>">
    </div>
  </div>

  <div class = "form-group">
    <label for = "first_name" class = "col-sm-3 control-label">First name*</label>
    <div class = "col-sm-7">
      <input type = "text" name = "first_name" class = "form-control" id = "first_name" placeholder = "Enter First Name" value = "<?php if ( isset( $_POST[ 'first_name' ] ) )
      {
	      echo $_POST[ 'first_name' ];
      } ?>">
    </div>
  </div>


  <div class = "form-group">
    <label for = "last_name" class = "col-sm-3 control-label">Last name</label>
    <div class = "col-sm-7">
      <input type = "text" name = "last_name" class = "form-control" id = "last_name" placeholder = "Enter Last Name" value = "<?php if ( isset( $_POST[ 'last_name' ] ) )
      {
	      echo $_POST[ 'last_name' ];
      } ?>">
    </div>
    </div>



  <div class = "form-group">
    <label for = "email" class = "col-sm-3 control-label">Email*</label>
    <div class = "col-sm-7">
      <input type = "text" name = "email" class = "form-control" id = "email" placeholder = "Enter Email" value = "<?php if ( isset( $_POST[ 'email' ] ) )
      {
	      echo $_POST[ 'email' ];
      } ?>">
    </div>
  </div>			
 

  <div class = "form-group">
    <div class = "col-sm-offset-3 col-sm-10">
      <button type = "submit" class = "btn btn-success">Register</button>
    </div>
  </div>
   </div>
    </div>
	</form>

		</div></div>
		<?php
	}
	include 'includes/overall/footer.php'; ?>