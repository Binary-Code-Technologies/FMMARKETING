<?php
include("../adminsession.php");
require("../fpdf182/fpdf.php");

$crit = " where  1 = 1 ";

if($_GET['todate']!="" && $_GET['todate']!="")
{
	$todate = addslashes(trim($_GET['todate']));
	$fromdate= addslashes(trim($_GET['fromdate']));
}

if($todate !='' && $fromdate !='')
{
	$todate = $cmn->dateformatusa($todate);
	$fromdate= $cmn->dateformatusa($fromdate);	
	$crit .=" and saledate between '$fromdate' and '$todate'";
}

$gsttinno = $cmn->getvalfield($connection,"company_setting","gsttinno ","1=1");

$sql_get = mysqli_query($connection,"Select * from saleentry $crit and billtype='withouttax' order by saleid desc");
while($row_get = mysqli_fetch_assoc($sql_get))
{
	
			$billamount=0;
			$total=0;
			$suppartyid = $row_get['suppartyid'];
			 $total = $cmn->getTotalBillAmt2($row_get['saleid']); 
			$disc = $row_get['disc'];
			$sgst=$cmn->getbillwisegstsale("sgst",$row_get['saleid']);
			$cgst=$cmn->getbillwisegstsale("cgst",$row_get['saleid']);
			$igst=$cmn->getbillwisegstsale("igst",$row_get['saleid']);
			$billamount=$total-$disc;
			$supparty_name = $cmn->getvalfield($connection,"m_supplier_party","supparty_name","suppartyid='$suppartyid'");
			
			
			$nettotal +=$billamount;
			$netcgst +=$cgst;
			$netsgst +=$sgst;
			$netigst +=$igst;
			$nettaxamt +=$cgst+$sgst+$igst;
	
}

//echo $nettotal; die;


$fromdate  = $cmn->dateformatindia($fromdate);
	$todate  = $cmn->dateformatindia($todate);

class PDF_MC_Table extends FPDF
{
  var $widths;
  var $aligns;

	function Header()
	{
		global $title1,$title2,$title3,$fromdate,$todate,$supparty_name,$nettotal,$netcgst,$netsgst,$netigst,$gsttinno;
		 // courier 25
		$this->Rect(5,5,200,287);
		
		// Move to the right
		
		// Title
		$this->SetX(5);
		$this->SetFont('courier','b',10);
		$this->Cell(100,0,"GST IN No :"." ".$gsttinno,0,0,'L');
		$this->SetFont('courier','b',18);
		
		$this->Cell(10,0,$title1,0,1,'C');
		// Line break
		$this->Ln(6);
		// Move to the right
		$this->Cell(90);
		 // courier bold 15
		$this->SetFont('courier','b',9);
		$this->Cell(20,0,$title2,0,1,'C');
		$this->Ln(5);
		
		$this->Cell(90);
		$this->SetFont('courier','b',9);
		$this->Cell(20,0,$title3,0,1,'C');
		
		
		  // Move to the right
		$this->Cell(80);
		// Line break
		$this->Ln(15);
		
		$this->Cell(82);
		 // courier bold 15
	 	$this->SetY(30);
		$this->SetX(5);
		$this->SetFont('courier','b',10);
		$this->Cell(200,0,'',T,0,0,'C');
	     $this->Ln(2);
		 
		  $this->SetX(90);
		 $this->SetFont('Arial','B',12);
		$this->Cell(150,6,'Sale GST Report',0,0,'L',0);
	
		$this->Ln(10);
		 $this->SetX(25);
		 $this->SetFont('Arial','B',8);
		$this->Cell(80,6,'From Date :-'.' '.$fromdate,0,0,'L',0);
		$this->Cell(80,6,'TO Date :-'.' '.$todate,0,0,'R',0);
		$this->Ln(8);
		
		
		$this->SetX(25);
		
		$this->SetFont('Arial','B',9);
		$this->Cell(80,6,'Total Sale',1,0,'L',0);
		$this->Cell(80,6,number_format($nettotal,2),1,1,'R',0);
		
		$this->SetX(25);
		$this->Cell(80,6,'Total CGST',1,0,'L',0);
		$this->Cell(80,6,number_format($netcgst,2),1,1,'R',0);
		
		$this->SetX(25);
		$this->Cell(80,6,'Total SGST ',1,0,'L',0);
		$this->Cell(80,6,number_format($netsgst,2),1,1,'R',0);
		
		
		
		$this->SetX(25);
		$this->Cell(80,6,'Total IGST',1,0,'L',0);
		$this->Cell(80,6,number_format($netigst,2),1,1,'R',0);
		
	
		$this->SetX(25);
		$this->SetFillColor(170, 170, 170);
		$this->Cell(80,6,'Net Total',1,0,'L',1);
		$this->Cell(80,6,number_format($netigst+$netcgst+$netsgst+$nettotal,2),1,1,'R',1);
		
		
	}
	  // Page footer
	function Footer()
	{
	// Position at 1.5 cm from bottom
		$this->SetY(-15);
		// Arial italic 8
		$this->SetFont('Arial','I',8); 
		// Page number
		$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
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

$address  = $cmn->getvalfield($connection,"company_setting","address","1 = 1");
$address2 = $cmn->getvalfield($connection,"company_setting","address2","1 = 1");
$mobile   = $cmn->getvalfield($connection,"company_setting","mobile","1 = 1");
$email_id  = $cmn->getvalfield($connection,"company_setting","email_id","1 = 1");

$title2 =   $address.$address2;

$title3 = "Mobile No :".$mobile." "."Email :".$email_id;

$pdf->SetTitle("Total Sale GST");
//$pdf->SetTitle($title2);
$pdf->AliasNbPages();
$pdf->AddPage('P','A4');	 
$pdf->Output();
?>                         	
<?php
mysql_close($db_link);
?>