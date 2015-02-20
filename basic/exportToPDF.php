<?php
session_start();

require("fpdf.php");
/*
 * Include the config.inc.php file
 */
define ( "MY_APP", 1 );
define ( "APPLICATION_PATH", "application");
include_once(APPLICATION_PATH . "/inc/session.inc.php");
include (APPLICATION_PATH . "/inc/config.inc.php");
include (APPLICATION_PATH . "/inc/db.inc.php");
include (APPLICATION_PATH . "/inc/functions.inc.php");

class PDF extends FPDF
{

/* header and footer function */
function Header()
{
    //Select Arial bold 15
    $this->SetFont('Arial','B',15);
    //Move to the right
    $this->Cell(80);
    //Framed title frame set to 0 so no frame
    $this->Cell(30,10,'Walk Tracker',0,0,'C');
    //Line break
    $this->Ln(20);
}    /* header fn */
    
function Footer()
{
    //Go to 1.5 cm from bottom
    $this->SetY(-15);
    //Select Arial italic 8
    $this->SetFont('Arial','I',8);
    //Print centered page number
    $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
} /* footer fn */
    
// Load data
// reading from a file - change to mysql..
function LoadData($file)
{
    // Read file lines
    $lines = file($file);
    $data = array();
    foreach($lines as $line)
        $data[] = explode(',',trim($line));
    return $data;
} /* end of load data */

// Load data
// reading from a file - change to mysql..
function LoadDBData($table)
{
    // Read file lines
  //  $lines = file($file);
    $data = array();
     

$sqlQuery = "SELECT * FROM $table";
$result = mysql_query($sqlQuery);

//$data = array();
if ($result) {
	
	while ($product = mysql_fetch_assoc($result))
	{
            $data[] = $product;
       //     print_r($product);
        }
}
    
 //   foreach($lines as $line)
   //     $data[] = explode(',',trim($line));
    return $data;
} /* end of load data */

// Simple table
function BasicTable($header, $data)
{
    // Header
    foreach($header as $col)
        $this->Cell(40,7,$col,1);
    $this->Ln();
    // Data
    foreach($data as $row)
    {
        foreach($row as $col)
            $this->Cell(40,6,$col,1);
        $this->Ln();
    }
} /* end of basic table */

// Better table
function ImprovedTable($header, $data)
{
    // Column widths
    $w = array(40, 35, 40, 45);
    // Header
    for($i=0;$i<count($header);$i++){
    $this->Cell($w[$i],7,$header[$i],1,0,'C');}
    $this->Ln();
    $num =0;
    // Data
    foreach($data as $row)
    {   $num++; // since $row[0] is not contigious 
        $this->Cell($w[0],6,$num,'LR', 0,'C');
//        $this->Cell($w[1],6,$row[1],'LR');
        print_r($row);
        print("<br>");
        $this->Cell($w[1],6,(int)$row[1],'LR', 0, 'C');  
        $this->Cell($w[2],6,number_format((double)$row[2], 2,'.',''),'LR',0,'C');
        $this->Cell($w[3],6,number_format((double)$row[3], 3,'.',''),'LR',0,'C');
     //   $this->Cell($w[4],6,$row[4],'LR',0,'C');
      
        $this->Ln();
    }
    // Closing line
    $this->Cell(array_sum($w),0,'','T');
} /* end of improved table */

// Better table
function ImprovedWalkTable($header, $data)
{
    // Column widths
    $w = array(20, 35, 40, 40,40);
    // Header
//    print_r($header);
    for($i=0;$i<count($header);$i++){
    $this->Cell($w[$i],7,$header[$i],1,0,'C');}
    $this->Ln();
    $num =0;
    // Data
    foreach($data as $row)
    {   $num++; // since $row[0] is not contigious 
        $this->Cell($w[0],6,$num,'LR', 0,'C');
//        $this->Cell($w[1],6,$row[1],'LR');
        $this->Cell($w[1],6,(int)$row['minutes'],'LR', 0, 'C');  
        $this->Cell($w[2],6,number_format((double)$row['distance_km'], 2,'.',''),'LR',0,'C');
        $this->Cell($w[3],6,number_format((double)$row['speed'], 3,'.',''),'LR',0,'C');
        $this->Cell($w[4],6,$row['date'],'LR',0,'C');
      
        $this->Ln();
    }
    // Closing line
    $this->Cell(array_sum($w),0,'','T');
} /* end of improved table */

// Better table
function ImprovedWalkReportTable($header, $data)
{
    // Column widths
    $w = array(40, 35, 40,50);
    // Header
//    print_r($header);
    $this->Text(10, 100, "Statistics from the walks database table");
    for($i=0;$i<count($header);$i++){
    $this->Cell($w[$i],7,$header[$i],1,0,'C');}
    $this->Ln();
    $num =0;
    $tot_time =0;
    $tot_distance = 0;
    $tot_speed =0;
    $min_speed    = 10.0;
    $min_distance = 10.0;
    $min_time     = 100.0;
    $max_speed    = 0.0;
    $max_distance = 0.0;
    $max_time     = 0.0;
    
    // Data
    foreach($data as $row)
    {   $num++; // since $row[0] is not contigious 
    
          $tot_time = $tot_time + (double)$row['minutes'];        
          $tot_distance = $tot_distance + (double)$row['distance_km'];
          $tot_speed = $tot_speed + (double)$row['speed'];
          $max_distance = ((float)$row["distance_km"] > $max_distance ? (float)$row["distance_km"] : $max_distance);
          $max_time  = ((float)$row["minutes"] > $max_time ? (float)$row["minutes"] : $max_time);
          $max_speed  = ((float)$row["speed"] > $max_speed ? (float)$row["speed"] : $max_speed);
          $min_distance = ((float)$row["distance_km"] < $min_distance ? (float)$row["distance_km"] : $min_distance);
          $min_time  = ((float)$row["minutes"] < $min_time ? (float)$row["minutes"] : $min_time);
          $min_speed  = ((float)$row["speed"] < $min_speed ? (float)$row["speed"] : $min_speed);
    }
        $avg_time     = $tot_time /$num;
        $avg_distance = $tot_distance /$num;
        $avg_speed    = $tot_speed * 60 / $num;
        
        $this->Cell($w[0],6," ",'LR', 0,'C');
        $this->Cell($w[1],6," ",'LR', 0, 'C');  
        $this->Cell($w[2],6," ",'LR',0,'C');
        $this->Cell($w[3],6," ",'LR',0,'C');
        $this->Ln();
        $this->Cell($w[0],6,"Averages",'LR', 0,'C');
        $this->Cell($w[1],6,number_format($avg_time, 0,'.',''),'LR', 0, 'C');  
        $this->Cell($w[2],6,  number_format($avg_distance, 2,'.',''),'LR',0,'C');
        $this->Cell($w[3],6,number_format($avg_speed, 3,'.',''),'LR',0,'C');
        $this->Ln();
        $this->Cell($w[0],6," ",'LR', 0,'C');
        $this->Cell($w[1],6," ",'LR', 0, 'C');  
        $this->Cell($w[2],6," ",'LR',0,'C');
        $this->Cell($w[3],6," ",'LR',0,'C');
        $this->Ln();
        
        $this->Cell($w[0],6,"Minimum",'LR', 0,'C');
        $this->Cell($w[1],6,number_format($min_time, 0,'.',''),'LR', 0, 'C');  
        $this->Cell($w[2],6,number_format($min_distance, 2,'.',''),'LR',0,'C');
        $this->Cell($w[3],6,number_format($min_speed * 60, 3,'.',''),'LR',0,'C');
        $this->Ln();
        $this->Cell($w[0],6," ",'LR', 0,'C');
        $this->Cell($w[1],6," ",'LR', 0, 'C');  
        $this->Cell($w[2],6," ",'LR',0,'C');
        $this->Cell($w[3],6," ",'LR',0,'C');
        $this->Ln();

        $this->Cell($w[0],6,"Maximum",'LR', 0,'C');
        $this->Cell($w[1],6,number_format($max_time, 0,'.',''),'LR', 0, 'C');  
        $this->Cell($w[2],6,number_format($max_distance, 2,'.',''),'LR',0,'C');
        $this->Cell($w[3],6,number_format($max_speed *60, 3,'.',''),'LR',0,'C');
        $this->Ln();  
        $this->Cell($w[0],6," ",'LR', 0,'C');
        $this->Cell($w[1],6," ",'LR', 0, 'C');  
        $this->Cell($w[2],6," ",'LR',0,'C');
        $this->Cell($w[3],6," ",'LR',0,'C');     
        $this->Ln();

        $this->Cell($w[0],6,"Totals",'LR', 0,'C');
        $this->Cell($w[1],6,number_format($tot_time, 0,'.',''),'LR', 0, 'C');  
        $this->Cell($w[2],6,number_format($tot_distance, 2,'.',''),'LR',0,'C');
        $this->Cell($w[3],6,"N/A",'LR',0,'C');
       
        $this->Ln();
        $this->Cell($w[0],6," ",'LR', 0,'C');
        $this->Cell($w[1],6," ",'LR', 0, 'C');  
        $this->Cell($w[2],6," ",'LR',0,'C');
        $this->Cell($w[3],6," ",'LR',0,'C');
        $this->Ln();    
    
    
    // Closing line
    $this->Cell(array_sum($w),0,'','T');
} /* end of improved table */



// Colored table
function FancyTable($header, $data)
{
    // Colors, line width and bold font
    $this->SetFillColor(255,0,0);
    $this->SetTextColor(255);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
    $this->SetFont('','B');
    // Header
    $w = array(40, 35, 40, 45);
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
    $this->Ln();
    // Color and font restoration
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');
    // Data
    $fill = false;
    $num =0;
    foreach($data as $row)
    {   $num++; // since $row[0] is not contigious 
        $this->Cell($w[0],6,$num,'LR',0,'L',$fill);
        $this->Cell($w[1],6,number_format($row[1]),'LR',0,'R',$fill);   
        $this->Cell($w[2],6,number_format($row[2]),'LR',0,'R',$fill);
        $this->Cell($w[3],6,number_format($row[3]),'LR',0,'R',$fill);
        $this->Ln();
        $fill = !$fill;
    }
    // Closing line
    $this->Cell(array_sum($w),0,'','T');
} /* end of fancy table */
} /* end of class */

