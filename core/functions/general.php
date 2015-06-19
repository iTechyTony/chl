<?php
function email($to, $subject, $body) {
	mail($to, $subject, $body, 'From: tech@finefinerfinest.com');
}

function logged_in_redirect() {
	if (logged_in() === true) {
		header('Location: index.php');
		exit();
	}
}

function protect_page() {
	if (logged_in() === false) {
		header('Location: protected.php');
		exit();
	}
}

function admin_protect() {
	global $user_data;
	if (has_access($user_data['user_id'], 1) === false) {
		header('Location: index.php');
		exit();
	}
}

function array_sanitize(&$item) {
	$item = htmlentities(strip_tags(mysql_real_escape_string($item)));
}

function sanitize($data) {
	return htmlentities(strip_tags(mysql_real_escape_string($data)));
}

function output_errors($errors) {
	return '<ul><li>' . implode('</li><li>', $errors) . '</li></ul>';
}

function update_data($id, $update_data, $table) {
	$update = array();
	array_walk($update_data, 'array_sanitize');
	
	foreach($update_data as $field=>$data) {
		$update[] = '`' . $field . '` = \'' . $data . '\'';
	}
	
	mysql_query("UPDATE `$table` SET " . implode(', ', $update) . " WHERE `id` = $id");
}

function update_user_data($id, $update_data, $table) {
	$update = array();
	array_walk($update_data, 'array_sanitize');
	
	foreach($update_data as $field=>$data) {
		$update[] = '`' . $field . '` = \'' . $data . '\'';
	}
	
	mysql_query("UPDATE `$table` SET " . implode(', ', $update) . " WHERE `user_id` = $id");
}

function insert($values,$table) {
	array_walk($values, 'array_sanitize');
	
	$fields = '`' . implode('`, `', array_keys($values)) . '`';
	$data = '\'' . implode('\', \'', $values) . '\'';
	
	mysql_query("INSERT INTO `$table` ($fields) VALUES ($data)");
}


function delete($id, $table){
	mysql_query("DELETE FROM  `$table`  WHERE `id` = $id");	
}

function deleteUser($id, $table){
	mysql_query("DELETE FROM  `$table`  WHERE `user_id` = $id");	
}
?>

<?php

$page = 'checkout.php';




if (isset($_GET['add'])) {
	$quantity = mysqli_query($connection, 'SELECT id, quantity FROM merchandise WHERE id=' . mysql_real_escape_string((int)$_GET['add']));
	while ($quantity_row = mysqli_fetch_assoc($quantity)) {
		if ($quantity_row['quantity'] != $_SESSION['cart_' . (int)$_GET['add']]) {
			$_SESSION['cart_' . (int)$_GET['add']] += 1;

		}

	}
	header('Location:' . $_SERVER['HTTP_REFERER'] );
}

if (isset($_GET['remove'])) {
	$_SESSION['cart_' . (int)$_GET['remove']]--;
	header('Location:' . $_SERVER['HTTP_REFERER']);
}

if (isset($_GET['delete'])) {
	$_SESSION['cart_' . (int)$_GET['delete']] = '0';
	header('Location:' . $_SERVER['HTTP_REFERER']);
}

if (isset($_GET['sort'])) {
	$_SESSION['sort'] = $_GET['sort'];
	header('Location: ' . $_SERVER['HTTP_REFERER'] );
}

if (isset($_POST['search'])) {
	$search=$_POST['search'];
$GLOBALS['searchq']= "AND name LIKE '%$search%'" ;
	$GLOBALS['search']=$search;
}

function products() {
	$get = mysqli_query($GLOBALS['connection'], 'SELECT * FROM merchandise WHERE quantity >0  '.$GLOBALS['searchq'].''.$_SESSION["sort"].'');
	if (mysqli_num_rows($get) == 0) {
		echo '<div class="col-sm-6 col-md-12">';
		echo '<div class="alert alert-success">';
		echo'<h1 class="text-center">Searching for '.$GLOBALS['search'].' </h1> ';
		echo'<h2 class="text-center">No results found</h2> ';
		echo'<p class="text-center" >Remember to check your spelling, and try using just a few key words.</p> ';
		echo'</div>';
		echo'</div>';
	} else {
	
		while ($get_row = mysqli_fetch_assoc($get)) {

				echo '<div class="col-sm-6 col-md-3">';
		echo '<div class="thumbnail">';
		echo '<a href="details.php?id=' . $get_row['id'] . '">';
		echo '<img src="images/db_images/merchandise/' . $get_row['img'] . '" alt="' . $get_row['img'] . '">';
		echo '</a>';
		echo '<div class="caption">';
		echo '<h5>' . $get_row['name'] . '</h5>';
		echo '<h6>' . ' £' . number_format($get_row['price'], 2) . '</h6>';
		echo ' <p><a href="details.php?id=' . $get_row['id'] . '" class="btn btn-primary" role="button">Details</a> <a href="details.php?add=' . $get_row['id'] . '" class="btn btn-success" role="button">Add To Cart</a></p>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
		}

	}

}

