<?php
	include 'core/init.php';
	protect_page ();
	admin_protect ();
	include 'includes/overall/header.php';
?>

	<div class = "panel panel-primary">
	<div class = "panel-heading">
              <h3 class = "panel-title">Merchandise</h3>
            </div>
            <div class = "panel-body">
<?php
	if ( isset( $_GET[ 'success' ] ) === true && empty( $_GET[ 'success' ] ) === true )
	{
		echo '<div class="alert alert-success"><h2>You have successfully added an Item</h2> </div>';
	}
	elseif ( ( isset( $_GET[ 'removeProduct' ] ) === true && empty( $_GET[ 'removeProduct' ] ) === false ) )
	{
		$unique_id = $_GET[ 'removeProduct' ];
		delete ( $unique_id , merchandise );
		echo '<div class="alert alert-success"><h2>You have successfully deleted the Item</h2> </div>';
	}
?>


	            <form role = "form" method = "get" action = "amendProducts.php">
  <button type = "submit" value = "add" name = "menu" class = "btn btn-primary">Add Item</button>
  <button type = "submit" value = "update" name = "menu" class = "btn btn-primary">Update Item</button>
  <button type = "submit" value = "delete" name = "menu" class = "btn btn-primary">Delete Item</button>

</form>


	            <?php
		            $id = $_GET[ 'menu' ];
		            switch ( $id )
		            {
			            case 'add':
				            echo '<br>';
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
				            if ( empty( $_POST ) === false && empty( $errors ) === true )
				            {
					            $values = array ( 'name' => $_POST[ 'name' ] , 'price' => $_POST[ 'price' ] , 'category' => $_POST[ 'category' ] , 'description' => $_POST[ 'description' ] , 'quantity' => $_POST[ 'quantity' ] , 'shipping' => $_POST[ 'shipping' ] );
					            insert ( $values , merchandise );
					            header ( 'Location: amendProducts.php?success' );
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
    <label for="name" class="col-sm-3 control-label">Item Name*</label>
    <div class="col-sm-7">
      <input type="text" name="name" class="form-control" id="name" value="">
    </div>
  </div>

<div class="form-group">
    <label for="price" class="col-sm-3 control-label">Price*</label>
    <div class="col-sm-7">
      <input type="text" name="price" class="form-control" id="price" >
    </div>
  </div>		

  
  <div class="form-group">
    <label for="type" class="col-sm-3 control-label">Item Category*</label>
    <div class="col-sm-7">
     
        <select class="form-control" name="type">
          <option value="">Please Choose Category</option>
          <option value="shoes">Shoes</option>
          <option value="badges"> Badges</option>
          <option value="shirts">Shirts</option>
        </select>

    </div>
    </div>

<div class="form-group">
    <label for="quantity" class="col-sm-3 control-label">Quantity*</label>
    <div class="col-sm-7">
      <input type="text" name="quantity" class="form-control" id="quantity" value="">
    </div>
    </div>
  	
  <div class="form-group">
    <label for="shipping" class="col-sm-3 control-label">Shipping*</label>
    <div class="col-sm-7">
      <input type="text" name="shipping" class="form-control" id="shipping" >
    </div>
  </div>		


 <div class="form-group">
    <label for="description" class="col-sm-3 control-label">Description*</label>
    <div class="col-sm-7">
      <textarea name="description" class="form-control" id="description" rows="4"  ></textarea>
    </div>
  </div>		
  

  <div class="form-group">
    <div class="col-sm-offset-3 col-sm-10">
      <button type="submit" class="btn btn-success">Add Item</button>
    </div>
  </div>
   </div>
    </div>
	</form> ';
				            break;
			            case 'update':
				            $query = mysql_query ( "SELECT * FROM merchandise" );
				            echo '<br>';
				            echo '	<div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Item Name</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Shipping</th>
          <th>Update</th>
        </tr>
      </thead>
      <tbody>';
				            while ( ( $row = mysql_fetch_assoc ( $query ) ) )
				            {
					            echo ' <tr>';
					            echo ' <td>' . $row[ 'name' ] . '</td>';
					            echo ' <td>' . '£' . $row[ 'price' ] . '</td>';
					            echo ' <td>' . $row[ 'quantity' ] . '</td>';
					            echo ' <td>' . '£' . $row[ 'shipping' ] . '</td>';
					            echo '<td><a href="edit_products.php?id=' . $row[ 'id' ] . '">Update</a></td>';
					            echo ' </tr>';
				            }
				            echo ' </tbody>
    </table>
  </div>';
				            break;
			            case 'delete':
				            $query = mysql_query ( "SELECT * FROM merchandise" );
				            echo '<br>';
				            echo '	<div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Item Name</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Shipping</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>';
				            while ( ( $row = mysql_fetch_assoc ( $query ) ) )
				            {
					            echo ' <tr>';
					            echo ' <td>' . $row[ 'name' ] . '</td>';
					            echo ' <td>' . '£' . $row[ 'price' ] . '</td>';
					            echo ' <td>' . $row[ 'quantity' ] . '</td>';
					            echo ' <td>' . '£' . $row[ 'shipping' ] . '</td>';
					            echo '<td><a href="amendProducts.php?removeProduct=' . $row[ 'id' ] . '">Delete</a></td>';
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