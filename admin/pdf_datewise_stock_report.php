<?php
include("../adminsession.php");
require("../fpdf182/fpdf.php");


if($_GET['todate']!="" && $_GET['todate']!="")
{
	
	$todate = addslashes(trim($_GET['todate']));
	$fromdate= addslashes(trim($_GET['fromdate']));
	
	
}
else
{
	$todate = date('Y-m-d');
	$fromdate=date('Y-m-d');
	
}





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
		$this->Cell(192,5,"Date : ".date('d-m-Y'),0,1,'R');
		 $this->Ln(1);
		 
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
$title2 = "DateWise Stock Report Details";
$pdf->SetTitle($title2);


$pdf->AliasNbPages();
$pdf->AddPage('P','A4');
$pdf->SetX(5);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(10,6,' Sno','1',0,'L',0);  
$pdf->Cell(50,6,'Categary',1,0,'L',0);
$pdf->Cell(25,6,'Unit',1,0,'L',0);
$pdf->Cell(25,6,'Open. Bal.',1,0,'L',0);
$pdf->Cell(25,6,'Purchase',1,0,'L',0);
$pdf->Cell(25,6,'Sold',1,0,'L',0);
$pdf->Cell(30,6,'Stock',1,1,'L',0);





$pdf->SetX(5);
$pdf->SetWidths(array(10,50,25,25,25,25,30));
$pdf->SetFont('Arial','',6);

$slno=1;
						$sql_get = mysqli_query($connection,"Select * from m_product_category order by catname asc");
						while($row_get=mysqli_fetch_assoc($sql_get))
								{
									$totalopenstock=0;
									$catname= $row_get['catname'];
									$pcatid= $row_get['pcatid'];
									$unitid= $row_get['unitid'];
									$unit_name=$cmn->getvalfield($connection,"m_unit","unit_name","unitid='$unitid'");									
									$totalopenstock=$cmn->getvalfield($connection,"m_product","sum(opening_stock)","pcatid='$pcatid'");
									
									
						$pur = 0;
												
						$sql_p = mysqli_query($connection,"SELECT A.*,pcatid	 FROM purchasentry_detail as A LEFT JOIN m_product as B ON A.productid = B.productid	 left join purchaseentry as C ON C.purchaseid = A.purchaseid WHERE pcatid ='$pcatid' and purchasedate between '$fromdate' and '$todate'");
						while($row_p = mysqli_fetch_assoc($sql_p))
						{
						$pur += $row_p['qty'];
						}
							
							
					$sold = 0;																
					$sql_s = mysqli_query($connection,"SELECT A.* FROM saleentry_detail as A LEFT JOIN m_product as B ON A.productid = B.productid 
										  LEFT JOIN saleentry as C ON C.saleid = A.saleid										 
										 WHERE pcatid ='$pcatid' and saledate between '$fromdate' and '$todate'");
					while($row_s = mysqli_fetch_assoc($sql_s))
					{
					$sold += $row_s['qty'];
					}
					$stock=$totalopenstock+$pur - $sold;
									  											
	$pdf->SetX(5);	
	$pdf->SetFont('Arial','',8);
	$pdf->SetTextColor(0,0,0);
	$pdf->Row(array($slno++,$catname,$unit_name,number_format($totalopenstock,2),number_format($pur,2),number_format($sold,2),number_format($stock,2)));
	
	        }



$pdf->Output();
?> 
                          	
<?php
mysql_close($db_link);
?>