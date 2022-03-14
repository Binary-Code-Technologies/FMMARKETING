<?php error_reporting(0);                                                                                                   include("../adminsession.php");
require("../fpdf182/fpdf.php");


$comp_name =  $cmn->getvalfield($connection,"company_setting","comp_name","1 = 1");



if(isset($_GET['saleid']))
{
	$saleid = $_GET['saleid'];
	$sql = "select * from saleentry where saleid = '$saleid'";
	$res = mysqli_query($connection,$sql);
	$row = mysqli_fetch_array($res);
	$branch_id = $row['branch_id'];
	$billno = $row['billno'];
	$saledate = $cmn->dateformatindia($row['saledate']);
	$receivername = $row['receivername'];
	$remark = $row['remark'];
	
	
	$branch_name=$cmn->getvalfield($connection,"m_branch","branch_name","branch_id='$branch_id'");
	
}
else
$saleid = 0;




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
		global $title1,$title2,$branch_name,$billno,$saledate,$receivername,$remark;
		 // courier 25
		 
		 $this->Rect(2, 2, 144, 205, 'D');
		$this->SetFont('courier','b',20);
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
		$this->SetFont('courier','b',15);
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
	    $this->Cell(25,5,"Branch Name :",0,0,'L');
		$this->SetFont('courier','',9);
	    $this->Cell(60,5,$branch_name,0,0,'L');
		
		$this->SetFont('courier','b',9);
	    $this->Cell(20,5,"BILL NO :",0,0,'L');
		$this->SetFont('courier','',9);
	    $this->Cell(28,5,$billno,0,1,'L');
		
		$this->SetX(2);
		
		$this->SetFont('courier','b',9);
	    $this->Cell(25,5,"Received By :",0,0,'L');
		$this->SetFont('courier','',9);
	    $this->Cell(60,5,$receivername,0,0,'L');
		
	    $this->SetFont('courier','b',9);
	    $this->Cell(25,5,"BILL DATE :",0,0,'L');
		$this->SetFont('courier','',9);
	    $this->Cell(20,5,$saledate,0,1,'R');
		
		$this->SetX(2);
		$this->SetFont('courier','b',9);
	    $this->Cell(25,5,"Remark:",0,0,'L');
		$this->SetFont('courier','',9);
	    $this->Cell(60,5,$remark,0,0,'L');
		
		
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
$title1 ="SLIP";
$pdf->SetTitle($title1);
$title2 = $cmn->getvalfield($connection,"company_setting","comp_name","1 = 1");
$pdf->SetTitle($title2);

$pdf->AliasNbPages();
$pdf->AddPage('P','A5');
$pdf->SetX(2);
$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(170, 170, 170); //gray
$pdf->SetTextColor(255,255,255);
$pdf->Cell(10,6,' Sno','1',0,'L',1);  
$pdf->Cell(70,6,'Product Name',1,0,'L',1);
$pdf->Cell(32,6,'UNIT',1,0,'L',1);
$pdf->Cell(32,6,'QTY',1,1,'L',1);


$pdf->SetX(2);
$pdf->SetWidths(array(10,70,32,32));
$pdf->SetAligns(array("C","L","L","L"));

$pdf->SetFont('Arial','',6);
$slno = 1;
$sql_get = mysqli_query($connection,"Select * from saleentry_detail where saleid='$saleid'");
			while($row_get = mysqli_fetch_assoc($sql_get))
{
		$amount=0;
		$productid=$row_get['productid'];
		$unitid=$row_get['unitid'];
		$prodname=$cmn->getvalfield($connection,"m_product","prodname","productid='$productid'");
		$unit_name = $cmn->getvalfield($connection,"m_unit","unit_name","unitid ='$unitid'");		
		$qty =$row_get['qty'];
		
											  											
	$pdf->SetX(2);	
	$pdf->SetFont('Arial','',8);
	$pdf->SetTextColor(0,0,0);
	$pdf->Row(array($slno,$prodname,$unit_name,$row_get['qty']));
	
	$total +=$amount;
	$slno++;
}

$pdf->Output();

?> 
                          	
<?php
mysql_close($db_link);

?>
