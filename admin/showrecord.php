<?php
include("../adminsession.php");
$inentryno = trim(addslashes($_REQUEST['inentryno']));


$sqlget=mysqli_query($connection,"select * from in_entry_details where inentry_no='$inentryno' && inentry_id=0");
$sn=1;

?>



<table class="table table-bordered table-condensed">
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
				
				$inentrydetail_id=$rowget['inentrydetail_id'];
				$productid=$rowget['productid'];
				$unitid=$rowget['unitid'];
				$qty=$rowget['qty'];
				
				$prodname=$cmn->getvalfield($connection,"m_product","prodname","productid='$productid'");
			  $unit_name = $cmn->getvalfield($connection,"m_unit","unit_name","unitid='$unitid'");
				
										?>
                                            <tr>
                                            	<td><?php echo $sn; ?></td>
                                                <td><?php echo $prodname; ?></td>
                                                <td><?php echo $unit_name; ?></td>
                                                <td><?php echo $qty;  ?></td>
                                                <td class="center"><a class="btn btn-danger btn-small" onClick="deleterecord('<?php echo $inentrydetail_id; ?>');"> X </a></td>
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
      <input type="hidden" name="inentry_no" value="<?php echo $inentryno; ?>"  />
      <a href="in-entry.php" class="btn btn-primary" > Reset </a>
      
       </p>  </td>
      </tr>                                      
               
                                           
                                        </tbody>
                                    </table>
