<?php

/*
 * This constant is declared in index.php
* It prevents this file being called directly
*/
defined('MY_APP') or die('Restricted access');

$link_id=@mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);

if ($link_id) {
   // $flashMessage ="Successful Connect to database server";
    //put inside if
    if(mysql_select_db(DB_DATABASE, $link_id)) {

      //  $flashMessage = "Connected to Database";
    } else {
        echo("<b>Couldn't select db</b>");
    }
    
} else {
    
    echo ("<b>Couldn't connect to db</b>");
}