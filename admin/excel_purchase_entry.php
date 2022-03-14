<?php include("../adminsession.php");
$tblname = "purchaseentry";
$tblpkey = "purchaseid";

 header("Content-type: application/vnd-ms-excel");
$filename = "excel_product_master".strtotime("now").'.xls';
// Defines the name of the export file "codelution-export.xls"
header("Content-Disposition: attachment; filename=".$filename);

?>

<table class="table table-bordered" id="dyntable" border="1">
                    <colgroup>
                        <col class="con0" style="align: center; width: 4%" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                        <col class="con0" />
                        <col class="con1" />
                    </colgroup>
                    <thead>
                        <tr>
                            <th width="5%" class="head0 nosort">S.No.</th>
                            <th width="8%" class="head0" >Purchase No</th>
                            <th width="10%" class="head0">Purchase Date</th>
                            <th width="13%" class="head0">Purchase Type</th>
                            <th width="9%" class="head0">Bill Type</th>
                            <th width="6%" class="head0" >Amount</th>
                            <th width="13%" class="head0" >Customer Name</th>
                            
                                                      
                        </tr>
                    </thead>
                    <tbody id="record">
                           </span>
                                <?php
									$slno=1;
									
									$sql_get = mysqli_query($connection,"Select * from purchaseentry order by purchasedate desc,purchaseid desc");
									while($row_get = mysqli_fetch_assoc($sql_get))
									{
										$total=0;
										$gst=0;
										$suppartyid = $row_get['suppartyid'];
										$disc =$row_get['disc'];
										$packing_charge =$row_get['packing_charge'];
										$freight_charge =$row_get['freight_charge'];
										$freight_tax=0;
										
										$supparty_name = $cmn->getvalfield($connection,"m_supplier_party","supparty_name","suppartyid='$suppartyid'");
										
										$total = $cmn->getTotalPerchaseBillAmt($connection,$row_get['purchaseid']);	
										
										
										
										$gst = $cmn->getTotalGst_pur($connection,$row_get['purchaseid']);
										$total = $total - $disc+$packing_charge+$freight_charge;
										$billtype = $row_get['billtype'];
										
										if($billtype=="withouttax")
										{
											$billname="Invoice";
										}
										else
										{
											$billname="Challan";
										}
										
									   ?> <tr>
                                                <td><?php echo $slno++; ?></td> 
                                                 <td><?php echo $row_get['billno']; ?></td>
                                                <td><?php echo $cmn->dateformatindia($row_get['purchasedate']); ?></td>
                                                
                                                <td><?php echo $row_get['purchase_type']; ?></td>
                                                <td><?php echo $billname; ?></td>
                                                                                               
                                                 <td><?php echo number_format(round($total+$gst+$freight_tax),2); ?></td>
                                                  <td><?php echo $supparty_name; ?></td>
                                                  
                                                   
                                                 
                                                                         					</tr>
                        <?php
						}
						?>
                        
                       
                    </tbody>
                </table>