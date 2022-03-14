<?php error_reporting(0);                                                                                                   include("../adminsession.php");
require("../fpdf182/fpdf.php");
$pagename = "other_expense_report.php";
$module = "Master";
$submodule = "Other Expense Report";
$btn_name = "Save";
$keyvalue =0 ;
$tblname = "other_expense";
$tblpkey = "expenid";
class PDF_MC_Table extends FPDF
{
  var $widths;
  var $aligns;

	function Header()
	{
		global $title1,$title2;
		
		$this->Rect(5,5,200,287);
	    $this->SetFont('courier','b',15);
		$this->Line(5,20,205,20);
		 // courier 25
		$this->SetFont('courier','b',20);
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
		$this->Ln(5);
		
		$this->Cell(-1);
		$this->SetFont('courier','b',8);
		//$this->Cell(95,5,"".$collect_from,0,0,'L');
		$this->Cell(192,5,"Date : ".date('d-m-Y'),0,1,'R');
		 $this->Ln(1);
		 
		 $this->SetX(5);
		 $this->SetFont('Arial','B',9);
		 $this->Cell(10,6,'S.No','LTR',0,'L',0);  
		 $this->Cell(90,6,'Expense Name',1,0,'L',0);
		 $this->Cell(60,6,'Expense Date',1,0,'L',0);
		 $this->Cell(40,6,'Amount',1,1,'R',0);
		 $this->SetX(5);
		 $this->SetWidths(array(10,90,60,40));
		 $this->SetAligns(array('L','L','L','R'));
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
$title2 = "Expense Details";
$pdf->SetTitle($title2);
$pdf->AliasNbPages();
$pdf->AddPage('P','A4');
$slno = 1; 	 
$sql_get = mysqli_query($connection,"select * from other_expense where 1=1 order by expen_date desc,expenid desc");
	while($row_get = mysqli_fetch_assoc($sql_get))
	{ 
	$expen_name=$cmn->getvalfield($connection,"master_expence","expense_name","expencetypeid='$row_get[expencetypeid]'");
		$pdf->SetX(5);	
		$pdf->SetFont('Arial','',8);
		$pdf->SetTextColor(0,0,0);
		$pdf->Row(array($slno++,$expen_name,$cmn->dateformatindia($row_get['expen_date']),$row_get['amount']));
	 }
$pdf->Output();
?> 
                          	
<?php
mysql_close($db_link);
?>