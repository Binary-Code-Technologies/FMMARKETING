<?php error_reporting(0);                                                                                                   include("../adminsession.php");
include("../fpdf182/fpdf.php");
$tblname="payment";
$tblpkey = "payid";
$module = "Masters";
$keyvalue="";
if(isset($_GET['payid']))
{
	$payid = addslashes(trim($_GET['payid']));
}
if($payid !='')
{
$sqlget=mysqli_query($connection,"select * from payment where payid='$payid'");
$rowget=mysqli_fetch_assoc($sqlget);
$suppartyid=$rowget['suppartyid'];
$supparty_name=$cmn->getvalfield($connection,"m_supplier_party","supparty_name","suppartyid='$suppartyid'");
$payamt=$rowget['payamt'];
$paydate=$cmn->dateformatindia($rowget['paydate']);
$payment_type=$rowget['payment_type'];
$chequeno=$rowget['chequeno'];
$refno=$rowget['refno']; 
//$bank_name = $rowget['bank_name'];

$bankid = $rowget['bankid'];
$bank_name = $cmn->getvalfield($connection,"m_bank","bank_name","bankid='$bankid'");

$receiptno=$rowget['receiptno'];
//$compid=$rowget['compid'];
//$company_name=$cmn->getvalfield($connection,"company_setting","comp_name","compid='$compid'");
$prevbalance = $cmn->getvalfield($connection,"m_supplier_party","prevbalance","suppartyid = '$suppartyid'");
	//get party detail 
//	echo "select * from saleentry where suppartyid = '$suppartyid'";die;
	   $sql_get = "select * from saleentry where suppartyid = '$suppartyid'";
	   $res_get = mysqli_query($connection,$sql_get);
	   $total_bill_amt = 0;
	   while($row_get = mysqli_fetch_array($res_get))
	   {
		   $saleid = $row_get['saleid'];
		 	$discount  = $row_get['discount'];
			$transportation  = $row_get['transportation'];
			$other_charges   = $row_get['other_charges'];
			$discount  = $row_get['discount'];
		   $bill_amt = $cmn->getTotal($saleid,'saled_product',"saleid");
		   
		   $discount_amt = ($bill_amt * $discount) / 100;
		  // $total_bill_amt += $bill_amt - $discount_amt;
		   $total_bill_amt += $bill_amt - $discount_amt + $other_charges  + $transportation;
		    
	   }
	 //echo $total_bill_amt;die;
	   
	 $tot_paid_amt = $cmn->getvalfield($connection,"payment","sum(payamt)","suppartyid='$suppartyid'");
	 
	// echo $tot_paid_amt; die;
	
	 $total_bill_amt = round($total_bill_amt + $prevbalance);
	// echo $total_bill_amt; die;
	  $curr_bal_amt = round($total_bill_amt - $tot_paid_amt) ;
	 $tot_paid_amt = round($cmn->getvalfield($connection,"payment","sum(payamt)","suppartyid='$suppartyid'"));



}

