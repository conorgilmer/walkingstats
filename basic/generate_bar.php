<?php
session_start();    
    //Set content-type header
    header("Content-type: image/png");

    //Include phpMyGraph5.0.php
    include_once('phpMyGraph5.0.php');
    
    //Set config directives 
    $cfg['title']  = $_GET['title'];  //name
    $cfg['width']  = $_GET['width'];  //500
    $cfg['height'] = $_GET['height']; //250

    $datastr   = $_SESSION["data"];

    $data = unserialize($datastr);
    
    //Create phpMyGraph instance
    $graph = new phpMyGraph();

    //Parse
    $graph->parseVerticalSimpleColumnGraph($data, $cfg);
?>
