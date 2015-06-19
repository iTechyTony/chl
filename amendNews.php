<?php
	include 'core/init.php';
	protect_page ();
	admin_protect ();
	include 'includes/overall/header.php';
?>

	<div class = "panel panel-primary">
	<div class = "panel-heading">
              <h3 class = "panel-title">News</h3>
            </div>
            <div class = "panel-body">
<?php
	if ( isset( $_GET[ 'success' ] ) === true && empty( $_GET[ 'success' ] ) === true )
	{
		echo '<div class="alert alert-success"><h2>You have successfully added a News</h2> </div>';
	}
	elseif ( ( isset( $_GET[ 'removeNews' ] ) === true && empty( $_GET[ 'removeNews' ] ) === false ) )
	{
		$unique_id = $_GET[ 'removeNews' ];
		delete ( $unique_id , news );
		echo '<div class="alert alert-success"><h2>You have successfully deleted News</h2> </div>';
	}
?>


	            <form role = "form" method = "get" action = "amendNews.php">
  <button type = "submit" value = "add" name = "menu" class = "btn btn-primary">Add News</button>
  <button type = "submit" value = "update" name = "menu" class = "btn btn-primary">Update News</button>
  <button type = "submit" value = "delete" name = "menu" class = "btn btn-primary">Delete News</button>

</form>


	            <?php
		            $id = $_GET[ 'menu' ];
		            switch ( $id )
		            {
			            case 'add':
				            echo '<br>';
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
				            }
				            if ( empty( $_POST ) === false && empty( $errors ) === true )
				            {
					            $given = $_POST[ 'date' ];
					            $date = date_create ( $_POST[ 'date' ] );
					            $new_date = date_format ( $date , 'Y-m-d' );
					            $values = array ( 'title' => $_POST[ 'title' ] , 'date' => $new_date , 'news' => $_POST[ 'news' ] );
					            insert ( $values , news );
					            header ( 'Location: amendNews.php?success' );
					            exit();
				            }
				            else if ( empty( $errors ) === false )
				            {
					            echo '<div class="alert alert-danger">' . output_errors ( $errors ) . '</div>';
				            }
				            echo '<form action="" method="post" class="form-horizontal" role="form">
		<div class="row">
			<div class="col-xs-9">
<div class="form-group">
    <label for="title" class="col-sm-3 control-label">News Title*</label>
    <div class="col-sm-7">
      <input type="text" name="title" class="form-control" id="title" value="">
    </div>
  </div>


  <div class="form-group">
    <label for="date" class="col-sm-3 control-label">Date*</label>
    <div class="col-sm-7">
      <input type="text" name="date" class="form-control" id="datepicker" value="">
    </div>
    </div>


 <div class="form-group">
    <label for="news" class="col-sm-3 control-label">News*</label>
    <div class="col-sm-7">
      <textarea name="news" class="form-control" id="news" rows="15"  ></textarea>
    </div>
  </div>		
  

  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-10">
      <button type="submit" class="btn btn-success">Add News</button>
    </div>
  </div>
   </div>
    </div>
	</form> ';
				            break;
			            case 'update':
				            $query = mysql_query ( "SELECT * FROM news order by date DESC" );
				            echo '<br>';
				            echo '	<div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Heading</th>
          <th>Date</th>
          <th>Update</th>
        </tr>
      </thead>
      <tbody>';
				            while ( ( $row = mysql_fetch_assoc ( $query ) ) )
				            {
					            $date = date_create ( $row[ 'date' ] );
					            echo ' <tr>';
					            echo ' <td>' . $row[ 'title' ] . '</td>';
					            echo ' <td>' . date_format ( $date , 'jS-F-Y' ) . '</td>';
					            echo '<td><a href="edit_news.php?id=' . $row[ 'id' ] . '">Update</a></td>';
					            echo ' </tr>';
				            }
				            echo ' </tbody>
    </table>
  </div>';
				            break;
			            case 'delete':
				            $query = mysql_query ( "SELECT * FROM news order by date DESC" );
				            echo '<br>';
				            echo '	<div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Heading</th>
          <th>Date</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>';
				            while ( ( $row = mysql_fetch_assoc ( $query ) ) )
				            {
					            $date = date_create ( $row[ 'date' ] );
					            echo ' <tr>';
					            echo ' <td>' . $row[ 'title' ] . '</td>';
					            echo ' <td>' . date_format ( $date , 'jS-F-Y' ) . '</td>';
					            echo '<td><a href="amendNews.php?removeNews=' . $row[ 'id' ] . '">Delete</a></td>';
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