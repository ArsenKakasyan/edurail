<?php

/***
* app info
*/
define('APP_NAME', 'EduRails');
define('APP_DESC', 'Study languages from your localhost');

/***
* database config
*/
if($_SERVER['SERVER_NAME'] == 'localhost')
{
	//database config for local server
	define('DBHOST', 'localhost');
	define('DBNAME', 'fluent_db');
	define('DBUSER', 'root');
	define('DBPASS', '');
	define('DBDRIVER', 'mysql');

	//root path e.g localhost/
	define('ROOT', 'http://localhost/edurails/public');
}else
{
	//database config for live server
	define('DBHOST', 'localhost');
	define('DBNAME', 'fluent_db');
	define('DBUSER', 'root');
	define('DBPASS', '');
	define('DBDRIVER', 'mysql');

	//root path e.g https://www.yourwebsite.com
	define('ROOT', 'http://');
}