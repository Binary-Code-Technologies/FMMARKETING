<?php error_reporting(0);                                                                                                   include("../adminsession.php");
require("../fpdf182/fpdf.php");
$comp_name =  $cmn->getvalfield($connection,"company_setting","comp_name","1 = 1");
$stateid =  $cmn->getvalfield($connection,"company_setting","stateid","1 = 1");
$company_code=$cmn->getvalfield($connection,"m_state","state_code","stateid = '$stateid'");
$company_state=$cmn->getvalfield($connection,"m_state","state_name","stateid = '$stateid'");
$gsttinno=$cmn->getvalfield($connection,'company_setting','gsttinno','1=1');
if(isset($_GET['pretentry_id']))
{
	$pretentry_id = $_GET['pretentry_id'];
//	echo "select * from purreturn_entry where pretentry_id = '$pretentry_id'";die;
	$sql = "select * from purreturn_entry where pretentry_id = '$pretentry_id'";
	$res = mysqli_query($connection,$sql);
	$row = mysqli_fetch_array($res);
		$purchaseid = $row['purchaseid'];
			$orderno = $row['orderno'];
	$suppartyid=$cmn->getvalfield($connection,"purchaseentry","suppartyid","purchaseid='$purchaseid'");
	$billno=$cmn->getvalfield($connection,"purchaseentry","billno","purchaseid='$purchaseid'");
	$purchasedate=$cmn->getvalfield($connection,"purchaseentry","purchasedate","purchaseid='$purchaseid'");
	$purchasedate = $cmn->dateformatindia($purchasedate);
    $ret_date = $cmn->dateformatindia($row['ret_date']);
	$purchase_type = $row['purchase_type'];
	$billtype = $row['billtype'];
	$discr = $row['disc'];
	$packing_charge = $row['packing_charge'];
	$freight_charge = $row['freight_charge'];
	$challan_no = $row['challan_no'];
	$packing_charge = $row['packing_charge'];
	$transport_name = $row['transport_name'];
	$transport_date = $cmn->dateformatindia($row['transport_date']);
	$freight_charge = $row['freight_charge'];
	$supparty_name=$cmn->getvalfield($connection,"m_supplier_party","supparty_name","suppartyid='$suppartyid'");
	 $sup_mobile=$cmn->getvalfield($connection,"m_supplier_party","mobile","suppartyid='$suppartyid'");
	$sup_address=$cmn->getvalfield($connection,"m_supplier_party","address","suppartyid='$suppartyid'");
	$tinno = $cmn->getvalfield($connection,"m_supplier_party","tinno","suppartyid='$suppartyid'");
	$stateid=$cmn->getvalfield($connection,"m_supplier_party","stateid","suppartyid='$suppartyid'");
	$cus_code=$cmn->getvalfield($connection,"m_state","state_code","stateid = '$stateid'");
	 $cus_state=$cmn->getvalfield($connection,"m_state","state_name","stateid = '$stateid'");
}
else
$purchaseid = 0;
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
		global $title1,$title2,$supparty_name,$mobile,$orderno,$ret_date,$gsttinno,$transport_name,$transport_date,$sup_address,$company_code,$company_state,$cus_code,$cus_state,$challan_no,$title3,$title4,$tinno,$address2,$comp_name,$sup_mobile,$tinno,$purchasedate,$billno;
		 //courier 25
		$this->Rect(5, 5,200,287,'D');
		//for first Rect
		$this->Rect(5,28,100,33,'D');
		//for second Rect
		$this->Rect(105,28,100,33,'D');
	     //$this->SetFont('courier','b',20);
		///for Second part
		//$this->Rect(5,40,100,20,'D');
		//for second Rect
		//$this->Rect(5,70,200,14,'D');
		$this->SetFont('courier','b',18);
		$this->SetY(8);
		$this->Cell(90);
		$this->Cell(10,0,"TAX PURCHASE RETURN INVOICE",0,1,'C');
		$this->Ln(5);
		$this->SetFont('courier','b',11);
		$this->Cell(90);
		$this->Cell(10,0,"(Under Section 31 and rule 46 of GST Act,2017)",0,1,'C');
		$this->Ln(5);
	   $this->SetFont('courier','b',15);
		// Move to the right
		$this->Cell(90);
		// Title
		$this->Cell(10,0,strtoupper($comp_name),0,1,'C');
		// Line break
		$this->Ln(5);
		$this->SetFont('courier','b',9);
		$this->Cell(90);
		$this->Cell(10,0,$title3." "."Mobile No :".$mobile,0,1,'C');
	    //$this->Ln(4);
		// $this->SetFont('courier','b',9);
		// $this->Cell(90);
	    // $this->Cell(10,0,$title4,0,1,'C');
		$this->Ln(5);
		// $this->SetFont('courier','b',9);
		//$this->Cell(90);
	   // $this->Cell(10,0,"Subject to Raipur Jurisdiction",0,1,'C');
		//$this->Ln(5);
		$this->Line(5,28,205,28);
		$this->Line(5,33,205,33);
		
		// for Company GST
		$this->SetX(5);
		$this->SetFont('courier','b',9);
		$this->Cell(29,5,"Supplier Details -",0,0,'L');
		$this->Cell(71,5," ",0,0,'L');
		//for Supplier Name
		$this->SetFont('courier','b',9);
		$this->Cell(28,5,"Billed To  -",0,0,'L');
		$this->Cell(72,5,"",0,1,'L');
		
		
		
		$this->SetX(5);
		$this->SetFont('courier','b',9);
		$this->Cell(23,5,"Name :",0,0,'L');
		$this->Cell(78,5,$comp_name,0,0,'L');
		//for Supplier Name
		$this->SetFont('courier','b',9);
		$this->Cell(25,5,"Supplier Name ",0,0,'L');
		$this->Cell(80,5,":".$supparty_name,0,1,'L');
	
	    //for Company Invoice
		$this->SetX(5);
		$this->SetFont('courier','b',9);
		$this->Cell(23,5,"Address",0,0,'L');
		$this->Cell(78,5,":".$title3,0,0,'L');
		//for Supplier GST
		$this->SetFont('courier','b',9);
		$this->Cell(25,5,"Retrun No",0,0,'L');
		$this->Cell(25,5,":".$orderno,0,0,'L');
		$this->Cell(25,5,"Invoice Date",0,0,'L');
		$this->Cell(75,5,":".$purchasedate,0,1,'L');
		//for Company Invoice
		$this->SetX(5);
		$this->SetFont('courier','b',9);
		$this->Cell(23,5,"Invoice No",0,0,'L');
		$this->Cell(78,5,":".$billno,0,0,'L');
		
		//for Supplier GST
		$this->SetFont('courier','b',9);
		$this->Cell(30,5,"Place of Supply",0,0,'L');
		$this->Cell(50,5,":".$cus_state."(".$cus_code.")",0,1,'L');
		//for Company Invoice
		//$this->SetX(5);
		//$this->SetFont('courier','b',9);
		//$this->Cell(29,5,"Date of Supply",1,0,'L');
		//$this->Cell(71,5,":".$saledate."Time : ".time($saledate),1,0,'L');
		//for Supplier GST
		//$this->SetFont('courier','b',9);
		//$this->Cell(28,5,"GSTIN",1,0,'L');
		//$this->Cell(72,5,":".$tinno,1,1,'L');
		
		//for Company Address
		$this->SetX(5);
		$this->SetFont('courier','b',9);
		$this->Cell(23,5,"State",0,0,'L');
		$this->Cell(78,5,":"." Chhaattisgarh(22) ",0,0,'L');
		//for Supplier GST
		$this->SetFont('courier','b',9);
		$this->Cell(25,5,"GSTIN",0,0,'L');
		$this->Cell(78,5,":".$tinno,0,1,'L');
		
		$this->SetX(5);
		$this->SetFont('courier','b',9);
		$this->Cell(23,5,"GSTIN",0,0,'L');
		$this->Cell(78,5,":".$gsttinno,0,0,'L');
		//for Supplier Name
		
	
		$this->SetFont('courier','b',9);
		$this->Cell(20,5,"Address : ",0,0,'L');
		$this->MultiCell(85,3,$sup_address,0,'L');
	//	$this->Cell(72,5,":".$sup_address,0,1,'L');
		
		
		
	    $this->Ln(7 );
	   $this->SetX(5);
		$this->SetFont('Arial','B',8);
		$this->SetFillColor(170, 170, 170); //gray
		$this->SetTextColor(0,0,0);
		$this->Cell(9,7,'Sno','1',0,'L',1);  
		$this->Cell(31,7,'Product Name',1,0,'L',1);
		$this->Cell(15,7,'HSN/SAC',1,0,'L',1);
		$this->Cell(11,7,'UNIT',1,0,'L',1);
		$this->Cell(12,7,'QTY',1,0,'C',1);
		$this->Cell(13,7,'RATE',1,0,'C',1);
		$this->Cell(12,7,'Disc',1,0,'C',1);
		$this->Cell(15,7,'AMOUNT',1,0,'C',1);
		$this->Cell(22,7,'CGST',1,0,'C',1);
		$this->Cell(22,7,'SGST',1,0,'C',1);
		$this->Cell(20,7,'IGST',1,0,'C',1);
		$this->Cell(18,7,'Total',1,1,'C',1);
		$this->SetX(5);
		
		$this->SetFont('Arial','B',8);
		$this->SetFillColor(170, 170, 170); //gray
		$this->SetTextColor(0,0,0);
		$this->Cell(118,7,'',1,0,'L',1);
		$this->Cell(11,7,'Rate',1,0,'L',1);
		$this->Cell(11,7,'Amt.',1,0,'L',1);
	
	    $this->Cell(11,7,'Rate',1,0,'L',1);
		$this->Cell(11,7,'Amt.',1,0,'L',1);
		
		$this->Cell(9,7,'Rate',1,0,'L',1);
		$this->Cell(11,7,'Amt.',1,0,'L',1);
		
		$this->Cell(18,7,'',1,1,'L',1);
		
		$this->SetWidths(array(9,31,15,11,12,13,12,15,11,11,11,11,9,11,18));
		$this->SetAligns(array("C","L","L","L","R","R","R","R","R","R","R","R","R","R","R","R","R"));
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
$title1 = "PURCHASE RETURN INVOICE";
$pdf->SetTitle($title1);
$title2 = $cmn->getvalfield($connection,"company_setting","comp_name","1 = 1");
$address = $cmn->getvalfield($connection,"company_setting","address","1 = 1");
$address2 = $cmn->getvalfield($connection,"company_setting","address2","1 = 1");
$email_id  = $cmn->getvalfield($connection,"company_setting","email_id ","1 = 1");
$mobile  = $cmn->getvalfield($connection,"company_setting","mobile ","1 = 1");

