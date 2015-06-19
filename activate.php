<?php
	include 'core/init.php';
	logged_in_redirect ();
	include 'includes/overall/header.php';
	if ( isset( $_GET[ 'success' ] ) === true && empty( $_GET[ 'success' ] ) === true )
	{
		?>
		<div class = "panel panel-primary">
		<div class = "panel-heading">
<h3 class = "panel-title">Thanks, we've activated your account...</h3>
</div>

		<div class = "panel-body">

		<div class = "alert alert-success">You're free to log in!</div>

		<?php
	}
	else if ( isset( $_GET[ 'email' ] , $_GET[ 'email_code' ] ) === true )
	{
		$email = trim ( $_GET[ 'email' ] );
		$email_code = trim ( $_GET[ 'email_code' ] );
		if ( email_exists ( $email ) === false )
		{
			$errors[] = ' something went wrong, and we couldn\'t find that email address!';
		}
		else if ( activate ( $email , $email_code ) === false )
		{
			$errors[] = 'We had problems activating your account';
		}
		if ( empty( $errors ) === false )
		{
			?>
			<h3 class = "panel-title">Oops....</h3>
			</div>
			<div class = "panel-body">
		<div class = "alert alert-danger">
			<?php
			echo output_errors ( $errors ) . '</div>';
		}
		else
		{
			header ( 'Location: activate.php?success' );
			exit();
		}
	}
	else
	{
		header ( 'Location: index.php' );
		exit();
	}
	echo '</div></div>';
	include 'includes/overall/footer.php';
?>