<?php
	include 'core/init.php';
	protect_page ();
	include 'includes/overall/header.php';
?>
	<div class = "panel panel-primary">
	<div class = "panel-heading">
<h3 class = "panel-title">Checkout</h3>
</div>

	<div class = "panel-body">
<?php checkout (); ?>

</div></div>
<?php
	include 'includes/overall/footer.php';
?>