$title3 = $address;
$title4 = "Mobile No : ".$mobile." "."Email ID : ".$email_id;
$pdf->AliasNbPages();
$pdf->AddPage('P','A4');
$slno = 1;
//echo "Select * from pur_return where pretentry_id='$pretentry_id'";die;
$sql_get = mysqli_query($connection,"Select * from pur_return where pretentry_id='$pretentry_id'");
			while($row_get = mysqli_fetch_assoc($sql_get))
{
		$amount=0;
		$gsttax=0;
		$gstamt=0;
		
		$cgstamt=0;
		$sgstamt=0;
		$igstamt=0;
		
		$productid=$row_get['productid'];
		$prodname=$cmn->getvalfield($connection,"m_product","prodname","productid='$productid'");
		$unitid=$cmn->getvalfield($connection,"m_product","unitid","productid='$productid'");
		$hsn_no=$cmn->getvalfield($connection,"m_product","hsn_no","productid='$productid'");
		$unit_name = $cmn->getvalfield($connection,"m_unit","unit_name","unitid ='$unitid'");
		$rate =$row_get['rate'];
		$qty =$row_get['ret_qty'];			
		$vat =$row_get['vat'];
		 $igst =$row_get['igst'];
		$sgst =$row_get['sgst'];
		$cgst =$row_get['cgst'];
		$disc =$row_get['disc'];
		
		
	   $amount= $rate * $qty;
	   
	   if($disc !='0')
	   {
		   $discamt= ($amount * $disc)/100;	     	
	   }
	   else
	   {
			$discamt=0;   
	   }
	   
	   $amount= $amount - $discamt;
	
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
			  $igstamt;
			
		}
		
	   $totaltax = ($cgstamt+$sgstamt+$igstamt);
		
	$pdf->SetX(5);	
	$pdf->SetFont('Arial','',8);
	$pdf->SetTextColor(0,0,0);
	$pdf->Row(array($slno,$prodname,$hsn_no,$unit_name,$qty,$rate,$discamt,$amount,$cgst.' %',number_format($cgstamt,2),$sgst.' %',number_format($sgstamt,2),$igst.' %',number_format($igstamt,2),number_format($amount + $gstamt,2)));
	$tot_qty +=$qty;
	$tot_amt +=$amount;
	$total +=$amount+$gstamt;
	
	$totcgst += $cgst.'%';
	$totsgcst += $sgst.'%';
	$totigst += $igst.'%';
	$slno++;
	}	
