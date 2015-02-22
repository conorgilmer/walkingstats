<?php
session_start();
/*
 * Set up constant to ensure include files cannot be called on their own
*/
define ( "MY_APP", 1 );

define ( "APPLICATION_PATH", "application" );
/*
 * Include the config.inc.php file
 */
include_once (APPLICATION_PATH . "/inc/session.inc.php");
include (APPLICATION_PATH . "/inc/config.inc.php");
include (APPLICATION_PATH . "/inc/db.inc.php");

// output headers so that the file is downloaded rather than displayed
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=data.csv');

// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// output the column headings
fputcsv($output, array('Minutes', 'Distance KM', 'Speed', 'Date'));

// fetch the data
mysql_connect('localhost', DB_USER,DB_PASSWORD);
mysql_select_db(DB_DATABASE);
$rows = mysql_query('SELECT minutes,distance_km,speed, date FROM walks');

// loop over the rows, outputting them
while ($row = mysql_fetch_assoc($rows)) fputcsv($output, $row);

?>

