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
<h1>Graph Minutes</h1>
</div>
</div>
<div clas="row">
<div class="span9">

<?php 
$route  = $_GET['route'];
$data1 = array();
$data2 = array();
$graphtitle = "Minutes Walked";
$graphwidth = 800;
$graphheight = 400;
$sqlQuery = "SELECT * FROM walks where place=$route";
$result = mysql_query($sqlQuery);


if ($result) {
//	$htmlString = "";
	while ($db_field = mysql_fetch_assoc($result))
	{	
         //   $htmlString .=  $route["date"];
          //  $data1[$db_field['date']] = $db_field['distance_km'];
            $data1[$db_field['date']] = $db_field['minutes'];
            
	}
} else {
	
	die("Failure: ");
}

$_SESSION['data1'] = serialize($data1);
//$_SESSION['data2'] = serialize($data2);

?>
    <img src="graphline.php?title=<? echo $graphtitle;?>&width=<?echo $graphwidth;?>&height=<?echo $graphheight;?>">


 <p><a href="graphspeedroutes.php?route=<?echo $route?>" class=btn btn-primary role=button>Speed</a> 
 <a href="graphkmroute.php?route=<?echo $route?>" class=btn btn-primary role=button>Distance</a> 
 </p>

</div>
<div class="span3"></div>

</div>


</div> <!-- /container -->
<?php 
include (TEMPLATE_PATH . "/footer.html");
?>