$pdf->SetX(5);
$pdf->SetFont('Arial','B',8);
$pdf->SetFillColor(170, 170, 170); //gray
$pdf->SetTextColor(0,0,0);
$pdf->Cell(66,7,'Total','1',0,'R',1);  
$pdf->Cell(12,7,$tot_qty,1,0,'R',1);
$pdf->Cell(13,7,'',1,0,'L',1);
$pdf->Cell(12,7,'',1,0,'L',1);
$pdf->Cell(15,7,number_format($tot_amt,2),1,0,'R',1);
$pdf->Cell(11,7,'',1,0,'L',1);
$pdf->Cell(11,7,'',1,0,'R',1);
$pdf->Cell(11,7,'',1,0,'R',1);
$pdf->Cell(11,7,'',1,0,'R',1);
$pdf->Cell(9,7,'',1,0,'R',1);
$pdf->Cell(11,7,'',1,0,'R',1);
$pdf->Cell(18,7,number_format($total,2),1,1,'R',1);
$pdf->SetX(5);
$pdf->SetFont('arial','b',9);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(172,5,'SUBTOTAL :',0,0,'R',0);
$pdf->Cell(28,5,number_format($tot_amt,2),'0',1,'R',0);
/*if($discr !='0')
{	
$tot_amt-=$discr;
$pdf->SetX(5);
$pdf->SetFont('arial','b',9);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(172,5,'Disc(Rs) :',0,0,'R',0);
$pdf->Cell(28,5,"( - ) ".number_format($discr,2),'0',1,'R',0);
}

if($packing_charge !='0')
{
$pdf->SetX(5);
$pdf->SetFont('arial','b',9);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(172,5,'Packing Charge(Rs) :',0,0,'R',0);
$pdf->Cell(28,5,number_format($packing_charge,2),'0',1,'R',0);
}
$freight_tax=0; 
if($freight_charge !='0')
{
$pdf->SetX(5);
$pdf->SetFont('arial','b',9);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(172,5,'Freight Charge(Rs) :',0,0,'R',0);
$pdf->Cell(28,5,number_format($freight_charge,2),'0',1,'R',0);

$freight_tax=($freight_charge * 5)/100;
}*/

 $taxamt=$cmn->getTotalcgst_purReturn($pretentry_id);
