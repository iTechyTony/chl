<?php
	include 'core/init.php';
	protect_page ();
	admin_protect ();
	include 'includes/overall/header.php';
?>

	<div class = "panel panel-primary">
	<div class = "panel-heading">
              <h3 class = "panel-title">Users</h3>
            </div>
            <div class = "panel-body">
<?php
	if ( isset( $_GET[ 'success' ] ) === true && empty( $_GET[ 'success' ] ) === true )
	{
	}
	elseif ( ( isset( $_GET[ 'removeUser' ] ) === true && empty( $_GET[ 'removeUser' ] ) === false ) )
	{
		$unique_id = $_GET[ 'removeUser' ];
		deleteUser ( $unique_id , users );
		echo '<div class="alert alert-success"><h2>You have successfully deleted User</h2> </div>';
	}
?>


	            <form role = "form" method = "get" action = "amendUsers.php">

  <button type = "submit" value = "update" name = "menu" class = "btn btn-primary">Edit USER Details</button>
  <button type = "submit" value = "delete" name = "menu" class = "btn btn-primary">Delete USER</button>

</form>


	            <?php
		            $id = $_GET[ 'menu' ];
		            switch ( $id )
		            {
			            case 'update':
				            $query = mysql_query ( "SELECT * FROM users " );
				            echo '<br>';
				            echo '	<div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Username</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Email</th>
          <th>Active</th>
          <th>Admin</th>
          <th>Receive Email</th>
          <th>Edit Details</th>
        </tr>
      </thead>
      <tbody>';
				            while ( ( $row = mysql_fetch_assoc ( $query ) ) )
				            {
					            if ( $row[ 'active' ] == 1 )
					            {
						            $active = "Yes";
					            }
					            else
					            {
						            $active = "No";
					            }
					            if ( $row[ 'type' ] == 1 )
					            {
						            $admin = "Yes";
					            }
					            else
					            {
						            $admin = "No";
					            }
					            if ( $row[ 'allow_email' ] == 1 )
					            {
						            $allow_email = "Yes";
					            }
					            else
					            {
						            $allow_email = "No";
					            }
					            echo ' <tr>';
					            echo ' <td>' . $row[ 'username' ] . '</td>';
					            echo ' <td>' . $row[ 'first_name' ] . '</td>';
					            echo ' <td>' . $row[ 'last_name' ] . '</td>';
					            echo ' <td>' . $row[ 'email' ] . '</td>';
					            echo ' <td>' . $active . '</td>';
					            echo ' <td>' . $admin . '</td>';
					            echo ' <td>' . $allow_email . '</td>';
					            echo '<td><a href="edit_user.php?id=' . $row[ 'user_id' ] . '">Edit</a></td>';
					            echo ' </tr>';
				            }
				            echo ' </tbody>
    </table>
  </div>';
				            break;
			            case 'delete':
				            $query = mysql_query ( "SELECT * FROM users" );
				            echo '<br>';
				            echo '	<div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>';
				            while ( ( $row = mysql_fetch_assoc ( $query ) ) )
				            {
					            echo ' <tr>';
					            echo ' <td>' . $row[ 'first_name' ] . '</td>';
					            echo ' <td>' . $row[ 'last_name' ] . '</td>';
					            echo '<td><a href="amendUsers.php?removeUser=' . $row[ 'user_id' ] . '">Delete</a></td>';
					            echo ' </tr>';
				            }
				            echo '</tbody>
    </table>
  </div>';
				            break;
			            default:
				            break;
		            }
	            ?>
 
 	

</div></div>
<?php include 'includes/overall/footer.php'; ?>