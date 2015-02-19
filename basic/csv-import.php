<?php

$connect = mysql_connect('localhost','root','');

if (!$connect) {
	die('Could not connect to MySQL: ' . mysql_error());
}

$cid =mysql_select_db('walking_stats',$connect);
// supply your database name

define('CSV_PATH','C:/wamp/www/csvfile/');
// path where your CSV file is located

//$csv_file = CSV_PATH . "dadwalking.csv"; // Name of your CSV file
$csv_file = "walking.csv"; // Name of your CSV file
$csvfile = fopen($csv_file, 'r');
$theData = fgets($csvfile);
$i = 0;
while (!feof($csvfile)) {
$csv_data[] = fgets($csvfile, 1024);
$csv_array = explode(",", $csv_data[$i]);
$insert_csv = array();
$insert_csv['ID'] = '';
$insert_csv['date'] = $csv_array[0];
$insert_csv['minutes'] = $csv_array[1];
$insert_csv['km'] = $csv_array[2];
$insert_csv['speed'] = (float)$csv_array[2]/(float)$csv_array[1];
$insert_csv['place'] = $csv_array[3];
$insert_csv['desc'] =  $csv_array[4];
$insert_csv['addedby'] = $csv_array[5];
$dateadded = date("Y-m-d", strtotime($insert_csv['date']));
echo $dateadded . "<br>";
$query = "INSERT INTO walks(ID,minutes,distance_km,speed,place,description,date,addedby)
VALUES('','".$insert_csv['minutes']."','".$insert_csv['km']."','".$insert_csv['speed']."','".$insert_csv['place']."' ,'".$insert_csv['desc']."' ,'".$dateadded."' ,'".$insert_csv['addedby']."'    )";
$n=mysql_query($query, $connect );
$i++;
print_r($insert_csv);
echo "<br>";
}
fclose($csvfile);

echo "File data successfully imported to database!!";
mysql_close($connect);
?>
