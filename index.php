<?php
		$page_title = 'User Registeration';
		include('Includes/config.inc.php');
		include('Includes/header.html');
		require(MySQL);
			

	
		if (isset($_GET['url'])){
			$user_id  = $_SESSION['user_id'];
			$url = $_GET['url'];
		$q = "DELETE FROM bookmark WHERE user_id=$user_id AND bm_url='$url' LIMIT 1";
		$r = mysqli_query($dbc,$q);
		
		if (mysqli_affected_rows($dbc) == 1){
			echo '<p>Deleted <a href="'. $url . '">' . $url . '</a></p>';
		}
		else{
			echo '<p> Could not delete bookmark</p>';
		}
	}
		if (isset($_SESSION['first_name']) && isset($_SESSION['time_login']) && isset($_SESSION['user_id'])){
			$name = $_SESSION['first_name'];
			$last_login = $_SESSION['time_login'];
			$user_id = $_SESSION['user_id'];
			echo "<p> Logged in as " . $name ."</p> " ;
			echo "<p>Time Login: " . $last_login . "</p>";
			
			//require(MySQL);
			
			$query = "SELECT bm_url FROM bookmark WHERE user_id=$user_id";
			
			$result = mysqli_query($dbc,$query);
			
			echo '<table align="center" cellpadding="3" cellspacing="3" width="75%">
					<tr>
						<td><b>Bookmark<b></td>
						<td><b>Delete?</b></td>
					</tr>';
			$bg = '#eeeeee';
			
			while ($row = mysqli_fetch_assoc($result)){
				$bg = ($bg == '#eeeeee' ? '#ffffff' : '#eeeeee');
				echo '<tr bgcolor="' . $bg . '">
						<td><a href="' . $row['bm_url'] . '">' . $row['bm_url'] . '</a></td>
						<td>
						<a href="index.php?url='. $row['bm_url'] . '">Yes</a>
						</td>
					</tr>';
			}		
			echo '</table>';
		}
		else{
			
		}
		
	if (isset($_SESSION['admin']) && ($_SESSION['time_login'])){
		
		echo '<p> Logged in as Admin</p>';
		echo '<p> Time Login: ' . $_SESSION['time_login'] . '</p>';
	}
		include('Includes/footer.html');
	
?>