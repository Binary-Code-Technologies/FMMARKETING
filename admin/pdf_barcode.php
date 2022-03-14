<?php
include("../adminsession.php");
include("../fpdf17/code128.php");
$tblname = "m_product";
$tblpkey = "productid";
if(isset($_GET['numofbarchode']))
$numofbarchode = $_REQUEST['numofbarchode']; 

if(isset($_GET['productid']))
$productid = $_REQUEST['productid'];

if($productid != "")
$barcode = $cmn->getvalfield($connection,"m_product","barcode","productid='$productid'");

if($barcode=="")
		{
		  $barcode= "BCODEPROD00".$productid;
		  $sql = mysqli_query($connection,"Update $tblname set barcode ='$barcode' where productid='$productid'");
		}
$pdf=new PDF_Code128('P', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 0);
$pdf->SetFont('Arial','',10);
$y = 9;
$x =11;
$ln =20;
$w = 27;
$h = 12;
$c = 1;
$cntx = 1;
for($i = 1; $i <= $numofbarchode; $i++)
{
	$code=$barcode;
	//$pdf->SetXY($x+40,$y);
	
	
	$pdf->Code128($x,$y,$barcode,27,7.8);//Code128($x, $y, $code, $w, $h)//12
	//$pdf->Cell(80);
	//$pdf->SetXY($x+40,$y);
	$ln =17.9;
	
	
	$pdf->SetXY($x,$y);
	$pdf->SetFont('courier','b',7);
	$pdf->Write($ln,$barcode);
	
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
	
	if($cntx > 35 && $i%5 == 0)
	{
		$y += 21.9;
	}
	else if($i%5 == 0)
	{
		$y += 22.8;
	}
	if($i%5 == 0)
	{
		$c = 1;
		
		$x =11;
		//$pdf->SetXY($x,$y);		
	}
	
	++$c;
	++$cntx;
	if($i%65 == 0 && $i != $numofbarchode)
	{
		$pdf->AddPage();
		$y = 9;
		$x =11;
		$cntx = 1;
	}
	
}
$pdf->Output();

?>