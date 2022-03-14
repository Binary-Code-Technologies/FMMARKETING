<?php error_reporting(0); 
include("../adminsession.php");
require("../fpdf182/fpdf.php");
$comp_name =  $cmn->getvalfield($connection,"company_setting","comp_name","1 = 1");
$stateid =  $cmn->getvalfield($connection,"company_setting","stateid","1 = 1");
$company_code=$cmn->getvalfield($connection,"m_state","state_code","stateid = '$stateid'");
$company_state=$cmn->getvalfield($connection,"m_state","state_name","stateid = '$stateid'");
$gsttinno=$cmn->getvalfield($connection,'company_setting','gsttinno','1=1');
$comp_name =  $cmn->getvalfield($connection,"company_setting","comp_name","1 = 1");
$gsttinno=$cmn->getvalfield($connection,'company_setting','gsttinno','1=1');
$licence_no=$cmn->getvalfield($connection,'company_setting','licence_no','1=1');
$com_panno=$cmn->getvalfield($connection,'company_setting','com_panno','1=1');
$com_vanno=$cmn->getvalfield($connection,'company_setting','com_vanno','1=1');
$com_vanlicno=$cmn->getvalfield($connection,'company_setting','com_vanlicno','1=1');
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
	$order_no = $row['order_no'];
	
	
    $supparty_name=$cmn->getvalfield($connection,"m_supplier_party","supparty_name","suppartyid='$suppartyid'");
	$smobile=$cmn->getvalfield($connection,"m_supplier_party","mobile","suppartyid='$suppartyid'");
	$cust_address=$cmn->getvalfield($connection,"m_supplier_party","address","suppartyid='$suppartyid'");
		$panno=$cmn->getvalfield($connection,"m_supplier_party","panno","suppartyid='$suppartyid'");
    $tinno = $cmn->getvalfield($connection,"m_supplier_party","tinno","suppartyid='$suppartyid'");
	$stateid=$cmn->getvalfield($connection,"m_supplier_party","stateid","suppartyid='$suppartyid'");
	$cus_code=$cmn->getvalfield($connection,"m_state","state_code","stateid = '$stateid'");
	$cus_state=$cmn->getvalfield($connection,"m_state","state_name","stateid = '$stateid'");
	
	
    $packing_charge = $row['packing_charge'];
	$freight_charge   = $row['freight_charge'];
}
else
$purchaseid = 0;
$packing_charge = 0;
$freight_charge  = 0;
function convert_number_to_words($number)
 {
  
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
		global $title1,$title2,$supparty_name,$address2,$mobile,$billno,$purchasedate,$gsttinno,$transport_name,$transport_date,$address,$tinno,$company_code,$company_state,$cus_code,$cus_state,$challan_no,$tinno,$purchase_type,$title4,$tinno,$cust_address,$licence_no,$com_panno,$com_vanno,$order_no,$com_vanlicno;
		 // courier 25
	$this->Rect(5, 5,200,287,'D');
		//for first Rect
		$this->Rect(5,33,100,20,'D');
		//for second Rect
	$this->Rect(105,33,100,20,'D');
	 
	//	$this->Rect(5,70,200,14,'D');
		
		
		$this->SetY(5);
		$this->SetX(5);
		$this->SetFont('courier','b',8);
		$this->Cell(140,5,"",'0',0,'L',0);
		$this->Cell(20,5,"",'0',0,'L',0);
		$this->Cell(40,5,'','0',1,'L',0);
		
		$this->SetX(5);
		$this->SetFont('courier','b',8);
		$this->Cell(140,5,"".$tinno,'0',0,'L',0);
		$this->Cell(20,5,"",'0',0,'L',0);
		$this->Cell(40,5,'','0',1,'L',0);
		
		$this->SetX(5);
		$this->SetFont('courier','b',8);
		$this->Cell(100,5,"",'0',0,'L',0);
		
		$this->SetFont('courier','b',18);
		
		$this->Cell(10,0,"PURCHASE INVOICE",0,1,'C');
		$this->SetFont('courier','b',18);
		
		$this->Ln(5);
		
	   $this->SetFont('courier','b',15);
		// Move to the right
		$this->Cell(90);
		// Title
		$this->Cell(10,0,$supparty_name,0,1,'C');
		// Line break
		$this->Ln(5);
		
		 $this->SetFont('courier','b',9);
		// Move to the right
		$this->Cell(90);
		// Title
		$this->Cell(10,0,$cust_address,0,1,'C');
		$this->Ln(4);
		
		 $this->SetFont('courier','b',9);
		 $this->Cell(90);
	     $this->Cell(10,0,"Mobile No.".$mobile,0,1,'C');
		 $this->Ln(4);
		
		
		$this->Line(5,33,205,33);
		
		// for Company GST
		$this->SetX(5);
		$this->SetFont('courier','b',9);
		$this->Cell(29,4,"Customer Details",0,0,'L');
		$this->Cell(71,4,"",0,0,'L');
		//for Supplier Name
		$this->SetFont('courier','b',9);
		$this->Cell(28,4,"Invoice No  :",0,0,'L');
		$this->Cell(72,4,$billno,0,1,'L');
		
		$this->SetX(5);
		$this->SetFont('courier','b',9);
		$this->Cell(29,4,$title2,0,0,'L');
		$this->Cell(71,4," ",0,0,'L');
		//for Supplier Name
		$this->SetFont('courier','b',9);
		$this->Cell(28,4,"Date        :",0,0,'L');
		$this->Cell(68,4,$purchasedate,0,1,'L');
		
		
		//for Company Invoice
		$this->SetX(5);
		$this->SetFont('courier','b',9);
		$this->Cell(29,4,$address,0,0,'L');
		$this->Cell(71,4,"",0,0,'L');
		//for Supplier GST
		$this->SetFont('courier','b',9);
		$this->Cell(28,4,"",0,0,'L');
		$this->Cell(72,4,'',0,1,'L');
		
					
		//for Company Invoice
		$this->SetX(5);
		$this->SetFont('courier','b',9);
		$this->Cell(29,4,$address2,0,0,'L');
		$this->Cell(71,4,"",0,0,'L');
		
		
	   $this->Ln(12);
	   $this->SetX(5);
		$this->SetFont('Arial','B',8);
		$this->SetFillColor(170, 170, 170); //gray
		$this->SetTextColor(255,255,255);
		if($purchase_type=='Challan'){
		$this->Cell(7,7,'Sno','1',0,'L',1);  
		$this->Cell(90,7,'Product Name',1,0,'L',1);
		//$this->Cell(15,7,'HSN',1,0,'L',1);
		$this->Cell(15,7,'UNIT',1,0,'L',1);		
		$this->Cell(15,7,'QTY',1,0,'R',1);
		$this->Cell(14,7,'RATE',1,0,'R',1);
		$this->Cell(17,7,'AMOUNT',1,0,'R',1);
		$this->Cell(15,7,'DISC',1,0,'R',1);
		//$this->Cell(10,6,'DISC.',0,0,'L',1);
		
		$this->Cell(27,7,'Total',1,1,'R',1);
	
		//$this->SetWidths(array(9,31,16,13,10,14,17,10,20,20,20,20));
		$this->SetWidths(array(7,90,15,15,14,17,15,27));
		//$this->SetAligns(array("L","L","L","L","R","R","R","R","R","R","R","R"));
		$this->SetAligns(array("C","L","L","L","R","R","R","R","R","R","R","R","R"));
		}
		else{
			
			$this->Cell(7,7,'Sno','1',0,'L',1);  
		$this->Cell(29,7,'Product Name',1,0,'L',1);
		//$this->Cell(15,7,'HSN',1,0,'L',1);
		$this->Cell(15,7,'UNIT',1,0,'L',1);		
		$this->Cell(15,7,'QTY',1,0,'R',1);
		$this->Cell(14,7,'RATE',1,0,'R',1);
		$this->Cell(17,7,'AMOUNT',1,0,'R',1);
		$this->Cell(10,7,'DISC',1,0,'R',1);
		//$this->Cell(10,6,'DISC.',0,0,'L',1);
		$this->Cell(22,7,'CGST',1,0,'R',1);
		$this->Cell(22,7,'SGST',1,0,'R',1);
		$this->Cell(22,7,'IGST',1,0,'R',1);
		$this->Cell(27,7,'Total',1,1,'R',1);
		$this->SetX(5);
		
		$this->SetFont('Arial','B',8);
		$this->SetFillColor(170, 170, 170); //gray
		$this->SetTextColor(255,255,255);
		$this->Cell(107,7,'',1,0,'L',1);
		$this->Cell(11,7,'Rate',1,0,'L',1);
		$this->Cell(11,7,'Amt.',1,0,'L',1);
	
	    $this->Cell(11,7,'Rate',1,0,'L',1);
		$this->Cell(11,7,'Amt.',1,0,'L',1);
		
		$this->Cell(11,7,'Rate',1,0,'L',1);
		$this->Cell(11,7,'Amt.',1,0,'L',1);
		
		$this->Cell(27,7,'',1,1,'L',1);
		//$this->SetWidths(array(9,31,16,13,10,14,17,10,20,20,20,20));
		$this->SetWidths(array(7,29,15,15,14,17,10,11,11,11,11,11,11,27));
		//$this->SetAligns(array("L","L","L","L","R","R","R","R","R","R","R","R"));
		$this->SetAligns(array("C","L","L","L","R","R","R","R","R","R","R","R","R","R","R","R","R"));
			
		}
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
		$this->MultiCell(200,5,'|| Developed By Binary Code Technologies, Contact us- +91-9302536911,||',0,'C');
		
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
    $h=8*$nb;
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
        $this->MultiCell($w,8,$data[$i],0,$a);
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
$title1 = "Sale INVOICE";
$pdf->SetTitle($title1);
$title2 = $cmn->getvalfield($connection,"company_setting","comp_name","1 = 1");
$address = $cmn->getvalfield($connection,"company_setting","address","1 = 1");
$address2 = $cmn->getvalfield($connection,"company_setting","address2","1 = 1");
$email_id  = $cmn->getvalfield($connection,"company_setting","email_id ","1 = 1");
$mobile  = $cmn->getvalfield($connection,"company_setting","mobile ","1 = 1");

$title3 = $address."".$address2;
$title4 = "Mobile No : ".$mobile." "."Email ID : ".$email_id;
$pdf->SetTitle($title2);
$pdf->AliasNbPages();
$pdf->AddPage('P','A4');
$slno = 1;
$sql_get = mysqli_query($connection,"Select * from purchasentry_detail where purchaseid='$purchaseid'");
			while($row_get = mysqli_fetch_assoc($sql_get))
{
		$amount=0;
		$gsttax=0;
		
		$productid=$row_get['productid'];
		$unitid=$row_get['unitid'];
		$pcatid=$cmn->getvalfield($connection,"m_product","pcatid","productid='$productid'");
		$hsn_no=$cmn->getvalfield($connection,"m_product","hsn_no","productid='$productid'");
		$catname=$cmn->getvalfield($connection,"m_product_category","catname","pcatid='$pcatid'");
		
		$unit_name = $cmn->getvalfield($connection,"m_unit","unit_name","unitid ='$unitid'");
		$rate =$row_get['rate'];
		$qty =$row_get['qty'];			
		$vat =$row_get['vat'];
		$igst =$row_get['igst'];
		$sgst =$row_get['sgst'];
		$cgst =$row_get['cgst'];
		$disc =$row_get['disc'];
		$qtycase =$row_get['qtycase'];
		$sale_unit =$row_get['sale_unit'];
		
		
		$amount=	$qty * $rate;
		
		if($disc !='0')
				{
					$discamt=($amount * $disc)/100;
				}
				else
				{
					$discamt=0;
				}
				
				$amount= $amount-$discamt;
	
	if($cgst !='0' && $sgst !='0')
		{
		    $gstt=$cgst+$sgst;
			$gst="GST $gstt %";
			
			$gstamt=($amount * $gstt)/100;
			
			$cgstamt = ($gstamt/2);
			$sgstamt = ($gstamt/2);
			
		}
		if($igst !='0')
		{
			
			 $gstt="IGST $igst %";
			 $gstamt=($amount * $igst)/100;
			  $igstamt = $gstamt; 
			
			
		}
		
	   $totaltax = ($cgstamt+$sgstamt+$igstamt);
	  // echo $totaltax ; 
	   
		
	$pdf->SetX(5);	
	$pdf->SetFont('Arial','',8);
	$pdf->SetTextColor(0,0,0);
	if($purchase_type=='Challan'){
		$pdf->Row(array($slno,$catname,$unit_name,$qty,$rate,$amount,$disc.'%',number_format($amount + $totaltax,2)));

	}else{
			$pdf->Row(array($slno,$catname,$unit_name,$qty,$rate,$amount,$disc.'%',$cgst.' %',number_format($cgstamt,2),$sgst.' %',number_format($sgstamt,2),$igst.' %',number_format($igstamt,2),number_format($amount + $totaltax,2)));
	}
	$tot_qty +=$qty;
	$tot_amt +=$amount;
	$tot_cgst +=$cgstamt;
	$tot_sgst +=$sgstamt;
	$tot_igst +=$igstamt;
	$total +=$amount+$totaltax;
	
	
	$totcgst += $cgst.'%';
	$totsgcst += $sgst.'%';
	$totigst += $igst.'%';
	$slno++;
	}
	
$pdf->SetX(5);
$pdf->SetFont('Arial','B',8);
$pdf->SetFillColor(170, 170, 170); //gray
$pdf->SetTextColor(255,255,255);

if($purchase_type=='Challan'){
$pdf->Cell(112,7,'Total','1',0,'R',1);  
$pdf->Cell(15,7,$tot_qty,1,0,'R',1);
$pdf->Cell(14,7,'',1,0,'L',1);
$pdf->Cell(17,7,number_format($tot_amt,2),1,0,'R',1);
$pdf->Cell(15,7,'',1,0,'L',1);

$pdf->Cell(27,7,number_format($total,2),1,1,'R',1);
}else{
	$pdf->Cell(51,7,'Total','1',0,'R',1);  
$pdf->Cell(15,7,$tot_qty,1,0,'R',1);
$pdf->Cell(14,7,'',1,0,'L',1);
$pdf->Cell(17,7,number_format($tot_amt,2),1,0,'R',1);
$pdf->Cell(10,7,'',1,0,'L',1);
$pdf->Cell(22,7,number_format($tot_cgst,2),1,0,'R',1);
$pdf->Cell(22,7,number_format($tot_sgst,2),1,0,'R',1);
$pdf->Cell(22,7,number_format($tot_igst,2),1,0,'R',1);
$pdf->Cell(27,7,number_format($total,2),1,1,'R',1);
}

if($discr !='0')
{	
$total-=$discr;
$pdf->SetX(5);
$pdf->SetFont('arial','b',9);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(172,5,'Disc(Rs) :',0,0,'R',0);
$pdf->Cell(28,5,"( - ) ".number_format($discr,2),'0',1,'R',0);
}

 $taxamt=$cmn->getTotalGst($connection,$purchaseid);
$igstamt=$cmn->getTotalIgst_Sale($connection,$purchaseid);

if($taxamt !='')
{
$pdf->SetX(5);
$pdf->SetFont('arial','b',9);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(172,5,'ADD CGST :',0,0,'R',0);
$pdf->Cell(28,5,number_format($taxamt/2,2),'0',1,'R',0);

$pdf->SetX(5);
$pdf->SetFont('arial','b',9);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(172,5,'ADD SGST :',0,0,'R',0);
$pdf->Cell(28,5,number_format($taxamt/2,2),'0',1,'R',0);
$pdf->SetX(5);
}
if($igstamt !='')
{
$pdf->SetX(5);
$pdf->SetFont('arial','b',9);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(172,5,'ADD IGST :',0,0,'R',0);
$pdf->Cell(28,5,number_format($igstamt,2),'0',1,'R',0);
}
if($packing_charge !='0')
{
$pdf->SetX(5);
$pdf->SetFont('arial','b',9);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(172,5,'Packing Charge(Rs) :',0,0,'R',0);
$pdf->Cell(28,5,number_format($packing_charge,2),'0',1,'R',0);
}

if($freight_charge !='0')
{
$pdf->SetX(5);
$pdf->SetFont('arial','b',9);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(172,5,'Freight Charge(Rs) :',0,0,'R',0);
$pdf->Cell(28,5,number_format($freight_charge,2),'0',1,'R',0);
}
$tot_amt=$tot_amt + $packing_charge + $freight_charge;

$pdf->SetX(5);
$pdf->SetFont('arial','b',9);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(174,5,'NET TOTAL :',0,0,'R',0);
$pdf->Cell(26,5,number_format(round($total),2),'0',1,'R',0);
$pdf->Ln(7);	
$pdf->SetX(5);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(200,5,'Total Amount in Words   :  ' .ucfirst(convert_number_to_words(round($total)))." only.",0,1,'L',0);
$pdf->Ln(5);

$pdf->Output();
?> 
                          	
<?php
mysql_close($db_link);

?>
