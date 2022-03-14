<?php include("../adminsession.php");
require("../fpdf182/fpdf.php");
$crit = " where 1 = 1 ";
set_time_limit(0);
if($_GET['todate']!="" && $_GET['todate']!="")
{
	
	$todate = addslashes(trim($_GET['todate']));
	$fromdate= addslashes(trim($_GET['fromdate']));
}
else
{
	$todate = date('Y-m-d');
	$fromdate= date('Y-m-d');	
}

if($_GET['pcatid']!="")
{
	$pcatid= addslashes(trim($_GET['pcatid']));
	$crit.=" and pcatid='$pcatid'";
}
else
{
	$pcatid='';	
}

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
		$this->Cell(200,0,'','',0,0,'C');
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
	
	function SetAligns($a)
	{
		//Set the array of column alignments
		$this->aligns=$a;
	}
function SetWidths($w)
	{
		//Set the array of column widths
		$this->widths=$w;
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
$pdf->SetX(5);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(10,6,' Sno','1',0,'L',0);  
$pdf->Cell(40,6,'Product',1,0,'L',0);
$pdf->Cell(30,6,'Categary',1,0,'L',0);
$pdf->Cell(20,6,'Open. Bal.',1,0,'R',0);
$pdf->Cell(20,6,'Purchased.',1,0,'R',0);
$pdf->Cell(20,6,'Purchase Ret',1,0,'R',0);
$pdf->Cell(20,6,'Sold',1,0,'R',0);
$pdf->Cell(20,6,'Sale Ret',1,0,'R',0);
$pdf->Cell(20,6,'Stock',1,1,'R',0);




$pdf->SetX(5);
$pdf->SetWidths(array(10,40,30,20,20,20,20,20,20));
$pdf->SetAligns(array('L','L','L','R','R','R','R','R','R'));
$pdf->SetFont('Arial','',6);

$slno=1;


									
						$slno=1;									
						$sql_get = mysqli_query($connection,"Select * from m_product $crit order by prodname asc"); 
									while($row_get = mysqli_fetch_assoc($sql_get))
									{
										$stock=0;
									$productid =  $row_get['productid'];
									$pcatid =  $row_get['pcatid'];
									 $opening_stock = $cmn->getstock($connection,$productid,$fromdate);
									$catname=$cmn->getvalfield($connection,"m_product_category","catname","pcatid='$pcatid'");									
									
									 $pcond=" where  1=1 ";
									 $scond=" where 1=1 ";									 
									$pret =" and 1=1 ";
									$sret =" and 1=1 ";
									 
								if($todate !='' && $fromdate !='')
								{
								$pcond .=" and purchasedate between '$fromdate' and '$todate' ";
								$scond .=" and saledate between '$fromdate' and '$todate' ";
								$pret .=" and ret_date between '$fromdate' and '$todate' ";
								$sret .=" and sale_retdate between '$fromdate' and '$todate' ";
								
								}
					$pur = 0;											 
						$sql_p = mysqli_query($connection,"select purchaseid from purchaseentry $pcond"); 
						while($row_p = mysqli_fetch_assoc($sql_p))
						{
						$pur += $cmn->getvalfield($connection,"purchasentry_detail","sum(qty)","productid='$productid' and purchaseid='$row_p[purchaseid]'");//purchase
						}
						
						 $pur_ret = 0;						 
					 $pur_ret += $cmn->getvalfield($connection,"pur_return","sum(ret_qty)","productid='$productid' $pret");//purchase
					
						
						 $sold = 0;																
						$sql_s = mysqli_query($connection,"select saleid from saleentry $scond");
						while($row_s = mysqli_fetch_assoc($sql_s))
						{
						$sold += $cmn->getvalfield($connection,"saleentry_detail","sum(qty)","productid='$productid' and saleid='$row_s[saleid]'");//purchase
						}
						
						
						$saleret=0;						
					 $saleret += $cmn->getvalfield($connection,"salereturn","sum(ret_qty)","productid='$productid' $sret");
					 
					 if($saleret=='')
					 {
						$saleret=0; 
					 }
					 else
					 {
						$saleret=$saleret; 
					 }
					 
					  if($pur_ret=='')
					 {
						$pur_ret=0; 
					 }
					 else
					 {
						$pur_ret=$pur_ret; 
					 }
							
							$stock=$opening_stock+$pur - $sold-$pur_ret+$saleret;
									  											
	$pdf->SetX(5);	
	$pdf->SetFont('Arial','',8);
	$pdf->SetTextColor(0,0,0);
		$pdf->Row(array($slno++,$row_get['prodname'],$catname,round($opening_stock,2),$pur,$pur_ret,$sold,$saleret,round($stock,2)));
	
	        }



$pdf->Output();
?> 
                          	
<?php
mysql_close($db_link);
?>