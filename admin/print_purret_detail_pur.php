<?php
include("../adminsession.php");
if(isset($_GET['productid']))
$productid =addslashes(trim($_GET['productid']));
else
$productid = 0;
  $prodname = $cmn->getvalfield($connection,"m_product", "prodname","productid = '$productid' ");
  $pcatid = $cmn->getvalfield($connection,"m_product", "pcatid","productid = '$productid' ");
  $catname = $cmn->getvalfield($connection,"m_product_category","catname","pcatid = '$pcatid'");
  $pageheading = ucfirst($prodname)." - ".ucfirst($catname)." Purchase Return Detail"; 
require("../fpdf182/fpdf.php");
$crit = " and 1 = 1 ";
if($_GET['todate']!="" && $_GET['todate']!="")
{
	
	$todate = addslashes(trim($_GET['todate']));
	$fromdate= addslashes(trim($_GET['fromdate']));	
}
if($todate !='' && $fromdate !='')
{

	$crit .=" and ret_date between '$fromdate' and '$todate' ";
		
}
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

	$pdf->Cell(20, 5, "Sno.", 1, 0, "C", 1);
	$pdf->Cell(60, 5, "Supplier", 1, 0, "C", 1);
	$pdf->Cell(40, 5, "Ret Date", 1, 0, "C", 1);
	$pdf->Cell(40, 5,"Bill No.", 1, 0, "C", 1);
	$pdf->Cell(40, 5, "Qty", 1, 1, "C", 1);
	
	
$pdf->SetFont('arial','',7);
$pdf->SetTextColor(0,0,0);

$sql_list = mysqli_query($connection,"Select * from  pur_return where productid = '$productid' $crit order by ret_date desc");
if($sql_list)
{
   while($row_list = mysqli_fetch_array($sql_list))
   {
	  
	$ret_date  = $row_list['ret_date'];
	$ret_qty  = $row_list['ret_qty'];
	$productid  = $row_list['productid'];
	$purchaseid  = $row_list['purchaseid'];
	$suppartyid= $cmn->getvalfield($connection,"purchaseentry","suppartyid","purchaseid='$purchaseid'");	
	$billno= $cmn->getvalfield($connection,"purchaseentry","billno","purchaseid='$purchaseid'");	
	$supplier_name = $cmn->getvalfield($connection,"m_supplier_party","supparty_name","suppartyid = '$suppartyid'");
	$pdf->setX(5);
	$pdf->Cell(20, 5, ++$slno, 1, 0, "C", 0);
	$pdf->Cell(60, 5,ucfirst($supplier_name), 1, 0, "C", 0);
	$pdf->Cell(40, 5,$cmn->dateformatindia($ret_date), 1, 0, "C", 0);
	$pdf->Cell(40, 5,$billno , 1, 0, "C", 0);
	$pdf->Cell(40, 5,$ret_qty, 1, 1, "C", 0);
	
}

}
 
$pdf->Output();


?>