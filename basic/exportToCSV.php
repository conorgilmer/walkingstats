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
<h1>List Routes</h1>
</div>
</div>
<div clas="row">
<div class="span9">

<?php 
//@session_start();
// Connect database
//
//
//require("db.inc");
$database = "walking_stats";
$table = "walks";
$fileout = 'export.csv';

//$db = mysql_connect("localhost", "root", "");
//	mysql_select_db($database, $db) or die(mysql_errno() . ": " . mysql_error() . "<br>");

$result=mysql_query("select * from $table ");

$out = '';

if ($result) {
// Get all fields names in table "name_list" in database "tutorial".
$fields = mysql_list_fields(DB_DATABASE,$table);

// Count the table fields and put the value into $columns.
$columns = mysql_num_fields($fields);


// Put the name of all fields to $out.
/*for ($i = 0; $i < $columns; $i++) {
$l=mysql_field_name($fields, $i);
$out .= '"'.$l.'",';
}
$out .="\r\n";
*/
// Add all values in the table to $out.
while ($l = mysql_fetch_array($result)) {
for ($i = 0; $i < $columns; $i++) {
//$out .='"'.$l["$i"].'",';
$out .=trim($l["$i"]).' ,';

    $outhtml .= $out;
}
$out .="\n";
$outhtml .="<br>";
//$edit_item = "update table set status='exported'";
//    mysql_query($edit_item) or die(mysql_error());

}



// Open file export.csv.
$f = fopen ($fileout,'w');

// Put all values from $out to export.csv.
fputs($f, $out);
fclose($f);


   // $flashMessage = "csv exported";
                	
             //       header("Location: listwalks.php");
header('Content-type: application/csv');
header('Content-Disposition: attachment; filename="export.csv"');
//readfile('.csv');
//echo $outhtml;
//session_destroy();
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

