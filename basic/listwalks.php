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
<h1>List Walks</h1>
</div>
</div>
<div clas="row">
<div class="span12">

<?php 

$sqlQuery = "SELECT * FROM walks";
$result = mysql_query($sqlQuery);


if ($result) {
	$htmlString = "";
	$htmlString .=  "<table class='table table-bordered table-condensed table-striped' border='1'>\n";
	
	$htmlString .= "<tr>";
	$htmlString .= "<th>ID</th>";
	$htmlString .= "<th>Minutes</th>";
	$htmlString .= "<th>Distance</th>";
	$htmlString .= "<th>Speed</th>";
        $htmlString .= "<th>Calories</th>";
        $htmlString .= "<th>Place</th>";
        $htmlString .= "<th>Description</th>";
        $htmlString .= "<th>Date Added</th>";
	$htmlString .= "<th>Added by</th>";
	$htmlString .= "<th colspan='2'>Actions</th>";

	$htmlString .= "</tr>";
	
	while ($product = mysql_fetch_assoc($result))
	{
		$htmlString .=  "<tr>" ;
		$htmlString .=  "<td>";
		$htmlString .=  $product["id"];
		$htmlString .=  "</td>";
		$htmlString .=  "<td>";
		$htmlString .=  $product["minutes"];
		$htmlString .=  "</td>";
		$htmlString .=  "<td>";
		$htmlString .=  $product["distance_km"];
		$htmlString .=  "</td>";
		$htmlString .=  "<td>";
		$htmlString .=  $product["speed"];
		$htmlString .=  "</td>";
                $htmlString .=  "<td>";
		$htmlString .=  $product["calories"];
		$htmlString .=  "</td>";
                $htmlString .=  "<td>";
		$htmlString .=  getRoute($product["place"]);
		$htmlString .=  "</td>";
                
                		$htmlString .=  "<td>";
		$htmlString .=  $product["description"];
		$htmlString .=  "</td>";
		$htmlString .=  "<td>";
                $htmlString .=  $product["date"];
//		$htmlString .=  getCountry($product["date"]);
		$htmlString .=  "</td>";
		$htmlString .=  "<td>";
		$htmlString .=  $product["addedby"];
		$htmlString .=  "</td>";
		
		$htmlString .=  "<td>";
		$htmlString .=  output_edit_link($product["id"]);
		$htmlString .=  "</td>";
		
		$htmlString .=  "<td>";
		$htmlString .=  output_delete_link($product["id"]);
		$htmlString .=  "</td>";
		
		
		
		$htmlString .=  "</tr>\n";
		
	}
	$htmlString .=  "</table>\n";
	
	echo $htmlString ;
	
	
	
} else {
	
	die("Failure: " . mysql_error($link_id));
}
?>
</div>


</div> <!-- /container -->
<?php 
include (TEMPLATE_PATH . "/footer.html");
?>
