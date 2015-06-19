<?php
	include 'core/init.php';
	include 'includes/overall/header.php';
	if ( isset( $_GET[ 'username' ] ) === true && empty( $_GET[ 'username' ] ) === false )
	{
		$username = $_GET[ 'username' ];
		if ( user_exists ( $username ) === true )
		{
			$user_id = user_id_from_username ( $username );
			$profile_data = user_data ( $user_id , 'first_name' , 'last_name' , 'email' );
			?>
			<div class = "panel panel-primary">
			<div class = "panel-heading">
              <h3 class = "panel-title"><?php echo $profile_data[ 'first_name' ]; ?>'s Profile</h3>
            </div>
			<div class = "panel-body">

			<p><?php echo $profile_data[ 'email' ]; ?></p>
<div class = "row">
  <div class = "col-xs-6 col-md-6">
	
		
					<?php
						if ( isset( $_FILES[ 'profile' ] ) === true )
						{
							if ( empty( $_FILES[ 'profile' ][ 'name' ] ) === true )
							{
								echo 'Please choose a file!';
							}
							else
							{
								$allowed = array ( 'jpg' , 'jpeg' , 'gif' , 'png' );
								$file_name = $_FILES[ 'profile' ][ 'name' ];
								$file_extn = strtolower ( end ( explode ( '.' , $file_name ) ) );
								$file_temp = $_FILES[ 'profile' ][ 'tmp_name' ];
								if ( in_array ( $file_extn , $allowed ) === true )
								{
									change_profile_image ( $session_user_id , $file_temp , $file_extn );
									header ( 'Location: ' . $current_file );
									exit();
								}
								else
								{
									echo 'Incorrect file type. Allowed: ';
									echo implode ( ', ' , $allowed );
								}
							}
						}
						if ( empty( $user_data[ 'profile' ] ) === false )
						{
							echo '<div class="thumbnail"><img src="' , $user_data[ 'profile' ] , '" alt="' , $user_data[ 'first_name' ] , '\'s Profile Image"></div>';
							echo '	<form action="" method="post" enctype="multipart/form-data" class="form-horizontal" role="form">
				<input type="file" name="profile" > <button class="btn btn-primary" type="submit">
				Submit
			</button>
			</form>';
						}
					?>
			
</div></div>
			<?php
		}
		else
		{
			echo 'Sorry, that user doesn\'t exist!';
		}
	}
	else
	{
		header ( 'Location: index.php' );
		exit();
	}
	echo '</div></div>';
	include 'includes/overall/footer.php'; ?>