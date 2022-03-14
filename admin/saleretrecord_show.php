<?php
include("../adminsession.php");
 $saleid=trim(addslashes($_REQUEST['saleid'])); 
$sqlget=mysqli_query($connection,"select * from salereturn where saleid='$saleid'");
$sn=1;
$amount=0;
?>
<table  class="table table-bordered table-condensed">
                                        <thead>
                                            <tr>
                                                <th>Sl.No</th>
                                                <th>Product Name</th>
                                                <th>Unit</th>
                                                <th>Qty.</th>
                                                <th class="center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                        <?php
									
			while($rowget=mysqli_fetch_assoc($sqlget))
			{
				
				
				$sale_returnid=$rowget['sale_returnid'];
				$saleid=$rowget['saleid'];
				$unitid=$cmn->getvalfield($connection,"m_product","unitid","productid='$productid'");
				$qty=$rowget['ret_qty'];
				$productid =$rowget['productid'];
				$prodname=$cmn->getvalfield($connection,"m_product","prodname","productid='$productid'");
			  $unit_name = $cmn->getvalfield($connection,"m_unit","unit_name","unitid='$unitid'");
				
										?>
                                            <tr>
                                            	<td><?php echo $sn; ?></td>
                                                <td><?php echo $prodname; ?></td>
                                                <td><?php echo $unit_name; ?></td>
                                                <td><?php echo $qty;  ?></td>
                                               
                                                <td class="center"><a class="btn btn-danger btn-small" onClick="deleterecord('<?php echo $sale_returnid; ?>');"> X </a></td>
                                            </tr>
                                            
             <?php
			
$sn++;
}

?>    
 <tr>
 
               </tr>
                                         
      <tr>
     
      <input type="hidden" name="sale_returnid" value="<?php echo $sale_returnid; ?>"  />
    
      
       </p>  </td>
      </tr>                                      
               
                                           
                                        </tbody>
                                    </table>
