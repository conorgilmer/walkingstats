<?php
   include('config.php');
     
    $db =  mysql_connect($dbhost,$dblogin,$dbpwd);
    mysql_select_db($dbname);    
	
    $day = date('d');
    $month = date('m');
    $lastMonth = (string)($month-1);	
    $lastMonth = strlen($month - 1) == 1? '0'.$lastMonth : $lastMonth;
 
    $SQLString = "SELECT places.name as place, COUNT(walks.id) as cnt FROM `places` LEFT JOIN `walks` ON places.id = walks.place GROUP BY places.id;";

    $result = mysql_query($SQLString);    
    $num = mysql_num_rows($result);   

    $table = array();
    $table['cols'] = array(
    array('id' => "", 'label' => 'place', 'pattern' => "", 'type' => 'string'),
    array('id' => "", 'label' => 'times', 'pattern' => "", 'type' => 'number')
    );

 //Create an array
    $rows = array();
    while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
	$temp = array();
    	$temp[] = array('v' => $row['place'], 'f' =>NULL);
    	$temp[] = array('v' => (int)$row['cnt'], 'f' =>NULL);
    	$rows[] = array('c' => $temp);
   
    }

	$table['rows'] = $rows;
        $jsonTable = json_encode($table);
        echo $jsonTable;


    mysql_close($db);
?>
