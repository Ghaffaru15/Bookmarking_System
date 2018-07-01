<?php
	/*This script:
	- defines constants and settings
	- dictates how errors are handled
	- defines useful functions
	*/
/*  DEVELOPER : GHAFFARU MUDASHIRU 
	LANGUAGES : PHP & MYSQL
*/
	// ******************************//
	// ********* SETTINGS ***********//

	//Flag for site status
	define('LIVE',FALSE);

	//Admin contact address
	define('EMAIL', 'mudashiruagm@gmail.com');

	//Site URL (base for all redirections)
	define('BASE_URL', 'http://localhost/Bookmarking_System/');

	//Location of the mysql connection script
	define('MySQL','C:\xampp\db_connect.php');

	//Adjust time zone
	date_default_timezone_set('US/Eastern');


	// ********* ERROR MANAGEMENT ************* //

	//Create error Handler
	function my_error_handler($e_number, $e_message, $e_file, $e_line, $e_vars){
		//Build error message 
		$message = "An error occurred in the script " . $e_file . " on line "  . $e_line . ": " . $e_message . "<br />";

		//Add date and time
		$message .="Date/Time: " . date('n-j-Y H:i:s') . "<br />";

		if (!LIVE){
			//show error messages
			echo '<div class="error">'. nl2br($message);
			echo '<pre>' . print_r($e_vars,1) . "<br />";
			debug_print_backtrace();
			echo '</pre></div>'; 
		}
		else{
			//Dont show the error
			$body = $message . "<br />" . print_r($e_vars,1);
			mail(EMAIL, 'Site Error!' , $body, 'From: databasegurus419@gmail.com');

			if ($e_number != E_NOTICE){
				echo '<div class="error">A system error occurred. We apologize for the inconvenience. </div><br />';
			}
		}
	}

	set_error_handler('my_error_handler');
?>