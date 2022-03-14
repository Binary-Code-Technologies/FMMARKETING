<?php
include("../adminsession.php");
$tblname = "m_product";
$tblpkey = "productid";
if(isset($_GET['barcode']))
$barcode = $_REQUEST['barcode'];
if(isset($_GET['productid']))

 $productid = $_REQUEST['productid']; 

if($productid != "")
{
 // $barcode = $cmn->getvalfield($connection,"m_product","barcode","productid='$productid'");
	if($barcode=="")
	{
	  $barcode= "BCODEPROD00".$productid;
	  //echo $barcode; die;
	  //echo "Update $tblname set barcode ='$barcode' where productid='$productid'"; die;
	  $sql = mysqli_query($connection,"Update $tblname set barcode ='$barcode' where productid='$productid'");
	}
 $rate = $cmn->getvalfield($connection,"m_product","rate","productid='$productid'");
}
	
	$height = 15;//(2.8 * $numofbarchode / 2);

require("../fpdf17/code128.php");
$pdf=new PDF_Code128('L', 'in', array(4.5,1.05 ));
$pdf->AddPage();

$pdf->SetAutoPageBreak(true, 0);

$y = 0.05;
$x =0.28;
$ln =0.2;

$c = 1;
$cntx = 1;
/*for($i = 1; $i <= $numofbarchode; $i++)
{
	$code=$product_code;
	//$pdf->SetXY($x+40,$y);
	*/
	//$pdf->SetXY($x,$y);
	//$x=4;
$pdf->Code128($x,$y,$barcode,1.6,0.5);//Code128($x, $y, $code, $w, $h)//12
	$x += 2.0;
	$pdf->Code128($x,$y,$barcode,1.6,0.5);//Code128($x, $y, $code, $w, $h)//12
	//$pdf->Cell($x,0.75,'Account Name',1,1,'L',0);
	$pdf->SetXY(0.25,0.54);
	$pdf->SetFont('Arial','b',8);
	$pdf->Write($ln,"".$barcode." (MRP:Rs.".$rate.")");
	
	$pdf->SetXY(2.23,0.54);
	$pdf->SetFont('Arial','b',8);
	$pdf->Write($ln,"".$barcode." (MRP:Rs.".$rate.")");
	
	//$pdf->SetXY(2.23,0.54);
	//$pdf->SetFont('Arial','b',8);
	//$pdf->Write($ln,"".$product_code." (MRP:Rs.".$mrp.")");
	
	/*//$pdf->Cell(80);
	//$pdf->SetXY($x+40,$y);
	$ln =17.9;
	
	
	$pdf->SetXY($x,$y);
	$pdf->SetFont('courier','b',7);
	//$pdf->Write($ln,$product_code);
	
	//$pdf->Ln(6);
	//$y += 10;
	
	if($c%4 == 0)
	{
		$x += 44;
	}
	else if($c%3 == 0 )
	$x += 42;
	else
	$x += 40;
	
	if($cntx > 35 && $i%2 == 0)
	{
		$y += 21.9;
	}
	else if($i%2 == 0)
	{
		$y += 22.8;
	}
	if($i%2== 0)
	{
		$c = 1;
		
		$x =11;
		//$pdf->SetXY($x,$y);		
	}
	
	++$c;
	++$cntx;
	if($i%15 == 0 && $i != $numofbarchode)
	{
		$pdf->AddPage();
		$y = 10;
		$x =11;
		$cntx = 1;
	}
	
	
	
	*/
	
//}
$pdf->Output();
?>