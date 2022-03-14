<?php error_reporting(0);    
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
if(isset($_GET['saleid']))
{
	$saleid = $_GET['saleid'];
	$sql = "select * from saleentry where saleid = '$saleid'";
	$res = mysqli_query($connection,$sql);
	$row = mysqli_fetch_array($res);
	$suppartyid = $row['suppartyid'];
	$billno = $row['billno'];
	$saledate = $cmn->dateformatindia($row['saledate']);
	$saletype = $row['saletype'];
	$billtype = $row['billtype'];
	$discr = $row['disc'];
	$remark = $row['remark'];

    
   

    $supparty_name=$cmn->getvalfield($connection,"m_supplier_party","supparty_name","suppartyid='$suppartyid'");
     $mobile=$cmn->getvalfield($connection,"m_supplier_party","mobile","suppartyid='$suppartyid'");
	 $age=$cmn->getvalfield($connection,"m_supplier_party","age","suppartyid='$suppartyid'");
	 $gender=$cmn->getvalfield($connection,"m_supplier_party","gender","suppartyid='$suppartyid'");
	$cust_address=$cmn->getvalfield($connection,"m_supplier_party","address","suppartyid='$suppartyid'");
    $tinno = $cmn->getvalfield($connection,"m_supplier_party","tinno","suppartyid='$suppartyid'");
	$disid=$cmn->getvalfield($connection,"m_supplier_party","disid","suppartyid='$suppartyid'");
	$cus_code=$cmn->getvalfield($connection,"m_state","state_code","stateid = '$stateid'");
	$diseasename=$cmn->getvalfield($connection,"m_disease","diseasename","disid = '$disid'");
    if($supparty_name=="cash"){
        $supparty_name = $supparty_name.'('.$remark.')';
    }else{
        $supparty_name = $supparty_name;
    }
}
else
$saleid = 0;
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
		global $title1,$title2,$supparty_name,$address,$address2,$cust_address,$mobile,$comp_mobile,$diseasename,$billno,$saledate,$gsttinno,$comp_name,$remark,$age,$gender,$cash_name,$remark;
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
		
	/*	$this->Ln(4);
		$this->Cell(55);
		$this->SetFont('courier','b',9);
		$this->Cell(10,0,$address,0,1,'C');*/
		
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
	    $this->Cell(25,5,"Contact  :",0,0,'C');
		$this->SetFont('courier','b',9);
	   // $this->Cell(33,5,$mobile,0,0,'C');
		$this->Cell(15,5,$mobile,0,0,'C');
		
		$this->SetFont('courier','b',9);
	    $this->Cell(140,5,"Bill Date :",0,0,'R');
		$this->SetFont('courier','b',9);
	   $this->Cell(25,5,$saledate,0,1,'L');
	   
	   $this->SetX(6);
		$this->SetFont('courier','b',9);
	    $this->Cell(25,5,"Address  :",0,0,'C');
		$this->SetFont('courier','b',9);
	   // $this->Cell(33,5,$mobile,0,0,'C');
		$this->Cell(20,5,$cust_address,0,0,'C');
		
	// 	$this->SetFont('courier','b',9);
	//     $this->Cell(69,5,"Disease Type :",0,0,'R');
	// 	$this->SetFont('courier','b',9);
	//    $this->Cell(25,5,$diseasename,0,1,'L');
	  
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
$title2 = "SALE INVOICE";
$pdf->SetTitle($title2);
$pdf->AliasNbPages();
$pdf->AddPage('P','A4');
$pdf->SetX(2);
$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(170,170,170); //gray
$pdf->SetTextColor(0,0,0);
if($saletype=='Challan'){
$pdf->Cell(14,6,' S.No.','1',0,'C',1);  
$pdf->Cell(60,6,'Product Name',1,0,'L',1);
$pdf->Cell(30,6,'UNIT',1,0,'L',1);
$pdf->Cell(20,6,'Qty',1,0,'R',1);
$pdf->Cell(20,6,'Rate',1,0,'R',1);
$pdf->Cell(20,6,'Disc(%)',1,0,'R',1);
$pdf->Cell(42,6,'AMOUNT',1,1,'R',1);
$pdf->SetX(2);
$pdf->SetWidths(array(14,60,30,20,20,20,42));
$pdf->SetAligns(array("C","L","L","R","R","R","R","R"));
}else{
	$pdf->Cell(14,6,' S.No.','1',0,'C',1);  
$pdf->Cell(40,6,'Product Name',1,0,'L',1);
$pdf->Cell(30,6,'UNIT',1,0,'L',1);
$pdf->Cell(20,6,'Qty',1,0,'R',1);
$pdf->Cell(20,6,'Rate',1,0,'R',1);
$pdf->Cell(20,6,'Disc(%)',1,0,'R',1);
$pdf->Cell(20,6,'GST %',1,0,'R',1);
$pdf->Cell(42,6,'AMOUNT',1,1,'R',1);
$pdf->SetX(2);
$pdf->SetWidths(array(14,40,30,20,20,20,20,42));
$pdf->SetAligns(array("C","L","L","R","R","R","R","R","R"));
}
$pdf->SetFont('Arial','',6);
$slno = 1;
$sql_get = mysqli_query($connection,"Select * from saleentry_detail where saleid='$saleid'");
			while($row_get = mysqli_fetch_assoc($sql_get))
{
		$amount=0;
		$gsttax=0;
		$productid=$row_get['productid'];
		$unitid=$row_get['unitid'];
		
		$prodname=$cmn->getvalfield($connection,"m_product","prodname","productid='$productid'");
		$unit_name = $cmn->getvalfield($connection,"m_unit","unit_name","unitid ='$unitid'");
		$rate =$row_get['rate'];
		$qty =$row_get['qty'];
		$disc_per =$row_get['disc_per'];
		$tax =$row_get['tax'];

	
		
	    $amount= $rate * $qty;	
		
	   if($disc_per!=0){
			$discamt=	$amount * $disc_per/100;
			$amount=	$amount - $discamt;
		}
        if($tax!=0){
			$taxamt=	$amount * $tax/100;
			$amount=	$amount + $taxamt;
		}
	 	
	
	
									  											
	$pdf->SetX(2);	
	$pdf->SetFont('Arial','',8);
	$pdf->SetTextColor(0,0,0);
	if($saletype=='Challan'){
	$pdf->Row(array($slno,$prodname,$unit_name,$row_get['qty'],number_format($rate,2),$row_get['disc_per'],number_format($amount,2)));
	}else{
		$pdf->Row(array($slno,$prodname,$unit_name,$row_get['qty'],number_format($rate,2),$row_get['disc_per'],$row_get['tax'],number_format($amount,2)));
	}
	
	$total +=$amount;
	$slno++;
	
	       }
