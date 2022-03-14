<?php error_reporting(0);                                                                                                   include("../adminsession.php");
require("../fpdf182/fpdf.php");
if($_GET['fromdate']!="" && $_GET['todate']!="")
{
	$fromdate = addslashes(trim($_GET['fromdate']));
	$todate = addslashes(trim($_GET['todate']));
}
else
{
	$fromdate = date('d-m-Y');
	$todate = date('d-m-Y');
}
$crit = " where 1 = 1 ";
if($fromdate!="" && $todate!="")
{
	
	$crit .= " and  saleentry.saledate between '$fromdate' and '$todate'";
}	
$comp_name =  $cmn->getvalfield($connection,"company_setting","comp_name","1 = 1");
function convert_number($number) 
{ 
     $no = round($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'One', '2' => 'Two',
    '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
    '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
    '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
    '13' => 'Thirteen', '14' => 'Fourteen',
    '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
    '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
    '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
    '60' => 'Sixty', '70' => 'Seventy',
    '80' => 'Eighty', '90' => 'Ninety');
   $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' And ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';
		  
  return $result; //. "and  " . $points . " Paise";
} 

class PDF_MC_Table extends FPDF
{
  var $widths;
  var $aligns;

	function Header()
	{
		global $title1,$title2;
		 // courier 25
		$this->Rect(5, 5,200,287, 'D');
		$this->SetFont('courier','b',20);
		// Move to the right
		$this->Cell(90);
		// Title
		$this->Cell(10,0,$title1,0,0,'C');
		// Line break
		$this->Ln(6);
		// Move to the right
		$this->Cell(90);
		 // courier bold 15
		$this->SetFont('courier','b',11);
		$this->Cell(10,0,$title2,0,0,'C');
		  // Move to the right
	    $this->Ln(15);
		$this->Cell(82);
		 // courier bold 15
		 
		$this->SetY(20);
		$this->SetX(5);
		$this->SetFont('courier','b',10);
		$this->Cell(200,0,'',T,0,0,'C');
	    $this->Ln(5);	
	   	
		$this->SetX(5);
		$this->SetFont('courier','b',10);
	    $this->Cell(20,0,"To :",0,0,'C');
		$this->SetFont('courier','',10);
	    $this->Cell(55,0,"Soniya",0,0,'L');
		
		$this->SetFont('courier','b',10);
	    $this->Cell(20,0,"BILL NO :",0,0,'C');
		$this->SetFont('courier','',10);
	    $this->Cell(38,0,"12345",0,0,'L');
		
		
		$this->SetFont('courier','b',10);
	    $this->Cell(30,0,"BILL DATE :",0,0,'C');
		$this->SetFont('courier','',10);
	    $this->Cell(20,0,"07-07-2017",0,0,'R');
	    $this->Ln(10);	 
	}
	  // Page footer
	function Footer()
	{
		global $comp_name;
	// Position at 1.5 cm from bottom
		$this->SetY(-11);
		// Arial italic 8
		$this->SetFont('Arial','I',8); 
		// Page number
		$this->SetX(5);
		$this->MultiCell(200,5,'|| Developed By Trinity Solutions Raipur, Contact us- +91-9770131555,+91-8871181890,Visit us- www.trinitysolutions.in ||',0,'C');
		
		  $this->SetY(-22);
		  $this->SetX(5);
          $this->SetFont('Arial','b',8);
          $this->SetTextColor(0,0,0);
          $this->Cell(195,5, "For "." ".$comp_name,0,'1','R',0);
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
$title1 =" SALE CHALLAN"; 
$pdf->SetTitle($title1);
$title2 = $cmn->getvalfield($connection,"company_setting","comp_name","1 = 1");
$pdf->SetTitle($title2);

$pdf->AliasNbPages();
$pdf->AddPage('P','A4');
$pdf->SetX(5);
$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(170, 170, 170); //gray
$pdf->SetTextColor(255,255,255);
$pdf->Cell(20,6,' Sno','1',0,'L',1);  
$pdf->Cell(45,6,'Product Name',1,0,'L',1);
$pdf->Cell(25,6,'UNIT',1,0,'L',1);
$pdf->Cell(25,6,'QTY',1,0,'L',1);
$pdf->Cell(35,6,'TAX',1,0,'L',1);
$pdf->Cell(25,6,'RATE',1,0,'L',1);
$pdf->Cell(25,6,'AMOUNT',1,1,'L',1);

$pdf->SetX(5);
$pdf->SetWidths(array(20,45,25,25,35,25,25));
$pdf->SetAligns(array("C","L","C","C","L","R","R"));

$pdf->SetFont('Arial','',6);
$slno = 1;
$sql_get = mysqli_query($connection,"Select * from saleentry $crit  order by saleid desc");
			while($row_get = mysqli_fetch_assoc($sql_get))
			//{
				$total=0;
				$suppartyid =$row_get['suppartyid'];
				$disc =$row_get['disc'];
				$supparty_name = $cmn->getvalfield($connection,"m_supplier_party","supparty_name","suppartyid='$suppartyid'");
				 $total = $cmn->getTotalBillAmt($row_get['saleid']);										 
				 $disc_amt= ($total * $disc)/100;
				 $total = $total - $disc_amt;
				
									  											
	$pdf->SetX(5);	
	$pdf->SetFont('Arial','',8);
	$pdf->SetTextColor(0,0,0);
	$pdf->Row(array(1,"abc","kg","1","GST 18 %","200","200"));
	
	       // }
$pdf->SetX(5);
$pdf->SetFont('arial','b',10);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(175,5,'SUBTOTAL :',0,0,'R',0);
$pdf->Cell(25,5,"200",'0',1,'R',0);

$pdf->SetX(5);
$pdf->SetFont('arial','b',10);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(175,5,'TAX :',0,0,'R',0);
$pdf->Cell(25,5,"200",'0',1,'R',0);

$pdf->SetX(5);
$pdf->SetFont('arial','b',10);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(175,5,'NET TOTAL :',0,0,'R',0);
$pdf->Cell(25,5,"200",'0',1,'R',0);
$pdf->SetX(5);

$pdf->Ln(7);	
$pdf->SetX(5);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(200,5,'RUPEES '.strtoupper(convert_number(round($net_total)))." ONLY",0,1,'L',0);
$pdf->Ln(5);

$pdf->Output();

?> 
                          	
<?php
mysql_close($db_link);

?>
