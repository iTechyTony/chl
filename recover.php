<?php
include 'core/init.php';
logged_in_redirect();
include 'includes/overall/header.php';
?>
<div class="panel panel-primary">
	<div class="panel-heading">
<h3 class="panel-title">Recover</h3>
</div>

	<div class="panel-body">
<?php
if (isset($_GET['success']) === true && empty($_GET['success']) === true) {
?>
	<div class="alert alert-success"><h2>Thanks, we've emailed you.</h2></div>
<?php
} else {
	$mode_allowed = array('username', 'password');
	if (isset($_GET['mode']) === true && in_array($_GET['mode'], $mode_allowed) === true) {
		if (isset($_POST['email']) === true && empty($_POST['email']) === false) {
			if (email_exists($_POST['email']) === true) {
				recover($_GET['mode'], $_POST['email']);
				header('Location: recover.php?success');
				exit();
			} else {
				echo '<div class="alert alert-danger">Oops, we couldn\'t find that email address!</div>';
			}
		}
	?>


	
	     <form action="" method="post" class="navbar-form" role="form">
        <label for="email" class="col-sm-3 control-label">Please enter your email address</label>
            <div class="form-group">
              <input type="text" name="email" class="form-control" id="email" placeholder="Enter Email">
            </div>
            <button type="submit" class="btn btn-success">Recover</button>
          </form>
	
	<?php
	} else {
		header('Location: index.php');
		exit();
	}
}
?>
</div></div>
<?php include 'includes/overall/footer.php'; ?>