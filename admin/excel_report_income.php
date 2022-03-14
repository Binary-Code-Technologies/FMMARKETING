<?php include("../adminsession.php");
$tblname = "other_income";
$tblpkey = "incomid";

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
                        	
                          	<th class="head0 nosort">S.No.</th>
                            <th class="head0">Income Name</th>
                            <th class="head0">Income Date</th>
                            <th class="head0">Amount</th>
                         </tr>
                    </thead>
                    <tbody>
                           </span>
                               <?php
									$slno=1;
									$sql_get = mysqli_query($connection,"select * from other_income where 1=1 order by incom_date desc,incomid desc");
									while($row_get = mysqli_fetch_assoc($sql_get))
									{
										$expen_name=$cmn->getvalfield($connection,"master_expence","expense_name","expencetypeid='$row_get[expencetypeid]'");
									   ?> <tr>
                                               <td><?php echo $slno++; ?></td> 
                                               <td><?php echo $expen_name; ?></td> 
                                               <td><?php echo $cmn->dateformatindia($row_get['incom_date']); ?></td>
                                               <td><?php echo $row_get['amount']; ?></td>
                                           </tr>
                    
										<?php
                                        }
                                        ?>
                        
                        
                              </tbody>
                   </table>