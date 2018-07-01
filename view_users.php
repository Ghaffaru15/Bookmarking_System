<?php


	include('Includes/config.inc.php');
	
	$page_title = 'View Users';
	
	include('Includes/header.html');
		if (isset($_SESSION['admin'])){
	require(MySQL);
	$q = "SELECT user_id,first_name,last_name,email,registeration_date,last_login FROM users";
	
	$r = mysqli_query($dbc,$q);
	
	echo '<table align="center" cellspacing="0" cellpadding="5" width="75%">
	<tr>
		<td align="left"> Edit User </td>
		<td align="left"> Delete User </td>
		<td align="left"> User Id </td>
		<td align="left"> First Name </td>
		<td align="left"> Last Name </td>
		<td align="left"> Email </td>
		<td align="left"> Registeration Date </td>
		<td align="left"> Last Login </td>
	</tr>';
	
	$bg = '#eeeeee';
	
	while ($row = mysqli_fetch_assoc($r)){
		$bg = ($bg == '#eeeeee' ? '#ffffff' : '#eeeeee');
		echo '<tr bgcolor="' . $bg . '">
				<td align="left"><a href="edit_user.php?id=' . $row['user_id'] . '">Edit</a></td>
				<td align="left"><a href="delete_user.php?id=' . $row['user_id'] . '">Delete</a></td>
				<td align="left">' . $row['user_id']  . '</td>
				<td align="left">' . $row['first_name'] . '</td>
				<td align="left">' . $row['last_name'] . '</td>
				<td align="left">' . $row['email'] . '</td>
				<td align="left">' . $row['registeration_date'] . '</td>
				<td align="left">' . $row['last_login'] . '</td>
			  </tr>';
	}
	
	echo '</table>';
	}
	else{
		//$url = BASE_URL . 'index.php';
		header("Location: index.php");
	}
?>	

<?php
	include('Includes/footer.html');
?>

</table>