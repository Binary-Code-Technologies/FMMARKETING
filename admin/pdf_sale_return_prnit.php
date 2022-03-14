<?php 
error_reporting(0);    
include("../adminsession.php");
require("../fpdf182/fpdf.php");

$comp_name =  $cmn->getvalfield($connection,"company_setting","comp_name","1 = 1");
$stateid =  $cmn->getvalfield($connection,"company_setting","stateid","1 = 1");
$company_code=$cmn->getvalfield($connection,"m_state","state_code","stateid = '$stateid'");
$company_state=$cmn->getvalfield($connection,"m_state","state_name","stateid = '$stateid'");
$gsttinno=$cmn->getvalfield($connection,'company_setting','gsttinno','1=1');
$comp_name =  $cmn->getvalfield($connection,"company_setting","comp_name","1 = 1");
$comp_mobile =  $cmn->getvalfield($connection,"company_setting","mobile","1 = 1");
$gsttinno=$cmn->getvalfield($connection,'company_setting','gsttinno','1=1');
$address=$cmn->getvalfield($connection,'company_setting','address','1=1');
$address2=$cmn->getvalfield($connection,'company_setting','address2','1=1');
$term_cond=$cmn->getvalfield($connection,'company_setting','term_cond','1=1');
if(isset($_GET['sale_returnid']))
{
	$sale_returnid = $_GET['sale_returnid'];
	$sql = "select * from salereturn where sale_returnid = '$sale_returnid'";
	$res = mysqli_query($connection,$sql);
	$row = mysqli_fetch_array($res);
	$saleid = $row['saleid'];
	$saledate = $cmn->dateformatindia($row['sale_retdate']);
	

    $billno=$cmn->getvalfield($connection,"saleentry","billno","saleid='$saleid'");
    $suppartyid=$cmn->getvalfield($connection,"saleentry","suppartyid","saleid='$saleid'");
     $supparty_name=$cmn->getvalfield($connection,"m_supplier_party","supparty_name","suppartyid='$suppartyid'");
     $cust_address=$cmn->getvalfield($connection,"m_supplier_party","address","suppartyid='$suppartyid'");
     
}
else
$sale_returnid = 0;
function convert_number_to_words($number) {

    $hyphen      = '-';
    $conjunction = ' and ';
    $separator   = ', ';
    $negative    = 'negative ';
    $decimal     = ' point ';
    $dictionary  = array(
        0                   => 'zero',
        1                   => 'one',
        2                   => 'two',
        3                   => 'three',
        4                   => 'four',
        5                   => 'five',
        6                   => 'six',
        7                   => 'seven',
        8                   => 'eight',
        9                   => 'nine',
        10                  => 'ten',
        11                  => 'eleven',
        12                  => 'twelve',
        13                  => 'thirteen',
        14                  => 'fourteen',
        15                  => 'fifteen',
        16                  => 'sixteen',
        17                  => 'seventeen',
        18                  => 'eighteen',
        19                  => 'nineteen',
        20                  => 'twenty',
        30                  => 'thirty',
        40                  => 'fourty',
        50                  => 'fifty',
        60                  => 'sixty',
        70                  => 'seventy',
        80                  => 'eighty',
        90                  => 'ninety',
        100                 => 'hundred',
        1000                => 'thousand',
        1000000             => 'million',
        1000000000          => 'billion',
        1000000000000       => 'trillion',
        1000000000000000    => 'quadrillion',
        1000000000000000000 => 'quintillion'
    );
   if (!is_numeric($number)) {
        return false;
    }
   if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        // overflow
        trigger_error(
            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
            E_USER_WARNING
        );
        return false;
    }

    if ($number < 0) {
        return $negative . convert_number_to_words(abs($number));
    }

    $string = $fraction = null;

    if (strpos($number, '.') !== false) {
        list($number, $fraction) = explode('.', $number);
    }

    switch (true) {
        case $number < 21:
            $string = $dictionary[$number];
            break;
        case $number < 100:
            $tens   = ((int) ($number / 10)) * 10;
            $units  = $number % 10;
            $string = $dictionary[$tens];
            if ($units) {
                $string .= $hyphen . $dictionary[$units];
            }
            break;
        case $number < 1000:
            $hundreds  = $number / 100;
            $remainder = $number % 100;
            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $string .= $conjunction . convert_number_to_words($remainder);
            }
            break;
        default:
            $baseUnit = pow(1000, floor(log($number, 1000)));
            $numBaseUnits = (int) ($number / $baseUnit);
            $remainder = $number % $baseUnit;
            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
            if ($remainder) {
                $string .= $remainder < 100 ? $conjunction : $separator;
                $string .= convert_number_to_words($remainder);
            }
            break;
    }
    if (null !== $fraction && is_numeric($fraction)) {
        $string .= $decimal;
        $words = array();
        foreach (str_split((string) $fraction) as $number) {
            $words[] = $dictionary[$number];
        }
        $string .= implode(' ', $words);
    }
  return $string;
}
class PDF_MC_Table extends FPDF
{
  var $widths;
  var $aligns;

