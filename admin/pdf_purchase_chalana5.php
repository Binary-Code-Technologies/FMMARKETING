<?php error_reporting(0);                                                                                                   include("../adminsession.php");
require("../fpdf182/fpdf.php");
	
$comp_name =  $cmn->getvalfield($connection,"company_setting","comp_name","1 = 1");

if(isset($_GET['purchaseid']))
{
	$purchaseid = $_GET['purchaseid'];
	$sql = "select * from purchaseentry where purchaseid = '$purchaseid'";
	$res = mysqli_query($connection,$sql);
	$row = mysqli_fetch_array($res);
	$suppartyid = $row['suppartyid'];
	$billno = $row['billno'];
	$purchasedate = $cmn->dateformatindia($row['purchasedate']);
	$purchase_type = $row['purchase_type'];
	$billtype = $row['billtype'];
	$discr = $row['disc'];
	
	 $supparty_name=$cmn->getvalfield($connection,"m_supplier_party","supparty_name","suppartyid='$suppartyid'");
	  $mobile =$cmn->getvalfield($connection,"m_supplier_party","mobile","suppartyid='$suppartyid'");
	$address=$cmn->getvalfield($connection,"m_supplier_party","address","suppartyid='$suppartyid'");
}
else
$purchaseid = 0;


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
		global $title1,$title2,$supparty_name,$mobile,$billno,$purchasedate,$gsttinno;
		 // courier 25
		 
		 $this->Rect(2, 2, 144, 205, 'D');
		$this->SetFont('courier','b',15);
		// Move to the right
		 $this->SetY(6);
		 $this->Cell(55);
		// Title
		$this->Cell(10,0,$title1,0,0,'C');
		// Line break
		$this->Ln(6);
		// Move to the right
		$this->Cell(50);
		 // courier bold 15
		$this->SetFont('courier','b',12);
		$this->Cell(20,0,$title2,0,0,'C');
		  // Move to the right
		$this->Ln(15);
		$this->SetY(20);
		$this->SetX(2);
		$this->SetFont('courier','b',9);
		$this->Cell(144,0,'',T,0,0,'C');
	    $this->Ln(2);	
	   	
		$this->SetX(2);
		$this->SetFont('courier','b',9);
	    $this->Cell(10,5," To :",0,0,'C');
		$this->SetFont('courier','',9);
	    $this->Cell(40,5,$supparty_name,0,0,'L');
		
		//echo $mobile;die;
		
		$this->SetFont('courier','b',9);
	    $this->Cell(74,5,"BILL NO :",0,0,'R');
		$this->SetFont('courier','',9);
	    $this->Cell(8,5,$billno,0,1,'R');
		
		$this->SetX(10);
		$this->SetFont('courier','b',9);
	    $this->Cell(10,5,"Contact No.:",0,0,'C');
		$this->SetFont('courier','',9);
	    $this->Cell(33,5,$mobile,0,0,'C');
		
		$this->SetFont('courier','b',9);
	    $this->Cell(73,5,"BILL DATE :",0,0,'R');
		$this->SetFont('courier','',9);
	   $this->Cell(20,5,$purchasedate,0,0,'R');
	    $this->Ln(10);	 
	}
	  // Page footer
	function Footer()
	{
		global $comp_name;
	// Position at 1.5 cm from bottom
		$this->SetY(-13);
		// Arial italic 8
		$this->SetFont('Arial','I',8); 
		// Page number
		$this->SetX(2);
		$this->MultiCell(140,5,'|| Developed By Trinity Solutions Raipur, Contact us- +91-9770131555,+91-8871181890,Visit us- www.trinitysolutions.in ||',0,'L');
		
		  $this->SetY(-22);
		  $this->SetX(2);
          $this->SetFont('Arial','b',8);
          $this->SetTextColor(0,0,0);
          $this->Cell(138,5, "For "." ".$comp_name,0,'1','R',0);
		
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
$title1 =$cmn->getvalfield($connection,"company_setting","comp_name","1 = 1");
$pdf->SetTitle($title1);
$title2 = "PURCHASE CHALLAN";
$pdf->SetTitle($title2);

$pdf->AliasNbPages();
$pdf->AddPage('P','A5');
$pdf->SetX(2);
$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(170, 170, 170); //gray
$pdf->SetTextColor(255,255,255);
$pdf->Cell(8,6,' Sno','1',0,'L',1);  
$pdf->Cell(31,6,'Product Name',1,0,'L',1);
$pdf->Cell(20,6,'UNIT',1,0,'L',1);
$pdf->Cell(20,6,'QTY',1,0,'L',1);
$pdf->Cell(20,6,'RATE',1,0,'L',1);
$pdf->Cell(25,6,'Disc(Rs)',1,0,'L',1);
$pdf->Cell(20,6,'AMOUNT',1,1,'L',1);

$pdf->SetX(2);
$pdf->SetWidths(array(8,31,20,20,20,25,20));
$pdf->SetAligns(array("C","L","C","C","R","R","R"));


$pdf->SetFont('Arial','',6);
$slno = 1;
$sql_get = mysqli_query($connection,"Select * from purchasentry_detail where purchaseid='$purchaseid'");
			while($row_get = mysqli_fetch_assoc($sql_get))
{
		$amount=0;
		$productid=$row_get['productid'];
		$unitid=$row_get['unitid'];
		$prodname=$cmn->getvalfield($connection,"m_product","prodname","productid='$productid'");
		$unit_name = $cmn->getvalfield($connection,"m_unit","unit_name","unitid ='$unitid'");
		$rate =$row_get['rate'];
		$qty =$row_get['qty'];
		
		$vat =$row_get['vat'];
		$igst =$row_get['igst'];
		$sgst =$row_get['sgst'];
		$cgst =$row_get['cgst'];
		$disc =$row_get['disc'];
		$amount= $rate * $qty;
		$amount=$amount-$disc;
		if($cgst !='0' && $sgst !='0')
		{
			$gstt=$cgst+$sgst;
			$gst="GST $gstt %";
		}
		
		if($igst !='0')
		{
			$gst="IGST $igst %";	
		}
		
		if($vat !='0')
		{
			$gst="Vat $vat %";
		}
									  											
	$pdf->SetX(2);	
	$pdf->SetFont('Arial','',8);
	$pdf->SetTextColor(0,0,0);
	$pdf->Row(array($slno,$prodname,$unit_name,$row_get['qty'],number_format($rate,2),number_format($disc,2),number_format($amount,2)));
	
	$total +=$amount;
	$slno++;
}

$pdf->SetX(2);
$pdf->SetFont('arial','b',10);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(124,5,'SUBTOTAL :',0,0,'R',0);
$pdf->Cell(20,5,number_format($total,2),'0',1,'R',0);

if($discr !='0')
{
$pdf->SetX(2);
$pdf->SetFont('arial','b',10);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(124,5,'Discount(Rs) :',0,0,'R',0);
$pdf->Cell(20,5,number_format($discr,2),'0',1,'R',0);
}
$netamt= $total - $discr;



$pdf->SetX(2);
$pdf->SetFont('arial','b',10);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(124,5,'NET TOTAL :',0,0,'R',0);
$pdf->Cell(20,5,number_format(round($netamt),2),'0',1,'R',0);
$pdf->SetX(2);

$pdf->Ln(7);	
$pdf->SetX(2);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(140,5,'RUPEES '.strtoupper(convert_number(round($netamt)))."ONLY",0,1,'L',0);
$pdf->Ln(5);
$pdf->Output();
?> 
                          	
<?php
mysql_close($db_link);

?>
