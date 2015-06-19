<?php

if (isset($_GET['sign_in']) === true && empty($_GET['sign_in']) === true) {
header('Location: login.php');
}elseif ((isset($_GET['sign_up']) === true && empty($_GET['sign_up']) === true)) {
header('Location: register.php');
}
	?>

<form class="navbar-form navbar-right" role="form" action="index.php" method="get">
	<button type="submit" name="sign_up" class="btn btn-success">
		Sign Up
	</button>
	<button type="submit" name="sign_in" class="btn btn-info">
		Sign In
	</button>
</form>