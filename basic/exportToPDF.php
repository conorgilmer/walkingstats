<?php
session_start();

require("fpdf.php");

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
    $this->Cell(30,10,'Walk tracker',0,0,'C');
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
       // print_r($row);
       // print("<br>");
        $this->Cell($w[1],6,(int)$row[1],'LR', 0, 'C');  
        $this->Cell($w[2],6,number_format((double)$row[2], 2,'.',''),'LR',0,'C');
        $this->Cell($w[3],6,number_format((double)$row[3], 3,'.',''),'LR',0,'C');
     //   $this->Cell($w[4],6,$row[4],'LR',0,'C');
      
        $this->Ln();
    }
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
$header = array('No.','Minutes','Distance(km)','Speed(km/min)');//,'place','desc','date','addedby');
// Data loading
$data = $pdf->LoadData('export.csv');
$pdf->SetFont('Arial','',14);
//$pdf->AddPage();
//$pdf->BasicTable($header,$data);
$pdf->AddPage();
$pdf->ImprovedTable($header,$data);
//$pdf->AddPage();
//$pdf->FancyTable($header,$data);
$pdf->Output();
?>