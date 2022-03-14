<?php error_reporting(0);                                                                                                   include("../adminsession.php");
$saleid=trim(addslashes($_REQUEST['saleid']));
$paidamount=0;

	if($saleid !='')
	{
		
		$paidamount=$cmn->getvalfield($connection,"payment","sum(payamt)","saleid='$saleid'");
		$receiptno=$cmn->getrec("payment","payid","pay_mode='received'");
		
				$disc =$cmn->getvalfield($connection,"saleentry","disc","saleid='$saleid'");		
				$total = $cmn->getTotalBillAmt($saleid);
				$igst = $cmn->getTotalIgst_Sale($saleid);
				$gst = $cmn->getTotalGst($saleid);
				$total = $total - $disc;				
				$total_bill_amt=round($total+$gst+$igst);	
		
		
	  			
	}
	
	if($paidamount=='')
	{
	$paidamount=0;
	}
	
	
	
	
	
	
	
	echo $paidamount.' | '.$receiptno;
?>