<?php
	include 'core/init.php';
	include 'includes/overall/header.php';
	logged_in_redirect ();
	if ( empty( $_POST ) === false )
	{
		$username = $_POST[ 'username' ];
		$password = $_POST[ 'password' ];
		if ( empty( $username ) === true || empty( $password ) === true )
		{
			$errors[] = 'You need to enter a username and password';
		}
		else if ( user_exists ( $username ) === false )
		{
			$errors[] = 'We can\'t find that username. Have you registered?';
		}
		else if ( user_active ( $username ) === false )
		{
			$errors[] = 'You haven\'t activated your account!';
		}
		else
		{
			if ( strlen ( $password ) > 32 )
			{
				$errors[] = 'Password too long';
			}
			$login = login ( $username , $password );
			if ( $login === false )
			{
				$errors[] = 'That username/password combination is incorrect';
			}
			else
			{
				$_SESSION[ 'user_id' ] = $login;
				header ( 'Location: index.php' );
				exit();
			}
		}
	}
	else
	{
		$errors[] = 'No data received';
	}
	if ( empty( $errors ) === false )
	{
		?>

		<form action = "login.php" method = "post"  class = "form-signin" role = "form">
		<div class = "panel panel-primary">
		<div class = "panel-heading">
			<h3 class = "panel-title">Please Sign In</h3>
		</div>
		<div class = "panel-body">
		<h2 class = "form-signin-heading"></h2>
		<input type = "text" name = "username" class = "form-control" placeholder = "Username" required autofocus>
		<input type = "password" name = "password" class = "form-control" placeholder = "Password" required>
		<button class = "btn btn-lg btn-info btn-block" type = "submit">
				Sign In
			</button>

		<br>
		<div class = "alert alert-dismissable alert-info">
	<ul>
				<li>
					<a href = "register.php">Sign Up</a>
				</li>
				<li>
					Forgotten your <a href = "recover.php?mode=username">username</a> or <a href = "recover.php?mode=password">password</a>?
				</li>
			</ul>			
</div>
		<?php
		if ( empty( $_POST ) === false )
		{
			echo '<div class="alert alert-danger">We tried to log you in, but...';
			echo output_errors ( $errors ) . '</div>';
		}
	}
?>
	</div></div>
	</form>

<?php
	include 'includes/overall/footer.php';
?>