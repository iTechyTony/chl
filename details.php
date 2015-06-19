<?php
	include 'core/init.php';
	include 'includes/overall/header.php';
	$item_id = $_GET[ 'id' ];
	$query = mysql_query ( "SELECT * FROM merchandise WHERE id ='$item_id'" );
	$row = mysql_fetch_assoc ( $query );
?>

	<div class = "panel panel-primary">
	<div class = "panel-heading">
              <h3 class = "panel-title"><?php echo ucfirst ( $row[ 'name' ] ); ?></h3>
            </div>
            <div class = "panel-body">
            
  <div class = "row">
      <div class = "col-xs-12 col-md-5">

       <?php
	       echo '<div class="thumbnail">';
	       echo '<a href="details.php?id=' . $row[ 'id' ] . '">';
	       echo '<img src="images/db_images/merchandise/' . $row[ 'img' ] . '" alt="' . $row[ 'img' ] . '">';
	       echo '</a>';
	       echo '</div> ';
       ?>
      
      </div>
    
    
   <div class = "col-xs-12 col-md-7">
    <div class = "panel panel-info">
      <div class = "panel-heading">
        <h3 class = "panel-title">Details</h3>
      </div>
      <div class = "panel-body">
<?php
	echo '<h4>Price : ' . '<kbd>£' . number_format ( $row[ 'price' ] , 2 ) . '</kbd></h4>';
	echo '<h4>Description</h4>';
	echo '<p>' . $row[ 'description' ] . '</p>';
?>
      </div>
    </div>

    
    </div>
  

  </div>     	
    </div>
   </div>

<?php include 'includes/overall/footer.php'; ?>