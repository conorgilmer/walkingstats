<?php

/*
 * This constant is declared in index.php
* It prevents this file being called directly
*/
defined('MY_APP') or die('Restricted access');

// validate the route
function validateRoute($route) {
	// if there is date and name
 	if(trim($route['name']) == '')
	{
		$_SESSION['errmsg'] = 'Please enter a Route Name <br>';
                return false;
	}
   
		else if(trim($route['date']) == '')
	{
		$_SESSION['errmsg'] = 'Please enter the date <br>';
                return false;
	}

	return true;
	
	
} /* end of validate route - need to put more in here*/

// validate the walk
function validateWalk($walk) {
	// if minutes and distance are numbers
        // if place is a valid place/route and date
    	if(trim($walk['minutes']) == '')
	{
		$_SESSION['errmsg'] = 'Please enter a time in minutes <br>';
                return false;
	}
    	else if (is_numeric(trim($walk['minutes'])) == false)
	{
		$_SESSION['errmsg'] = 'Minutes need to be in numbers <br>';
                return false;
	}
	else if(trim($walk['distance_km']) == '')
	{
		$_SESSION['errmsg'] = 'Please enter the distance<br>';
                return false;
	}
        else if (is_numeric(trim($walk['distance_km'])) == false)
	{
		$_SESSION['errmsg'] = 'Distance need to be in numbers <br>';
                return false;
	}
	else if(trim($walk['date']) == '')
	{
		$_SESSION['errmsg'] = 'Please enter the date <br>';
                return false;
	}	
	return true;
	        
} /* end of validate walk - need to put more in here */

// get the route name
function getRoute($r_id ) {
	
	$sqlQuery = "SELECT name from places where id = " . $r_id;
	
	$result = mysql_query($sqlQuery);

	if (!$result) {
		echo $sqlQuery;
		
		die("error" . mysql_error());
	} 
	//comment in	
        $ret = mysql_fetch_array($result);
	return $ret['name'];
	
} /* end of getRoute */

// save a walk
function saveWalk($walk ) {
        
        $addeddate = date("Y-m-d", strtotime($walk['date']));
        //die($addeddate);
        $speed = ((float)$walk['distance_km']) / ((float)$walk['minutes']);
	$sqlQuery = "INSERT INTO walks (id, minutes, distance_km, speed, calories, place, description, date, addedby)
        values ('', '{$walk['minutes']}', '{$walk['distance_km']}','{$speed}','{$walk['calories']}','{$walk['place']}',
            '{$walk['description']}', '{$addeddate}', '{$walk['addedby']}')";
	
	$result = mysql_query($sqlQuery);

	if (!$result) {
		echo $sqlQuery;
		
		die("error" . mysql_error());
	} 
	//comment in	
	return mysql_insert_id();
	
} /* end of save walk */

// update save a walk
function updateWalk($walk ) {
        
        $addeddate = date("Y-m-d", strtotime($walk['date']));
        //die($addeddate);
        $speed = ((float)$walk['distance_km']) / ((float)$walk['minutes']);
	/*$sqlQuery = "INSERT INTO walks (id, minutes, distance_km, speed, place, description, date, addedby)
        values ('', '{$walk['minutes']}', '{$walk['distance_km']}','{$speed}','{$walk['place']}',
            '{$walk['description']}', '{$addeddate}', '{$walk['addedby']}')";
	*/
        
        $walkID = (int) $walk['id'];
        $sqlQuery = "UPDATE walks SET ";
        $sqlQuery .= " minutes = '". $walk['minutes'] . "'";
        $sqlQuery .= ", distance_km = '". $walk['distance_km'] . "'";
        $sqlQuery .= ", speed = '". $speed . "'";
        $sqlQuery .= ", calories = '". $walk['calories'] . "'";
        $sqlQuery .= ", place = '". $walk['place'] . "'";
        $sqlQuery .= ", description = '". $walk['description'] . "'";
        $sqlQuery .= ", date = '". $addeddate . "'";
        $sqlQuery .= ", addedby = '". $walk['addedby'] . "'";
        $sqlQuery .= " WHERE id = $walkID";
        
        
        
	$result = mysql_query($sqlQuery);

	if (!$result) {
		echo $sqlQuery;
		
		die("error" . mysql_error());
	} 
	//comment in	
	return mysql_insert_id();
	
} /* end of update walk */


// save a route
function saveRoute($route ) {
        
        $addeddate = date("Y-m-d", strtotime($route['date']));
        //die($addeddate);
	$sqlQuery = "INSERT INTO places (name, date)
        values ('{$route['name']}', '{$addeddate}')";
	
	$result = mysql_query($sqlQuery);

	if (!$result) {
		echo $sqlQuery;
		
		die("error" . mysql_error());
	} 
	//comment in	
	return mysql_insert_id();
	
} /* end of save Route */

