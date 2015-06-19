<?php
	include 'core/init.php';
	protect_page ();
	admin_protect ();
	include 'includes/overall/header.php';
	$id = $_GET[ id ];
	$query = mysql_query ( "SELECT * FROM users WHERE user_id='$id'" );
	$row = mysql_fetch_assoc ( $query );
?>
	<div class = "panel panel-primary">
	<div class = "panel-heading">
              <h3 class = "panel-title">Update <?php echo $row[ 'first_name' ] . ' ' . $row[ 'last_name' ]; ?></h3>
            </div>
            <div class = "panel-body">
            	
<?php
	if ( empty( $_POST ) === false )
	{
		$required_fields = array ( 'username' , 'first_name' , 'email' );
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
			if ( preg_match ( "/\\s/" , $_POST[ 'username' ] ) == true )
			{
				$errors[] = 'Your username must not contain any spaces.';
			}
			if ( filter_var ( $_POST[ 'email' ] , FILTER_VALIDATE_EMAIL ) === false )
			{
				$errors[] = 'A valid email address is required';
			}
		}
	}
	if ( empty( $_POST ) === false && empty( $errors ) === true )
	{
		$update_data = array ( 'username' => $_POST[ 'username' ] , 'first_name' => $_POST[ 'first_name' ] , 'last_name' => $_POST[ 'last_name' ] , 'type' => $_POST[ 'type' ] , 'active' => $_POST[ 'active' ] , 'allow_email' => $_POST[ 'allow_email' ] , 'email' => $_POST[ 'email' ] );
		update_user_data ( $id , $update_data , users );
		header ( 'Location: amendUsers.php?menu=update ' );
		exit();
	}
	else if ( empty( $errors ) === false )
	{
		echo '<div class="alert alert-danger">' . output_errors ( $errors ) . '</div>';
	}
?>


	            <form action = "" method = "post" class = "form-horizontal" role = "form">
		<div class = "row">
			<div class = "col-xs-9">
	<div class = "form-group">
    <label for = "Username" class = "col-sm-3 control-label">Username*</label>
    <div class = "col-sm-7">
      <input type = "text" name = "username" class = "form-control" id = "Username" value = "<?php echo $row[ 'username' ]; ?>">
     
    </div>
  </div>

  <input type = "hidden" name = "user_id" class = "form-control" id = "user_id" value = "<?php echo $row[ 'user_id' ]; ?>">

  <div class = "form-group">
    <label for = "first_name" class = "col-sm-3 control-label">First name*</label>
    <div class = "col-sm-7">
      <input type = "text" name = "first_name" class = "form-control" id = "first_name" value = "<?php echo $row[ 'first_name' ]; ?>">
    </div>
  </div>


  <div class = "form-group">
    <label for = "last_name" class = "col-sm-3 control-label">Last name</label>
    <div class = "col-sm-7">
      <input type = "text" name = "last_name" class = "form-control" id = "last_name" value = "<?php echo $row[ 'last_name' ]; ?>">
    </div>
    </div>



  <div class = "form-group">
    <label for = "email" class = "col-sm-3 control-label">Email*</label>
    <div class = "col-sm-7">
      <input type = "text" name = "email" class = "form-control" id = "email" value = "<?php echo $row[ 'email' ]; ?>">
    </div>
  </div>				

  <div class = "form-group">
    <label for = "type" class = "col-sm-3 control-label">Permissions*</label>
    <div class = "col-sm-3">
     
        <select class = "form-control" name = "type" id = "type">
          <option value = "<?php echo $row[ 'type' ]; ?>"><?php if ( $row[ 'type' ] == 1 )
	          {
		          echo 'Admin';
	          }
	          else
	          {
		          echo 'Standard User';
	          } ?></option>
          <option value = "<?php if ( $row[ 'type' ] == 0 )
          {
	          echo 1;
          }
          else
          {
	          echo 0;
          } ?>"><?php if ( $row[ 'type' ] == 0 )
	          {
		          echo 'Admin';
	          }
	          else
	          {
		          echo 'Standard User';
	          } ?></option>
        </select>

    </div>
    </div>

 <div class = "form-group">
    <label for = "active" class = "col-sm-3 control-label">Activated*</label>
    <div class = "col-sm-4">
     
        <select class = "form-control" name = "active" id = "active">
          <option value = "<?php echo $row[ 'active' ]; ?>"><?php if ( $row[ 'active' ] == 1 )
	          {
		          echo 'Activate';
	          }
	          else
	          {
		          echo 'Deactivate';
	          } ?></option>
          <option value = "<?php if ( $row[ 'active' ] == 0 )
          {
	          echo 1;
          }
          else
          {
	          echo 0;
          } ?>"><?php if ( $row[ 'active' ] == 0 )
	          {
		          echo 'Activate';
	          }
	          else
	          {
		          echo 'Deactivate';
	          } ?></option>
        </select>

    </div>
    </div>
    
 <div class = "form-group">
    <label for = "allow_email" class = "col-sm-3 control-label">Receive Email*</label>
    <div class = "col-sm-4">
     
        <select class = "form-control" name = "allow_email" id = "allow_email">
          <option value = "<?php echo $row[ 'allow_email' ]; ?>"><?php if ( $row[ 'allow_email' ] == 1 )
	          {
		          echo 'Yes';
	          }
	          else
	          {
		          echo 'No';
	          } ?></option>
          <option value = "<?php if ( $row[ 'allow_email' ] == 0 )
          {
	          echo 1;
          }
          else
          {
	          echo 0;
          } ?>"><?php if ( $row[ 'allow_email' ] == 0 )
	          {
		          echo 'Yes';
	          }
	          else
	          {
		          echo 'No';
	          } ?></option>
        </select>

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