class PDF_MC_Table extends FPDF
{
  var $widths;
  var $aligns;
	function Header()
	{ 
	   //global $title1,$title2;
	
		$this->SetFont('courier','b',15);
		$this->Cell(30);
		$this->Cell(90,0,$title1,0,1,'L');
		$this->Ln(6);
		$this->SetFont('courier','b',15);
		$this->Cell(80);
		$this->Cell(90,0,$title2,0,1,'C');
		$this->Ln(3);
		$this->Cell(-1);
		$this->SetFont('courier','b',11);
		//$this->Cell(95,5,"".$collect_from,0,0,'L');
		//$this->Cell(280,5,"Date : ".date('d-m-Y'),0,1,'R');
		$this->Ln(1);
		//$this->Ln(10);
		
		    $this->SetFont('courier','b',9);
	       // $this->Rect(5, 5, 200, 80, 'D'); //For A4
		
		
	}
	function Footer()
	{ 
	    $this->SetY(-15);
		$this->SetFont('Arial','I',9);
		//$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
     }
function SetWidths($w)
{
    //Set the array of column widths
    $this->widths=$w;
}

function SetAligns($a)
{
    //Set the array of column alignments
    $this->aligns=$a;
}

function Row($data)
{
    //Calculate the height of the row
    $nb=0;
    for($i=0;$i<count($data);$i++)
        $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
    $h=5*$nb;
    //Issue a page break first if needed
    $this->CheckPageBreak($h);
    //Draw the cells of the row
    for($i=0;$i<count($data);$i++)
    {
        $w=$this->widths[$i];
        $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
        //Save the current position
        $x=$this->GetX();
        $y=$this->GetY();
        //Draw the border
        $this->Rect($x,$y,$w,$h);
        //Print the text
        $this->MultiCell($w,5,$data[$i],0,$a);
        //Put the position to the right of the cell
        $this->SetXY($x+$w,$y);
    }
    //Go to the next line
    $this->Ln($h);
}

function CheckPageBreak($h)
{
    //If the height h would cause an overflow, add a new page immediately
    if($this->GetY()+$h>$this->PageBreakTrigger)
        $this->AddPage($this->CurOrientation);
}

function NbLines($w,$txt)
{
    //Computes the number of lines a MultiCell of width w will take
    $cw=&$this->CurrentFont['cw'];
    if($w==0)
        $w=$this->w-$this->rMargin-$this->x;
    $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
    $s=str_replace("\r",'',$txt);
    $nb=strlen($s);
    if($nb>0 and $s[$nb-1]=="\n")
        $nb--;
    $sep=-1;
    $i=0;
    $j=0;
    $l=0;
    $nl=1;
    while($i<$nb)
    {
        $c=$s[$i];
        if($c=="\n")
        {
            $i++;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
            continue;
        }
        if($c==' ')
            $sep=$i;
        $l+=$cw[$c];
        if($l>$wmax)
        {
            if($sep==-1)
            {
                if($i==$j)
                    $i++;
            }
            else
                $i=$sep+1;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
        }
        else
            $i++;
    }
    return $nl;
}
}
?>
<?php


function GenerateWord()
{
    //Get a random word
    $nb=rand(3,10);
    $w='';
    for($i=1;$i<=$nb;$i++)
        $w.=chr(rand(ord('a'),ord('z')));
    return $w;
}

function GenerateSentence()
{
    //Get a random sentence
    $nb=rand(1,10);
    $s='';
    for($i=1;$i<=$nb;$i++)
        $s.=GenerateWord().' ';
    return substr($s,0,-1);
}
$pdf=new PDF_MC_Table();
$pdf->SetTitle("Payment Receipt");
$pdf->AliasNbPages();
$pdf->AddPage('P','A5');
//$pdf->MultiCell(80,5,"Customer Copy",0,'L');

$pdf->SetY(10);
 $pdf->SetX(20);
//Image(string file [, float x [, float y [, float w [, float h [, string type [, mixed link]]]]]])

//Line(float x1, float y1, float x2, float y2)

// $pdf->SetFont('courier','b',9);
 //$pdf->Line(30,52, 130, 52 ); //For A4
 
 // $pdf->SetFont('courier','b',9);
  //$pdf->Line(20,61, 185, 61 ); //For A4
 


 $pdf->SetFont('courier','b',9);
 $pdf->Rect(4,10, 140, 80, 'D'); //For A4
 
$pdf->SetFont('courier','b',9);
$pdf->Rect(4,10, 140, 15, 'D'); //For A4
 
  //$pdf->SetFont('courier','b',9);
  //$pdf->Rect(10,71, 95, 25, 'D'); //For A4
 
 //$pdf->SetFont('courier','b',9);
 //$pdf->Rect(105,71, 95, 25, 'D'); //For A4
 
  //$pdf->SetY(25);
//$pdf->SetX(8);
//$pdf->Image('Chrysanthemum.jpg',10,10,20,15);//Image(string file [, float x [, float y [, float w [, float h [, string type [, mixed link]]]]]])
 //$pdf->SetFont('courier','b',9);
// $pdf->Rect(10,10, 20, 15, 'D'); //For A4
 
$pdf->SetY(13);
//$pdf->SetX(13);
 $comp_name = $cmn->getvalfield($connection,"company_setting","comp_name","1 = 1");
   $address = $cmn->getvalfield($connection,"company_setting","address","1 = 1");
    $address2 = $cmn->getvalfield($connection,"company_setting","address2","1 = 1");