$pdf->SetX(2);
$pdf->SetFont('arial','b',9);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(184,5,'SUBTOTAL :',0,0,'R',0);
$pdf->Cell(22,5,number_format($total,2),'0',1,'R',0);

$total+=$discr;
if($discr!=0){
$pdf->SetX(2);
$pdf->SetFont('arial','b',10);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(184,5,'Freight Charge(Rs) :',0,0,'R',0);
$pdf->Cell(22,5,number_format($discr,2),'0',1,'R',0);

}
$return_amt = $cmn->getvalfield($connection,"salereturn","sum(return_amt)","saleid='$saleid'");
if($return_amt!=0){
$pdf->SetX(2);
$pdf->SetFont('arial','b',10);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(184,5,'Return Amount(Rs) :',0,0,'R',0);
$pdf->Cell(22,5,number_format($return_amt,2),'0',1,'R',0);
}
if($discr!=0 || $return_amt!=0){
$pdf->SetX(2);
$pdf->SetFont('arial','b',9);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(184,5,'NET TOTAL :',0,0,'R',0);
$pdf->Cell(22,5,number_format(round($total-$return_amt),2),'0',1,'R',0);
}
 $pdf->Ln(2);
 $pdf->SetX(5);
 $pdf->SetFont('Arial','b',8);
 $pdf->SetTextColor(0,0,0);
 $pdf->Cell(31,5,'AMOUNT IN RUPEES :',0,'0','L',0);
 
   $pdf->SetFont('Arial','b',8);
  $pdf->SetTextColor(0,0,0);
 $pdf->Cell(101,5,ucfirst(convert_number_to_words(round($total-$return_amt)))." Only. ",0,1,'L',0); 
 
