<?php

/*
 * This constant is declared in index.php
* It prevents this file being called directly
*/
defined('MY_APP') or die('Restricted access');

/*
 * Declare a number of constants that you can change depending on your application
 */
define("DB_HOST",""); //localhost or your host
define("DB_USER",""); //dbuser
define("DB_PASSWORD",""); //dbpwd
define("DB_DATABASE","walking_stats");

/*
 * Declare a number of constants that you can change depending on your application
*/

define("VERSION_NUMBER","1.0");

define("COMPANY_NAME","Webwayz");

define("APPLICATION_NAME","Walking Tracking Statistics App");

define("UPLOAD_PATH",  realpath(dirname(__FILE__)) . "/../../uploads/");