$pdf->SetFont('Arial','b',12);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(120,4,$comp_name,'0',1,'C',0);
$pdf->Ln(2);
$pdf->SetFont('Arial','b',8);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(120,4,ucwords($address." , ".$address2),'0',1,'C',0);
$pdf->Ln(3);

$pdf->SetFont('Arial','b',13);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(130,4,'Cash Receipt','0',1,'C',0);
$pdf->Ln(3);
$pdf->SetFont('Arial','b',9);
$pdf->SetTextColor(0,0,0);
//$pdf->SetX(150);
$pdf->Cell(30,4,'Receipt No : '.$receiptno,'0',0,'L',0);
//$pdf->Ln(2);
$pdf->SetX(90);
$pdf->SetFont('Arial','b',9);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(30,4,'Payment Date : '.$paydate,'0',1,'L',0);

$pdf->Ln(3);
$pdf->SetX(10);
$pdf->SetFont('Arial','b',8);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(40,5,'Receipt from : '.$supparty_name,0,0,'L',0);

$pdf->SetX(90);
$pdf->Cell(45,5,'The Amount : '.number_format($payamt,2),0,0,'L',0);



//$pdf->Line(20,65,100,65);
//$pdf->Cell(18,5,"in words ".strtoupper($cmn->numtowords($payamt)),0,1,'C',0);

$pdf->Ln(9);



$pdf->SetX(10);
//$pdf->Cell(50,5,'Current Paid Amount :',1,0,'L',0);
//$pdf->Cell(45,5,$payamt,1,0,'L',0);

$pdf->Cell(128,5,'Payment Mode' ,1,1,'C',0);
//$pdf->Cell(30,5,$payment_type,0,1,'L',0);
$pdf->SetX(10);
//$pdf->Cell(50,5,'Current Balance :',1,0,'L',0);
//$pdf->Cell(45,5,$total_bill_amt,1,0,'L',0);
$pdf->Cell(50,5,'Payment Type',1,0,'L',0);
$pdf->Cell(78,5,$payment_type,1,1,'L',0);

$pdf->SetX(10);
//$pdf->Cell(50,5,'Total Amount :',1,0,'L',0);
//$pdf->Cell(45,5,$tot_paid_amt,1,0,'L',0);
$pdf->Cell(50,5,'Cheque No' ,1,0,'L',0);
$pdf->Cell(78,5,$chequeno,1,1,'L',0);

$pdf->SetX(10);
//$pdf->Cell(50,5,'Balance Amount :',1,0,'L',0);
//$pdf->Cell(45,5,$curr_bal_amt,1,0,'L',0);
$pdf->Cell(50,5,'Bank Name ',1,0,'L',0);
$pdf->Cell(78,5,$bank_name,1,1,'L',0);
$pdf->Ln(2);

$pdf->SetX(40);
$pdf->SetFont('Arial','b',8);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(90,5,'For :-'.$comp_name,0,0,'R',0);
$pdf->Ln(7);
$pdf->SetX(80);
$pdf->Cell(50,5,'Signatory',0,0,'R',0);
$pdf->Cell(100,5,'',0,1,'L',0);

$pdf->ln(10);



//$pdf->SetY(200);

$pdf->SetY(300);
 $pdf->SetX(300);
//Image(string file [, float x [, float y [, float w [, float h [, string type [, mixed link]]]]]])

//Line(float x1, float y1, float x2, float y2)

// $pdf->SetFont('courier','b',9);
 //$pdf->Line(30,52, 130, 52 ); //For A4
 
 // $pdf->SetFont('courier','b',9);
  //$pdf->Line(20,61, 185, 61 ); //For A4
 


 $pdf->SetFont('courier','b',9);
 $pdf->Rect(4,110, 140, 80, 'D'); //For A4
 
$pdf->SetFont('courier','b',9);
$pdf->Rect(4,110, 140, 15, 'D'); //For A4
 
  //$pdf->SetFont('courier','b',9);
  //$pdf->Rect(10,71, 95, 25, 'D'); //For A4
 
 //$pdf->SetFont('courier','b',9);
 //$pdf->Rect(105,71, 95, 25, 'D'); //For A4
 
  //$pdf->SetY(25);
