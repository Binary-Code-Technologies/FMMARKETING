<?php
include("../adminsession.php");
require("../fpdf182/fpdf.php");
$crit = " where 1 = 1 ";
if($_GET['todate']!="" && $_GET['todate']!="")
{
	$todate = addslashes(trim($_GET['todate']));
	$fromdate= addslashes(trim($_GET['fromdate']));
}
else
{
	$todate = date('d-m-Y');
	$fromdate=date('d-m-Y');
}

if($_GET['suppartyid']!="")
	{
		$suppartyid= addslashes(trim($_GET['suppartyid']));
		$supparty_name = $cmn->getvalfield($connection,"m_supplier_party","supparty_name","suppartyid='$suppartyid'");
		$crit .=" and suppartyid='$suppartyid' ";
	}
if($todate !='' && $fromdate !='')
{
		
	$crit .=" and saledate between '$fromdate' and '$todate'";
}

$todate = $cmn->dateformatindia($todate);
$fromdate= $cmn->dateformatindia($fromdate);

class PDF_MC_Table extends FPDF
{
  var $widths;
  var $aligns;

	function Header()
	{
		global $title1,$title2 ,$fromdate,$todate,$supparty_name;
		 // courier 25
		$this->Rect(5,5,200,287);
		$this->SetFont('courier','b',18);
		// Move to the right
		$this->Cell(95);
		// Title
		$this->Cell(10,0,$title1,0,0,'C');
		// Line break
		$this->Ln(6);
		// Move to the right
		$this->Cell(90);
		 // courier bold 15
		$this->SetFont('courier','b',11);
		$this->Cell(20,0,$title2,0,0,'C');
		  // Move to the right
		$this->Cell(80);
		// Line break
		$this->Ln(15);
		
		$this->Cell(82);
		 // courier bold 15
	   
		
	   
		$this->SetY(20);
		$this->SetX(5);
		$this->SetFont('courier','b',10);
		$this->Cell(200,0,'',T,0,0,'C');
	     $this->Ln(2);
		
		$this->Cell(-1);
		$this->SetFont('courier','b',8);
		//$this->Cell(95,5,"".$collect_from,0,0,'L');
		$this->Cell(55,5,"From Date : ".$fromdate,0,0,'L');
		$this->Cell(55,5,"To Date : ".$todate,0,1,'L');
		//$this->Cell(55,5,"Customer : ".$supparty_name,0,1,'L');
		$this->Ln(1);
		$this->SetX(5);
		$this->SetFont('Arial','B',9);
		$this->Cell(10,6,'Sno','LTR',0,'L',0);  
		$this->Cell(23,6,'Bill No',1,0,'L',0);
		$this->Cell(23,6,'Bill Date',1,0,'L',0);
		$this->Cell(37,6,'Customer Name',1,0,'L',0);
		$this->Cell(25,6,'Total Bill Amt',1,0,'L',0);
		$this->Cell(20,6,'CGST Amt.',1,0,'L',0);
		$this->Cell(20,6,'SGST Amt.',1,0,'L',0);
		$this->Cell(20,6,'IGST Amt.',1,0,'L',0);
		$this->Cell(22,6,'Total Tax Amt',1,1,'L',0);
		$this->SetX(5);
		$this->SetWidths(array(10,23,23,37,25,20,20,20,22));
		$this->SetAligns(array('C','L','L','L','R','R','R','R','R')); 
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
$pdf->SetTitle($title1);
$title2 = "Sale Details";
$pdf->SetTitle($title2);
$pdf->AliasNbPages();
$pdf->AddPage('P','A4');
$slno=1;
$nettotal=0;
$netcgst=0;
$netsgst=0;
$netigst=0;
$nettaxamt =0;
$sql_get = mysqli_query($connection,"Select * from saleentry $crit order by saledate Asc");
while($row_get = mysqli_fetch_assoc($sql_get))
{
	
		$billamount=0;
		$total=0;
		$suppartyid = $row_get['suppartyid'];
		$total = $cmn->getTotalBillAmt($row_get['saleid']);
		$disc = $row_get['disc'];
		$sgst=$cmn->getbillwisegstsale("sgst",$row_get['saleid']);
		$cgst=$cmn->getbillwisegstsale("cgst",$row_get['saleid']);
		$igst=$cmn->getbillwisegstsale("igst",$row_get['saleid']);
		$billamount=$total-$disc+$sgst+$cgst+$igst;
			$supparty_name = $cmn->getvalfield($connection,"m_supplier_party","supparty_name","suppartyid='$suppartyid'");
			
			$pdf->SetX(5);	
			$pdf->SetFont('Arial','',8);
			$pdf->SetTextColor(0,0,0);
		$pdf->Row(array($slno++,$row_get['billno'],$cmn->dateformatindia($row_get['saledate']),$supparty_name,number_format($billamount,2),number_format($cgst,2),number_format($sgst,2),number_format($igst,2),number_format($cgst+$sgst+$igst,2)));
		
		$nettotal +=$billamount;
		$netcgst +=$cgst;
		$netsgst +=$sgst;
		$netigst +=$igst;
		$nettaxamt +=$cgst+$sgst+$igst;
	  }
	 $pdf->SetX(5);
	 $pdf->SetFont('Arial','B',9);
	 $pdf->Cell(93,6,'Total','1',0,'R',0);
	  $pdf->Cell(25,6,number_format($nettotal,2),'1',0,'R',0);
	  $pdf->Cell(20,6,number_format($netcgst,2),'1',0,'R',0);
	  $pdf->Cell(20,6,number_format($netsgst,2),'1',0,'R',0);
	  $pdf->Cell(20,6,number_format($netigst,2),'1',0,'R',0);
	  $pdf->Cell(22,6,number_format($nettaxamt,2),'1',1,'R',0);
	 
$pdf->Output();
?>                         	
<?php
mysql_close($db_link);
?>