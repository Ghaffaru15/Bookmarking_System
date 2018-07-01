<?php
	include('Includes/config.inc.php');
	
	$page_title = 'Delete User';
	
	include('Includes/header.html');
	
	require(MySQL);
	if (isset($_GET['id']) AND is_numeric($_GET['id'])){
		$id = $_GET['id'];
		
		
		
		$q = "SELECT first_name,last_name,email FROM users WHERE user_id=$id";
		
		$r = mysqli_query($dbc,$q);
		
		$row = mysqli_fetch_assoc($r);
		
		echo '<h3 align="center"> Are you sure you want to delete ' . $row['first_name'] . ' ' . $row['last_name'] . ' with email, ' . $row['email'] . ' ? </h3>';
		
		echo '<form method="post" action="#" class="form-login">
			<div class="form-log-in-with-email">
				<input type="hidden" name="id" value="' . $id. ' " />
				 <div class="form-row">
                        <button type="submit">Delete</button>
                    </div>
			</div>
			  </form>';
	}
	
	
		if (isset($_POST['id'])){
			$id = $_POST['id'];
			//require(MySQL);
			$q = "DELETE FROM users WHERE user_id=$id LIMIT 1";
			
			$r = mysqli_query($dbc,$q);
			
			if (mysqli_affected_rows($dbc) == 1){
				echo '<p> User has been deleted</p>';
			}
		}
	
?>

<?php
	include('Includes/footer.html');
?>