$pdf->Ln(2);	


if($taxamt !=0)
{
// $pdf->SetX(5);
// $pdf->SetFont('arial','b',9);
// $pdf->SetTextColor(0,0,0);
// $pdf->Cell(140,5,'TAX SUMMARY',0,1,'L',0);
// $pdf->Ln(3);	
 

// $pdf->SetX(2);
// $pdf->SetFont('Arial','B',9);
// $pdf->SetFillColor(170, 170, 170); //gray
// $pdf->SetTextColor(0,0,0);
// $pdf->Cell(37,6,' RATE','1',0,'C',1);  
// $pdf->Cell(70,6,'TAX',1,0,'C',1);
// $pdf->Cell(37,6,'Total Tax ',1,1,'C',1);

// $pdf->SetWidths(array(37,70,37));
// $pdf->SetAligns(array("C","C","R"));


$mysql_tax=mysqli_query($connection,"select distinct tax_id from saleentry_detail where saleid='$saleid' && tax_id !='0'");
while($row_tax=mysqli_fetch_assoc($mysql_tax)) 
{ 
	$tax_id=$row_tax['tax_id'];
	$cgst=$row_tax['cgst'];
	$sgst=$row_tax['sgst'];
	$igst=$row_tax['igst'];
	$netgst=0;
	
	$tax_cat_id=$cmn->getvalfield($connection,"m_tax","tax_cat_id","tax_id='$tax_id'"); 
	$taxname=$cmn->getvalfield($connection,"m_tax","taxname","tax_id='$tax_id'");
	$tax=$cmn->getvalfield($connection,"m_tax","tax","tax_id='$tax_id'");
	
	if($tax_cat_id=='4')
	{
	
	  $netgst=$cmn->getgsttaxes($saleid,$tax_id);	
	  
	  $c_gst=$netgst/2;
		
    $pdf->SetX(2);	
	$pdf->SetFont('Arial','',7);
	$pdf->SetTextColor(0,0,0);
	$pdf->Row(array('CGST @'.$tax/2,number_format($tax,2).'%',number_format($c_gst,2)));
	
	 $pdf->SetX(2);	
	$pdf->SetFont('Arial','',7);
	$pdf->SetTextColor(0,0,0);
	$pdf->Row(array('SGST @'.$tax/2,number_format($tax,2).'%',number_format($c_gst,2)));
		
	}
	else if($tax_cat_id =='3')
	{
	$netgst=$cmn->getgsttaxes($saleid,$tax_id);	
	 $pdf->SetX(2);	
	$pdf->SetFont('Arial','',8);
	$pdf->SetTextColor(0,0,0);
	$pdf->Row(array('IGST @',number_format($tax,2).'%',number_format($netgst,2)));
		
	}
	else
	{
		 $pdf->SetX(2);	
	$pdf->SetFont('Arial','',8);
	$pdf->SetTextColor(0,0,0);
	$pdf->Row(array('IGST @','0 %',"0"));
	}
	
	 $total_gstamount +=$netgst;

}

// $pdf->SetX(2);
// $pdf->SetFont('Arial','B',9);
// $pdf->SetFillColor(170, 170, 170); //gray
// $pdf->SetTextColor(0,0,0);
// $pdf->Cell(107,6,'Total Tax','1',0,'R',1);  
// $pdf->Cell(37,6,number_format($total_gstamount,2),1,1,'R',1);

}

 


$pdf->Output();

?> 
                          	
<?php
mysql_close($db_link);

?>
