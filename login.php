<?php
	include('Includes/config.inc.php');
	$page_title = "Login";
	include('Includes/header.html');

	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		require(MySQL);
		
		$trimmed = array_map('trim',$_POST);
		
		$email = mysqli_real_escape_string($dbc,$trimmed['email']);
		
		$password = mysqli_real_escape_string($dbc,$trimmed['password']);
		
		$q = "SELECT user_id, first_name FROM users WHERE email='$email' AND pass=sha1('$password') AND active IS NULL";

		$r = mysqli_query($dbc,$q);
		
		if (mysqli_num_rows($r) == 1){
			$row = mysqli_fetch_assoc($r);
			$_SESSION['user_id'] = $row['user_id'];
			$_SESSION['first_name'] = $row['first_name'];
			//$_SESSION['user_level'] = $row['user_level'];
			$_SESSION['time_login'] = date('F j, Y  H:i');
			$time_login = $_SESSION['time_login'];
			//$q = "UPDATE users SET last_login=" . $time_login . "WHERE user_id=" . $row['user_id']  ."AND last_login IS NULL";
			
			$r = mysqli_query($dbc,$q);
			
			if (mysqli_affected_rows($dbc) == 1){
					$url = BASE_URL  . 'index.php';
			
			header("Location: $url");
			}
		
		}
		else{
			echo '<p class="error"> Email and password does not match, or Account not activated </p>';
		}
		mysqli_close($dbc);
	}
?>

        <form class="form-login" method="post" action="#">

            <div class="form-log-in-with-email">

                <div class="form-white-background">
					<ul>	
						<li>Store your bookmarks online with us</li>
						<li>See what other users use </li>
						<li>Share your favorite links with others</li>
					</ul>
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
                <a href="register.php" class="form-create-an-account">Create an account &rarr;</a>

            </div>

            <div class="form-sign-in-with-social">

                <div class="form-row form-title-row">
                    <span class="form-title">Sign in with</span>
                </div>

                <a href="#" class="form-google-button">Google</a>
                <a href="#" class="form-facebook-button">Facebook</a>
                <a href="#" class="form-twitter-button">Twitter</a>

            </div>

        </form>
<?php
	include('Includes/footer.html');
?>	