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
$barcode = $cmn->getvalfield($connection,"m_product","barcode","productid='$productid'");
$pcatid  = $cmn->getvalfield($connection,"m_product","pcatid","productid='$productid'");
$catname = $cmn->getvalfield($connection,"m_product_category","catname","pcatid='$pcatid'");
$comp_name  = $cmn->getvalfield($connection,"company_setting","comp_name","compid ='1'");
//echo $comp_name; die;
if($barcode=="")
	{
	  $barcode= "BCODEPROD00".$productid;
	  //echo $barcode; die;
	  //echo "Update $tblname set barcode ='$barcode' where productid='$productid'"; die;
	  $sql = mysqli_query($connection,"Update $tblname set barcode ='$barcode' where productid='$productid'");
	}
$pdf=new PDF_Code128('P', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 0);
$pdf->SetFont('Arial','',10);
$y = 16;
$x =15;
$ln =20;
$w = 27;
$h = 12;
$c = 1;
$cntx = 1;
for($i =1; $i <= $numofbarchode; $i++)
{
	$code=$barcode;
	//$pdf->SetXY($x+40,$y);
	$pdf->Code128($x,$y,$barcode,80,18);//Code128($x, $y, $code, $w, $h)//12
	//$pdf->Cell(80);
	//$pdf->SetXY($x+40,$y);
	$ln =40;
	$pdf->SetXY($x,$y);
	$pdf->SetFont('courier','b',9);
	$pdf->Write($ln,$barcode);
	$ln =40;
	$pdf->SetXY($x,$y+3);
	$pdf->SetFont('courier','b',9);
	$pdf->Write($ln,$catname);
	
	$pdf->SetXY($x+30,$y);
	$pdf->SetFont('courier','b',9);
	$pdf->Write($ln,$comp_name);
	
	//$pdf->Ln(10);
	//$y += 1;
	if($c%2 == 0)
	{
		$x += 102;
	}
	else if($c%2 == 0 )
	$x += 102;
	else
	$x += 102;
	if($cntx > 12 && $i%2 == 0)
	{
		$y += 47;
	}
	else if($i%2 == 0)
	{
		$y += 47.6;
	}
	if($i%2 == 0)
	{
		$c = 1;
		$x =16;
	}
	++$c;
	++$cntx;
	if($i%12 == 0 && $i != $numofbarchode)
	{
		$pdf->AddPage();
		$y = 15;
		$x = 16;
		$cntx = 1;
	}
}
$pdf->Output();

?>