<?php 
session_start();
error_reporting(0);
		include("conn.php");	
		include_once("lib/dboperation.php");
		include_once("lib/getval.php");
		$cmn = new Comman();
		$ipaddress = $cmn->get_client_ip();
		//$userid = $_SESSION['userid'];
	//	$loginid = $_SESSION['loginid'];
			$haspid = $_SESSION['haspid'];
		$usertype = $_SESSION['usertype'];		
		//$websiteid = $_SESSION['websiteid'] ;
		$createdate = date('Y-m-d');	
 include("fpdf17/fpdf.php");
 $opd_id=$_GET['id'];
//echo "select * from hos_setting where id='$haspid'";
 $sql = mysqli_query($conn,"select * from hos_setting where id='$haspid'");
   $rowedit = mysqli_fetch_array($sql);
   //print_r($rowedit);
     $hos_name = $rowedit['hos_name'];
     $address = $rowedit['address'];
	 $website = $rowedit['website'];
     $email = $rowedit['email'];
     $contact = $rowedit['contact'];

 //$visit_type = $rowedit['visit_type'];

class PDF_MC_Table extends FPDF
{
  var $widths;
  var $aligns;
    function Header()
    { 
	global $hos_name,$address,$website,$email,$contact;
	
	   $this->SetXY(2,2);
       $this->SetFont('Times','B',12);
       
       //global $title1,$title2;
    //    $this->SetXY(25,10);
    //    $this->SetFont('Times','B',24);
    //    $this->Cell(150, 7,$hos_name,'','','C');
    //   // $this->Image('img/logo/logo.png',10,05,30,10);
    //    $this->SetXY(44,19);
    //    $this->SetFont('Arial','B',12);
    //    $this->Cell(100, 7,$address,'','','L');
       $this->SetXY(112,123);
       $this->SetFont('Arial','B',11);
       $this->Cell(180, 7,'OPD PRESCRIPTION ','','','L');
	   
	//    $this->SetXY(160,9);
    //    $this->SetFont('Times','B',11);
    //    $this->Cell(100, 7,'Phone  : ','','','L');
	//    $this->SetXY(175,9);
    //    $this->SetFont('Times','',11);
    //    $this->Cell(100, 7,$contact,'','','L');
    //    $this->SetXY(160,14);
    //    $this->SetFont('Times','B',11);
    //    $this->Cell(180, 7,'E-mail  : ','','','L');
	//    $this->SetXY(175,14);
    //    $this->SetFont('Times','',11);
    //    $this->Cell(100, 7,$email,'','','L');
    //    $this->SetXY(160,19);
    //    $this->SetFont('Times','B',11);
    //    $this->Cell(180,7,'Website: ','','','L');
	//    $this->SetXY(175,19);
    //    $this->SetFont('Times','',11);
    //    $this->Cell(100, 7,$website,'','','L');
	      
    //    $this->ln(8);
	//    $this->SetXY(2,35);
	// 	$this->SetFont('Times','BU',10);
	// 	$this->Cell(206,0,'','B','L');
	// 	$this->ln();
	// 	$this->Cell(0,0,'','B','L');
	// 	$this->ln();
	// 	$this->Cell(0,0,'','B','L');
		// $this->ln(8);
	    // $this->SetXY(2,105);
		// $this->SetFont('Times','BU',10);
		// $this->Cell(206,0,'','BU','L');
		// $this->ln();
		// $this->Cell(0,0,'','BU','L');
		// $this->ln();
		// $this->Cell(0,0,'','BU','L');
       // $this->Ln(10);
        // 	$this->Rect(2,105,60,187);
        //     $this->SetFont('courier','b',9);
        //    $this->Rect(5, 5, 200, 80, 'D'); //For A4
        //    $this->SetXY(82,106);
		// $this->SetFont('Times','B',10);
        // $this->Cell(108,6,'Rx','0','1','L');

        $this->SetXY(4,130);
		$this->SetFont('Times','B',10);
        $this->Cell(108,6,'PULSE - ','0','1','L');
        $this->SetXY(4,140);
		$this->SetFont('Times','B',10);
        $this->Cell(108,6,'BP -','0','1','L');
        
         $this->SetXY(4,150);
		$this->SetFont('Times','B',10);
        $this->Cell(108,6,'WEIGHT -','0','1','L');
        
         $this->SetXY(4,160);
		$this->SetFont('Times','B',10);
        $this->Cell(108,6,'SPO2 -','0','1','L');



        
    }
    function Footer()
    { 
        // $this->SetY(-7);
        // $this->SetFont('Arial','I',7);
        // $this->Cell(0,10,'|| Software Developed By Chaaruvi Infotech, +91 8871181890 ||',0,0,'C');
     }

}
$pdf=new PDF_MC_Table();
$pdf->SetTitle("OPD PRESCRIPTION");
$pdf->AliasNbPages();
$pdf->AddPage('P','A4');
  
//echo "select * from doc_master where doc_id='$opd_id'";die;
 //echo "select * from depart_master where depart_id='$opd_id'" ;die;

  $get_accsess = mysqli_query($conn,"select * from opd where opd_id='$opd_id'");	
