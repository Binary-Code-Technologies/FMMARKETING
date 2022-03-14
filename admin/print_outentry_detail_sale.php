<?php include("../adminsession.php");

if(isset($_GET['productid']))
$productid =addslashes(trim($_GET['productid']));
else
$productid = 0;
  $prodname = $cmn->getvalfield($connection,"m_product", "prodname","productid = '$productid' ");
  $pcatid = $cmn->getvalfield($connection,"m_product", "pcatid","productid = '$productid' ");
  $catname = $cmn->getvalfield($connection,"m_product_category","catname","pcatid = '$pcatid'");
  $pageheading = ucfirst($prodname)." - ".ucfirst($catname)."  Sale Detail"; 
  
require("../fpdf182/fpdf.php");
$crit = " where 1 = 1 ";
if($_GET['todate']!="" && $_GET['todate']!="")
{
	
	$todate = addslashes(trim($_GET['todate']));
	$fromdate= addslashes(trim($_GET['fromdate']));	
}
else
{
	$todate = date('Y-m-d');
	$fromdate = date('Y-m-d');
}

if($todate !='' && $fromdate !='')
{
	$crit .=" and saledate between '$fromdate' and '$todate' ";		
}
class PDF extends FPDF
{
	// Page header
	function Header()
	{
		global $title1;
		 // courier 25
		$this->SetFont('arial','',12);
		
		$this->Rect(5,5,200,287);
		$this->SetFont('arial','b',12);
		$this->Line(5,20,205,20);
		
		// Move to the right
		$this->SetFont('arial','',12);
		$this->Cell(80);
		// Title
		$this->Cell(30,0,$title1,0,1,'C');
		$this->Ln(15);
		$this->SetFont('arial','',7);
		$this->SetX(120);
		$this->Cell(50,0,"From Date : ".date('d-m-Y'),0,0,'L');
		$this->Cell(50,0,"To Date : ".date('d-m-Y'),0,1,'L');
		
		//$this->Ln(10);	
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

$pdf->Ln(20);

//$y = $pdf->GetY(15);
$x = 5;
//$pdf->setXY($x, $y);
//table header

$pdf->SetFillColor(170, 170, 170); //gray
$pdf->SetFont('arial','b',10);
$pdf->SetTextColor(255,255,255);
$pdf->SetX(5);

	$pdf->Cell(10, 5, "Sno.", 1, 0, "C", 1);
	$pdf->Cell(30, 5, "Branch Name", 1, 0, "C", 1);
	$pdf->Cell(40, 5, "Name", 1, 0, "C", 1);
	$pdf->Cell(40, 5, "Issue Date", 1, 0, "C", 1);
	$pdf->Cell(40, 5,"Issue No.", 1, 0, "C", 1);
	$pdf->Cell(40, 5, "Qty", 1, 0, "C", 1);
	
	
$pdf->Ln(5);
$pdf->SetFont('arial','',7);
$pdf->SetTextColor(0,0,0);
$y = $pdf->GetY();
$x = 5;
$pdf->setXY($x, $y);	
$slno=0;

$total_qty=0;
$subtotal=0;
$sql_list = mysqli_query($connection,"Select * from  saleentry_detail where productid = '$productid' order by saleid  desc");
if($sql_list)
{
   while($row_list = mysqli_fetch_array($sql_list))
   {
	   $qty = $row_list['qty'];
	   $rate = $row_list['rate'];
	   $saleid = $row_list['saleid'];
	   $tax_id = $row_list['tax_id'];
	   $cgst = $row_list['cgst'];
	   $sgst = $row_list['sgst'];
	   $igst = $row_list['igst'];
	  
	  $sql_p = mysqli_query($connection,"Select * from saleentry $crit and saleid = '$saleid'");
	  $row_p = mysqli_fetch_assoc($sql_p);
	  $branch_id = $row_p['branch_id']; 
	  $billno = $row_p['billno'];
	  $billdate = $row_p['saledate'];
	  $receivername = $row_p['receivername'];
	  // echo $tax_id; die; 	
	 $taxname = $cmn->getvalfield($connection,"m_tax","taxname","tax_id='$tax_id'");
	 
	 if($cgst !=0 && $sgst !=0)
	 {
		$gstamount = $cgst+ $sgst;
     }
	 else 
	 $gstamount = $igst;
	
	
	
	   $branch_name = $cmn->getvalfield($connection,"m_branch","branch_name","branch_id = '$branch_id'");
	 
	$pdf->Cell(10, 5, ++$slno, 1, 0, "C", 0);
	$pdf->Cell(30, 5,ucfirst($branch_name), 1, 0, "C", 0);
	$pdf->Cell(40, 5,$receivername, 1, 0, "C", 0);
	$pdf->Cell(40, 5,$cmn->dateformatindia($billdate), 1, 0, "C", 0);
	$pdf->Cell(40, 5,$billno , 1, 0, "R", 0);
	$pdf->Cell(40, 5,$qty, 1, 0, "R", 0);
	
	
	$y += 5;
	
	$total_qty += $qty;

	
	if ($y > 280)
	{
		$pdf->AddPage();
		
		$y = 32;
		$pdf->SetFont('arial','',7);
	}
	
	$pdf->setXY($x, $y);

   }
}


$pdf->Cell(160, 5,"Total", 1, 0, "R", 0);
$pdf->Cell(40, 5,$total_qty, 1, 0, "R", 0);


 $y = $pdf->GetY();
 if ($y > 275)
	{
		$pdf->AddPage();
		
		$y = 32;
		$pdf->SetFont('arial','',7);
	}
	
 
$pdf->Output();


?>