function paypal_items(){
	$num='0';
	
	foreach ($_SESSION as $name => $value) {
		if ($value > 0) {
			if (substr($name, 0, 5) == 'cart_') {
				$id = substr($name, 5, (strlen($name) - 5));
				$get = mysqli_query($GLOBALS['connection'], 'SELECT id, name, price, shipping FROM merchandise WHERE id=' . mysql_real_escape_string((int)$id));
				while ($get_row = mysqli_fetch_assoc($get)) {
					$num++;
					echo '<input type="hidden" name="item_number_'.$num.'" value="'.$id.'">';
				    echo '<input type="hidden" name="item_name_'.$num.'" value="'.$get_row['name'].'">';
					echo '<input type="hidden" name="amount_'.$num.'" value="'.$get_row['price'].'">';
					echo '<input type="hidden" name="shipping_'.$num.'" value="'.$get_row['shipping'].'">';
					echo '<input type="hidden" name="shipping_'.$num.'" value="'.$get_row['shipping'].'">';
					echo '<input type="hidden" name="quantity_'.$num.'" value="'.$value.'">';
				}
			}

		}

	}
	
	
}

function cart() {
	$num='0';
	foreach ($_SESSION as $name => $value) {
		if ($value > 0) {
			if (substr($name, 0, 5) == 'cart_') {
				$id = substr($name, 5, (strlen($name) - 5));
				$get = mysqli_query($GLOBALS['connection'], 'SELECT id, name, price, shipping FROM merchandise WHERE id=' . mysql_real_escape_string((int)$id));
				while ($get_row = mysqli_fetch_assoc($get)) {
					$num++;
				}
			}

		}

	}
	

					echo'
    <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#" id="download"><span class="glyphicon-class"><span class="glyphicon glyphicon-shopping-cart"></span><kbd>'.$num.'</kbd></span><span class="caret"></span></a>
              <ul class="dropdown-menu" aria-labelledby="download">
               ';
	foreach ($_SESSION as $name => $value) {
			
		if ($value > 0) {
			
			if (substr($name, 0, 5) == 'cart_') {

				$id = substr($name, 5, (strlen($name) - 5));
				$get = mysqli_query($GLOBALS['connection'], 'SELECT * FROM merchandise WHERE id=' . mysql_real_escape_string((int)$id));
				
				while ($get_row = mysqli_fetch_assoc($get)) {
					$sub = $get_row['price'] * $value;
				
				//	echo $get_row['name'] . ' x ' . $value . ' @ &pound;' . number_format($get_row['price'], 2) . ' = &pound;' . number_format($sub, 2) . '<a href="cart.php?remove=' . $id . '">[-]</a><a href="cart.php?add=' . $id . '">[+]</a><a href="cart.php?delete=' . $id . '">[Delete]</a><br />';
				echo' <li><a href="#">'.$get_row['name'] . ' x ' . $value . ' @ &pound;' . number_format($get_row['price'], 2) . ' = &pound;' . number_format($sub, 2) .'</a></li>
            
            ';

				
				}
	
			} 
		$total = @$total + $sub;
		

		}

	}

	if (!isset($total)) {
	echo '<li><a href="#">Cart is Empty</a></li>';
	} else {

		echo '<li><a href="checkout.php">Checkout</a><li>';
}
echo'</ul></li>';
}


function checkout() {
	
	echo '	<div class="table-responsive">
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Item</th>
          <th>Quantity</th>
          <th>Price</th>
          <th>Shipping</th>
          <th>Quantity + -</th>
          <th>Delete</th>
         <th>Sub Total</th>
          
        </tr>
      </thead>
      <tbody>';
      
	foreach ($_SESSION as $name => $value) {
		if ($value > 0) {
			if (substr($name, 0, 5) == 'cart_') {
				$id = substr($name, 5, (strlen($name) - 5));
				$get = mysqli_query($GLOBALS['connection'], 'SELECT * FROM merchandise WHERE id=' . mysql_real_escape_string((int)$id));
				while ($get_row = mysqli_fetch_assoc($get)) {
					
					
					$sub = $get_row['price'] * $value;
					
				
									echo ' <tr>';
									echo ' <td>' . $get_row['name'] . '</td>';
									echo ' <td>' .$value. '</td>';
									echo ' <td>' . number_format($get_row['price'], 2). '</td>';
									echo ' <td>' . number_format($get_row['shipping'], 2). '</td>';
									echo ' <td> <a href="checkout.php?remove=' . $id . '">[-]</a> <a href="checkout.php?add=' . $id . '">[+]</a></td>';
									echo '<td><a href="checkout.php?delete=' . $id . '">[Delete]</a></td>';
									echo'<td>'.$sub.'</td>';
									echo ' </tr>';				

			}
			}
			$totalcheckout = $totalcheckout + $sub;

		}

	}
	if (!isset($totalcheckout)) {
		echo 'Your cart is empty!';
	} else {
   echo'</tbody>
    </table>
  </div>';
?>
<p>
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
		<input type="hidden" name="cmd" value="_cart">
		<input type="hidden" name="upload" value="1">
		<input type="hidden" name="business" value="antonydat@live.co.uk">
		<?php paypal_items(); ?>
		<input type="hidden" name="currency_code" value="GBP">
		<input type="hidden" name="amount" value="<?php echo $value; ?>">
		<input type="image" src="http://www.paypal.com/en_US/i/btn/x-click-but03.gif" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
	</form>
</p>
<?php
}
}
						

?>