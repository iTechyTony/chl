<?php
	include 'core/init.php';
	include 'includes/overall/header.php';
?>

	<div class = "panel panel-primary">
	<div class = "panel-heading">
              <h3 class = "panel-title">News</h3>
            </div>
            <div class = "panel-body">
            	<div class = "row">
            		  <div class = "col-md-4">
            		  	
    <div class = "list-group">
    	<?php
		    $query = mysql_query ( "SELECT * FROM news " );
		    while ( ( $row = mysql_fetch_assoc ( $query ) ) )
		    {
			    $date = date_create ( $row[ 'date' ] );
			    $new_date = date_format ( $date , 'd M Y' );
			    echo ' <a href="news.php?id=' . $row[ 'id' ] . '" class="list-group-item">' . $row[ 'title' ] . '<br>' . $new_date . '</a>';
		    }
	    ?>
   
    </div>
  
            		  </div>
  <div class = "col-md-8">
  	<?php
	    if ( isset( $_GET[ 'id' ] ) )
	    {
		    $uid = $_GET[ 'id' ];
		    switch ( $uid )
		    {
			    case $uid:
				    $query = mysql_query ( "SELECT * FROM news WHERE id ='$uid' order by date LIMIT 0, 30" );
				    $row = mysql_fetch_assoc ( $query );
				    $date = date_create ( $row[ 'date' ] );
				    $new_date = date_format ( $date , 'D j M Y' );
				    echo '<h1>' . $row[ 'title' ] . '</h1>';
				    echo '<h5>' . $new_date . '</h5>';
				    echo '<div class="pull-right"><img src="images/db_images/news/' . $row[ 'img' ] . '" alt="' . $row[ 'img' ] . '" class="img-circle"></div>';
				    echo '<hp>' . $row[ 'news' ] . '</p>';
				    break;
			    default:
				    break;
		    }
	    }
	    else
	    {
		    $query = mysql_query ( "SELECT * FROM news order by date DESC" );
		    $row = mysql_fetch_assoc ( $query );
		    $date = date_create ( $row[ 'date' ] );
		    $new_date = date_format ( $date , 'D j M Y' );
		    echo '<h1>' . $row[ 'title' ] . '</h1>';
		    echo '<h5>' . $new_date . '</h5>';
		    echo '<div class="pull-right"><img src="images/db_images/news/' . $row[ 'img' ] . '" alt="' . $row[ 'img' ] . '" class="img-circle"></div>';
		    echo '<p>' . $row[ 'news' ] . '</p>';
	    }
    ?>

  </div>

</div>
            	
	

</div></div>
<?php include 'includes/overall/footer.php'; ?>