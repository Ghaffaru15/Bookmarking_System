<?php
	include('Includes/config.inc.php');
	
	$page_title = 'Admin';
	
	include('Includes/header.html');
	
	if ($_SERVER['REQUEST_METHOD']  == 'POST'){
		
		$errors = array();
		
		if (empty($_POST['email']))
			$errors[] = "Your email cannot be empty, Admin";
		
		if (empty($_POST['password']))
			$errors[] = "Your password cannot be empty, Admin";
		
		
		
		$email = trim($_POST['email']);
		$password = trim($_POST['password']);
		if (($email != 'admin@ghaffwebtech.com') AND ($password != 'admin12345'))
			$errors[] = "Email and Password does not match";
		
		
		
		if (empty($errors)){
			$_SESSION['admin'] = 'admin';
			$_SESSION['time_login'] = date('F j, Y H:i');
			
			$url = BASE_URL . 'index.php';
			header("Location: $url");
		}
		else{
			foreach ($errors as $values){
				echo $values . '<br />';
			}
		}
	}
?>
        <form class="form-login" method="post" action="#">

            <div class="form-log-in-with-email">

                <div class="form-white-background">

                    <div class="form-title-row">
                        <h1>Log in</h1>
                    </div>

                    <div class="form-row">
                        <label>
                            <span>Email</span>
                            <input type="email" name="email">
                        </label>
                    </div>

                    <div class="form-row">
                        <label>
                            <span>Password</span>
                            <input type="password" name="password">
                        </label>
                    </div>

                    <div class="form-row">
                        <button type="submit">Log in</button>
                    </div>

                </div>
				  <a href="reset_password.php" class="form-forgotten-password">Forgotten password &middot;</a>
			</div>
		</form>	
<?php
	include('Includes/footer.html');
?>