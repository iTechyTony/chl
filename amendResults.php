<?php
	include 'core/init.php';
	protect_page ();
	admin_protect ();
	include 'includes/overall/header.php';
?>

	<div class = "panel panel-primary">
	<div class = "panel-heading">
              <h3 class = "panel-title">Results</h3>
            </div>
            <div class = "panel-body">
<?php
	if ( isset( $_GET[ 'success' ] ) === true && empty( $_GET[ 'success' ] ) === true )
	{
		echo '<div class="alert alert-success"><h2>You\'ve Successfully Added Competitor Results!</h2></div>';
	}
	else if ( ( isset( $_GET[ 'removeResult' ] ) === true && empty( $_GET[ 'removeResult' ] ) === false ) )
	{
		$unique_id = $_GET[ 'removeResult' ];
		delete ( $unique_id , results );
		echo '<div class="alert alert-success"><h2>You have successfully deleted Competitor!</h2> </div>';
	}
?>


	            <form role = "form" method = "get" action = "amendResults.php">
  <button type = "submit" value = "add" name = "menu" class = "btn btn-primary">Add Results</button>
  <button type = "submit" value = "update" name = "menu" class = "btn btn-primary">Update Results</button>
  <button type = "submit" value = "delete" name = "menu" class = "btn btn-primary">Delete Results</button>