	function Header()
	{
		global $title1,$title2,$supparty_name,$address,$address2,$cust_address,$comp_mobile,$billno,$saledate,$gsttinno,$comp_name,$remark;
		 // courier 25
		 
		 $this->Rect(2, 2, 206, 293, 'D');
		 $this->SetFont('courier','b',14);
		//Move to the right
		 $this->SetY(6);
		 $this->Cell(60);
		 $this->Cell(70,0,"SALE INVOICE",0,0,'C');
		 $this->Ln(4);
		 $this->Cell(60);
		 $this->SetFont('courier','b',9);
		 $this->Cell(70,0,$title1,0,1,'C');

		
		$this->Ln(4);
		$this->Cell(60);
		$this->SetFont('courier','b',9);
		$this->Cell(65,0,$address2,0,1,'C');
		
		$this->Ln(6);
		$this->SetY(6);
		$this->SetX(2);
		$this->SetFont('courier','b',8);
		$this->Cell(205,0,'Mobile No.: '.$comp_mobile,0,0,'R');
	    $this->Ln(3);
	    $this->Cell(82);
		 // courier bold 15
		$this->SetY(20);
		$this->SetX(2);
		$this->SetFont('courier','b',9);
	//	$this->Cell(144,0,'',T,0,0,'C');
	    $this->Ln(2);	
	   	
		$this->SetX(7);
		$this->SetFont('courier','b',9);
	    $this->Cell(20,5,"Customer :",0,0,'L');
		$this->SetFont('courier','b',9);
		 $this->Cell(15,5,$supparty_name,0,0,'L');
		//echo $mobile;die;
		$this->SetFont('courier','b',9);
	    $this->Cell(144,5,"Bill No  :",0,0,'R');
		$this->SetFont('courier','b',9);
	    $this->Cell(25,5,$billno,0,1,'L');

	   $this->SetX(6);
		$this->SetFont('courier','b',9);
	    $this->Cell(24,5,"Address :",0,0,'C');
		$this->SetFont('courier','b',9);
	   // $this->Cell(33,5,$mobile,0,0,'C');
		$this->Cell(19,5,$cust_address,0,0,'C');
		
		$this->SetFont('courier','b',9);
	    $this->Cell(137,5,"Bill Date :",0,0,'R');
		$this->SetFont('courier','b',9);
	   $this->Cell(22,5,$saledate,0,1,'L');
	   

	  
	    $this->Ln(5);	 
	}
	  // Page footer
	function Footer()
	{
		global $comp_name,$term_cond;
	// Position at 1.5 cm from bottom
	
		$this->SetY(-22);
		$this->SetFont('Arial','b',10); 
		$this->SetTextColor(0,0,0);
		$this->SetX(4);
		 $this->Cell(60,4, "Term and Conditions ",0,'1','L',0);
		 $this->SetX(4);
		 $this->SetFont('Arial','',8); 
		$this->SetTextColor(0,0,0);
		$this->MultiCell(85,3,$term_cond,0,'L');
		
		$this->SetY(-13);
		// Arial italic 8
		$this->SetFont('Arial','I',8); 
		$this->SetTextColor(0,0,0);
		
		// Page number
		$this->SetX(2);
		//$this->MultiCell(144,5,'|| Developed By Chaaruvi Infotech Raipur, Contact us- +91-8871181890 ||',0,'C');
		
		  $this->SetY(-20);
		  $this->SetX(2);
          $this->SetFont('Arial','b',8);
          $this->SetTextColor(0,0,0);
          $this->Cell(180,5, "For "." ".$comp_name,0,'1','R',0);
		
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
$title1 = $cmn->getvalfield($connection,"company_setting","comp_name","1 = 1");
$pdf->SetTitle($title1);
$title2 = "SALE RETURN INVOICE";
$pdf->SetTitle($title2);
$pdf->AliasNbPages();
$pdf->AddPage('P','A4');
$pdf->SetX(2);
$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(170,170,170); //gray
$pdf->SetTextColor(0,0,0);

$pdf->Cell(14,6,' S.No.','1',0,'C',1);  
$pdf->Cell(50,6,'Product Name',1,0,'L',1);
$pdf->Cell(20,6,'Bill No',1,0,'R',1);
$pdf->Cell(30,6,'Total Amount',1,0,'R',1);
$pdf->Cell(25,6,'Return Qty',1,0,'R',1);
$pdf->Cell(32,6,'Return Amount',1,0,'R',1);
$pdf->Cell(35,6,'Balance Amount',1,1,'R',1);
$pdf->SetX(2);
$pdf->SetWidths(array(14,50,20,30,25,32,35));
$pdf->SetAligns(array("C","L","R","R","R","R","R","R"));

$pdf->SetFont('Arial','',6);
$slno = 1;
$sql_get = mysqli_query($connection,"SELECT * from salereturn where sale_returnid='$sale_returnid'");
        while($row_get = mysqli_fetch_assoc($sql_get))
        {
            $productid = $row_get['productid'];
            $ret_qty = $row_get['ret_qty'];
            $saleidl = $row_get['saleid'];

            $billno = $cmn->getvalfield($connection,"saleentry","billno","saleid='$saleidl'");
            
            $totamt = $cmn->getvalfield($connection,"saleentry","totalsale","saleid='$saleidl'");

            $rateamt = $cmn->getvalfield($connection,"saleentry_detail","rate","saleid='$saleidl' and productid='$productid' order by productid desc");
                $newamt =   $rateamt * $ret_qty;
            
                $balamt = $totamt - $newamt;


            
            $prodname = $cmn->getvalfield($connection,"m_product","prodname","productid='$productid'");
	
									  											
	$pdf->SetX(2);	
	$pdf->SetFont('Arial','',8);
	$pdf->SetTextColor(0,0,0);
	
	$pdf->Row(array($slno,$prodname,$billno,$totamt,$row_get['ret_qty'],$newamt,number_format($balamt,2)));
	
	
	$total +=$balamt;
	$slno++;
	
	       }
$pdf->SetX(2);
$pdf->SetFont('arial','b',9);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(184,5,'TOTAL :',0,0,'R',0);
$pdf->Cell(22,5,number_format($total,2),'0',1,'R',0);


 $pdf->Ln(2);
 $pdf->SetX(5);
 $pdf->SetFont('Arial','b',8);
 $pdf->SetTextColor(0,0,0);
 $pdf->Cell(31,5,'AMOUNT IN RUPEES :',0,'0','L',0);
 
   $pdf->SetFont('Arial','b',8);
  $pdf->SetTextColor(0,0,0);
 $pdf->Cell(101,5,ucfirst(convert_number_to_words(round($total)))." Only. ",0,1,'L',0); 
 
$pdf->Ln(2);	

$pdf->Output();

?> 
                          	
<?php
mysql_close($db_link);

?>