//$pdf->SetX(8);
//$pdf->Image('Chrysanthemum.jpg',10,10,20,15);//Image(string file [, float x [, float y [, float w [, float h [, string type [, mixed link]]]]]])
 //$pdf->SetFont('courier','b',9);
// $pdf->Rect(10,10, 20, 15, 'D'); //For A4
 
$pdf->SetY(115);
//$pdf->SetX(13);
 $comp_name = $cmn->getvalfield($connection,"company_setting","comp_name","1 = 1");
   $address = $cmn->getvalfield($connection,"company_setting","address","1 = 1");
    $address2 = $cmn->getvalfield($connection,"company_setting","address2","1 = 1");
$pdf->SetFont('Arial','b',12);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(120,4,$comp_name,'0',1,'C',0);
$pdf->Ln(2);
$pdf->SetFont('Arial','b',8);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(120,4,ucwords($address." , ".$address2),'0',1,'C',0);
$pdf->Ln(3);

$pdf->SetFont('Arial','b',13);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(130,4,'Cash Receipt','0',1,'C',0);
$pdf->Ln(3);
$pdf->SetFont('Arial','b',9);
$pdf->SetTextColor(0,0,0);
//$pdf->SetX(150);
$pdf->Cell(30,4,'Receipt No : '.$receiptno,'0',0,'L',0);
//$pdf->Ln(2);
$pdf->SetX(90);
$pdf->SetFont('Arial','b',9);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(30,4,'Payment Date : '.$paydate,'0',1,'L',0);

$pdf->Ln(3);
$pdf->SetX(10);
$pdf->SetFont('Arial','b',8);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(40,5,'Receipt from : '.$supparty_name,0,0,'L',0);

$pdf->SetX(90);
$pdf->Cell(45,5,'The Amount : '.number_format($payamt,2),0,0,'L',0);

$pdf->Ln(9);



$pdf->SetX(10);
//$pdf->Cell(50,5,'Current Paid Amount :',1,0,'L',0);
//$pdf->Cell(45,5,$payamt,1,0,'L',0);

$pdf->Cell(128,5,'Payment Mode' ,1,1,'C',0);
//$pdf->Cell(30,5,$payment_type,0,1,'L',0);
$pdf->SetX(10);
//$pdf->Cell(50,5,'Current Balance :',1,0,'L',0);
//$pdf->Cell(45,5,$total_bill_amt,1,0,'L',0);
$pdf->Cell(50,5,'Payment Type',1,0,'L',0);
$pdf->Cell(78,5,$payment_type,1,1,'L',0);

$pdf->SetX(10);
//$pdf->Cell(50,5,'Total Amount :',1,0,'L',0);
//$pdf->Cell(45,5,$tot_paid_amt,1,0,'L',0);
$pdf->Cell(50,5,'Cheque No' ,1,0,'L',0);
$pdf->Cell(78,5,$chequeno,1,1,'L',0);

$pdf->SetX(10);
//$pdf->Cell(50,5,'Balance Amount :',1,0,'L',0);
//$pdf->Cell(45,5,$curr_bal_amt,1,0,'L',0);
$pdf->Cell(50,5,'Bank Name',1,0,'L',0);
$pdf->Cell(78,5,$bank_name,1,1,'L',0);
$pdf->Ln(2);

$pdf->SetX(40);
$pdf->SetFont('Arial','b',8);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(90,5,'For :-'.$comp_name,0,0,'R',0);
$pdf->Ln(7);
$pdf->SetX(80);
$pdf->Cell(50,5,'Signatory',0,0,'R',0);
$pdf->Cell(100,5,'',0,1,'L',0);

$pdf->SetY(5);
$pdf->SetX(114);
$pdf->SetFont('Arial','b',8);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(30,5,'For Company',0,0,'R',0);

$pdf->SetY(105);
$pdf->SetX(114);
$pdf->SetFont('Arial','b',8);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(30,5,'For Customer',0,0,'R',0);



  $pdf->Output();	
?>
