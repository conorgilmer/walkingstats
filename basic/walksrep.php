<?php
session_start();

/*
 * Set up constant to ensure include files cannot be called on their own
*/
define ( "MY_APP", 1 );
/*
 * Set up a constant to your main application path
 */
define ( "APPLICATION_PATH", "application" );
define ( "TEMPLATE_PATH", APPLICATION_PATH . "/view" );

include_once(APPLICATION_PATH . "/inc/session.inc.php");


/*
 * Include the config.inc.php file
 */
include (APPLICATION_PATH . "/inc/config.inc.php");
include (APPLICATION_PATH . "/inc/db.inc.php");
include (APPLICATION_PATH . "/inc/functions.inc.php");

//Set up variable so 'active' class set on navbar link
$activeHome = "active";

include (TEMPLATE_PATH . "/header.html");

?>

<div class="container">
<div class="row">
<div class="span12">
<h1>Walks Report</h1>
</div>
</div>
<div clas="row">
<div class="span9">

<?php 

//$avg_speed    = 0.0;
//$avg_distance = 0.0;
//$avg_time     = 0.0;
$min_speed    = 10.0;
$min_distance = 10.0;
$min_time     = 100.0;
$max_speed    = 0.0;
$max_distance = 0.0;
$max_time     = 0.0;
$tot_speed    = 0.0;
$tot_distance = 0.0;
$tot_time     = 0.0;
$number       = 0;


$sqlQuery = "SELECT * FROM walks";
$result = mysql_query($sqlQuery);


if ($result) {
	$htmlString = "";
	$htmlString .=  "<table class='table table-bordered table-condensed table-striped' border='1'>\n";
	
	$htmlString .= "<tr>";
	$htmlString .= "<th>Statistics</th>";
	$htmlString .= "<th>Minutes</th>";
	$htmlString .= "<th>Distance (KM)</th>";
	$htmlString .= "<th>Speed (KM/Hour)</th>";
	$htmlString .= "</tr>";
	
	while ($product = mysql_fetch_assoc($result))
	{       $number++;
        
                $tot_time     = $tot_time     + (float)$product["minutes"];
                $tot_distance = $tot_distance + (float)$product["distance_km"];
                $tot_speed    = $tot_speed    + (float)$product["speed"];
                $max_distance = ((float)$product["distance_km"] > $max_distance ? (float)$product["distance_km"] : $max_distance);
                $max_time  = ((float)$product["minutes"] > $max_time ? (float)$product["minutes"] : $max_time);
                $max_speed  = ((float)$product["speed"] > $max_speed ? (float)$product["speed"] : $max_speed);
                $min_distance = ((float)$product["distance_km"] < $min_distance ? (float)$product["distance_km"] : $min_distance);
                $min_time  = ((float)$product["minutes"] < $min_time ? (float)$product["minutes"] : $min_time);
                $min_speed  = ((float)$product["speed"] < $min_speed ? (float)$product["speed"] : $min_speed);

                
        }
        	$htmlString .=  "<tr>" ;
		$htmlString .=  "<td>";
		$htmlString .=  "Minimum";
		$htmlString .=  "</td>";
		$htmlString .=  "<td>";
		$htmlString .=  $min_time;
		$htmlString .=  "</td>";
		$htmlString .=  "<td>";
		$htmlString .=  $min_distance;
		$htmlString .=  "</td>";
		$htmlString .=  "<td>";
		$htmlString .=  $min_speed * 60;
		$htmlString .=  "</td>";		
		$htmlString .=  "</tr>\n";
                
                
        	$htmlString .=  "<tr>" ;
		$htmlString .=  "<td>";
		$htmlString .=  "Maximum";
		$htmlString .=  "</td>";
		$htmlString .=  "<td>";
		$htmlString .=  $max_time;
		$htmlString .=  "</td>";
		$htmlString .=  "<td>";
		$htmlString .=  $max_distance;
		$htmlString .=  "</td>";
		$htmlString .=  "<td>";
		$htmlString .=  $max_speed * 60;
		$htmlString .=  "</td>";
		
		$htmlString .=  "</tr>\n";
                
        	$htmlString .=  "<tr>" ;
		$htmlString .=  "<td>";
		$htmlString .=  "Averages";
		$htmlString .=  "</td>";
		$htmlString .=  "<td>";
		$htmlString .=  number_format((double)($tot_time/$number), 0,'.','');
		$htmlString .=  "</td>";
		$htmlString .=  "<td>";
		$htmlString .=  number_format((double)($tot_distance/$number), 2,'.','');
		$htmlString .=  "</td>";
		$htmlString .=  "<td>";
		$htmlString .=  number_format((double)($tot_speed*60/$number), 3,'.','');
		$htmlString .=  "</td>";		
		$htmlString .=  "</tr>\n";
                
        	$htmlString .=  "<tr>" ;
		$htmlString .=  "<td>";
		$htmlString .=  "Totals";
		$htmlString .=  "</td>";
		$htmlString .=  "<td>";
		$htmlString .=  $tot_time;
		$htmlString .=  "</td>";
		$htmlString .=  "<td>";
		$htmlString .=  $tot_distance;
		$htmlString .=  "</td>";
		$htmlString .=  "<td>";
		$htmlString .=  "N/A";
		$htmlString .=  "</td>";
		
		$htmlString .=  "</tr>\n";
                
                
        
	$htmlString .=  "</table>\n";
	
	echo $htmlString ;
	
	
	
} else {
	
	die("Failure: " . mysql_error($link_id));
}
?>
</div>
<div class="span3"></div>

</div>


</div> <!-- /container -->
<?php 
include (TEMPLATE_PATH . "/footer.html");
?>