while($done = mysqli_fetch_assoc($get_accsess))
{    


 $sqlpat=mysqli_query($conn,"select * from depart_master where depart_id='$opd_id'");
$dep=mysqli_fetch_array($sqlpat);
  
  
 

                $set_first = $done['set_first'];
                $patient=$done['patient'];
				$gender=$done['gender'];
				$contact=$done['contact'];
				$email=$done['email'];
				$parents=$done['parents'];
				$age=$done['age'];
	            $address=$done['address'];
				$repote=$done['repote'];
				$doctor=$done['doctor'];
	             $department=$done['department'];
				$payamount=$done['payamount'];
				 $visit_type=$done['visit_type'];
				$apointmentid=$done['apointmentid'];
			    $currentdate = date("d-m-Y");
			   $department_name = $cmn->getvalfield($conn,"depart_master","department_name","depart_id='$department'");

               $doc_name = $cmn->getvalfield($conn,"doc_master","doc_name","doc_id='$doctor'");
 }
 
       $pdf->SetXY(70,130);
       $pdf->SetFont('Times','B',10);
       $pdf->Cell(100, 7,'Department    :','','','L');
	   $pdf->SetXY(95,130);
       $pdf->SetFont('Times','',10);
       $pdf->Cell(100, 7,ucwords($department_name),'','','L');
       $pdf->SetXY(150,130);
       $pdf->SetFont('Times','B',10);
       $pdf->Cell(180, 7,'Apointment Date  :','','','L');
	   $pdf->SetXY(180,130);
       $pdf->SetFont('Times','',10);
       $pdf->Cell(180, 7,$currentdate,'','','L');//$currentdate = date("m-d-Y");
       $pdf->SetXY(70,137);
       $pdf->SetFont('Times','B',10);
       $pdf->Cell(180, 7,'OPD.No.         :','','','L');
	   $pdf->SetXY(98,137);
       $pdf->SetFont('Times','',10);
       $pdf->Cell(180, 7,$apointmentid,'','','L');
	   $pdf->SetXY(150,137);
       $pdf->SetFont('Times','B',10);
       $pdf->Cell(180, 7,'Paid Amount         :','','','L');
	   $pdf->SetXY(180,137);
       $pdf->SetFont('Times','',10);
       $pdf->Cell(180, 7,$payamount." Rs",'','','L');

	   $pdf->SetXY(70,144);
       $pdf->SetFont('Times','B',10);
       $pdf->Cell(100, 7,'Patient Name :','','','L');
	   $pdf->SetXY(95,144);
       $pdf->SetFont('Times','',10);
       $pdf->Cell(180, 7,ucfirst($set_first),'','','L');
       $pdf->SetXY(103,144);
       $pdf->SetFont('Times','',10);
       $pdf->Cell(180, 7,ucfirst($patient),'','','L');
       $pdf->SetXY(150,144);
       $pdf->SetFont('Times','B',10);
       $pdf->Cell(150, 7,'S/D/W/H/F/C         :','','','L');
	   $pdf->SetXY(181,144);
       $pdf->SetFont('Times','',10);
       $pdf->Cell(180, 7,ucfirst($parents),'','','L');

	   $pdf->SetXY(70,151);
       $pdf->SetFont('Times','B',10);
       $pdf->Cell(180, 7,'Age                  :','','','L');
	   $pdf->SetXY(98,151);
       $pdf->SetFont('Times','',10);
       $pdf->Cell(180, 7,$age,'','','L');
	   $pdf->SetXY(150,151);
       $pdf->SetFont('Times','B',10);
       $pdf->Cell(180, 7,'Gender                   :','','','L');
	   $pdf->SetXY(181,151);
       $pdf->SetFont('Times','',10);
       $pdf->Cell(180, 7,ucwords($gender),'','','L');
	   $pdf->SetXY(70,158);
       $pdf->SetFont('Times','B',10);
       $pdf->Cell(180, 7,'Mobile No.      :','','','L');
	   $pdf->SetXY(98,158);
       $pdf->SetFont('Times','',10);
       $pdf->Cell(180, 7,$contact,'','','L');
       $pdf->SetXY(150,158);
       $pdf->SetFont('Times','B',10);
       $pdf->Cell(180, 7,'Reporting Time     :','','','L');
	   $pdf->SetXY(181,158);
       $pdf->SetFont('Times','',10);
       $pdf->Cell(180, 7,$repote	,'','','L');
       $pdf->SetXY(70,165);
       $pdf->SetFont('Times','B',10);
       $pdf->Cell(180, 7,'Address           :','','','L');
	   $pdf->SetXY(98,165);
       $pdf->SetFont('Times','',10);
       $pdf->Cell(180, 7,ucwords($address),'','','L');
       $pdf->SetXY(150,165);
       $pdf->SetFont('Times','B',10);
       $pdf->Cell(180, 7,'OPD Type              :','','','L');
       $pdf->SetXY(182,165); 
       $pdf->SetFont('Times','',10);
       $pdf->Cell(180, 7,$visit_type,'','','L');


       $pdf->SetXY(70,172);
       $pdf->SetFont('Times','B',10);
       $pdf->Cell(180, 7,'Doctor             :','','','L');
	   $pdf->SetXY(98,172);
       $pdf->SetFont('Times','',10);
       $pdf->Cell(180, 7,ucwords($doc_name),'','','L');
//        
//        
//   
	 
      // $pdf->Image('img/anandlogo.png',160,5,'25','25');
    //    $pdf->Image('img/cgc-logo.png',4,4,'35','30'); 


$pdf->Output();

//exit;
//==============================================================
?>

 