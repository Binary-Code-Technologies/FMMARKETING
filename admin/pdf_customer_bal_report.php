<?php
include("../adminsession.php");
require("../fpdf182/fpdf.php");
$suppartyid = $_GET['suppartyid'];
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

$fromdate = $cmn->dateformatindia($fromdate);
$todate  = $cmn->dateformatindia($todate); 
$comp_name =  $cmn->getvalfield($connection,"company_setting","comp_name","1 = 1");
class PDF_MC_Table extends FPDF
{
  var $widths;
  var $aligns;

	function Header()
	{
		global $title1,$title2;
		 // courier 25
		 
		 $this->Rect(5, 5,200,287, 'D');
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
		$this->SetFont('courier','b',12);
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
		//$this->Cell(200,0,'',T,0,0,'C');
	     $this->Ln(2);
		
		$this->Cell(-1);
		$this->SetFont('courier','b',8);
		//$this->Cell(95,5,"".$collect_from,0,0,'L');
		$this->Cell(192,5,"Date : ".date('d-m-Y'),0,1,'R');
		 $this->Ln(1); 
		 
		 $this->SetX(5);
		 $this->SetFont('Arial','B',9);
		 $this->Cell(10,6,' S.No','1',0,'L',0);  
		 $this->Cell(50,6,'Customer Name',1,0,'L',0);
		 $this->Cell(40,6,'Mobile No',1,0,'L',0);
		 $this->Cell(65,6,'Address',1,0,'L',0);
		 $this->Cell(35,6,'Balance Amount',1,1,'L',0);
		 $this->SetWidths(array(10,50,40,65,35));
		 $this->SetAligns(array('L','L','L','L','R'));
		 
		 $this->SetX(5);

		 
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
	//	$this->MultiCell(200,5,'|| Developed By Trinity Solutions Raipur, Contact us- +91-9770131555,+91-8871181890,Visit us- www.trinitysolutions.in ||',0,'C');
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
$title1 = $cmn->getvalfield($connection,"company_setting","comp_name","1 = 1");
$pdf->SetTitle($title1);
$title2 = "Customer Balance Amount";
$pdf->SetTitle($title2);
$pdf->AliasNbPages();
$pdf->AddPage('P','A4');
$slno = 1;
$nettotal =0;
  $cond=" where 1=1";
                                        if($suppartyid!='') 
                                        {
                                        $cond .=" and suppartyid='$suppartyid'"; 
                                        }
$sql_get = mysqli_query($connection,"select * from m_supplier_party $cond and type_supparty='party'  order by suppartyid desc");
	while($row_get = mysqli_fetch_assoc($sql_get))
	{
        $supparty_name =$row_get['supparty_name'];
        $mobile =$row_get['mobile'];
        $address =$row_get['address'];
        $prevbalance =$row_get['prevbalance'];
        $suppartyid =$row_get['suppartyid'];
        
        $saleamt = $cmn->getvalfield($connection,"saleentry","sum(totalsale)","suppartyid='$suppartyid'");
                    
                            $payamt = $cmn->getvalfield($connection,"payment","sum(payamt)","suppartyid='$suppartyid'");

                            $balamt = $prevbalance + $saleamt - $payamt;
                            if($balamt!=0){
		
		$pdf->SetX(5);	
		$pdf->SetFont('Arial','',8);
		$pdf->SetTextColor(0,0,0);
		$pdf->Row(array($slno++,$supparty_name,$mobile,$address,number_format(round($balamt),2)));
		$nettotal +=$balamt;
    }}
	
	 $pdf->SetX(5);
		 $pdf->SetFont('Arial','B',9);
		 $pdf->Cell(165,6,'Total','1',0,'R',0);  
		 $pdf->Cell(35,6,number_format($nettotal,2),1,0,'R',0);
		 
   
$pdf->Output();
?> 
                          	
<?php
mysql_close($db_link);
?>