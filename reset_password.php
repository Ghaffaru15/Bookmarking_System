<?php
	include('Includes/config.inc.php');
	
	$page_title = 'Page reset';
	
	include('Includes/header.html');
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		if (!empty($_POST['email'])){
			require(MySQL);
			$email = mysqli_real_escape_string($dbc, $_POST['email']);
			$q = "SELECT user_id,first_name FROM users WHERE email='$email'";
			
			$r = mysqli_query($dbc, $q);
			
			if (mysqli_num_rows($r) == 1){
				while ($row= mysqli_fetch_assoc($r)){
				$user_id  = $row['user_id'];
				}
			}
			else{
				echo '<p class="error"> The email is not registered </p>';
			}
		}
		else{
			echo '<p class="error"> You forgot to enter your email </p>';
		}
		
		if ($user_id){
			$password = substr(md5(uniqid(rand(), true)), 3, 10);
			
			$query = "UPDATE users SET pass=sha1('$password') WHERE user_id=$user_id LIMIT 1";
			
			$result = mysqli_query($dbc,$query);
			
			if (mysqli_affected_rows($dbc) == 1 ){
				echo '<p>Your password has been reset to ' . $password . ', Login with this password, and change it later.</p>';
			}
	
			
		}
		else{
			echo '<p> Error retrieving data </p>';
		}
	}
?>

<form class="form-login" method="post" action="#">

            <div class="form-log-in-with-email">

                <div class="form-white-background">

                    <div class="form-title-row">
                        <h1>Reset Password</h1>
                    </div>

                    <div class="form-row">
                        <label>
                            <span>Email</span>
                            <input type="email" name="email">
                        </label>
                    </div>
				</div>
				<div class="form-row">
                        <button type="submit">Reset Password</button>
                </div>
			</div>
</form>

<?php
	include('Includes/footer.html');
?>