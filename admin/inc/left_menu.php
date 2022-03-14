<div class="leftpanel">
       <div class="logopanel">
        	<h1 style="font-size:18px;"><a href="index.php"><?php echo $cmn->getvalfield($connection,"company_setting","comp_name","compid = '$loginid' "); ?></a></h1>
        </div><!--logopanel-->
        
        <div class="datewidget"><span style="font-size:15px"><b>Session <?php echo $cmn->getvalfield($connection,"m_session","session_name","status = '1' "); ?></b></span></div>
    
    	<div class="searchwidget">
        	<form action="" method="post">
            	<div class="input-append">
                    <input type="text" class="span2 search-query" placeholder="Search here...">
                    <button type="submit" class="btn"><span class="icon-search"></span></button>
                </div>
            </form>
        </div><!--searchwidget-->
        
        <div class="leftmenu">        
            <ul class="nav nav-tabs nav-stacked" id="mymenu">
             <li <?php if($pagename == "index.php") { ?>class="active" <?php } ?>><a href="index.php"><span class="icon-align-justify"></span>Dashboard</a></li>
               
                 
                   <li class="dropdown  <?php if($pagename == "company_setting.php" || $pagename == "master_unit.php" || $pagename == "master_disease.php" || $pagename == "master_pcat.php" || $pagename == "master_product.php" || $pagename =="m_supplier.php" || $pagename =="m_customer.php" || $pagename =="master_branch.php" || $pagename =="master_tax.php" || $pagename =="master_bank.php" || $pagename=="master_expense.php" ) { ?>active <?php } ?>"><a href="#"><span class="icon-pencil"></span> Master </a>
                	<ul <?php if($pagename == "company_setting.php" || $pagename == "master_unit.php" || $pagename == "master_disease.php" || $pagename == "master_pcat.php" || $pagename == "master_product.php" || $pagename =="m_supplier.php"  || $pagename =="master_bank.php" || $pagename =="m_customer.php" || $pagename =="master_branch.php" || $pagename =="master_tax.php" || $pagename=="master_expense.php" ) { ?>style="display: block"  <?php } ?>>
                    	
                                 <li><a href="company_setting.php">Company Setting</a></li>
                                 <li><a href="master_unit.php">Unit Name</a></li>
                                 <!-- <li><a href="master_disease.php">Disease Type</a></li> -->
                              <!--   <li><a href="master_state.php">State Name</a></li>-->
                                  <li><a href="master_pcat.php">Categary Master</a></li>
                                <li><a href="master_product.php">Product Master</a></li>
                                <li><a href="m_supplier.php">Supplier Master</a></li>
                                    <li><a href="m_customer.php">Customer Master</a></li>
                            
                                <li><a href="master_session.php">Session Master</a></li>
                                <!--<li><a href="master_tax_cat.php">Master Tax Categary</a></li>--> 
                             
                                  <li><a href="master_expense.php">Master Expense</a></li> 
                                <!--<li><a href="master_tax.php">Tax Setting</a></li> -->
                               <?php if($usertype=='admin') { ?> <li><a href="user_master.php">User Master</a></li>  <?php } ?>
                    </ul>
                </li>
                
                <li class="dropdown  <?php if($pagename == "purchaseentry.php" || $pagename == "purchasereturnentry.php" ) { ?>active <?php } ?>"><a href="#"><span class="icon-pencil"></span> Purchase Entry </a>
                	<ul <?php if($pagename == "purchaseentry.php" || $pagename == "purchasereturn.php" ) { ?>style="display: block"  <?php } ?>>
                    	
                        <li><a href="purchaseentry.php">Purchase Entry</a></li>
                      <!-- <li><a href="purchasereturn.php">Purchase Return Entry</a></li>-->
                       
                    </ul>
                </li>
                <li class="dropdown  <?php if($pagename == "saleentry.php" || $pagename == "salereturnentry.php" ) { ?>active <?php } ?>"><a href="#"><span class="icon-pencil"></span> Sale Entry </a>
                	<ul <?php if($pagename == "saleentry.php" || $pagename == "salereturn.php" ) { ?>style="display: block"  <?php } ?>>
                    	
                        <li><a href="saleentry.php">Sale Entry</a></li>
                      <li><a href="salereturn.php">Sale Return Entry</a></li>
                       
                    </ul>
                </li>
                
                
                
                 
                  <li class="dropdown  <?php if($pagename == "payment_party.php" || $pagename == "payment_supplier.php" ) { ?>active <?php } ?>"><a href="#"><span class="icon-pencil"></span> Payment </a>
                	<ul <?php if($pagename == "payment_party.php" || $pagename == "payment_supplier.php") { ?>style="display: block"  <?php } ?>>
                    	
                        <li><a href="payment_party.php">Payment Customer </a></li>
                       <li><a href="payment_supplier.php">Payment Supplier</a></li>                       
                   
                    </ul>
                </li>
                
                <li class="dropdown  <?php if($pagename == "other_expense.php" || $pagename == "other_income.php") { ?>active <?php } ?>"><a href="#"><span class="icon-pencil"></span> Expense Dairy </a>
                	<ul <?php if($pagename == "other_expense.php" || $pagename == "other_income.php" ) { ?>style="display: block"  <?php } ?>>
                    	
                                             
                        <li><a href="other_expense.php">Other Expense</a></li>
                       <li><a href="other_income.php">Other Income</a></li>
                       
                    </ul>
                </li>
                
                              
                
                 <li class="dropdown  <?php if($pagename == "salereport.php" || $pagename == "purchasereport.php" || $pagename == "stock_report.php" || $pagename == "datewise_stock_report.php" || $pagename=="gst_wise_purchase_report2.php" ) { ?>active <?php } ?>"><a href="#"><span class="icon-pencil"></span> Report </a>
                	<ul <?php if($pagename == "salereport.php" || $pagename == "purchasereport.php" || $pagename == "stock_report.php" || $pagename == "datewise_stock_report.php" || $pagename=="gst_wise_purchase_report2.php" ) { ?>style="display: block"  <?php } ?>>
                    	
                       
                       <li><a href="purchasereport.php">Purchase Report</a></li>  
                       <li><a href="salereport.php">Sale Report</a></li>
                        <li><a href="salereturnreport.php">Sale Return Report</a></li>
                        <li><a href="customer_bal.php">Customer Balance Report</a></li>
                        <!--<li><a href="purchaseretrn_report.php">Purchase Return Report</a></li>-->                       
                         <!--<li><a href="datewise_stock_report.php">Categary Wise Stock Report</a></li>-->
                         <li><a href="productwise_stock_report.php">Product Wise Stock Report</a></li>
                                                  
                           
                    </ul>
                </li>
                
                
                  <li class="dropdown  <?php if($pagename == "bank_ledger.php" || $pagename == "cash_ledger.php" || $pagename == "customer_ledger.php" ) { ?>active <?php } ?>"><a href="#"><span class="icon-pencil"></span>  Transactions Detail </a>
                	<ul <?php if($pagename == "bank_ledger.php" || $pagename == "cash_ledger.php" || $pagename == "customer_ledger.php" ) { ?>style="display: block"  <?php } ?>>
                    	
                       
                       <li><a href="supplier_ledger.php" target="_blank" >Supplier Ledger </a></li>
                       <li><a href="customer_ledger.php" target="_blank" >Customer Ledger </a></li>
                                              
                    </ul>
                </li>
                
                
                
                <li <?php if($pagename == "changepassword.php" ) { ?>class="active" <?php } ?>><a href="changepassword.php"><i class="icon-user"></i>
                &nbsp;&nbsp;&nbsp;	
                 Change Password</a></li>
                 
      
                  
            </ul>
            
        </div><!--leftmenu-->
        
    </div>