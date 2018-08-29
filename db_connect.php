<?php
    define('DB_USER', 'root');
    define('DB_PASSWORD', 'iambad0245389652');
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'user_registeration_system');

    @ $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

    if (!$dbc){
	trigger_error('Could not connect to MYSQL: ' . mysqli_connect_error());
	}
    else{
	mysqli_set_charset($dbc, 'utf-8');
    }
?>