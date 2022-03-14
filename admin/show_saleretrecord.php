<?php
include("../adminsession.php");

 $pretentry_id=trim(addslashes($_REQUEST['pretentry_id'])); 
 
if($pretentry_id =='')
{
	$pretentry_id=0;	
}
else
{
	$pretentry_id=$pretentry_id;
}
//echo "select * from pur_return where pretentry_id='$pretentry_id'";
$sqlget=mysqli_query($connection,"select * from pur_return where pretentry_id='$pretentry_id'");
$sn=1;
$amount=0;
?>
<table class="table table-bordered table-condensed">
                                        <thead>
                                            <tr>
                                                <th>Sl.No</th>
                                                <th>Product Name</th>
                                                <th>Unit</th>
                                                 
                                                 <th>Return Qty.</th>
                                                <th class="center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                        <?php
									
			while($rowget=mysqli_fetch_assoc($sqlget))
			{
				
				
				$pret_id=$rowget['pret_id'];
				$productid=$rowget['productid'];
				$unitid=$cmn->getvalfield($connection,"m_product","unitid","productid='$productid'");
				$qty=$rowget['ret_qty'];
				
				$prodname=$cmn->getvalfield($connection,"m_product","prodname","productid='$productid'");
			  $unit_name = $cmn->getvalfield($connection,"m_unit","unit_name","unitid='$unitid'");
				
										?>
                                            <tr>
                                            	<td><?php echo $sn; ?></td>
                                                <td><?php echo $prodname; ?></td>
                                                <td><?php echo $unit_name; ?></td>
                                                
                                                <td><?php echo $qty;  ?></td>
                                               
                                                <td class="center"><a class="btn btn-danger btn-small" onClick="deleterecord('<?php echo $pret_id; ?>');"> X </a></td>
                                            </tr>
                                            
             <?php
			
$sn++;
}

?>    
 <tr>
 
              
               </tr>
                                         
      <tr>
     
      <input type="hidden" name="pret_id" value="<?php echo $pret_id; ?>"  />
     
        </td>
      </tr>                                      
               
                                           
                                        </tbody>
                                    </table>
