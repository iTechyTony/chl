<?php
include 'core/init.php';
protect_page();
admin_protect();
include 'includes/overall/header.php';
?>
<div class="panel panel-primary">
	<div class="panel-heading">
<h3 class="panel-title">Email All Riders</h3>
</div>

	<div class="panel-body">


<?php
if (isset($_GET['success']) === true && empty($_GET['success']) === true) {
?>
	<div class="alert alert-success"><h2>Email has been sent</h2></div></div></div>
<?php
} else {
	if (empty($_POST) === false) {
		if (empty($_POST['subject']) === true) {
			$errors[] = 'Subject is required';
		}
		
		if (empty($_POST['body']) === true) {
			$errors[] = 'Body is required';
		}
		
		if (empty($errors) === false)
		{
			echo '<div class="alert alert-danger">'.output_errors($errors).'</div>';
		} else {
			mail_users($_POST['subject'], $_POST['body']);
			header('Location: mail.php?success');
			exit();
		}
	}
	?>

<form action="mail.php" method="post" role="form">
	<div class="form-group">
		<label for="subject">Subject*</label>
		<input type="text" name="subject" class="form-control" id="subject" placeholder="Enter Subject">
	</div>
	<div class="form-group">
		<label for="body">Body*</label>
		<textarea name="body" class="form-control" id="body" rows="3"></textarea>
	</div>

	<button type="submit" class="btn btn-success">
		Send
	</button>
</form>
</div></div>
<?php
}
include 'includes/overall/footer.php';
?>