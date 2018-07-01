<?php
	include('Includes/config.inc.php');
	
	$page_title = 'Edit';
	
	include('Includes/header.html');
	require(MySQL);
	if (isset($_GET['id'])){
		$id = $_GET['id'];
		
		$q = "SELECT email FROM users WHERE user_id=$id";
		$r = mysqli_query($dbc,$q);
		
		$row = mysqli_fetch_assoc($r);
		
		echo 'Activate this account <br /> ' . $row['email'];
		echo '<form method="post" action=""> 
			
				<input type="hidden" name="id" value="' . $id . '" />
					<input type="submit" value="Activate" />
			  </form>';
		
	}
	
	if (isset($_POST['id'])){
		$id = $_POST['id'];
	$query = "UPDATE users SET active=NULL WHERE user_id=$id";
		$result = mysqli_query($dbc,$query);
		
		if (mysqli_affected_rows($dbc) == 1){
			echo '<p> User account has been activated</p>';
		}
	}
?>

<?php

	include('Includes/footer.html');
?>