<?php include("../adminsession.php");
$tblname = "m_product";
$tblpkey = "productid";

 header("Content-type: application/vnd-ms-excel");
$filename = "excel_product_master".strtotime("now").'.xls';
// Defines the name of the export file "codelution-export.xls"
header("Content-Disposition: attachment; filename=".$filename);

?>


<table width="98%" class="table table-bordered" id="dyntable" border="1">
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
                        <th width="6%"  class="head0 nosort">S.No.</th>
                        <th width="14%" class="head0">Product Code</th>
                        <th width="11%" class="head0">Unit</th>
                         <th width="14%" class="head0">Categary</th>
                        <th width="15%" class="head0">Product Name</th>
                         <th width="15%" class="head0">Opening Stock</th>
                        <th width="10%" class="head0">Rate</th>
                       
                        </tr>
                    </thead>
                    <tbody>
                           </span>
                               <?php
									$slno=1;
									$sql_get = mysqli_query($connection,"select * from m_product where 1=1 order by productid desc");
									while($row_get = mysqli_fetch_assoc($sql_get))
									{
										$pcatid=$row_get['pcatid'];
									   ?> <tr>
                                                <td style="text-align:center;"><?php echo $slno++; ?></td> 
                                                <td><?php echo $row_get['prod_code']; ?></td> 
                                                 <td><?php echo $cmn->getvalfield($connection,"m_unit","unit_name","unitid='$row_get[unitid]'"); ?></td> 
                                                 <td><?php echo $cmn->getvalfield($connection,"m_product_category","catname","pcatid='$pcatid'"); ?></td> 
                                                 <td><?php echo $row_get['prodname']; ?></td>
                                                 <td><?php echo $row_get['opening_stock']; ?></td>  
                                                 <td><?php echo $row_get['rate']; ?></td> 
                 
                              					
                        </tr>
                    
                        <?php
						}
						?>
                        
                        
                    </tbody>
                </table>