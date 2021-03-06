<?php
        /* Libchart - PHP chart library
         * Copyright (C) 2005-2011 Jean-Marc Trémeaux (jm.tremeaux at gmail.com)
         *
         * This program is free software: you can redistribute it and/or modify
         * it under the terms of the GNU General Public License as published by
         * the Free Software Foundation, either version 3 of the License, or
         * (at your option) any later version.
         *
         * This program is distributed in the hope that it will be useful,
         * but WITHOUT ANY WARRANTY; without even the implied warranty of
         * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
         * GNU General Public License for more details.
         *
         * You should have received a copy of the GNU General Public License
         * along with this program.  If not, see <http://www.gnu.org/licenses/>.
         *
         */

        /**
         * Direct PNG output demonstration (image not saved to disk)
         *
         */
define ( "MY_APP", 1 );
/*
 * Set up a constant to your main application path
 */
define ( "APPLICATION_PATH", "application" );
define ( "TEMPLATE_PATH", APPLICATION_PATH . "/view" );


/*
 * Include the config.inc.php file
 */
include (APPLICATION_PATH . "/inc/config.inc.php");
include (APPLICATION_PATH . "/inc/db.inc.php");
include (APPLICATION_PATH . "/inc/functions.inc.php");


	$title  = $_GET['title'];
	$height = $_GET['height'];
	$width  = $_GET['width'];
        include "library/libchart/classes/libchart.php";

        header("Content-type: image/png");

        $chart = new PieChart($width, $height);

        $dataSet = new XYDataSet();
$sqlQuery = "SELECT * FROM places";
$result = mysql_query($sqlQuery);

if ($result) {
	while ($db_field = mysql_fetch_assoc($result))
	{
		$place_id =  $db_field['id'];
		$sqlQuery1 = "SELECT count(*) as num  FROM walks where place = $place_id";
		$result1 = mysql_query($sqlQuery1);

		if ($result1) {
        		while ($db_field1 = mysql_fetch_assoc($result1))
        		{
			$count = $db_field1['num'];
		        $dataSet->addPoint(new Point($db_field['name'], $count));
     			}	
		} else {

        		die("Failure: ");
		}
       }
} else {
        
        die("Failure: ");
}
 


        $chart->setDataSet($dataSet);

        $chart->setTitle($title);
        $chart->render();
?>

