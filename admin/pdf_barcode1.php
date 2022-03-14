<?php
include("../adminsession.php");

	$hiddenid = $_REQUEST['hiddenid'];
	$pageid = $_REQUEST['pageid'];
	print_r($hiddenid);die;;
	$numofbarchode = split(",",$hiddenid);
	$numofbarchode = array_combine(range(1, count($numofbarchode)), array_values($numofbarchode));//change array index to 1
	//if(isset($_REQUEST['hiddenid']))
    // $numofbarchode_arr = $_REQUEST['hiddenid'];

   // if(isset($_REQUEST['pageid']))
   // $productid_arr = $_REQUEST['pageid'];
   // if($numofbarchode != "");
 
require("../fpdf17/code128.php");
$pdf=new PDF_Code128('P', 'mm', 'A4');
$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 5);
$pdf->SetFont('Arial','',10);
$y =11;
$x =8;
$ln =20;
//$w = 27;
//$h = 12;
$c = 1;
$cntx = 1;
$n=1;

$pdf->SetFont('courier','b',9);
//$pdf->Image('../strik.jpg',0,0,211.9,299.93);//Image(string file [, float x [, float y [, float w [, float h [, string type [, mixed 
$arr_size = sizeof($pageid);
	if($arr_size > 0)
	{
		for($i=0; $i < $arr_size; $i++)
		{
			$numofbarchode=0;
			$productid = $pageid[$i];
		 echo   $numofbarchode = $numofbarchode[$i];
		//  print_r($numofbarchode);die;
		  $product_code = $cmn->getvalfield($connection,"m_product","prod_code","productid='$productid'"); 
         $rate = $cmn->getvalfield($connection,"m_product","rate","productid='$productid'");
         $batch_no = $cmn->getvalfield($connection,"m_product","batch_no","productid='$productid'");
	 
	
//for($j = 1; $j <= $numofbarchode; $j++)
for($j = 1; $j <=$numofbarchode; $j++)
 {
	$code=$product_code;
	//$pdf->SetXY($x+40,$y);
	
	
	$pdf->Code128($x,$y,$code,27,7.8);//Code128($x, $y, $code, $w, $h)//12
	//$pdf->Code128(10,15,$size,27,7.8);//Code128($x, $y, $code, $w, $h)//12
	
	//$pdf->Code128(10,$y,$color_code,27,7.8);//Code128($x, $y, $code, $w, $h)//12
	
	//$pdf->Cell(80);
	//$pdf->SetXY($x+40,$y);
	$ln =19.9;
	
	$pdf->SetXY($x,$y);
	//$pdf->setCellMargin(10);
	$pdf->SetFont('courier','b',7);
	$pdf->Write($ln,$product_code);
	
	$ln =25.9;
	
	$pdf->SetXY($x,$y);
	$pdf->SetFont('courier','b',7);
	$pdf->Write($ln,$rate."/".$size); 
	
	
	//$ln =30.9;
	//$pdf->SetXY($x,$y);
	//$pdf->SetFont('courier','b',7);
	//$pdf->Write($ln,$batch_no);
	
	
	//$pdf->Ln(6);
	//$y += 10;
	
	if($c%5 == 0)
	{
		$x += 40;
	}	
	
	else
	$x += 41.5;
	
	 if($n%5 == 0)
	{
		$y += 21.7;
	}
	if($n%5== 0)
	{
		$c = 1;
		
		$x =8;
		//$pdf->SetXY($x,$y);	
	}
	else 
	{
		$c = 1;
		
	}
	++$n;
	++$c;
	++$cntx;
	//if($i%25 != $numofbarchode)
	if($j%65== 0 && $j != $numofbarchode)
	{
		$pdf->AddPage();
		$y = 11;
		$x =8;
		$cntx = 1;
		
	}
	
}
		}
	}
	

$pdf->Output();

?>