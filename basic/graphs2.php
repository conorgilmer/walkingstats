<?php
/* Walking Tracker */
/*
 * Set up constant to ensure include files cannot be called on their own
*/
define ( "MY_APP", 1 );
/*
 * Set up a constant to your main application path
*/
define ( "APPLICATION_PATH", "application" );
define ( "TEMPLATE_PATH", APPLICATION_PATH . "/view" );

/*
 * Include the config.inc.php file
 */
include (APPLICATION_PATH . "/inc/config.inc.php");
include (APPLICATION_PATH . "/inc/db.inc.php");

include (TEMPLATE_PATH . "/public/header.html");


?>


<div class="container">
<div class="row">
<div class="span12">
<h1>Graphs Distance and Speed</h1>
</div>
</div>
<div class="row">
<div class="span5">

<?php 

$graphtitle = "Distance in KM";
$graphwidth = 500;
$graphheight = 400;

$graphlineurl1="graph_line_generic.php?title=".$graphtitle."&width=".$graphwidth."&height=".$graphheight."&table=walks&xaxis=date&yaxis=distance_km";
?>
<img src="<?echo $graphlineurl1;?>"/>
</div>

<div class="span5">


<?php

$graphtitle2 = "Speed (Distance/Time) KM per Hour";
$graphwidth2 = 550;
$graphheight2 = 425;

$graphlineurl2="graph_line_generic.php?title=".$graphtitle2."&width=".$graphwidth2."&height=".$graphheight2."&table=walks&xaxis=date&yaxis=speed";

?>
    <img src="<?echo $graphlineurl2;?>"/>

</div>
</div> <!-- /container -->
<div class="row">
    <div class="span5">
    <img src="http://localhost/walkingstats/basic/pieplaces.php?title=Places+Walked&height=300&width=450">    
    </div>
    <div class="span5">
        <img src="http://localhost/walkingstats/basic/line.php?title=Time+Minutes&height=300&width=450&xaxis=date&yaxis=minutes&table=walks"/>
    </div>

</div>



<?php include (TEMPLATE_PATH . "/public/footer.html"); ?>
