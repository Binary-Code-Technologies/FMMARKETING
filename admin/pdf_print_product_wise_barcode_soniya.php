<?php
include("../adminsession.php");
include("../fpdf17/code128.php");

  if(isset($_REQUEST['submit']))
{
	 $hiddenid = $_REQUEST['hiddenid'];
	 $pageid = $_REQUEST['pageid'];
      $productid = $_REQUEST['productid']; 
	$numofbarchode = split(",",$hiddenid);
	//$numofbarchode = array_combine(range( 1, count($numofbarchode)),array_values($numofbarchode));	
	
}
$pdf=new PDF_Code128('P', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 5);
$pdf->SetFont('Arial','',10);
$y = 16;
$x =15;
$ln =20;
$w = 27;
$h = 12;
$c = 1;
$cntx = 1;
$n=1;
$pdf->SetFont('courier','b',9);
for($j = 0; $j < count($numofbarchode); $j++)
 {
	 $barcode = $numofbarchode[$j];
	 $code=$barcode;
	//echo $barcode;
   $pcatid = $cmn->getvalfield($connection,"m_product","pcatid","barcode='$numofbarchode[$j]'");
   // echo $pcatid;
	$catname = $cmn->getvalfield($connection," m_product_category","catname","pcatid='$pcatid'");
	$barcode = $cmn->getvalfield($connection,"m_product","barcode","barcode='$numofbarchode[$j]'");
    $comp_name = $cmn->getvalfield($connection,"company_setting","comp_name","compid ='1'");
	$pdf->Code128($x,$y,$barcode,80,18);//Code128($x, $y, $code, $w, $h)//12
	
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
	
	if($c%2 == 0)
	{
		$x = 15;
		$y += 46.5;
	}
	else
	$x += 102;
	
	if($cntx > 12 && $n%2 == 0)
	{
		$y += 47;
	}
	else if($n%2 == 0)
	{
		$y += 47.6;
	}
	
	if($n%2 == 0)
	{
		$c = 1;
		$x =15;
	}
	
	if($j%11==0)
	{
		
		$y=16;
		$cntx=0;
	}
	
	++$c;
	++$cntx;
	
}
$pdf->Output();
?>