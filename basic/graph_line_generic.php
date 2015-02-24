<?php     
//session_start();
    //Include phpMyGraph5.0.php 
    include_once('phpMyGraph5.0.php'); 
    
define ( "MY_APP", 1 );
define ( "APPLICATION_PATH", "application" );
define ( "TEMPLATE_PATH", APPLICATION_PATH . "/view" );

//include_once(APPLICATION_PATH . "/inc/session.inc.php");
include (APPLICATION_PATH . "/inc/config.inc.php");
include (APPLICATION_PATH . "/inc/db.inc.php");
include (APPLICATION_PATH . "/inc/functions.inc.php");

 
    //Set config directives 
    $cfg['title']  = $_GET['title'];
    $cfg['width']  = $_GET['width'];
    $cfg['height'] = $_GET['height'];
    $table         = $_GET['table'];
    $xaxis         = $_GET['xaxis'];
    $yaxis         = $_GET['yaxis'];

$sqlQuery = "SELECT * FROM $table";
$result = mysql_query($sqlQuery);


if ($result) {
	while ($db_field = mysql_fetch_assoc($result))
	{	
            $data1[$db_field[$xaxis]] = $db_field[$yaxis];
	}
} else {
	
	die("Failure: ");
}


    //Create phpMyGraph instance 
    $graph = new verticalLineGraph(); 

    //Parse 
     $graph->parsecompare($data1,$data1, $cfg); 
?> 
