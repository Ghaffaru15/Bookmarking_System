<?php
	include('Includes/config.inc.php');
	
	$page_title = 'Add Bookmark';
	
	include('Includes/header.html');
	if (isset($_SESSION['user_id'])){
	$error = array();
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
		if (isset($_SESSION['user_id']))
			$user_id = $_SESSION['user_id'];
		
		if (empty($_POST['new_bm']))
				$error[] = 'Please provide your bookmark';
			else{
			$url = trim($_POST['new_bm']);
			if (strstr($url, 'http://') == false)
				$url = 'http://' . $url;
			}
		
			if (empty($error)){
				require(MySQL);
				$query = "INSERT INTO bookmark(user_id, bm_url) VALUES ('$user_id','$url')";
				
				$result = mysqli_query($dbc,$query);
				
				if (mysqli_affected_rows($dbc) == 1){
					echo '<p> Bookmark added </p>';
				}
				else{
					echo '<p> Failed to add bookmark, try again</p>';
				}
			}
			else{
				foreach($error as $value){
					echo $value . '<br />';
				}
		}
	}
	
	
	echo '<form class="form-login" method="post" action="#">

            <div class="form-log-in-with-email">

                <div class="form-white-background">
					
                    <div class="form-title-row">
                        <h1>Add Bookmarks</h1>
                    </div>

                    <div class="form-row">
                        <label>
                            <span>New BM:</span>
                            <input type="text" name="new_bm" value="">
                        </label>
                    </div>

                    <div class="form-row">
                        <button type="submit">Add bookmark</button>
                    </div>

                </div>
				</div>
				</form>';
	include('Includes/footer.html');

	}
	else{
		$_SESSION['redirect_to'] = $_SERVER['REQUEST_URI'];
 		 header("Location: login.php");
  		exit();
	}?>	

        