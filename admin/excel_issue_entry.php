<?php include("../adminsession.php");
$tblname = "saleentry";
$tblpkey = "saleid";

 header("Content-type: application/vnd-ms-excel");
$filename = "excel_product_master".strtotime("now").'.xls';
// Defines the name of the export file "codelution-export.xls"
header("Content-Disposition: attachment; filename=".$filename);

?>


<table class="table table-bordered" id="dyntable">
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
                        	<th width="7%" class="head0 nosort">S.No.</th>
                            <th width="16%" class="head0" >Issue No</th>
                            <th width="11%" class="head0">Issue Date</th>
                            <th width="11%" class="head0" >Tot Item</th>
                             <th width="16%" class="head0" >Branch Name</th>
                            <th width="16%" class="head0" >Receiver Name</th>
                            <th width="16%" class="head0">Remark </th>
                            <th class="head0" >Challan </th>                                                      
                                                      
                        </tr>
                    </thead>
                    <tbody id="record">
                           </span>
                                <?php
									$slno=1;									
									$sql_get = mysqli_query($connection,"Select * from saleentry  order by saledate desc,saleid desc");
									while($row_get = mysqli_fetch_assoc($sql_get))
									{
										$saleid =$row_get['saleid'];	
										$branch_id =$row_get['branch_id'];										
										$disc =$row_get['disc'];
										$branch_name = $cmn->getvalfield($connection,"m_branch","branch_name","branch_id='$branch_id'");										
										$billtype = $row_get['billtype'];
										
										 
										
									   ?> <tr>
                                                <td><?php echo $slno++; ?></td> 
                                                 <td><?php echo $row_get['billno']; ?></td>
                                                 <td><?php echo $cmn->dateformatindia($row_get['saledate']); ?></td>                                                 <td><?php echo $cmn->getvalfield($connection,"saleentry_detail","count(*)","saleid='$saleid'") ?></td>
                                                  <td><?php echo $branch_name; ?></td>
                                                  <td><?php echo $row_get['receivername']; ?></td>
                                                  <td><?php echo $row_get['remark']; ?></td>
                                                  
                                                  
                                                    <td>  
											
												<a class="btn btn-primary btn-sm" href="pdf_sale_chalana5.php?saleid=<?php echo  $row_get['saleid']; ?>" target="_blank" >Print</a>
                                                   </td>
                                                                                                             
                                                   
                                                  
                                                 
                                          </tr>
                        <?php
						}
						?>
                        
                       
                    </tbody>
                </table>