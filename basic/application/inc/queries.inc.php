<?php

/*
 * Gets a complete list of movies Returns: Associative Array
 */
function product_listing_get() {
	
	$sqlQuery = "SELECT * FROM products";
	$result = mysql_query ( $sqlQuery );
	$records = array ();
	
	while ( $records [] = mysql_fetch_assoc ( $result ) )
		;
	
	array_pop ( $records ); // pop the null record which was pushed on as last item
	
	return $records;

}

/*
 * Gets a complete list of movies Returns: Associative Array
 */
function product_listing_get_byid($movie_id) {
	
	$movie_id = ( int ) $movie_id;
	$sqlQuery = "SELECT * FROM products where movie_id=$movie_id";
	$result = mysql_query ( $sqlQuery );
	$records = array ();
	
	while ( $records [] = mysql_fetch_assoc ( $result ) )
		;
	
	array_pop ( $records ); // pop the null record which was pushed on as last item
	
	return $records;

}

/*
 * Gets a complete list of movies Returns: Associative Array
 */
function countwalks($place_id) {
	
	$place_id = ( int ) $place_id;
	$sqlQuery = "SELECT * FROM walks where place=$place_id";
	$result = mysql_query ( $sqlQuery );
	$records = array ();
	
	while ( $records [] = mysql_fetch_assoc ( $result ) )
		;
	
	array_pop ( $records ); // pop the null record which was pushed on as last item
	
	return $records;

}

function route_get_all() {
	
	$sqlQuery = "SELECT * FROM places where 1 order by id asc";
	$result = mysql_query ( $sqlQuery );
	$records = array ();
	
	if ($result) {
		while ( $records [] = mysql_fetch_assoc ( $result ) );
		
		
		
		array_pop ( $records ); // pop the null record which was pushed on as last
		                     // item
	}
	return $records;

}
