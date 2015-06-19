     <ul class="nav navbar-nav navbar-right">
     <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <span class="glyphicon glyphicon-user"></span> Welcome <?php echo $user_data['first_name']; ?> <b class="caret"></b></a>
              <ul class="dropdown-menu">
			<li>
				<a href="logout.php">Log out</a>
			</li>
		<li>
				<a href="<?php echo $user_data['username']; ?>">Profile</a>
			</li>
			<li>
				<a href="changepassword.php">Change password</a>
			</li>
			<li>
				<a href="settings.php">Settings</a>
			</li>
<?php     
if(isset($user_data['user_id'])){
			
if (has_access($user_data['user_id'], 1) === true) {
		include 'includes/login_message/admin_links.php';
		} 
		}
             ?> 
              </ul>
            </li>
          </ul>