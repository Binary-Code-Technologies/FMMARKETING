<?php
include("../adminsession.php");
  $payamt= addslashes($_REQUEST['payamt']);
  $payment_type= addslashes($_REQUEST['payment_type']);
  $chequeno= trim(addslashes($_REQUEST['chequeno']));
  $refno= trim(addslashes($_REQUEST['refno']));
  $pay_mode=trim(addslashes($_REQUEST['pay_mode']));
  $paydate = $cmn->dateformatusa($_REQUEST['paydate']);

  $bank_name=trim(addslashes($_REQUEST['bank_name']));
  $receiptno=trim(addslashes($_REQUEST['receiptno']));

  $saleid=trim(addslashes($_REQUEST['saleid']));
  $suppartyid=trim(addslashes($_REQUEST['suppartyid']));
  
if($payamt !=''  &&  $payment_type !='' && $suppartyid !='' && $saleid!='')
{
	$form_data = array('payamt'=>$payamt,'payment_type'=>$payment_type,'chequeno'=>$chequeno,'refno'=>$refno,'pay_mode'=>$pay_mode,'paydate'=>$paydate,'bank_name'=>$bank_name,'receiptno'=>$receiptno,'bank_name'=>$bank_name,'saleid'=>$saleid,'suppartyid'=>$suppartyid,'createdate'=>$createdate,'createdby'=>$loginid);
  dbRowInsert($connection,'payment', $form_data);
					
}
?>