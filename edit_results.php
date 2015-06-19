<?php
	include 'core/init.php';
	protect_page ();
	admin_protect ();
	include 'includes/overall/header.php';
?>

<?php
	$id = $_GET[ id ];
	$query = mysql_query ( "SELECT * FROM results WHERE id='$id'" );
	$row = mysql_fetch_assoc ( $query );
?>
	<div class = "panel panel-primary">
	<div class = "panel-heading">
<h3 class = "panel-title">Update - <?php echo $row[ 'Rider' ]; ?></h3>
</div>

	<div class = "panel-body">
<?php
	if ( empty( $_POST ) === false && empty( $errors ) === true )
	{
		for ( $i = 1 ; $i <= 18 ; $i ++ )
		{
			$total = $_POST[ $i ] + $total;
		}
		$update_data = array ( 'Points' => $total , '1' => $_POST[ '1' ] , '2' => $_POST[ '2' ] , '3' => $_POST[ '3' ] , '4' => $_POST[ '4' ] , '5' => $_POST[ '5' ] , '6' => $_POST[ '6' ] , '7' => $_POST[ '7' ] , '8' => $_POST[ '8' ] , '9' => $_POST[ '9' ] , '10' => $_POST[ '10' ] , '11' => $_POST[ '11' ] , '12' => $_POST[ '12' ] , '13' => $_POST[ '13' ] , '14' => $_POST[ '14' ] , '15' => $_POST[ '15' ] , '16' => $_POST[ '16' ] , '17' => $_POST[ '17' ] , '18' => $_POST[ '18' ] );
		update_data ( $id , $update_data , results );
		header ( 'Location: amendResults.php?menu=update' );
		exit();
	}
?>
		<form action = "" method = "post" class = "form-horizontal" role = "form">
		<div class = "row">
			<div class = "col-xs-9">

  <?php
	  for ( $i = 1 ; $i <= 18 ; $i ++ )
	  {
		  echo '<div class="form-group">
    <label for="' . $i . '" class="col-sm-2 control-label">Point ' . $i . '</label>
    <div class="col-sm-3">
      <input type="text" name="' . $i . '" class="form-control" id="' . $i . '" value="' . $row[ $i ] . '">
    </div>
  </div>';
	  }
  ?>


				<div class = "form-group">
    <div class = "col-sm-offset-2 col-sm-10">
      <button type = "submit" class = "btn btn-success">Update</button>
    </div>
  </div>
   </div>
    </div>
	</form>
</div></div>
<?php include 'includes/overall/footer.php'; ?>