//update route
function updateRoute($product) {
    //die ("in update maker");
    $routeID = (int) $product['id'];
    $sqlQuery = "UPDATE places SET ";
    $sqlQuery .= " name = '". $product['name'] . "'";
    //print_r($product);
    $addeddate = date("Y-m-d", strtotime($product['date']));
   // print_r($addeddate);
    $sqlQuery .= ", date = '". $addeddate . "'";
   
    $sqlQuery .= " WHERE id = $routeID";
    //die($sqlQuery);
    $result = mysql_query($sqlQuery);
	 
	if (!$result) {
		die("error" . mysql_error());
        }
} /* end of updateRoute */

// delete route
function deleteRoute($id) {
    $routeID = (int) $id;
    $sqlQuery = "DELETE FROM places where id = $routeID";
    
    $result = mysql_query($sqlQuery);
    if (!$result) {
		die("error" . mysql_error());
        }
} /* end of delete route */


// delete walk
function deleteWalk($id) {
    $walkID = (int) $id;
    $sqlQuery = "DELETE FROM walks where id = $walkID";
    
    $result = mysql_query($sqlQuery);
    if (!$result) {
		die("error" . mysql_error());
        }
} /* end of delete Walk */


// return the route details
function retrieveWalk($id) {

	$sqlQuery = "SELECT * from walks WHERE id = $id";
	$result = mysql_query($sqlQuery);
	if(!$result) die("error" . mysql_error());
	
	return mysql_fetch_assoc($result);
	
} /* end fo retrieve walk */


// return the route details
function retrieveRoute($id) {

	$sqlQuery = "SELECT * from places WHERE id = $id";
       
        $result = mysql_query($sqlQuery);
	
        if(!$result) die("error" . mysql_error());
	
	return mysql_fetch_assoc($result);
	
} /* end of retrieve route details */


/* form the link for graph speed for routes */
function output_route_speed($id){
    return "<a href ='graphspeedroutes.php?route=$id'>Speed</a>";
}

/* form the link for graph distance for routes */
function output_route_distance($id){
    return "<a href ='graphkmroute.php?route=$id'>Distance</a>";
}

/* form the link for graph time for routes */
function output_route_time($id){
    return "<a href ='graphminroute.php?route=$id'>Time</a>";
}

/* form the link for graph calories for routes */
function output_route_cal($id){
    return "<a href ='graphcalroute.php?route=$id'>Calories</a>";
}

function output_edit_link($id) {
	
	return "<a href='edit.php?id=$id'>Edit</a>";	
	
} /* end of build output edit walk link */

function output_delete_link($id) {

	return "<a href='delete.php?id=$id'>Delete</a>";

} /* end of build output delete walk link */

//edit places

function output_edit_route_link($id) {
	
	return "<a href='editroute.php?id=$id'>Edit</a>";
	
} /* end of build output edit route link */

function output_delete_route_link($id) {
//
	return "<a href='deleteroute.php?id=$id'>Delete</a>";

} /* end of build output delete route link */

// build options selected html
function output_selected($currentValue, $valueToMatch) {
	
	
	if ($currentValue == $valueToMatch) {
		
		return "selected ='selected'";
		
	}	
} /* end of build selected options menu */

// authenticate login funciton
function authenticate($username, $password) {   
    $boolAuthenticated = false;
    
    $sqlQuery = "SELECT * from adminusers WHERE ";
    $sqlQuery .= "username = '" . $username . "'";
    $sqlQuery .= " AND ";
    $sqlQuery .= "password = '" .$password . "'";
    
    $result = mysql_query($sqlQuery);
    
    if (!$result)  die("Error: " . $sqlQuery . mysql_error());
    
    if (mysql_num_rows($result)==1) {
        $boolAuthenticated = true;
    }
    
    return $boolAuthenticated;
    
} /* login user authenticate */


function writeCSV ($table){
    $result=mysql_query("select * from $table ");

    $out = '';

    // Get all fields names in table.
    $fields = mysql_list_fields('walking_stats',$table);

    // Count the table fields and put the value into $columns.
    $columns = mysql_num_fields($fields);

    // Put the name of all fields to $out.
    for ($i = 0; $i < $columns; $i++) {
        $l=mysql_field_name($fields, $i);
        $out .= '"'.$l.'",';
    }
    $out .="\r\n";

    // Add all values in the table to $out.
    while ($l = mysql_fetch_array($result)) {
        for ($i = 0; $i < $columns; $i++) {
            $out .='"'.$l["$i"].'",';
        }
        $out .="\r\n";

    }

    try {
    // Open file export.csv.
    $f = fopen ('export.csv','w');

    // Put all values from $out to export.csv.
    fputs($f, $out);
    fclose($f);
    } catch (Exception $e) {
        return FALSE;
    }
    return TRUE;
}