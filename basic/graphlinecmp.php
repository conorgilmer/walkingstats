<?php     
session_start();
    //Include phpMyGraph5.0.php 
    include_once('phpMyGraph5.0.php'); 
     
    //Set config directives 
    $cfg['title']  = $_GET['title'];  //name
    $cfg['width']  = $_GET['width'];  //500
    $cfg['height'] = $_GET['height']; //250


$data1s   = $_SESSION["data1"];
$data2s   = $_SESSION["data2"];

$data1 = unserialize($data1s);
$data2 = unserialize($data2s);    

    //Create phpMyGraph instance 
    $graph = new verticalLineGraph(); 

    //Parse 
    $graph->parseCompare($data1, $data2, $cfg); 
?> 
