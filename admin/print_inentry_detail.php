<?php
include("../adminsession.php");
//$prefix = $cmn ->getvalfield($connection,"company_details","prefix","1=1");
if(isset($_GET['pcatid']))
$pcatid =addslashes(trim($_GET['pcatid']));
else
$pcatid = 0;
  
$catname = $cmn->getvalfield($connection,"m_product_category","catname","pcatid = '$pcatid'");
$pageheading = ucfirst($catname)." Purchase Detail"; 
require("../fpdf182/fpdf.php");
$crit = " and 1 = 1 ";
if($_GET['todate']!="" && $_GET['todate']!="")
{
	
	$todate = addslashes(trim($_GET['todate']));
	$fromdate= addslashes(trim($_GET['fromdate']));	
}
if($todate !='' && $fromdate !='')
{

	$crit .=" and purchasedate between '$fromdate' and '$todate' ";
		
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

	$pdf->Cell(9, 5, "Sno.", 1, 0, "C", 1);
	$pdf->Cell(25, 5, "Product", 1, 0, "C", 1);
	$pdf->Cell(40, 5, "Supplier", 1, 0, "C", 1);
	$pdf->Cell(20, 5, "Bill Date", 1, 0, "C", 1);
	$pdf->Cell(22, 5,"Bill No.", 1, 0, "C", 1);
	$pdf->Cell(18, 5, "Bill Type", 1, 0, "C", 1);
	$pdf->Cell(18, 5, "Pur. Type", 1, 0, "C", 1);
	$pdf->Cell(12, 5, "Qty", 1, 0, "C", 1);
	$pdf->Cell(12, 5, "Rate", 1, 0, "C", 1);
	$pdf->Cell(24, 5, "Tax", 1, 0, "C", 1);	
	
$pdf->Ln(5);
$pdf->SetFont('arial','',7);
$pdf->SetTextColor(0,0,0);
$y = $pdf->GetY();
$x = 5;
$pdf->setXY($x, $y);	
$slno=0;

$sql_list = mysqli_query($connection,"SELECT A.*, purchasedate,branch_id,billno, purchase_type, billtype, pcatid FROM purchasentry_detail as A left join purchaseentry as B on A.purchaseid=B.purchaseid left join m_product as C on A.productid = C.productid where pcatid = '$pcatid' $crit order by purchaseid");
$total=0;
if($sql_list)
{
   while($row_list = mysqli_fetch_array($sql_list))
   {
		$productid= $row_list['productid'];
		$prodname=$cmn->getvalfield($connection,"m_product","prodname","productid='$productid'");
		$branch_id = $row_list['branch_id']; 
		$supparty_name=$cmn->getvalfield($connection,"m_supplier_party","supparty_name","branch_id='$branch_id'");
		$purchasedate=$row_list['purchasedate']; 
		$billno=$row_list['billno']; 
		$purchase_type=$row_list['purchase_type']; 
		$qty=$row_list['qty']; 
		$rate=$row_list['rate']; 
		$tax_id=$row_list['tax_id']; 
		$billtype=$row_list['billtype']; 
		if($billtype="withouttax")
		{
			$billtypename="Invoice";
		}
		else
		{
			$billtypename="Challan";
		}
		
		$taxname=$cmn->getvalfield($connection,"m_tax","taxname","tax_id='$tax_id'");
	$pdf->setX(5);
	$pdf->Cell(9, 5, ++$slno, 1, 0, "C", 0);
	$pdf->Cell(25, 5,$prodname, 1, 0, "R", 0);
	$pdf->Cell(40, 5,$supparty_name, 1, 0, "C", 0);
	$pdf->Cell(20, 5,$cmn->dateformatindia($purchasedate), 1, 0, "C", 0);
	$pdf->Cell(22, 5,$billno , 1, 0, "R", 0);
	$pdf->Cell(18, 5,$billtypename, 1, 0, "R", 0);
	$pdf->Cell(18, 5,$purchase_type, 1, 0, "R", 0);
	$pdf->Cell(12, 5,$qty, 1, 0, "R", 0);
	$pdf->Cell(12, 5,$rate, 1, 0, "R", 0);	
	$pdf->Cell(24, 5,$taxname, 1, 1, "R", 0);
	
	$total+=$qty;

   }
}

	$pdf->setX(5);	
	$pdf->Cell(152, 5,"Total", 1, 0, "R", 0);	
	$pdf->Cell(48, 5,$total, 1, 0, "L", 0);
	
	

 
$pdf->Output();


?>