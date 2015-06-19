<?php
	include 'core/init.php';
	protect_page ();
	admin_protect ();
	include 'includes/overall/header.php';
	$id = $_GET[ id ];
	$query = mysql_query ( "SELECT * FROM merchandise WHERE id='$id'" );
	$row = mysql_fetch_assoc ( $query );
	if ( empty( $_POST ) === false )
	{
		$required_fields = array ( 'name' , 'price' , 'category' , 'description' , 'quantity' , 'shipping' );
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
			if ( is_numeric ( $_POST[ 'quantity' ] ) === false )
			{
				$errors[] = 'Quantity must be a number';
			}
			if ( is_numeric ( $_POST[ 'shipping' ] ) === false )
			{
				$errors[] = 'Shipping must be a number';
			}
			if ( is_numeric ( $_POST[ 'price' ] ) === false )
			{
				$errors[] = 'Price must be a number';
			}
		}
	}
?>

<?php
	if ( empty( $_POST ) === false && empty( $errors ) === true )
	{
		$update_data = array ( 'name' => $_POST[ 'name' ] , 'price' => $_POST[ 'price' ] , 'category' => $_POST[ 'category' ] , 'description' => $_POST[ 'description' ] , 'quantity' => $_POST[ 'quantity' ] , 'shipping' => $_POST[ 'shipping' ] );
		update_data ( $id , $update_data , merchandise );
		header ( 'Location: amendProducts.php?menu=update ' );
		exit();
	}
	else if ( empty( $errors ) === false )
	{
		echo '<div class="alert alert-danger">' . output_errors ( $errors ) . '</div>';
	}
?>

	<div class = "panel panel-primary">
	<div class = "panel-heading">
              <h3 class = "panel-title">Update <?php echo $row[ 'name' ]; ?></h3>
            </div>
            <div class = "panel-body">
	
	<form action = "" method = "post" class = "form-horizontal" role = "form">
		<div class = "row">
			<div class = "col-xs-9">
<div class = "form-group">
    <label for = "name" class = "col-sm-3 control-label">Item Name*</label>
    <div class = "col-sm-7">
      <input type = "text" name = "name" class = "form-control" id = "name" value = "<?php echo $row[ 'name' ]; ?>">
    </div>
  </div>

<div class = "form-group">
    <label for = "price" class = "col-sm-3 control-label">Price*</label>
    <div class = "col-sm-7">
      <input type = "text" name = "price" class = "form-control" id = "price" value = "<?php echo $row[ 'price' ]; ?>">
    </div>
  </div>		

  
  <div class = "form-group">
    <label for = "type" class = "col-sm-3 control-label">Item Category*</label>
    <div class = "col-sm-7">
     
        <select class = "form-control" name = "type">
            <option value = "<?php echo $row[ 'type' ]; ?>"><?php echo $row[ 'category' ]; ?>*</option>
          <option value = "shoes">Shoes</option>
          <option value = "badges"> Badges</option>
          <option value = "shirts">Shirts</option>
        </select>

    </div>
    </div>

<div class = "form-group">
    <label for = "quantity" class = "col-sm-3 control-label">Quantity*</label>
    <div class = "col-sm-7">
      <input type = "text" name = "quantity" class = "form-control" id = "quantity" value = "<?php echo $row[ 'quantity' ]; ?>">
    </div>
    </div>
  	
  <div class = "form-group">
    <label for = "shipping" class = "col-sm-3 control-label">Shipping*</label>
    <div class = "col-sm-7">
      <input type = "text" name = "shipping" class = "form-control" id = "shipping" value = "<?php echo $row[ 'shipping' ]; ?>">
    </div>
  </div>		


 <div class = "form-group">
    <label for = "description" class = "col-sm-3 control-label">Description*</label>
    <div class = "col-sm-7">
      <textarea name = "description" class = "form-control" id = "description" rows = "4"><?php echo $row[ 'description' ]; ?></textarea>
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