$igstamt=$cmn->getTotalIgst_purReturn($pretentry_id); 

if($taxamt !='')
{
$pdf->SetX(5);
$pdf->SetFont('arial','b',9);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(172,5,'ADD CGST :',0,0,'R',0);
$pdf->Cell(28,5,number_format($taxamt/2+$freight_tax/2,2),'0',1,'R',0);

$pdf->SetX(5);
$pdf->SetFont('arial','b',9);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(172,5,'ADD SGST :',0,0,'R',0);
$pdf->Cell(28,5,number_format($taxamt/2+$freight_tax/2,2),'0',1,'R',0);
$pdf->SetX(5);
}
if($igstamt !='')
{
$pdf->SetX(5);
$pdf->SetFont('arial','b',9);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(172,5,'ADD IGST :',0,0,'R',0);
$pdf->Cell(28,5,number_format($igstamt+$freight_tax,2),'0',1,'R',0);
}
$tot_amt=$tot_amt + $packing_charge + $freight_charge;

$pdf->SetX(5);
$pdf->SetFont('arial','b',9);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(172,5,'NET TOTAL :',0,0,'R',0);
$pdf->Cell(28,5,number_format(round($tot_amt+$taxamt+$igstamt+$freight_tax),2),'0',1,'R',0);

$pdf->Ln(7);	
$pdf->SetX(5);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(200,5,'Total Amount in Words'.ucfirst(convert_number_to_words(round($tot_amt+$taxamt+$igstamt+$freight_tax)))." ONLY",0,1,'L',0);
$pdf->Ln(5);

$pdf->Output();
?> 
                          	
<?php
mysql_close($db_link);

?>
