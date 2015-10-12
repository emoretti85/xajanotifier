<?php
/**
 * Config class
 *
 * Just a configuration class called from XajaServer.php and XajaAdminServer.php
 *
 *
 * PHP version 5
 *
 * @author     Ettore Moretti <author@example.com>
 * @version 1.0.0
 *
 */
class Config{
	// Seconds to wait for deleting users from the table... USE THE SAME TIME FOR THE SESSION
	const DELETE_AFTER_SECONDS = 60;
	//Seconds to wait for call to the db... INCREASE THIS VALUE IN PRODUCTION
	const POLL_WAIT_SECONDS = 2;
	
	//Db Conf
	const DB_HOST="localhost";
	const DB_NAME="xaja";
	const DB_USER="root";
	const DB_PSWD="";
	
}