</form>


	            <?php
		            $id = $_GET[ 'menu' ];
		            switch ( $id )
		            {
			            case 'add':
				            echo '<br>';
				            if ( empty( $_POST ) === false )
				            {
					            $required_fields = array ( 'rider' , 'gender' );
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
				            if ( empty( $_POST ) === false && empty( $errors ) === true )
				            {
					            for ( $i = 1 ; $i <= 18 ; $i ++ )
					            {
						            $total = $_POST[ $i ] + $total;
					            }
					            $values = array ( 'Rider' => $_POST[ 'rider' ] , 'gender' => $_POST[ 'gender' ] , 'Points' => $total , '1' => $_POST[ '1' ] , '2' => $_POST[ '2' ] , '3' => $_POST[ '3' ] , '4' => $_POST[ '4' ] , '5' => $_POST[ '5' ] , '6' => $_POST[ '6' ] , '7' => $_POST[ '7' ] , '8' => $_POST[ '8' ] , '9' => $_POST[ '9' ] , '10' => $_POST[ '10' ] , '11' => $_POST[ '11' ] , '12' => $_POST[ '12' ] , '13' => $_POST[ '13' ] , '14' => $_POST[ '14' ] , '15' => $_POST[ '15' ] , '16' => $_POST[ '16' ] , '17' => $_POST[ '17' ] , '18' => $_POST[ '18' ] );
					            insert ( $values , results );
					            header ( 'Location: amendResults.php?success' );
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
    <label for="rider" class="col-sm-2 control-label">Rider Name*</label>
    <div class="col-sm-3">
      <input type="text" name="rider" class="form-control" id="rider" value="">
    </div>
  </div>

    <div class="form-group">
    <label for="gender" class="col-sm-2 control-label">Gender*</label>
    <div class="col-sm-3">
     
        <select class="form-control" name="gender" id="gender">
          <option value="">Select Your Gender</option>
          <option value="male">Male</option>
          <option value="female">Female</option>
        </select>

    </div>
    </div>';
				            for ( $i = 1 ; $i <= 18 ; $i ++ )
				            {
					            echo '<div class="form-group">
    <label for="' . $i . '" class="col-sm-2 control-label">Point ' . $i . '</label>
    <div class="col-sm-3">
      <input type="text" name="' . $i . '" class="form-control" id="' . $i . '" value="' . $row[ $i ] . '">
    </div>
  </div>';
				            }
				            echo '  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-success">Add Result</button>
    </div>
  </div>
   </div>
    </div>
	</form>';
				            break;
			            case 'delete':
				            $data = $_POST[ 'search' ];
				            $searching = "WHERE Rider LIKE '%$data%'";
				            $sort = $_POST[ 'sort' ];
				            $query = mysql_query ( "SELECT * FROM results $searching $sort" );
				            echo '<hr>';
				            echo '<div class="bs-example">
    <nav class="navbar navbar-default" role="navigation">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Filter Competitors</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">

     
          </ul>
          <form class="navbar-form navbar-left" role="search" action="amendResults.php?menu=delete" method="post">
            <div class="form-group">
              <input class="form-control" name="search"  placeholder="Search" type="text">
            </div>
            <button type="submit" class="btn btn-success">Search</button>
            <button type="submit" value="ORDER BY Points" name="sort"  class="btn btn-success">Highest Score</button>
             <button type="submit" value="ORDER BY Points DESC" name="sort" class="btn btn-success">Lowest Score</button>
          </form>
          <ul class="nav navbar-nav navbar-right">
                      
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  </div>';
				            echo '	<div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Competitor</th>
          <th>Points</th>
          <th>Gender</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>';
				            while ( ( $row = mysql_fetch_assoc ( $query ) ) )
				            {
					            echo ' <tr>';
					            echo ' <td>' . $row[ 'Rider' ] . '</td>';
					            echo ' <td>' . $row[ 'Points' ] . '</td>';
					            echo ' <td>' . $row[ 'gender' ] . '</td>';
					            echo '<td><a href="amendResults.php?removeResult=' . $row[ 'id' ] . '">Delete</a></td>';
					            echo ' </tr>';
				            }
				            echo '</tbody>
    </table>
  </div>';
				            break;
			            case 'update':
				            echo '<br>';
				            echo '
	         	<h1>Ladies\' Competition</h1>
        <div class="table-responsive">    	
       <table class="table table-bordered">
        <thead>
          <tr>
            <th>Pos</th>
            <th>Rider</th>
            <th>Points</th>
    ';
				            for ( $i = 1 ; $i <= 18 ; $i ++ )
				            {
					            echo '<th>' . $i . '</th>';
				            }
				            echo '  <th>Edit</th>
          </tr>
        </thead>
        <tbody>';
				            $query = mysql_query ( "SELECT * FROM results WHERE gender='female' order by Points DESC" );
				            $womenPos = 1;
				            while ( ( $row = mysql_fetch_assoc ( $query ) ) )
				            {
					            echo ' <tr>';
					            echo ' <td>' . $womenPos ++ . '</td>';
					            echo ' <td>' . $row[ 'Rider' ] . '</td>';
					            echo ' <td>' . $row[ 'Points' ] . '</td>';
					            for ( $i = 1 ; $i <= 18 ; $i ++ )
					            {
						            echo ' <td>' . $row[ $i ] . '</td>';
					            }
					            echo '<td><a href="edit_results.php?id=' . $row[ 'id' ] . '">Edit</a></td>';
					            echo ' </tr>';
				            }
				            echo '   </tbody>
      </table>
</div>

          	<h1>Mens\' Competition</h1>
        <div class="table-responsive">    	
       <table class="table table-bordered">
        <thead>
          <tr>
            <th>Pos</th>
            <th>Rider</th>
            <th>Points</th>';
				            for ( $i = 1 ; $i <= 18 ; $i ++ )
				            {
					            echo '<th>' . $i . '</th>';
				            }
				            echo '    <th>Edit</th>
          </tr>
        </thead>
        <tbody>';
				            $query = mysql_query ( "SELECT * FROM results WHERE gender='male' order by Points DESC" );
				            $menPos = 1;
				            while ( ( $row = mysql_fetch_assoc ( $query ) ) )
				            {
					            echo ' <tr>';
					            echo ' <td>' . $menPos ++ . '</td>';
					            echo ' <td>' . $row[ 'Rider' ] . '</td>';
					            echo ' <td>' . $row[ 'Points' ] . '</td>';
					            for ( $i = 1 ; $i <= 18 ; $i ++ )
					            {
						            echo ' <td>' . $row[ $i ] . '</td>';
					            }
					            echo '<td><a href="edit_results.php?id=' . $row[ 'id' ] . '">Edit</a></td>';
					            echo ' </tr>';
				            }
				            echo ' </tbody>
      </table>
</div>
	';
				            break;
			            default:
				            break;
		            }
	            ?>
 
 	

</div></div>
<?php include 'includes/overall/footer.php'; ?>