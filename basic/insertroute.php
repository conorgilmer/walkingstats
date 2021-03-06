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
$product['name'] = "";
$product['date'] = '';
$product['id'] =0;


if (!empty($_POST)) {
	
	$product = array();
	$product['name'] = htmlspecialchars(strip_tags($_POST["name"]));
 	$product['date'] = htmlspecialchars(strip_tags($_POST["date"]));
        $product['id'] = isset($_POST["id"]) ? (int) $_POST["id"] : 0;
        
	$flashMessage = "";
	if (validateRoute($product)) {
		if ($product['id'] == 0) {
         //New! Save route returns the id of the record inserted         
		$id = saveRoute($product);
	//	uploadFiles($product_id);
		
		
		$flashMessage = "Record has been saved";
                } else {
                    
                    updateRoute($product);
                        header("Location: listroutes.php");
                }		
		
	}
        else {
            $flashMessage ="Error - you need to enter a " . $_SESSION['errmsg'];
        }
	
	

	
	
	}//end post
	

?>
<?php 
$activeInsert = "active";
$buttonLabel = "Insert New Route";
include (TEMPLATE_PATH . "/header.html");
include (TEMPLATE_PATH . "/form_route_insert.html");
include (TEMPLATE_PATH . "/footer.html");
?>