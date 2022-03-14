<?php
include("../adminsession.php");
$outentry_no = trim(addslashes($_REQUEST['outentry_no']));
$shop_id = trim(addslashes($_REQUEST['shop_id']));

$sqlget=mysqli_query($connection,"select * from out_entry_details where shop_id='$shop_id' && outentry_id=0 ");
$sn=1;

$shop_id_name= $cmn->getvalfield($connection,"m_shop","shop_id","1=1 limit 0,1");

?>



<table class="table table-bordered">
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
				
				$outentrydetail_id=$rowget['outentrydetail_id'];
				$productid=$rowget['productid'];
				$unitid=$rowget['unitid'];
				$qty=$rowget['qty'];
				
				$prodname=$cmn->getvalfield($connection,"m_product","prodname","productid='$productid'");
				$unit_name=$cmn->getvalfield($connection,"m_unit","unit_name","unitid='$unitid'");
				
										?>
                                            <tr>
                                            	<td><?php echo $sn; ?></td>
                                                <td><?php echo $prodname; ?></td>
                                                <td><?php echo $unit_name; ?></td>
                                                <td><?php echo $qty;  ?></td>
                                                <td class="center"><a class="btn btn-danger btn-small" onClick="deleterecord('<?php echo $outentrydetail_id; ?>');"> X </a></td>
                                            </tr>
                                            
             <?php
			 $total += $amount;
$sn++;
}

?>    
 <tr>
 
               <td colspan="7" align="right" style="text-align:right;"> <!--<h3> <strong>Bill Amount : <span  style="color:#00F;" > <?php// echo number_format($total,2); ?> </span></strong> </h3>--> </td>
               </tr>
                                         
      <tr>
      <td colspan="7"><p align="center"> <input type="submit" class="btn btn-danger" value="Save" name="submit" >  &nbsp; &nbsp; 
      <input type="hidden" name="outentry_no" value="<?php echo $outentry_no; ?>"  />
      <a href="out-entry.php?shop_id=<?php echo $shop_id_name; ?>" class="btn btn-primary" > Reset </a>
      
       </p>  </td>
      </tr>                                      
               
                                           
                                        </tbody>
                                    </table>
