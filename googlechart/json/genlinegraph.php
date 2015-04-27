<?php
   include('config.php');

    $choice = $_GET["q"]; 
    $db =  mysql_connect($dbhost,$dblogin,$dbpwd);
    mysql_select_db($dbname);    
	
// The Chart table contain two fields: Date and PercentageChange
$queryData = mysql_query("
	SELECT
		date,
		minutes,
		speed,
		distance_km,
		calories
	FROM walks ");

$table = array();
$table['cols'] = array(
    array('label' => 'Date', 'type' => 'string'),
    array('label' => $choice, 'type' => 'number')
);
//,
 //   array('label' => 'distance', 'type' => 'number')
//);

//First Series
$rows = array();
while($r = mysql_fetch_assoc($queryData)) {
	$temp = array();
	// the following line will used to slice the Pie chart
	$temp[] = array('v' => (string) $r['date']); 

	//Values of the each slice
	$temp[] = array('v' => (float) $r[$choice]); 
//	$temp[] = array('v' => (float) $r['distance_km']); 
	$rows[] = array('c' => $temp);
}

$table['rows'] = $rows;
$jsonTable = json_encode($table);

echo $jsonTable;

?>






