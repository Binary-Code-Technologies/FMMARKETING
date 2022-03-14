<?php
include("../adminsession.php");
//$prefix = $cmn ->getvalfield($connection,"company_details","prefix","1=1");
if(isset($_GET['pcatid']))
$pcatid =addslashes(trim($_GET['pcatid']));
else
$pcatid = 0;

 // $prodname = $cmn->getvalfield($connection,"m_product", "prodname","productid = '$productid' ");
  //$pcatid = $cmn->getvalfield($connection,"m_product", "pcatid","productid = '$productid' ");
 $catname = $cmn->getvalfield($connection,"m_product_category","catname","pcatid = '$pcatid'");
$pageheading = ucfirst($catname)." Opening Stock Detail"; 
require("../fpdf182/fpdf.php");
$crit = " where 1 = 1 ";
if($_GET['todate']!="" && $_GET['todate']!="")
{
	
	$todate = addslashes(trim($_GET['todate']));
	$fromdate= addslashes(trim($_GET['fromdate']));	
}
/*if($todate !='' && $fromdate !='')
{

	$crit .=" and purchasedate between '$fromdate' and '$todate' ";
		
}*/
class PDF extends FPDF
{
	// Page header
	function Header()
	{
		global $title1;
		 // courier 25
		$this->SetFont('arial','',12);
		// Move to the right
		$this->Cell(80);
		// Title
		$this->Cell(30,0,$title1,0,0,'C');
		$this->SetFont('arial','',7);
		$this->Cell(86,0,"Date : ".date('d-m-Y'),0,0,'R');
		$this->Ln(2);	
	}
	// Page footer
	function Footer()
	{
		// Position at 1.5 cm from bottom
		$this->SetY(-15);
		// Arial italic 8
		$this->SetFont('Arial','I',8);
		// Page number
		$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	}
	
}

// Instanciation of inherited class
$pdf = new PDF();
$title1 = $pageheading;
$pdf->SetTitle($title1);

$pdf->SetTitle($pageheading);

$pdf->open();
//$pdf->AddPage();

$pdf->SetAutoPageBreak(true);


$pdf->SetFillColor(0, 0, 0); //black
$pdf->SetDrawColor(0, 0, 0); //black

$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFont('Times','',12);

$y = 7;
$pdf->setXY(10, $y);

$pdf->Ln(6);

$y = $pdf->GetY();
$x = 5;
$pdf->setXY($x, $y);
//table header
$pdf->SetFillColor(170, 170, 170); //gray
$pdf->SetFont('arial','b',10);
$pdf->SetTextColor(255,255,255);

	$pdf->Cell(12, 5, "Sno.", 1, 0, "C", 1);
	$pdf->Cell(60, 5, "Categary", 1, 0, "C", 1);
	$pdf->Cell(45, 5, "Product Name", 1, 0, "C", 1);
	$pdf->Cell(42, 5,"Unit", 1, 0, "C", 1);
	$pdf->Cell(40, 5, "Opening Stock", 1, 0, "C", 1);
	
	
$pdf->Ln(5);
$pdf->SetFont('arial','',7);
$pdf->SetTextColor(0,0,0);
$y = $pdf->GetY();
$x = 5;
$pdf->setXY($x, $y);	
$slno=0;

$total=0;
$sql_list = mysqli_query($connection,"Select * from  m_product where pcatid = '$pcatid' order by prodname");
if($sql_list)
{
   while($row_list = mysqli_fetch_array($sql_list))
   {
	   $pcatid = $row_list['pcatid'];
	   $prodname = $row_list['prodname'];
	   $unitid = $row_list['unitid'];
	   $opening_stock = $row_list['opening_stock'];
	  
	$pdf->setX(5); 
	$pdf->Cell(12, 5, ++$slno, 1, 0, "C", 0);
	$pdf->Cell(60, 5,$cmn->getvalfield($connection,"m_product_category","catname","pcatid='$pcatid'"), 1, 0, "C", 0);
	$pdf->Cell(45, 5,$prodname, 1, 0, "C", 0);
	$pdf->Cell(42, 5,$cmn->getvalfield($connection,"m_unit","unit_name","unitid='$unitid'"), 1, 0, "R", 0);
	$pdf->Cell(40, 5,$opening_stock, 1, 1, "R", 0);
	
	$total +=$opening_stock;
	}
	
	

   
}


	
	$pdf->setX(5); 
	$pdf->Cell(159, 5,"Total", 1, 0, "R", 0);
	$pdf->Cell(40, 5,$total, 1, 1, "R", 0);

								
 $y = $pdf->GetY();
 if ($y > 275)
	{
		$pdf->AddPage();
		
		$y = 32;
		$pdf->SetFont('arial','',7);
	}
	
 
$pdf->Output();


?>