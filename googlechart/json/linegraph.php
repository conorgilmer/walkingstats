<?php
   include('config.php');
     
    $db =  mysql_connect($dbhost,$dblogin,$dbpwd);
    mysql_select_db($dbname);    
	
    $SQLString = "SELECT places.name as place, COUNT(walks.id) as cnt FROM `places` LEFT JOIN `walks` ON places.id = walks.place GROUP BY places.id;";

// The Chart table contain two fields: Date and PercentageChange
$queryData = mysql_query("
	SELECT
		date,
		minutes,
		distance_km
	FROM walks ");

$table = array();
$table['cols'] = array(
    array('label' => 'Date', 'type' => 'string'),
    array('label' => 'minutes', 'type' => 'number')
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
	$temp[] = array('v' => (float) $r['minutes']); 
//	$temp[] = array('v' => (float) $r['distance_km']); 
	$rows[] = array('c' => $temp);
}

$table['rows'] = $rows;
$jsonTable = json_encode($table);
?>
<!DOCTYPE html>
<html>
<head>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script type="text/javascript">
		// Load the Visualization API and the chart package.
		google.load('visualization', '1', {'packages':['corechart']});

		// Set a callback to run when the Google Visualization API is loaded.
		google.setOnLoadCallback(drawChart);

		function drawChart() {
			// Create our data table out of JSON data loaded from server.
			var data = new google.visualization.DataTable(<?=$jsonTable?>);
			var options = {
				title: 'Walking Time',
				width: 500,
				height: 300
			};
			// Instantiate and draw our chart, passing in some options.
			var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
			chart.draw(data, options);
		}
    </script>
</head>

<body>
	<!--Div that will hold the pie chart-->
	<div id="chart_div"></div>
</body>
</html>






