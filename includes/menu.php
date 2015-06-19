<div class="navbar navbar-inverse navbar-static-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php">Cycle Happy Leeds</a>
		</div>
		<div class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">About<b class="caret"></b></a>
					<ul class="dropdown-menu" role="menu">
						<li>
							<a href="about.php">About Us</a>
						</li>
						<li >
							<a href="contact.php">Contact us</a>
						</li>
						<li>
							<a href="find_us.php">Find Us</a>
						</li>
						</ul>
						</li>

						<li>
							<a href="events.php">Events</a>
						</li>

						<li >
							<a href="results.php">Results</a>
						</li>
						
						<li >
							<a href="news.php">News</a>
						</li>
						<?php cart(); ?>
		
			</ul>

     <?php
   	 
	if (logged_in() === true) {
		include 'includes/login_message/loggedin.php';
		
	} 
	
	else {
		include 'includes/login_message/notloggedin.php';
	
	}
	
	
	  
	?> 
        </div>
      </div>
    </div>