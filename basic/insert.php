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

/* Prevent unauthorised access */
include_once(APPLICATION_PATH . "/inc/session.inc.php");

/*
 * Include the config.inc.php file
 */
include (APPLICATION_PATH . "/inc/config.inc.php");
include (APPLICATION_PATH . "/inc/db.inc.php");
include (APPLICATION_PATH . "/inc/functions.inc.php");
include (APPLICATION_PATH . "/inc/queries.inc.php");
include (APPLICATION_PATH . "/inc/ui_helpers.inc.php");
$product = array();
$product['id'] =0;
$product['minutes'] = "";
$product['description'] = "";
$product['distance_km'] ="";
$product['speed'] ="";
$product['calories'] ="";
$product['place'] ="";
$product['addedby'] ="";
$product['product_id']="";
$product['date']="";


if (!empty($_POST)) {
	
	
	$product = array();
	$product['minutes']     = htmlspecialchars(strip_tags($_POST["minutes"]));
	$product['description'] = htmlspecialchars(strip_tags($_POST["description"]));
	$product['distance_km'] = htmlspecialchars(strip_tags($_POST["distance_km"]));
	$product['calories']    = htmlspecialchars(strip_tags($_POST["calories"]));
        $product['place']       = (int)htmlspecialchars(strip_tags($_POST["place"]));
	$product['addedby']     = htmlspecialchars(strip_tags($_POST["addedby"]));
   	$product['date']        = htmlspecialchars(strip_tags($_POST["date"]));
        $product['id']          = isset($_POST["id"]) ? (int) $_POST["id"] : 0;
        
	$flashMessage = "";
	if (validateWalk($product)) {
		if ($product['id'] == 0) {
         //New! Save Walk returns the id of the record inserted         
		$product_id = saveWalk($product);
		
		
		$flashMessage = "Record has been saved";
                } else {
                    //update product record and upload new file
                    updateWalk($product);
             //flash record updated
        	    $flashMessage = "Record has been updated";
                	
                    header("Location: listwalks.php");
                }	
	}
        else
        {
            $flashMessage = "Error - " . $_SESSION['errmsg'];
        }
	}//end post
	

?>
<?php 
$activeInsert = "active";
$buttonLabel = "Insert a New Walk";
include (TEMPLATE_PATH . "/header.html");
include (TEMPLATE_PATH . "/form_insert.html");
include (TEMPLATE_PATH . "/footer.html");
?>