/* main stuff calling the fpdf */
$pdf = new PDF('P','mm','A4'); //l forlandscape default is portrait P
// Column headings
//$header = array('Country', 'Capital', 'Area (sq km)', 'Pop. (thousands)');
$header = array('No.','Minutes','Distance(km)','Speed(km/min)','Date');//,'place','desc','date','addedby');
// Data loading
$data = $pdf->LoadDBData('walks');
$pdf->SetFont('Arial','',14);
//$pdf->AddPage();
//$pdf->BasicTable($header,$data);
$pdf->AddPage();
$pdf->ImprovedWalkTable($header,$data);

$headerRep = array('Statistics','Minutes','Distance KM', 'Speed KM/Hour');
$pdf->AddPage();
$pdf->ImprovedWalkReportTable($headerRep,$data);


//$pdf->AddPage();
// Insert a dynamic image from a URL
//$graphtitle =urlencode("Speed km/minutes");

//$graphlink = "http://localhost/walkingstats/basic/graphlinedb.php?title=".$graphtitle."&width=800&height=600";

//$graphlink = "'http://localhost/walkingstats/basic/graphlinedb.php'";
//print_r($dta1);
//$pdf->Image('http://127.0.0.1/walkingstats/basic/graphlinedb.php',60,30,90,0,'PNG');
//$pdf->AddPage();
//$pdf->FancyTable($header,$data);
$pdf->Output();
?>