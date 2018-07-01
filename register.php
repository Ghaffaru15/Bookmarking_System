<?php
	require("Includes/config.inc.php");
	$page_title = "Register with us";
	
	include("Includes/header.html");
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		require(MySQL);
		$trimmed = array_map('trim', $_POST);
		$fn = $ln = $e = $p = $check = FALSE;
		
		if (preg_match('/^[A-Z \'.-]{2,20}$/i',$trimmed['first_name'])){
			$fn = mysqli_real_escape_string($dbc,$trimmed['first_name']);
		}
		else{
			echo '<p class="error"> Please provide your first name </p>';
		}
		
		if (preg_match('/^[A-Z \.-]{2,40}$/i',$trimmed['last_name'])){
			$ln = mysqli_real_escape_string($dbc,$trimmed['last_name']);
		}
		else{
			echo '<p class="error"> Please provide your last name </p>';
		}
		
		if (filter_var($trimmed['email'], FILTER_VALIDATE_EMAIL)){
			$e = mysqli_real_escape_string($dbc, $trimmed['email']);
		}
		else{
			echo '<p class="error"> Please provide your email </p>';
		}
		if (preg_match('/^\w{4,20}$/',$trimmed['password']) && strlen($trimmed['password']) >= 8 ){
			if ($trimmed['password'] == $trimmed['password_confirm']){
				$p = mysqli_real_escape_string($dbc,$trimmed['password']);
				
				$password_length = 1;
			}
		
			else{
				echo '<p class="error"> The password entered does not match </p>';
			}
		}
		else{
			echo '<p class="error"> Please check your password </p>';
		}
		if (isset($_POST['checkbox'])){
			$check = 1;
		}
		else{
			$check = 0;
			echo '<p class="error"> Please agree to our terms and conditions </p>';
		}
		
		if ($fn && $ln && $e && $p && $check && $password_length){
			//Checking for valid email address
			$query = "SELECT user_id FROM users where email='$e'";
			
			$result = mysqli_query($dbc, $query) or trigger_error("Query: $query<br />MySQL error: " . mysqli_error($dbc));
			
			if (mysqli_num_rows($result) == 0){
				//Generate activation code
				$activation = md5(uniqid(rand(),true));
				$q = "INSERT into users(first_name,last_name,email,pass,active,registeration_date) VALUES ('$fn', '$ln','$e', sha1('$p'), '$activation', NOW())";
				
				$r = mysqli_query($dbc,$q) or trigger_error("Query: $q<br />MySQL error: " . mysqli_error($dbc));

				if (mysqli_affected_rows($dbc) == 1){
					$body = "Thank you for registering at Ghaff WebTech, To activate your account, please click<br />";
					$link = BASE_URL . 'activate.php?x='. urlencode($e) . "&y=$activation";
					//mail($trimmed['email'], 'Registeration Confirmation', $body ,'From: admin@gmail.com');
					
					echo $body . '<a href="' . $link . '"> here </a>';
					
				}
				else{
					echo '<p class="error">You could not be registered due to system error. We apologize for any inconvenience </p>';
				}
			}
			else{
				echo '<p class="error">That email is already registered with us, please login rather </p>';
			}
		}
		else{
			echo '<p class="error"> Please try again </p>';
		}
		mysqli_close($dbc);
	}
?>
<form action="#" method="post" class="form-register">
    <div class="form-register-with-email">

                <div class="form-white-background">

                    <div class="form-title-row">
                        <h1>Create an account</h1>
                    </div>
				
                    <div class="form-row">
                        <label>
                            <span>First Name</span>
                            <input type="text" name="first_name" value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name'];?>">
                        </label>
                    </div>
					<div class="form-row">
						<label>
							<span> Last Name </span>
							<input type="text" name="last_name" value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>">
						</label>
					</div>
                    <div class="form-row">
                        <label>
                            <span>Email</span>
                            <input type="email" name="email" value=" <?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
                        </label>
                    </div>

                    <div class="form-row">
                        <label>
                            <span>Password</span>
                            <input type="password" name="password">
							<?php
								if (isset($_POST['password'])){
									if (strlen($_POST['password']) < 8){
										echo '<p> You password should be more than 8 characters</p>';
										//$error[] = ' ';
									}
									else{
										//$password_length = 1;
									}
								}
							?>
                        </label>
                    </div>
					<div class="form-row">
						<label> 
							<span>Confirm Password</span>
							<input type="password" name="password_confirm">
						</label>
					</div>
                    <div class="form-row">
                        <label class="form-checkbox">
                            <input type="checkbox" name="checkbox">
                            <span>I agree to the <a href="#">terms and conditions</a></span>
                        </label>
                    </div>

                    <div class="form-row">
                        <button type="submit">Register</button>
                    </div>

                </div>

                <a href="login.php" class="form-log-in-with-existing">Already have an account? Login here &rarr;</a>

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
	include("Includes/footer.html");
?>