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
<h1>Graph Calories</h1>
</div>
</div>
<div clas="row">
<div class="span9">

<?php 
$data1 = array();
$data2 = array();
$graphtitle = "Calories";
$graphwidth = 800;
$graphheight = 400;
$sqlQuery = "SELECT * FROM walks";
$result = mysql_query($sqlQuery);


if ($result) {
//	$htmlString = "";
	while ($db_field = mysql_fetch_assoc($result))
	{	
         //   $htmlString .=  $route["date"];
          //  $data1[$db_field['date']] = $db_field['distance_km'];
            if (empty($db_field['calories'])) {
                $data1[$db_field['date']] = 0;
                } else {
                $data1[$db_field['date']] = $db_field['calories'];
            }
	}
} else {
	
	die("Failure: ");
}

$_SESSION['data1'] = serialize($data1);
//$_SESSION['data2'] = serialize($data2);

?>
    <img src="graphline.php?title=<? echo $graphtitle;?>&width=<?echo $graphwidth;?>&height=<?echo $graphheight;?>">

    <p><a href="graphspeed.php" class=btn btn-primary role=button>Speed</a> 
 <a href="graphmin.php" class=btn btn-primary role=button>Time</a> 
 <a href="graphkm.php" class=btn btn-primary role=button>Distance</a> 

 </p>


</div>
<div class="span3"></div>

</div>


</div> <!-- /container -->
<?php 
include (TEMPLATE_PATH . "/footer.html");
?>