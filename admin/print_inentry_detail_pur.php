<?php
include("../adminsession.php");
$crit = " where 1 = 1 ";
if(isset($_GET['productid']))
{
$productid =addslashes(trim($_GET['productid']));


$prodname = $cmn->getvalfield($connection,"m_product", "prodname","productid = '$productid' ");
$pcatid = $cmn->getvalfield($connection,"m_product", "pcatid","productid = '$productid' ");
$catname = $cmn->getvalfield($connection,"m_product_category","catname","pcatid = '$pcatid'");
$pageheading = ucfirst($prodname)." - ".ucfirst($catname)." Purchase Detail"; 
$crit .=" and B.productid='$productid' ";
}
else
{
$productid = 0;
}

require("../fpdf182/fpdf.php");

if($_GET['todate']!="" && $_GET['todate']!="")
{
	
	$todate = addslashes(trim($_GET['todate']));
	$fromdate= addslashes(trim($_GET['fromdate']));	
}
if($todate !='' && $fromdate !='')
{

	$crit .=" and A.purchasedate between '$fromdate' and '$todate' ";
		
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
	$pdf->Cell(40, 5, "Supplier", 1, 0, "C", 1);
	$pdf->Cell(20, 5, "Bill Date", 1, 0, "C", 1);
	$pdf->Cell(22, 5,"Bill No.", 1, 0, "C", 1);
	$pdf->Cell(18, 5, "Bill Type", 1, 0, "C", 1);
	$pdf->Cell(18, 5, "Pur. Type", 1, 0, "C", 1);
	$pdf->Cell(15, 5, "Qty", 1, 0, "C", 1);
	$pdf->Cell(15, 5, "Rate", 1, 0, "C", 1);
	$pdf->Cell(25, 5, "Tax", 1, 0, "C", 1);
	$pdf->Cell(18, 5, "Total", 1, 0, "C", 1);	
	
$pdf->Ln(5);
$pdf->SetFont('arial','',7);
$pdf->SetTextColor(0,0,0);
$y = $pdf->GetY();
$x = 5;
$pdf->setXY($x, $y);	
$slno=0;

//echo "Select A.*,B.qty,B.rate,B.tax_id from  purchaseentry as A left join purchasentry_detail as B on A.purchaseid=B.purchaseid $crit";
$sql_list = mysqli_query($connection,"Select A.*,B.qty,B.rate,B.tax_id from  purchaseentry as A left join purchasentry_detail as B on A.purchaseid=B.purchaseid $crit");
if($sql_list)
{
	$total_qty=0;
	$subtotal=0;
   while($row_list = mysqli_fetch_array($sql_list))
   {
	   $total=0;
	   $suppartyid=$row_list['suppartyid'];
	   $purchasedate=$row_list['purchasedate'];
	   $supplier_name= $cmn->getvalfield($connection,"m_supplier_party","supparty_name","suppartyid='$suppartyid'");
	   $billno=$row_list['billno'];
	   $billtype=$row_list['billtype'];
	   $purchase_type=$row_list['purchase_type'];
	   $qty=$row_list['qty'];
	   
	   $rate=$row_list['rate'];
	   $tax_id =$row_list['tax_id'];
	   $taxname=$cmn->getvalfield($connection,"m_tax","taxname","tax_id='$tax_id'");
	   $tax=$cmn->getvalfield($connection,"m_tax","tax","tax_id='$tax_id'");
	   
	   $total= $qty * $rate;
	   
	   $total= $total + ($total * $tax)/100;
	
	 
	$pdf->Cell(9, 5, ++$slno, 1, 0, "C", 0);
	$pdf->Cell(40, 5,ucfirst($supplier_name), 1, 0, "C", 0);
	$pdf->Cell(20, 5,$cmn->dateformatindia($purchasedate), 1, 0, "C", 0);
	$pdf->Cell(22, 5,$billno , 1, 0, "R", 0);
	$pdf->Cell(18, 5,$billtype, 1, 0, "R", 0);
	$pdf->Cell(18, 5,$purchase_type, 1, 0, "R", 0);
	$pdf->Cell(15, 5,$qty, 1, 0, "R", 0);
	$pdf->Cell(15, 5,$rate, 1, 0, "R", 0);
	$pdf->Cell(25, 5,$taxname, 1, 0, "R", 0);
	$pdf->Cell(18, 5,$total, 1, 0, "R", 0);
	
	$y += 5;
	
	$total_qty += $qty;	
	$subtotal += $total;
	
	if ($y > 280)
	{
		$pdf->AddPage();
		
		$y = 32;
		$pdf->SetFont('arial','',7);
	}
	
	$pdf->setXY($x, $y);

   }
}

$pdf->Cell(127, 5,"Total", 1, 0, "R", 0);
$pdf->Cell(15, 5,$total_qty, 1, 0, "R", 0);
$pdf->Cell(15, 5,"", 1, 0, "R", 0);
$pdf->Cell(25, 5,"", 1, 0, "R", 0);
$pdf->Cell(18, 5,$subtotal, 1, 0, "R", 0);
								
 $y = $pdf->GetY();
 if ($y > 275)
	{
		$pdf->AddPage();
		
		$y = 32;
		$pdf->SetFont('arial','',7);
	}
	
 
$pdf->Output();


?>