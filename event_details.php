<?php
	include 'core/init.php';
	include 'includes/overall/header.php';
	$id = $_GET[ 'id' ];
	$query = mysql_query ( "SELECT * FROM events WHERE id='$id'" );
	$row = mysql_fetch_assoc ( $query );
?>

	<div class = "panel panel-primary">
	<div class = "panel-heading">
              <h3 class = "panel-title"><?php echo $row[ 'title' ]; ?></h3>
            </div>
            <div class = "panel-body">
            	
           <?php
	           $date = date_create ( $row[ 'event_date' ] );
	           $new_date = date_format ( $date , 'D j M Y' );
	           echo '<div class="row">';
	           echo '<div class="col-xs-12 col-md-6">';
	           echo '<h3>Date : <kbd>' . $new_date . '</kbd></h3>';
	           echo '<h3>Details : <kbd>' . $row[ 'details' ] . '</kbd></h3>';
	           echo '<h3>Distance : <kbd>' . $row[ 'distance' ] . ' Miles' . '</kbd></h3>';
	           echo '<h3>Description</h3>' . ' <p>' . $row[ 'description' ] . '</p>';
	           echo '</div>';
	           echo '<div class="col-xs-12 col-md-6">';
	           echo ' <a class="thumbnail"  data-toggle="modal" data-target=".bs-example-modal-lg">    ';
	           echo '<img src="images/db_images/maps/' . $row[ 'map' ] . '" alt="' . $row[ 'map' ] . '">';
	           echo '</a>';
	           echo '</div></div>';
           ?>

	            <div style = "display: none;" class = "modal fade bs-example-modal-lg" tabindex = "-1" role = "dialog" aria-labelledby = "myLargeModalLabel" aria-hidden = "true">
    <div class = "modal-dialog modal-lg">
      <div class = "modal-content">

        <div class = "modal-header">
          <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true">×</button>
          <h4 class = "modal-title" id = "myLargeModalLabel"><?php echo $row[ 'title' ]; ?></h4>
        </div>
        <div class = "modal-body">
          <div class = "thumbnail"><?php echo '<img src="images/db_images/maps/' . $row[ 'map' ] . '" alt="' . $row[ 'map' ] . '">'; ?> </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>


<?php include 'includes/overall/footer.php'; ?>